import React, { useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import {
  LayoutGrid, Calendar, Users, Award, Scissors, ShoppingBag,
  Percent, Bell, MessageSquare, Settings, Search, Plus, CheckCircle,
  Clock, ArrowUpRight, ChevronRight, X, User, CreditCard, ChevronDown,
  Sparkles, Check, DollarSign, RefreshCw, BarChart2, Filter,
  Phone, AlertCircle, Eye, Printer, Trash2, CalendarX, CheckCircle2,
  ChevronLeft, Send, AlertTriangle
} from 'lucide-react';

export default function AtelierBooking({ auth }) {
  const user = auth?.user || { name: 'Mario Alfarizi', email: 'admin@lstyle.id', role: 'Owner / Manager' };

  // ==========================================
  // STATE MANAGEMENT
  // ==========================================
  // Mode data: 'kosong' (Default - empty for user to input) vs 'demo' (Pre-populated sample data)
  const [dataMode, setDataMode] = useState('kosong');
  const [viewTab, setViewTab] = useState('kalender'); // 'kalender' | 'tabel' | 'stylist'
  const [searchQuery, setSearchQuery] = useState('');
  const [toastMessage, setToastMessage] = useState(null);

  // Modals state
  const [showBookingModal, setShowBookingModal] = useState(false);
  const [selectedSlotForBooking, setSelectedSlotForBooking] = useState(null);

  // Selected Booking for Detail Panel
  const [selectedBooking, setSelectedBooking] = useState(null);

  // Notifications & User Menu
  const [showNotificationDrawer, setShowNotificationDrawer] = useState(false);
  const [showUserMenu, setShowUserMenu] = useState(false);

  // Toast Notification helper
  const showToast = (msg) => {
    setToastMessage(msg);
    setTimeout(() => setToastMessage(null), 4000);
  };

  // ==========================================
  // DEMO VS EMPTY DATA SETS
  // ==========================================
  const demoData = {
    stats: {
      totalBooking: 18,
      targetSub: 'Target salon: 20 tamu',
      dikonfirmasi: 14,
      dikonfirmasiSub: '78% Tingkat Kepastian',
      pending: 3,
      pendingSub: 'Memerlukan follow-up CS',
      dibatalkan: 1,
      dibatalkanSub: 'Slot 16:30 siap diisi kembali'
    },
    bookings: [
      {
        id: 'LS-8892',
        nama: 'Jessica Aurelia',
        phone: '0811-9234-5678',
        tier: 'VIP MEMBER TIER',
        jam: '14:00 - 16:00 WIB',
        timeSlot: '14:00 - 15:00',
        layanan: 'Balayage & Gloss Hair Treatment',
        durasi: '120 Menit (2 Jam Perawatan)',
        stylist: 'Stylist Elena Rose',
        stylistId: 'elena',
        kursi: 'Kursi 03 • Color Atelier Lounge',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 650000,
        status: 'Dikonfirmasi',
        paymentNote: 'DP Rp 150.000 Lunas',
        catatan: 'Konsultasi warna abu-abu keemasan / ash blonde, scalp agak sensitif.',
        badgeType: 'VIP'
      },
      {
        id: 'LS-8890',
        nama: 'Budi Hartono',
        phone: '0812-4455-6677',
        tier: 'Member Regular',
        jam: '10:00 WIB',
        timeSlot: '10:00',
        layanan: 'Signature Gentleman Cut',
        durasi: '45m',
        stylist: 'Barber David',
        stylistId: 'david',
        kursi: 'Kursi 01',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 180000,
        status: 'Dikonfirmasi',
        paymentNote: 'Lunas',
        catatan: 'Potongan klasik undercut rapi.',
        badgeType: 'Lunas'
      },
      {
        id: 'LS-8891',
        nama: 'Nathalie S.',
        phone: '0813-8899-0011',
        tier: 'Regular Guest',
        jam: '10:00 WIB',
        timeSlot: '10:00',
        layanan: 'Gloss Hair Blowout',
        durasi: '50m',
        stylist: 'Stylist Elena',
        stylistId: 'elena',
        kursi: 'Kursi 03',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 250000,
        status: 'Dikonfirmasi',
        paymentNote: 'Bayar Kasir',
        catatan: 'Blowout volume soft wave.',
        badgeType: 'Bayar'
      },
      {
        id: 'LS-8893',
        nama: 'Airlangga Radit',
        phone: '0815-1122-3344',
        tier: 'Gold Member',
        jam: '11:00 WIB',
        timeSlot: '11:00',
        layanan: 'Hot Towel Shave Ritual',
        durasi: '40m',
        stylist: 'Barber David',
        stylistId: 'david',
        kursi: 'Kursi 01',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 150000,
        status: 'Dikonfirmasi',
        paymentNote: 'Lunas',
        catatan: 'Kumis & jenggot di-shave klimis.',
        badgeType: 'Lunas'
      },
      {
        id: 'LS-8894',
        nama: 'Kevin Sutanto',
        phone: '0817-9900-1122',
        tier: 'Platinum Member',
        jam: '11:00 WIB',
        timeSlot: '11:00',
        layanan: 'Executive Cut & Scalp Detox',
        durasi: '60m',
        stylist: 'Barber Reza',
        stylistId: 'reza',
        kursi: 'Kursi 02',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 280000,
        status: 'Dikonfirmasi',
        paymentNote: 'Lunas',
        catatan: 'Pijat kepala herbal scalping.',
        badgeType: 'Lunas'
      },
      {
        id: 'LS-8895',
        nama: 'Fauzan Prasetya',
        phone: '0819-3344-5566',
        tier: 'Regular Guest',
        jam: '12:00 WIB',
        timeSlot: '12:00',
        layanan: 'Hair Cut & Styling',
        durasi: '45m',
        stylist: 'Barber Reza',
        stylistId: 'reza',
        kursi: 'Kursi 02',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 200000,
        status: 'Menunggu',
        paymentNote: 'DP 50%',
        catatan: 'Menunggu konfirmasi kedatangan.',
        badgeType: 'DP'
      },
      {
        id: 'LS-8896',
        nama: 'Valerie Tan',
        phone: '0821-5566-7788',
        tier: 'VIP Member',
        jam: '12:00 WIB',
        timeSlot: '12:00',
        layanan: 'Hydra Keratin Therapy',
        durasi: '75m',
        stylist: 'Stylist Elena',
        stylistId: 'elena',
        kursi: 'Kursi 03',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 550000,
        status: 'Dikonfirmasi',
        paymentNote: 'Lunas',
        catatan: 'Keratin smoothing lembut alami.',
        badgeType: 'Lunas'
      },
      {
        id: 'LS-8897',
        nama: 'Bambang Wijaya',
        phone: '0822-7788-9900',
        tier: 'Regular Guest',
        jam: '13:00 WIB',
        timeSlot: '13:00',
        layanan: 'Signature Precision Cut',
        durasi: '45m',
        stylist: 'Barber David',
        stylistId: 'david',
        kursi: 'Kursi 01',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 180000,
        status: 'Dikonfirmasi',
        paymentNote: 'Lunas',
        catatan: 'Fade rendah samping pendek.',
        badgeType: 'Lunas'
      },
      {
        id: 'LS-8898',
        nama: 'Rian Pratama',
        phone: '0823-1111-2222',
        tier: 'Gold Member',
        jam: '14:00 WIB',
        timeSlot: '14:00 - 15:00',
        layanan: 'Signature Cut',
        durasi: '45m',
        stylist: 'Barber David',
        stylistId: 'david',
        kursi: 'Kursi 01',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 180000,
        status: 'Dikonfirmasi',
        paymentNote: 'Lunas',
        catatan: 'Cukur tirus samping.',
        badgeType: 'Lunas'
      },
      {
        id: 'LS-8899',
        nama: 'Marcus Lim',
        phone: '0824-3333-4444',
        tier: 'Platinum Member',
        jam: '14:00 WIB',
        timeSlot: '14:00 - 15:00',
        layanan: 'Skin Fade & Sculpt',
        durasi: '50m',
        stylist: 'Barber Reza',
        stylistId: 'reza',
        kursi: 'Kursi 02',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 220000,
        status: 'Dikonfirmasi',
        paymentNote: 'Lunas',
        catatan: 'Skin fade gradasi halus.',
        badgeType: 'Lunas'
      },
      {
        id: 'LS-8900',
        nama: 'Doni Kurnia',
        phone: '0825-5555-6666',
        tier: 'Regular Guest',
        jam: '14:30 WIB',
        timeSlot: '14:00 - 15:00',
        layanan: 'Hot Towel Shave',
        durasi: '30m',
        stylist: 'Barber David',
        stylistId: 'david',
        kursi: 'Kursi 01',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 120000,
        status: 'Dikonfirmasi',
        paymentNote: 'Bayar Kasir',
        catatan: 'Handuk hangat aroma terapi.',
        badgeType: 'Bayar'
      },
      {
        id: 'LS-8901',
        nama: 'Tommy Soeharto',
        phone: '0826-7777-8888',
        tier: 'Regular Guest',
        jam: '16:00 WIB',
        timeSlot: '16:00',
        layanan: 'Signature Gentlemen Styling',
        durasi: '45m',
        stylist: 'Barber David',
        stylistId: 'david',
        kursi: 'Kursi 01',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 180000,
        status: 'Dikonfirmasi',
        paymentNote: 'Lunas',
        catatan: 'Pomade matte finish.',
        badgeType: 'Lunas'
      },
      {
        id: 'LS-8902',
        nama: 'Rizky Ananda',
        phone: '0827-9999-0000',
        tier: 'Regular Guest',
        jam: '16:00 WIB',
        timeSlot: '16:00',
        layanan: 'Slot Dibatalkan Tamu',
        durasi: '45m',
        stylist: 'Barber Reza',
        stylistId: 'reza',
        kursi: 'Kursi 02',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 0,
        status: 'Batal',
        paymentNote: 'Bisa dialihkan walk-in',
        catatan: 'Dibatalkan 1 jam lalu via telepon.',
        badgeType: 'Batal'
      },
      {
        id: 'LS-8903',
        nama: 'Clara Angelica',
        phone: '0828-1122-3344',
        tier: 'Gold Member',
        jam: '16:00 WIB',
        timeSlot: '16:00',
        layanan: 'Scalp Rejuvenation',
        durasi: '60m',
        stylist: 'Stylist Elena',
        stylistId: 'elena',
        kursi: 'Kursi 03',
        tanggal: 'Kamis, 24 Okt 2024',
        amount: 350000,
        status: 'Dikonfirmasi',
        paymentNote: 'Lunas',
        catatan: 'Treatment kulit kepala dingin.',
        badgeType: 'Lunas'
      }
    ]
  };

  const emptyData = {
    stats: {
      totalBooking: 0,
      targetSub: 'Target salon: 20 tamu',
      dikonfirmasi: 0,
      dikonfirmasiSub: '0% Tingkat Kepastian',
      pending: 0,
      pendingSub: 'Tidak ada pending CS',
      dibatalkan: 0,
      dibatalkanSub: 'Tidak ada slot dibatalkan'
    },
    bookings: []
  };

  // State data for dynamic operations
  const [currentData, setCurrentData] = useState(emptyData);

  // Sync state whenever dataMode switches
  useEffect(() => {
    if (dataMode === 'demo') {
      setCurrentData(demoData);
      setSelectedBooking(demoData.bookings[0]); // Select Jessica Aurelia for detail panel preview
    } else {
      setCurrentData(emptyData);
      setSelectedBooking(null);
    }
  }, [dataMode]);

  // Form states for adding booking
  const [bookingForm, setBookingForm] = useState({
    nama: '',
    phone: '',
    tier: 'VIP MEMBER TIER',
    jam: '14:00 - 16:00 WIB',
    timeSlot: '14:00 - 15:00',
    layanan: 'Balayage & Gloss Hair Treatment',
    durasi: '120 Menit (2 Jam Perawatan)',
    stylist: 'Stylist Elena Rose',
    stylistId: 'elena',
    kursi: 'Kursi 03 • Color Atelier Lounge',
    tanggal: 'Kamis, 24 Okt 2024',
    amount: 650000,
    status: 'Dikonfirmasi',
    paymentNote: 'Lunas',
    catatan: ''
  });

  const openBookingModalWithSlot = (slotInfo) => {
    setSelectedSlotForBooking(slotInfo);
    if (slotInfo) {
      const isElena = slotInfo.stylistId === 'elena';
      const isReza = slotInfo.stylistId === 'reza';
      setBookingForm({
        nama: '',
        phone: '',
        tier: 'VIP MEMBER TIER',
        jam: `${slotInfo.slot} WIB`,
        timeSlot: slotInfo.slot,
        layanan: isElena ? 'Balayage & Gloss Hair Treatment' : (isReza ? 'Executive Cut & Scalp Detox' : 'Signature Gentleman Cut'),
        durasi: isElena ? '120 Menit (2 Jam Perawatan)' : '45m',
        stylist: slotInfo.stylistName,
        stylistId: slotInfo.stylistId,
        kursi: `Kursi ${isElena ? '03 • Color Atelier Lounge' : (isReza ? '02' : '01')}`,
        tanggal: 'Kamis, 24 Okt 2024',
        amount: isElena ? 650000 : (isReza ? 280000 : 180000),
        status: 'Dikonfirmasi',
        paymentNote: 'Lunas',
        catatan: ''
      });
    }
    setShowBookingModal(true);
  };

  // Handler to add new booking
  const handleAddBooking = (e) => {
    e.preventDefault();
    if (!bookingForm.nama) return;

    const nextId = `LS-${8904 + currentData.bookings.length}`;
    const newBooking = {
      ...bookingForm,
      id: nextId,
      badgeType: bookingForm.tier.includes('VIP') ? 'VIP' : 'Lunas'
    };

    const updatedBookings = [newBooking, ...currentData.bookings];
    const newTotal = currentData.stats.totalBooking + 1;
    const newDikonfirmasi = currentData.stats.dikonfirmasi + (newBooking.status === 'Dikonfirmasi' ? 1 : 0);
    const newPending = currentData.stats.pending + (newBooking.status === 'Menunggu' ? 1 : 0);

    setCurrentData(prev => ({
      ...prev,
      stats: {
        ...prev.stats,
        totalBooking: newTotal,
        dikonfirmasi: newDikonfirmasi,
        pending: newPending,
        dikonfirmasiSub: `${Math.round((newDikonfirmasi / (newTotal || 1)) * 100)}% Tingkat Kepastian`
      },
      bookings: updatedBookings
    }));

    setSelectedBooking(newBooking);
    setShowBookingModal(false);
    showToast(`Booking #${newBooking.id} untuk ${newBooking.nama} berhasil ditambahkan!`);
  };

  const handleLogout = () => {
    router.post('/logout');
  };

  // Format IDR helper
  const formatRupiah = (val) => {
    return 'Rp ' + (val || 0).toLocaleString('id-ID');
  };

  // Helper to find booking in timetable cell
  const getBookingForCell = (timeSlot, stylistId) => {
    return currentData.bookings.find(b => {
      const matchSlot = b.timeSlot === timeSlot || (timeSlot === '14:00 - 15:00' && b.jam.includes('14:00'));
      return matchSlot && b.stylistId === stylistId;
    });
  };

  return (
    <div className="min-h-screen bg-[#F4F5F7] font-sans text-slate-800 flex flex-col md:flex-row">
      <Head title="Jadwal & Reservasi Booking - L-Style ATELIER SUITE" />

      {/* ==========================================
          SIDEBAR NAVIGATION (LEFT)
      ========================================== */}
      <aside className="w-full md:w-64 bg-white border-r border-slate-200/80 flex flex-col shrink-0 z-30 sticky top-0 h-auto md:h-screen">
        {/* Brand Logo Header */}
        <div className="p-5 border-b border-slate-100 flex items-center gap-3">
          <div className="w-10 h-10 rounded-xl bg-slate-950 flex items-center justify-center text-white font-black text-xl shadow-md">
            L
          </div>
          <div>
            <h1 className="font-bold text-slate-900 tracking-tight text-base leading-tight">L-Style</h1>
            <p className="text-[10px] font-bold text-amber-600 tracking-wider uppercase">ATELIER SUITE</p>
          </div>
        </div>

        {/* Navigation Sections */}
        <nav className="flex-1 p-3 space-y-6 overflow-y-auto text-xs font-medium">
          {/* Operasional & Layanan */}
          <div>
            <p className="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Operasional & Layanan</p>
            <div className="space-y-1">
              <Link
                href="/barbershop/dashboard"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <LayoutGrid className="w-4 h-4 text-slate-400" />
                <span>Dashboard</span>
              </Link>

              <Link
                href="/barbershop/booking"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-slate-900 text-white shadow-sm font-semibold transition-all"
              >
                <Calendar className="w-4 h-4 text-white" />
                <span>Booking</span>
              </Link>

              <Link
                href="/barbershop/antrean"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <Clock className="w-4 h-4 text-slate-400" />
                <span>Antrean</span>
              </Link>

              <Link
                href="/barbershop/pelanggan"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <Users className="w-4 h-4 text-slate-400" />
                <span>Pelanggan</span>
              </Link>

              <Link
                href="/barbershop/membership"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <Award className="w-4 h-4 text-slate-400" />
                <span>Membership</span>
              </Link>

              <Link
                href="/barbershop/treatment"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <Scissors className="w-4 h-4 text-slate-400" />
                <span>Treatment</span>
              </Link>

              <Link
                href="/barbershop/kasir"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <ShoppingBag className="w-4 h-4 text-slate-400" />
                <span>Kasir / POS</span>
              </Link>
            </div>
          </div>

          {/* Keuangan & Relasi */}
          <div>
            <p className="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Keuangan & Relasi</p>
            <div className="space-y-1">
              <Link
                href="/barbershop/komisi"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <Percent className="w-4 h-4 text-slate-400" />
                <span>Komisi Pegawai</span>
              </Link>

              <Link
                href="/barbershop/reminder"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <Bell className="w-4 h-4 text-slate-400" />
                <span>Reminder</span>
              </Link>

              <Link
                href="/barbershop/reminder"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <MessageSquare className="w-4 h-4 text-slate-400" />
                <span>Promo WhatsApp</span>
              </Link>
            </div>
          </div>
        </nav>

        {/* Sidebar Footer Info */}
        <div className="p-3 border-t border-slate-100 space-y-2">
          <button
            onClick={() => showToast('Pengaturan Terminal System')}
            className="w-full flex items-center gap-3 px-3.5 py-2 rounded-xl text-slate-600 hover:bg-slate-100 text-xs font-medium transition-all"
          >
            <Settings className="w-4 h-4 text-slate-400" />
            <span>Pengaturan</span>
          </button>

          <div className="bg-slate-50 border border-slate-200/70 rounded-xl p-2.5 text-[11px] text-slate-500 flex items-center justify-between">
            <div>
              <p className="text-[9px] font-semibold text-slate-400 uppercase tracking-wider">Terminal Versi</p>
              <p className="font-bold text-slate-800">v2.4.0 Sovereign</p>
            </div>
            <span className="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
          </div>
        </div>
      </aside>

      {/* ==========================================
          MAIN WORKSPACE CONTENT (RIGHT)
      ========================================== */}
      <div className="flex-1 flex flex-col min-w-0 overflow-x-hidden">
        {/* Top Header Bar */}
        <header className="bg-white border-b border-slate-200/80 px-6 py-3.5 flex flex-wrap items-center justify-between gap-4 sticky top-0 z-20">
          {/* Search Input */}
          <div className="relative w-full max-w-sm">
            <Search className="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
            <input
              type="text"
              placeholder="Cari transaksi, pelanggan, atau booking..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              className="w-full pl-9 pr-10 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 transition-all"
            />
            <span className="absolute right-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-400 bg-slate-200/60 px-1.5 py-0.5 rounded border border-slate-300/50">
              HK
            </span>
          </div>

          {/* Center / Right Header Badges */}
          <div className="flex items-center gap-3">
            <div className="bg-amber-50 border border-amber-200/70 px-3 py-1.5 rounded-full flex items-center gap-2 text-xs font-semibold text-amber-800 shadow-xs">
              <span className="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
              <span>Live Outlet + 8 Stylist Aktif</span>
            </div>

            <div className="bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 flex items-center gap-2 text-xs font-medium text-slate-700 cursor-pointer hover:bg-slate-100 transition-all">
              <span className="font-semibold text-slate-900">Senopati Atelier Branch</span>
              <ChevronDown className="w-3.5 h-3.5 text-slate-400" />
            </div>

            <button
              onClick={() => setShowNotificationDrawer(!showNotificationDrawer)}
              className="relative p-2 rounded-xl bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 transition-all"
            >
              <Bell className="w-4 h-4" />
              <span className="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-red-500 ring-2 ring-white"></span>
            </button>

            {/* User Profile Pill */}
            <div className="relative">
              <button
                onClick={() => setShowUserMenu(!showUserMenu)}
                className="flex items-center gap-2.5 pl-1.5 pr-3 py-1 rounded-xl border border-slate-200 hover:bg-slate-50 transition-all text-left"
              >
                <div className="w-8 h-8 rounded-full bg-slate-900 text-white font-bold flex items-center justify-center text-xs shadow-xs">
                  {user.name.charAt(0)}
                </div>
                <div>
                  <p className="text-xs font-bold text-slate-900 leading-tight">{user.name}</p>
                  <p className="text-[10px] text-slate-500 leading-tight">Owner / Manager</p>
                </div>
              </button>

              {/* User Dropdown */}
              {showUserMenu && (
                <div className="absolute right-0 mt-2 w-56 bg-white border border-slate-200 rounded-2xl shadow-xl p-2 z-50 text-xs font-medium space-y-1">
                  <div className="p-2 border-b border-slate-100">
                    <p className="font-bold text-slate-900">{user.name}</p>
                    <p className="text-slate-400 text-[11px]">{user.email}</p>
                  </div>

                  <div className="p-2 bg-slate-50 rounded-xl space-y-1 my-1">
                    <p className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Mode Tampilan Data</p>
                    <div className="grid grid-cols-2 gap-1 pt-1">
                      <button
                        onClick={() => { setDataMode('kosong'); setShowUserMenu(false); showToast('Mode Data: Kosong (Siap Diisi)'); }}
                        className={`py-1 px-2 rounded-lg text-[11px] font-bold transition-all ${
                          dataMode === 'kosong' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 border border-slate-200'
                        }`}
                      >
                        Data Kosong
                      </button>
                      <button
                        onClick={() => { setDataMode('demo'); setShowUserMenu(false); showToast('Mode Data: Demo (Contoh Image)'); }}
                        className={`py-1 px-2 rounded-lg text-[11px] font-bold transition-all ${
                          dataMode === 'demo' ? 'bg-amber-600 text-white' : 'bg-white text-slate-700 border border-slate-200'
                        }`}
                      >
                        Data Demo
                      </button>
                    </div>
                  </div>

                  <button
                    onClick={handleLogout}
                    className="w-full flex items-center gap-2 p-2 rounded-xl text-red-600 hover:bg-red-50 text-left transition-all"
                  >
                    <span>Keluar / Logout</span>
                  </button>
                </div>
              )}
            </div>
          </div>
        </header>

        {/* Toast Alert */}
        {toastMessage && (
          <div className="mx-6 mt-4 p-3 bg-slate-900 text-white text-xs font-semibold rounded-2xl shadow-lg flex items-center justify-between animate-bounce">
            <div className="flex items-center gap-2">
              <CheckCircle className="w-4 h-4 text-emerald-400" />
              <span>{toastMessage}</span>
            </div>
            <button onClick={() => setToastMessage(null)} className="text-slate-400 hover:text-white">
              <X className="w-4 h-4" />
            </button>
          </div>
        )}

        {/* Operational Body */}
        <main className="p-6 space-y-6">

          {/* Top Breadcrumb & Actions Bar */}
          <div className="flex flex-wrap items-center justify-between gap-4">
            <div>
              <p className="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                ATELIER CONCIERGE DESK • Senopati Studio
              </p>
              <h2 className="text-2xl font-black text-slate-900 tracking-tight">Jadwal & Reservasi Booking</h2>
              <p className="text-xs text-slate-500 font-medium mt-0.5">
                Kelola jadwal temu pelanggan, kalender stylist, dan konfirmasi reservasi online secara real-time.
              </p>
            </div>

            <div className="flex items-center gap-2.5">
              {/* Date Selector */}
              <button
                onClick={() => showToast('Membuka Date Picker Kalender')}
                className="px-3.5 py-2 bg-white hover:bg-slate-50 text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-xs flex items-center gap-2"
              >
                <Calendar className="w-4 h-4 text-slate-500" />
                <span>24 Okt 2024</span>
                <ChevronDown className="w-3.5 h-3.5 text-slate-400" />
              </button>

              {/* Broadcast WA */}
              <button
                onClick={() => showToast('Membuka Panel Broadcast WhatsApp Reminder')}
                className="px-4 py-2 bg-white hover:bg-slate-50 text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-xs flex items-center gap-2"
              >
                <Send className="w-3.5 h-3.5 text-slate-600" />
                <span>Broadcast WhatsApp</span>
              </button>

              {/* + Buat Booking Baru */}
              <button
                onClick={() => { setSelectedSlotForBooking(null); setShowBookingModal(true); }}
                className="px-4 py-2 bg-slate-950 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-md flex items-center gap-2"
              >
                <Plus className="w-4 h-4" />
                <span>+ Buat Booking Baru</span>
              </button>
            </div>
          </div>

          {/* View Mode Bar & Switcher */}
          <div className="bg-white p-2 rounded-2xl border border-slate-200/80 shadow-xs flex flex-wrap items-center justify-between gap-4">
            {/* View Tabs */}
            <div className="flex items-center gap-1.5 text-xs font-semibold">
              <button
                onClick={() => setViewTab('kalender')}
                className={`px-3.5 py-2 rounded-xl transition-all flex items-center gap-2 ${
                  viewTab === 'kalender' ? 'bg-slate-100 text-slate-900 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-900'
                }`}
              >
                <LayoutGrid className="w-4 h-4 text-slate-600" />
                <span>Tampilan Kalender / Jadwal</span>
              </button>

              <button
                onClick={() => setViewTab('tabel')}
                className={`px-3.5 py-2 rounded-xl transition-all flex items-center gap-2 ${
                  viewTab === 'tabel' ? 'bg-slate-100 text-slate-900 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-900'
                }`}
              >
                <BarChart2 className="w-4 h-4 text-slate-500" />
                <span>Tampilan Tabel Daftar</span>
              </button>

              <button
                onClick={() => setViewTab('stylist')}
                className={`px-3.5 py-2 rounded-xl transition-all flex items-center gap-2 ${
                  viewTab === 'stylist' ? 'bg-slate-100 text-slate-900 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-900'
                }`}
              >
                <Users className="w-4 h-4 text-slate-500" />
                <span>Jadwal per Barber/Stylist</span>
              </button>
            </div>

            {/* Nav & Mode controls */}
            <div className="flex items-center gap-3 text-xs">
              <div className="flex items-center gap-2 bg-slate-50 px-3 py-1.5 rounded-xl border border-slate-200">
                <button className="text-slate-400 hover:text-slate-700">
                  <ChevronLeft className="w-4 h-4" />
                </button>
                <span className="font-bold text-slate-800">Hari Ini • Kamis, 24 Okt</span>
                <button className="text-slate-400 hover:text-slate-700">
                  <ChevronRight className="w-4 h-4" />
                </button>
              </div>

              {/* Data Mode Switcher Button */}
              <button
                onClick={() => {
                  const nextMode = dataMode === 'kosong' ? 'demo' : 'kosong';
                  setDataMode(nextMode);
                  showToast(`Mode Data Diubah ke: ${nextMode.toUpperCase()}`);
                }}
                className={`px-3 py-1.5 rounded-xl font-bold border transition-all flex items-center gap-1.5 ${
                  dataMode === 'kosong'
                    ? 'bg-slate-100 text-slate-800 border-slate-300'
                    : 'bg-amber-500 text-white border-amber-600 shadow-xs'
                }`}
              >
                <RefreshCw className="w-3.5 h-3.5" />
                <span>{dataMode === 'kosong' ? 'Mode Kosong (Siap Diisi)' : 'Mode Demo (Gambar Sample)'}</span>
              </button>
            </div>
          </div>

          {/* ==========================================
              TOP 4 STAT CARDS GRID
          ========================================== */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {/* Stat 1: TOTAL BOOKING HARI INI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">TOTAL BOOKING HARI INI</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.totalBooking} <span className="text-xs font-medium text-slate-400">Slot</span></h3>
                <p className="text-[11px] text-slate-500 mt-0.5">{currentData.stats.targetSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-700">
                <Calendar className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 2: DIKONFIRMASI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">DIKONFIRMASI</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.dikonfirmasi} <span className="text-xs font-medium text-slate-400">Tamu Siap</span></h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-0.5">• {currentData.stats.dikonfirmasiSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <CheckCircle className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 3: MENUNGGU KONFIRMASI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">MENUNGGU KONFIRMASI</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.pending} <span className="text-xs font-medium text-slate-400">Pending</span></h3>
                <p className="text-[11px] font-semibold text-amber-600 mt-0.5">{currentData.stats.pendingSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <Clock className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 4: DIBATALKAN / RESCHEDULE */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">DIBATALKAN / RESCHEDULE</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.dibatalkan} <span className="text-xs font-medium text-slate-400">Slot Kosong</span></h3>
                <p className="text-[11px] font-semibold text-red-600 mt-0.5">{currentData.stats.dibatalkanSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center">
                <CalendarX className="w-5 h-5" />
              </div>
            </div>
          </div>

          {/* ==========================================
              MAIN TIMETABLE GRID & DETAIL PANEL
          ========================================== */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {/* LEFT 2 COLS: Timetable Stylist Grid */}
            <div className="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
              <div className="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-4">
                <div>
                  <h3 className="font-extrabold text-slate-900 text-base">Alokasi Timetable Stylist</h3>
                  <p className="text-xs text-slate-500 font-medium">Studio Lantai 1 & 2</p>
                </div>

                {/* Status Legend */}
                <div className="flex items-center gap-3 text-xs font-semibold">
                  <div className="flex items-center gap-1.5">
                    <span className="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <span className="text-slate-700">Dikonfirmasi</span>
                  </div>
                  <div className="flex items-center gap-1.5">
                    <span className="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
                    <span className="text-slate-700">Menunggu Konfirmasi</span>
                  </div>
                  <div className="flex items-center gap-1.5">
                    <span className="w-2.5 h-2.5 rounded-full bg-slate-200 border border-slate-300"></span>
                    <span className="text-slate-700">Slot Terbuka</span>
                  </div>
                </div>
              </div>

              {/* Timetable Headers (Stylists) */}
              <div className="grid grid-cols-4 gap-3 text-xs font-bold border-b border-slate-100 pb-3">
                <div className="text-slate-400 uppercase tracking-wider text-[10px] pl-2 pt-2">WAKTU</div>
                <div className="flex items-center gap-2 bg-slate-50 p-2 rounded-xl border border-slate-200/60">
                  <div className="w-7 h-7 rounded-full bg-slate-900 text-white font-bold flex items-center justify-center text-[10px]">BD</div>
                  <div>
                    <p className="text-slate-900 leading-tight">Barber David</p>
                    <p className="text-[9px] text-slate-400 font-normal">Master Groomer • Kursi 01</p>
                  </div>
                </div>
                <div className="flex items-center gap-2 bg-slate-50 p-2 rounded-xl border border-slate-200/60">
                  <div className="w-7 h-7 rounded-full bg-slate-900 text-white font-bold flex items-center justify-center text-[10px]">BR</div>
                  <div>
                    <p className="text-slate-900 leading-tight">Barber Reza</p>
                    <p className="text-[9px] text-slate-400 font-normal">Senior Fade Artisan • Kursi 02</p>
                  </div>
                </div>
                <div className="flex items-center gap-2 bg-slate-50 p-2 rounded-xl border border-slate-200/60">
                  <div className="w-7 h-7 rounded-full bg-slate-900 text-white font-bold flex items-center justify-center text-[10px]">SE</div>
                  <div>
                    <p className="text-slate-900 leading-tight">Stylist Elena</p>
                    <p className="text-[9px] text-slate-400 font-normal">Color Specialist • Kursi 03</p>
                  </div>
                </div>
              </div>

              {/* Timetable Rows */}
              <div className="space-y-3">
                {[
                  { time: '10:00 WIB', slotId: '10:00' },
                  { time: '11:00 WIB', slotId: '11:00' },
                  { time: '12:00 WIB', slotId: '12:00' },
                  { time: '13:00 WIB', slotId: '13:00' },
                  { time: '14:00 - 15:00 WIB', slotId: '14:00 - 15:00', isSessionActive: true },
                  { time: '16:00 WIB', slotId: '16:00' }
                ].map((row) => (
                  <div key={row.slotId} className={`grid grid-cols-4 gap-3 text-xs items-center p-1 rounded-2xl ${
                    row.isSessionActive ? 'bg-amber-50/30 border border-amber-200/50' : ''
                  }`}>
                    {/* Time Column */}
                    <div className="font-bold text-slate-800 text-xs pl-2">
                      <p>{row.time}</p>
                      {row.isSessionActive && (
                        <span className="text-[9px] font-bold text-amber-700 uppercase tracking-wider block">Sesi Aktif</span>
                      )}
                    </div>

                    {/* Barber David Cell */}
                    {(() => {
                      const b = getBookingForCell(row.slotId, 'david');
                      if (b) {
                        return (
                          <div
                            onClick={() => setSelectedBooking(b)}
                            className={`p-3 rounded-2xl border transition-all cursor-pointer shadow-xs ${
                              selectedBooking?.id === b.id
                                ? 'bg-slate-950 text-white border-slate-900 ring-2 ring-amber-500'
                                : 'bg-slate-50 border-slate-200/80 hover:bg-slate-100'
                            }`}
                          >
                            <div className="flex items-center justify-between">
                              <h5 className={`font-extrabold text-xs ${selectedBooking?.id === b.id ? 'text-white' : 'text-slate-900'}`}>{b.nama}</h5>
                              <span className="text-[9px] font-bold px-1.5 py-0.5 rounded bg-amber-100 text-amber-900">{b.badgeType}</span>
                            </div>
                            <p className={`text-[11px] mt-0.5 font-medium ${selectedBooking?.id === b.id ? 'text-slate-300' : 'text-slate-600'}`}>{b.layanan}</p>
                            <div className="mt-2 flex items-center justify-between text-[10px]">
                              <span className="flex items-center gap-1">
                                <Clock className="w-3 h-3 text-slate-400" />
                                <span>{b.durasi}</span>
                              </span>
                              <span className="font-semibold text-amber-500">{b.status}</span>
                            </div>
                          </div>
                        );
                      }
                      return (
                        <button
                          onClick={() => openBookingModalWithSlot({ slot: row.slotId, stylistId: 'david', stylistName: 'Barber David' })}
                          className="w-full py-3.5 border-2 border-dashed border-slate-200 rounded-2xl text-slate-400 hover:text-slate-700 hover:border-slate-300 text-xs font-semibold transition-all flex items-center justify-center gap-1"
                        >
                          <Plus className="w-3.5 h-3.5" />
                          <span>Slot Kosong</span>
                        </button>
                      );
                    })()}

                    {/* Barber Reza Cell */}
                    {(() => {
                      const b = getBookingForCell(row.slotId, 'reza');
                      if (b) {
                        return (
                          <div
                            onClick={() => setSelectedBooking(b)}
                            className={`p-3 rounded-2xl border transition-all cursor-pointer shadow-xs ${
                              selectedBooking?.id === b.id
                                ? 'bg-slate-950 text-white border-slate-900 ring-2 ring-amber-500'
                                : b.status === 'Batal'
                                ? 'bg-red-50/50 border-red-200 text-red-900'
                                : 'bg-slate-50 border-slate-200/80 hover:bg-slate-100'
                            }`}
                          >
                            <div className="flex items-center justify-between">
                              <h5 className={`font-extrabold text-xs ${selectedBooking?.id === b.id ? 'text-white' : 'text-slate-900'}`}>{b.nama}</h5>
                              <span className={`text-[9px] font-bold px-1.5 py-0.5 rounded ${
                                b.status === 'Batal' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-900'
                              }`}>{b.badgeType}</span>
                            </div>
                            <p className={`text-[11px] mt-0.5 font-medium ${selectedBooking?.id === b.id ? 'text-slate-300' : 'text-slate-600'}`}>{b.layanan}</p>
                            <div className="mt-2 flex items-center justify-between text-[10px]">
                              <span className="flex items-center gap-1">
                                <Clock className="w-3 h-3 text-slate-400" />
                                <span>{b.durasi}</span>
                              </span>
                              <span className={`font-semibold ${b.status === 'Batal' ? 'text-red-600' : 'text-amber-500'}`}>{b.status}</span>
                            </div>
                          </div>
                        );
                      }
                      return (
                        <button
                          onClick={() => openBookingModalWithSlot({ slot: row.slotId, stylistId: 'reza', stylistName: 'Barber Reza' })}
                          className="w-full py-3.5 border-2 border-dashed border-slate-200 rounded-2xl text-slate-400 hover:text-slate-700 hover:border-slate-300 text-xs font-semibold transition-all flex items-center justify-center gap-1"
                        >
                          <Plus className="w-3.5 h-3.5" />
                          <span>Slot Kosong</span>
                        </button>
                      );
                    })()}

                    {/* Stylist Elena Cell */}
                    {(() => {
                      const b = getBookingForCell(row.slotId, 'elena');
                      if (b) {
                        return (
                          <div
                            onClick={() => setSelectedBooking(b)}
                            className={`p-3 rounded-2xl border transition-all cursor-pointer shadow-xs ${
                              selectedBooking?.id === b.id
                                ? 'bg-slate-950 text-white border-slate-900 ring-2 ring-amber-500'
                                : 'bg-slate-50 border-slate-200/80 hover:bg-slate-100'
                            }`}
                          >
                            <div className="flex items-center justify-between">
                              <h5 className={`font-extrabold text-xs ${selectedBooking?.id === b.id ? 'text-white' : 'text-slate-900'}`}>{b.nama}</h5>
                              <span className="text-[9px] font-bold px-1.5 py-0.5 rounded bg-amber-100 text-amber-900">{b.badgeType}</span>
                            </div>
                            <p className={`text-[11px] mt-0.5 font-medium ${selectedBooking?.id === b.id ? 'text-slate-300' : 'text-slate-600'}`}>{b.layanan}</p>
                            <div className="mt-2 flex items-center justify-between text-[10px]">
                              <span className="flex items-center gap-1">
                                <Clock className="w-3 h-3 text-slate-400" />
                                <span>{b.durasi}</span>
                              </span>
                              <span className="font-semibold text-amber-500">{b.status}</span>
                            </div>
                          </div>
                        );
                      }
                      return (
                        <button
                          onClick={() => openBookingModalWithSlot({ slot: row.slotId, stylistId: 'elena', stylistName: 'Stylist Elena' })}
                          className="w-full py-3.5 border-2 border-dashed border-slate-200 rounded-2xl text-slate-400 hover:text-slate-700 hover:border-slate-300 text-xs font-semibold transition-all flex items-center justify-center gap-1"
                        >
                          <Plus className="w-3.5 h-3.5" />
                          <span>Slot Kosong</span>
                        </button>
                      );
                    })()}
                  </div>
                ))}
              </div>

              {/* Night Session Banner */}
              <div className="mt-4 p-4 bg-slate-50 border border-slate-200/80 rounded-2xl flex flex-wrap items-center justify-between gap-4 text-xs">
                <div className="flex items-center gap-2">
                  <span className="font-bold text-slate-900">17:00 - 20:00 WIB</span>
                  <span className="text-slate-500 font-medium">• Sesi Malam Atelier ({currentData.bookings.length} Reservasi Terjadwal)</span>
                </div>
                <span className="text-[11px] text-slate-400 font-medium">David: 2 • Reza: 1 • Elena: 1</span>
              </div>
            </div>

            {/* RIGHT 1 COL: Detail Reservasi Terpilih Drawer */}
            <div className="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
              {selectedBooking ? (
                <div className="space-y-5">
                  <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 className="font-extrabold text-slate-900 text-sm">Detail Reservasi Terpilih</h3>
                    <span className="px-2.5 py-1 bg-amber-100 text-amber-900 text-[11px] font-black rounded-lg">
                      BOOKING #{selectedBooking.id}
                    </span>
                  </div>

                  {/* Customer Card */}
                  <div className="bg-slate-50 border border-slate-200/60 rounded-2xl p-4 flex items-center gap-3">
                    <div className="w-12 h-12 rounded-2xl bg-slate-950 text-white font-black flex items-center justify-center text-sm shadow-xs">
                      {selectedBooking.nama.split(' ').map(n => n[0]).join('').slice(0, 2)}
                    </div>
                    <div>
                      <h4 className="font-extrabold text-slate-900 text-base leading-tight">{selectedBooking.nama}</h4>
                      <p className="text-xs text-slate-500 font-mono mt-0.5">{selectedBooking.phone}</p>
                      <span className="text-[9px] font-bold text-purple-700 bg-purple-50 px-2 py-0.5 rounded border border-purple-200/60 inline-block mt-1">
                        {selectedBooking.tier}
                      </span>
                    </div>
                  </div>

                  {/* Layanan & Durasi */}
                  <div>
                    <p className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">LAYANAN & DURASI</p>
                    <h5 className="font-bold text-slate-900 text-sm mt-0.5">{selectedBooking.layanan}</h5>
                    <p className="text-xs text-slate-500 font-medium">Durasi: {selectedBooking.durasi}</p>
                  </div>

                  {/* Barber / Stylist */}
                  <div>
                    <p className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">BARBER / STYLIST PENANGGUNG JAWAB</p>
                    <h5 className="font-bold text-slate-900 text-xs mt-0.5 flex items-center gap-1.5">
                      <Scissors className="w-3.5 h-3.5 text-amber-500" />
                      <span>{selectedBooking.stylist}</span>
                    </h5>
                    <p className="text-xs text-slate-500 font-medium">{selectedBooking.kursi}</p>
                  </div>

                  {/* Jadwal Sesi */}
                  <div>
                    <p className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">JADWAL SESI</p>
                    <p className="font-bold text-slate-900 text-xs mt-0.5 flex items-center gap-1.5">
                      <Calendar className="w-3.5 h-3.5 text-slate-500" />
                      <span>{selectedBooking.tanggal}</span>
                    </p>
                    <p className="text-xs text-slate-700 font-semibold">{selectedBooking.jam}</p>
                  </div>

                  {/* Biaya Estimasi & Status */}
                  <div className="bg-amber-50/60 border border-amber-200/60 rounded-2xl p-3.5 flex items-center justify-between">
                    <div>
                      <p className="text-[10px] font-bold text-amber-800 uppercase tracking-wider">BIAYA ESTIMASI & STATUS</p>
                      <h4 className="text-xl font-black text-slate-900 mt-0.5">{formatRupiah(selectedBooking.amount)}</h4>
                      <p className="text-[10px] text-slate-500">{selectedBooking.paymentNote}</p>
                    </div>
                    <span className="px-2.5 py-1 bg-amber-500 text-slate-950 font-bold text-xs rounded-lg">
                      {selectedBooking.status}
                    </span>
                  </div>

                  {/* Catatan Khusus */}
                  {selectedBooking.catatan && (
                    <div>
                      <p className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">CATATAN KHUSUS TAMU</p>
                      <p className="text-xs text-slate-600 bg-slate-50 p-2.5 rounded-xl border border-slate-200/60 mt-1 italic">
                        "{selectedBooking.catatan}"
                      </p>
                    </div>
                  )}

                  {/* Drawer Action Buttons */}
                  <div className="space-y-2 pt-2 border-t border-slate-100">
                    <button
                      onClick={() => showToast(`Tamu ${selectedBooking.nama} berhasil Di-Check-in!`)}
                      className="w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl text-xs transition-all shadow-xs flex items-center justify-center gap-2"
                    >
                      <Check className="w-4 h-4 text-emerald-400" />
                      <span>Check-in & Masukkan Antrean</span>
                    </button>

                    <button
                      onClick={() => showToast(`WhatsApp Reminder dikirim ke ${selectedBooking.phone}!`)}
                      className="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold rounded-xl text-xs transition-all border border-slate-200 flex items-center justify-center gap-2"
                    >
                      <Send className="w-3.5 h-3.5 text-slate-600" />
                      <span>Kirim WhatsApp Reminder</span>
                    </button>

                    <div className="grid grid-cols-2 gap-2">
                      <button
                        onClick={() => showToast('Membuka Ubah Jadwal Booking')}
                        className="py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs border border-slate-200"
                      >
                        Ubah Jadwal
                      </button>
                      <button
                        onClick={() => showToast('Booking Dibatalakan!')}
                        className="py-2 bg-red-50 hover:bg-red-100 text-red-700 font-bold rounded-xl text-xs border border-red-200"
                      >
                        Batalkan
                      </button>
                    </div>
                  </div>
                </div>
              ) : (
                <div className="py-24 text-center text-slate-400 space-y-3">
                  <Calendar className="w-10 h-10 mx-auto text-slate-300" />
                  <p className="text-sm font-semibold">Pilih atau Tambah Booking untuk Melihat Detail Sesi</p>
                  <button
                    onClick={() => { setSelectedSlotForBooking(null); setShowBookingModal(true); }}
                    className="px-4 py-2 bg-amber-500 text-slate-950 text-xs font-bold rounded-xl shadow-xs transition-all"
                  >
                    + Buat Booking Pertama
                  </button>
                </div>
              )}
            </div>

          </div>

        </main>
      </div>

      {/* ==========================================
          MODAL BUAT BOOKING BARU
      ========================================== */}
      {showBookingModal && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4 border border-slate-200">
            <div className="flex items-center justify-between border-b border-slate-100 pb-3">
              <h3 className="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                <Calendar className="w-5 h-5 text-amber-500" />
                <span>+ Buat Booking Baru</span>
              </h3>
              <button onClick={() => setShowBookingModal(false)} className="text-slate-400 hover:text-slate-600">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleAddBooking} className="space-y-3 text-xs">
              <div>
                <label className="font-bold text-slate-700 block mb-1">Nama Pelanggan</label>
                <input
                  type="text"
                  required
                  placeholder="Misal: Jessica Aurelia"
                  value={bookingForm.nama}
                  onChange={(e) => setBookingForm({ ...bookingForm, nama: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Nomor WhatsApp / HP</label>
                  <input
                    type="text"
                    placeholder="0811-9234-5678"
                    value={bookingForm.phone}
                    onChange={(e) => setBookingForm({ ...bookingForm, phone: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Jam & Sesi Sesi</label>
                  <input
                    type="text"
                    placeholder="14:00 - 16:00 WIB"
                    value={bookingForm.jam}
                    onChange={(e) => setBookingForm({ ...bookingForm, jam: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Layanan Hair Treatment</label>
                <select
                  value={bookingForm.layanan}
                  onChange={(e) => setBookingForm({ ...bookingForm, layanan: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                >
                  <option value="Balayage & Gloss Hair Treatment">Balayage & Gloss Hair Treatment (Rp 650.000)</option>
                  <option value="Signature Gentleman Cut">Signature Gentleman Cut (Rp 180.000)</option>
                  <option value="Executive Cut & Scalp Detox">Executive Cut & Scalp Detox (Rp 280.000)</option>
                  <option value="Hydra Keratin Therapy">Hydra Keratin Therapy (Rp 550.000)</option>
                </select>
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Pilih Barber / Stylist</label>
                  <select
                    value={bookingForm.stylistId}
                    onChange={(e) => {
                      const id = e.target.value;
                      const name = id === 'david' ? 'Barber David' : (id === 'reza' ? 'Barber Reza' : 'Stylist Elena Rose');
                      setBookingForm({ ...bookingForm, stylistId: id, stylist: name });
                    }}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  >
                    <option value="david">Barber David (Kursi 01)</option>
                    <option value="reza">Barber Reza (Kursi 02)</option>
                    <option value="elena">Stylist Elena Rose (Kursi 03)</option>
                  </select>
                </div>

                <div>
                  <label className="font-bold text-slate-700 block mb-1">Estimasi Biaya (Rp)</label>
                  <input
                    type="number"
                    value={bookingForm.amount}
                    onChange={(e) => setBookingForm({ ...bookingForm, amount: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl font-bold focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Catatan Khusus / Preferensi</label>
                <textarea
                  rows="2"
                  placeholder="Catatan warna, sensitivitas scalp, dll..."
                  value={bookingForm.catatan}
                  onChange={(e) => setBookingForm({ ...bookingForm, catatan: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                ></textarea>
              </div>

              <div className="pt-2 flex justify-end gap-2">
                <button
                  type="button"
                  onClick={() => setShowBookingModal(false)}
                  className="px-4 py-2 bg-slate-100 text-slate-700 font-bold rounded-xl"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="px-5 py-2 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-xl shadow-md"
                >
                  Simpan Booking Baru
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

    </div>
  );
}
