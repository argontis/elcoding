<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\PklInvoice;
use App\Models\PklHistory;

#[Signature('pkl:check-overdue-invoices')]
#[Description('Mengecek invoice pkl yang lewat jatuh tempo dan menonaktifkan akun magang.')]
class CheckOverduePklInvoices extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $overdueInvoices = PklInvoice::where('status', 'pending')
            ->whereNotNull('due_date')
            ->where('due_date', '<', now())
            ->with('profile')
            ->get();

        $count = 0;
        foreach ($overdueInvoices as $invoice) {
            $invoice->update(['status' => 'cancelled']);
            
            if ($invoice->profile) {
                $invoice->profile->update(['status' => 'inactive']);
                
                PklHistory::create([
                    'pkl_profile_id' => $invoice->profile->id,
                    'activity_type' => 'account_deactivated',
                    'title' => 'Akun Dinonaktifkan Otomatis',
                    'description' => 'Invoice ' . $invoice->invoice_code . ' telah melewati batas waktu pembayaran.',
                    'icon' => 'fa-user-slash',
                    'logged_at' => now(),
                ]);
            }
            $count++;
        }

        $this->info("Berhasil membatalkan $count invoice yang lewat jatuh tempo dan menonaktifkan akun terkait.");
    }
}
