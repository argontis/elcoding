import React, { useState, useEffect } from 'react';
import { Head } from '@inertiajs/react';
import {
  Scissors, Calendar, Clock, MapPin, Award, Star, CheckCircle,
  ArrowRight, X, Phone, MessageSquare, ShoppingBag,
  User, ShieldCheck, Sparkles, QrCode, Check, AlertCircle, Eye,
  LogIn, LogOut, Bell, UserCheck, Share2, Printer, Sliders, RefreshCw,
  Zap, Coffee, Wine, Store, Tag, CheckSquare, Square, Download,
  Navigation, CheckCircle2, Car, Compass, ChevronRight, Mail,
  Search, Filter, Repeat, FileText, FlaskConical, CreditCard,
  Crown, ExternalLink
} from 'lucide-react';

export default function BarbershopVisitor({
  auth,
  initialTab = 'beranda',
  isMember: initialIsMember = false,
  memberData: initialMemberData = null,
  activeReservation: initialActiveReservation = null,
  services = [],
  allServices = [],
  barbers = [],
  suiteInfo = {},
  groomingProducts = [],
  flash = {}
}) {
  // ==========================================
  // NAVIGATION & TAB STATE (PUSAT INFORMASI)
  // ==========================================
  const [activeTab, setActiveTab] = useState(initialTab); // 'beranda' | 'reservasi' | 'tiket' | 'profil'
  const [isMember, setIsMember] = useState(initialIsMember);
  const [memberData, setMemberData] = useState(initialMemberData);
  const [activeReservation, setActiveReservation] = useState(initialActiveReservation);

  // Modals Info
  const [showEPassModal, setShowEPassModal] = useState(false);
  const [showLoginModal, setShowLoginModal] = useState(false);
  const [showCatalogModal, setShowCatalogModal] = useState(false);
  const [showProductsModal, setShowProductsModal] = useState(false);
  const [showConsultModal, setShowConsultModal] = useState(false);
  const [showInvoiceModal, setShowInvoiceModal] = useState(null);
  const [showBenefitModal, setShowBenefitModal] = useState(false);
  const [showUserDropdown, setShowUserDropdown] = useState(false);
  const [toastMessage, setToastMessage] = useState(flash?.message || null);

  // ==========================================
  // RESERVASI CEPAT STATE (STEP 01 - 04)
  // ==========================================
  const [selectedBranch, setSelectedBranch] = useState('senopati'); // 'senopati' | 'kebayoran'
  
  // Step 02: Multi-select Layanan
  const [selectedServices, setSelectedServices] = useState([
    'gentleman-royal-cut',
    'signature-beard-sculpt'
  ]);

  // Step 03: Selected Master Barber
  const [selectedBarber, setSelectedBarber] = useState('fastest'); // 'fastest' | 'yudha' | 'bram' | 'arief'

  // Step 04: Date & Slot
  const [selectedDateIndex, setSelectedDateIndex] = useState(0);
  const [selectedTimeSlot, setSelectedTimeSlot] = useState('14:00');

  // Live Summary State
  const [promoCode, setPromoCode] = useState('');
  const [promoApplied, setPromoApplied] = useState(false);
  const [redeemVipPoints, setRedeemVipPoints] = useState(false);
  const [paymentOption, setPaymentOption] = useState('dp'); // 'dp' | 'tempat'

  // ==========================================
  // RIWAYAT & PROFIL STATE (SCREEN 4)
  // ==========================================
  const [historySubTab, setHistorySubTab] = useState('kunjungan'); // 'kunjungan' | 'ulasan'
  const [searchHistoryQuery, setSearchHistoryQuery] = useState('');

  // Show Toast Helper
  const showToast = (msg) => {
    setToastMessage(msg);
    setTimeout(() => setToastMessage(null), 5000);
  };

  useEffect(() => {
    if (flash?.message) {
      showToast(flash.message);
    }
  }, [flash]);

  // Toggle Service Selection (Multi-select)
  const toggleService = (serviceId) => {
    if (selectedServices.includes(serviceId)) {
      if (selectedServices.length === 1) {
        showToast('Minimal pilih 1 perawatan.');
        return;
      }
      setSelectedServices(selectedServices.filter((id) => id !== serviceId));
    } else {
      setSelectedServices([...selectedServices, serviceId]);
    }
  };

  // Layanan data untuk tab Reservasi Cepat
  const reservationServices = [
    {
      id: 'gentleman-royal-cut',
      title: 'Gentleman Royal Cut',
      badge: 'Signature',
      badgeColor: 'amber',
      desc: 'Konsultasi profil kepala, precision shear cut, hot towel massage, & tonic scalp finish.',
      duration: '45 Menit',
      durationMinutes: 45,
      price: 250000,
      priceLabel: 'Rp 250k',
      sublabel: 'Termasuk Styling'
    },
    {
      id: 'signature-beard-sculpt',
      title: 'Signature Beard Sculpt',
      badge: '',
      badgeColor: '',
      desc: 'Razor contouring tajam, conditioning beard balm, dan minyak esensial cedarwood.',
      duration: '30 Menit',
      durationMinutes: 30,
      price: 120000,
      priceLabel: 'Rp 120k',
      sublabel: 'Beard Oil Treatment'
    },
    {
      id: 'scalp-scrub-purify',
      title: 'Scalp Scrub & Purify',
      badge: 'Detox',
      badgeColor: 'gray',
      desc: 'Exfoliasi garam laut organik, pembersihan sebum folikel, & pijatan relaksasi tengkuk.',
      duration: '35 Menit',
      durationMinutes: 35,
      price: 150000,
      priceLabel: 'Rp 150k',
      sublabel: 'Spa Grade'
    }
  ];

  // Hitung total perawatan terpilih
  const activeSelectedServicesData = reservationServices.filter((s) => selectedServices.includes(s.id));
  const totalDuration = activeSelectedServicesData.reduce((acc, curr) => acc + curr.durationMinutes, 0);
  const subtotalPrice = activeSelectedServicesData.reduce((acc, curr) => acc + curr.price, 0);
  const vipDiscount = redeemVipPoints ? 25000 : 0;
  const promoDiscount = promoApplied ? 30000 : 0;
  const grandTotal = Math.max(0, subtotalPrice - vipDiscount - promoDiscount);

  // List Barber untuk Reservasi Cepat
  const fastBarbers = [
    {
      id: 'fastest',
      name: 'Paling Cepat',
      role: 'Auto-Assign',
      status: 'Tersedia',
      rating: null,
      isSpecial: true
    },
    {
      id: 'yudha',
      name: 'Yudha P.',
      role: 'Fade & Scissor Spec',
      status: 'Tersedia',
      rating: '4.98',
      avatar: 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=200&auto=format&fit=crop&q=80'
    },
    {
      id: 'bram',
      name: 'Bram K.',
      role: 'Classic Sculpting',
      status: 'Tersedia',
      rating: '4.95',
      avatar: 'https://images.unsplash.com/photo-1622286342621-4bd786c2447c?w=200&auto=format&fit=crop&q=80'
    },
    {
      id: 'arief',
      name: 'Arief M.',
      role: 'Beard & Texture',
      status: 'Tersedia',
      rating: '4.92',
      avatar: 'https://images.unsplash.com/photo-1517832606589-7629c3395907?w=200&auto=format&fit=crop&q=80'
    }
  ];

  // List Tanggal
  const datesList = [
    { label: 'HARI INI', day: '24', month: 'Mei', isToday: true },
    { label: 'MIN', day: '25', month: 'Mei' },
    { label: 'SEN', day: '26', month: 'Mei' },
    { label: 'SEL', day: '27', month: 'Mei' },
    { label: 'RAB', day: '28', month: 'Mei' },
    { label: 'KAM', day: '29', month: 'Mei' },
  ];

  // List Slot Jam
  const timeSlots = [
    { time: '14:00', status: 'Tersedia' },
    { time: '15:30', status: 'Tersedia' },
    { time: '16:30', status: 'Tersedia' },
    { time: '18:00', status: 'Prime Evening' },
  ];

  // Helper Barber Terpilih
  const currentBarberObj = fastBarbers.find((b) => b.id === selectedBarber);
  const currentBarberName = currentBarberObj?.id === 'fastest' ? 'Siapa Saja yang Tersedia' : currentBarberObj?.name || 'Master Barber';

  // Format IDR
  const formatRupiah = (num) => {
    return 'Rp ' + num.toLocaleString('id-ID');
  };

  // Treatment Log History Data (Screen 4)
  const treatmentLogs = [
    {
      id: 'LOG-01',
      date: '12 SEPTEMBER 2025',
      session: 'Sesi 15:30 WIB',
      status: 'Selesai',
      statusType: 'gold',
      title: 'Gentleman Classic Fade & Beard Shape',
      barberName: 'Master Barber Yudha Pratama',
      barberAvatar: 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=100&auto=format&fit=crop&q=80',
      formula: 'Low drop fade 1.5mm, textured crop, matte clay finish. Gradasi clipper #1 to #2.5 dengan razor shaping garis leher natural.',
      cost: 350000,
      costFormatted: 'Rp 350.000',
      image: 'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?w=400&auto=format&fit=crop&q=80',
      canReorder: true
    },
    {
      id: 'LOG-02',
      date: '20 AGUSTUS 2025',
      session: 'Sesi 13:00 WIB',
      status: 'Arsip',
      statusType: 'gray',
      title: 'Royal Hair Cut & Scalp Wash',
      barberName: 'Senior Barber Bram Kusuma',
      barberAvatar: 'https://images.unsplash.com/photo-1622286342621-4bd786c2447c?w=100&auto=format&fit=crop&q=80',
      formula: 'Side part pompadour, high shine pomade. Taper fade rapi di sekeliling pelipis, hair tonic cooling peppermint ritual.',
      cost: 280000,
      costFormatted: 'Rp 280.000',
      image: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=400&auto=format&fit=crop&q=80',
      canReorder: false
    }
  ];

  // Filter logs
  const filteredLogs = treatmentLogs.filter(log => 
    log.title.toLowerCase().includes(searchHistoryQuery.toLowerCase()) ||
    log.formula.toLowerCase().includes(searchHistoryQuery.toLowerCase()) ||
    log.barberName.toLowerCase().includes(searchHistoryQuery.toLowerCase())
  );

  // Toggle Mode VIP vs Guest
  const toggleSimulation = (targetMode) => {
    if (targetMode === 'vip') {
      setIsMember(true);
      setMemberData({
        id: 16,
        name: 'Raditya Pratama',
        email: 'raditya.pratama@noiratelier.id',
        tier: 'Platinum VIP',
        tier_badge: 'PLATINUM VIP',
        tier_code: 'TIER 01',
        points: '4.850 PTS',
        card_number: 'GILT-8839-0021',
        valid_thru: '12 / 2028',
        phone: '+62 811-9874-2091',
        avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&auto=format&fit=crop&q=80',
        join_date: 'Maret 2024',
        preferred_barber: 'Yudha P.',
        status_reservasi: 'Ready',
        completed_cuts: 24,
      });
      setActiveReservation({
        id: 'AG-2025-8891',
        nomor_antrean: 'A-016',
        status: 'Sesi Sedang Berlangsung',
        est_pelayanan: 'Est. Selesai 17:45 WIB',
        jam_pelayanan: '16:30 WIB',
        barber: {
          name: 'Yudha Pratama',
          kursi: 'Kursi 02 • Senopati Suite',
          experience: 'Senior Artisan (12 thn)',
        },
        paket: {
          name: 'Bespoke Royal Cut',
          kategori: 'Hair Architecture & Facial Towel',
          durasi: '60 Menit',
          harga: 250000,
          harga_formatted: 'Rp 250.000',
        },
        lokasi: 'Senopati Suites No. 42, Kebayoran Baru',
        kota: 'Jakarta Selatan',
        qr_code: 'AG-PASS-016',
        tanggal: 'Kamis, 25 Okt 2025',
      });
      showToast('Pusat Informasi: Menampilkan status member langganan Raditya Pratama');
    } else {
      setIsMember(false);
      setMemberData(null);
      setActiveReservation(null);
      showToast('Pusat Informasi: Menampilkan panduan dan status untuk pengunjung umum');
    }
  };

  // Handler Konfirmasi Reservasi Cepat
  const handleConfirmReservation = () => {
    const queueNo = 'A-0' + Math.floor(Math.random() * 20 + 18);
    const newRes = {
      id: 'AG-2025-' + Math.floor(Math.random() * 8999 + 1000),
      nomor_antrean: queueNo,
      status: 'Sesi Terjadwal & Dikonfirmasi',
      est_pelayanan: `Est. Pelayanan ${selectedTimeSlot} WIB`,
      jam_pelayanan: `${selectedTimeSlot} WIB`,
      barber: {
        name: currentBarberName,
        kursi: selectedBranch === 'senopati' ? 'Kursi 02 • Senopati Suite' : 'Kursi 01 • Kebayoran Branch',
        experience: 'Master Barber on Duty',
      },
      paket: {
        name: activeSelectedServicesData.map(s => s.title).join(' + '),
        kategori: 'Private Suite Grooming',
        durasi: `${totalDuration} Menit`,
        harga: grandTotal,
        harga_formatted: formatRupiah(grandTotal),
      },
      lokasi: selectedBranch === 'senopati' ? 'Jl. Senopati No. 42, Kebayoran Baru' : 'Jl. Bumi No. 18, Kebayoran Lama',
      kota: 'Jakarta Selatan',
      qr_code: `AG-PASS-${queueNo}`,
      tanggal: `${datesList[selectedDateIndex].day} ${datesList[selectedDateIndex].month} 2025`,
    };

    setActiveReservation(newRes);
    setActiveTab('tiket');
    showToast(`Reservasi berhasil dikonfirmasi! Membuka Tiket Antrean: ${queueNo}`);
  };

  return (
    <div className="min-h-screen bg-[#090d14] text-slate-100 font-sans selection:bg-amber-500 selection:text-black">
      <Head title="Atelier Gilt — Haute Grooming Concierge" />

      {/* =========================================================
          TOAST NOTIFICATION
      ========================================================= */}
      {toastMessage && (
        <div className="fixed bottom-6 right-6 z-50 bg-[#161f30] border border-amber-500/40 text-amber-200 px-5 py-3.5 rounded-xl shadow-2xl flex items-center gap-3">
          <Sparkles className="w-5 h-5 text-amber-400 shrink-0" />
          <span className="text-sm font-medium">{toastMessage}</span>
          <button onClick={() => setToastMessage(null)} className="ml-2 text-slate-400 hover:text-white">
            <X className="w-4 h-4" />
          </button>
        </div>
      )}

      {/* =========================================================
          TOP BAR STATUS INFORMASI
      ========================================================= */}
      <div className="bg-[#0f1522] border-b border-slate-800/80 px-4 py-1.5 text-xs">
        <div className="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
          <div className="flex items-center gap-2 text-slate-400">
            <span className="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span className="text-slate-300 font-medium">Pusat Informasi Pengunjung:</span>
            <span className="text-amber-300 font-medium">
              {isMember ? `Informasi Langganan (${memberData?.name || 'Raditya Pratama'})` : 'Informasi Pengunjung Umum (Tanpa Akun)'}
            </span>
          </div>
          <div className="flex items-center gap-2">
            <span className="text-slate-400">Pilih Mode Informasi:</span>
            <button
              onClick={() => toggleSimulation('vip')}
              className={`px-2.5 py-1 rounded text-[11px] font-medium transition-all ${
                isMember
                  ? 'bg-amber-500 text-slate-950 font-semibold shadow-sm'
                  : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
              }`}
            >
              ⭐ Member VIP (Raditya)
            </button>
            <button
              onClick={() => toggleSimulation('guest')}
              className={`px-2.5 py-1 rounded text-[11px] font-medium transition-all ${
                !isMember
                  ? 'bg-amber-500 text-slate-950 font-semibold shadow-sm'
                  : 'bg-slate-800 text-slate-300 hover:bg-slate-700'
              }`}
            >
              👤 Pengunjung Umum
            </button>
            {auth?.isAdmin && (
              <a
                href="/barbershop/dashboard"
                className="ml-2 text-[11px] text-amber-400 hover:text-amber-300 underline font-medium flex items-center gap-1"
              >
                Dashboard Admin ↗
              </a>
            )}
          </div>
        </div>
      </div>

      {/* =========================================================
          MAIN NAVIGATION HEADER
      ========================================================= */}
      <header className="sticky top-0 z-40 bg-[#0d121c]/95 backdrop-blur-md border-b border-slate-800/80">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
          
          {/* Logo Brand */}
          <div
            onClick={() => setActiveTab('beranda')}
            className="flex items-center gap-3 cursor-pointer"
          >
            <div className="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-400 via-amber-600 to-amber-700 p-0.5 shadow-lg shadow-amber-950/40">
              <div className="w-full h-full bg-[#0d121c] rounded-[7px] flex items-center justify-center">
                <Scissors className="w-5 h-5 text-amber-400" />
              </div>
            </div>
            <div>
              <div className="text-lg font-serif font-bold tracking-wider text-white">
                ATELIER GILT
              </div>
              <div className="text-[10px] font-semibold tracking-[0.25em] text-amber-400/90 uppercase -mt-0.5">
                GROOMING CONCIERGE
              </div>
            </div>
          </div>

          {/* Navigation Links (Pill Style) */}
          <nav className="hidden md:flex items-center gap-1 bg-[#141b29] p-1.5 rounded-full border border-slate-800/90 text-sm">
            {/* Tab 1: Beranda */}
            <button
              onClick={() => setActiveTab('beranda')}
              className={`px-5 py-1.5 rounded-full font-medium transition-all ${
                activeTab === 'beranda'
                  ? 'bg-[#1e2738] text-white shadow-sm border border-slate-700/60'
                  : 'text-slate-300 hover:text-white hover:bg-slate-800/50'
              }`}
            >
              Beranda
            </button>

            {/* Tab 2: Reservasi Cepat */}
            <button
              onClick={() => setActiveTab('reservasi')}
              className={`px-5 py-1.5 rounded-full font-medium transition-all ${
                activeTab === 'reservasi'
                  ? 'bg-[#1e2738] text-amber-300 border border-amber-500/50 shadow-sm'
                  : 'text-slate-300 hover:text-white hover:bg-slate-800/50'
              }`}
            >
              Reservasi Cepat
            </button>

            {/* Tab 3: Tiket Antrean */}
            <button
              onClick={() => setActiveTab('tiket')}
              className={`px-5 py-1.5 rounded-full font-medium transition-all flex items-center gap-1.5 ${
                activeTab === 'tiket'
                  ? 'bg-[#1e2738] text-amber-300 border border-amber-500/50 shadow-sm'
                  : 'text-slate-300 hover:text-white hover:bg-slate-800/50'
              }`}
            >
              <span>Tiket Antrean</span>
              <span className="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
            </button>

            {/* Tab 4: Riwayat & Profil (Highlighted when active) */}
            <button
              onClick={() => setActiveTab('profil')}
              className={`px-5 py-1.5 rounded-full font-medium transition-all ${
                activeTab === 'profil'
                  ? 'bg-[#1e2738] text-amber-300 border border-amber-500/50 shadow-sm'
                  : 'text-slate-300 hover:text-white hover:bg-slate-800/50'
              }`}
            >
              Riwayat & Profil
            </button>
          </nav>

          {/* Right User Actions (VIP Pill, Notification, Avatar) */}
          <div className="flex items-center gap-3">
            {isMember ? (
              <>
                <div className="hidden sm:flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-amber-500/10 via-amber-500/20 to-amber-500/10 border border-amber-500/40 text-amber-300 text-xs font-semibold tracking-wider">
                  <Award className="w-3.5 h-3.5 text-amber-400" />
                  <span>{memberData?.tier_badge || 'PLATINUM VIP'}</span>
                </div>

                <button
                  onClick={() => showToast(`Pemberitahuan: Sesi pelayanan dijadwalkan pukul ${activeReservation?.jam_pelayanan || '16:30 WIB'}.`)}
                  className="w-10 h-10 rounded-full bg-[#141b29] border border-slate-800 flex items-center justify-center text-slate-300 hover:text-amber-400 hover:border-amber-500/40 transition-colors relative"
                  title="Notifikasi Antrean"
                >
                  <Bell className="w-4 h-4" />
                  <span className="absolute top-2.5 right-2.5 w-2 h-2 rounded-full bg-amber-400"></span>
                </button>

                <div className="relative">
                  <button
                    onClick={() => setShowUserDropdown(!showUserDropdown)}
                    className="w-10 h-10 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-amber-300 hover:ring-2 hover:ring-amber-500/40 transition-all overflow-hidden"
                  >
                    {memberData?.avatar ? (
                      <img src={memberData.avatar} alt="Avatar" className="w-full h-full object-cover" />
                    ) : (
                      <User className="w-5 h-5 text-amber-400" />
                    )}
                  </button>

                  {showUserDropdown && (
                    <div className="absolute right-0 mt-3 w-64 rounded-2xl bg-[#141b29] border border-slate-700/80 shadow-2xl p-3 z-50 animate-in fade-in slide-in-from-top-2">
                      <div className="px-3 py-2 border-b border-slate-800 mb-2">
                        <div className="text-sm font-semibold text-white">{memberData?.name || 'Raditya Pratama'}</div>
                        <div className="text-xs text-amber-400 font-medium">{memberData?.tier || 'Platinum VIP'} • {memberData?.points || '4.850 PTS'}</div>
                        <div className="text-[11px] text-slate-400 mt-0.5">{memberData?.email || 'raditya.pratama@noiratelier.id'}</div>
                      </div>

                      <button
                        onClick={() => {
                          setShowUserDropdown(false);
                          setActiveTab('profil');
                        }}
                        className="w-full text-left px-3 py-2 rounded-lg text-xs text-slate-200 hover:bg-slate-800 flex items-center justify-between"
                      >
                        <span>Riwayat Treatment & Kartu VIP</span>
                        <User className="w-3.5 h-3.5 text-amber-400" />
                      </button>

                      <button
                        onClick={() => {
                          setShowUserDropdown(false);
                          setActiveTab('tiket');
                        }}
                        className="w-full text-left px-3 py-2 rounded-lg text-xs text-slate-200 hover:bg-slate-800 flex items-center justify-between"
                      >
                        <span>Lihat e-Pass / Tiket Antrean</span>
                        <QrCode className="w-3.5 h-3.5 text-amber-400" />
                      </button>

                      <button
                        onClick={() => {
                          setShowUserDropdown(false);
                          setActiveTab('reservasi');
                        }}
                        className="w-full text-left px-3 py-2 rounded-lg text-xs text-slate-200 hover:bg-slate-800 flex items-center justify-between"
                      >
                        <span>Reservasi Sesi Grooming</span>
                        <Calendar className="w-3.5 h-3.5 text-amber-400" />
                      </button>

                      <button
                        onClick={() => {
                          setShowUserDropdown(false);
                          setShowProductsModal(true);
                        }}
                        className="w-full text-left px-3 py-2 rounded-lg text-xs text-slate-200 hover:bg-slate-800 flex items-center justify-between"
                      >
                        <span>Informasi Produk Grooming</span>
                        <ShoppingBag className="w-3.5 h-3.5 text-slate-400" />
                      </button>

                      <button
                        onClick={() => {
                          setShowUserDropdown(false);
                          setShowConsultModal(true);
                        }}
                        className="w-full text-left px-3 py-2 rounded-lg text-xs text-slate-200 hover:bg-slate-800 flex items-center justify-between"
                      >
                        <span>Konsultasi Concierge</span>
                        <MessageSquare className="w-3.5 h-3.5 text-slate-400" />
                      </button>

                      {auth?.isAdmin && (
                        <a
                          href="/barbershop/dashboard"
                          className="block px-3 py-2 rounded-lg text-xs text-amber-300 hover:bg-amber-500/10 font-medium"
                        >
                          Buka Dashboard Admin Barbershop ↗
                        </a>
                      )}

                      <div className="border-t border-slate-800 mt-2 pt-2">
                        <button
                          onClick={() => {
                            setShowUserDropdown(false);
                            toggleSimulation('guest');
                          }}
                          className="w-full text-left px-3 py-2 rounded-lg text-xs text-slate-400 hover:text-white hover:bg-slate-800 flex items-center gap-2"
                        >
                          <LogOut className="w-3.5 h-3.5 text-slate-400" />
                          <span>Beralih ke Pengunjung Umum</span>
                        </button>
                      </div>
                    </div>
                  )}
                </div>
              </>
            ) : (
              <div className="flex items-center gap-2">
                <button
                  onClick={() => setShowLoginModal(true)}
                  className="px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold text-xs transition-all shadow-lg shadow-amber-950/30 flex items-center gap-1.5"
                >
                  <LogIn className="w-3.5 h-3.5" />
                  <span>Login Langganan / VIP</span>
                </button>
              </div>
            )}
          </div>
        </div>
      </header>

      {/* =========================================================
          VIEW A: TAB BERANDA (SCREEN 1)
      ========================================================= */}
      {activeTab === 'beranda' && (
        <>
          <section id="beranda" className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
            <div className="flex flex-col md:flex-row md:items-center justify-between gap-6">
              <div className="max-w-2xl">
                <div className="text-xs font-semibold tracking-[0.2em] text-amber-400/90 uppercase mb-2 flex items-center gap-2">
                  <span>SARTORIAL CONCIERGE PRIVÉ</span>
                  <span className="text-slate-600">•</span>
                  <span className="text-slate-300">{suiteInfo.branch_name || 'Senopati Suite, Jakarta Selatan'}</span>
                </div>

                <h1 className="text-3xl sm:text-4xl font-serif text-white tracking-tight">
                  {isMember ? (
                    <>
                      Selamat Datang kembali,{' '}
                      <span className="italic font-serif font-normal text-amber-200">
                        {memberData?.name || 'Raditya Pratama'}
                      </span>
                    </>
                  ) : (
                    <>
                      Selamat Datang di{' '}
                      <span className="italic font-serif font-normal text-amber-200">
                        Atelier Gilt Concierge
                      </span>
                    </>
                  )}
                </h1>

                <p className="mt-2 text-sm text-slate-400 leading-relaxed">
                  Kursi eksklusif dan ritual relaksasi rambut Anda siap disajikan dengan presisi tertinggi hari ini.
                </p>
              </div>

              <div className="flex items-center gap-4">
                <div className="bg-[#121824] border border-slate-800/90 rounded-2xl px-5 py-3.5 flex items-center gap-3.5 shadow-xl">
                  <div className="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400">
                    <Award className="w-5 h-5 text-amber-400" />
                  </div>
                  <div>
                    <div className="text-[10px] font-semibold tracking-wider text-slate-400 uppercase">
                      KEANGGOTAAN
                    </div>
                    <div className="text-sm font-bold text-white tracking-wide">
                      {isMember ? (memberData?.tier || 'Platinum VIP') : 'Tamu Reguler'}
                    </div>
                  </div>
                </div>

                <div className="bg-[#121824] border border-slate-800/90 rounded-2xl px-5 py-3.5 flex items-center gap-3.5 shadow-xl">
                  <div className="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400">
                    <Star className="w-5 h-5 text-amber-400 fill-amber-400/20" />
                  </div>
                  <div>
                    <div className="text-[10px] font-semibold tracking-wider text-slate-400 uppercase">
                      GILT POINTS
                    </div>
                    <div className="text-sm font-bold text-white tracking-wide">
                      {isMember ? (
                        memberData?.points || '4.850 PTS'
                      ) : (
                        <span className="text-amber-400 text-xs font-semibold cursor-pointer" onClick={() => setShowLoginModal(true)}>
                          +Gabung VIP
                        </span>
                      )}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
              
              {/* Card 1: Reservasi Hari Ini Aktif */}
              <div className="lg:col-span-7 bg-[#101622] border border-slate-800/90 rounded-3xl p-6 md:p-7 flex flex-col justify-between shadow-2xl relative overflow-hidden">
                <div className="absolute top-0 right-0 w-72 h-72 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

                <div className="flex items-center justify-between pb-5 border-b border-slate-800/80">
                  <div className="flex items-center gap-2 text-xs font-semibold tracking-widest uppercase text-amber-400">
                    <span className="w-2.5 h-2.5 rounded-full bg-amber-400 animate-ping"></span>
                    <span>RESERVASI HARI INI AKTIF</span>
                  </div>
                  <div className="px-3.5 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs font-medium">
                    Dikonfirmasi • Menunggu Giliran
                  </div>
                </div>

                <div className="py-6 grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                  <div className="md:col-span-5 bg-[#141b29] border border-slate-800 rounded-2xl p-5 text-center flex flex-col items-center justify-center">
                    <div className="text-[11px] font-semibold tracking-wider text-slate-400 uppercase">
                      NOMOR ANTREAN ANDA
                    </div>
                    <div className="text-4xl sm:text-5xl font-serif font-bold text-amber-100 tracking-wider my-1.5">
                      {activeReservation?.nomor_antrean || 'A-016'}
                    </div>
                    <div className="text-xs text-slate-400 flex items-center gap-1.5">
                      <Clock className="w-3.5 h-3.5 text-amber-400" />
                      <span>{activeReservation?.est_pelayanan || 'Est. Pelayanan 16:30 WIB'}</span>
                    </div>
                  </div>

                  <div className="md:col-span-7 space-y-4">
                    <div className="flex items-start gap-3.5">
                      <div className="w-9 h-9 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 shrink-0 mt-0.5">
                        <UserCheck className="w-4 h-4 text-amber-400" />
                      </div>
                      <div>
                        <div className="text-[10px] font-bold tracking-widest text-amber-400/90 uppercase">
                          SPESIALIS PENATA RAMBUT
                        </div>
                        <div className="text-sm font-semibold text-white">
                          {activeReservation?.barber?.name || 'Master Barber Yudha Pratama'}
                        </div>
                        <div className="text-xs text-slate-400">
                          {activeReservation?.barber?.kursi || 'Kursi VIP 02 • The Atelier Main Floor'}
                        </div>
                      </div>
                    </div>

                    <div className="flex items-start gap-3.5">
                      <div className="w-9 h-9 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 shrink-0 mt-0.5">
                        <Scissors className="w-4 h-4 text-amber-400" />
                      </div>
                      <div>
                        <div className="text-[10px] font-bold tracking-widest text-amber-400/90 uppercase">
                          PAKET TERPILIH
                        </div>
                        <div className="text-sm font-semibold text-white">
                          {activeReservation?.paket?.name || 'The Executive Royal Cut & Hot Towel Finish'}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div className="pt-5 border-t border-slate-800/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                  <div className="flex items-center gap-2 text-xs text-slate-400">
                    <MapPin className="w-3.5 h-3.5 text-amber-400 shrink-0" />
                    <span>{suiteInfo.full_address || 'Senopati Suites No. 18, Kebayoran Baru'}</span>
                  </div>
                  <button
                    onClick={() => setActiveTab('tiket')}
                    className="px-5 py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs tracking-wide transition-all shadow-lg shadow-amber-950/40 flex items-center justify-center gap-1.5"
                  >
                    <span>Lihat e-Pass / Tiket</span>
                    <ArrowRight className="w-3.5 h-3.5" />
                  </button>
                </div>
              </div>

              {/* Card 2: Sistem Penjadwalan Instan */}
              <div className="lg:col-span-5 flex flex-col gap-4">
                <div
                  onClick={() => setActiveTab('reservasi')}
                  className="bg-gradient-to-br from-amber-400 via-amber-400 to-amber-500 text-slate-950 rounded-3xl p-6 cursor-pointer hover:shadow-2xl hover:shadow-amber-500/20 transition-all group flex items-start justify-between"
                >
                  <div>
                    <div className="text-[10px] font-bold tracking-[0.2em] text-amber-950 uppercase">
                      SISTEM PENJADWALAN INSTAN
                    </div>
                    <div className="text-2xl font-bold font-serif tracking-tight text-slate-950 mt-1">
                      Buat Reservasi Baru
                    </div>
                    <div className="text-xs text-amber-950/80 mt-1">
                      Pilih barber, tanggal & paket treatment berikutnya
                    </div>
                  </div>

                  <div className="w-11 h-11 rounded-2xl bg-amber-300 border border-amber-500/40 flex items-center justify-center text-slate-950 shadow-md group-hover:scale-110 transition-transform shrink-0">
                    <Calendar className="w-5 h-5 text-slate-950" />
                  </div>
                </div>

                <div className="grid grid-cols-2 gap-4">
                  <div
                    onClick={() => setShowProductsModal(true)}
                    className="bg-[#101622] border border-slate-800/90 rounded-2xl p-5 hover:border-amber-500/40 transition-all cursor-pointer group"
                  >
                    <div className="w-8 h-8 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 mb-3 group-hover:scale-110 transition-transform">
                      <ShoppingBag className="w-4 h-4 text-amber-400" />
                    </div>
                    <div className="text-sm font-semibold text-white group-hover:text-amber-300 transition-colors">
                      Produk Grooming
                    </div>
                    <div className="text-xs text-slate-400 mt-0.5">
                      Pomade, beard oil, & cologne
                    </div>
                  </div>

                  <div
                    onClick={() => setShowConsultModal(true)}
                    className="bg-[#101622] border border-slate-800/90 rounded-2xl p-5 hover:border-amber-500/40 transition-all cursor-pointer group"
                  >
                    <div className="w-8 h-8 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 mb-3 group-hover:scale-110 transition-transform">
                      <MessageSquare className="w-4 h-4 text-amber-400" />
                    </div>
                    <div className="text-sm font-semibold text-white group-hover:text-amber-300 transition-colors">
                      Konsultasi Gaya
                    </div>
                    <div className="text-xs text-slate-400 mt-0.5">
                      Diskusi langsung concierge
                    </div>
                  </div>
                </div>

                <div className="bg-[#101622] border border-slate-800/80 rounded-2xl px-5 py-3.5 flex items-center justify-between text-xs">
                  <div className="flex items-center gap-2 text-slate-300">
                    <span className="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>Kapasitas Kursi Atelier Hari Ini:</span>
                  </div>
                  <div className="font-semibold text-amber-300 tracking-wider">
                    {suiteInfo.chair_status_text || '4 KURSI KOSONG DARI 8'}
                  </div>
                </div>
              </div>

            </div>
          </section>

          {/* Section: Menu Perawatan Signature */}
          <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
            <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-2 mb-6">
              <div>
                <div className="text-[10px] font-semibold tracking-[0.25em] text-amber-400 uppercase">
                  MENU PERAWATAN SIGNATURE
                </div>
                <h2 className="text-2xl sm:text-3xl font-serif text-white tracking-tight mt-1">
                  Layanan Terpopuler
                </h2>
              </div>
              <button
                onClick={() => setActiveTab('reservasi')}
                className="text-xs font-medium text-amber-400 hover:text-amber-300 flex items-center gap-1.5 transition-colors self-start sm:self-auto"
              >
                <span>Lihat Seluruh Katalog Perawatan</span>
                <ArrowRight className="w-3.5 h-3.5" />
              </button>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
              {services.map((item, idx) => (
                <div
                  key={item.id || idx}
                  className="bg-[#101622] border border-slate-800/90 rounded-3xl overflow-hidden flex flex-col justify-between hover:border-amber-500/40 hover:shadow-2xl hover:shadow-amber-950/20 transition-all group"
                >
                  <div className="relative h-52 w-full overflow-hidden bg-slate-900">
                    <img
                      src={item.image}
                      alt={item.title}
                      onError={(e) => {
                        if (item.fallback_image) {
                          e.target.src = item.fallback_image;
                        }
                      }}
                      className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-[#101622] via-transparent to-black/30"></div>
                    <div className="absolute top-4 right-4 px-3 py-1 rounded-md bg-[#0f1522]/90 backdrop-blur-md border border-amber-500/40 text-[10px] font-bold tracking-wider text-amber-300 uppercase shadow-lg">
                      {item.badge}
                    </div>
                  </div>

                  <div className="p-6 flex-1 flex flex-col justify-between">
                    <div>
                      <div className="flex items-center justify-between text-slate-400 text-[11px] font-semibold tracking-wider uppercase mb-1">
                        <span>{item.category}</span>
                        <span className="flex items-center gap-1 text-slate-400 font-normal">
                          <Clock className="w-3 h-3 text-amber-400" />
                          <span>{item.duration}</span>
                        </span>
                      </div>

                      <h3 className="text-lg font-serif font-bold text-white group-hover:text-amber-200 transition-colors mt-1">
                        {item.title}
                      </h3>

                      <p className="mt-2 text-xs text-slate-400 leading-relaxed line-clamp-3">
                        {item.description}
                      </p>
                    </div>

                    <div className="pt-5 mt-4 border-t border-slate-800/80 flex items-center justify-between">
                      <div>
                        <div className="text-[10px] font-semibold tracking-wider text-slate-400 uppercase">
                          INVESTASI DIRI
                        </div>
                        <div className="text-base sm:text-lg font-serif font-bold text-amber-200">
                          {item.price_formatted}
                        </div>
                      </div>

                      <button
                        onClick={() => {
                          if (!selectedServices.includes(item.id)) {
                            setSelectedServices([...selectedServices, item.id]);
                          }
                          setActiveTab('reservasi');
                        }}
                        className="px-4 py-2 rounded-xl bg-[#172133] hover:bg-amber-400 hover:text-slate-950 text-slate-200 text-xs font-semibold tracking-wide border border-slate-700 hover:border-amber-400 transition-all flex items-center gap-1"
                      >
                        <span>Pilih</span>
                        <span>+</span>
                      </button>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </section>

          {/* Section: Master Barber Bertugas */}
          <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-16">
            <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-2 mb-6">
              <div>
                <div className="text-[10px] font-semibold tracking-[0.25em] text-amber-400 uppercase">
                  PARA MAESTRO PENATA RAMBUT
                </div>
                <h2 className="text-2xl sm:text-3xl font-serif text-white tracking-tight mt-1">
                  Master Barber Bertugas Hari Ini
                </h2>
              </div>
              <div className="text-xs text-slate-400">
                {suiteInfo.shift || 'Atelier Senopati Suite • Shift Siang/Malam'}
              </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
              {barbers.map((barber, idx) => (
                <div
                  key={barber.id || idx}
                  className="bg-[#101622] border border-slate-800/90 rounded-3xl p-6 flex flex-col justify-between hover:border-amber-500/30 transition-all"
                >
                  <div>
                    <div className="flex items-center gap-3.5 mb-4">
                      <div className="w-14 h-14 rounded-2xl bg-slate-800 overflow-hidden border border-amber-500/30 shrink-0">
                        <img
                          src={barber.avatar}
                          alt={barber.name}
                          className="w-full h-full object-cover"
                        />
                      </div>
                      <div>
                        <div className="flex items-center gap-1.5 text-xs text-amber-400 mb-0.5">
                          <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />
                          <span className="font-bold">{barber.rating}</span>
                          <span className="text-slate-400">({barber.reviews})</span>
                        </div>
                        <div className="text-base font-serif font-bold text-white">
                          {barber.name}
                        </div>
                        <div className="text-[10px] font-semibold tracking-wider text-amber-400/90 uppercase">
                          {barber.title}
                        </div>
                        <div className="text-[11px] text-slate-400">
                          {barber.experience}
                        </div>
                      </div>
                    </div>

                    <div className="space-y-2 py-3 border-t border-slate-800/80 text-xs">
                      <div className="flex items-center justify-between">
                        <span className="text-slate-400">Spesialisasi</span>
                        <span className="text-slate-200 font-medium">{barber.specialty}</span>
                      </div>
                      <div className="flex items-center justify-between">
                        <span className="text-slate-400">Ketersediaan Kursi</span>
                        <span className="text-amber-300 font-semibold">{barber.availability}</span>
                      </div>
                    </div>
                  </div>

                  <div className="pt-4 border-t border-slate-800/80">
                    {barber.is_current_for_user ? (
                      <button
                        disabled
                        className="w-full py-2.5 rounded-xl bg-[#151c2a] text-slate-400 text-xs font-semibold flex items-center justify-center gap-1.5 border border-slate-800 cursor-default"
                      >
                        <CheckCircle className="w-3.5 h-3.5 text-amber-400" />
                        <span>Barber Anda Saat Ini</span>
                      </button>
                    ) : (
                      <button
                        onClick={() => {
                          setSelectedBarber(barber.id);
                          setActiveTab('reservasi');
                        }}
                        className="w-full py-2.5 rounded-xl bg-[#172133] hover:bg-amber-400 hover:text-slate-950 text-slate-200 text-xs font-semibold transition-all border border-slate-700 hover:border-amber-400 flex items-center justify-center gap-1.5"
                      >
                        <Calendar className="w-3.5 h-3.5" />
                        <span>Booking Barber</span>
                      </button>
                    )}
                  </div>
                </div>
              ))}
            </div>
          </section>
        </>
      )}

      {/* =========================================================
          VIEW B: TAB RESERVASI CEPAT (SCREEN 2)
      ========================================================= */}
      {activeTab === 'reservasi' && (
        <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-16">
          <div className="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
              <div className="text-xs font-semibold tracking-[0.2em] text-amber-400 uppercase flex items-center gap-2 mb-1">
                <Calendar className="w-3.5 h-3.5 text-amber-400" />
                <span>PRIVATE SUITE RESERVATION</span>
              </div>
              <h1 className="text-3xl sm:text-4xl font-serif text-white tracking-tight">
                Reservasi Sesi Grooming
              </h1>
              <p className="mt-1.5 text-xs sm:text-sm text-slate-400 leading-relaxed">
                Pengalaman pangkas rambut, pemangkasan janggut, dan spa kulit kepala eksklusif. Pilih spesialisasi dan tentukan jadwal privasi Anda.
              </p>
            </div>

            <div className="bg-[#121824] border border-slate-800/90 rounded-2xl px-5 py-3 flex items-center gap-3 shrink-0 shadow-xl self-start md:self-auto">
              <span className="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
              <div>
                <div className="text-[10px] font-semibold tracking-wider text-slate-400 uppercase">
                  KETERSEDIAAN KURSI
                </div>
                <div className="text-xs font-bold text-white tracking-wide">
                  3 Master Barber Bertugas
                </div>
              </div>
            </div>
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <div className="lg:col-span-7 space-y-6">
              
              {/* 01. Cabang */}
              <div className="bg-[#101622] border border-slate-800/90 rounded-3xl p-6 shadow-xl">
                <div className="flex items-center justify-between mb-4">
                  <div className="flex items-center gap-2">
                    <span className="text-xs font-mono font-bold text-amber-400">01</span>
                    <h2 className="text-sm font-bold text-white uppercase tracking-wider">
                      Pilih Cabang Atelier
                    </h2>
                  </div>
                  <span className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                    LOKASI SALON PRIVÉ
                  </span>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div
                    onClick={() => setSelectedBranch('senopati')}
                    className={`rounded-2xl p-4 cursor-pointer transition-all border ${
                      selectedBranch === 'senopati'
                        ? 'bg-[#151e2c] border-amber-500/60 shadow-lg shadow-amber-950/20'
                        : 'bg-[#121824] border-slate-800 hover:border-slate-700'
                    }`}
                  >
                    <div className="flex items-start justify-between">
                      <div className="flex items-center gap-2">
                        <Store className="w-4 h-4 text-amber-400 shrink-0" />
                        <span className="text-sm font-bold text-white">Senopati Atelier</span>
                      </div>
                      <div className={`w-4 h-4 rounded-full border flex items-center justify-center ${
                        selectedBranch === 'senopati' ? 'border-amber-400' : 'border-slate-600'
                      }`}>
                        {selectedBranch === 'senopati' && (
                          <div className="w-2 h-2 rounded-full bg-amber-400"></div>
                        )}
                      </div>
                    </div>
                    <div className="text-xs text-slate-400 mt-1">
                      Jl. Senopati No. 42, Kebayoran Baru
                    </div>
                    <div className="mt-3 flex items-center gap-1.5 text-[11px] text-amber-300/90">
                      <Wine className="w-3.5 h-3.5 text-amber-400" />
                      <span>Free Single-Malt & Cigar Lounge</span>
                    </div>
                  </div>

                  <div
                    onClick={() => setSelectedBranch('kebayoran')}
                    className={`rounded-2xl p-4 cursor-pointer transition-all border ${
                      selectedBranch === 'kebayoran'
                        ? 'bg-[#151e2c] border-amber-500/60 shadow-lg shadow-amber-950/20'
                        : 'bg-[#121824] border-slate-800 hover:border-slate-700'
                    }`}
                  >
                    <div className="flex items-start justify-between">
                      <div className="flex items-center gap-2">
                        <MapPin className="w-4 h-4 text-slate-400 shrink-0" />
                        <span className="text-sm font-bold text-white">Kebayoran Branch</span>
                      </div>
                      <div className={`w-4 h-4 rounded-full border flex items-center justify-center ${
                        selectedBranch === 'kebayoran' ? 'border-amber-400' : 'border-slate-600'
                      }`}>
                        {selectedBranch === 'kebayoran' && (
                          <div className="w-2 h-2 rounded-full bg-amber-400"></div>
                        )}
                      </div>
                    </div>
                    <div className="text-xs text-slate-400 mt-1">
                      Jl. Bumi No. 18, Kebayoran Lama
                    </div>
                    <div className="mt-3 flex items-center gap-1.5 text-[11px] text-slate-400">
                      <Coffee className="w-3.5 h-3.5 text-amber-400" />
                      <span>Private Valet & Espresso Bar</span>
                    </div>
                  </div>
                </div>
              </div>

              {/* 02. Layanan Utama */}
              <div className="bg-[#101622] border border-slate-800/90 rounded-3xl p-6 shadow-xl">
                <div className="flex items-center justify-between mb-4">
                  <div className="flex items-center gap-2">
                    <span className="text-xs font-mono font-bold text-amber-400">02</span>
                    <h2 className="text-sm font-bold text-white uppercase tracking-wider">
                      Pilih Layanan Utama & Perawatan
                    </h2>
                  </div>
                  <span className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                    BISA PILIH LEBIH DARI SATU
                  </span>
                </div>

                <div className="space-y-3">
                  {reservationServices.map((srv) => {
                    const isChecked = selectedServices.includes(srv.id);
                    return (
                      <div
                        key={srv.id}
                        onClick={() => toggleService(srv.id)}
                        className={`rounded-2xl p-4.5 cursor-pointer transition-all border flex items-center justify-between gap-4 ${
                          isChecked
                            ? 'bg-[#151e2c] border-amber-500/50 shadow-md'
                            : 'bg-[#121824] border-slate-800 hover:border-slate-700'
                        }`}
                      >
                        <div className="flex items-start gap-3.5 flex-1">
                          <div className="mt-1 shrink-0">
                            {isChecked ? (
                              <div className="w-5 h-5 rounded-md bg-amber-400 flex items-center justify-center text-slate-950">
                                <Check className="w-3.5 h-3.5 stroke-[3]" />
                              </div>
                            ) : (
                              <div className="w-5 h-5 rounded-md border border-slate-600 bg-transparent"></div>
                            )}
                          </div>
                          <div>
                            <div className="flex items-center gap-2">
                              <span className="text-sm font-bold text-white">{srv.title}</span>
                              {srv.badge && (
                                <span className={`text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider ${
                                  srv.badgeColor === 'amber'
                                    ? 'bg-amber-500/20 text-amber-300 border border-amber-500/30'
                                    : 'bg-slate-800 text-slate-300 border border-slate-700'
                                }`}>
                                  {srv.badge}
                                </span>
                              )}
                            </div>
                            <p className="text-xs text-slate-400 mt-1 line-clamp-2 leading-relaxed">
                              {srv.desc}
                            </p>
                            <div className="text-[11px] text-slate-500 mt-1.5 flex items-center gap-1">
                              <Clock className="w-3 h-3 text-amber-400" />
                              <span>{srv.duration}</span>
                            </div>
                          </div>
                        </div>

                        <div className="text-right shrink-0">
                          <div className="text-lg font-serif font-bold text-amber-300">
                            {srv.priceLabel}
                          </div>
                          <div className="text-[10px] text-slate-500">
                            {srv.sublabel}
                          </div>
                        </div>
                      </div>
                    );
                  })}
                </div>
              </div>

              {/* 03. Master Barber */}
              <div className="bg-[#101622] border border-slate-800/90 rounded-3xl p-6 shadow-xl">
                <div className="flex items-center justify-between mb-4">
                  <div className="flex items-center gap-2">
                    <span className="text-xs font-mono font-bold text-amber-400">03</span>
                    <h2 className="text-sm font-bold text-white uppercase tracking-wider">
                      Pilih Master Barber
                    </h2>
                  </div>
                  <span className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                    ARTISAN STYLIST
                  </span>
                </div>

                <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
                  {fastBarbers.map((b) => {
                    const isBarberSelected = selectedBarber === b.id;
                    return (
                      <div
                        key={b.id}
                        onClick={() => setSelectedBarber(b.id)}
                        className={`rounded-2xl p-4 cursor-pointer text-center transition-all border flex flex-col items-center justify-center ${
                          isBarberSelected
                            ? 'bg-[#151e2c] border-amber-500/60 shadow-lg shadow-amber-950/20'
                            : 'bg-[#121824] border-slate-800 hover:border-slate-700'
                        }`}
                      >
                        {b.isSpecial ? (
                          <div className="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 mb-2">
                            <Zap className="w-6 h-6 fill-amber-400 text-amber-400" />
                          </div>
                        ) : (
                          <div className="w-12 h-12 rounded-xl overflow-hidden border border-amber-500/30 mb-2">
                            <img src={b.avatar} alt={b.name} className="w-full h-full object-cover" />
                          </div>
                        )}

                        <div className="text-xs font-bold text-white">{b.name}</div>
                        <div className="text-[10px] text-slate-400 mt-0.5">{b.role}</div>

                        {b.rating ? (
                          <div className="mt-1 text-[11px] text-amber-400 font-bold flex items-center gap-0.5">
                            <Star className="w-3 h-3 fill-amber-400 text-amber-400" />
                            <span>{b.rating}</span>
                          </div>
                        ) : (
                          <div className="mt-1 text-[10px] font-bold text-amber-400 uppercase tracking-wider">
                            {b.status}
                          </div>
                        )}
                      </div>
                    );
                  })}
                </div>
              </div>

              {/* 04. Tanggal & Slot */}
              <div className="bg-[#101622] border border-slate-800/90 rounded-3xl p-6 shadow-xl">
                <div className="flex items-center justify-between mb-4">
                  <div className="flex items-center gap-2">
                    <span className="text-xs font-mono font-bold text-amber-400">04</span>
                    <h2 className="text-sm font-bold text-white uppercase tracking-wider">
                      Pilih Tanggal & Slot Jam
                    </h2>
                  </div>
                  <span className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                    ZONA WAKTU WIB
                  </span>
                </div>

                <div className="grid grid-cols-3 sm:grid-cols-6 gap-2 mb-6">
                  {datesList.map((d, idx) => {
                    const isDateSelected = selectedDateIndex === idx;
                    return (
                      <div
                        key={idx}
                        onClick={() => setSelectedDateIndex(idx)}
                        className={`rounded-xl p-3 cursor-pointer text-center transition-all border ${
                          isDateSelected
                            ? 'bg-[#162132] border-amber-500 text-white shadow-md'
                            : 'bg-[#121824] border-slate-800 hover:border-slate-700 text-slate-400'
                        }`}
                      >
                        <div className="text-[9px] font-bold tracking-wider uppercase text-amber-400 mb-0.5">
                          {d.label}
                        </div>
                        <div className="text-2xl font-serif font-bold text-white">
                          {d.day}
                        </div>
                        <div className="text-[10px] text-slate-400">
                          {d.month}
                        </div>
                      </div>
                    );
                  })}
                </div>

                <div>
                  <div className="text-[10px] font-bold tracking-widest text-slate-500 uppercase mb-2">
                    SLOT SORE & MALAM TERSEDIA
                  </div>
                  <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    {timeSlots.map((slot, sIdx) => {
                      const isSlotSelected = selectedTimeSlot === slot.time;
                      return (
                        <div
                          key={sIdx}
                          onClick={() => setSelectedTimeSlot(slot.time)}
                          className={`rounded-xl p-3 cursor-pointer text-center transition-all border ${
                            isSlotSelected
                              ? 'bg-[#162132] border-amber-500 text-amber-300 shadow-md'
                              : 'bg-[#121824] border-slate-800 hover:border-slate-700 text-slate-300'
                          }`}
                        >
                          <div className="text-sm font-bold text-white">{slot.time}</div>
                          <div className={`text-[10px] mt-0.5 ${
                            isSlotSelected ? 'text-amber-400 font-semibold' : 'text-slate-500'
                          }`}>
                            {slot.status}
                          </div>
                        </div>
                      );
                    })}
                  </div>
                </div>
              </div>

            </div>

            {/* Kolom Kanan: Live Summary */}
            <div className="lg:col-span-5 space-y-4 sticky top-28">
              <div className="bg-[#101622] border border-slate-800/90 rounded-3xl p-6 shadow-2xl">
                <div className="flex items-center justify-between pb-4 border-b border-slate-800">
                  <div className="flex items-center gap-2">
                    <Tag className="w-4 h-4 text-amber-400" />
                    <h3 className="text-sm font-bold text-white uppercase tracking-wider">
                      Rincian Reservasi
                    </h3>
                  </div>
                  <span className="text-[10px] font-bold tracking-widest text-amber-400 uppercase">
                    LIVE SUMMARY
                  </span>
                </div>

                <div className="bg-[#141b29] border border-slate-800 rounded-2xl p-4 my-4 space-y-3 text-xs">
                  <div className="flex items-start justify-between">
                    <div>
                      <div className="text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                        LOKASI OUTLET
                      </div>
                      <div className="text-sm font-bold text-white mt-0.5">
                        {selectedBranch === 'senopati' ? 'Senopati Atelier' : 'Kebayoran Branch'}
                      </div>
                      <div className="text-slate-400 text-[11px]">
                        {selectedBranch === 'senopati' ? 'Jl. Senopati No. 42, Kebayoran Baru' : 'Jl. Bumi No. 18, Kebayoran Lama'}
                      </div>
                    </div>
                    <Store className="w-4 h-4 text-slate-400 shrink-0" />
                  </div>

                  <div className="pt-2 border-t border-slate-800/80 grid grid-cols-2 gap-2 text-[11px]">
                    <div>
                      <div className="text-slate-500 uppercase text-[9px] font-bold tracking-wider">
                        TANGGAL & WAKTU
                      </div>
                      <div className="text-white font-semibold mt-0.5">
                        {datesList[selectedDateIndex].day} {datesList[selectedDateIndex].month} 2025 • {selectedTimeSlot} WIB
                      </div>
                    </div>
                    <div>
                      <div className="text-slate-500 uppercase text-[9px] font-bold tracking-wider">
                        MASTER STYLIST
                      </div>
                      <div className="text-amber-300 font-semibold mt-0.5 truncate">
                        {currentBarberName}
                      </div>
                    </div>
                  </div>
                </div>

                <div className="py-2 border-b border-slate-800 text-xs">
                  <div className="flex items-center justify-between text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-2">
                    <span>PERAWATAN DIPILIH</span>
                    <span className="text-amber-400">Estimasi {totalDuration} Menit</span>
                  </div>
                  <div className="space-y-1.5">
                    {activeSelectedServicesData.map((s) => (
                      <div key={s.id} className="flex justify-between text-slate-300">
                        <span>{s.title}</span>
                        <span className="font-semibold text-white">{formatRupiah(s.price)}</span>
                      </div>
                    ))}
                  </div>
                </div>

                <div className="py-3 border-b border-slate-800">
                  <div className="flex gap-2">
                    <input
                      type="text"
                      placeholder="KODE PROMO / PRIVILEGE PASS"
                      value={promoCode}
                      onChange={(e) => setPromoCode(e.target.value)}
                      className="bg-[#141b29] border border-slate-700 rounded-xl px-3 py-2 text-xs text-white uppercase placeholder-slate-500 focus:outline-none focus:border-amber-400 flex-1 tracking-wider"
                    />
                    <button
                      onClick={() => {
                        if (promoCode.trim()) {
                          setPromoApplied(true);
                          showToast('Kode Privilege berhasil diterapkan!');
                        }
                      }}
                      className="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs transition-colors"
                    >
                      Pakai
                    </button>
                  </div>

                  <div
                    onClick={() => setRedeemVipPoints(!redeemVipPoints)}
                    className="mt-3 flex items-center justify-between cursor-pointer p-2 rounded-xl bg-[#141b29] border border-slate-800 hover:border-amber-500/40 transition-colors"
                  >
                    <div className="flex items-center gap-2">
                      <Award className="w-4 h-4 text-amber-400" />
                      <div>
                        <div className="text-xs font-semibold text-white">Tukarkan 250 Poin VIP</div>
                        <div className="text-[10px] text-slate-400">Potongan langsung Rp 25.000</div>
                      </div>
                    </div>
                    <div className={`w-4 h-4 rounded border flex items-center justify-center ${
                      redeemVipPoints ? 'bg-amber-400 border-amber-400 text-slate-950' : 'border-slate-600'
                    }`}>
                      {redeemVipPoints && <Check className="w-3 h-3 stroke-[3]" />}
                    </div>
                  </div>
                </div>

                <div className="py-3 border-b border-slate-800">
                  <div className="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">
                    METODE BOOKING & JAMINAN KURSI
                  </div>
                  <div className="grid grid-cols-2 gap-2 text-xs">
                    <div
                      onClick={() => setPaymentOption('dp')}
                      className={`p-3 rounded-xl border cursor-pointer transition-all ${
                        paymentOption === 'dp'
                          ? 'bg-[#151e2c] border-amber-500 text-white'
                          : 'bg-[#141b29] border-slate-800 text-slate-400'
                      }`}
                    >
                      <div className="flex items-center justify-between">
                        <span className="text-[10px] font-bold uppercase">BAYAR DP ONLINE</span>
                        <QrCode className="w-3.5 h-3.5 text-amber-400" />
                      </div>
                      <div className="text-sm font-bold text-amber-300 mt-1">
                        Rp 100.000
                      </div>
                      <div className="text-[9px] text-slate-400 mt-0.5">
                        Sisa dibayar di salon via QRIS / CC
                      </div>
                    </div>

                    <div
                      onClick={() => setPaymentOption('tempat')}
                      className={`p-3 rounded-xl border cursor-pointer transition-all ${
                        paymentOption === 'tempat'
                          ? 'bg-[#151e2c] border-amber-500 text-white'
                          : 'bg-[#141b29] border-slate-800 text-slate-400'
                      }`}
                    >
                      <div className="flex items-center justify-between">
                        <span className="text-[10px] font-bold uppercase">BAYAR DI TEMPAT</span>
                        <Store className="w-3.5 h-3.5 text-slate-400" />
                      </div>
                      <div className="text-sm font-bold text-white mt-1">
                        {formatRupiah(grandTotal)}
                      </div>
                      <div className="text-[9px] text-slate-400 mt-0.5">
                        Selesaikan saat sesi selesai
                      </div>
                    </div>
                  </div>
                </div>

                <div className="py-3 space-y-1.5 text-xs border-b border-slate-800">
                  <div className="flex justify-between text-slate-400">
                    <span>Subtotal Perawatan</span>
                    <span className="text-white font-medium">{formatRupiah(subtotalPrice)}</span>
                  </div>
                  {redeemVipPoints && (
                    <div className="flex justify-between text-amber-400">
                      <span>Privilege Diskon Poin VIP</span>
                      <span>- Rp 25.000</span>
                    </div>
                  )}
                  {promoApplied && (
                    <div className="flex justify-between text-amber-400">
                      <span>Privilege Pass Promo</span>
                      <span>- Rp 30.000</span>
                    </div>
                  )}
                  <div className="flex justify-between text-slate-400">
                    <span>Biaya Layanan Concierge</span>
                    <span className="text-amber-400 font-bold uppercase">GRATIS (VIP)</span>
                  </div>
                </div>

                <div className="pt-4 pb-2 flex items-baseline justify-between">
                  <div>
                    <div className="text-xs font-semibold text-white">
                      {paymentOption === 'dp' ? 'Total Tagihan Saat Ini (DP):' : 'Total Tagihan Saat Ini:'}
                    </div>
                    <div className="text-[10px] text-slate-500">
                      Jaminan konfirmasi reservasi instan
                    </div>
                  </div>
                  <div className="text-2xl font-serif font-bold text-amber-300">
                    {paymentOption === 'dp' ? 'Rp 100.000' : formatRupiah(grandTotal)}
                  </div>
                </div>

                <div className="pt-3">
                  <button
                    onClick={handleConfirmReservation}
                    className="w-full py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-xl shadow-amber-950/40 flex items-center justify-center gap-2 transition-all"
                  >
                    <ShieldCheck className="w-4 h-4 stroke-[2.5]" />
                    <span>Konfirmasi & Kunci Jadwal</span>
                  </button>
                  <div className="text-center text-[10px] text-slate-500 mt-2 flex items-center justify-center gap-1">
                    <span>🔒</span>
                    <span>Slot langsung direservasi di kalender atelier tanpa tunggu antre.</span>
                  </div>
                </div>
              </div>

              <div className="bg-[#101622] border border-slate-800/80 rounded-2xl p-4 flex items-center gap-3">
                <div className="w-9 h-9 rounded-xl bg-slate-800 flex items-center justify-center text-amber-400 shrink-0">
                  <ShieldCheck className="w-5 h-5 text-amber-400" />
                </div>
                <div>
                  <div className="text-xs font-bold text-white">Concierge Garansi Kepuasan</div>
                  <div className="text-[11px] text-slate-400">
                    Reschedule gratis hingga 2 jam sebelum kedatangan langsung via aplikasi.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      )}

      {/* =========================================================
          VIEW C: TAB TIKET ANTREAN (SCREEN 3)
      ========================================================= */}
      {activeTab === 'tiket' && (
        <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-16">
          <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-6 border-b border-slate-800/80 mb-8">
            <div className="flex items-center gap-2 text-xs font-semibold text-amber-400">
              <span className="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
              <span className="uppercase tracking-wider">SESI SEDANG BERLANGSUNG</span>
              <span className="text-slate-600">•</span>
              <span className="text-slate-300 font-normal">Senopati Suite, Private Room 02</span>
            </div>

            <div className="flex items-center gap-3 text-xs text-slate-400">
              <span>ID RESERVASI: <strong className="text-white font-mono">{activeReservation?.id || 'AG-2025-8891'}</strong></span>
              <span className="text-slate-700">|</span>
              <span className="text-amber-400 font-semibold flex items-center gap-1">
                <CheckCircle2 className="w-3.5 h-3.5" />
                <span>Check-in Terverifikasi</span>
              </span>
            </div>
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            {/* Kolom Kiri: Digital Pass */}
            <div className="lg:col-span-5 space-y-4">
              <div className="bg-[#101622] border-t-2 border-t-amber-400 border border-slate-800/90 rounded-3xl p-6 sm:p-7 shadow-2xl relative">
                <div className="flex items-start justify-between pb-6">
                  <div>
                    <div className="text-[10px] font-bold tracking-widest text-slate-400 uppercase">
                      DIGITAL PASS SALON PRIVÉ
                    </div>
                    <div className="text-2xl font-serif font-bold text-amber-200 tracking-wider mt-0.5">
                      ATELIER GILT
                    </div>
                  </div>
                  <div className="px-3 py-1 rounded-md bg-[#182030] border border-amber-500/40 text-[10px] font-bold text-amber-300 uppercase tracking-wider">
                    PRIORITAS VIP
                  </div>
                </div>

                <div className="grid grid-cols-2 gap-4 pb-6 border-b border-slate-800/80">
                  <div>
                    <div className="text-[10px] font-bold tracking-widest text-slate-400 uppercase">
                      NOMOR ANTREAN ANDA
                    </div>
                    <div className="text-4xl sm:text-5xl font-serif font-bold text-amber-100 tracking-wider mt-1">
                      {activeReservation?.nomor_antrean || 'A-016'}
                    </div>
                  </div>
                  <div className="text-right">
                    <div className="text-[10px] font-bold tracking-widest text-slate-400 uppercase">
                      LOKASI STASIUN
                    </div>
                    <div className="text-lg font-bold text-white mt-1">
                      Kursi 02
                    </div>
                    <div className="text-xs text-slate-400">
                      Senopati Suite
                    </div>
                  </div>
                </div>

                <div className="my-6 bg-[#141b29] border border-slate-800 rounded-2xl p-4 flex items-center gap-4">
                  <div className="w-24 h-24 bg-gradient-to-br from-amber-400 via-amber-500 to-amber-600 rounded-xl p-1.5 shadow-lg shrink-0">
                    <div className="w-full h-full bg-[#0d121c] rounded-lg p-1 flex items-center justify-center">
                      <QrCode className="w-full h-full text-amber-400" />
                    </div>
                  </div>

                  <div className="space-y-1">
                    <div className="text-[10px] font-bold tracking-widest text-amber-400 uppercase flex items-center gap-1.5">
                      <Compass className="w-3.5 h-3.5" />
                      <span>PINDAI DI MEJA CONCIERGE</span>
                    </div>
                    <p className="text-xs text-slate-400 leading-relaxed">
                      Tunjukkan kode matriks ini kepada Butler atau Front Desk untuk validasi layanan salon privé Anda secara instan.
                    </p>
                    <div className="text-xs font-mono font-bold text-amber-300 pt-0.5">
                      KODE: {activeReservation?.qr_code || 'AG-PASS-016'}
                    </div>
                  </div>
                </div>

                <div className="grid grid-cols-2 gap-4 py-4 text-xs">
                  <div>
                    <div className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                      NAMA TAMU
                    </div>
                    <div className="text-sm font-bold text-white mt-0.5">
                      {activeReservation?.client_name || memberData?.name || 'Raditya Pratama'}
                    </div>
                  </div>

                  <div>
                    <div className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                      LAYANAN TERPILIH
                    </div>
                    <div className="text-sm font-bold text-amber-300 mt-0.5">
                      {activeReservation?.paket?.name || 'Bespoke Royal Cut'}
                    </div>
                  </div>

                  <div className="pt-2">
                    <div className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                      JADWAL & WAKTU
                    </div>
                    <div className="text-xs text-white font-medium mt-0.5">
                      {activeReservation?.tanggal || 'Kamis, 25 Okt 2025'}
                    </div>
                    <div className="text-amber-400 font-bold">
                      {activeReservation?.jam_pelayanan || '16:30 WIB'}
                    </div>
                  </div>

                  <div className="pt-2">
                    <div className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                      MASTER BARBER
                    </div>
                    <div className="text-xs font-bold text-white mt-0.5">
                      {activeReservation?.barber?.name || 'Yudha Pratama'}
                    </div>
                    <div className="text-[11px] text-slate-400">
                      Senior Artisan (12 thn)
                    </div>
                  </div>
                </div>

                <div className="border-t border-dashed border-slate-800 my-4"></div>

                <div className="space-y-2">
                  <button
                    onClick={() => window.print()}
                    className="w-full py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-lg flex items-center justify-center gap-2 transition-colors"
                  >
                    <Download className="w-4 h-4 stroke-[2.5]" />
                    <span>Unduh Tiket PDF</span>
                  </button>

                  <div className="grid grid-cols-2 gap-2">
                    <a
                      href={`https://wa.me/628123456789?text=Halo%20Atelier%20Gilt,%20saya%20pemegang%20tiket%20antrean%20${activeReservation?.nomor_antrean || 'A-016'}.`}
                      target="_blank"
                      rel="noreferrer"
                      className="py-2.5 rounded-xl bg-[#151e2c] border border-slate-700 hover:border-amber-500 text-xs font-semibold text-slate-200 flex items-center justify-center gap-1.5 transition-colors"
                    >
                      <MessageSquare className="w-3.5 h-3.5 text-amber-400" />
                      <span>Kirim ke WhatsApp</span>
                    </a>
                    <a
                      href="https://maps.google.com"
                      target="_blank"
                      rel="noreferrer"
                      className="py-2.5 rounded-xl bg-[#151e2c] border border-slate-700 hover:border-amber-500 text-xs font-semibold text-slate-200 flex items-center justify-center gap-1.5 transition-colors"
                    >
                      <Navigation className="w-3.5 h-3.5 text-amber-400" />
                      <span>Petunjuk Maps</span>
                    </a>
                  </div>
                </div>
              </div>

              <div className="bg-[#101622] border border-slate-800/80 rounded-2xl p-4 flex items-center justify-between">
                <div className="flex items-center gap-3">
                  <div className="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center text-amber-400 font-bold font-mono">
                    P
                  </div>
                  <div>
                    <div className="text-xs font-bold text-white">Layanan Valet Tersedia</div>
                    <div className="text-[11px] text-slate-400">Tunjukkan pass ini kepada petugas valet Senopati</div>
                  </div>
                </div>
                <div className="text-xs font-bold text-amber-400 uppercase tracking-wider">
                  Gratis
                </div>
              </div>
            </div>

            {/* Kolom Kanan: Pelacak Antrean */}
            <div className="lg:col-span-7 space-y-6">
              <div className="bg-[#101622] border border-slate-800/90 rounded-3xl p-6 sm:p-7 shadow-xl">
                <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-6 border-b border-slate-800">
                  <div>
                    <div className="text-[10px] font-bold tracking-widest text-amber-400 uppercase">
                      PELACAK ANTREAN TERPADU
                    </div>
                    <h2 className="text-2xl font-serif font-bold text-white mt-0.5">
                      Status Pelayanan Real-Time
                    </h2>
                  </div>
                  <div className="flex items-center gap-2 text-xs font-semibold text-amber-400 self-start sm:self-auto">
                    <span className="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Sinkronisasi Otomatis</span>
                  </div>
                </div>

                <div className="py-6 space-y-7 relative">
                  <div className="flex items-start gap-4 relative">
                    <div className="w-7 h-7 rounded-full bg-amber-500/20 border border-amber-500/60 flex items-center justify-center text-amber-400 shrink-0 mt-0.5 z-10">
                      <Check className="w-4 h-4 stroke-[2.5]" />
                    </div>
                    <div className="flex-1">
                      <div className="flex items-baseline justify-between">
                        <div className="text-sm font-bold text-white">Reservasi Dikonfirmasi</div>
                        <div className="text-xs text-slate-500 font-mono">14:10 WIB</div>
                      </div>
                      <p className="text-xs text-slate-400 mt-0.5 leading-relaxed">
                        Slot privat telah dikunci oleh tim concierge pusat Atelier Gilt.
                      </p>
                    </div>
                  </div>

                  <div className="flex items-start gap-4 relative">
                    <div className="w-7 h-7 rounded-full bg-amber-500/20 border border-amber-500/60 flex items-center justify-center text-amber-400 shrink-0 mt-0.5 z-10">
                      <Check className="w-4 h-4 stroke-[2.5]" />
                    </div>
                    <div className="flex-1">
                      <div className="flex items-baseline justify-between">
                        <div className="text-sm font-bold text-white">Tiba di Outlet & Check-in</div>
                        <div className="text-xs text-slate-500 font-mono">16:25 WIB</div>
                      </div>
                      <p className="text-xs text-slate-400 mt-0.5 leading-relaxed">
                        Disambut oleh Butler, welcome drink single malt dipersiapkan di Gentlemen's Lounge.
                      </p>
                    </div>
                  </div>

                  <div className="flex items-start gap-4 relative bg-[#131b29] p-4.5 rounded-2xl border border-amber-500/40">
                    <div className="w-7 h-7 rounded-full border-2 border-amber-400 bg-[#0d121c] flex items-center justify-center shrink-0 mt-0.5 z-10">
                      <div className="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></div>
                    </div>
                    <div className="flex-1">
                      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                        <div className="flex items-center gap-2">
                          <span className="px-2 py-0.5 rounded bg-amber-400 text-slate-950 font-bold text-[10px] uppercase">
                            SEDANG BERLANGSUNG
                          </span>
                          <span className="text-sm font-bold text-white">Kursi 02</span>
                        </div>
                        <div className="text-xs text-amber-300 font-medium">
                          Estimasi Selesai: 17:45 WIB
                        </div>
                      </div>

                      <p className="text-xs text-slate-300 mt-2 leading-relaxed">
                        Sedang dalam pengerjaan ritual pemotongan presisi dan hot towel facial oleh <strong className="text-amber-200">Master Yudha Pratama</strong>.
                      </p>

                      <div className="mt-3.5 space-y-1.5">
                        <div className="flex justify-between text-xs">
                          <span className="text-slate-400 text-[11px]">Progres Pengerjaan Treatment</span>
                          <span className="text-amber-300 font-bold">55% Berjalan</span>
                        </div>
                        <div className="w-full h-2 rounded-full bg-slate-800 overflow-hidden">
                          <div
                            className="h-full bg-gradient-to-r from-amber-500 to-amber-300 rounded-full"
                            style={{ width: `55%` }}
                          ></div>
                        </div>
                      </div>

                      <div className="mt-3 text-[11px] text-amber-300/90 flex items-center gap-1.5">
                        <Sparkles className="w-3.5 h-3.5 text-amber-400" />
                        <span>Aromaterapi Sandalwood & Cedrat Facial Mist aktif</span>
                      </div>
                    </div>
                  </div>

                  <div className="flex items-start gap-4 relative opacity-60">
                    <div className="w-7 h-7 rounded-full border border-slate-700 bg-slate-900 flex items-center justify-center shrink-0 mt-0.5 z-10">
                      <div className="w-2 h-2 rounded-full bg-slate-600"></div>
                    </div>
                    <div className="flex-1">
                      <div className="flex items-baseline justify-between">
                        <div className="text-sm font-bold text-slate-300">Selesai & Kasir Concierge</div>
                        <div className="text-xs text-slate-500 font-mono">17:50 WIB</div>
                      </div>
                      <p className="text-xs text-slate-400 mt-0.5 leading-relaxed">
                        Penyelesaian pembayaran, penyerahan grooming goodie bag, dan penyiapan kendaraan valet di lobby.
                      </p>
                    </div>
                  </div>
                </div>

                <div className="pt-4 border-t border-slate-800">
                  <div className="bg-[#141b29] border border-slate-800 rounded-2xl p-4 flex items-center justify-between">
                    <div className="flex items-center gap-3.5">
                      <div className="w-11 h-11 rounded-xl overflow-hidden border border-amber-500/40 shrink-0">
                        <img
                          src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=200&auto=format&fit=crop&q=80"
                          alt="Yudha Pratama"
                          className="w-full h-full object-cover"
                        />
                      </div>
                      <div>
                        <div className="text-xs font-bold text-white">Artisan: Yudha Pratama</div>
                        <div className="text-[11px] text-slate-400">Bespoke Hair Sculptor & Shaving Specialist</div>
                      </div>
                    </div>
                    <div className="text-xs text-amber-400 font-bold flex items-center gap-1">
                      <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />
                      <span>4.98</span>
                      <span className="text-slate-500 font-normal">(340+ ulasan)</span>
                    </div>
                  </div>
                </div>
              </div>

              <div className="bg-[#101622] border border-slate-800/80 rounded-2xl p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div className="flex items-start gap-3.5">
                  <div className="w-9 h-9 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 shrink-0 mt-0.5">
                    <Bell className="w-4 h-4 text-amber-400" />
                  </div>
                  <div>
                    <div className="text-[10px] font-bold text-amber-400 uppercase tracking-wider">
                      BANTUAN & PELAYANAN KHUSUS
                    </div>
                    <div className="text-sm font-bold text-white mt-0.5">
                      Perlu Menyesuaikan Jadwal atau Valet?
                    </div>
                    <div className="text-xs text-slate-400 mt-0.5 leading-relaxed">
                      Hubungi Butler Desk kami untuk penambahan add-on massage, reservasi valet khusus, atau request minuman lounge.
                    </div>
                  </div>
                </div>

                <a
                  href="https://wa.me/628123456789?text=Halo%20Butler%20Desk%20Atelier%20Gilt,%20saya%20tamu%20A-016%20ingin%20bantuan."
                  target="_blank"
                  rel="noreferrer"
                  className="px-4 py-2.5 rounded-xl bg-[#182130] hover:bg-slate-700 text-white font-semibold text-xs border border-slate-700 shrink-0 flex items-center gap-2 transition-colors self-end sm:self-auto"
                >
                  <MessageSquare className="w-3.5 h-3.5 text-amber-400" />
                  <span>Hubungi Resepsionis</span>
                </a>
              </div>

              <div className="bg-[#101622] border border-slate-800/80 rounded-2xl p-4 flex flex-col sm:flex-row items-center gap-4">
                <div className="w-full sm:w-48 h-28 rounded-xl bg-slate-900 border border-slate-800 overflow-hidden shrink-0 relative flex items-center justify-center">
                  <img
                    src="https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?w=400&auto=format&fit=crop&q=80"
                    alt="Map Location"
                    className="w-full h-full object-cover opacity-60"
                  />
                  <div className="absolute inset-0 bg-black/40"></div>
                  <div className="absolute z-10 flex flex-col items-center">
                    <MapPin className="w-6 h-6 text-amber-400 fill-amber-400/30 animate-bounce" />
                    <span className="text-[10px] font-bold text-amber-300 bg-black/80 px-2 py-0.5 rounded">Senopati Suite</span>
                  </div>
                </div>

                <div>
                  <div className="text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                    ATELIER FLAGSHIP OUTLET
                  </div>
                  <div className="text-sm font-bold text-white mt-0.5">
                    Atelier Gilt — Senopati Suite
                  </div>
                  <p className="text-xs text-slate-400 leading-relaxed mt-1">
                    Jl. Senopati No. 42, Kebayoran Baru, Jakarta Selatan. Akses parkir valet di lobi barat basement.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
      )}

      {/* =========================================================
          VIEW D: TAB RIWAYAT & PROFIL (SCREEN 4 - EXACTLY AS SCREENSHOT)
      ========================================================= */}
      {activeTab === 'profil' && (
        <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-16">
          
          {/* Top Row: Two Cards Grid (Profile Summary & Black Sovereign VIP Card) */}
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch mb-8">
            
            {/* Card 1 (Left - approx 7 cols): Profile Details Box */}
            <div className="lg:col-span-7 bg-[#101622] border border-slate-800/90 rounded-3xl p-6 sm:p-7 shadow-xl flex flex-col justify-between">
              <div>
                <div className="flex items-start gap-4">
                  {/* Avatar with Verified Badge */}
                  <div className="relative shrink-0">
                    <div className="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden border-2 border-amber-500/40">
                      <img
                        src={memberData?.avatar || 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&auto=format&fit=crop&q=80'}
                        alt="Profile Avatar"
                        className="w-full h-full object-cover"
                      />
                    </div>
                    <div className="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-amber-400 text-slate-950 flex items-center justify-center shadow-md">
                      <Check className="w-3.5 h-3.5 stroke-[3]" />
                    </div>
                  </div>

                  {/* Name, Tier & Contacts */}
                  <div className="flex-1">
                    <div className="flex items-center gap-2.5">
                      <h2 className="text-xl sm:text-2xl font-bold text-white font-serif">
                        {memberData?.name || 'Raditya Pratama'}
                      </h2>
                      <span className="px-2 py-0.5 rounded text-[10px] font-bold bg-[#172133] border border-amber-500/40 text-amber-300 uppercase tracking-wider">
                        {memberData?.tier_code || 'TIER 01'}
                      </span>
                    </div>

                    <div className="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-400">
                      <div className="flex items-center gap-1.5">
                        <Phone className="w-3.5 h-3.5 text-amber-400" />
                        <span>{memberData?.phone || '+62 811-9874-2091'}</span>
                      </div>
                      <div className="flex items-center gap-1.5">
                        <Mail className="w-3.5 h-3.5 text-amber-400" />
                        <span>{memberData?.email || 'raditya.pratama@noiratelier.id'}</span>
                      </div>
                      <div className="flex items-center gap-1.5">
                        <MapPin className="w-3.5 h-3.5 text-amber-400" />
                        <span>Senopati Suite, Jakarta</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {/* 3 Stats Columns */}
              <div className="grid grid-cols-3 gap-4 pt-6 mt-6 border-t border-slate-800/80 text-xs">
                <div>
                  <div className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                    TOTAL KUNJUNGAN
                  </div>
                  <div className="text-lg font-bold text-white mt-1">
                    {memberData?.completed_cuts || 24} Sesi
                  </div>
                </div>

                <div>
                  <div className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                    PREFERRED BARBER
                  </div>
                  <div className="text-lg font-bold text-amber-300 mt-1">
                    {memberData?.preferred_barber || 'Yudha P.'}
                  </div>
                </div>

                <div>
                  <div className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                    STATUS RESERVASI
                  </div>
                  <div className="text-lg font-bold text-amber-400 mt-1 flex items-center gap-1.5">
                    <span className="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Ready</span>
                  </div>
                </div>
              </div>
            </div>

            {/* Card 2 (Right - approx 5 cols): Black Sovereign VIP Card */}
            <div className="lg:col-span-5 bg-gradient-to-br from-[#121927] via-[#0f1522] to-[#0a0e17] border border-amber-500/40 rounded-3xl p-6 sm:p-7 shadow-2xl relative overflow-hidden flex flex-col justify-between">
              {/* Luxury Watermark Pattern */}
              <div className="absolute right-0 top-0 bottom-0 w-64 opacity-5 pointer-events-none flex items-center justify-center">
                <Compass className="w-56 h-56 text-amber-300" />
              </div>

              {/* Header Card */}
              <div className="flex items-start justify-between relative z-10">
                <div className="flex items-center gap-2.5">
                  <div className="w-8 h-8 rounded-lg bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400">
                    <Award className="w-4 h-4 text-amber-400" />
                  </div>
                  <div>
                    <div className="text-sm font-serif font-bold tracking-wider text-amber-200">
                      ATELIER GILT
                    </div>
                    <div className="text-[9px] font-bold tracking-[0.2em] text-slate-400 uppercase">
                      PRIVILEGE ACCESS
                    </div>
                  </div>
                </div>

                <div className="px-3 py-1 rounded bg-amber-400 text-slate-950 text-[10px] font-bold uppercase tracking-wider shadow">
                  PLATINUM VIP
                </div>
              </div>

              {/* Chip & Card Number */}
              <div className="my-8 relative z-10">
                <div className="w-10 h-7 rounded bg-gradient-to-br from-amber-300 to-amber-600 mb-4 opacity-90 shadow"></div>
                <div className="text-xl sm:text-2xl font-mono font-bold tracking-[0.25em] text-amber-100">
                  {memberData?.card_number || 'G I L T - 8 8 3 9 - 0 0 2 1'}
                </div>
              </div>

              {/* Card Footer: Points & Expiry */}
              <div className="flex items-end justify-between pt-4 border-t border-slate-800/80 relative z-10">
                <div>
                  <div className="text-[9px] font-bold tracking-wider text-slate-400 uppercase">
                    ATELIER POINTS BALANCE
                  </div>
                  <div className="text-2xl font-serif font-bold text-amber-300 mt-0.5">
                    {memberData?.points || '4.850 PTS'}
                  </div>
                </div>

                <div className="text-right">
                  <div className="text-[9px] font-bold tracking-wider text-slate-400 uppercase">
                    VALID THRU
                  </div>
                  <div className="text-sm font-bold text-white mt-0.5 font-mono">
                    {memberData?.valid_thru || '12 / 2028'}
                  </div>
                </div>
              </div>
            </div>

          </div>

          {/* Middle Row: Hak Istimewa Keanggotaan Anda */}
          <div className="mb-10">
            <div className="flex items-center justify-between mb-4">
              <div className="text-[10px] font-bold tracking-widest text-slate-400 uppercase">
                HAK ISTIMEWA KEANGGOTAAN ANDA
              </div>
              <button
                onClick={() => setShowBenefitModal(true)}
                className="text-xs font-semibold text-amber-400 hover:text-amber-300 flex items-center gap-1 transition-colors"
              >
                <span>Detail Benefit</span>
                <ArrowRight className="w-3.5 h-3.5" />
              </button>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              {/* Benefit 1 */}
              <div className="bg-[#101622] border border-slate-800/90 rounded-2xl p-5 flex items-start gap-4">
                <div className="w-10 h-10 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center text-amber-400 shrink-0">
                  <Wine className="w-5 h-5 text-amber-400" />
                </div>
                <div>
                  <div className="text-sm font-bold text-white">
                    Complimentary Single Malt / Espresso
                  </div>
                  <div className="text-xs text-slate-400 mt-0.5 leading-relaxed">
                    Bespoke lounge menu pour per visit
                  </div>
                </div>
              </div>

              {/* Benefit 2 */}
              <div className="bg-[#101622] border border-slate-800/90 rounded-2xl p-5 flex items-start gap-4">
                <div className="w-10 h-10 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center text-amber-400 shrink-0">
                  <Store className="w-5 h-5 text-amber-400" />
                </div>
                <div>
                  <div className="text-sm font-bold text-white">
                    Fast Priority Chair Access
                  </div>
                  <div className="text-xs text-slate-400 mt-0.5 leading-relaxed">
                    Zero wait time dengan reservasi kilat
                  </div>
                </div>
              </div>

              {/* Benefit 3 */}
              <div className="bg-[#101622] border border-slate-800/90 rounded-2xl p-5 flex items-start gap-4">
                <div className="w-10 h-10 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center text-amber-400 shrink-0">
                  <Tag className="w-5 h-5 text-amber-400" />
                </div>
                <div>
                  <div className="text-sm font-bold text-white">
                    Diskon 15% Grooming Products
                  </div>
                  <div className="text-xs text-slate-400 mt-0.5 leading-relaxed">
                    Pomade, beard oil, & fine colognes
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Bottom Section: Riwayat Kunjungan & Treatment Log */}
          <div>
            {/* Header Tabs & Search/Filter */}
            <div className="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-800">
              {/* Left Sub Tabs */}
              <div className="flex items-center gap-2">
                <button
                  onClick={() => setHistorySubTab('kunjungan')}
                  className={`px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 ${
                    historySubTab === 'kunjungan'
                      ? 'bg-[#1a2333] border border-amber-500/50 text-amber-300 shadow'
                      : 'bg-[#121824] border border-slate-800 text-slate-400 hover:text-white'
                  }`}
                >
                  <FileText className="w-3.5 h-3.5 text-amber-400" />
                  <span>Riwayat Kunjungan & Treatment Log</span>
                </button>

                <button
                  onClick={() => setHistorySubTab('ulasan')}
                  className={`px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 ${
                    historySubTab === 'ulasan'
                      ? 'bg-[#1a2333] border border-amber-500/50 text-amber-300 shadow'
                      : 'bg-[#121824] border border-slate-800 text-slate-400 hover:text-white'
                  }`}
                >
                  <MessageSquare className="w-3.5 h-3.5 text-slate-400" />
                  <span>Ulasan Pelayanan (24)</span>
                </button>
              </div>

              {/* Right Search & Filter */}
              <div className="flex items-center gap-2.5">
                <div className="relative flex-1 sm:w-72">
                  <Search className="w-3.5 h-3.5 text-slate-500 absolute left-3 top-3" />
                  <input
                    type="text"
                    value={searchHistoryQuery}
                    onChange={(e) => setSearchHistoryQuery(e.target.value)}
                    placeholder="Cari formula atau nama barber..."
                    className="w-full bg-[#121824] border border-slate-800 rounded-xl pl-9 pr-3 py-2 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400"
                  />
                </div>
                <button
                  onClick={() => showToast('Filter periode riwayat: Semua Kunjungan')}
                  className="px-3.5 py-2 rounded-xl bg-[#121824] border border-slate-800 hover:border-slate-700 text-slate-300 text-xs font-medium flex items-center gap-1.5 transition-colors"
                >
                  <Filter className="w-3.5 h-3.5 text-amber-400" />
                  <span>Filter</span>
                </button>
              </div>
            </div>

            {/* List Log Cards */}
            {historySubTab === 'kunjungan' && (
              <div className="space-y-4">
                {filteredLogs.map((log) => (
                  <div
                    key={log.id}
                    className="bg-[#101622] border border-slate-800/90 rounded-3xl p-5 sm:p-6 shadow-xl flex flex-col md:flex-row items-start md:items-center justify-between gap-6 hover:border-amber-500/30 transition-all"
                  >
                    {/* Image & Main Info */}
                    <div className="flex items-start gap-4 flex-1">
                      <div className="w-24 h-24 rounded-2xl bg-slate-900 border border-slate-800 overflow-hidden shrink-0 relative">
                        <img
                          src={log.image}
                          alt={log.title}
                          className="w-full h-full object-cover"
                        />
                        <div className="absolute top-1.5 left-1.5 px-2 py-0.5 rounded bg-black/80 text-[8px] font-bold text-amber-300 uppercase">
                          HAIRSTYLE
                        </div>
                      </div>

                      <div className="space-y-2 flex-1">
                        <div className="flex flex-wrap items-center gap-2">
                          <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                            {log.date} • {log.session}
                          </span>
                          <span className={`px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider ${
                            log.statusType === 'gold'
                              ? 'bg-amber-500/20 text-amber-300 border border-amber-500/40'
                              : 'bg-slate-800 text-slate-400 border border-slate-700'
                          }`}>
                            {log.status}
                          </span>
                        </div>

                        <h3 className="text-base sm:text-lg font-bold text-white font-serif">
                          {log.title}
                        </h3>

                        <div className="flex items-center gap-2 text-xs text-slate-400">
                          <div className="w-5 h-5 rounded-full overflow-hidden border border-amber-500/30">
                            <img src={log.barberAvatar} alt="Barber" className="w-full h-full object-cover" />
                          </div>
                          <span className="font-medium text-slate-300">{log.barberName}</span>
                        </div>

                        {/* Hair Formula & Clipper Log Box */}
                        <div className="bg-[#141b29] border border-slate-800/90 rounded-xl p-3 text-xs space-y-1">
                          <div className="text-[10px] font-bold text-amber-400 uppercase tracking-wider flex items-center gap-1.5">
                            <FlaskConical className="w-3.5 h-3.5 text-amber-400" />
                            <span>HAIR FORMULA & CLIPPER LOG</span>
                          </div>
                          <p className="text-[11px] text-slate-300 leading-relaxed font-sans">
                            {log.formula}
                          </p>
                        </div>
                      </div>
                    </div>

                    {/* Right Side: Total Biaya & Action Buttons */}
                    <div className="text-right shrink-0 flex flex-col items-end gap-3 self-end md:self-center w-full md:w-auto pt-3 md:pt-0 border-t md:border-t-0 border-slate-800">
                      <div>
                        <div className="text-[10px] font-bold tracking-widest text-slate-500 uppercase">
                          TOTAL BIAYA
                        </div>
                        <div className="text-xl sm:text-2xl font-serif font-bold text-amber-300 mt-0.5">
                          {log.costFormatted}
                        </div>
                      </div>

                      <div className="flex items-center gap-2">
                        {log.canReorder ? (
                          <>
                            <button
                              onClick={() => setShowInvoiceModal(log)}
                              className="w-10 h-10 rounded-xl bg-[#141b29] border border-slate-700 hover:border-amber-400 text-slate-300 flex items-center justify-center transition-colors"
                              title="Lihat Detail Nota"
                            >
                              <FileText className="w-4 h-4 text-amber-400" />
                            </button>
                            <button
                              onClick={() => {
                                setActiveTab('reservasi');
                                showToast(`Model "${log.title}" telah dimuat ke jadwal reservasi!`);
                              }}
                              className="px-4 py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-md flex items-center gap-1.5 transition-colors"
                            >
                              <Repeat className="w-3.5 h-3.5" />
                              <span>Pesan Model Ini Lagi</span>
                            </button>
                          </>
                        ) : (
                          <button
                            onClick={() => setShowInvoiceModal(log)}
                            className="px-4 py-2.5 rounded-xl bg-[#141b29] border border-slate-700 hover:border-amber-400 text-slate-200 font-semibold text-xs flex items-center gap-1.5 transition-colors"
                          >
                            <FileText className="w-3.5 h-3.5 text-amber-400" />
                            <span>Lihat Invoice</span>
                          </button>
                        )}
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            )}

            {historySubTab === 'ulasan' && (
              <div className="bg-[#101622] border border-slate-800 rounded-3xl p-6 text-center space-y-3">
                <Star className="w-8 h-8 text-amber-400 fill-amber-400 mx-auto" />
                <h3 className="text-sm font-bold text-white">24 Ulasan Layanan Terverifikasi</h3>
                <p className="text-xs text-slate-400 max-w-md mx-auto leading-relaxed">
                  Semua ulasan sesi potong rambut dan shaving Anda di Atelier Gilt mendapatkan rating sempurna rata-rata 5.0 bintang.
                </p>
                <div className="pt-2">
                  <span className="text-xs text-amber-400 font-bold bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/30">
                    ★ 5.0 / 5.0 (Tamu Platinum Terpercaya)
                  </span>
                </div>
              </div>
            )}

          </div>

        </section>
      )}

      {/* =========================================================
          FOOTER (EXACTLY AS IN SCREENSHOT)
      ========================================================= */}
      <footer className="border-t border-slate-800/80 bg-[#0a0e16] py-10 text-xs text-slate-500">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
          <div className="flex items-center gap-2">
            <span className="font-serif font-bold text-slate-300 tracking-wider">ATELIER GILT</span>
            <span>—</span>
            <span>Bespoke Haute Grooming Atelier</span>
          </div>
          <div>
            © 2025 Atelier Gilt Salon Privé. Hak Cipta Dilindungi.
          </div>
          <div className="tracking-widest uppercase text-slate-400 font-medium">
            JAKARTA • SENOPATI SUITE
          </div>
        </div>
      </footer>

      {/* =========================================================
          MODAL: DETAIL BENEFIT KEANGGOTAAN
      ========================================================= */}
      {showBenefitModal && (
        <div className="fixed inset-0 z-50 bg-black/80 backdrop-blur-md flex items-center justify-center p-4">
          <div className="bg-[#101724] border border-amber-500/40 rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl animate-in zoom-in-95 duration-200">
            <div className="p-6 bg-[#141d2e] border-b border-slate-800 flex items-center justify-between">
              <div className="flex items-center gap-2.5">
                <Crown className="w-5 h-5 text-amber-400" />
                <div>
                  <div className="text-xs font-bold text-amber-400 uppercase tracking-widest">PRIVILEGE SUMMARY</div>
                  <div className="text-base font-serif font-bold text-white">Privilege Keanggotaan Platinum VIP</div>
                </div>
              </div>
              <button
                onClick={() => setShowBenefitModal(false)}
                className="w-8 h-8 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition-colors"
              >
                <X className="w-5 h-5" />
              </button>
            </div>

            <div className="p-6 space-y-4 text-xs">
              <div className="bg-[#162030] rounded-2xl p-4 border border-slate-800 space-y-3">
                <div className="flex items-center gap-2 text-white font-bold text-sm">
                  <Award className="w-4 h-4 text-amber-400" />
                  <span>Sovereign Tier Privé Privileges</span>
                </div>
                <ul className="space-y-2 text-slate-300 list-disc list-inside leading-relaxed">
                  <li><strong>Akses Bebas Tunggu:</strong> Prioritas alokasi kursi utama di seluruh outlet Senopati & Kebayoran.</li>
                  <li><strong>Hospitality Bar:</strong> Menu pour bebas untuk single malt whisky, kopi pour-over artisan, atau organic sparkling water.</li>
                  <li><strong>Boutique Diskon 15%:</strong> Potongan khusus untuk lini produk pomade, beard oil, dan parfum eksklusif.</li>
                  <li><strong>Concierge Valet Service:</strong> Parkir valet gratis tanpa batas di Senopati Suites.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      )}

      {/* =========================================================
          MODAL: INVOICE RIWAYAT
      ========================================================= */}
      {showInvoiceModal && (
        <div className="fixed inset-0 z-50 bg-black/80 backdrop-blur-md flex items-center justify-center p-4">
          <div className="bg-[#101724] border border-amber-500/40 rounded-3xl max-w-md w-full overflow-hidden shadow-2xl animate-in zoom-in-95 duration-200">
            <div className="p-6 bg-[#141d2e] border-b border-slate-800 flex items-center justify-between">
              <div className="flex items-center gap-2">
                <FileText className="w-5 h-5 text-amber-400" />
                <span className="font-serif font-bold text-white text-base">Invoice Kunjungan</span>
              </div>
              <button
                onClick={() => setShowInvoiceModal(null)}
                className="w-8 h-8 rounded-full bg-slate-800 text-slate-300 flex items-center justify-center"
              >
                <X className="w-5 h-5" />
              </button>
            </div>

            <div className="p-6 space-y-4 text-xs">
              <div className="bg-[#151d2c] rounded-2xl p-4 border border-slate-800 space-y-2">
                <div className="flex justify-between">
                  <span className="text-slate-400">Kode Invoice:</span>
                  <span className="font-mono text-white font-bold">{showInvoiceModal.id}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-slate-400">Tanggal:</span>
                  <span className="text-white">{showInvoiceModal.date}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-slate-400">Layanan:</span>
                  <span className="text-amber-200 font-semibold">{showInvoiceModal.title}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-slate-400">Master Barber:</span>
                  <span className="text-white">{showInvoiceModal.barberName}</span>
                </div>
                <div className="flex justify-between pt-2 border-t border-slate-800 font-bold text-sm">
                  <span className="text-white">Total Lunas:</span>
                  <span className="text-amber-300">{showInvoiceModal.costFormatted}</span>
                </div>
              </div>

              <button
                onClick={() => window.print()}
                className="w-full py-3 rounded-xl bg-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider"
              >
                Cetak Bukti Transaksi
              </button>
            </div>
          </div>
        </div>
      )}

      {/* =========================================================
          MODAL: LOGIN AKUN LANGGANAN (VIP MEMBER)
      ========================================================= */}
      {showLoginModal && (
        <div className="fixed inset-0 z-50 bg-black/80 backdrop-blur-md flex items-center justify-center p-4">
          <div className="bg-[#101724] border border-amber-500/40 rounded-3xl max-w-md w-full overflow-hidden shadow-2xl animate-in zoom-in-95 duration-200">
            <div className="p-6 bg-[#141d2e] border-b border-slate-800 flex items-center justify-between">
              <div className="flex items-center gap-2.5">
                <Award className="w-5 h-5 text-amber-400" />
                <div>
                  <div className="text-xs font-bold text-amber-400 uppercase tracking-wider">LOGIN KHUSUS LANGGANAN</div>
                  <div className="text-base font-serif font-bold text-white">Atelier Sovereign VIP</div>
                </div>
              </div>
              <button
                onClick={() => setShowLoginModal(false)}
                className="w-8 h-8 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition-colors"
              >
                <X className="w-5 h-5" />
              </button>
            </div>

            <div className="p-6 space-y-4">
              <div className="bg-[#162030] border border-amber-500/30 rounded-2xl p-4">
                <div className="text-xs font-semibold text-amber-300 flex items-center gap-1.5 mb-1">
                  <Sparkles className="w-4 h-4 text-amber-400" />
                  <span>Uji Coba Cepat (1-Klik)</span>
                </div>
                <p className="text-xs text-slate-400 mb-3">
                  Masuk langsung dengan profil pelanggan langganan <strong className="text-white">Raditya Pratama (Platinum VIP)</strong> seperti pada gambar tampilan.
                </p>
                <button
                  type="button"
                  onClick={() => {
                    setShowLoginModal(false);
                    toggleSimulation('vip');
                  }}
                  className="w-full py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs transition-colors flex items-center justify-center gap-2"
                >
                  <UserCheck className="w-4 h-4" />
                  <span>Tampilkan Status Raditya Pratama</span>
                </button>
              </div>

              <div className="relative flex py-1 items-center">
                <div className="flex-grow border-t border-slate-800"></div>
                <span className="flex-shrink mx-3 text-xs text-slate-500 uppercase tracking-wider">atau masuk biasa</span>
                <div className="flex-grow border-t border-slate-800"></div>
              </div>

              <form
                onSubmit={(e) => {
                  e.preventDefault();
                  setShowLoginModal(false);
                  toggleSimulation('vip');
                }}
                className="space-y-3"
              >
                <div>
                  <label className="block text-xs font-medium text-slate-300 mb-1">Email / Nomor Kartu VIP</label>
                  <input
                    type="text"
                    defaultValue="raditya.pratama@noiratelier.id"
                    className="w-full bg-[#162030] border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400"
                  />
                </div>
                <div>
                  <label className="block text-xs font-medium text-slate-300 mb-1">Password</label>
                  <input
                    type="password"
                    defaultValue="raditya123"
                    className="w-full bg-[#162030] border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400"
                  />
                </div>
                <button
                  type="submit"
                  className="w-full py-3 rounded-xl bg-[#1d273a] hover:bg-slate-700 text-white font-semibold text-xs border border-slate-700 transition-colors"
                >
                  Masuk Akun Member
                </button>
              </form>
            </div>
          </div>
        </div>
      )}

      {/* =========================================================
          MODAL: PRODUK GROOMING CONCIERGE
      ========================================================= */}
      {showProductsModal && (
        <div className="fixed inset-0 z-50 bg-black/80 backdrop-blur-md flex items-center justify-center p-4 overflow-y-auto">
          <div className="bg-[#101724] border border-amber-500/40 rounded-3xl max-w-2xl w-full overflow-hidden shadow-2xl my-8 animate-in zoom-in-95 duration-200">
            <div className="p-6 bg-[#141d2e] border-b border-slate-800 flex items-center justify-between">
              <div>
                <div className="text-[10px] font-bold text-amber-400 uppercase tracking-widest">BOUTIQUE & APOTHECARY</div>
                <div className="text-xl font-serif font-bold text-white">Produk Grooming Signature</div>
              </div>
              <button
                onClick={() => setShowProductsModal(false)}
                className="w-8 h-8 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition-colors"
              >
                <X className="w-5 h-5" />
              </button>
            </div>

            <div className="p-6 space-y-4">
              {groomingProducts.map((p) => (
                <div key={p.id} className="bg-[#162030] border border-slate-800 rounded-2xl p-4 flex items-center gap-4">
                  <div className="w-16 h-16 rounded-xl bg-slate-800 overflow-hidden shrink-0 border border-slate-700">
                    <img src={p.image} alt={p.name} className="w-full h-full object-cover" />
                  </div>
                  <div className="flex-1">
                    <div className="text-xs text-amber-400 font-medium">{p.category} • {p.size}</div>
                    <div className="text-sm font-serif font-bold text-white">{p.name}</div>
                    <div className="text-xs text-slate-400 mt-0.5">{p.desc}</div>
                  </div>
                  <div className="text-right">
                    <div className="text-sm font-bold text-amber-200">{p.price}</div>
                    <a
                      href={`https://wa.me/628123456789?text=Halo%20Atelier%20Gilt,%20saya%20ingin%20memesan%20produk%20${p.name}.`}
                      target="_blank"
                      rel="noreferrer"
                      className="mt-1.5 inline-block px-3 py-1 rounded-lg bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs"
                    >
                      Beli via Concierge
                    </a>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      )}

      {/* =========================================================
          MODAL: KONSULTASI GAYA & CONCIERGE
      ========================================================= */}
      {showConsultModal && (
        <div className="fixed inset-0 z-50 bg-black/80 backdrop-blur-md flex items-center justify-center p-4">
          <div className="bg-[#101724] border border-amber-500/40 rounded-3xl max-w-md w-full overflow-hidden shadow-2xl animate-in zoom-in-95 duration-200">
            <div className="p-6 bg-[#141d2e] border-b border-slate-800 flex items-center justify-between">
              <div className="flex items-center gap-2.5">
                <MessageSquare className="w-5 h-5 text-amber-400" />
                <div>
                  <div className="text-xs font-bold text-amber-400 uppercase tracking-widest">SARTORIAL ADVICE</div>
                  <div className="text-base font-serif font-bold text-white">Konsultasi Gaya Concierge</div>
                </div>
              </div>
              <button
                onClick={() => setShowConsultModal(false)}
                className="w-8 h-8 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition-colors"
              >
                <X className="w-5 h-5" />
              </button>
            </div>

            <div className="p-6 space-y-4 text-xs">
              <p className="text-slate-300 leading-relaxed">
                Ingin konsultasi model rambut yang cocok dengan bentuk wajah Anda, perawatan jenggot artisan, atau rekomendasi paket spa kepala? Tim concierge Atelier Gilt siap melayani Anda.
              </p>

              <div className="bg-[#162030] rounded-xl p-4 border border-slate-800 space-y-2">
                <div className="flex items-center gap-2 text-white font-semibold">
                  <Clock className="w-4 h-4 text-amber-400" />
                  <span>Jam Layanan Concierge: 10:00 - 21:00 WIB</span>
                </div>
                <div className="flex items-center gap-2 text-slate-400">
                  <MapPin className="w-4 h-4 text-amber-400" />
                  <span>Senopati Suite No. 18, Kebayoran Baru</span>
                </div>
              </div>

              <a
                href="https://wa.me/628123456789?text=Halo%20Concierge%20Atelier%20Gilt,%20saya%20ingin%20konsultasi%20gaya%20rambut%20dan%20treatment."
                target="_blank"
                rel="noreferrer"
                className="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center justify-center gap-2 transition-colors shadow-lg"
              >
                <MessageSquare className="w-4 h-4" />
                <span>Mulai Chat WhatsApp dengan Concierge</span>
              </a>
            </div>
          </div>
        </div>
      )}

    </div>
  );
}
