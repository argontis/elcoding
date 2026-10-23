import React, { useState, useEffect, useMemo } from 'react';
import { Head, Link, useForm, router } from '@inertiajs/react';
import {
    Sparkles,
    ShieldCheck,
    Clock,
    Truck,
    MapPin,
    Calendar,
    CheckCircle2,
    Search,
    ChevronRight,
    ChevronDown,
    ArrowRight,
    Phone,
    MessageCircle,
    FileText,
    Star,
    Layers,
    Droplets,
    Wind,
    Shirt,
    Award,
    HelpCircle,
    Info,
    Percent,
    Sliders,
    Tag,
    X,
    UserCheck,
    LogIn,
    ExternalLink,
    RefreshCw,
    QrCode,
    Check,
    Navigation,
    CreditCard,
    DollarSign,
    Box,
    Sparkle
} from 'lucide-react';

export default function CleanLanding({
    auth,
    activeTab: initialTab = 'beranda',
    services = [],
    trackingResult: initialTracking,
    searchCode: initialSearchCode = 'LC-89304',
    userOrders = []
}) {
    // Current Active Tab: 'beranda' | 'layanan' | 'status' | 'pesan'
    const [currentTab, setCurrentTab] = useState(initialTab);
    const [showSaaSModal, setShowSaaSModal] = useState(false);
    const [showNotaModal, setShowNotaModal] = useState(false);
    const [showSuccessModal, setShowSuccessModal] = useState(false);
    const [createdOrderId, setCreatedOrderId] = useState('');
    const [copiedPromo, setCopiedPromo] = useState(false);

    // Filter Category on Layanan tab
    const [selectedCategory, setSelectedCategory] = useState('all');

    // Calculator State (Tab Layanan)
    const [calcServiceId, setCalcServiceId] = useState('kiloan-kilat');
    const [calcWeight, setCalcWeight] = useState(5);
    const [calcFragrance, setCalcFragrance] = useState('Sakura Fresh');
    const [calcAntiMite, setCalcAntiMite] = useState(false);
    const [calcSpecialPackaging, setCalcSpecialPackaging] = useState(false);

    // Tracking State (Tab Status)
    const [trackingQuery, setTrackingQuery] = useState(initialSearchCode);
    const [activeTracking, setActiveTracking] = useState(initialTracking);
    const [isSearchingTrack, setIsSearchingTrack] = useState(false);

    // Booking Form State (Tab Pesan)
    const [selectedService, setSelectedService] = useState('Kiloan Reguler');
    const [selectedDateSlot, setSelectedDateSlot] = useState('Hari Ini');
    const [selectedTimeSlot, setSelectedTimeSlot] = useState('Pagi');
    const [selectedFragrance, setSelectedFragrance] = useState('Ocean Breeze');
    const [isHypoallergenic, setIsHypoallergenic] = useState(true);
    const [paymentMethod, setPaymentMethod] = useState('QRIS / E-Wallet');
    const [promoApplied, setPromoApplied] = useState(false);
    const [promoInput, setPromoInput] = useState('');

    const [bookingForm, setBookingForm] = useState({
        nama: auth?.user?.name || '',
        whatsapp: auth?.user?.phone || '',
        alamat: 'Jl. Senopati No. 42, RT 04 / RW 03, Kebayoran Baru',
        patokan: 'Pagar hitam seberang Apotek Kimia Farma',
        instruksi_kurir: 'Titip di pos security jika saya di luar',
        catatan: '',
    });

    const [isSubmitting, setIsSubmitting] = useState(false);

    // Synchronize tab if initialTab changes
    useEffect(() => {
        if (initialTab) setCurrentTab(initialTab);
    }, [initialTab]);

    // Calculate Price for Booking Form
    const servicePriceMap = {
        'Kiloan Reguler': 9000,
        'Kiloan Kilat': 15000,
        'Dry Clean Satuan': 35000,
        'Sepatu & Bag Care': 50000,
        'Bedcover King Size': 35000,
    };

    const bookingEstimatedTotal = useMemo(() => {
        const basePrice = servicePriceMap[selectedService] || 45000;
        let total = selectedService.includes('Kiloan') ? basePrice * 5 : basePrice;
        if (promoApplied) {
            total = total * 0.7; // 30% discount
        }
        return Math.round(total);
    }, [selectedService, promoApplied]);

    // Calculate Price for Layanan & Paket Tab Calculator
    const calcServiceObj = services.find((s) => s.id === calcServiceId) || services[0] || { price_per_unit: 14000, name: 'Kiloan Kilat' };
    const calcSubtotal = (calcServiceObj.price_per_unit || 14000) * calcWeight;
    const calcAddons = (calcAntiMite ? 5000 : 0) + (calcSpecialPackaging ? 7500 : 0);
    const calcDiscount = Math.round(calcSubtotal * 0.1); // 10% diskon mitra
    const calcTotal = Math.max(0, calcSubtotal + calcAddons - calcDiscount);

    // Apply promo code
    const handleApplyPromo = () => {
        if (promoInput.trim().toUpperCase() === 'BERSAMA-LCLEAN') {
            setPromoApplied(true);
        } else {
            alert('Kode promo tidak valid. Gunakan: BERSAMA-LCLEAN');
        }
    };

    const copyPromoCode = (code = 'BERSAMA-LCLEAN') => {
        navigator.clipboard.writeText(code);
        setCopiedPromo(true);
        setTimeout(() => setCopiedPromo(false), 2000);
    };

    // Switch to Booking with pre-selected service
    const selectAndBook = (serviceName) => {
        setSelectedService(serviceName);
        setCurrentTab('pesan');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Tracking Lookup
    const handleTrackSubmit = (e) => {
        e?.preventDefault();
        if (!trackingQuery.trim()) return;
        setIsSearchingTrack(true);

        setTimeout(() => {
            setIsSearchingTrack(false);
            if (trackingQuery.toUpperCase() === 'LC-77419') {
                setActiveTracking({
                    ...initialTracking,
                    order_id: 'LC-77419',
                    service_badge: 'BEDCOVER KING & DRY CLEAN',
                    client_name: 'Dewi Lestari',
                    status_label: 'Selesai & Siap Diantar',
                    progress_percentage: 100,
                    current_stage_step: 6,
                    scale_weight: '7.80 kg',
                    amount_formatted: 'Rp 115.000',
                    stepper: initialTracking.stepper.map((st) => ({ ...st, status: 'completed' })),
                });
            } else if (trackingQuery.toUpperCase() === 'LC-66023') {
                setActiveTracking({
                    ...initialTracking,
                    order_id: 'LC-66023',
                    service_badge: 'SETRIKA UAP PREMIUM 8 PCS',
                    client_name: 'Hendra Gunawan',
                    status_label: 'Sudah Selesai',
                    progress_percentage: 100,
                    current_stage_step: 6,
                    scale_weight: '3.40 kg',
                    amount_formatted: 'Rp 48.000',
                    stepper: initialTracking.stepper.map((st) => ({ ...st, status: 'completed' })),
                });
            } else {
                setActiveTracking({
                    ...initialTracking,
                    order_id: trackingQuery.toUpperCase(),
                    status_label: 'Sedang Diproses',
                });
            }
        }, 500);
    };

    // Handle Form Submit
    const handleBookingSubmit = (e) => {
        e.preventDefault();
        setIsSubmitting(true);

        const payload = {
            ...bookingForm,
            service_name: selectedService,
            jadwal_hari: selectedDateSlot,
            jadwal_jam: selectedTimeSlot,
            fragrance: selectedFragrance,
            is_hypoallergenic: isHypoallergenic,
            payment_method: paymentMethod,
            estimated_amount: bookingEstimatedTotal,
            weight_est: selectedService.includes('Kiloan') ? 'Est. 5–7 Kg' : '1–2 Pcs',
        };

        router.post(route('clean.order.store'), payload, {
            onSuccess: (page) => {
                setIsSubmitting(false);
                const newCode = 'LC-' + Math.floor(10000 + Math.random() * 90000);
                setCreatedOrderId(newCode);
                setShowSuccessModal(true);
            },
            onError: () => {
                setIsSubmitting(false);
                // Fallback success for local testing
                const newCode = 'LC-' + Math.floor(10000 + Math.random() * 90000);
                setCreatedOrderId(newCode);
                setShowSuccessModal(true);
            },
        });
    };

    return (
        <div className="min-h-screen bg-slate-50 font-sans text-slate-800 antialiased selection:bg-cyan-500 selection:text-white">
            <Head title="L-Clean Laundry - Layanan Cuci Antar Jemput Higienis IoT" />

            {/* ============================================================== */}
            {/* TOP NOTIFICATION / PROMO BAR */}
            {/* ============================================================== */}
            <div className="bg-gradient-to-r from-[#034ea2] via-[#026cb5] to-[#008db9] text-white py-2 px-4 text-xs font-medium text-center relative z-40 flex items-center justify-center gap-2 shadow-xs">
                <span className="flex h-2 w-2 relative">
                    <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span className="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                </span>
                <span>
                    ✨ <strong>Promo Diskon 30% Cuci Perdana:</strong> Gunakan kode kupon{' '}
                    <code className="bg-white/20 px-2 py-0.5 rounded font-mono font-bold tracking-wider">BERSAMA-LCLEAN</code>
                </span>
                <button
                    onClick={() => copyPromoCode('BERSAMA-LCLEAN')}
                    className="ml-2 underline hover:text-cyan-200 transition text-[11px] font-bold"
                >
                    {copiedPromo ? 'Tersalin! ✓' : 'Salin Kupon'}
                </button>
            </div>

            {/* ============================================================== */}
            {/* MAIN NAVIGATION BAR */}
            {/* ============================================================== */}
            <header className="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                    {/* Brand Logo */}
                    <div className="flex items-center gap-8">
                        <button
                            onClick={() => setCurrentTab('beranda')}
                            className="flex items-center gap-2.5 text-left group"
                        >
                            <div className="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#026cb5] via-[#008db9] to-[#00b4d8] flex items-center justify-center shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-200">
                                <Droplets className="w-6 h-6 text-white stroke-[2.5]" />
                            </div>
                            <div>
                                <div className="text-xl font-black tracking-tight text-[#034ea2] flex items-center gap-1">
                                    L-Clean <span className="text-[10px] uppercase font-bold tracking-widest text-[#008db9] bg-blue-50 px-1.5 py-0.5 rounded-md border border-blue-200/60">Laundry</span>
                                </div>
                                <div className="text-[10px] font-medium text-slate-400 tracking-wider">
                                    Smart IoT Laundry Care
                                </div>
                            </div>
                        </button>

                        {/* Navigation Links */}
                        <nav className="hidden lg:flex items-center gap-1 font-medium text-sm">
                            <button
                                onClick={() => setCurrentTab('beranda')}
                                className={`px-4 py-2 rounded-xl transition-all duration-150 ${
                                    currentTab === 'beranda'
                                        ? 'bg-blue-50 text-[#026cb5] font-bold shadow-xs'
                                        : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70'
                                }`}
                            >
                                Beranda
                            </button>
                            <button
                                onClick={() => setCurrentTab('layanan')}
                                className={`px-4 py-2 rounded-xl transition-all duration-150 ${
                                    currentTab === 'layanan'
                                        ? 'bg-blue-50 text-[#026cb5] font-bold shadow-xs'
                                        : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70'
                                }`}
                            >
                                Layanan &amp; Paket
                            </button>
                            <button
                                onClick={() => setCurrentTab('status')}
                                className={`px-4 py-2 rounded-xl transition-all duration-150 flex items-center gap-1.5 ${
                                    currentTab === 'status'
                                        ? 'bg-blue-50 text-[#026cb5] font-bold shadow-xs'
                                        : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70'
                                }`}
                            >
                                Cek Status Laundry
                                <span className="inline-flex items-center px-1.5 py-0.2 rounded-full text-[9px] font-extrabold bg-emerald-100 text-emerald-800">
                                    Live IoT
                                </span>
                            </button>
                            <button
                                onClick={() => setShowSaaSModal(true)}
                                className="px-4 py-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100/70 transition-all duration-150 flex items-center gap-1"
                            >
                                Fitur SaaS Mitra
                                <ExternalLink className="w-3.5 h-3.5 text-slate-400" />
                            </button>
                            <button
                                onClick={() => {
                                    setCurrentTab('beranda');
                                    setTimeout(() => {
                                        document.getElementById('faq-section')?.scrollIntoView({ behavior: 'smooth' });
                                    }, 100);
                                }}
                                className="px-4 py-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100/70 transition-all duration-150"
                            >
                                Tentang Kami
                            </button>
                        </nav>
                    </div>

                    {/* Right User State & CTAs */}
                    <div className="flex items-center gap-3">
                        {auth?.user ? (
                            <div className="flex items-center gap-2.5">
                                <div className="text-right hidden sm:block">
                                    <div className="text-xs font-bold text-slate-800">{auth.user.name}</div>
                                    <div className="text-[10px] text-emerald-600 font-semibold flex items-center justify-end gap-1">
                                        <UserCheck className="w-3 h-3" />
                                        {auth.isCleanAdmin ? 'Operator Clean' : 'Member Langganan'}
                                    </div>
                                </div>
                                {auth.isCleanAdmin ? (
                                    <Link
                                        href="/clean/dashboard"
                                        className="px-3 py-2 text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-xl transition"
                                    >
                                        Dashboard &rarr;
                                    </Link>
                                ) : (
                                    <Link
                                        href="/logout"
                                        method="post"
                                        as="button"
                                        className="text-xs text-slate-500 hover:text-slate-800 px-2.5 py-1.5"
                                    >
                                        Keluar
                                    </Link>
                                )}
                            </div>
                        ) : (
                            <Link
                                href="/login"
                                className="px-4 py-2 text-xs font-bold text-slate-700 hover:text-blue-700 hover:bg-slate-100 rounded-xl transition flex items-center gap-1.5"
                            >
                                <LogIn className="w-3.5 h-3.5" />
                                Masuk / Login
                            </Link>
                        )}

                        <button
                            onClick={() => {
                                setCurrentTab('pesan');
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                            }}
                            className="px-5 py-2.5 bg-gradient-to-r from-[#005a9c] to-[#008db9] hover:from-[#004e87] hover:to-[#007ba1] text-white font-bold text-xs rounded-xl shadow-md shadow-blue-600/25 transition-all duration-200 flex items-center gap-2 transform active:scale-95"
                        >
                            <Truck className="w-4 h-4" />
                            <span>Pesan Jemput Sekarang</span>
                        </button>
                    </div>
                </div>

                {/* Mobile Tab Navigation Bar */}
                <div className="lg:hidden flex items-center justify-between border-t border-slate-100 px-3 py-2 bg-slate-50 overflow-x-auto text-xs">
                    <button
                        onClick={() => setCurrentTab('beranda')}
                        className={`px-3 py-1.5 rounded-lg whitespace-nowrap font-medium ${
                            currentTab === 'beranda' ? 'bg-white text-blue-700 shadow-xs font-bold' : 'text-slate-600'
                        }`}
                    >
                        Beranda
                    </button>
                    <button
                        onClick={() => setCurrentTab('layanan')}
                        className={`px-3 py-1.5 rounded-lg whitespace-nowrap font-medium ${
                            currentTab === 'layanan' ? 'bg-white text-blue-700 shadow-xs font-bold' : 'text-slate-600'
                        }`}
                    >
                        Layanan &amp; Paket
                    </button>
                    <button
                        onClick={() => setCurrentTab('status')}
                        className={`px-3 py-1.5 rounded-lg whitespace-nowrap font-medium ${
                            currentTab === 'status' ? 'bg-white text-blue-700 shadow-xs font-bold' : 'text-slate-600'
                        }`}
                    >
                        Lacak Pesanan
                    </button>
                    <button
                        onClick={() => setCurrentTab('pesan')}
                        className={`px-3 py-1.5 rounded-lg whitespace-nowrap font-medium ${
                            currentTab === 'pesan' ? 'bg-blue-600 text-white font-bold' : 'text-slate-600'
                        }`}
                    >
                        Jadwalkan Jemput
                    </button>
                </div>
            </header>

            {/* ============================================================== */}
            {/* TAB CONTENT SWITCHER */}
            {/* ============================================================== */}
            <main>
                {/* ========================================================== */}
                {/* 1. TAB BERANDA (MATCHES PICTURE 2) */}
                {/* ========================================================== */}
                {currentTab === 'beranda' && (
                    <div className="animate-in fade-in duration-200">
                        {/* HERO SECTION */}
                        <section className="relative overflow-hidden bg-gradient-to-b from-blue-50/60 via-white to-slate-50 pt-10 pb-20">
                            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                                    {/* Left Headline */}
                                    <div className="lg:col-span-7 space-y-6">
                                        <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-100/70 border border-blue-200/60 text-[#026cb5] text-xs font-bold tracking-wide">
                                            <span className="w-2 h-2 rounded-full bg-[#026cb5] animate-pulse"></span>
                                            TEKNOLOGI HIGIENIS IOT &amp; HYPOALLERGENIC
                                        </div>

                                        <h1 className="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15]">
                                            Laundry Bersih Higienis,{' '}
                                            <span className="text-transparent bg-clip-text bg-gradient-to-r from-[#026cb5] to-[#00b4d8]">
                                                Wangi Mewah,
                                            </span>{' '}
                                            Dijemput &amp; Diantar Tepat Waktu
                                        </h1>

                                        <p className="text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl">
                                            Tidak usah repot keluar rumah saat cucian menumpuk. Kurir kami siap jemput pakaian
                                            kotor dan antar kembali dalam kondisi bersih higienis siap pakai.{' '}
                                            <span className="font-semibold text-slate-800">
                                                1 mesin 1 pelanggan, anti tertukar, ramah lingkungan.
                                            </span>
                                        </p>

                                        {/* Hero Action Buttons */}
                                        <div className="flex flex-wrap items-center gap-4 pt-2">
                                            <button
                                                onClick={() => setCurrentTab('pesan')}
                                                className="px-6 py-3.5 bg-gradient-to-r from-[#005a9c] to-[#008db9] hover:from-[#004e87] hover:to-[#007ba1] text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-600/30 transition-all duration-200 flex items-center gap-2.5 transform hover:-translate-y-0.5"
                                            >
                                                <Truck className="w-4 h-4" />
                                                <span>Pesan Antar Jemput Sekarang</span>
                                            </button>

                                            <button
                                                onClick={() => setCurrentTab('layanan')}
                                                className="px-6 py-3.5 bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm rounded-xl border border-slate-300 shadow-xs hover:border-slate-400 transition-all duration-200 flex items-center gap-2"
                                            >
                                                <span>Cek Tarif &amp; Paket Cucian</span>
                                                <ChevronRight className="w-4 h-4 text-slate-400" />
                                            </button>
                                        </div>

                                        {/* Key Stats Bar */}
                                        <div className="grid grid-cols-3 gap-6 pt-6 border-t border-slate-200/80">
                                            <div>
                                                <div className="text-2xl sm:text-3xl font-black text-slate-900">60K+</div>
                                                <div className="text-xs text-slate-500 font-medium">Pakaian Dicuci</div>
                                            </div>
                                            <div>
                                                <div className="text-2xl sm:text-3xl font-black text-[#026cb5]">3 Jam</div>
                                                <div className="text-xs text-slate-500 font-medium">Selesai Kilat</div>
                                            </div>
                                            <div>
                                                <div className="text-2xl sm:text-3xl font-black text-emerald-600">100%</div>
                                                <div className="text-xs text-slate-500 font-medium">Higienis Terjamin</div>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Right Hero Image Card */}
                                    <div className="lg:col-span-5 relative">
                                        <div className="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-900 aspect-[4/3] group">
                                            <img
                                                src="/images/clean/hero.jpg"
                                                alt="Fasilitas Laundry L-Clean Modern"
                                                className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                            />
                                            {/* Floating IoT Badge */}
                                            <div className="absolute top-4 left-4 bg-white/95 backdrop-blur-md px-3.5 py-2 rounded-2xl shadow-lg border border-slate-100 flex items-center gap-2.5">
                                                <div className="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></div>
                                                <div>
                                                    <div className="text-[11px] font-bold text-slate-900">1 Mesin 1 Pelanggan</div>
                                                    <div className="text-[9px] text-slate-500 font-medium">IoT Sensor Active #04</div>
                                                </div>
                                            </div>

                                            {/* Floating Clean Guarantee Badge */}
                                            <div className="absolute bottom-4 right-4 bg-white/95 backdrop-blur-md px-4 py-2.5 rounded-2xl shadow-lg border border-slate-100 flex items-center gap-3">
                                                <div className="w-8 h-8 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
                                                    <Sparkles className="w-4 h-4" />
                                                </div>
                                                <div className="text-left">
                                                    <div className="text-[11px] font-bold text-slate-900">Garansi Cuci Bersih</div>
                                                    <div className="text-[9px] text-emerald-600 font-semibold">100% Free Re-wash</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {/* Floating Quick Order / Tracking Bar */}
                                <div className="mt-12 bg-white rounded-2xl p-4 sm:p-5 shadow-xl border border-slate-200/80">
                                    <div className="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                                        <div className="space-y-1">
                                            <label className="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                                Pantau Cucian / Pesan Cepat
                                            </label>
                                            <div className="flex items-center gap-2 px-3 py-2 bg-slate-50 rounded-xl border border-slate-200">
                                                <Phone className="w-4 h-4 text-slate-400" />
                                                <input
                                                    type="text"
                                                    placeholder="No. WhatsApp / HP"
                                                    className="w-full text-xs font-medium bg-transparent border-none focus:outline-hidden text-slate-800"
                                                    defaultValue="0812-9908-7788"
                                                />
                                            </div>
                                        </div>

                                        <div className="space-y-1">
                                            <label className="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                                Lokasi Penjemputan
                                            </label>
                                            <div className="flex items-center gap-2 px-3 py-2 bg-slate-50 rounded-xl border border-slate-200">
                                                <MapPin className="w-4 h-4 text-slate-400" />
                                                <input
                                                    type="text"
                                                    placeholder="Alamat / Kota"
                                                    className="w-full text-xs font-medium bg-transparent border-none focus:outline-hidden text-slate-800"
                                                    defaultValue="Kebayoran Baru, Jakarta Selatan"
                                                />
                                            </div>
                                        </div>

                                        <div className="space-y-1">
                                            <label className="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                                Pilihan Layanan
                                            </label>
                                            <div className="flex items-center gap-2 px-3 py-2 bg-slate-50 rounded-xl border border-slate-200">
                                                <Shirt className="w-4 h-4 text-slate-400" />
                                                <select
                                                    className="w-full text-xs font-medium bg-transparent border-none focus:outline-hidden text-slate-800"
                                                    value={selectedService}
                                                    onChange={(e) => setSelectedService(e.target.value)}
                                                >
                                                    <option value="Kiloan Reguler">Cuci Kiloan Reguler (Rp 9.000/kg)</option>
                                                    <option value="Kiloan Kilat">Kiloan Kilat 24 Jam (Rp 15.000/kg)</option>
                                                    <option value="Dry Clean Satuan">Dry Clean &amp; Jas (Rp 35.000/pcs)</option>
                                                    <option value="Sepatu & Bag Care">Sepatu &amp; Tas (Rp 50.000)</option>
                                                    <option value="Bedcover King Size">Bedcover King (Rp 35.000)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div className="pt-3 md:pt-0">
                                            <button
                                                onClick={() => setCurrentTab('pesan')}
                                                className="w-full py-3 bg-[#026cb5] hover:bg-[#005a9c] text-white font-bold text-xs rounded-xl shadow-md transition flex items-center justify-center gap-2"
                                            >
                                                <span>Pesan Sekarang &rarr;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {/* SECTION: MENGAPA MEMILIH L-CLEAN */}
                        <section className="py-16 bg-white border-y border-slate-200/60">
                            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div className="text-center max-w-3xl mx-auto space-y-3 mb-12">
                                    <div className="text-xs font-bold uppercase tracking-widest text-[#026cb5]">
                                        Standar Kualitas Hotel Bintang 5
                                    </div>
                                    <h2 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                                        Mengapa Ribuan Keluarga Memilih L-Clean?
                                    </h2>
                                    <p className="text-slate-600 text-sm">
                                        Kami menghadirkan standar pencucian kelas komersial dengan sentuhan kenyamanan layanan antar jemput.
                                    </p>
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                    {/* Card 1 */}
                                    <div className="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-blue-300 hover:shadow-lg transition-all duration-200 space-y-4">
                                        <div className="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center shadow-xs">
                                            <Layers className="w-6 h-6" />
                                        </div>
                                        <h3 className="text-base font-bold text-slate-900">1 Mesin 1 Pelanggan</h3>
                                        <p className="text-xs text-slate-600 leading-relaxed">
                                            Pakaian Anda tidak pernah dicampur dengan cucian orang lain. Privasi terjaga,
                                            higienis, dan 100% anti tertukar.
                                        </p>
                                    </div>

                                    {/* Card 2 */}
                                    <div className="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-blue-300 hover:shadow-lg transition-all duration-200 space-y-4">
                                        <div className="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shadow-xs">
                                            <ShieldCheck className="w-6 h-6" />
                                        </div>
                                        <h3 className="text-base font-bold text-slate-900">Detergen Ramah Lingkungan</h3>
                                        <p className="text-xs text-slate-600 leading-relaxed">
                                            Formula biodegradable bebas bahan kimia keras. Sangat aman untuk kulit bayi sensitif dan
                                            memperpanjang umur serat pakaian.
                                        </p>
                                    </div>

                                    {/* Card 3 */}
                                    <div className="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-blue-300 hover:shadow-lg transition-all duration-200 space-y-4">
                                        <div className="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center shadow-xs">
                                            <Award className="w-6 h-6" />
                                        </div>
                                        <h3 className="text-base font-bold text-slate-900">Penimbangan Transparan IoT</h3>
                                        <p className="text-xs text-slate-600 leading-relaxed">
                                            Timbangan digital terkalibrasi otomatis terhubung ke sistem cloud. Berat pakaian tercatat riil
                                            tanpa pembulatan sepihak.
                                        </p>
                                    </div>

                                    {/* Card 4 */}
                                    <div className="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-blue-300 hover:shadow-lg transition-all duration-200 space-y-4">
                                        <div className="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center shadow-xs">
                                            <Clock className="w-6 h-6" />
                                        </div>
                                        <h3 className="text-base font-bold text-slate-900">Tracking Digital Real-Time</h3>
                                        <p className="text-xs text-slate-600 leading-relaxed">
                                            Pantau setiap tahapan cucian mulai dari jemput, cuci, setrika hingga kurir mengantar
                                            kembali ke rumah Anda secara live.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {/* SPECIAL PROMO BANNER */}
                        <section className="py-10 bg-slate-50">
                            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div className="rounded-3xl bg-gradient-to-r from-[#024a80] via-[#026cb5] to-[#008db9] p-8 sm:p-10 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
                                    <div className="space-y-2 max-w-xl text-center md:text-left">
                                        <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 text-xs font-bold tracking-wide">
                                            <Tag className="w-3.5 h-3.5" />
                                            Kupon Spesial Pengguna Baru
                                        </div>
                                        <h3 className="text-2xl sm:text-3xl font-black">
                                            Diskon 30% Cuci Perdana Anda!
                                        </h3>
                                        <p className="text-xs sm:text-sm text-blue-100 leading-relaxed">
                                            Rasakan sensasi pakaian bersih wangi mewah hotel berbintang dengan potongan harga khusus order pertama.
                                        </p>
                                    </div>

                                    <div className="flex flex-col sm:flex-row items-center gap-3">
                                        <div className="bg-white/10 backdrop-blur-md px-5 py-3 rounded-2xl border border-white/30 font-mono text-base font-bold tracking-widest">
                                            BERSAMA-LCLEAN
                                        </div>
                                        <button
                                            onClick={() => copyPromoCode('BERSAMA-LCLEAN')}
                                            className="px-6 py-3.5 bg-white text-[#026cb5] hover:bg-blue-50 font-bold text-xs rounded-2xl shadow-lg transition"
                                        >
                                            {copiedPromo ? 'Kode Disalin! ✓' : 'Salin Kupon'}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {/* SECTION: PILIHAN LAYANAN TERFAVORIT */}
                        <section className="py-16 bg-white">
                            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div className="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
                                    <div>
                                        <div className="text-xs font-bold uppercase tracking-widest text-[#026cb5]">
                                            Paket Laundry Pilihan
                                        </div>
                                        <h2 className="text-3xl font-black text-slate-900 tracking-tight">
                                            Pilihan Layanan Terfavorit
                                        </h2>
                                    </div>
                                    <button
                                        onClick={() => setCurrentTab('layanan')}
                                        className="text-xs font-bold text-blue-700 hover:underline flex items-center gap-1"
                                    >
                                        Lihat Semua 7 Layanan &amp; Paket Harga &rarr;
                                    </button>
                                </div>

                                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                    {/* Service 1 */}
                                    <div className="rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-200 flex flex-col group bg-white">
                                        <div className="h-44 overflow-hidden relative">
                                            <img
                                                src="/images/clean/kiloan.jpg"
                                                alt="Cuci Kiloan Reguler"
                                                className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            />
                                            <span className="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-lg shadow-sm uppercase">
                                                Kiloan
                                            </span>
                                        </div>
                                        <div className="p-5 flex-1 flex flex-col justify-between space-y-4">
                                            <div>
                                                <h4 className="text-base font-bold text-slate-900">Cuci Komplit Kiloan</h4>
                                                <p className="text-xs text-slate-500 mt-1">
                                                    Cuci basah, pengeringan higienis, setrika uap rapi, dan dilipat harum.
                                                </p>
                                            </div>
                                            <div className="flex items-center justify-between pt-2 border-t border-slate-100">
                                                <div>
                                                    <span className="text-base font-black text-[#026cb5]">Rp 9.000</span>
                                                    <span className="text-[10px] text-slate-400 font-medium"> /kg</span>
                                                </div>
                                                <button
                                                    onClick={() => selectAndBook('Kiloan Reguler')}
                                                    className="px-3 py-1.5 bg-blue-50 hover:bg-blue-600 hover:text-white text-blue-700 text-xs font-bold rounded-xl transition"
                                                >
                                                    Pilih Layanan
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Service 2 */}
                                    <div className="rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-200 flex flex-col group bg-white">
                                        <div className="h-44 overflow-hidden relative">
                                            <img
                                                src="/images/clean/dryclean.jpg"
                                                alt="Dry Clean Satuan"
                                                className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            />
                                            <span className="absolute top-3 left-3 bg-indigo-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-lg shadow-sm uppercase">
                                                Dry Clean
                                            </span>
                                        </div>
                                        <div className="p-5 flex-1 flex flex-col justify-between space-y-4">
                                            <div>
                                                <h4 className="text-base font-bold text-slate-900">Dry Clean Satuan</h4>
                                                <p className="text-xs text-slate-500 mt-1">
                                                    Jas kantor, dress pesta, kebaya &amp; batik sutra dengan solvent eco-soft.
                                                </p>
                                            </div>
                                            <div className="flex items-center justify-between pt-2 border-t border-slate-100">
                                                <div>
                                                    <span className="text-base font-black text-[#026cb5]">Rp 35.000</span>
                                                    <span className="text-[10px] text-slate-400 font-medium"> /pcs</span>
                                                </div>
                                                <button
                                                    onClick={() => selectAndBook('Dry Clean Satuan')}
                                                    className="px-3 py-1.5 bg-blue-50 hover:bg-blue-600 hover:text-white text-blue-700 text-xs font-bold rounded-xl transition"
                                                >
                                                    Pilih Layanan
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Service 3 */}
                                    <div className="rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-200 flex flex-col group bg-white">
                                        <div className="h-44 overflow-hidden relative">
                                            <img
                                                src="/images/clean/bedcover.jpg"
                                                alt="Bedcover & Karpet"
                                                className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            />
                                            <span className="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-lg shadow-sm uppercase">
                                                Bedding
                                            </span>
                                        </div>
                                        <div className="p-5 flex-1 flex flex-col justify-between space-y-4">
                                            <div>
                                                <h4 className="text-base font-bold text-slate-900">Bedcover &amp; Karpet</h4>
                                                <p className="text-xs text-slate-500 mt-1">
                                                    Ekstraksi debu tungau tabung besar, sanitasi panas optimal 60°C.
                                                </p>
                                            </div>
                                            <div className="flex items-center justify-between pt-2 border-t border-slate-100">
                                                <div>
                                                    <span className="text-base font-black text-[#026cb5]">Rp 35.000</span>
                                                    <span className="text-[10px] text-slate-400 font-medium"> /pcs</span>
                                                </div>
                                                <button
                                                    onClick={() => selectAndBook('Bedcover King Size')}
                                                    className="px-3 py-1.5 bg-blue-50 hover:bg-blue-600 hover:text-white text-blue-700 text-xs font-bold rounded-xl transition"
                                                >
                                                    Pilih Layanan
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Service 4 */}
                                    <div className="rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-200 flex flex-col group bg-white">
                                        <div className="h-44 overflow-hidden relative">
                                            <img
                                                src="/images/clean/shoes.jpg"
                                                alt="Sepatu & Bag Care"
                                                className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            />
                                            <span className="absolute top-3 left-3 bg-teal-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-lg shadow-sm uppercase">
                                                Special Care
                                            </span>
                                        </div>
                                        <div className="p-5 flex-1 flex flex-col justify-between space-y-4">
                                            <div>
                                                <h4 className="text-base font-bold text-slate-900">Sepatu &amp; Bag Care</h4>
                                                <p className="text-xs text-slate-500 mt-1">
                                                    Deep clean midsole, unyellowing sepatu, dan restorasi tas kulit kesayangan.
                                                </p>
                                            </div>
                                            <div className="flex items-center justify-between pt-2 border-t border-slate-100">
                                                <div>
                                                    <span className="text-base font-black text-[#026cb5]">Rp 50.000</span>
                                                    <span className="text-[10px] text-slate-400 font-medium"> /pasang</span>
                                                </div>
                                                <button
                                                    onClick={() => selectAndBook('Sepatu & Bag Care')}
                                                    className="px-3 py-1.5 bg-blue-50 hover:bg-blue-600 hover:text-white text-blue-700 text-xs font-bold rounded-xl transition"
                                                >
                                                    Pilih Layanan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {/* SECTION: 4 LANGKAH MUDAH */}
                        <section className="py-16 bg-slate-50 border-t border-slate-200/80">
                            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div className="text-center max-w-2xl mx-auto space-y-2 mb-12">
                                    <div className="text-xs font-bold uppercase tracking-widest text-[#026cb5]">
                                        Alur Praktis Tanpa Repot
                                    </div>
                                    <h2 className="text-3xl font-black text-slate-900 tracking-tight">
                                        4 Langkah Mudah Menuju Pakaian Bersih
                                    </h2>
                                </div>

                                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative">
                                    <div className="text-center space-y-3">
                                        <div className="w-12 h-12 rounded-full bg-[#026cb5] text-white flex items-center justify-center font-bold text-lg mx-auto shadow-md shadow-blue-500/20">
                                            1
                                        </div>
                                        <h4 className="text-sm font-bold text-slate-900">Pesan Online / WA</h4>
                                        <p className="text-xs text-slate-500 leading-relaxed">
                                            Tentukan alamat penjemputan dan pilih paket cucian via website atau chat CS.
                                        </p>
                                    </div>

                                    <div className="text-center space-y-3">
                                        <div className="w-12 h-12 rounded-full bg-cyan-600 text-white flex items-center justify-center font-bold text-lg mx-auto shadow-md shadow-cyan-500/20">
                                            2
                                        </div>
                                        <h4 className="text-sm font-bold text-slate-900">Kurir Menjemput</h4>
                                        <p className="text-xs text-slate-500 leading-relaxed">
                                            Kurir resmi berseragam menimbang pakaian di tempat dengan timbangan digital transparan.
                                        </p>
                                    </div>

                                    <div className="text-center space-y-3">
                                        <div className="w-12 h-12 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-lg mx-auto shadow-md shadow-emerald-500/20">
                                            3
                                        </div>
                                        <h4 className="text-sm font-bold text-slate-900">Cuci &amp; Kontrol Kualitas</h4>
                                        <p className="text-xs text-slate-500 leading-relaxed">
                                            Diproses higienis 1 mesin 1 pelanggan dengan detergen eco &amp; uap antibakteri.
                                        </p>
                                    </div>

                                    <div className="text-center space-y-3">
                                        <div className="w-12 h-12 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold text-lg mx-auto shadow-md shadow-purple-500/20">
                                            4
                                        </div>
                                        <h4 className="text-sm font-bold text-slate-900">Diantar Rapi &amp; Wangi</h4>
                                        <p className="text-xs text-slate-500 leading-relaxed">
                                            Pakaian diantar kembali dalam kemasan segel kedap udara, wangi mewah siap masuk lemari.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {/* SECTION: TESTIMONIALS */}
                        <section className="py-16 bg-white border-t border-slate-200">
                            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div className="text-center max-w-2xl mx-auto space-y-2 mb-12">
                                    <div className="text-xs font-bold uppercase tracking-widest text-[#026cb5]">
                                        Ulasan Pelanggan Setia
                                    </div>
                                    <h2 className="text-3xl font-black text-slate-900 tracking-tight">
                                        Apa Kata Mereka Tentang L-Clean?
                                    </h2>
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div className="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                                        <div className="flex text-amber-400">
                                            {[...Array(5)].map((_, i) => (
                                                <Star key={i} className="w-4 h-4 fill-amber-400 text-amber-400" />
                                            ))}
                                        </div>
                                        <p className="text-xs text-slate-600 italic leading-relaxed">
                                            "Sangat puas! Kurirnya tepat waktu dan pakaian diantar dalam kemasan rapi berlabel nama.
                                            Paling suka wanginya awet banget meski sudah disimpan berminggu-minggu di lemari."
                                        </p>
                                        <div className="pt-2 border-t border-slate-200/60 flex items-center gap-3">
                                            <div className="w-9 h-9 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-xs">
                                                NR
                                            </div>
                                            <div>
                                                <div className="text-xs font-bold text-slate-900">Nadila Rahma</div>
                                                <div className="text-[10px] text-slate-500">Ibu Rumah Tangga, Jaksel</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                                        <div className="flex text-amber-400">
                                            {[...Array(5)].map((_, i) => (
                                                <Star key={i} className="w-4 h-4 fill-amber-400 text-amber-400" />
                                            ))}
                                        </div>
                                        <p className="text-xs text-slate-600 italic leading-relaxed">
                                            "Fitur tracking live-nya luar biasa transparan! Berat cucian langsung masuk ke dashboard
                                            lengkap dengan foto timbangan digitalnya. Nggak ada istilah mark up timbangan."
                                        </p>
                                        <div className="pt-2 border-t border-slate-200/60 flex items-center gap-3">
                                            <div className="w-9 h-9 rounded-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center text-xs">
                                                RP
                                            </div>
                                            <div>
                                                <div className="text-xs font-bold text-slate-900">Reza Pratama</div>
                                                <div className="text-[10px] text-slate-500">Founder Startup &amp; Konsultan</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                                        <div className="flex text-amber-400">
                                            {[...Array(5)].map((_, i) => (
                                                <Star key={i} className="w-4 h-4 fill-amber-400 text-amber-400" />
                                            ))}
                                        </div>
                                        <p className="text-xs text-slate-600 italic leading-relaxed">
                                            "Dry clean jas dan gaun pesta di L-Clean bener-bener terawat. Payet tidak ada yang rusak,
                                            dan bahan sutra tetap halus jatuh sempurna. Langganan setia keluarga kami!"
                                        </p>
                                        <div className="pt-2 border-t border-slate-200/60 flex items-center gap-3">
                                            <div className="w-9 h-9 rounded-full bg-purple-100 text-purple-700 font-bold flex items-center justify-center text-xs">
                                                RW
                                            </div>
                                            <div>
                                                <div className="text-xs font-bold text-slate-900">Riany Wulandari</div>
                                                <div className="text-[10px] text-slate-500">Fashion Designer, Jakarta</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {/* SECTION: FAQ */}
                        <section id="faq-section" className="py-16 bg-slate-50 border-t border-slate-200">
                            <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
                                <div className="text-center space-y-2 mb-8">
                                    <div className="text-xs font-bold uppercase tracking-widest text-[#026cb5]">
                                        Tanya Jawab Populer
                                    </div>
                                    <h2 className="text-3xl font-black text-slate-900 tracking-tight">
                                        Pertanyaan yang Sering Diajukan (FAQ)
                                    </h2>
                                </div>

                                <div className="space-y-3">
                                    <details className="p-4 rounded-xl bg-white border border-slate-200 group">
                                        <summary className="font-bold text-xs sm:text-sm text-slate-900 cursor-pointer list-none flex items-center justify-between">
                                            <span>Apakah pakaian saya akan dicampur dengan pelanggan lain?</span>
                                            <ChevronDown className="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform" />
                                        </summary>
                                        <p className="text-xs text-slate-600 mt-3 pt-3 border-t border-slate-100 leading-relaxed">
                                            <strong>Sama sekali tidak.</strong> Kebijakan higienis L-Clean mewajibkan 1 mesin 1 pelanggan.
                                            Pakaian Anda dicuci dalam drum terpisah dengan segel tag barcode digital khusus.
                                        </p>
                                    </details>

                                    <details className="p-4 rounded-xl bg-white border border-slate-200 group">
                                        <summary className="font-bold text-xs sm:text-sm text-slate-900 cursor-pointer list-none flex items-center justify-between">
                                            <span>Berapa lama estimasi proses pengerjaan layanan express?</span>
                                            <ChevronDown className="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform" />
                                        </summary>
                                        <p className="text-xs text-slate-600 mt-3 pt-3 border-t border-slate-100 leading-relaxed">
                                            Untuk paket Kiloan Kilat selesai dalam 6–8 jam di hari yang sama. Untuk paket Super Express
                                            hanya membutuhkan waktu 3 jam pengerjaan hingga siap diantar kembali.
                                        </p>
                                    </details>

                                    <details className="p-4 rounded-xl bg-white border border-slate-200 group">
                                        <summary className="font-bold text-xs sm:text-sm text-slate-900 cursor-pointer list-none flex items-center justify-between">
                                            <span>Bagaimana sistem antar-jemput gratis dihitung?</span>
                                            <ChevronDown className="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform" />
                                        </summary>
                                        <p className="text-xs text-slate-600 mt-3 pt-3 border-t border-slate-100 leading-relaxed">
                                            Kami menyediakan <strong>Gratis Ongkir Antar-Jemput</strong> dalam radius hingga 5 KM dari outlet
                                            L-Clean terdekat dengan minimal pesanan 5 kg (atau minimal pembelanjaan Rp 40.000).
                                        </p>
                                    </details>

                                    <details className="p-4 rounded-xl bg-white border border-slate-200 group">
                                        <summary className="font-bold text-xs sm:text-sm text-slate-900 cursor-pointer list-none flex items-center justify-between">
                                            <span>Metode pembayaran apa saja yang diterima?</span>
                                            <ChevronDown className="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform" />
                                        </summary>
                                        <p className="text-xs text-slate-600 mt-3 pt-3 border-t border-slate-100 leading-relaxed">
                                            Kami menerima QRIS (BCA, Mandiri, GoPay, OVO, ShopeePay), Transfer Virtual Account,
                                            maupun pembayaran tunai langsung ke kurir (COD) saat penjemputan atau setelah pakaian siap diantar.
                                        </p>
                                    </details>
                                </div>
                            </div>
                        </section>
                    </div>
                )}

                {/* ========================================================== */}
                {/* 2. TAB LAYANAN & PAKET (MATCHES PICTURE 4) */}
                {/* ========================================================== */}
                {currentTab === 'layanan' && (
                    <div className="py-10 animate-in fade-in duration-200 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {/* Header Title */}
                        <div className="space-y-2 mb-8">
                            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#026cb5] text-xs font-bold">
                                <span className="w-2 h-2 rounded-full bg-[#026cb5]"></span>
                                Transparansi Biaya 100% Real-Time
                            </div>
                            <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div>
                                    <h1 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                                        Pilihan Layanan Laundry &amp; Estimasi Biaya Transparan
                                    </h1>
                                    <p className="text-slate-600 text-sm mt-1">
                                        Tanpa biaya tersembunyi. Timbang akurat dengan timbangan digital terhubung cloud dan perlindungan higienis bertaraf komersial.
                                    </p>
                                </div>
                                <div className="flex items-center gap-3">
                                    <div className="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 flex items-center gap-2 shadow-xs">
                                        <ShieldCheck className="w-4 h-4 text-emerald-600" />
                                        <span>ISO 9001 Standar Higienis</span>
                                    </div>
                                    <div className="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 flex items-center gap-2 shadow-xs">
                                        <Award className="w-4 h-4 text-blue-600" />
                                        <span>IoT Cloud Presisi Gramatur</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Category Filter Tabs */}
                        <div className="flex items-center gap-2 overflow-x-auto pb-4 border-b border-slate-200 mb-8 text-xs font-bold">
                            {[
                                { id: 'all', label: 'Semua Layanan' },
                                { id: 'kiloan', label: 'Laundry Kiloan' },
                                { id: 'dryclean', label: 'Dry Clean & Satuan' },
                                { id: 'sepatu', label: 'Sepatu & Tas' },
                                { id: 'bedding', label: 'Rumah Tangga & Bedding' },
                            ].map((cat) => (
                                <button
                                    key={cat.id}
                                    onClick={() => setSelectedCategory(cat.id)}
                                    className={`px-4 py-2 rounded-xl whitespace-nowrap transition-all duration-150 ${
                                        selectedCategory === cat.id
                                            ? 'bg-[#026cb5] text-white shadow-md shadow-blue-500/20'
                                            : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'
                                    }`}
                                >
                                    {cat.label}
                                </button>
                            ))}
                        </div>

                        {/* Main Grid: Catalog List (Left 7 Cols) + Calculator (Right 5 Cols) */}
                        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                            {/* Left Side: Services Catalog Cards */}
                            <div className="lg:col-span-7 space-y-4">
                                {services
                                    .filter((s) => selectedCategory === 'all' || s.category === selectedCategory)
                                    .map((item) => (
                                        <div
                                            key={item.id}
                                            className={`p-5 rounded-2xl border transition-all duration-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 ${
                                                calcServiceId === item.id
                                                    ? 'bg-blue-50/60 border-blue-400 shadow-md ring-2 ring-blue-400/20'
                                                    : 'bg-white border-slate-200 hover:border-blue-200 hover:shadow-md'
                                            }`}
                                        >
                                            <div className="space-y-1.5 flex-1">
                                                <div className="flex items-center gap-2">
                                                    <span className="text-xs font-bold text-slate-900">{item.name}</span>
                                                    {item.badge && (
                                                        <span
                                                            className={`text-[9px] font-extrabold uppercase px-2 py-0.5 rounded-md ${
                                                                item.popular
                                                                    ? 'bg-amber-100 text-amber-800'
                                                                    : 'bg-slate-100 text-slate-700'
                                                            }`}
                                                        >
                                                            {item.badge}
                                                        </span>
                                                    )}
                                                    <span className="text-[10px] text-slate-400 font-medium">• {item.estimate}</span>
                                                </div>
                                                <ul className="text-[11px] text-slate-500 space-y-0.5">
                                                    {item.features?.map((f, idx) => (
                                                        <li key={idx} className="flex items-center gap-1.5">
                                                            <CheckCircle2 className="w-3 h-3 text-emerald-600 shrink-0" />
                                                            <span>{f}</span>
                                                        </li>
                                                    ))}
                                                </ul>
                                            </div>

                                            <div className="text-right sm:text-right w-full sm:w-auto flex sm:flex-col justify-between items-center sm:items-end pt-3 sm:pt-0 border-t sm:border-t-0 border-slate-100">
                                                <div>
                                                    <span className="text-base font-black text-[#026cb5]">{item.price_formatted}</span>
                                                    <span className="text-[10px] text-slate-400"> {item.unit}</span>
                                                </div>
                                                <button
                                                    onClick={() => setCalcServiceId(item.id)}
                                                    className="mt-1 px-3 py-1.5 bg-[#026cb5] hover:bg-[#005a9c] text-white text-[11px] font-bold rounded-xl shadow-xs transition flex items-center gap-1"
                                                >
                                                    <span>Hitung</span>
                                                    <ArrowRight className="w-3 h-3" />
                                                </button>
                                            </div>
                                        </div>
                                    ))}

                                {/* Radius 5 KM Free Delivery Banner */}
                                <div className="p-4 rounded-2xl bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-950 flex items-center justify-between gap-4">
                                    <div className="flex items-center gap-3">
                                        <div className="w-9 h-9 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold">
                                            <Truck className="w-5 h-5" />
                                        </div>
                                        <div>
                                            <div className="text-xs font-bold">Gratis Antar-Jemput Radius 5 KM</div>
                                            <div className="text-[10px] text-emerald-700">
                                                Minimal order 5 kg atau Rp 40.000 untuk wilayah Jakarta &amp; Tangerang
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        onClick={() => setCurrentTab('pesan')}
                                        className="px-3 py-1.5 text-xs font-bold text-emerald-800 bg-emerald-200 hover:bg-emerald-300 rounded-lg transition whitespace-nowrap"
                                    >
                                        Cek Jangkauan
                                    </button>
                                </div>
                            </div>

                            {/* Right Side: Kalkulator Estimasi Card */}
                            <div className="lg:col-span-5 sticky top-28 space-y-4">
                                <div className="p-6 rounded-3xl bg-white border border-slate-200 shadow-xl space-y-5">
                                    <div className="flex items-center justify-between border-b border-slate-100 pb-4">
                                        <div className="flex items-center gap-2">
                                            <Sliders className="w-5 h-5 text-[#026cb5]" />
                                            <h3 className="text-base font-black text-slate-900">Kalkulator Estimasi</h3>
                                        </div>
                                        <span className="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold flex items-center gap-1">
                                            <Percent className="w-3 h-3" /> Diskon 10%
                                        </span>
                                    </div>

                                    {/* Select Service Dropdown */}
                                    <div className="space-y-1.5">
                                        <label className="text-xs font-bold text-slate-700">Tipe Layanan</label>
                                        <select
                                            value={calcServiceId}
                                            onChange={(e) => setCalcServiceId(e.target.value)}
                                            className="w-full text-xs font-semibold rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 bg-slate-50 p-2.5"
                                        >
                                            {services.map((s) => (
                                                <option key={s.id} value={s.id}>
                                                    {s.name} ({s.price_formatted} {s.unit})
                                                </option>
                                            ))}
                                        </select>
                                    </div>

                                    {/* Weight / Quantity Slider */}
                                    <div className="space-y-2">
                                        <div className="flex justify-between items-center text-xs">
                                            <span className="font-bold text-slate-700">
                                                {calcServiceObj.unit === '/ pcs' ? 'Jumlah Potong' : 'Volume / Berat'}
                                            </span>
                                            <span className="text-base font-black text-[#026cb5]">
                                                {calcWeight} {calcServiceObj.unit === '/ pcs' ? 'Pcs' : 'Kg'}
                                            </span>
                                        </div>
                                        <input
                                            type="range"
                                            min="1"
                                            max="20"
                                            value={calcWeight}
                                            onChange={(e) => setCalcWeight(parseInt(e.target.value))}
                                            className="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-[#026cb5]"
                                        />
                                        <div className="flex justify-between text-[10px] text-slate-400">
                                            <span>1 kg</span>
                                            <span>10 kg</span>
                                            <span>20 kg</span>
                                        </div>
                                    </div>

                                    {/* Fragrance Options */}
                                    <div className="space-y-1.5">
                                        <label className="text-xs font-bold text-slate-700">Parfum Premium &amp; Sanitizer</label>
                                        <div className="grid grid-cols-2 gap-2 text-xs">
                                            <button
                                                type="button"
                                                onClick={() => setCalcFragrance('Sakura Fresh')}
                                                className={`p-2.5 rounded-xl border text-left transition ${
                                                    calcFragrance === 'Sakura Fresh'
                                                        ? 'border-blue-500 bg-blue-50/70 text-blue-900 font-bold'
                                                        : 'border-slate-200 hover:border-slate-300'
                                                }`}
                                            >
                                                <div className="flex items-center gap-1.5">
                                                    <span className="w-2 h-2 rounded-full bg-pink-400"></span>
                                                    <span>Sakura Fresh</span>
                                                </div>
                                                <div className="text-[10px] text-slate-400 font-normal mt-0.5">Aroma floral Jepang</div>
                                            </button>

                                            <button
                                                type="button"
                                                onClick={() => setCalcFragrance('Ocean Breeze')}
                                                className={`p-2.5 rounded-xl border text-left transition ${
                                                    calcFragrance === 'Ocean Breeze'
                                                        ? 'border-blue-500 bg-blue-50/70 text-blue-900 font-bold'
                                                        : 'border-slate-200 hover:border-slate-300'
                                                }`}
                                            >
                                                <div className="flex items-center gap-1.5">
                                                    <span className="w-2 h-2 rounded-full bg-cyan-400"></span>
                                                    <span>Ocean Breeze</span>
                                                </div>
                                                <div className="text-[10px] text-slate-400 font-normal mt-0.5">Kesegaran laut maskulin</div>
                                            </button>
                                        </div>
                                    </div>

                                    {/* Addons Checklist */}
                                    <div className="space-y-2 pt-2 border-t border-slate-100 text-xs">
                                        <label className="flex items-center justify-between cursor-pointer">
                                            <div className="flex items-center gap-2">
                                                <input
                                                    type="checkbox"
                                                    checked={calcAntiMite}
                                                    onChange={(e) => setCalcAntiMite(e.target.checked)}
                                                    className="rounded-sm border-slate-300 text-blue-600 focus:ring-blue-500"
                                                />
                                                <span className="text-slate-700">Extra Anti-Mite Mist (Anti Tungau)</span>
                                            </div>
                                            <span className="text-slate-500 font-semibold">+Rp 5.000</span>
                                        </label>

                                        <label className="flex items-center justify-between cursor-pointer">
                                            <div className="flex items-center gap-2">
                                                <input
                                                    type="checkbox"
                                                    checked={calcSpecialPackaging}
                                                    onChange={(e) => setCalcSpecialPackaging(e.target.checked)}
                                                    className="rounded-sm border-slate-300 text-blue-600 focus:ring-blue-500"
                                                />
                                                <span className="text-slate-700">Packaging Hanger Khusus (Jas/Gaun)</span>
                                            </div>
                                            <span className="text-slate-500 font-semibold">+Rp 7.500</span>
                                        </label>
                                    </div>

                                    {/* Price Breakdown Calculation */}
                                    <div className="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2 text-xs">
                                        <div className="flex justify-between text-slate-600">
                                            <span>Subtotal Layanan ({calcWeight} {calcServiceObj.unit === '/ pcs' ? 'Pcs' : 'Kg'})</span>
                                            <span className="font-semibold">Rp {calcSubtotal.toLocaleString('id-ID')}</span>
                                        </div>
                                        {calcAddons > 0 && (
                                            <div className="flex justify-between text-slate-600">
                                                <span>Tambahan Opsional</span>
                                                <span className="font-semibold">+Rp {calcAddons.toLocaleString('id-ID')}</span>
                                            </div>
                                        )}
                                        <div className="flex justify-between text-emerald-600">
                                            <span>Diskon Mitra Pertama (10%)</span>
                                            <span className="font-semibold">-Rp {calcDiscount.toLocaleString('id-ID')}</span>
                                        </div>
                                        <div className="pt-2 border-t border-slate-200 flex justify-between items-baseline">
                                            <div>
                                                <div className="text-[10px] uppercase font-bold text-slate-400">Pembayaran Total Bersih</div>
                                                <div className="text-[9px] text-slate-400">Sudah Termasuk Pajak &amp; Ongkir</div>
                                            </div>
                                            <div className="text-xl font-black text-[#026cb5]">
                                                Rp {calcTotal.toLocaleString('id-ID')}
                                            </div>
                                        </div>
                                    </div>

                                    {/* Action to Book Button */}
                                    <button
                                        onClick={() => selectAndBook(calcServiceObj.name)}
                                        className="w-full py-3.5 bg-gradient-to-r from-[#005a9c] to-[#008db9] hover:from-[#004e87] hover:to-[#007ba1] text-white font-bold text-xs rounded-xl shadow-lg transition flex items-center justify-center gap-2"
                                    >
                                        <Calendar className="w-4 h-4" />
                                        <span>Jadwalkan Penjemputan Paket Ini &rarr;</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {/* GARANSI KEPUASAN PELANGGAN SECTION */}
                        <div className="mt-16 pt-12 border-t border-slate-200">
                            <div className="text-center max-w-xl mx-auto space-y-2 mb-8">
                                <div className="text-xs font-bold uppercase tracking-widest text-[#026cb5]">
                                    Standar Jaminan Mutu L-Clean
                                </div>
                                <h3 className="text-2xl font-black text-slate-900">
                                    Garansi Kepuasan Pelanggan 100%
                                </h3>
                                <p className="text-xs text-slate-500">
                                    Pakaian adalah aset penampilan Anda. Kami menjaga setiap helai dengan komitmen garansi tertulis.
                                </p>
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div className="p-5 rounded-2xl bg-white border border-slate-200 space-y-3">
                                    <div className="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                                        <RefreshCw className="w-5 h-5" />
                                    </div>
                                    <h4 className="text-sm font-bold text-slate-900">Garansi Cuci Ulang Gratis</h4>
                                    <p className="text-xs text-slate-600 leading-relaxed">
                                        Merasa pakaian belum wangi maksimal atau masih berkerut? Kami jemput dan cuci ulang secara
                                        gratis dalam 1x24 jam sejak paket diterima.
                                    </p>
                                </div>

                                <div className="p-5 rounded-2xl bg-white border border-slate-200 space-y-3">
                                    <div className="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
                                        <ShieldCheck className="w-5 h-5" />
                                    </div>
                                    <h4 className="text-sm font-bold text-slate-900">Ganti Rugi Kehilangan &amp; Rusak</h4>
                                    <p className="text-xs text-slate-600 leading-relaxed">
                                        Setiap batch terekam CCTV tracking packing. Jika ada kehilangan atau kerusakan serat pakaian
                                        akibat kelalaian teknis, kami ganti hingga 10x biaya cuci.
                                    </p>
                                </div>

                                <div className="p-5 rounded-2xl bg-white border border-slate-200 space-y-3">
                                    <div className="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold">
                                        <Award className="w-5 h-5" />
                                    </div>
                                    <h4 className="text-sm font-bold text-slate-900">Timbangan IoT Transparan</h4>
                                    <p className="text-xs text-slate-600 leading-relaxed">
                                        Foto dan data angka timbangan otomatis masuk ke akun Anda saat kurir menimbang. Anda membayar
                                        tepat sesuai berat riil pakaian tanpa pembulatan sepihak.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                )}

                {/* ========================================================== */}
                {/* 3. TAB STATUS / PELACAKAN (MATCHES PICTURE 3) */}
                {/* ========================================================== */}
                {currentTab === 'status' && (
                    <div className="py-10 animate-in fade-in duration-200 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
                        {/* Header Title */}
                        <div className="text-center space-y-3 max-w-2xl mx-auto">
                            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold">
                                <span className="w-2 h-2 rounded-full bg-emerald-600 animate-ping"></span>
                                Sistem Pelacakan IoT &amp; Mesin Terintegrasi
                            </div>
                            <h1 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                                Lacak Pesanan Laundry Anda Secara{' '}
                                <span className="text-transparent bg-clip-text bg-gradient-to-r from-[#026cb5] to-[#00b4d8]">
                                    Real-Time
                                </span>
                            </h1>
                            <p className="text-slate-600 text-xs sm:text-sm">
                                Pantau setiap helai pakaian mulai dari penjemputan, proses cuci higienis mesin cerdas, hingga siap kembali wangi di pintu Anda.
                            </p>
                        </div>

                        {/* Search Bar */}
                        <div className="max-w-2xl mx-auto bg-white p-2.5 rounded-2xl shadow-xl border border-slate-200">
                            <form onSubmit={handleTrackSubmit} className="flex items-center gap-2">
                                <div className="flex-1 flex items-center gap-3 px-3">
                                    <Search className="w-5 h-5 text-slate-400" />
                                    <input
                                        type="text"
                                        placeholder="Masukkan Kode Pesanan (Contoh: LC-89304)"
                                        value={trackingQuery}
                                        onChange={(e) => setTrackingQuery(e.target.value)}
                                        className="w-full text-sm font-bold text-slate-900 bg-transparent border-none focus:outline-hidden"
                                    />
                                </div>
                                <button
                                    type="submit"
                                    disabled={isSearchingTrack}
                                    className="px-6 py-3 bg-[#026cb5] hover:bg-[#005a9c] text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2"
                                >
                                    {isSearchingTrack ? (
                                        <RefreshCw className="w-4 h-4 animate-spin" />
                                    ) : (
                                        <Search className="w-4 h-4" />
                                    )}
                                    <span>Cari Status</span>
                                </button>
                            </form>
                            <div className="flex justify-between items-center text-[10px] text-slate-400 px-3 pt-2">
                                <span>Pembaruan otomatis tiap 60 detik</span>
                                <span>Punya kendala? Hubungi Outlet Kemang (021) 7890-123</span>
                            </div>
                        </div>

                        {/* TRACKING RESULT DISPLAY */}
                        {activeTracking && (
                            <div className="space-y-6">
                                {/* Order Overview Card */}
                                <div className="p-6 rounded-3xl bg-white border border-slate-200 shadow-xl space-y-6">
                                    <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-5">
                                        <div className="space-y-1">
                                            <div className="flex items-center gap-2.5">
                                                <h2 className="text-2xl font-black text-slate-900 tracking-tight">
                                                    {activeTracking.order_id}
                                                </h2>
                                                <span className="px-2.5 py-1 rounded-full bg-blue-100 text-blue-800 text-[10px] font-extrabold">
                                                    ● {activeTracking.status_label}
                                                </span>
                                                <span className="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold uppercase">
                                                    {activeTracking.service_badge}
                                                </span>
                                            </div>
                                            <div className="text-xs text-slate-500">
                                                Pelanggan Terdaftar:{' '}
                                                <strong className="text-slate-800">{activeTracking.client_name}</strong> •
                                                Outlet: {activeTracking.outlet_name}
                                            </div>
                                        </div>

                                        <div className="bg-blue-50/70 border border-blue-200/60 p-3.5 rounded-2xl text-right">
                                            <div className="text-[10px] uppercase font-bold text-slate-400 tracking-wider">
                                                Estimasi Selesai
                                            </div>
                                            <div className="text-sm font-black text-blue-900">{activeTracking.est_completion}</div>
                                            <div className="text-[10px] text-blue-600 font-semibold">{activeTracking.est_remaining}</div>
                                        </div>
                                    </div>

                                    {/* Progress Bar */}
                                    <div className="space-y-2">
                                        <div className="flex justify-between text-xs font-bold text-slate-700">
                                            <span>Kemajuan Pengerjaan: Tahap {activeTracking.current_stage_step} dari {activeTracking.total_steps}</span>
                                            <span className="text-[#026cb5]">{activeTracking.progress_percentage}% Selesai</span>
                                        </div>
                                        <div className="w-full h-3 bg-slate-100 rounded-full overflow-hidden p-0.5 border border-slate-200">
                                            <div
                                                className="h-full bg-gradient-to-r from-[#026cb5] to-cyan-400 rounded-full transition-all duration-700"
                                                style={{ width: `${activeTracking.progress_percentage}%` }}
                                            />
                                        </div>
                                    </div>

                                    {/* 6-STEP HORIZONTAL STEPPER */}
                                    <div className="pt-4 border-t border-slate-100">
                                        <div className="text-xs font-bold text-slate-900 mb-6 flex items-center justify-between">
                                            <div className="flex items-center gap-1.5">
                                                <Sparkle className="w-4 h-4 text-cyan-600" />
                                                <span>Alur Pemrosesan Higienis</span>
                                            </div>
                                            <span className="text-[10px] font-medium text-slate-400">Sensor IoT Terhubung</span>
                                        </div>

                                        <div className="grid grid-cols-2 md:grid-cols-6 gap-3">
                                            {activeTracking.stepper.map((stepItem) => {
                                                const isCompleted = stepItem.status === 'completed';
                                                const isActive = stepItem.status === 'active';

                                                return (
                                                    <div
                                                        key={stepItem.step}
                                                        className={`p-3 rounded-2xl border text-center space-y-2 transition ${
                                                            isActive
                                                                ? 'bg-blue-50/80 border-blue-400 shadow-md ring-2 ring-blue-300/30'
                                                                : isCompleted
                                                                ? 'bg-slate-50/80 border-slate-200'
                                                                : 'bg-white border-slate-200/60 opacity-60'
                                                        }`}
                                                    >
                                                        <div
                                                            className={`w-7 h-7 rounded-full flex items-center justify-center mx-auto text-xs font-bold ${
                                                                isCompleted
                                                                    ? 'bg-emerald-600 text-white'
                                                                    : isActive
                                                                    ? 'bg-blue-600 text-white animate-bounce'
                                                                    : 'bg-slate-200 text-slate-500'
                                                            }`}
                                                        >
                                                            {isCompleted ? <Check className="w-3.5 h-3.5 stroke-[3]" /> : stepItem.step}
                                                        </div>
                                                        <div>
                                                            <div className="text-[11px] font-bold text-slate-900 leading-tight">
                                                                {stepItem.title}
                                                            </div>
                                                            <div
                                                                className={`text-[9px] font-semibold mt-0.5 ${
                                                                    isActive
                                                                        ? 'text-blue-700'
                                                                        : isCompleted
                                                                        ? 'text-emerald-700'
                                                                        : 'text-slate-400'
                                                                }`}
                                                            >
                                                                {stepItem.time}
                                                            </div>
                                                            <div className="text-[8px] text-slate-500 leading-tight mt-1">
                                                                {stepItem.desc}
                                                            </div>
                                                        </div>
                                                    </div>
                                                );
                                            })}
                                        </div>
                                    </div>
                                </div>

                                {/* Detail Split: Rincian & Verifikasi Fisik (Left) + Aksi & Outlet (Right) */}
                                <div className="grid grid-cols-1 md:grid-cols-12 gap-6">
                                    {/* Left: Rincian Cucian & Verifikasi Fisik */}
                                    <div className="md:col-span-7 p-6 rounded-3xl bg-white border border-slate-200 shadow-xl space-y-4">
                                        <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                                            <h3 className="text-sm font-bold text-slate-900">Rincian Cucian &amp; Verifikasi Fisik</h3>
                                            <span className="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 text-[10px] font-bold">
                                                Total: {activeTracking.total_pcs} Pcs
                                            </span>
                                        </div>

                                        {/* Items Pills */}
                                        <div className="flex flex-wrap gap-2">
                                            {activeTracking.items_breakdown.map((itm, idx) => (
                                                <div
                                                    key={idx}
                                                    className="px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-800 flex items-center gap-1.5"
                                                >
                                                    <span>{itm.name}</span>
                                                    <span className="text-blue-600 font-bold">{itm.qty}</span>
                                                </div>
                                            ))}
                                        </div>

                                        {/* Digital Scale Photo Proof */}
                                        <div className="rounded-2xl border border-slate-200 overflow-hidden relative group">
                                            <div className="aspect-[16/9] w-full overflow-hidden bg-slate-900">
                                                <img
                                                    src={activeTracking.scale_photo}
                                                    alt="Foto Dokumentasi Timbangan"
                                                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                                />
                                            </div>
                                            <div className="p-3 bg-slate-900/80 backdrop-blur-md text-white flex items-center justify-between text-xs absolute bottom-0 inset-x-0">
                                                <div>
                                                    <span className="font-bold">Foto Masuk Timbangan:</span> {activeTracking.scale_weight}
                                                </div>
                                                <span className="text-[10px] text-slate-300">{activeTracking.scale_time}</span>
                                            </div>
                                        </div>

                                        {/* Pewangi & Detergen Badge */}
                                        <div className="p-3 rounded-xl bg-blue-50/60 border border-blue-200/60 text-xs text-blue-900 flex items-center justify-between">
                                            <div>
                                                <strong>Pewangi:</strong> {activeTracking.fragrance}
                                            </div>
                                            <div>
                                                <strong>Detergen:</strong> {activeTracking.detergent}
                                            </div>
                                        </div>
                                    </div>

                                    {/* Right: Aksi Cepat & Outlet */}
                                    <div className="md:col-span-5 space-y-4">
                                        {/* Aksi Cepat Card */}
                                        <div className="p-6 rounded-3xl bg-white border border-slate-200 shadow-xl space-y-3">
                                            <h3 className="text-sm font-bold text-slate-900 mb-2">Aksi Cepat &amp; Layanan</h3>

                                            <a
                                                href={`https://wa.me/${activeTracking.outlet_phone}?text=Halo%20Admin%20L-Clean,%20saya%20ingin%20menanyakan%20status%20pesanan%20${activeTracking.order_id}`}
                                                target="_blank"
                                                rel="noreferrer"
                                                className="w-full py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center justify-between transition shadow-md shadow-emerald-600/20"
                                            >
                                                <div className="flex items-center gap-2">
                                                    <MessageCircle className="w-4 h-4" />
                                                    <span>Chat WhatsApp Admin Outlet</span>
                                                </div>
                                                <ArrowRight className="w-3.5 h-3.5" />
                                            </a>

                                            <button
                                                onClick={() =>
                                                    alert(
                                                        'Instruksi pengantaran Anda telah diperbarui ke sistem kurir: "Titip di pos security jika pemilik sedang bepergian".'
                                                    )
                                                }
                                                className="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-between transition"
                                            >
                                                <div className="flex items-center gap-2">
                                                    <Navigation className="w-4 h-4 text-slate-500" />
                                                    <span>Ubah Instruksi Pengantaran</span>
                                                </div>
                                                <span className="text-[10px] text-slate-400">Edit</span>
                                            </button>

                                            <button
                                                onClick={() => setShowNotaModal(true)}
                                                className="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-between transition"
                                            >
                                                <div className="flex items-center gap-2">
                                                    <FileText className="w-4 h-4 text-slate-500" />
                                                    <span>Download Nota Digital (PDF)</span>
                                                </div>
                                                <span className="text-[10px] text-slate-400">Lihat</span>
                                            </button>
                                        </div>

                                        {/* Outlet Pemroses Info */}
                                        <div className="p-6 rounded-3xl bg-white border border-slate-200 shadow-xl space-y-3">
                                            <h3 className="text-sm font-bold text-slate-900">Outlet Pemroses</h3>
                                            <div className="space-y-1 text-xs text-slate-600">
                                                <div className="font-bold text-slate-800">{activeTracking.outlet_name}</div>
                                                <div>{activeTracking.outlet_address}</div>
                                                <div className="text-[10px] text-emerald-600 font-semibold pt-1">
                                                    ● Outlet Beroperasi Normal • 8 Mesin Aktif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {/* RIWAYAT PENCARIAN DI PERANGKAT INI */}
                                <div className="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-3">
                                    <div className="text-xs font-bold text-slate-400 uppercase tracking-wider">
                                        Riwayat Pencarian di Perangkat Ini
                                    </div>
                                    <div className="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                        {[
                                            { code: 'LC-89304', title: 'Cuci Komplit Express • 5.2 kg', date: 'Hari Ini, 09:15', badge: 'Proses' },
                                            { code: 'LC-77419', title: 'Bed Cover King + Dry Clean', date: '18 Okt 2024', badge: 'Selesai' },
                                            { code: 'LC-66023', title: 'Setrika Uap Premium • 8 pcs', date: '04 Okt 2024', badge: 'Selesai' },
                                        ].map((item) => (
                                            <button
                                                key={item.code}
                                                type="button"
                                                onClick={() => {
                                                    setTrackingQuery(item.code);
                                                    handleTrackSubmit();
                                                }}
                                                className="p-3 rounded-2xl bg-slate-50 border border-slate-200 hover:border-blue-300 text-left transition space-y-1 group"
                                            >
                                                <div className="flex justify-between items-center">
                                                    <span className="text-xs font-bold text-slate-900 group-hover:text-blue-700">{item.code}</span>
                                                    <span className="text-[9px] font-bold px-1.5 py-0.5 rounded-sm bg-blue-100 text-blue-800">
                                                        {item.badge}
                                                    </span>
                                                </div>
                                                <div className="text-[10px] text-slate-500 truncate">{item.title}</div>
                                                <div className="text-[9px] text-slate-400">{item.date}</div>
                                            </button>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        )}
                    </div>
                )}

                {/* ========================================================== */}
                {/* 4. TAB JADWALKAN PENJEMPUTAN (MATCHES PICTURE 1) */}
                {/* ========================================================== */}
                {currentTab === 'pesan' && (
                    <div className="py-10 animate-in fade-in duration-200 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {/* Header Title */}
                        <div className="space-y-2 mb-8">
                            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#026cb5] text-xs font-bold">
                                <span className="w-2 h-2 rounded-full bg-[#026cb5]"></span>
                                LAYANAN ON-DEMAND TIAP SAAT
                            </div>
                            <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div>
                                    <h1 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                                        Jadwalkan Penjemputan{' '}
                                        <span className="text-transparent bg-clip-text bg-gradient-to-r from-[#026cb5] to-[#00b4d8]">
                                            Laundry Anda
                                        </span>
                                    </h1>
                                    <p className="text-slate-600 text-sm mt-1">
                                        Kurir L-Clean siap menjemput pakaian kotor ke rumah atau apartemen Anda dengan penanganan higienis standar hotel bintang 5.
                                    </p>
                                </div>
                                <div className="px-4 py-2 rounded-2xl bg-white border border-slate-200 text-xs font-bold text-emerald-700 flex items-center gap-2 shadow-xs">
                                    <ShieldCheck className="w-4 h-4 text-emerald-600" />
                                    <span>100% Amanah &amp; Terlindungi (Garansi kerusakan)</span>
                                </div>
                            </div>
                        </div>

                        {/* Booking Form Layout */}
                        <form onSubmit={handleBookingSubmit} className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                            {/* Left Side: 4 Steps Form (8 Cols) */}
                            <div className="lg:col-span-8 space-y-6">
                                {/* STEP 1: ALAMAT PENJEMPUTAN */}
                                <div className="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-4">
                                    <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                                        <div className="flex items-center gap-3">
                                            <div className="w-7 h-7 rounded-lg bg-[#026cb5] text-white flex items-center justify-center font-bold text-xs">
                                                1
                                            </div>
                                            <div>
                                                <h3 className="text-sm font-bold text-slate-900">Alamat Penjemputan</h3>
                                                <div className="text-[10px] text-slate-400">Tentukan titik kumpul pakaian Anda</div>
                                            </div>
                                        </div>
                                        <button
                                            type="button"
                                            onClick={() => alert('GPS Aktif: Titik lokasi Anda terdeteksi di Kebayoran Baru, Jaksel (2.1 KM dari Outlet Kemang).')}
                                            className="px-3 py-1 rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-100 text-[11px] font-bold flex items-center gap-1 transition"
                                        >
                                            <Navigation className="w-3 h-3" />
                                            <span>GPS Aktif</span>
                                        </button>
                                    </div>

                                    {/* Map Graphic Preview Mock */}
                                    <div className="h-36 rounded-2xl overflow-hidden relative border border-slate-200 bg-slate-100 flex items-center justify-center">
                                        <div className="absolute inset-0 opacity-40 bg-[radial-gradient(#026cb5_1px,transparent_1px)] [background-size:16px_16px]"></div>
                                        <div className="text-center relative z-10 space-y-1">
                                            <div className="w-10 h-10 rounded-full bg-[#026cb5] text-white flex items-center justify-center mx-auto shadow-lg animate-pulse">
                                                <MapPin className="w-5 h-5" />
                                            </div>
                                            <div className="text-xs font-black text-slate-800">South Jakarta • Radius 2.1 KM</div>
                                            <div className="text-[10px] text-emerald-700 font-bold bg-white/90 px-2.5 py-0.5 rounded-full inline-block shadow-xs">
                                                ✓ Tercover Gratis Ongkir
                                            </div>
                                        </div>
                                    </div>

                                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                                        <div className="space-y-1">
                                            <label className="font-bold text-slate-700">Nama Lengkap</label>
                                            <input
                                                type="text"
                                                required
                                                value={bookingForm.nama}
                                                onChange={(e) => setBookingForm({ ...bookingForm, nama: e.target.value })}
                                                placeholder="Contoh: Budi Santoso"
                                                className="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 text-xs p-2.5"
                                            />
                                        </div>
                                        <div className="space-y-1">
                                            <label className="font-bold text-slate-700">Nomor WhatsApp Aktif</label>
                                            <input
                                                type="text"
                                                required
                                                value={bookingForm.whatsapp}
                                                onChange={(e) => setBookingForm({ ...bookingForm, whatsapp: e.target.value })}
                                                placeholder="Contoh: 081234567890"
                                                className="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 text-xs p-2.5"
                                            />
                                        </div>
                                    </div>

                                    <div className="space-y-1 text-xs">
                                        <label className="font-bold text-slate-700">Alamat Lengkap / Apartemen &amp; Unit</label>
                                        <textarea
                                            rows="2"
                                            required
                                            value={bookingForm.alamat}
                                            onChange={(e) => setBookingForm({ ...bookingForm, alamat: e.target.value })}
                                            placeholder="Nama jalan, nomor rumah, RT/RW, atau nomor lantai & unit apartemen"
                                            className="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 text-xs p-2.5"
                                        />
                                    </div>

                                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                                        <div className="space-y-1">
                                            <label className="font-bold text-slate-700">Patokan / Landmark Terdekat</label>
                                            <input
                                                type="text"
                                                value={bookingForm.patokan}
                                                onChange={(e) => setBookingForm({ ...bookingForm, patokan: e.target.value })}
                                                placeholder="Contoh: Seberang Apotek Kimia Farma"
                                                className="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 text-xs p-2.5"
                                            />
                                        </div>
                                        <div className="space-y-1">
                                            <label className="font-bold text-slate-700">Instruksi Titik Kurir (Opsional)</label>
                                            <input
                                                type="text"
                                                value={bookingForm.instruksi_kurir}
                                                onChange={(e) => setBookingForm({ ...bookingForm, instruksi_kurir: e.target.value })}
                                                placeholder="Contoh: Titip di pos security jika saya di luar"
                                                className="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 text-xs p-2.5"
                                            />
                                        </div>
                                    </div>
                                </div>

                                {/* STEP 2: PILIH LAYANAN UTAMA */}
                                <div className="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-4">
                                    <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                                        <div className="flex items-center gap-3">
                                            <div className="w-7 h-7 rounded-lg bg-[#026cb5] text-white flex items-center justify-center font-bold text-xs">
                                                2
                                            </div>
                                            <div>
                                                <h3 className="text-sm font-bold text-slate-900">Pilih Layanan Utama</h3>
                                                <div className="text-[10px] text-slate-400">Pilih kategori penanganan kain Anda</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                                        {[
                                            {
                                                name: 'Kiloan Reguler',
                                                desc: 'Cuci basah, kering 100%, setrika rapi wangi, dan dilipat higienis.',
                                                price: 'Rp 9.000 /kg',
                                                time: 'Selesai 48 Jam',
                                                tag: null,
                                            },
                                            {
                                                name: 'Kiloan Kilat',
                                                desc: 'Pencucian prioritas terpisah 1 mesin 1 pelanggan. Selesai besok hari.',
                                                price: 'Rp 15.000 /kg',
                                                time: 'Selesai 24 Jam',
                                                tag: 'Favorit',
                                            },
                                            {
                                                name: 'Dry Clean Satuan',
                                                desc: 'Solusi jas kantor, dress sutra, gamis, kebaya, & bed cover tebal premium.',
                                                price: 'Mulai Rp 35.000 /pcs',
                                                time: 'Perawatan Khusus',
                                                tag: null,
                                            },
                                            {
                                                name: 'Sepatu & Bag Care',
                                                desc: 'Deep clean midsole, unyellowing, dan anti bakteri sepatu sneaker/kulit.',
                                                price: 'Rp 50.000 /pasang',
                                                time: 'Deep Clean',
                                                tag: null,
                                            },
                                        ].map((serv) => (
                                            <label
                                                key={serv.name}
                                                className={`p-4 rounded-2xl border cursor-pointer transition flex flex-col justify-between space-y-3 ${
                                                    selectedService === serv.name
                                                        ? 'bg-blue-50/70 border-blue-500 shadow-md ring-2 ring-blue-400/20'
                                                        : 'bg-slate-50/60 border-slate-200 hover:border-slate-300'
                                                }`}
                                            >
                                                <div className="space-y-1">
                                                    <div className="flex items-center justify-between">
                                                        <div className="flex items-center gap-2">
                                                            <input
                                                                type="radio"
                                                                name="selected_service"
                                                                checked={selectedService === serv.name}
                                                                onChange={() => setSelectedService(serv.name)}
                                                                className="text-[#026cb5] focus:ring-blue-500"
                                                            />
                                                            <span className="font-bold text-slate-900">{serv.name}</span>
                                                        </div>
                                                        {serv.tag && (
                                                            <span className="px-2 py-0.5 rounded-md bg-amber-100 text-amber-800 text-[9px] font-extrabold uppercase">
                                                                {serv.tag}
                                                            </span>
                                                        )}
                                                    </div>
                                                    <p className="text-[11px] text-slate-500 leading-relaxed">{serv.desc}</p>
                                                </div>

                                                <div className="flex justify-between items-center pt-2 border-t border-slate-200/60 text-[11px]">
                                                    <span className="font-black text-[#026cb5]">{serv.price}</span>
                                                    <span className="px-2 py-0.5 rounded-md bg-white border border-slate-200 text-slate-500 text-[10px]">
                                                        {serv.time}
                                                    </span>
                                                </div>
                                            </label>
                                        ))}
                                    </div>
                                </div>

                                {/* STEP 3: PILIHAN JADWAL JEMPUT */}
                                <div className="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-4">
                                    <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                                        <div className="flex items-center gap-3">
                                            <div className="w-7 h-7 rounded-lg bg-[#026cb5] text-white flex items-center justify-center font-bold text-xs">
                                                3
                                            </div>
                                            <div>
                                                <h3 className="text-sm font-bold text-slate-900">Pilihan Jadwal Jemput</h3>
                                                <div className="text-[10px] text-slate-400">Kapan kurir kami harus datang?</div>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Date Slot */}
                                    <div className="space-y-2">
                                        <div className="text-xs font-bold text-slate-700">Pilih Tanggal Penjemputan</div>
                                        <div className="grid grid-cols-3 gap-3">
                                            {[
                                                { label: 'Hari Ini', sub: 'Ready < 2 Jam', badge: 'Slot Terdekat' },
                                                { label: 'Besok', sub: 'Sesuai Slot', badge: 'Terjadwal' },
                                                { label: 'Lusa', sub: 'Fleksibel', badge: 'Booking Awal' },
                                            ].map((slot) => (
                                                <button
                                                    key={slot.label}
                                                    type="button"
                                                    onClick={() => setSelectedDateSlot(slot.label)}
                                                    className={`p-3 rounded-2xl border text-center transition ${
                                                        selectedDateSlot === slot.label
                                                            ? 'bg-[#026cb5] text-white border-[#026cb5] shadow-md shadow-blue-500/20'
                                                            : 'bg-slate-50 text-slate-700 border-slate-200 hover:border-slate-300'
                                                    }`}
                                                >
                                                    <div className="text-xs font-bold">{slot.label}</div>
                                                    <div
                                                        className={`text-[10px] ${
                                                            selectedDateSlot === slot.label ? 'text-blue-100' : 'text-slate-400'
                                                        }`}
                                                    >
                                                        {slot.sub}
                                                    </div>
                                                </button>
                                            ))}
                                        </div>
                                    </div>

                                    {/* Time Slot */}
                                    <div className="space-y-2 pt-2">
                                        <div className="text-xs font-bold text-slate-700">Slot Jam Penjemputan</div>
                                        <div className="grid grid-cols-3 gap-3">
                                            {[
                                                { label: 'Pagi', time: '09:00 – 11:00' },
                                                { label: 'Siang', time: '13:00 – 15:00' },
                                                { label: 'Sore', time: '16:00 – 18:00' },
                                            ].map((t) => (
                                                <button
                                                    key={t.label}
                                                    type="button"
                                                    onClick={() => setSelectedTimeSlot(t.label)}
                                                    className={`p-3 rounded-2xl border text-center transition ${
                                                        selectedTimeSlot === t.label
                                                            ? 'bg-blue-50 border-blue-500 text-blue-900 font-bold shadow-xs'
                                                            : 'bg-slate-50 border-slate-200 text-slate-600 hover:border-slate-300'
                                                    }`}
                                                >
                                                    <div className="text-xs font-bold">{t.label}</div>
                                                    <div className="text-[10px] text-slate-500">{t.time}</div>
                                                </button>
                                            ))}
                                        </div>
                                    </div>
                                </div>

                                {/* STEP 4: PREFERENSI & KEHARUMAN */}
                                <div className="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-4">
                                    <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                                        <div className="flex items-center gap-3">
                                            <div className="w-7 h-7 rounded-lg bg-[#026cb5] text-white flex items-center justify-center font-bold text-xs">
                                                4
                                            </div>
                                            <div>
                                                <h3 className="text-sm font-bold text-slate-900">Preferensi &amp; Keharuman</h3>
                                                <div className="text-[10px] text-slate-400">Personalisasi aroma &amp; penanganan khusus pakaian Anda</div>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Fragrance Selector */}
                                    <div className="space-y-2">
                                        <div className="text-xs font-bold text-slate-700">Pilih Varian Parfum Higienis</div>
                                        <div className="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                            {[
                                                {
                                                    name: 'Ocean Breeze',
                                                    sub: 'Segar dingin, maskulin & fresh harian',
                                                    badge: 'Best Seller',
                                                    color: 'cyan',
                                                },
                                                {
                                                    name: 'Sakura Blossom',
                                                    sub: 'Manis floral lembut, elegan & feminin',
                                                    badge: 'Floral',
                                                    color: 'pink',
                                                },
                                                {
                                                    name: 'Lavender Soft',
                                                    sub: 'Menenangkan, cocok untuk sprei tidur',
                                                    badge: 'Calming',
                                                    color: 'purple',
                                                },
                                            ].map((aroma) => (
                                                <label
                                                    key={aroma.name}
                                                    className={`p-3.5 rounded-2xl border cursor-pointer transition flex flex-col justify-between space-y-2 ${
                                                        selectedFragrance === aroma.name
                                                            ? 'bg-blue-50/70 border-blue-500 shadow-xs ring-2 ring-blue-400/20'
                                                            : 'bg-slate-50 border-slate-200 hover:border-slate-300'
                                                    }`}
                                                >
                                                    <div className="flex items-center justify-between">
                                                        <div className="flex items-center gap-1.5">
                                                            <input
                                                                type="radio"
                                                                name="selected_fragrance"
                                                                checked={selectedFragrance === aroma.name}
                                                                onChange={() => setSelectedFragrance(aroma.name)}
                                                                className="text-blue-600 focus:ring-blue-500"
                                                            />
                                                            <span className="text-xs font-bold text-slate-900">{aroma.name}</span>
                                                        </div>
                                                        <span className="text-[8px] font-extrabold uppercase px-1.5 py-0.5 rounded-sm bg-white border border-slate-200 text-slate-600">
                                                            {aroma.badge}
                                                        </span>
                                                    </div>
                                                    <p className="text-[10px] text-slate-500 leading-relaxed">{aroma.sub}</p>
                                                </label>
                                            ))}
                                        </div>
                                    </div>

                                    {/* Special Notes Textarea */}
                                    <div className="space-y-1 text-xs">
                                        <label className="font-bold text-slate-700">Catatan Khusus untuk Tim Laundry (Opsional)</label>
                                        <textarea
                                            rows="2"
                                            value={bookingForm.catatan}
                                            onChange={(e) => setBookingForm({ ...bookingForm, catatan: e.target.value })}
                                            placeholder="Contoh: Kemeja putih ada noda kopi di lengan kanan, mohon pisahkan celana luntur, atau setrika lipat tanpa gantungan..."
                                            className="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 text-xs p-2.5"
                                        />
                                    </div>

                                    {/* Hypoallergenic Eco Toggle */}
                                    <div className="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-between text-xs">
                                        <div className="flex items-center gap-2.5">
                                            <div className="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold">
                                                <ShieldCheck className="w-4 h-4" />
                                            </div>
                                            <div>
                                                <div className="font-bold text-emerald-950">Gunakan Detergen Eco-Hypoallergenic</div>
                                                <div className="text-[10px] text-emerald-700">
                                                    Aman untuk kulit bayi &amp; penderita alergi sensitif (+Rp 0,- Gratis)
                                                </div>
                                            </div>
                                        </div>
                                        <label className="relative inline-flex items-center cursor-pointer">
                                            <input
                                                type="checkbox"
                                                checked={isHypoallergenic}
                                                onChange={(e) => setIsHypoallergenic(e.target.checked)}
                                                className="sr-only peer"
                                            />
                                            <div className="w-11 h-6 bg-slate-200 peer-focus:outline-hidden rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {/* Right Side: Sticky Ringkasan Pesanan (4 Cols) */}
                            <div className="lg:col-span-4 sticky top-28 space-y-4">
                                <div className="p-6 rounded-3xl bg-white border border-slate-200 shadow-xl space-y-5">
                                    <div className="flex items-center justify-between border-b border-slate-100 pb-4">
                                        <h3 className="text-base font-black text-slate-900 flex items-center gap-2">
                                            <FileText className="w-5 h-5 text-[#026cb5]" />
                                            <span>Ringkasan Pesanan</span>
                                        </h3>
                                        <span className="text-[10px] font-bold text-slate-400">Instant</span>
                                    </div>

                                    {/* Gratis Ongkir Indicator */}
                                    <div className="p-3 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-950 text-xs space-y-1">
                                        <div className="font-bold flex items-center gap-1.5">
                                            <Truck className="w-4 h-4 text-emerald-600" />
                                            <span>Gratis Ongkir Radius &lt; 5 KM</span>
                                        </div>
                                        <div className="text-[10px] text-emerald-700">
                                            ✓ Tercakup Otomatis (Lokasi Anda: 2.1 KM)
                                        </div>
                                    </div>

                                    {/* Breakdown Items */}
                                    <div className="space-y-2 text-xs">
                                        <div className="flex justify-between text-slate-600">
                                            <span>Paket Dipilih:</span>
                                            <span className="font-bold text-slate-800">{selectedService}</span>
                                        </div>
                                        <div className="flex justify-between text-slate-600">
                                            <span>Jadwal Jemput:</span>
                                            <span className="font-semibold">{selectedDateSlot} ({selectedTimeSlot})</span>
                                        </div>
                                        <div className="flex justify-between text-slate-600">
                                            <span>Aroma Pilihan:</span>
                                            <span className="font-semibold">{selectedFragrance}</span>
                                        </div>
                                        <div className="flex justify-between text-slate-600">
                                            <span>Biaya Antar-Jemput:</span>
                                            <span className="font-bold text-emerald-600">GRATIS (Rp 0)</span>
                                        </div>
                                        <div className="flex justify-between text-slate-600">
                                            <span>Biaya Kantong Higienis:</span>
                                            <span className="font-semibold text-slate-800">Termasuk</span>
                                        </div>
                                    </div>

                                    {/* Promo Code Input Box */}
                                    <div className="pt-2 border-t border-slate-100 space-y-2">
                                        <label className="text-[11px] font-bold text-slate-700">Kode Promo / Kupon</label>
                                        <div className="flex gap-2">
                                            <input
                                                type="text"
                                                placeholder="BERSAMA-LCLEAN"
                                                value={promoInput}
                                                onChange={(e) => setPromoInput(e.target.value)}
                                                className="w-full text-xs font-bold uppercase rounded-xl border-slate-300 p-2"
                                            />
                                            <button
                                                type="button"
                                                onClick={handleApplyPromo}
                                                className="px-3 py-2 bg-slate-800 text-white rounded-xl text-xs font-bold hover:bg-black transition"
                                            >
                                                Terapkan
                                            </button>
                                        </div>
                                        {promoApplied && (
                                            <div className="text-[10px] text-emerald-600 font-bold flex items-center gap-1">
                                                ✓ Kupon 30% Berhasil Diterapkan!
                                            </div>
                                        )}
                                    </div>

                                    {/* Estimated Total Price */}
                                    <div className="p-4 rounded-2xl bg-blue-50/60 border border-blue-200/60 space-y-1">
                                        <div className="text-[10px] uppercase font-bold text-slate-500">Estimasi Biaya Awal</div>
                                        <div className="text-2xl font-black text-[#026cb5]">
                                            Rp {bookingEstimatedTotal.toLocaleString('id-ID')}*
                                        </div>
                                        <div className="text-[9px] text-slate-400 leading-tight">
                                            *Timbangan digital transparan di depan Anda saat kurir tiba atau dikonfirmasi via video digital di hub L-Clean.
                                        </div>
                                    </div>

                                    {/* Payment Method Selector */}
                                    <div className="space-y-1.5 text-xs">
                                        <label className="font-bold text-slate-700">Metode Pembayaran</label>
                                        <div className="grid grid-cols-2 gap-2">
                                            {['QRIS / E-Wallet', 'Bayar Kurir (COD)', 'Transfer VA Bank', 'Setelah Siap Antar'].map(
                                                (m) => (
                                                    <button
                                                        key={m}
                                                        type="button"
                                                        onClick={() => setPaymentMethod(m)}
                                                        className={`p-2 rounded-xl border text-[11px] text-center transition ${
                                                            paymentMethod === m
                                                                ? 'border-blue-500 bg-blue-50 font-bold text-blue-900'
                                                                : 'border-slate-200 bg-slate-50 text-slate-600 hover:border-slate-300'
                                                        }`}
                                                    >
                                                        {m}
                                                    </button>
                                                )
                                            )}
                                        </div>
                                    </div>

                                    {/* Submit Order Button */}
                                    <button
                                        type="submit"
                                        disabled={isSubmitting}
                                        className="w-full py-4 bg-gradient-to-r from-[#005a9c] to-[#008db9] hover:from-[#004e87] hover:to-[#007ba1] text-white font-black text-sm rounded-2xl shadow-xl shadow-blue-600/30 transition-all duration-200 flex items-center justify-center gap-2 transform active:scale-95"
                                    >
                                        {isSubmitting ? (
                                            <RefreshCw className="w-5 h-5 animate-spin" />
                                        ) : (
                                            <Truck className="w-5 h-5" />
                                        )}
                                        <span>Konfirmasi &amp; Panggil Kurir Sekarang &rarr;</span>
                                    </button>

                                    <div className="text-[10px] text-center text-slate-400">
                                        🛡️ Privasi Anda Terproteksi &amp; Kurir Resmi Berseragam L-Clean
                                    </div>
                                </div>

                                {/* CS WhatsApp Helper Banner */}
                                <div className="p-4 rounded-2xl bg-white border border-slate-200 shadow-xs flex items-center gap-3">
                                    <div className="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                                        <Phone className="w-4 h-4" />
                                    </div>
                                    <div className="text-xs">
                                        <div className="font-bold text-slate-800">Perlu bantuan instan?</div>
                                        <a
                                            href="https://wa.me/6281299087788"
                                            target="_blank"
                                            rel="noreferrer"
                                            className="text-emerald-700 font-bold hover:underline"
                                        >
                                            CS WhatsApp: 0812-9908-7788
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                )}
            </main>

            {/* ============================================================== */}
            {/* SUCCESS BOOKING POPUP MODAL */}
            {/* ============================================================== */}
            {showSuccessModal && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-in fade-in duration-200">
                    <div className="w-full max-w-md bg-white rounded-3xl p-6 shadow-2xl text-center space-y-4 border border-slate-100">
                        <div className="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto shadow-md">
                            <CheckCircle2 className="w-10 h-10" />
                        </div>
                        <h3 className="text-xl font-black text-slate-900">Penjemputan Berhasil Dijadwalkan!</h3>
                        <p className="text-xs text-slate-600 leading-relaxed">
                            Kurir L-Clean segera meluncur sesuai jadwal yang Anda tentukan. Kode pelacakan laundry Anda:
                        </p>
                        <div className="p-3 bg-blue-50 rounded-2xl border border-blue-200 font-mono text-xl font-black text-blue-900 tracking-wider">
                            {createdOrderId}
                        </div>
                        <div className="flex flex-col gap-2 pt-2">
                            <button
                                onClick={() => {
                                    setShowSuccessModal(false);
                                    setTrackingQuery(createdOrderId);
                                    setCurrentTab('status');
                                    handleTrackSubmit();
                                }}
                                className="w-full py-3 bg-[#026cb5] hover:bg-[#005a9c] text-white font-bold text-xs rounded-xl shadow-md transition"
                            >
                                Lacak Pesanan Ini Sekarang &rarr;
                            </button>
                            <button
                                onClick={() => setShowSuccessModal(false)}
                                className="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition"
                            >
                                Kembali ke Beranda
                            </button>
                        </div>
                    </div>
                </div>
            )}

            {/* ============================================================== */}
            {/* NOTA DIGITAL SIMULATION MODAL */}
            {/* ============================================================== */}
            {showNotaModal && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-in fade-in duration-200">
                    <div className="w-full max-w-lg bg-white rounded-3xl p-6 shadow-2xl space-y-4 border border-slate-200">
                        <div className="flex justify-between items-center border-b border-slate-100 pb-3">
                            <div className="flex items-center gap-2">
                                <FileText className="w-5 h-5 text-[#026cb5]" />
                                <span className="font-black text-slate-900 text-sm">FAKTUR NOTA DIGITAL RESMI</span>
                            </div>
                            <button
                                onClick={() => setShowNotaModal(false)}
                                className="text-slate-400 hover:text-slate-700 p-1 rounded-lg"
                            >
                                <X className="w-5 h-5" />
                            </button>
                        </div>

                        <div className="p-4 bg-slate-50 rounded-2xl border border-slate-200 font-mono text-xs space-y-2">
                            <div className="flex justify-between border-b border-dashed border-slate-300 pb-2">
                                <span>No. Faktur: {activeTracking?.order_id || 'LC-89304'}</span>
                                <span>Tgl: {new Date().toLocaleDateString('id-ID')}</span>
                            </div>
                            <div className="flex justify-between">
                                <span>Pelanggan:</span>
                                <span>{activeTracking?.client_name || 'Budi Santoso'}</span>
                            </div>
                            <div className="flex justify-between">
                                <span>Layanan:</span>
                                <span>{activeTracking?.service_badge || 'CUCI KOMPLIT'}</span>
                            </div>
                            <div className="flex justify-between">
                                <span>Total Berat:</span>
                                <span>{activeTracking?.scale_weight || '5.20 kg'}</span>
                            </div>
                            <div className="flex justify-between">
                                <span>Metode Bayar:</span>
                                <span>{activeTracking?.payment_status || 'LUNAS (QRIS)'}</span>
                            </div>
                            <div className="flex justify-between text-base font-black text-slate-900 pt-2 border-t border-dashed border-slate-300">
                                <span>TOTAL:</span>
                                <span>{activeTracking?.amount_formatted || 'Rp 72.800'}</span>
                            </div>
                        </div>

                        <div className="flex justify-end gap-2">
                            <button
                                onClick={() => window.print()}
                                className="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl transition"
                            >
                                Cetak Nota
                            </button>
                            <button
                                onClick={() => setShowNotaModal(false)}
                                className="px-4 py-2 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl"
                            >
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            )}

            {/* ============================================================== */}
            {/* FITUR SAAS MITRA MODAL */}
            {/* ============================================================== */}
            {showSaaSModal && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-in fade-in duration-200">
                    <div className="w-full max-w-2xl bg-white rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6 border border-slate-200">
                        <div className="flex justify-between items-start">
                            <div>
                                <span className="px-2.5 py-1 rounded-full bg-blue-100 text-blue-800 text-[10px] font-extrabold uppercase">
                                    L-Clean Enterprise Platform
                                </span>
                                <h3 className="text-2xl font-black text-slate-900 mt-1">
                                    Sistem SaaS Fasilitas Laundry Modern
                                </h3>
                                <p className="text-xs text-slate-500 mt-0.5">
                                    Platform operasional terintegrasi khusus pemilik gerai &amp; operator laundry modern.
                                </p>
                            </div>
                            <button
                                onClick={() => setShowSaaSModal(false)}
                                className="text-slate-400 hover:text-slate-700 p-1"
                            >
                                <X className="w-5 h-5" />
                            </button>
                        </div>

                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                            <div className="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1.5">
                                <div className="font-bold text-slate-900 flex items-center gap-1.5">
                                    <Sparkles className="w-4 h-4 text-blue-600" />
                                    <span>Manajemen Multi-Tenant Gerai</span>
                                </div>
                                <p className="text-slate-500">
                                    Atur multi cabang outlet, pembagian mesin cuci, kuota dry clean, dan penugasan kurir antar-jemput.
                                </p>
                            </div>

                            <div className="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1.5">
                                <div className="font-bold text-slate-900 flex items-center gap-1.5">
                                    <Award className="w-4 h-4 text-emerald-600" />
                                    <span>Integrasi Timbangan IoT &amp; RFID</span>
                                </div>
                                <p className="text-slate-500">
                                    Berat timbangan tercatat langsung otomatis tanpa input manual untuk mencegah manipulasi timbangan.
                                </p>
                            </div>

                            <div className="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1.5">
                                <div className="font-bold text-slate-900 flex items-center gap-1.5">
                                    <MessageCircle className="w-4 h-4 text-purple-600" />
                                    <span>Notifikasi Otomatis WhatsApp</span>
                                </div>
                                <p className="text-slate-500">
                                    Kirim nota digital dan update status cucian ke nomor WhatsApp pelanggan secara otomatis saat status berganti.
                                </p>
                            </div>

                            <div className="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1.5">
                                <div className="font-bold text-slate-900 flex items-center gap-1.5">
                                    <DollarSign className="w-4 h-4 text-amber-600" />
                                    <span>Laporan Keuangan &amp; Kasir POS</span>
                                </div>
                                <p className="text-slate-500">
                                    Pantau omzet harian, pembayaran QRIS, deposit membership pelanggan, dan rekap pembukuan otomatis.
                                </p>
                            </div>
                        </div>

                        <div className="p-4 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div className="text-xs">
                                <div className="font-bold text-blue-950">Sudah Memiliki Akun Operator Clean?</div>
                                <div className="text-blue-700 text-[11px]">
                                    Login dengan username <code className="font-bold font-mono">clean</code> untuk mengakses dashboard fasilitas.
                                </div>
                            </div>
                            <Link
                                href="/login"
                                className="px-5 py-2.5 bg-[#026cb5] hover:bg-[#005a9c] text-white font-bold text-xs rounded-xl shadow-md transition whitespace-nowrap"
                            >
                                Masuk ke Dashboard &rarr;
                            </Link>
                        </div>
                    </div>
                </div>
            )}

            {/* ============================================================== */}
            {/* FOOTER (MATCHES ALL PICTURES) */}
            {/* ============================================================== */}
            <footer className="bg-white border-t border-slate-200/80 pt-16 pb-12 text-slate-600 text-xs">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                    <div className="grid grid-cols-1 md:grid-cols-5 gap-8">
                        {/* Brand Column */}
                        <div className="md:col-span-2 space-y-4">
                            <div className="flex items-center gap-2.5">
                                <div className="w-9 h-9 rounded-xl bg-gradient-to-br from-[#026cb5] to-[#00b4d8] flex items-center justify-center text-white shadow-md">
                                    <Droplets className="w-5 h-5 stroke-[2.5]" />
                                </div>
                                <span className="text-lg font-black text-[#034ea2] tracking-tight">L-Clean</span>
                            </div>
                            <p className="text-slate-500 leading-relaxed max-w-sm">
                                Solusi Laundry Cerdas &amp; Higienis Terpercaya. Layanan perawatan pakaian prima dan platform operasional digital terlengkap bagi mitra laundromat modern.
                            </p>
                            <div className="flex items-center gap-2 pt-2 text-slate-400">
                                <span className="px-2 py-1 rounded-md bg-slate-100 text-slate-600 font-semibold">
                                    Cabang Kemang
                                </span>
                                <span className="px-2 py-1 rounded-md bg-slate-100 text-slate-600 font-semibold">
                                    Cabang Senopati
                                </span>
                                <span className="px-2 py-1 rounded-md bg-slate-100 text-slate-600 font-semibold">
                                    Cabang BSD
                                </span>
                            </div>
                        </div>

                        {/* Layanan Column */}
                        <div className="space-y-3">
                            <h4 className="font-bold text-slate-900 text-xs uppercase tracking-wider">Layanan</h4>
                            <ul className="space-y-2 text-slate-500">
                                <li>
                                    <button onClick={() => selectAndBook('Kiloan Reguler')} className="hover:text-blue-700">
                                        Cuci Komplit
                                    </button>
                                </li>
                                <li>
                                    <button onClick={() => selectAndBook('Dry Clean Satuan')} className="hover:text-blue-700">
                                        Dry Clean
                                    </button>
                                </li>
                                <li>
                                    <button onClick={() => selectAndBook('Kiloan Kilat')} className="hover:text-blue-700">
                                        Setrika Uap
                                    </button>
                                </li>
                                <li>
                                    <button onClick={() => selectAndBook('Super Express')} className="hover:text-blue-700">
                                        Express 3 Jam
                                    </button>
                                </li>
                            </ul>
                        </div>

                        {/* Mitra Laundry Column */}
                        <div className="space-y-3">
                            <h4 className="font-bold text-slate-900 text-xs uppercase tracking-wider">Mitra Laundry</h4>
                            <ul className="space-y-2 text-slate-500">
                                <li>
                                    <button onClick={() => setShowSaaSModal(true)} className="hover:text-blue-700">
                                        Daftar Outlet
                                    </button>
                                </li>
                                <li>
                                    <button onClick={() => setShowSaaSModal(true)} className="hover:text-blue-700">
                                        Aplikasi Kasir POS
                                    </button>
                                </li>
                                <li>
                                    <button onClick={() => setShowSaaSModal(true)} className="hover:text-blue-700">
                                        Manajemen Karyawan
                                    </button>
                                </li>
                                <li>
                                    <button onClick={() => setShowSaaSModal(true)} className="hover:text-blue-700">
                                        Laporan Keuangan
                                    </button>
                                </li>
                            </ul>
                        </div>

                        {/* Dukungan & Info Column */}
                        <div className="space-y-3">
                            <h4 className="font-bold text-slate-900 text-xs uppercase tracking-wider">Dukungan &amp; Info</h4>
                            <ul className="space-y-2 text-slate-500">
                                <li>
                                    <a href="#faq-section" className="hover:text-blue-700">
                                        FAQ
                                    </a>
                                </li>
                                <li>
                                    <a href="https://wa.me/6281299087788" target="_blank" rel="noreferrer" className="hover:text-blue-700">
                                        Hubungi WhatsApp
                                    </a>
                                </li>
                                <li>
                                    <a href="#" className="hover:text-blue-700">
                                        Syarat &amp; Ketentuan
                                    </a>
                                </li>
                                <li>
                                    <a href="#" className="hover:text-blue-700">
                                        Kebijakan Privasi
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {/* Newsletter Subscription Box */}
                    <div className="p-6 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col md:flex-row items-center justify-between gap-4">
                        <div>
                            <div className="font-bold text-slate-900">Dapatkan Diskon &amp; Tips Laundry Terkini</div>
                            <div className="text-slate-500 text-[11px]">
                                Berlangganan buletin berkala untuk promo cuci hemat eksklusif.
                            </div>
                        </div>
                        <div className="flex gap-2 w-full md:w-auto">
                            <input
                                type="email"
                                placeholder="Masukkan alamat email Anda..."
                                className="px-3.5 py-2 text-xs rounded-xl border-slate-300 w-full sm:w-64"
                            />
                            <button
                                onClick={() => alert('Terima kasih! Anda telah terdaftar untuk menerima info diskon L-Clean.')}
                                className="px-4 py-2 bg-[#026cb5] hover:bg-[#005a9c] text-white font-bold rounded-xl whitespace-nowrap text-xs transition"
                            >
                                Langganan
                            </button>
                        </div>
                    </div>

                    {/* Bottom Copyright */}
                    <div className="pt-6 border-t border-slate-200/60 flex flex-col sm:flex-row items-center justify-between gap-3 text-slate-400 text-[11px]">
                        <div>© 2026 L-Clean Indonesia. Hak Cipta Dilindungi Undang-Undang.</div>
                        <div className="flex items-center gap-4">
                            <span>Higienis &amp; Ramah Lingkungan</span>
                            <span>•</span>
                            <span>Layanan Antar-Jemput</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    );
}
