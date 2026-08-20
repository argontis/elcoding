<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProgramKursus;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramKursusController extends Controller
{
    /**
     * Halaman detail program kursus.
     */
    public function show($id)
    {
        $program = ProgramKursus::findOrFail($id);
        $relatedPrograms = ProgramKursus::where('id', '!=', $id)->latest()->take(3)->get();

        \Artesaos\SEOTools\Facades\SEOTools::setTitle($program->title);
        \Artesaos\SEOTools\Facades\SEOTools::setDescription(strip_tags(substr($program->description, 0, 160)));

        return view('program-kursus-detail', compact('program', 'relatedPrograms'));
    }

    /**
     * Proses checkout — buat order + invoice Xendit, redirect ke halaman bayar.
     */
    public function checkout(Request $request, $id)
    {
        $program = ProgramKursus::findOrFail($id);

        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'nullable|string|max:20',
        ]);

        // Pastikan price_amount sudah diisi
        if (!$program->price_amount || $program->price_amount <= 0) {
            return back()->with('error', 'Harga program belum dikonfigurasi. Silakan hubungi admin.');
        }

        $externalId = 'ELC-' . strtoupper(Str::random(8)) . '-' . time();

        $order = Order::create([
            'external_id' => $externalId,
            'user_name' => $validated['user_name'],
            'user_email' => $validated['user_email'],
            'user_phone' => $validated['user_phone'] ?? null,
            'program_kursus_id' => $program->id,
            'amount' => $program->price_amount,
            'status' => 'pending',
        ]);

        try {
            $xendit = new XenditService();
            $invoice = $xendit->createInvoice($order);

            $order->update([
                'xendit_invoice_id' => $invoice['invoice_id'],
                'xendit_invoice_url' => $invoice['invoice_url'],
            ]);

            \App\Models\ActivityLog::add(
                'Transaksi',
                'Pesanan Baru',
                "{$order->user_name} ({$order->user_email}) membuat pesanan untuk program '{$program->title}' sebesar Rp " . number_format($order->amount, 0, ',', '.') . ".",
                'blue',
                'fa-shopping-cart'
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

        $order = Order::with('programKursus')->where('external_id', $externalId)->first();

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

        $programTitle = $order->programKursus->title ?? 'Program Kursus';

        if (in_array($status, ['PAID', 'SETTLED'])) {
            \App\Models\ActivityLog::add(
                'Transaksi',
                'Pembayaran Lunas',
                "Pembayaran dari {$order->user_name} untuk '{$programTitle}' sebesar Rp " . number_format($order->amount, 0, ',', '.') . " telah LUNAS via Xendit.",
                'emerald',
                'fa-check-circle'
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
        $order = Order::where('external_id', $orderId)->with('programKursus')->first();

        return view('payment-success', compact('order'));
    }
}
