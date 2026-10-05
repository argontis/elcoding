<?php

namespace App\Http\Controllers\Clean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\LaundryOrder;
use App\Models\LaundryCustomer;
use App\Models\LaundryService;
use Carbon\Carbon;

class CleanDashboardController extends Controller
{
    /**
     * Display the L-Clean Multi-Tenant SaaS Laundry Facility Dashboard.
     */
    public function index(Request $request)
    {
        $currentUser = auth()->user();

        // ---------------------------------------------------------------
        // 1. DASHBOARD OMZET & FINANCIAL ANALYTICS
        // ---------------------------------------------------------------
        $totalOrders = LaundryOrder::all();
        $totalOrdersCount = $totalOrders->count();
        
        $totalRevAmount = $totalOrders->sum('amount');
        $todayRevAmount = LaundryOrder::whereDate('created_at', Carbon::today())->sum('amount');
        
        $todayRevenueFormatted = 'Rp ' . number_format($todayRevAmount, 0, ',', '.');
        $totalOmzetFormatted = 'Rp ' . number_format($totalRevAmount, 0, ',', '.');

        // Revenue breakdown by payment method
        $qrisOmzet = LaundryOrder::where('payment_method', 'QRIS')->sum('amount');
        $cashOmzet = LaundryOrder::where('payment_method', 'Tunai')->sum('amount');
        $transferOmzet = LaundryOrder::where('payment_method', 'LIKE', '%Transfer%')->sum('amount');
        $membershipOmzet = LaundryOrder::where('payment_method', 'LIKE', '%Membership%')->sum('amount');

        // Order stage counts (Flow: Diterima -> Proses -> Selesai -> Diambil)
        $diterimaCount = LaundryOrder::where('stage', 'Diterima')->count();
        $prosesCount = LaundryOrder::where('stage', 'Proses')->count();
        $selesaiCount = LaundryOrder::where('stage', 'Selesai')->count();
        $diambilCount = LaundryOrder::where('stage', 'Diambil')->count();

        $stats = [
            'today_revenue' => $todayRevenueFormatted,
            'total_omzet' => $totalOmzetFormatted,
            'revenue_change' => $totalOrdersCount > 0 ? '+24.5%' : '0%',
            'yesterday_revenue' => 'Rp 0',
            'in_facility_orders' => $prosesCount + $diterimaCount,
            'diterima_count' => $diterimaCount,
            'proses_count' => $prosesCount,
            'selesai_count' => $selesaiCount,
            'diambil_count' => $diambilCount,
            'capacity_percentage' => $totalOrdersCount > 0 ? '88%' : '0%',
            'delivered_transit' => $diambilCount,
            'turnaround_sla' => '100%',
            'outbound_couriers' => $totalOrdersCount > 0 ? 8 : 0,
            'qris_omzet' => 'Rp ' . number_format($qrisOmzet, 0, ',', '.'),
            'cash_omzet' => 'Rp ' . number_format($cashOmzet, 0, ',', '.'),
            'transfer_omzet' => 'Rp ' . number_format($transferOmzet, 0, ',', '.'),
            'membership_omzet' => 'Rp ' . number_format($membershipOmzet, 0, ',', '.'),
            'active_clients_today' => LaundryCustomer::count(),
            'commercial_clients' => LaundryCustomer::where('account_type', 'LIKE', '%Corporate%')->count(),
            'vip_members' => LaundryCustomer::where('account_type', 'LIKE', '%VIP%')->orWhere('account_type', 'LIKE', '%Gold%')->count(),
        ];

        // ---------------------------------------------------------------
        // 2. REAL ORDERS STREAM & STATUS TRACKING
        // ---------------------------------------------------------------
        $dbOrders = LaundryOrder::latest()->get();
        $ordersStream = [];

        foreach ($dbOrders as $ord) {
            $ordersStream[] = [
                'id' => $ord->id,
                'order_id' => $ord->order_id,
                'tenant_name' => $ord->tenant_name ?: 'L-Clean Hub #01',
                'rfid_tag' => $ord->rfid_tag ?: 'TAG-9024-' . $ord->id,
                'client_name' => $ord->client_name,
                'client_badge' => $ord->client_badge,
                'whatsapp_phone' => $ord->whatsapp_phone ?: '081234567890',
                'service' => $ord->service_name,
                'weight_items' => $ord->weight_items,
                'stage' => $ord->stage, // Diterima, Proses, Selesai, Diambil
                'stage_type' => $this->getStageTypeColor($ord->stage),
                'est_completion' => $ord->est_completion ?: 'Hari ini, 17:00 WIB',
                'completion_sub' => $ord->completion_sub ?: 'Rak Bay Operasional',
                'specialist' => $ord->specialist ?: ($currentUser ? $currentUser->name : 'Operator Laundry'),
                'action_primary' => $this->getNextStageAction($ord->stage),
                'amount_raw' => $ord->amount,
                'amount' => 'Rp ' . number_format($ord->amount, 0, ',', '.'),
                'status' => $ord->status,
                'payment_status' => $ord->payment_status ?: 'PAID',
                'payment_method' => $ord->payment_method ?: 'QRIS',
                'delivery_type' => $ord->delivery_type ?: 'Self Pickup',
                'notes' => $ord->notes ?: '-',
                'created_at_formatted' => $ord->created_at ? $ord->created_at->format('d M Y, H:i') : now()->format('d M Y, H:i'),
            ];
        }

        // ---------------------------------------------------------------
        // 3. REAL CUSTOMERS & MEMBERSHIP BALANCE
        // ---------------------------------------------------------------
        $dbCustomers = LaundryCustomer::latest()->get();
        $customerList = [];

        foreach ($dbCustomers as $cust) {
            $customerList[] = [
                'id' => $cust->id,
                'name' => $cust->name,
                'account_type' => $cust->account_type,
                'contact_person' => $cust->contact_person ?: $cust->name,
                'email' => $cust->email ?: 'pelanggan@lclean.id',
                'phone' => $cust->phone ?: '081234567890',
                'status' => $cust->status,
                'membership_balance' => 'Rp ' . number_format($cust->membership_balance, 0, ',', '.'),
                'membership_balance_raw' => $cust->membership_balance,
                'points' => $cust->points,
                'throughput_kg' => number_format($cust->throughput_kg) . ' kg',
                'total_spent' => $cust->total_spent,
                'total_batches' => $cust->total_batches,
                'on_time_rate' => $cust->on_time_rate,
            ];
        }

        // ---------------------------------------------------------------
        // 4. REAL SERVICES & PRICING CATALOG
        // ---------------------------------------------------------------
        $dbServices = LaundryService::all();
        $servicesList = [];

        foreach ($dbServices as $srv) {
            $servicesList[] = [
                'id' => $srv->id,
                'name' => $srv->name,
                'tier' => $srv->tier,
                'unit' => $srv->unit,
                'price' => $srv->price_formatted,
                'raw_price' => $srv->price_amount,
                'minimum_batch' => $srv->minimum_batch ?: '1 min',
                'hardware_spec' => $srv->hardware_spec ?: 'Mesin Cuci Industrial',
                'status' => $srv->status,
                'active' => $srv->status === 'Active',
            ];
        }

        // ---------------------------------------------------------------
        // 5. INDUSTRIAL PIPELINE FLOW
        // ---------------------------------------------------------------
        $garmentPipeline = [
            ['stage' => '01', 'name' => 'DITERIMA', 'action' => 'Intake & Timbang', 'count' => $diterimaCount, 'subtitle' => 'Antrian Cuci', 'badge' => 'Front Office', 'color' => 'amber'],
            ['stage' => '02', 'name' => 'PROSES', 'action' => 'Washing & Ironing', 'count' => $prosesCount, 'subtitle' => 'Sedang Dicuci/Setrika', 'badge' => 'Bay Operasional', 'color' => 'sky'],
            ['stage' => '03', 'name' => 'SELESAI', 'action' => 'Packing & QC', 'count' => $selesaiCount, 'subtitle' => 'Siap Diambil/Diantar', 'badge' => 'Rak Siap #A-04', 'color' => 'emerald'],
            ['stage' => '04', 'name' => 'DIAMBIL', 'action' => 'Diserahkan ke Client', 'count' => $diambilCount, 'subtitle' => 'Nota Lunas', 'badge' => 'Selesai & Handover', 'color' => 'purple'],
        ];

        // Render Inertia Page
        return Inertia::render('Clean/Dashboard', [
            'auth' => [
                'user' => $currentUser,
            ],
            'stats' => $stats,
            'garmentPipeline' => $garmentPipeline,
            'ordersStream' => $ordersStream,
            'customerList' => $customerList,
            'servicesList' => $servicesList,
        ]);
    }

