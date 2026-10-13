import React, { useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import {
  LayoutGrid, Calendar, Users, Award, Scissors, ShoppingBag,
  Percent, Bell, MessageSquare, Settings, Search, Plus, CheckCircle,
  Clock, ArrowUpRight, ChevronRight, X, User, CreditCard, ChevronDown,
  Sparkles, Check, DollarSign, RefreshCw, BarChart2, Filter,
  Phone, AlertCircle, Eye, Printer, Trash2, CalendarX, CheckCircle2,
  ChevronLeft, Send, AlertTriangle, Gift, Crown, ShieldCheck, Tag, Star,
  SlidersHorizontal, Coins, Download, TrendingUp, Building2, Banknote,
  Send as SendIcon, Info, ChevronUp, UserCheck
} from 'lucide-react';

export default function AtelierKomisi({ auth }) {
  const user = auth?.user || { name: 'Mario Alfarizi', email: 'admin@lstyle.id', role: 'Owner / Manager' };

  // Data Mode State: 'kosong' (default) vs 'demo'
  const [dataMode, setDataMode] = useState('kosong');
  const [dateRangeFilter, setDateRangeFilter] = useState('bulan'); // 'hari' | 'minggu' | 'bulan' | 'custom'
  const [searchQuery, setSearchQuery] = useState('');
  const [toastMessage, setToastMessage] = useState(null);

  // Selected Stylist for Detail Panel
  const [selectedStylistId, setSelectedStylistId] = useState(1);

  // Modals state
  const [showConfigModal, setShowConfigModal] = useState(false);
  const [showPayoutModal, setShowPayoutModal] = useState(false);

  // Notifications & User Menu
  const [showNotificationDrawer, setShowNotificationDrawer] = useState(false);
  const [showUserMenu, setShowUserMenu] = useState(false);

  const showToast = (msg) => {
    setToastMessage(msg);
    setTimeout(() => setToastMessage(null), 4000);
  };

  // Demo Data Set
  const demoData = {
    stats: {
      totalOmzet: '128.450.000',
      totalOmzetSub: 'Layanan: Rp 113.8M • Retail: Rp 14.65M',
      growthOmzet: '↑+14.2% vs bulan sebelumnya',
      totalKomisi: '48.620.000',
      totalKomisiSub: '5 Stylist Aktif • 100% Terverifikasi',
      avgKomisiRate: 'Rata-rata 37.8% dari omzet bruto',
      layananSelesai: '486',
      layananSub: 'Avg Ticket: Rp 264k • Durasi: 42 mnt',
      growthLayanan: '↑+28 Tamu kapasitas 89%',
      topPerformer: {
        initials: 'RP',
        nama: 'Reza Pratama',
        role: 'MASTER BARBER ATELIER',
        komisiEstimasi: '14.900.000'
      }
    },
    stylists: [
      {
        id: 1,
        initials: 'RP',
        nama: 'Reza Pratama',
        role: 'Master Barber',
        branch: 'Senopati Branch',
        layananCount: 124,
        omzetLayanan: 36200000,
        retailTerjual: 4200000,
        skemaKomisi: '40% Svc + 10% Ret',
        komisiLayananRate: 40,
        komisiRetailRate: 10,
        komisiLayananNominal: 14480000,
        komisiRetailNominal: 420000,
        totalKomisi: 14900000,
        status: 'Siap Cair',
        rating: 4.96,
        totalUlasan: 118,
        ulasanPositif: '100%',
        bank: 'Bank Mandiri',
        rekening: '137-00-9821-432',
        atasNama: 'REZA PRATAMA PUTRA',
        topServices: [
          { name: 'Gentleman Royal Cut', count: 62, percent: 50 },
          { name: 'Hot Towel Shave & Massage', count: 48, percent: 38 },
          { name: 'Head & Scalp Hair Spa', count: 14, percent: 12 }
        ]
      },
      {
        id: 2,
        initials: 'ER',
        nama: 'Elena Rose',
        role: 'Senior Colorist',
        branch: 'Senopati Branch',
        layananCount: 68,
        omzetLayanan: 38400000,
        retailTerjual: 2800000,
        skemaKomisi: '40% Svc + 10% Ret',
        komisiLayananRate: 40,
        komisiRetailRate: 10,
        komisiLayananNominal: 15360000,
        komisiRetailNominal: 280000,
        totalKomisi: 15640000,
        status: 'Siap Cair',
        rating: 4.98,
        totalUlasan: 94,
        ulasanPositif: '100%',
        bank: 'BCA',
        rekening: '883-0129-441',
        atasNama: 'ELENA ROSELYN',
        topServices: [
          { name: 'Creative Hair Coloring', count: 42, percent: 62 },
          { name: 'Balayage & Glossing', count: 18, percent: 26 },
          { name: 'Scalp Purifying Spa', count: 8, percent: 12 }
        ]
      },
      {
        id: 3,
        initials: 'DG',
        nama: 'David Gunawan',
        role: 'Senior Barber',
        branch: 'Senopati Branch',
        layananCount: 110,
        omzetLayanan: 24800000,
        retailTerjual: 3600000,
        skemaKomisi: '35% Svc + 10% Ret',
        komisiLayananRate: 35,
        komisiRetailRate: 10,
        komisiLayananNominal: 8680000,
        komisiRetailNominal: 360000,
        totalKomisi: 9040000,
        status: 'Siap Cair',
        rating: 4.92,
        totalUlasan: 105,
        ulasanPositif: '99%',
        bank: 'Bank Mandiri',
        rekening: '137-00-5542-109',
        atasNama: 'DAVID GUNAWAN',
        topServices: [
          { name: 'Signature Cut & Wash', count: 70, percent: 64 },
          { name: 'Beard Grooming', count: 30, percent: 27 },
          { name: 'Hair Tonic Spa', count: 10, percent: 9 }
        ]
      },
      {
        id: 4,
        initials: 'KS',
        nama: 'Kevin Sanjaya',
        role: 'Stylist',
        branch: 'Senopati Branch',
        layananCount: 86,
        omzetLayanan: 19500000,
        retailTerjual: 1500000,
        skemaKomisi: '35% Svc + 10% Ret',
        komisiLayananRate: 35,
        komisiRetailRate: 10,
        komisiLayananNominal: 6825000,
        komisiRetailNominal: 150000,
        totalKomisi: 6975000,
        status: 'Siap Cair',
        rating: 4.88,
        totalUlasan: 76,
        ulasanPositif: '98%',
        bank: 'BNI',
        rekening: '044-8912-301',
        atasNama: 'KEVIN SANJAYA',
        topServices: [
          { name: 'Korean Texture Wave', count: 40, percent: 46 },
          { name: 'Men Haircut', count: 36, percent: 42 },
          { name: 'Styling Pomade', count: 10, percent: 12 }
        ]
      },
      {
        id: 5,
        initials: 'DS',
        nama: 'Dimas S.',
        role: 'Junior Barber',
        branch: 'Senopati Branch',
        layananCount: 58,
        omzetLayanan: 9550000,
        retailTerjual: 850000,
        skemaKomisi: '30% Svc + 10% Ret',
        komisiLayananRate: 30,
        komisiRetailRate: 10,
        komisiLayananNominal: 2865000,
        komisiRetailNominal: 85000,
        totalKomisi: 2950000,
        status: 'Siap Cair',
        rating: 4.85,
        totalUlasan: 45,
        ulasanPositif: '97%',
        bank: 'BRI',
        rekening: '0112-01-098234-50-1',
        atasNama: 'DIMAS SETIAWAN',
        topServices: [
          { name: 'Junior Haircut', count: 38, percent: 65 },
          { name: 'Basic Wash', count: 15, percent: 26 },
          { name: 'Beard Trim', count: 5, percent: 9 }
        ]
      }
    ]
  };

  const emptyData = {
    stats: {
      totalOmzet: '0',
      totalOmzetSub: 'Layanan: Rp 0 • Retail: Rp 0',
      growthOmzet: 'Belum ada transaksi',
      totalKomisi: '0',
      totalKomisiSub: '0 Stylist Aktif',
      avgKomisiRate: 'Rata-rata 0% omzet',
      layananSelesai: '0',
      layananSub: 'Avg Ticket: Rp 0',
      growthLayanan: '0 Tamu terlayani',
      topPerformer: {
        initials: '-',
        nama: 'Belum ada data',
        role: 'TOP PERFORMER',
        komisiEstimasi: '0'
      }
    },
    stylists: []
  };

  const [currentData, setCurrentData] = useState(emptyData);

  useEffect(() => {
    if (dataMode === 'demo') {
      setCurrentData(demoData);
      setSelectedStylistId(1);
    } else {
      setCurrentData(emptyData);
      setSelectedStylistId(null);
    }
  }, [dataMode]);

  const activeStylist = currentData.stylists.find(s => s.id === selectedStylistId) || currentData.stylists[0];

  const handleLogout = () => {
    router.post('/logout');
  };

  // Filtered Stylist Table
  const filteredStylists = currentData.stylists.filter(s =>
    s.nama.toLowerCase().includes(searchQuery.toLowerCase()) ||
    s.role.toLowerCase().includes(searchQuery.toLowerCase())
  );

  return (
    <div className="min-h-screen bg-[#F4F5F7] font-sans text-slate-800 flex flex-col md:flex-row">
      <Head title="Komisi Pegawai & Kinerja Stylist - L-Style ATELIER SUITE" />

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
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-slate-900 text-white shadow-sm font-semibold transition-all"
              >
                <Percent className="w-4 h-4 text-white" />
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
              ⌘K
            </span>
          </div>

          {/* Center / Right Header Badges */}
          <div className="flex items-center gap-3">
            <div className="bg-amber-50 border border-amber-200/70 px-3 py-1.5 rounded-full flex items-center gap-2 text-xs font-semibold text-amber-800 shadow-xs">
              <span className="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
              <span>Live Outlet • 8 Stylist Aktif</span>
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

          {/* Top Breadcrumb & Action Controls */}
          <div className="flex flex-wrap items-center justify-between gap-4">
            <div>
              <p className="text-[10px] font-bold uppercase tracking-widest text-slate-400 flex items-center gap-1.5">
                <Percent className="w-3.5 h-3.5 text-amber-500" />
                <span>ATELIER FINANCIAL & PAYROLL GOVERNANCE</span>
              </p>
              <h2 className="text-2xl font-black text-slate-900 tracking-tight">Komisi Pegawai & Kinerja Stylist</h2>
              <p className="text-xs text-slate-500 font-medium mt-0.5">
                Laporan bagi hasil komisi barber, stylist, dan terapis berdasarkan omzet layanan & penjualan produk retail.
              </p>
            </div>

            <div className="flex items-center gap-2.5">
              {/* Mode Data Switcher */}
              <button
                onClick={() => {
                  const nextMode = dataMode === 'kosong' ? 'demo' : 'kosong';
                  setDataMode(nextMode);
                  showToast(`Mode Data Diubah ke: ${nextMode.toUpperCase()}`);
                }}
                className={`px-3.5 py-2 rounded-xl text-xs font-bold border transition-all flex items-center gap-2 ${
                  dataMode === 'kosong' ? 'bg-white text-slate-800 border-slate-200' : 'bg-amber-500 text-slate-950 border-amber-600 shadow-xs'
                }`}
              >
                <RefreshCw className="w-3.5 h-3.5" />
                <span>{dataMode === 'kosong' ? 'Mode Kosong (Siap Diisi)' : 'Mode Demo (Contoh)'}</span>
              </button>

              {/* Pengaturan Skema Bagi Hasil */}
              <button
                onClick={() => showToast('Membuka Pengaturan Skema Bagi Hasil Komisi')}
                className="px-4 py-2 bg-white hover:bg-slate-50 text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-xs flex items-center gap-2"
              >
                <SlidersHorizontal className="w-4 h-4 text-slate-600" />
                <span>Pengaturan Skema Bagi Hasil</span>
              </button>

              {/* Download Slip Komisi */}
              <button
                onClick={() => showToast('Mengunduh Slip Komisi Batch #OKT-2024 (PDF)')}
                className="px-4 py-2 bg-slate-950 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-md flex items-center gap-2"
              >
                <Download className="w-4 h-4" />
                <span>Download Slip Komisi</span>
              </button>
            </div>
          </div>

          {/* Date Range Selector Bar */}
          <div className="flex flex-wrap items-center justify-between gap-4 bg-white p-3 rounded-2xl border border-slate-200/80 shadow-xs">
            <div className="flex items-center gap-2 overflow-x-auto text-xs font-semibold">
              <button
                onClick={() => setDateRangeFilter('hari')}
                className={`px-4 py-2 rounded-xl transition-all ${
                  dateRangeFilter === 'hari' ? 'bg-slate-950 text-white font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                }`}
              >
                Hari Ini
              </button>
              <button
                onClick={() => setDateRangeFilter('minggu')}
                className={`px-4 py-2 rounded-xl transition-all ${
                  dateRangeFilter === 'minggu' ? 'bg-slate-950 text-white font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                }`}
              >
                Minggu Ini
              </button>
              <button
                onClick={() => setDateRangeFilter('bulan')}
                className={`px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 ${
                  dateRangeFilter === 'bulan' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                }`}
              >
                <span className="w-2 h-2 rounded-full bg-amber-400"></span>
                <span>Bulan Ini (Oktober 2024 - Aktif)</span>
              </button>
              <button
                onClick={() => setDateRangeFilter('custom')}
                className={`px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 ${
                  dateRangeFilter === 'custom' ? 'bg-slate-950 text-white font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                }`}
              >
                <Calendar className="w-3.5 h-3.5" />
                <span>Custom Range</span>
              </button>
            </div>

            <div className="flex items-center gap-2 text-xs font-semibold">
              <div className="bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-slate-800 flex items-center gap-2">
                <span>Senopati Atelier Branch (Utama)</span>
                <ChevronDown className="w-3.5 h-3.5 text-slate-400" />
              </div>
              <button className="p-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl text-slate-600">
                <RefreshCw className="w-4 h-4" />
              </button>
            </div>
          </div>

          {/* Top 4 Summary Cards Grid */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {/* Stat 1: TOTAL OMZET TIM */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">TOTAL OMZET TIM</p>
                <h3 className="text-2xl font-black text-slate-900 mt-1">Rp {currentData.stats.totalOmzet}</h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-0.5">{currentData.stats.growthOmzet}</p>
                <p className="text-[10px] text-slate-400 mt-2 font-medium">{currentData.stats.totalOmzetSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <Banknote className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 2: TOTAL KOMISI DICAIRKAN */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">TOTAL KOMISI DICAIRKAN</p>
                <h3 className="text-2xl font-black text-slate-900 mt-1">Rp {currentData.stats.totalKomisi}</h3>
                <span className="inline-block px-2 py-0.5 rounded text-[9px] font-bold bg-amber-100 text-amber-900 border border-amber-200 mt-0.5">
                  {currentData.stats.avgKomisiRate}
                </span>
                <p className="text-[10px] text-slate-400 mt-2 font-medium">{currentData.stats.totalKomisiSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <Coins className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 3: LAYANAN SELESAI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">LAYANAN SELESAI</p>
                <h3 className="text-2xl font-black text-slate-900 mt-1">{currentData.stats.layananSelesai} <span className="text-xs font-medium text-slate-400">Kunjungan</span></h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-0.5">{currentData.stats.growthLayanan}</p>
                <p className="text-[10px] text-slate-400 mt-2 font-medium">{currentData.stats.layananSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <Scissors className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 4: TOP PERFORMER */}
            <div className="bg-slate-950 text-white p-5 rounded-2xl border border-slate-800 shadow-xl flex flex-col justify-between relative overflow-hidden">
              <div className="flex items-center justify-between text-xs">
                <span className="text-[9px] font-bold uppercase tracking-widest text-amber-400 flex items-center gap-1">
                  <Star className="w-3 h-3 fill-amber-400 text-amber-400" />
                  <span>TOP PERFORMER</span>
                </span>
                <span className="text-[9px] bg-slate-900 px-2 py-0.5 rounded text-slate-300 font-semibold border border-slate-800">
                  Bulan Ini
                </span>
              </div>

              <div className="flex items-center gap-3 my-2">
                <div className="w-11 h-11 rounded-2xl bg-amber-200 text-slate-950 font-black flex items-center justify-center text-sm shadow-md shrink-0">
                  {currentData.stats.topPerformer.initials}
                </div>
                <div>
                  <h4 className="font-extrabold text-white text-sm">{currentData.stats.topPerformer.nama}</h4>
                  <p className="text-[9px] font-bold text-slate-400 uppercase tracking-wider">{currentData.stats.topPerformer.role}</p>
                </div>
              </div>

              <div className="flex items-center justify-between border-t border-slate-800 pt-2 text-xs">
                <span className="text-[10px] text-slate-400 font-medium">Estimasi Komisi:</span>
                <span className="font-black text-amber-400 text-sm">Rp {currentData.stats.topPerformer.komisiEstimasi}</span>
              </div>
              <div className="absolute -right-6 -bottom-6 w-24 h-24 bg-amber-500/10 rounded-full pointer-events-none"></div>
            </div>
          </div>

          {/* MAIN 2-COLUMN WORKSPACE SECTION */}
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            {/* LEFT 7/12: RINCIAN PERFORMA & BAGI HASIL TABLE */}
            <div className="lg:col-span-8 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
              <div className="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-3">
                <div>
                  <h3 className="font-extrabold text-slate-900 text-base">Rincian Performa & Bagi Hasil</h3>
                  <p className="text-xs text-slate-500 font-medium">Daftar hak komisi berdasarkan realisasi transaksi kasir POS yang telah lunas.</p>
                </div>
                <span className="px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold border border-slate-200">
                  {currentData.stylists.length} Stylist Terdata
                </span>
              </div>

              {/* Table */}
              <div className="overflow-x-auto">
                <table className="w-full text-left text-xs">
                  <thead>
                    <tr className="border-b border-slate-100 text-[9px] font-bold text-slate-400 uppercase tracking-wider">
                      <th className="pb-3 pl-2">PEGAWAI & ROLE</th>
                      <th className="pb-3 text-center">LAYANAN</th>
                      <th className="pb-3 text-right">OMZET LAYANAN</th>
                      <th className="pb-3 text-right">RETAIL TERJUAL</th>
                      <th className="pb-3 text-center">SKEMA KOMISI</th>
                      <th className="pb-3 text-right">TOTAL KOMISI</th>
                      <th className="pb-3 pr-2 text-right">STATUS</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-slate-100">
                    {filteredStylists.length > 0 ? (
                      filteredStylists.map((s) => (
                        <tr
                          key={s.id}
                          onClick={() => setSelectedStylistId(s.id)}
                          className={`transition-all cursor-pointer ${
                            selectedStylistId === s.id ? 'bg-amber-50/60 font-semibold' : 'hover:bg-slate-50/80'
                          }`}
                        >
                          <td className="py-3.5 pl-2">
                            <div className="flex items-center gap-3">
                              <div className="w-9 h-9 rounded-xl bg-slate-900 text-white font-bold flex items-center justify-center text-xs shrink-0">
                                {s.initials}
                              </div>
                              <div>
                                <p className="font-extrabold text-slate-900 text-xs">{s.nama}</p>
                                <p className="text-[10px] text-slate-500">{s.role}</p>
                              </div>
                            </div>
                          </td>
                          <td className="py-3.5 text-center">
                            <span className="font-extrabold text-slate-900">{s.layananCount}</span>
                            <span className="text-[10px] text-slate-400 block font-normal">Kunjungan</span>
                          </td>
                          <td className="py-3.5 text-right font-extrabold text-slate-900">
                            Rp {s.omzetLayanan.toLocaleString('id-ID')}
                          </td>
                          <td className="py-3.5 text-right font-medium text-slate-700">
                            Rp {s.retailTerjual.toLocaleString('id-ID')}
                          </td>
                          <td className="py-3.5 text-center">
                            <span className="bg-slate-100 text-slate-700 px-2 py-0.5 rounded text-[10px] font-bold border border-slate-200">
                              {s.skemaKomisi}
                            </span>
                          </td>
                          <td className="py-3.5 text-right font-black text-amber-900 text-sm">
                            Rp {s.totalKomisi.toLocaleString('id-ID')}
                          </td>
                          <td className="py-3.5 pr-2 text-right">
                            <span className="inline-flex items-center gap-1 text-[10px] font-extrabold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                              <span className="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                              <span>{s.status}</span>
                            </span>
                          </td>
                        </tr>
                      ))
                    ) : (
                      <tr>
                        <td colSpan="7" className="py-12 text-center text-slate-400 font-semibold">
                          Belum ada data komisi pegawai terdata.
                        </td>
                      </tr>
                    )}
                  </tbody>
                </table>
              </div>

              {/* Bottom Info Banner */}
              <div className="bg-slate-50 border border-slate-200/80 p-3.5 rounded-2xl flex flex-wrap items-center justify-between gap-3 text-xs">
                <div className="flex items-center gap-2 text-slate-600 font-medium">
                  <ShieldCheck className="w-4 h-4 text-amber-600" />
                  <span>Perhitungan dihitung otomatis dari POS Batch #OKT-2024-W4.</span>
                </div>
                <div className="text-right">
                  <span className="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Total Akumulasi: </span>
                  <span className="font-black text-slate-900 text-sm">
                    Rp {currentData.stats.totalKomisi}
                  </span>
                </div>
              </div>
            </div>

            {/* RIGHT 5/12: DETAILED PAYROLL & STYLIST BREAKDOWN */}
            <div className="lg:col-span-4 space-y-4">
              {activeStylist ? (
                <>
                  {/* Stylist Profile Card */}
                  <div className="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs space-y-4">
                    <div className="flex items-center justify-between">
                      <div className="flex items-center gap-3">
                        <div className="w-11 h-11 rounded-2xl bg-slate-950 text-white font-black flex items-center justify-center text-sm shadow-md">
                          {activeStylist.initials}
                        </div>
                        <div>
                          <div className="flex items-center gap-1.5">
                            <h4 className="font-extrabold text-slate-900 text-base">{activeStylist.nama}</h4>
                            <UserCheck className="w-4 h-4 text-emerald-500 fill-emerald-100" />
                          </div>
                          <p className="text-xs text-slate-500 font-medium">{activeStylist.role} • {activeStylist.branch}</p>
                        </div>
                      </div>
                      <span className="px-2.5 py-0.5 rounded text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Aktif
                      </span>
                    </div>

                    {/* Rating & Performance Box */}
                    <div className="bg-slate-50 p-3.5 rounded-2xl border border-slate-200/60 flex items-center justify-between text-xs">
                      <div className="flex items-center gap-2">
                        <Star className="w-4 h-4 fill-amber-400 text-amber-400" />
                        <div>
                          <p className="font-extrabold text-slate-900 text-xs">{activeStylist.rating} <span className="text-slate-400 font-normal">/ 5.0</span></p>
                          <p className="text-[10px] text-slate-500 font-medium">Rating Kepuasan Pelanggan</p>
                        </div>
                      </div>
                      <div className="text-right">
                        <p className="font-extrabold text-slate-900 text-xs">{activeStylist.totalUlasan} Ulasan</p>
                        <p className="text-[10px] font-bold text-emerald-600">{activeStylist.ulasanPositif} Positif</p>
                      </div>
                    </div>

                    {/* KALKULASI BAGI HASIL */}
                    <div className="space-y-3 pt-2">
                      <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">KALKULASI BAGI HASIL</p>

                      <div className="space-y-2 text-xs">
                        <div className="bg-slate-50 p-3 rounded-2xl border border-slate-200/70 flex justify-between items-center">
                          <div>
                            <p className="font-extrabold text-slate-900">Komisi Layanan ({activeStylist.komisiLayananRate}%)</p>
                            <p className="text-[10px] text-slate-500">{activeStylist.komisiLayananRate}% x Rp {activeStylist.omzetLayanan.toLocaleString('id-ID')}</p>
                          </div>
                          <span className="font-black text-slate-900 text-xs">
                            Rp {activeStylist.komisiLayananNominal.toLocaleString('id-ID')}
                          </span>
                        </div>

                        <div className="bg-slate-50 p-3 rounded-2xl border border-slate-200/70 flex justify-between items-center">
                          <div>
                            <p className="font-extrabold text-slate-900">Komisi Retail ({activeStylist.komisiRetailRate}%)</p>
                            <p className="text-[10px] text-slate-500">{activeStylist.komisiRetailRate}% x Rp {activeStylist.retailTerjual.toLocaleString('id-ID')}</p>
                          </div>
                          <span className="font-black text-slate-900 text-xs">
                            Rp {activeStylist.komisiRetailNominal.toLocaleString('id-ID')}
                          </span>
                        </div>

                        {/* Gross Total Box */}
                        <div className="bg-amber-100/70 border border-amber-300 p-3.5 rounded-2xl flex justify-between items-center">
                          <div>
                            <p className="font-black text-amber-950 text-xs">Total Diterima (Gross)</p>
                            <p className="text-[10px] text-amber-800 font-medium">Sebelum pemotongan PPh 21</p>
                          </div>
                          <span className="font-black text-amber-950 text-base">
                            Rp {activeStylist.totalKomisi.toLocaleString('id-ID')}
                          </span>
                        </div>
                      </div>
                    </div>

                    {/* LAYANAN TERLARIS */}
                    <div className="space-y-2.5 pt-2">
                      <div className="flex items-center justify-between text-xs">
                        <span className="text-[10px] font-bold uppercase tracking-wider text-slate-400">LAYANAN TERLARIS</span>
                        <span className="text-[10px] font-bold text-slate-700">{activeStylist.layananCount} Total</span>
                      </div>

                      <div className="space-y-2 text-xs">
                        {activeStylist.topServices.map((srv, idx) => (
                          <div key={idx} className="space-y-1">
                            <div className="flex justify-between font-bold text-slate-800 text-[11px]">
                              <span>{srv.name}</span>
                              <span>{srv.count}x ({srv.percent}%)</span>
                            </div>
                            <div className="w-full bg-slate-100 rounded-full h-1.5">
                              <div className="bg-slate-900 h-1.5 rounded-full" style={{ width: `${srv.percent}%` }}></div>
                            </div>
                          </div>
                        ))}
                      </div>
                    </div>

                    {/* INFORMASI REKENING BANK */}
                    <div className="bg-slate-50 p-3.5 rounded-2xl border border-slate-200/80 space-y-2 text-xs">
                      <div className="flex items-center justify-between">
                        <div className="flex items-center gap-2">
                          <Building2 className="w-4 h-4 text-slate-600" />
                          <span className="font-extrabold text-slate-900">{activeStylist.bank}</span>
                        </div>
                        <span className="font-mono font-bold text-slate-700">{activeStylist.rekening}</span>
                      </div>
                      <div className="flex justify-between text-[10px] text-slate-500 font-medium border-t border-slate-200/60 pt-1.5">
                        <span>Atas Nama:</span>
                        <span className="font-bold text-slate-900">{activeStylist.atasNama}</span>
                      </div>

                      <button
                        onClick={() => showToast(`Transfer Komisi Rp ${activeStylist.totalKomisi.toLocaleString('id-ID')} ke ${activeStylist.bank} diproses`)}
                        className="w-full py-3 bg-slate-950 hover:bg-slate-800 text-white font-extrabold rounded-xl text-xs shadow-md transition-all flex items-center justify-center gap-2 mt-2"
                      >
                        <SendIcon className="w-3.5 h-3.5 text-amber-400" />
                        <span>Transfer Komisi via Bank</span>
                      </button>
                    </div>

                  </div>

                  {/* Kebijakan Settlement Banner */}
                  <div className="bg-amber-50/70 border border-amber-200/80 rounded-3xl p-4 flex items-start gap-3 text-xs">
                    <Info className="w-4 h-4 text-amber-700 shrink-0 mt-0.5" />
                    <div>
                      <h5 className="font-bold text-amber-900 text-xs">Kebijakan Settlement Atelier</h5>
                      <p className="text-[11px] text-amber-800/90 font-medium leading-relaxed mt-0.5">
                        Seluruh pembayaran komisi otomatis dilaporkan ke SPT Masa PPh 21 Karyawan Lepas & Mitra Mandiri.
                      </p>
                    </div>
                  </div>
                </>
              ) : (
                <div className="bg-white rounded-3xl p-12 border border-slate-200/80 text-center space-y-3 shadow-xs">
                  <User className="w-10 h-10 text-slate-300 mx-auto" />
                  <p className="text-xs font-semibold text-slate-500">Pilih pegawai pada tabel untuk melihat rincian kalkulasi bagi hasil.</p>
                </div>
              )}
            </div>

          </div>

        </main>
      </div>

    </div>
  );
}
