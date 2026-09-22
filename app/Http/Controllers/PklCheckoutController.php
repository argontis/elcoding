<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramKursus;
use App\Models\Event;
use App\Models\Order;
use App\Models\EventOrder;
use App\Models\PklProfile;
use App\Services\XenditService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PklCheckoutController extends Controller
{
    private function getProfile()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user) return null;

        $profile = PklProfile::where('user_id', $user->id)->first();
        if (!$profile) {
            $profile = PklProfile::where('email', $user->email)->first();
            if ($profile && !$profile->user_id) {
                $profile->update(['user_id' => $user->id]);
            }
        }
        return $profile;
    }

    public function checkoutProgram($id)
    {
        $profile = $this->getProfile();
        $program = ProgramKursus::findOrFail($id);
        $user = Auth::user();

        // Cek jika sudah dibeli
        $isPurchased = Order::where('user_email', $user->email)
            ->where('program_kursus_id', $program->id)
            ->whereIn('status', ['paid', 'PAID', 'SETTLED'])
            ->exists();

        if ($isPurchased) {
            return redirect()->route('pkl.program.detail', $program->id)->with('success', 'Anda sudah terdaftar di program ini.');
        }

        $itemType = 'program';
        $item = $program;
        
        return view('pkl.checkout', compact('profile', 'itemType', 'item', 'user'));
    }

    public function processProgram(Request $request, $id)
    {
        $program = ProgramKursus::findOrFail($id);
        $user = Auth::user();

        $amount = (float) $program->price_amount;

        $order = Order::create([
            'external_id' => 'ELC-' . strtoupper(Str::random(8)) . '-' . time(),
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $request->input('user_phone', '08000000000'), // Fallback if no phone
            'program_kursus_id' => $program->id,
            'amount' => $amount,
            'status' => $amount > 0 ? 'pending' : 'PAID',
        ]);

        if ($amount > 0) {
            try {
                $xendit = new XenditService();
                $invoice = $xendit->createInvoice($order);

                $order->update([
                    'xendit_invoice_id' => $invoice['invoice_id'],
                    'xendit_invoice_url' => $invoice['invoice_url'],
                ]);

                \App\Models\ActivityLog::add(
                    'Transaksi PKL',
                    'Pesanan Baru PKL',
                    "{$order->user_name} (PKL) memesan program '{$program->title}' sebesar Rp " . number_format($order->amount, 0, ',', '.') . ".",
                    'blue',
                    'fa-shopping-cart'
                );

                return redirect($invoice['invoice_url']);
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal membuat tagihan Xendit: ' . $e->getMessage());
            }
        } else {
            \App\Models\ActivityLog::add(
                'Transaksi PKL',
                'Pendaftaran Gratis PKL',
                "{$order->user_name} (PKL) mendaftar program gratis '{$program->title}'.",
                'emerald',
                'fa-check-circle'
            );
            return redirect()->route('pkl.program.detail', $program->id)->with('success', 'Pendaftaran program gratis berhasil!');
        }
    }

    public function checkoutEvent($id)
    {
        $profile = $this->getProfile();
        $event = Event::findOrFail($id);
        $user = Auth::user();

        // Cek jika sudah dibeli
        $isPurchased = EventOrder::where('user_email', $user->email)
            ->where('event_id', $event->id)
            ->whereIn('status', ['paid', 'PAID', 'SETTLED'])
            ->exists();

        if ($isPurchased) {
            return redirect()->route('pkl.event.detail', $event->id)->with('success', 'Anda sudah terdaftar di event ini.');
        }

        $itemType = 'event';
        $item = $event;
        
        return view('pkl.checkout', compact('profile', 'itemType', 'item', 'user'));
    }

    public function processEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user();

        $amount = (float) $event->price_amount;

        $order = EventOrder::create([
            'external_id' => 'EVT-' . strtoupper(Str::random(8)) . '-' . time(),
            'event_id' => $event->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $request->input('user_phone', '08000000000'),
            'amount' => $amount,
            'status' => $amount > 0 ? 'pending' : 'PAID',
        ]);

        if ($amount > 0) {
            try {
                $xendit = new XenditService();
                $invoice = $xendit->createEventInvoice($order);

                $order->update([
                    'xendit_invoice_id' => $invoice['invoice_id'],
                    'xendit_invoice_url' => $invoice['invoice_url'],
                ]);

                \App\Models\ActivityLog::add(
                    'Transaksi PKL',
                    'Pesanan Event Baru PKL',
                    "{$order->user_name} (PKL) mendaftar event '{$event->title}' tagihan: Rp " . number_format($order->amount, 0, ',', '.') . ".",
                    'blue',
                    'fa-calendar-check'
                );

                return redirect($invoice['invoice_url']);
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal membuat tagihan Xendit: ' . $e->getMessage());
            }
        } else {
            \App\Models\ActivityLog::add(
                'Transaksi PKL',
                'Pendaftaran Event Gratis PKL',
                "{$order->user_name} (PKL) mendaftar event gratis '{$event->title}'.",
                'emerald',
                'fa-check-circle'
            );
            return redirect()->route('pkl.event.detail', $event->id)->with('success', 'Pendaftaran event gratis berhasil!');
        }
    }
}
