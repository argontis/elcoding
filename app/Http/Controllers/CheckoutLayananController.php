<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\LayananOrder;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutLayananController extends Controller
{
    /**
     * Proses checkout — buat order + invoice Xendit, redirect ke halaman bayar.
     */
    public function checkout(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'nullable|string|max:20',
        ]);

        // Pastikan price_amount sudah diisi
        if (!$layanan->price_amount || $layanan->price_amount <= 0) {
            return back()->with('error', 'Harga layanan belum dikonfigurasi. Silakan hubungi admin.');
        }

        $externalId = 'LAY-' . strtoupper(Str::random(8)) . '-' . time();

        $order = LayananOrder::create([
            'external_id' => $externalId,
            'user_name' => $validated['user_name'],
            'user_email' => $validated['user_email'],
            'user_phone' => $validated['user_phone'] ?? null,
            'layanan_id' => $layanan->id,
            'amount' => $layanan->price_amount,
            'status' => 'pending',
        ]);

        try {
            $xendit = new XenditService();
            $invoice = $xendit->createLayananInvoice($order);

            $order->update([
                'xendit_invoice_id' => $invoice['invoice_id'],
                'xendit_invoice_url' => $invoice['invoice_url'],
            ]);

            \App\Models\ActivityLog::add(
                'Transaksi',
                'Pesanan Layanan Baru',
                "{$order->user_name} ({$order->user_email}) membuat pesanan untuk layanan '{$layanan->title}' sebesar Rp " . number_format($order->amount, 0, ',', '.') . ".",
                'blue',
                'fa-shopping-bag'
            );

            return redirect($invoice['invoice_url']);
        } catch (\Exception $e) {
            $order->update(['status' => 'failed']);
            return back()->with('error', 'Gagal membuat invoice pembayaran. Silakan coba lagi.');
        }
    }

    /**
     * Xendit webhook callback — update status order.
     */
    public function callback(Request $request)
    {
        // Verifikasi callback token dari Xendit
        $callbackToken = $request->header('x-callback-token');
        $expectedToken = config('xendit.callback_token');

        if ($expectedToken && $callbackToken !== $expectedToken) {
            return response()->json(['message' => 'Invalid callback token'], 403);
        }

        $externalId = $request->input('external_id');
        $status = $request->input('status');

        $order = LayananOrder::with('layanan')->where('external_id', $externalId)->first();

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

        $layananTitle = $order->layanan->title ?? 'Layanan';

        if (in_array($status, ['PAID', 'SETTLED'])) {
            \App\Models\ActivityLog::add(
                'Transaksi',
                'Pembayaran Layanan Lunas',
                "Pembayaran dari {$order->user_name} untuk layanan '{$layananTitle}' sebesar Rp " . number_format($order->amount, 0, ',', '.') . " telah LUNAS via Xendit.",
                'emerald',
                'fa-check-double'
            );
        }

        return response()->json(['message' => 'OK']);
    }

    /**
     * Halaman sukses setelah pembayaran.
     */
    public function paymentSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = LayananOrder::where('external_id', $orderId)->with('layanan')->first();

        return view('payment-success-layanan', compact('order'));
    }
}
