import React, { useState, useEffect } from 'react';
import { Head, usePage, router, Link } from '@inertiajs/react';
import {
  LayoutGrid, Calendar, Users, Award, Scissors, ShoppingBag,
  Percent, Bell, MessageSquare, Settings, Search, Plus, CheckCircle,
  Clock, ArrowUpRight, ChevronRight, X, User, CreditCard, ChevronDown,
  Sparkles, ShieldCheck, Check, DollarSign, RefreshCw, BarChart2, Filter,
  Phone, AlertCircle, Eye, Printer, Trash2
} from 'lucide-react';

export default function AtelierDashboard({ auth }) {
  const user = auth?.user || { name: 'Mario Alfarizi', email: 'admin@lstyle.id', role: 'Owner / Manager' };

  // ==========================================
  // STATE MANAGEMENT
  // ==========================================
  // Mode data: 'kosong' (Default - empty for user to input) vs 'demo' (Pre-populated sample data)
  const [dataMode, setDataMode] = useState('kosong'); 
  const [activeTab, setActiveTab] = useState('dashboard');
  const [reservationTab, setReservationTab] = useState('semua');
  const [searchQuery, setSearchQuery] = useState('');
  const [toastMessage, setToastMessage] = useState(null);

  // Modals state
  const [showBookingModal, setShowBookingModal] = useState(false);
  const [showWalkInModal, setShowWalkInModal] = useState(false);
  const [showKasirModal, setShowKasirModal] = useState(false);
  const [selectedChair, setSelectedChair] = useState(null);
  const [selectedBookingForKasir, setSelectedBookingForKasir] = useState(null);

  // Notifications Drawer & User Menu
  const [showNotificationDrawer, setShowNotificationDrawer] = useState(false);
  const [showUserMenu, setShowUserMenu] = useState(false);

  // Toast Notification helper
  const showToast = (msg) => {
    setToastMessage(msg);
    setTimeout(() => setToastMessage(null), 4000);
  };

  // ==========================================
  // INITIAL DEMO VS EMPTY DATA SETS
  // ==========================================
  const demoData = {
    stats: {
      bookingCount: 18,
      bookingChange: '+12% dibanding kemarin',
      customerCount: 24,
      customerSub: '6 Walk-in terlayani mulus',
      chairActive: 4,
      chairTotal: 6,
      chairPercent: '67%',
      omzetAmount: 4850000,
      omzetChange: '+8.5% vs target harian'
    },
    liveAntrean: {
      id: 'A-015',
      namaTamu: 'Dimas Pratama',
      badge: 'Gold VIP',
      phone: '+62 812-4491-0021',
      layanan: 'Gentleman Royal Cut',
      artisan: 'Barber Reza Pratama (Kursi 02)',
      progressMnt: 28,
      totalMnt: 45,
      percent: 62,
      estSelesai: '14:15 WIB',
      urutanBerikutnya: 'A-016 • Farhan Ramadhan'
    },
    chairs: [
      { id: '01', stylist: 'David Gunawan', status: 'Terisi', sisaMnt: 'Sisa 10 mnt', tamu: 'Randy', layanan: 'Fade Cut', isDark: false },
      { id: '02', stylist: 'Reza Pratama', status: 'Terisi', sisaMnt: 'Sisa 18 mnt', tamu: 'Dimas P.', layanan: 'Royal Cut', isDark: true },
      { id: '03', stylist: 'Elena Rose', status: 'Terisi', sisaMnt: 'Sisa 25 mnt', tamu: 'Maya', layanan: 'Hair Coloring', isDark: false },
      { id: '04', stylist: 'Kevin Sanjaya', status: 'Tersedia', sisaMnt: 'Tersedia / Siap', tamu: '-', layanan: '-', isDark: false },
      { id: '05_06', stylist: 'Scalp Ritual Pods', status: 'Terisi', sisaMnt: '1 Sedang Dipakai + 1 Siap Bilas', tamu: 'Pod Operasional', layanan: 'Scalp Treatment', isDark: false }
    ],
    reservations: [
      { id: 1, jam: '14:00 WIB', nama: 'Jessica Aurelia', tier: 'Membership Platinum', layanan: 'Balayage & Gloss', stylist: 'Stylist Elena', status: 'Dikonfirmasi', amount: 650000, note: 'DP 50% Main' },
      { id: 2, jam: '14:30 WIB', nama: 'Arif Wibowo', tier: 'Tamu Reguler', layanan: 'Cut & Hot Towel', stylist: 'Barber Dimas', status: 'Dikonfirmasi', amount: 180000, note: 'Lunas di Kasir' },
      { id: 3, jam: '15:15 WIB', nama: 'Citra Kirana', tier: 'Gold Member', layanan: 'Korean Perm & Ritual', stylist: 'Stylist Kevin', status: 'Menunggu Datang', amount: 520000, note: 'Belum DP' },
      { id: 4, jam: '16:00 WIB', nama: 'Bimo Santoso', tier: 'Tamu Reguler', layanan: 'Signature Cut', stylist: 'Barber David', status: 'Dikonfirmasi', amount: 180000, note: 'Bayar di Tempat' }
    ],
    activities: [
      { id: 1, type: 'payment', title: 'Pembayaran Sukses', desc: 'Rp 350.000 oleh Bimo S. via QRIS BCA Atelier POS.', time: '2m lalu' },
      { id: 2, type: 'member', title: 'Membership Baru', desc: 'Sarah Theodore terdaftar Tier Black Gold VIP.', time: '14m lalu' },
      { id: 3, type: 'done', title: 'Treatment Selesai', desc: 'Arka M. (Kursi 04) selesai ditangani oleh Barber Kevin.', time: '28m lalu' },
      { id: 4, type: 'wa', title: 'Reservasi WhatsApp', desc: 'Booking otomatis via bot WhatsApp masuk untuk sesi esok 11:00.', time: '40m lalu' }
    ],
    stylists: [
      { id: 1, code: 'RP', name: 'Reza Pratama', role: 'Barber', active: true },
      { id: 2, code: 'DG', name: 'David Gunawan', role: 'Barber', active: true },
      { id: 3, code: 'ER', name: 'Elena Rose', role: 'Stylist', active: true },
      { id: 4, code: 'KS', name: 'Kevin Sanjaya', role: 'Stylist', active: true },
      { id: 5, code: 'AM', name: 'Arka Maulana', role: 'Barber', active: true },
      { id: 6, code: 'FR', name: 'Farhan Ramadhan', role: 'Barber', active: true },
      { id: 7, code: 'ST', name: 'Siti Rahma', role: 'Stylist', active: true },
      { id: 8, code: 'NW', name: 'Nadia Wijaya', role: 'Stylist', active: true }
    ]
  };

  const emptyData = {
    stats: {
      bookingCount: 0,
      bookingChange: 'Belum ada jadwal hari ini',
      customerCount: 0,
      customerSub: '0 Tamu terdaftar',
      chairActive: 0,
      chairTotal: 6,
      chairPercent: '0%',
      omzetAmount: 0,
      omzetChange: 'Target: Rp 5.000.000'
    },
    liveAntrean: null,
    chairs: [
      { id: '01', stylist: 'David Gunawan', status: 'Tersedia', sisaMnt: 'Tersedia / Siap', tamu: '-', layanan: '-', isDark: false },
      { id: '02', stylist: 'Reza Pratama', status: 'Tersedia', sisaMnt: 'Tersedia / Siap', tamu: '-', layanan: '-', isDark: false },
      { id: '03', stylist: 'Elena Rose', status: 'Tersedia', sisaMnt: 'Tersedia / Siap', tamu: '-', layanan: '-', isDark: false },
      { id: '04', stylist: 'Kevin Sanjaya', status: 'Tersedia', sisaMnt: 'Tersedia / Siap', tamu: '-', layanan: '-', isDark: false },
      { id: '05_06', stylist: 'Scalp Ritual Pods', status: 'Tersedia', sisaMnt: '2 Unit Siap Pakai', tamu: '-', layanan: '-', isDark: false }
    ],
    reservations: [],
    activities: [],
    stylists: [
      { id: 1, code: 'RP', name: 'Reza Pratama', role: 'Barber', active: true },
      { id: 2, code: 'DG', name: 'David Gunawan', role: 'Barber', active: true },
      { id: 3, code: 'ER', name: 'Elena Rose', role: 'Stylist', active: true },
      { id: 4, code: 'KS', name: 'Kevin Sanjaya', role: 'Stylist', active: true }
    ]
  };

  // State data for dynamic operations
  const [currentData, setCurrentData] = useState(emptyData);

  // Sync state whenever dataMode switches
  useEffect(() => {
    if (dataMode === 'demo') {
      setCurrentData(demoData);
    } else {
      setCurrentData(emptyData);
    }
  }, [dataMode]);

  // Form states for modals
  const [bookingForm, setBookingForm] = useState({
    nama: '',
    phone: '',
    tier: 'Tamu Reguler',
    jam: '14:00 WIB',
    layanan: 'Gentleman Royal Cut',
    stylist: 'Barber Reza Pratama',
    amount: 180000,
    status: 'Dikonfirmasi'
  });

  const [walkInForm, setWalkInForm] = useState({
    nama: '',
    phone: '',
    layanan: 'Gentleman Royal Cut',
    stylist: 'Barber Reza Pratama',
    kursiId: '01'
  });

  const [kasirForm, setKasirForm] = useState({
    nama: '',
    layanan: '',
    amount: 0,
    paymentMethod: 'QRIS BCA Atelier POS',
    diskon: 0
  });

  // ==========================================
  // HANDLERS FOR ADDING / MUTATING DATA
  // ==========================================
  const handleAddBooking = (e) => {
    e.preventDefault();
    if (!bookingForm.nama) return;

    const newRes = {
      id: Date.now(),
      jam: bookingForm.jam || '14:00 WIB',
      nama: bookingForm.nama,
      tier: bookingForm.tier,
      layanan: bookingForm.layanan,
      stylist: bookingForm.stylist,
      status: bookingForm.status,
      amount: Number(bookingForm.amount) || 180000,
      note: 'Daftar via System'
    };

    const updatedReservations = [newRes, ...currentData.reservations];
    const newOmzet = currentData.stats.omzetAmount + (bookingForm.status === 'Dikonfirmasi' ? newRes.amount : 0);
    const newBookingCount = currentData.stats.bookingCount + 1;
    const newCustomerCount = currentData.stats.customerCount + 1;

    // Add activity log
    const newAct = {
      id: Date.now(),
      type: 'wa',
      title: 'Reservasi Baru Added',
      desc: `${newRes.nama} (${newRes.layanan}) dijadwalkan pada ${newRes.jam}.`,
      time: 'Baru saja'
    };

    setCurrentData(prev => ({
      ...prev,
      stats: {
        ...prev.stats,
        bookingCount: newBookingCount,
        bookingChange: `+${newBookingCount} total jadwal`,
        customerCount: newCustomerCount,
        customerSub: `${newCustomerCount} Tamu terdaftar`
      },
      reservations: updatedReservations,
      activities: [newAct, ...prev.activities]
    }));

    setShowBookingModal(false);
    setBookingForm({ nama: '', phone: '', tier: 'Tamu Reguler', jam: '14:00 WIB', layanan: 'Gentleman Royal Cut', stylist: 'Barber Reza Pratama', amount: 180000, status: 'Dikonfirmasi' });
    showToast(`Reservasi untuk ${newRes.nama} berhasil ditambahkan!`);
  };

  const handleAddWalkIn = (e) => {
    e.preventDefault();
    if (!walkInForm.nama) return;

    // Put into Live Antrean Pod
    const newLivePod = {
      id: `A-0${currentData.stats.customerCount + 1}`,
      namaTamu: walkInForm.nama,
      badge: 'Walk-in',
      phone: walkInForm.phone || '+62 812-0000-1122',
      layanan: walkInForm.layanan,
      artisan: `${walkInForm.stylist} (Kursi ${walkInForm.kursiId})`,
      progressMnt: 5,
      totalMnt: 45,
      percent: 11,
      estSelesai: 'Hari ini, 35 mnt lagi',
      urutanBerikutnya: 'Tamu berikutnya di antrean'
    };

    // Update Chair state
    const updatedChairs = currentData.chairs.map(c => {
      if (c.id === walkInForm.kursiId) {
        return {
          ...c,
          status: 'Terisi',
          sisaMnt: 'Sisa 35 mnt',
          tamu: walkInForm.nama,
          layanan: walkInForm.layanan,
          isDark: true
        };
      }
      return c;
    });

    const activeCount = updatedChairs.filter(c => c.status === 'Terisi').length;
    const percentStr = Math.round((activeCount / 6) * 100) + '%';

    const newAct = {
      id: Date.now(),
      type: 'done',
      title: 'Walk-in Baru Masuk Pod',
      desc: `${walkInForm.nama} menempati Kursi ${walkInForm.kursiId} (${walkInForm.layanan}).`,
      time: 'Baru saja'
    };

    setCurrentData(prev => ({
      ...prev,
      liveAntrean: newLivePod,
      chairs: updatedChairs,
      stats: {
        ...prev.stats,
        customerCount: prev.stats.customerCount + 1,
        customerSub: `${prev.stats.customerCount + 1} Walk-in terlayani`,
        chairActive: activeCount,
        chairPercent: percentStr
      },
      activities: [newAct, ...prev.activities]
    }));

    setShowWalkInModal(false);
    setWalkInForm({ nama: '', phone: '', layanan: 'Gentleman Royal Cut', stylist: 'Barber Reza Pratama', kursiId: '01' });
    showToast(`Walk-in ${walkInForm.nama} berhasil ditempatkan di Kursi ${walkInForm.kursiId}!`);
  };

  const handleProcessPayment = (e) => {
    e.preventDefault();
    const finalAmount = Number(kasirForm.amount) - Number(kasirForm.diskon || 0);

    const newAct = {
      id: Date.now(),
      type: 'payment',
      title: 'Pembayaran Sukses POS',
      desc: `Rp ${finalAmount.toLocaleString('id-ID')} oleh ${kasirForm.nama || 'Tamu POS'} via ${kasirForm.paymentMethod}.`,
      time: 'Baru saja'
    };

    setCurrentData(prev => ({
      ...prev,
      stats: {
        ...prev.stats,
        omzetAmount: prev.stats.omzetAmount + finalAmount,
        omzetChange: '+ Terupdate dari Kasir POS'
      },
      activities: [newAct, ...prev.activities]
    }));

    setShowKasirModal(false);
    showToast(`Pembayaran Rp ${finalAmount.toLocaleString('id-ID')} Berhasil Disimpan!`);
  };

  const openKasirFor = (res) => {
    setSelectedBookingForKasir(res);
    setKasirForm({
      nama: res ? res.nama : 'Dimas Pratama',
      layanan: res ? res.layanan : 'Gentleman Royal Cut',
      amount: res ? res.amount : 180000,
      paymentMethod: 'QRIS BCA Atelier POS',
      diskon: 0
    });
    setShowKasirModal(true);
  };

  const handleLogout = () => {
    router.post('/logout');
  };

  // Format IDR helper
  const formatRupiah = (val) => {
    return 'Rp ' + (val || 0).toLocaleString('id-ID');
  };

  // Filter reservations based on active tab
  const filteredReservations = currentData.reservations.filter(r => {
    if (reservationTab === 'dikonfirmasi') return r.status === 'Dikonfirmasi';
    if (reservationTab === 'menunggu') return r.status === 'Menunggu Datang';
    return true;
  });

  return (
    <div className="min-h-screen bg-[#F4F5F7] font-sans text-slate-800 flex flex-col md:flex-row">
      <Head title="L-Style ATELIER SUITE - Operating System" />

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
                className={`w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all font-semibold ${
                  activeTab === 'dashboard'
                    ? 'bg-slate-900 text-white shadow-sm'
                    : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'
                }`}
              >
                <LayoutGrid className="w-4 h-4" />
                <span>Dashboard</span>
              </Link>

              <Link
                href="/barbershop/booking"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <Calendar className="w-4 h-4 text-slate-400" />
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
            onClick={() => showToast('Pengaturan Atelier & Terminal System')}
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
            {/* Live Outlet & Stylist Badge */}
            <div className="bg-amber-50 border border-amber-200/70 px-3 py-1.5 rounded-full flex items-center gap-2 text-xs font-semibold text-amber-800 shadow-xs">
              <span className="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
              <span>Live Outlet + 8 Stylist Aktif</span>
            </div>

            {/* Branch Selector */}
            <div className="bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 flex items-center gap-2 text-xs font-medium text-slate-700 cursor-pointer hover:bg-slate-100 transition-all">
              <span className="font-semibold text-slate-900">Senopati Atelier Branch</span>
              <ChevronDown className="w-3.5 h-3.5 text-slate-400" />
            </div>

            {/* Notification Bell */}
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

                  {/* Mode Data Switcher */}
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

        {/* Notification Toast Alert */}
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

        {/* Dashboard Operational Body */}
        <main className="p-6 space-y-6">

          {/* Mode Switcher Banner (Top Action Bar) */}
          <div className="flex flex-wrap items-center justify-between gap-4 bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
            <div className="flex items-center gap-3">
              <div className="px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 text-[11px] font-bold uppercase tracking-wider flex items-center gap-1.5">
                <span className="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                <span>LIVE OPERATIONAL</span>
              </div>
              <span className="text-xs font-semibold text-slate-500">Senin, 24 Oktober 2024</span>
            </div>

            {/* Mode Switcher Button & Help */}
            <div className="flex items-center gap-2 text-xs">
              <span className="text-slate-500 font-medium">Status Data:</span>
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

          {/* Operational Greeting Header */}
          <div className="flex flex-wrap items-end justify-between gap-4">
            <div>
              <h2 className="text-2xl font-black text-slate-900 tracking-tight">Selamat Datang, {user.name}</h2>
              <p className="text-xs text-slate-500 font-medium mt-0.5">
                Operasional Senopati Atelier berjalan optimal • 8 Barber & Stylist aktif bertugas
              </p>
            </div>

            {/* Main Action Buttons */}
            <div className="flex items-center gap-2.5">
              <button
                onClick={() => showToast('Membuka Laporan Operasional Detailed Analytics')}
                className="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-800 rounded-xl text-xs font-bold transition-all flex items-center gap-2 border border-slate-200"
              >
                <BarChart2 className="w-4 h-4 text-slate-600" />
                <span>Lihat Laporan</span>
              </button>

              <button
                onClick={() => setShowBookingModal(true)}
                className="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-bold transition-all shadow-sm flex items-center gap-2"
              >
                <Calendar className="w-4 h-4" />
                <span>+ Reservasi Booking</span>
              </button>

              <button
                onClick={() => setShowWalkInModal(true)}
                className="px-4 py-2 bg-slate-950 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-sm flex items-center gap-2"
              >
                <User className="w-4 h-4" />
                <span>+ Walk-in Baru</span>
              </button>
            </div>
          </div>

          {/* ==========================================
              TOP 4 STAT CARDS GRID
          ========================================== */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {/* Stat 1: BOOKING HARI INI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col justify-between">
              <div className="flex items-center justify-between">
                <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider">BOOKING HARI INI</span>
                <div className="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600">
                  <Calendar className="w-4 h-4" />
                </div>
              </div>
              <div className="mt-4">
                <h3 className="text-3xl font-black text-slate-900 tracking-tight">{currentData.stats.bookingCount} <span className="text-xs font-medium text-slate-400">Jadwal</span></h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-1 flex items-center gap-1">
                  <ArrowUpRight className="w-3.5 h-3.5" />
                  <span>{currentData.stats.bookingChange}</span>
                </p>
              </div>
            </div>

            {/* Stat 2: PELANGGAN & TAMU */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col justify-between">
              <div className="flex items-center justify-between">
                <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider">PELANGGAN & TAMU</span>
                <div className="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                  <Users className="w-4 h-4" />
                </div>
              </div>
              <div className="mt-4">
                <h3 className="text-3xl font-black text-slate-900 tracking-tight">{currentData.stats.customerCount} <span className="text-xs font-medium text-slate-400">Orang</span></h3>
                <p className="text-[11px] font-semibold text-slate-500 mt-1">
                  {currentData.stats.customerSub}
                </p>
              </div>
            </div>

            {/* Stat 3: KAPASITAS KURSI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col justify-between">
              <div className="flex items-center justify-between">
                <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider">KAPASITAS KURSI</span>
                <div className="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center">
                  <Scissors className="w-4 h-4" />
                </div>
              </div>
              <div className="mt-4">
                <div className="flex items-baseline justify-between">
                  <h3 className="text-3xl font-black text-slate-900 tracking-tight">
                    {currentData.stats.chairActive} / {currentData.stats.chairTotal} <span className="text-xs font-medium text-slate-400">Kursi Aktif</span>
                  </h3>
                  <span className="text-xs font-bold text-amber-600">{currentData.stats.chairPercent}</span>
                </div>
                {/* Progress bar */}
                <div className="w-full bg-slate-100 h-1.5 rounded-full mt-2.5 overflow-hidden">
                  <div
                    className="bg-amber-500 h-full rounded-full transition-all duration-500"
                    style={{ width: currentData.stats.chairPercent }}
                  ></div>
                </div>
              </div>
            </div>

            {/* Stat 4: OMZET KASIR HARI INI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col justify-between">
              <div className="flex items-center justify-between">
                <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider">OMZET KASIR HARI INI</span>
                <div className="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                  <CreditCard className="w-4 h-4" />
                </div>
              </div>
              <div className="mt-4">
                <h3 className="text-2xl font-black text-slate-900 tracking-tight">{formatRupiah(currentData.stats.omzetAmount)}</h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-1 flex items-center gap-1">
                  <ArrowUpRight className="w-3.5 h-3.5" />
                  <span>{currentData.stats.omzetChange}</span>
                </p>
              </div>
            </div>
          </div>

          {/* ==========================================
              MAIN OPERATIONAL CARDS ROW 
          ========================================== */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {/* LEFT 2 COLS: Live Pod Antrean Card */}
            <div className="lg:col-span-2 space-y-6">
              <div className="bg-[#121215] text-white rounded-3xl p-6 shadow-xl relative overflow-hidden flex flex-col justify-between border border-slate-800">

                {/* Top Badge Row */}
                <div className="flex flex-wrap items-center justify-between gap-3 border-b border-slate-800/80 pb-4">
                  <div className="flex items-center gap-2">
                    <span className="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
                    <span className="text-xs font-bold uppercase tracking-wider text-amber-300">SEDANG DILAYANI • LIVE POD ANTREAN</span>
                  </div>

                  {currentData.liveAntrean && (
                    <div className="flex items-center gap-2">
                      <span className="px-2.5 py-0.5 rounded-full border border-amber-500/40 text-amber-400 text-[10px] font-bold uppercase">
                        ANTREAN AKTIF
                      </span>
                      <span className="px-3 py-1 bg-amber-500 text-slate-950 font-black rounded-lg text-sm">
                        {currentData.liveAntrean.id}
                      </span>
                    </div>
                  )}
                </div>

                {/* Live Guest Treatment Info */}
                {currentData.liveAntrean ? (
                  <div className="py-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    {/* Guest Name & Contact */}
                    <div>
                      <p className="text-[10px] font-bold uppercase tracking-widest text-slate-400">NAMA TAMU & STATUS</p>
                      <h4 className="text-xl font-extrabold text-white mt-1">{currentData.liveAntrean.namaTamu}</h4>
                      <div className="mt-2 flex items-center gap-2">
                        <span className="px-2 py-0.5 bg-amber-400/20 text-amber-300 text-[10px] font-bold rounded border border-amber-400/30">
                          {currentData.liveAntrean.badge}
                        </span>
                      </div>
                      <p className="text-xs text-slate-400 mt-2 font-mono">{currentData.liveAntrean.phone}</p>
                    </div>

                    {/* Service & Barber */}
                    <div>
                      <p className="text-[10px] font-bold uppercase tracking-widest text-slate-400">ARTISAN & LAYANAN</p>
                      <h4 className="text-lg font-bold text-amber-300 mt-1">{currentData.liveAntrean.layanan}</h4>
                      <p className="text-xs text-slate-300 mt-2 font-medium flex items-center gap-1.5">
                        <Scissors className="w-3.5 h-3.5 text-amber-400" />
                        <span>{currentData.liveAntrean.artisan}</span>
                      </p>
                    </div>

                    {/* Progress & Duration */}
                    <div>
                      <p className="text-[10px] font-bold uppercase tracking-widest text-slate-400">DURASI & STATUS</p>
                      <div className="mt-1 flex items-baseline justify-between">
                        <span className="text-base font-bold text-white">
                          {currentData.liveAntrean.progressMnt} / {currentData.liveAntrean.totalMnt} mnt
                        </span>
                        <span className="text-xs font-semibold text-amber-400">({currentData.liveAntrean.percent}%)</span>
                      </div>
                      {/* Progress Bar */}
                      <div className="w-full bg-slate-800 h-2 rounded-full mt-2 overflow-hidden">
                        <div
                          className="bg-amber-400 h-full rounded-full transition-all duration-500"
                          style={{ width: `${currentData.liveAntrean.percent}%` }}
                        ></div>
                      </div>
                      <p className="text-[11px] text-slate-400 mt-2 flex items-center gap-1">
                        <Clock className="w-3.5 h-3.5 text-slate-500" />
                        <span>Estimasi selesai: {currentData.liveAntrean.estSelesai}</span>
                      </p>
                    </div>
                  </div>
                ) : (
                  <div className="py-10 text-center text-slate-400 space-y-3">
                    <Scissors className="w-10 h-10 mx-auto text-slate-600 opacity-60" />
                    <p className="text-sm font-semibold">Belum Ada Tamu Sedang Dilayani di Pod Antrean</p>
                    <button
                      onClick={() => setShowWalkInModal(true)}
                      className="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 text-xs font-bold rounded-xl shadow-md transition-all inline-flex items-center gap-2"
                    >
                      <Plus className="w-4 h-4" />
                      <span>+ Panggil Walk-in / Tamu Baru</span>
                    </button>
                  </div>
                )}

                {/* Bottom Pod Action Bar */}
                <div className="pt-4 border-t border-slate-800/80 flex flex-wrap items-center justify-between gap-4 text-xs font-semibold">
                  <div className="text-slate-400 flex items-center gap-2">
                    <span className="text-slate-500">Urutan Selanjutnya:</span>
                    <span className="bg-slate-800 px-2.5 py-1 rounded-lg text-white font-mono">
                      {currentData.liveAntrean ? currentData.liveAntrean.urutanBerikutnya : 'A-016 • Farhan Ramadhan'}
                    </span>
                  </div>

                  <div className="flex items-center gap-2">
                    <button
                      onClick={() => showToast('Memanggil Tamu Berikutnya...')}
                      className="px-3.5 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-xl transition-all"
                    >
                      Panggil Berikutnya
                    </button>

                    <button
                      onClick={() => showToast('Treatment Ditandai Selesai!')}
                      className="px-3.5 py-2 bg-slate-800 hover:bg-slate-700 text-emerald-400 rounded-xl transition-all flex items-center gap-1.5"
                    >
                      <Check className="w-3.5 h-3.5" />
                      <span>Selesaikan Treatment</span>
                    </button>

                    <button
                      onClick={() => openKasirFor(null)}
                      className="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded-xl transition-all shadow-md flex items-center gap-1.5"
                    >
                      <ShoppingBag className="w-4 h-4" />
                      <span>Buka Kasir</span>
                    </button>
                  </div>
                </div>

              </div>
            </div>

            {/* RIGHT 1 COL: Stasiun Kursi Live Panel */}
            <div className="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs flex flex-col justify-between">
              <div>
                <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                  <div>
                    <h3 className="font-extrabold text-slate-900 text-sm">Stasiun Kursi Live</h3>
                    <p className="text-[11px] text-slate-400 font-medium">Status 6 unit kursi barber & styling</p>
                  </div>
                  <span className="px-2.5 py-1 bg-amber-100 text-amber-800 text-[11px] font-bold rounded-full">
                    {currentData.stats.chairActive} / 6 Terisi
                  </span>
                </div>

                {/* Chair Stations List */}
                <div className="mt-4 space-y-2.5">
                  {currentData.chairs.map((c) => (
                    <div
                      key={c.id}
                      className={`p-3 rounded-2xl border transition-all ${
                        c.isDark
                          ? 'bg-slate-950 text-white border-slate-900 shadow-md'
                          : c.status === 'Terisi'
                          ? 'bg-amber-50/40 border-amber-200/70 text-slate-800'
                          : 'bg-slate-50 border-slate-200/60 text-slate-700'
                      }`}
                    >
                      <div className="flex items-center justify-between">
                        <div className="flex items-center gap-2.5">
                          <span className={`w-7 h-7 rounded-xl font-bold text-xs flex items-center justify-center ${
                            c.isDark ? 'bg-amber-500 text-slate-950' : 'bg-slate-200 text-slate-800'
                          }`}>
                            {c.id}
                          </span>
                          <div>
                            <p className={`font-bold text-xs ${c.isDark ? 'text-white' : 'text-slate-900'}`}>{c.stylist}</p>
                            <p className={`text-[11px] ${c.isDark ? 'text-slate-400' : 'text-slate-500'}`}>
                              {c.tamu !== '-' ? `Tamu: ${c.tamu} (${c.layanan})` : 'Menunggu antrean berikutnya'}
                            </p>
                          </div>
                        </div>

                        {c.status === 'Terisi' ? (
                          <span className={`text-[10px] font-bold px-2 py-0.5 rounded-md ${
                            c.isDark ? 'bg-amber-500/20 text-amber-300' : 'bg-amber-100 text-amber-800'
                          }`}>
                            {c.sisaMnt}
                          </span>
                        ) : (
                          <button
                            onClick={() => { setSelectedChair(c.id); setShowWalkInModal(true); }}
                            className="px-2.5 py-1 bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 text-[10px] font-bold rounded-lg transition-all"
                          >
                            Tugaskan Tamu
                          </button>
                        )}
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            </div>

          </div>

          {/* ==========================================
              BOTTOM ROW: RESERVASI & RECENT ACTIVITY
          ========================================== */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {/* LEFT 2 COLS: Jadwal Reservasi Hari Ini */}
            <div className="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
              <div>
                <div className="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-4">
                  <div>
                    <h3 className="font-extrabold text-slate-900 text-base">Jadwal Reservasi Hari Ini</h3>
                    <p className="text-xs text-slate-500 font-medium">Daftar janji temu aktif & konfirmasi kehadiran atelier</p>
                  </div>

                  {/* Status Filter Tabs */}
                  <div className="flex items-center gap-1 bg-slate-100 p-1 rounded-xl text-xs font-semibold">
                    <button
                      onClick={() => setReservationTab('semua')}
                      className={`px-3 py-1.5 rounded-lg transition-all ${
                        reservationTab === 'semua' ? 'bg-white text-slate-900 shadow-xs font-bold' : 'text-slate-500 hover:text-slate-900'
                      }`}
                    >
                      Semua ({currentData.reservations.length})
                    </button>
                    <button
                      onClick={() => setReservationTab('dikonfirmasi')}
                      className={`px-3 py-1.5 rounded-lg transition-all ${
                        reservationTab === 'dikonfirmasi' ? 'bg-white text-slate-900 shadow-xs font-bold' : 'text-slate-500 hover:text-slate-900'
                      }`}
                    >
                      Dikonfirmasi ({currentData.reservations.filter(r => r.status === 'Dikonfirmasi').length})
                    </button>
                    <button
                      onClick={() => setReservationTab('menunggu')}
                      className={`px-3 py-1.5 rounded-lg transition-all ${
                        reservationTab === 'menunggu' ? 'bg-white text-slate-900 shadow-xs font-bold' : 'text-slate-500 hover:text-slate-900'
                      }`}
                    >
                      Menunggu ({currentData.reservations.filter(r => r.status === 'Menunggu Datang').length})
                    </button>
                  </div>
                </div>

                {/* Reservations List */}
                <div className="mt-4 divide-y divide-slate-100">
                  {filteredReservations.length > 0 ? (
                    filteredReservations.map((res) => (
                      <div key={res.id} className="py-3.5 flex flex-wrap items-center justify-between gap-4 hover:bg-slate-50/60 px-2 rounded-xl transition-all">
                        <div className="flex items-center gap-4">
                          {/* Time badge */}
                          <div className="px-3 py-1.5 bg-slate-100 text-slate-900 font-black rounded-xl text-xs text-center border border-slate-200/60">
                            {res.jam}
                          </div>

                          <div>
                            <div className="flex items-center gap-2">
                              <h4 className="font-bold text-slate-900 text-sm">{res.nama}</h4>
                              <span className="text-[10px] font-bold px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 border border-purple-200/50">
                                {res.tier}
                              </span>
                            </div>
                            <p className="text-xs text-slate-500 mt-0.5 font-medium flex items-center gap-1.5">
                              <Scissors className="w-3.5 h-3.5 text-amber-500" />
                              <span>{res.layanan}</span>
                              <span className="text-slate-300">•</span>
                              <span className="text-slate-600">{res.stylist}</span>
                            </p>
                          </div>
                        </div>

                        <div className="flex items-center gap-4">
                          {/* Status Badge */}
                          <div className="flex items-center gap-1.5">
                            <span className={`w-2 h-2 rounded-full ${
                              res.status === 'Dikonfirmasi' ? 'bg-amber-500' : 'bg-slate-400'
                            }`}></span>
                            <span className="text-xs font-semibold text-slate-700">{res.status}</span>
                          </div>

                          {/* Price & Note */}
                          <div className="text-right">
                            <p className="font-bold text-slate-900 text-xs">{formatRupiah(res.amount)}</p>
                            <p className="text-[10px] text-slate-400 font-medium">{res.note}</p>
                          </div>

                          {/* Kasir Action */}
                          <button
                            onClick={() => openKasirFor(res)}
                            className="p-1.5 text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all"
                            title="Proses ke Kasir"
                          >
                            <ChevronRight className="w-4 h-4" />
                          </button>
                        </div>
                      </div>
                    ))
                  ) : (
                    <div className="py-12 text-center text-slate-400 space-y-2">
                      <Calendar className="w-8 h-8 mx-auto text-slate-300" />
                      <p className="text-xs font-semibold">Belum Ada Jadwal Reservasi Terdaftar Hari Ini</p>
                      <button
                        onClick={() => setShowBookingModal(true)}
                        className="text-xs text-amber-600 font-bold hover:underline"
                      >
                        + Tambah Booking Pertama
                      </button>
                    </div>
                  )}
                </div>
              </div>

              {/* Table Footer */}
              <div className="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-medium">
                <span>Menampilkan {filteredReservations.length} dari {currentData.reservations.length} total reservasi</span>
                <button
                  onClick={() => showToast('Membuka Kalender Reservasi Atelier')}
                  className="text-slate-900 font-bold hover:underline flex items-center gap-1"
                >
                  <span>Buka Kalender Lengkap</span>
                  <ArrowUpRight className="w-3.5 h-3.5" />
                </button>
              </div>
            </div>

            {/* RIGHT 1 COL: Aktivitas Terkini Log Feed */}
            <div className="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
              <div>
                <div className="flex items-center justify-between border-b border-slate-100 pb-4">
                  <div>
                    <h3 className="font-extrabold text-slate-900 text-base">Aktivitas Terkini</h3>
                    <p className="text-xs text-slate-500 font-medium">Real-time log transaksi & atelier</p>
                  </div>
                  <span className="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                </div>

                <div className="mt-4 space-y-4">
                  {currentData.activities.length > 0 ? (
                    currentData.activities.map((act) => (
                      <div key={act.id} className="flex gap-3">
                        <div className={`w-8 h-8 rounded-xl shrink-0 flex items-center justify-center ${
                          act.type === 'payment' ? 'bg-amber-100 text-amber-800' :
                          act.type === 'member' ? 'bg-purple-100 text-purple-800' :
                          act.type === 'done' ? 'bg-emerald-100 text-emerald-800' :
                          'bg-slate-100 text-slate-800'
                        }`}>
                          {act.type === 'payment' ? <CreditCard className="w-4 h-4" /> :
                           act.type === 'member' ? <Award className="w-4 h-4" /> :
                           act.type === 'done' ? <Scissors className="w-4 h-4" /> :
                           <MessageSquare className="w-4 h-4" />}
                        </div>

                        <div className="flex-1 min-w-0">
                          <div className="flex items-center justify-between">
                            <h5 className="font-bold text-slate-900 text-xs truncate">{act.title}</h5>
                            <span className="text-[10px] text-slate-400">{act.time}</span>
                          </div>
                          <p className="text-xs text-slate-500 mt-0.5 leading-snug">{act.desc}</p>
                        </div>
                      </div>
                    ))
                  ) : (
                    <div className="py-10 text-center text-slate-400 space-y-1">
                      <Clock className="w-6 h-6 mx-auto text-slate-300" />
                      <p className="text-xs font-medium">Belum ada aktivitas tercatat hari ini</p>
                    </div>
                  )}
                </div>
              </div>

              <button
                onClick={() => showToast('Membuka Audit Trail Log Aktivitas Lengkap')}
                className="w-full mt-4 py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-800 font-bold rounded-xl text-xs text-center transition-all border border-slate-200/80"
              >
                Lihat Log Aktivitas Lengkap
              </button>
            </div>

          </div>

          {/* ==========================================
              WEEKLY REVENUE ANALYTICS & STYLIST ON DUTY
          ========================================== */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {/* LEFT 2 COLS: Tren Revenue & Kepadatan Kursi Chart Card */}
            <div className="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
              <div className="flex flex-wrap items-center justify-between gap-4">
                <div>
                  <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">ANALISIS PERFORMA ATELIER</p>
                  <h3 className="text-lg font-extrabold text-slate-900">Tren Revenue & Kepadatan Kursi Mingguan</h3>
                </div>

                <div className="text-right">
                  <h4 className="text-2xl font-black text-slate-900">Rp 32.400.000</h4>
                  <p className="text-[11px] font-semibold text-emerald-600">+14.2% vs minggu lalu</p>
                </div>
              </div>

              {/* Custom Bar Chart Visual */}
              <div className="mt-8 grid grid-cols-7 gap-3 items-end h-44 border-b border-slate-100 pb-4">
                {[
                  { day: 'Sen', val: 55, peak: false },
                  { day: 'Sel', val: 65, peak: false },
                  { day: 'Rab', val: 60, peak: false },
                  { day: 'Kam', val: 50, peak: false },
                  { day: 'Jum', val: 80, peak: true },
                  { day: 'Sab', val: 95, peak: true },
                  { day: 'Min (Hari Ini)', val: 75, peak: true }
                ].map((item, idx) => (
                  <div key={idx} className="flex flex-col items-center gap-2 group">
                    <div className="w-full bg-slate-100 rounded-t-xl overflow-hidden h-36 flex items-end relative">
                      <div
                        className={`w-full rounded-t-xl transition-all duration-700 group-hover:opacity-90 ${
                          item.peak ? 'bg-amber-500' : 'bg-slate-900'
                        }`}
                        style={{ height: `${dataMode === 'kosong' ? 10 : item.val}%` }}
                      ></div>
                    </div>
                    <span className="text-[11px] font-bold text-slate-600">{item.day}</span>
                  </div>
                ))}
              </div>

              {/* Chart Legend */}
              <div className="mt-4 flex flex-wrap items-center justify-between text-xs text-slate-500 font-medium">
                <div className="flex items-center gap-4">
                  <div className="flex items-center gap-1.5">
                    <span className="w-3 h-3 rounded-sm bg-slate-900"></span>
                    <span>Omzet Layanan</span>
                  </div>
                  <div className="flex items-center gap-1.5">
                    <span className="w-3 h-3 rounded-sm bg-amber-500"></span>
                    <span>Tamu Weekend Peak</span>
                  </div>
                </div>
                <span>Rata-rata tiket per tamu: Rp 245.000</span>
              </div>
            </div>

            {/* RIGHT 1 COL: STYLIST ON DUTY */}
            <div className="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
              <div>
                <div className="flex items-center justify-between border-b border-slate-100 pb-4">
                  <div>
                    <h3 className="font-extrabold text-slate-900 text-sm">STYLIST ON DUTY</h3>
                    <p className="text-[11px] text-slate-400 font-medium">8 Barber & Stylist aktif shift ini</p>
                  </div>
                  <span className="px-2.5 py-1 bg-emerald-100 text-emerald-800 text-[11px] font-bold rounded-full">
                    8/8 Hadir
                  </span>
                </div>

                {/* Stylists Avatars Grid */}
                <div className="mt-6 flex flex-wrap gap-2.5">
                  {currentData.stylists.map((s) => (
                    <div
                      key={s.id}
                      className="w-11 h-11 rounded-2xl bg-slate-900 text-white font-bold flex flex-col items-center justify-center text-xs shadow-xs hover:bg-amber-500 hover:text-slate-950 transition-all cursor-pointer"
                      title={`${s.name} (${s.role})`}
                    >
                      <span>{s.code}</span>
                    </div>
                  ))}
                  <div className="w-11 h-11 rounded-2xl bg-slate-100 text-slate-500 font-bold flex items-center justify-center text-xs border border-slate-200">
                    +4
                  </div>
                </div>

                <p className="text-xs text-slate-500 mt-6 leading-relaxed">
                  Semua stylist telah melakukan clock-in shift pagi atelier tanpa absensi terlambat.
                </p>
              </div>

              <button
                onClick={() => showToast('Jadwal Shift Barber & Stylist Active')}
                className="w-full mt-4 py-2.5 bg-slate-900 text-white font-bold rounded-xl text-xs text-center transition-all hover:bg-slate-800 shadow-xs"
              >
                Kelola Shift Stylist
              </button>
            </div>

          </div>

        </main>
      </div>

      {/* ==========================================
          MODALS FOR CREATING DATA
      ========================================== */}

      {/* 1. MODAL RESERVASI BOOKING BARU */}
      {showBookingModal && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4 border border-slate-200">
            <div className="flex items-center justify-between border-b border-slate-100 pb-3">
              <h3 className="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                <Calendar className="w-5 h-5 text-amber-500" />
                <span>Tambah Reservasi Booking</span>
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
                  <label className="font-bold text-slate-700 block mb-1">Nomor Telepon</label>
                  <input
                    type="text"
                    placeholder="081234567890"
                    value={bookingForm.phone}
                    onChange={(e) => setBookingForm({ ...bookingForm, phone: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Jam Reservasi</label>
                  <input
                    type="text"
                    placeholder="14:00 WIB"
                    value={bookingForm.jam}
                    onChange={(e) => setBookingForm({ ...bookingForm, jam: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Pilih Layanan</label>
                <select
                  value={bookingForm.layanan}
                  onChange={(e) => setBookingForm({ ...bookingForm, layanan: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                >
                  <option value="Gentleman Royal Cut">Gentleman Royal Cut (Rp 180.000)</option>
                  <option value="Balayage & Gloss">Balayage & Gloss (Rp 650.000)</option>
                  <option value="Korean Perm & Ritual">Korean Perm & Ritual (Rp 520.000)</option>
                  <option value="Signature Hair Cut">Signature Hair Cut (Rp 180.000)</option>
                </select>
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Barber / Stylist</label>
                  <select
                    value={bookingForm.stylist}
                    onChange={(e) => setBookingForm({ ...bookingForm, stylist: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  >
                    <option value="Barber Reza Pratama">Barber Reza Pratama</option>
                    <option value="Barber David Gunawan">Barber David Gunawan</option>
                    <option value="Stylist Elena Rose">Stylist Elena Rose</option>
                    <option value="Stylist Kevin Sanjaya">Stylist Kevin Sanjaya</option>
                  </select>
                </div>
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Estimasi Biaya (Rp)</label>
                  <input
                    type="number"
                    value={bookingForm.amount}
                    onChange={(e) => setBookingForm({ ...bookingForm, amount: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>
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
                  className="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl shadow-md"
                >
                  Simpan Reservasi
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* 2. MODAL WALK-IN BARU */}
      {showWalkInModal && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4 border border-slate-200">
            <div className="flex items-center justify-between border-b border-slate-100 pb-3">
              <h3 className="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                <User className="w-5 h-5 text-slate-900" />
                <span>Input Tamu Walk-in Baru</span>
              </h3>
              <button onClick={() => setShowWalkInModal(false)} className="text-slate-400 hover:text-slate-600">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleAddWalkIn} className="space-y-3 text-xs">
              <div>
                <label className="font-bold text-slate-700 block mb-1">Nama Tamu Walk-in</label>
                <input
                  type="text"
                  required
                  placeholder="Misal: Budi Santoso"
                  value={walkInForm.nama}
                  onChange={(e) => setWalkInForm({ ...walkInForm, nama: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Nomor WhatsApp / HP</label>
                <input
                  type="text"
                  placeholder="0812-3456-7890"
                  value={walkInForm.phone}
                  onChange={(e) => setWalkInForm({ ...walkInForm, phone: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Pilih Stasiun Kursi</label>
                <select
                  value={walkInForm.kursiId}
                  onChange={(e) => setWalkInForm({ ...walkInForm, kursiId: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none font-bold text-slate-900"
                >
                  <option value="01">Kursi 01 - Barber David Gunawan</option>
                  <option value="02">Kursi 02 - Barber Reza Pratama</option>
                  <option value="03">Kursi 03 - Stylist Elena Rose</option>
                  <option value="04">Kursi 04 - Stylist Kevin Sanjaya</option>
                </select>
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Layanan / Treatment</label>
                <select
                  value={walkInForm.layanan}
                  onChange={(e) => setWalkInForm({ ...walkInForm, layanan: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                >
                  <option value="Gentleman Royal Cut">Gentleman Royal Cut</option>
                  <option value="Fade Cut & Styling">Fade Cut & Styling</option>
                  <option value="Hair Coloring & Wash">Hair Coloring & Wash</option>
                  <option value="Scalp Therapy Treatment">Scalp Therapy Treatment</option>
                </select>
              </div>

              <div className="pt-2 flex justify-end gap-2">
                <button
                  type="button"
                  onClick={() => setShowWalkInModal(false)}
                  className="px-4 py-2 bg-slate-100 text-slate-700 font-bold rounded-xl"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="px-5 py-2 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-xl shadow-md"
                >
                  Proses Ke Kursi
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* 3. MODAL BUKA KASIR POS */}
      {showKasirModal && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4 border border-slate-200">
            <div className="flex items-center justify-between border-b border-slate-100 pb-3">
              <h3 className="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                <ShoppingBag className="w-5 h-5 text-amber-500" />
                <span>Kasir / Checkout POS Atelier</span>
              </h3>
              <button onClick={() => setShowKasirModal(false)} className="text-slate-400 hover:text-slate-600">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleProcessPayment} className="space-y-3 text-xs">
              <div>
                <label className="font-bold text-slate-700 block mb-1">Nama Tamu / Pelanggan</label>
                <input
                  type="text"
                  required
                  value={kasirForm.nama}
                  onChange={(e) => setKasirForm({ ...kasirForm, nama: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Layanan Treatment</label>
                <input
                  type="text"
                  required
                  value={kasirForm.layanan}
                  onChange={(e) => setKasirForm({ ...kasirForm, layanan: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Total Tagihan (Rp)</label>
                  <input
                    type="number"
                    required
                    value={kasirForm.amount}
                    onChange={(e) => setKasirForm({ ...kasirForm, amount: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl font-bold text-slate-900 focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>

                <div>
                  <label className="font-bold text-slate-700 block mb-1">Metode Pembayaran</label>
                  <select
                    value={kasirForm.paymentMethod}
                    onChange={(e) => setKasirForm({ ...kasirForm, paymentMethod: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  >
                    <option value="QRIS BCA Atelier POS">QRIS BCA Atelier POS</option>
                    <option value="Tunai / Cash">Tunai / Cash</option>
                    <option value="Kartu Kredit / EDC">Kartu Kredit / EDC</option>
                    <option value="Saldo Membership">Saldo Membership</option>
                  </select>
                </div>
              </div>

              <div className="p-3 bg-amber-50 rounded-2xl border border-amber-200/60 flex items-center justify-between">
                <span className="font-bold text-amber-900 text-xs">Total Pembayaran Akhir:</span>
                <span className="font-black text-amber-900 text-base">
                  {formatRupiah(Number(kasirForm.amount) - Number(kasirForm.diskon || 0))}
                </span>
              </div>

              <div className="pt-2 flex justify-end gap-2">
                <button
                  type="button"
                  onClick={() => setShowKasirModal(false)}
                  className="px-4 py-2 bg-slate-100 text-slate-700 font-bold rounded-xl"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-black rounded-xl shadow-md"
                >
                  Cetak Nota & Bayar
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

    </div>
  );
}
