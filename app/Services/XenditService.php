<?php

namespace App\Services;

use App\Models\Order;
use App\Models\LayananOrder;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Exception;

class XenditService
{
    protected InvoiceApi $invoiceApi;

    /**
     * Inisialisasi Xendit Configuration.
     */
    public function __construct()
    {
        $secretKey = config('xendit.secret_key');

        if (empty($secretKey)) {
            throw new Exception('Xendit Secret Key is not set in configuration.');
        }

        Configuration::setXenditKey($secretKey);
        $this->invoiceApi = new InvoiceApi();
    }

    /**
     * Mengecek apakah Xendit sudah dikonfigurasi.
     */
    public function isConfigured(): bool
    {
        return !empty(config('xendit.secret_key'));
    }

    /**
     * Membuat invoice Xendit untuk sebuah Order.
     *
     * @return array{invoice_id: string, invoice_url: string}
     */
    public function createInvoice(Order $order): array
    {
        $program = $order->programKursus;

        $request = new CreateInvoiceRequest([
            'external_id' => $order->external_id,
            'amount' => $order->amount,
            'description' => "Pembayaran kursus: {$program->title}",
            'currency' => 'IDR',
            'invoice_duration' => 86400, // 24 jam
            'customer' => [
                'given_names' => (string) $order->user_name,
                'email' => (string) $order->user_email,
                'mobile_number' => (string) $order->user_phone,
            ],
            'success_redirect_url' => url('/payment/success?order_id=' . $order->external_id),
            'failure_redirect_url' => url('/program-kursus/' . $program->id),
        ]);

        $result = $this->invoiceApi->createInvoice($request);

        return [
            'invoice_id' => $result->getId(),
            'invoice_url' => $result->getInvoiceUrl(),
        ];
    }

    public function createLayananInvoice(LayananOrder $order): array
    {
        $layanan = $order->layanan;

        $request = new CreateInvoiceRequest([
            'external_id' => $order->external_id,
            'amount' => $order->amount,
            'description' => "Pembayaran Layanan: {$layanan->title}",
            'currency' => 'IDR',
            'invoice_duration' => 86400, // 24 jam
            'customer' => [
                'given_names' => (string) $order->user_name,
                'email' => (string) $order->user_email,
                'mobile_number' => (string) $order->user_phone,
            ],
            'success_redirect_url' => url('/layanan/payment/success?order_id=' . $order->external_id),
            'failure_redirect_url' => url('/layanan/detail/' . $layanan->slug),
        ]);

        $result = $this->invoiceApi->createInvoice($request);

        return [
            'invoice_id' => $result->getId(),
            'invoice_url' => $result->getInvoiceUrl(),
        ];
    }
    public function createEventInvoice(\App\Models\EventOrder $order): array
    {
        $request = new CreateInvoiceRequest([
            'external_id' => $order->external_id,
            'amount' => $order->amount,
            'description' => "Pendaftaran Event & Webinar Elcoding",
            'currency' => 'IDR',
            'invoice_duration' => 86400, // 24 jam
            'customer' => [
                'given_names' => (string) $order->user_name,
                'email' => (string) $order->user_email,
                'mobile_number' => (string) $order->user_phone,
            ],
            'success_redirect_url' => url('/event-webinar/payment/success?order_id=' . $order->external_id),
            'failure_redirect_url' => url('/event-webinar'),
        ]);

        $result = $this->invoiceApi->createInvoice($request);

        return [
            'invoice_id' => $result->getId(),
            'invoice_url' => $result->getInvoiceUrl(),
        ];
    }
}