    /**
     * Store new Laundry Order.
     */
    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'whatsapp_phone' => 'nullable|string|max:20',
            'service_name' => 'required|string',
            'weight_items' => 'required|string',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'delivery_type' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $nextId = (LaundryOrder::max('id') ?? 0) + 1;
        $orderId = '#LC-' . sprintf('%04d', 8940 + $nextId);
        $rfidTag = 'TAG-QRIS-' . (9024 + $nextId);

        $order = LaundryOrder::create([
            'order_id' => $orderId,
            'tenant_name' => 'L-Clean Hub Utama',
            'rfid_tag' => $rfidTag,
            'client_name' => $validated['client_name'],
            'client_badge' => 'Pelanggan Regular',
            'whatsapp_phone' => $validated['whatsapp_phone'] ?: '081234567890',
            'service_name' => $validated['service_name'],
            'weight_items' => $validated['weight_items'],
            'stage' => 'Diterima',
            'stage_type' => 'amber',
            'est_completion' => 'Besok, 16:00 WIB',
            'completion_sub' => 'Rak Intake #01',
            'specialist' => auth()->user()->name ?? 'Operator L-Clean',
            'action_primary' => 'Mulai Proses',
            'amount' => $validated['amount'],
            'status' => 'Diterima',
            'payment_status' => 'PAID',
            'payment_method' => $validated['payment_method'],
            'delivery_type' => $validated['delivery_type'],
            'notes' => $validated['notes'] ?? '-',
        ]);

