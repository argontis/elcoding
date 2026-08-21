<x-layout title="Status Pembayaran">
    <style>
        .payment-status-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 40px 30px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #e5e7eb;
            text-align: center;
        }
        .status-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }
        .status-icon.success { color: #10b981; }
        .status-icon.pending { color: #f59e0b; }
        .status-title {
            font-size: 26px;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .status-desc {
            font-size: 15px;
            color: #6b7280;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .order-info-box {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
            border: 1px solid #f3f4f6;
        }
        .order-info-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
            border-bottom: 1px dashed #e5e7eb;
        }
        .order-info-item:last-child {
            border-bottom: none;
        }
        .btn-home {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #4B6BF5;
            color: #ffffff !important;
            font-size: 15px;
            font-weight: 700;
            padding: 14px 32px;
            border-radius: 30px;
            text-decoration: none !important;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(124, 58, 237, 0.4);
        }
        .btn-home:hover, .btn-home:focus, .btn-home:active, .btn-home:visited {
            background: #4B6BF5;
            color: #ffffff !important;
            transform: translateY(-2px);
            text-decoration: none !important;
            box-shadow: 0 6px 20px rgba(109, 40, 217, 0.5);
        }
    </style>

    <div class="payment-status-container">
        @if($order && in_array($order->status, ['paid', 'PAID', 'SETTLED']))
            <div class="status-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="status-title">Pembayaran Berhasil!</h1>
            <p class="status-desc">
                Terima kasih, <strong>{{ $order->user_name }}</strong>! Pembayaran untuk program <strong>{{ $order->programKursus->title ?? 'Kursus' }}</strong> telah kami terima.
            </p>
        @else
            <div class="status-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <h1 class="status-title">Transaksi Diproses</h1>
            <p class="status-desc">
                Transaksi Anda sedang diproses atau menunggu konfirmasi dari sistem Xendit. Silakan cek email Anda untuk detail transaksi.
            </p>
        @endif

        @if($order)
        <div class="order-info-box">
            <div class="order-info-item">
                <span class="text-gray-500">ID Transaksi:</span>
                <span class="font-mono font-bold">{{ $order->external_id }}</span>
            </div>
            <div class="order-info-item">
                <span class="text-gray-500">Program:</span>
                <span class="font-semibold">{{ $order->programKursus->title ?? '-' }}</span>
            </div>
            <div class="order-info-item">
                <span class="text-gray-500">Total Pembayaran:</span>
                <span class="font-bold text-purple-600">Rp{{ number_format($order->amount, 0, ',', '.') }}</span>
            </div>
            <div class="order-info-item">
                <span class="text-gray-500">Status:</span>
                <span class="font-bold uppercase {{ $order->status == 'paid' ? 'text-green-600' : 'text-amber-600' }}">{{ $order->status }}</span>
            </div>
        </div>
        @endif

        <a href="{{ url('/program-kursus') }}" class="btn-home">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali ke Program Kursus</span>
        </a>
    </div>
</x-layout>
