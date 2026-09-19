<?php

namespace App\Http\Controllers;

use App\Models\PklAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RfidController extends Controller
{
    /**
     * Tampilan Kiosk Terminal Absensi RFID (Public / Dedicated Display)
     */
    public function terminal()
    {
        $today = now()->toDateString();
        $recentAttendances = PklAttendance::with(['user.pklProfile'])
            ->where('date', $today)
            ->latest('updated_at')
            ->take(10)
            ->get();

        return view('presensi-rfid', compact('today', 'recentAttendances'));
    }

    /**
     * API Handler Scan RFID untuk Absensi
     */
    public function scanAttendance(Request $request)
    {
        $request->validate([
            'rfid_uid' => 'required|string',
        ]);

        $rfidUid = trim($request->rfid_uid);
        $user = User::where('rfid_uid', $rfidUid)->with('pklProfile')->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Kartu RFID (' . $rfidUid . ') belum terdaftar di sistem! Silakan hubungi Admin.',
            ], 404);
        }

        $today = now()->toDateString();
        $now = now()->format('H:i:s');
        $attendance = PklAttendance::where('user_id', $user->id)->where('date', $today)->first();

        $action = 'check_in';
        $message = '';

        if (!$attendance) {
            // Check-In (Absen Masuk)
            $status = ($now > '08:15:00') ? 'terlambat' : 'hadir';
            $attendance = PklAttendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'check_in' => $now,
                'status' => $status,
            ]);
            $action = 'MASUK';
            $message = 'Presensi Masuk Berhasil! Selamat bekerja/belajar, ' . $user->name . '.';
        } else if (is_null($attendance->check_out)) {
            // Check-Out (Absen Pulang)
            $attendance->update([
                'check_out' => $now,
            ]);
            $action = 'PULANG';
            $message = 'Presensi Pulang Berhasil! Terima kasih dan hati-hati di jalan, ' . $user->name . '.';
        } else {
            // Sudah Absen Masuk & Pulang
            $action = 'SUDAH_ABSEN';
            $message = $user->name . ' sudah mencatat presensi Masuk (' . $attendance->check_in . ') & Pulang (' . $attendance->check_out . ') hari ini.';
        }

        $institution = $user->pklProfile->institution ?? 'Elcoding Student';

        return response()->json([
            'success' => true,
            'action' => $action,
            'message' => $message,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'institution' => $institution,
                'rfid_uid' => $user->rfid_uid,
            ],
            'attendance' => [
                'date' => $attendance->date,
                'check_in' => $attendance->check_in,
                'check_out' => $attendance->check_out,
                'status' => ucfirst($attendance->status),
            ],
        ]);
    }

    /**
     * Login Cepat via RFID Scan
     */
    public function loginWithRfid(Request $request)
    {
        $request->validate([
            'rfid_uid' => 'required|string',
        ]);

        $rfidUid = trim($request->rfid_uid);
        $user = User::where('rfid_uid', $rfidUid)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Kartu RFID tidak ditemukan! Pastikan kartu sudah terdaftar.',
            ], 404);
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        $redirectUrl = route('dashboard');
        if ($user->isPklStudent()) {
            $redirectUrl = route('member.dashboard');
        }

        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil! Selamat datang kembali, ' . $user->name,
            'redirect' => $redirectUrl,
        ]);
    }

    /**
     * Admin: Connect / Assign RFID Card to User
     */
    public function assignRfid(Request $request, $userId)
    {
        $request->validate([
            'rfid_uid' => 'required|string|unique:users,rfid_uid,' . $userId,
        ], [
            'rfid_uid.unique' => 'Kode Kartu RFID ini sudah dipakai oleh pengguna lain!',
        ]);

        $user = User::findOrFail($userId);
        $user->update([
            'rfid_uid' => trim($request->rfid_uid),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kartu RFID berhasil dihubungkan ke ' . $user->name,
                'rfid_uid' => $user->rfid_uid,
            ]);
        }

        return redirect()->back()->with('success', 'Kartu RFID berhasil dihubungkan ke ' . $user->name);
    }
}