        return redirect()->back()->with('success', "Order {$order->order_id} berhasil dibuat!");
    }

    /**
     * Update order stage status: Diterima -> Proses -> Selesai -> Diambil.
     */
    public function updateStatus(Request $request, $id)
    {
        $order = LaundryOrder::findOrFail($id);
        $currentStage = $order->stage;

        $nextStage = 'Diterima';
        if ($currentStage === 'Diterima') {
            $nextStage = 'Proses';
        } elseif ($currentStage === 'Proses') {
            $nextStage = 'Selesai';
        } elseif ($currentStage === 'Selesai') {
            $nextStage = 'Diambil';
        } else {
            $nextStage = 'Diambil';
        }

        $order->update([
            'stage' => $nextStage,
            'status' => $nextStage,
            'stage_type' => $this->getStageTypeColor($nextStage),
            'action_primary' => $this->getNextStageAction($nextStage),
            'est_completion' => $nextStage === 'Selesai' ? 'Siap Diambil' : ($nextStage === 'Diambil' ? 'Diserahkan' : $order->est_completion),
        ]);

        return redirect()->back()->with('success', "Status Order {$order->order_id} diperbarui menjadi {$nextStage}!");
    }

    /**
     * Generate WhatsApp Notification payload & simulation.
     */
    public function sendWhatsappNotification(Request $request, $id)
    {
        $order = LaundryOrder::findOrFail($id);
        $phone = preg_replace('/[^0-9]/', '', $order->whatsapp_phone ?: '081234567890');

        $message = "Halo Bpk/Ibu *{$order->client_name}*,\n\n";
        $message .= "Update Cucian L-Clean *{$order->order_id}*:\n";
        $message .= "• Service: {$order->service_name}\n";
        $message .= "• Berat/Pcs: {$order->weight_items}\n";
        $message .= "• Status Cucian: *{$order->stage}*\n";
        $message .= "• Total Tagihan: Rp " . number_format($order->amount, 0, ',', '.') . " ({$order->payment_method})\n\n";

        if ($order->stage === 'Selesai') {
            $message .= "✨ Cucian Anda sudah SELESAI dan wangi! Siap diambil atau diantar.\n Terima kasih telah mengaktifkan layanan L-Clean SaaS Laundry!";
        } else {
            $message .= "Cucian Anda sedang ditangani oleh spesialis kami dengan higienis.\nTerima kasih!";
        }

        $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

        return response()->json([
            'status' => 'success',
            'message' => "Pesan WhatsApp untuk Order {$order->order_id} telah disiapkan.",
            'wa_url' => $waUrl,
            'phone' => $phone,
            'preview_text' => $message,
        ]);
    }

    /**
     * Get digital receipt data (Nota Digital).
     */
    public function getNotaDigital($id)
    {
        $order = LaundryOrder::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'nota' => [
                'brand_name' => 'L-Clean SaaS Laundry & Dry Clean',
                'tenant' => $order->tenant_name,
                'order_id' => $order->order_id,
                'rfid_tag' => $order->rfid_tag,
                'date' => $order->created_at ? $order->created_at->format('d/m/Y H:i') : now()->format('d/m/Y H:i'),
                'customer_name' => $order->client_name,
                'customer_badge' => $order->client_badge,
                'phone' => $order->whatsapp_phone,
                'service_name' => $order->service_name,
                'weight_items' => $order->weight_items,
                'amount' => 'Rp ' . number_format($order->amount, 0, ',', '.'),
                'payment_method' => $order->payment_method,
                'payment_status' => $order->payment_status,
                'stage' => $order->stage,
                'delivery_type' => $order->delivery_type,
                'operator' => $order->specialist ?: 'Admin L-Clean',
                'notes' => $order->notes,
            ]
        ]);
    }

    /**
     * Store new Customer into Membership system.
     */
    public function storeCustomer(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'account_type' => 'required|string',
            'membership_balance' => 'nullable|numeric',
        ]);

        $customer = LaundryCustomer::create([
            'name' => $validated['name'],
            'account_type' => $validated['account_type'],
            'contact_person' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? 'pelanggan@lclean.id',
            'status' => 'Active',
            'membership_balance' => $validated['membership_balance'] ?? 0,
            'points' => 100,
            'ledger_balance' => 'Rp ' . number_format($validated['membership_balance'] ?? 0, 0, ',', '.'),
            'total_spent' => 'Rp 0',
            'total_batches' => 0,
            'on_time_rate' => '100%',
        ]);

        return redirect()->back()->with('success', "Pelanggan {$customer->name} berhasil ditambahkan!");
    }

    /**
     * Store new Laundry Service & Pricing.
     */
    public function storeService(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tier' => 'required|string',
            'unit' => 'required|string',
            'price_amount' => 'required|numeric',
            'minimum_batch' => 'nullable|string',
            'hardware_spec' => 'nullable|string',
        ]);

        $unit = $validated['unit'] ?: 'kg';

        $service = LaundryService::create([
            'name' => $validated['name'],
            'tier' => $validated['tier'],
            'unit' => $unit,
            'price_amount' => $validated['price_amount'],
            'price_formatted' => 'Rp ' . number_format($validated['price_amount'], 0, ',', '.') . '/' . $unit,
            'minimum_batch' => $validated['minimum_batch'] ?: '1 ' . $unit,
            'hardware_spec' => $validated['hardware_spec'] ?: 'Mesin Cuci Industrial',
            'status' => 'Active',
        ]);

        return redirect()->back()->with('success', "Layanan {$service->name} berhasil ditambahkan!");
    }

    private function getStageTypeColor($stage)
    {
        switch ($stage) {
            case 'Diterima': return 'amber';
            case 'Proses': return 'sky';
            case 'Selesai': return 'emerald';
            case 'Diambil': return 'purple';
            default: return 'sky';
        }
    }

    private function getNextStageAction($stage)
    {
        switch ($stage) {
            case 'Diterima': return 'Mulai Proses';
            case 'Proses': return 'Set Selesai';
            case 'Selesai': return 'Set Diambil';
            case 'Diambil': return 'Sudah Selesai';
            default: return 'Lanjut';
        }
    }
}
