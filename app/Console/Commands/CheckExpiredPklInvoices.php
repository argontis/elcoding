<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PklInvoice;
use App\Models\PklProfile;
use App\Models\PklHistory;

class CheckExpiredPklInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pkl:check-expired-invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nonaktifkan otomatis akun PKL yang masa aktif pembayarannya (valid_until) telah habis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find paid invoices whose valid_until has passed
        $expiredInvoices = PklInvoice::where('status', 'paid')
                                     ->whereNotNull('valid_until')
                                     ->where('valid_until', '<', now())
                                     ->get();

        $count = 0;
        foreach ($expiredInvoices as $invoice) {
            $profile = $invoice->profile;
            
            // Wait, we only deactivate if they don't have any OTHER paid invoice that is still valid.
            $hasActiveInvoice = PklInvoice::where('pkl_profile_id', $profile->id)
                                          ->where('status', 'paid')
                                          ->where(function($q) {
                                              $q->whereNull('valid_until')
                                                ->orWhere('valid_until', '>=', now());
                                          })
                                          ->exists();

            if ($profile && $profile->status === 'active' && !$hasActiveInvoice) {
                $profile->update(['status' => 'inactive']);

                PklHistory::create([
                    'pkl_profile_id' => $profile->id,
                    'activity_type' => 'account_deactivated',
                    'title' => 'Masa Aktif Pembayaran Habis',
                    'description' => 'Akun dinonaktifkan otomatis karena masa berlaku pembayaran telah habis.',
                    'icon' => 'fa-clock',
                    'logged_at' => now(),
                ]);

                $this->info("Deactivated PKL profile ID: {$profile->id}");
                $count++;
            }
        }

        $this->info("Successfully checked and deactivated {$count} expired accounts.");
    }
}
