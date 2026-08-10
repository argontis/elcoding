<?php

namespace App\Services;

use Xendit\Configuration;
use Exception;

class XenditService
{
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
    }

    /**
     * Contoh metode untuk mengecek setup
     */
    public function isConfigured(): bool
    {
        return !empty(config('xendit.secret_key'));
    }
}
