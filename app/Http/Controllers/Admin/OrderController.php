<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar transaksi / pesanan.
     */
    public function index(Request $request)
    {
        $query = Order::with('programKursus')->latest();

        // Filter status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search name, email, phone, external_id
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('user_name', 'like', "%{$search}%")
                  ->orWhere('user_email', 'like', "%{$search}%")
                  ->orWhere('user_phone', 'like', "%{$search}%")
                  ->orWhere('external_id', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        // Counter stats
        $stats = [
            'total' => Order::count(),
            'paid' => Order::whereIn('status', ['paid', 'PAID', 'SETTLED'])->count(),
            'pending' => Order::where('status', 'pending')->count(),
            'failed' => Order::whereIn('status', ['failed', 'expired'])->count(),
            'revenue' => Order::whereIn('status', ['paid', 'PAID', 'SETTLED'])->sum('amount'),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Manual status update (e.g. konfirmasi pembayaran manual).
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::with('programKursus')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,paid,failed,expired',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        $order->status = $newStatus;
        if ($newStatus === 'paid' && !$order->paid_at) {
            $order->paid_at = now();
        }
        $order->save();

        // Add Activity Log
        $programTitle = $order->programKursus->title ?? 'Program';
        ActivityLog::add(
            'Transaksi',
            'Update Status Pembayaran',
            "Status transaksi {$order->external_id} ({$order->user_name}) diperbarui dari '{$oldStatus}' menjadi '{$newStatus}'.",
            $newStatus === 'paid' ? 'green' : 'amber',
            'fa-receipt'
        );

        return back()->with('success', "Status transaksi {$order->external_id} berhasil diperbarui menjadi {$newStatus}.");
    }

    /**
     * Hapus transaksi.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $externalId = $order->external_id;
        $order->delete();

        ActivityLog::add(
            'Transaksi',
            'Hapus Transaksi',
            "Transaksi {$externalId} telah dihapus dari sistem.",
            'red',
            'fa-trash-alt'
        );

        return back()->with('success', "Transaksi {$externalId} berhasil dihapus.");
    }
}
