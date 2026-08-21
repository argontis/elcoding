<?php

namespace App\Http\Controllers;

use App\Models\EventOrder;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventCheckoutController extends Controller
{
    /**
     * Proses checkout pendaftaran event.
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20',
            'amount' => 'nullable|numeric',
            'event_name' => 'nullable|string'
        ]);

        $externalId = 'EVT-' . strtoupper(Str::random(8)) . '-' . time();
        $amount = $validated['amount'] ?? 50000;
        $eventName = $validated['event_name'] ?? 'Event & Webinar';

        $order = EventOrder::create([
            'external_id' => $externalId,
            'user_name' => $validated['nama'],
            'user_email' => $validated['email'],
            'user_phone' => $validated['whatsapp'],
            'amount' => $amount,
            'status' => 'pending',
        ]);

        try {
            $xendit = new XenditService();
            $invoice = $xendit->createEventInvoice($order);

            $order->update([
                'xendit_invoice_id' => $invoice['invoice_id'],
                'xendit_invoice_url' => $invoice['invoice_url'],
            ]);

            \App\Models\ActivityLog::add(
                'Event',
                'Pendaftaran Event Baru',
                "{$order->user_name} ({$order->user_email}) mendaftar event & webinar. Tagihan: Rp " . number_format($order->amount, 0, ',', '.') . ".",
                'blue',
                'fa-calendar-check'
            );

            return redirect($invoice['invoice_url']);
        } catch (\Exception $e) {
            $order->update(['status' => 'failed']);
            return back()->with('error', 'Gagal membuat tagihan pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Webhook Xendit untuk Event.
     */
    public function callback(Request $request)
    {
        $callbackToken = $request->header('x-callback-token');
        $expectedToken = config('xendit.callback_token');

        if ($expectedToken && $callbackToken !== $expectedToken) {
            return response()->json(['message' => 'Invalid callback token'], 403);
        }

        $externalId = $request->input('external_id');
        $status = $request->input('status');

        $order = EventOrder::where('external_id', $externalId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $statusMap = [
            'PAID' => 'paid',
            'SETTLED' => 'paid',
            'EXPIRED' => 'expired',
            'FAILED' => 'failed',
        ];

        $newStatus = $statusMap[$status] ?? 'pending';

        $order->update([
            'status' => $newStatus,
            'paid_at' => in_array($status, ['PAID', 'SETTLED']) ? now() : null,
        ]);

        if (in_array($status, ['PAID', 'SETTLED'])) {
            \App\Models\ActivityLog::add(
                'Event',
                'Pembayaran Event Lunas',
                "Pembayaran dari {$order->user_name} untuk Event & Webinar sebesar Rp " . number_format($order->amount, 0, ',', '.') . " telah LUNAS.",
                'emerald',
                'fa-check-double'
            );
        }

        return response()->json(['message' => 'OK']);
    }

    /**
     * Halaman sukses pembayaran event.
     */
    public function paymentSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = EventOrder::where('external_id', $orderId)->first();

        return view('payment-success-event', compact('order'));
    }
}
