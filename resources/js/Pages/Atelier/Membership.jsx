import React, { useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import {
  LayoutGrid, Calendar, Users, Award, Scissors, ShoppingBag,
  Percent, Bell, MessageSquare, Settings, Search, Plus, CheckCircle,
  Clock, ArrowUpRight, ChevronRight, X, User, CreditCard, ChevronDown,
  Sparkles, Check, DollarSign, RefreshCw, BarChart2, Filter,
  Phone, AlertCircle, Eye, Printer, Trash2, CalendarX, CheckCircle2,
  ChevronLeft, Send, AlertTriangle, Gift, Crown, ShieldCheck, Tag, Star,
  SlidersHorizontal, Coins
} from 'lucide-react';

export default function AtelierMembership({ auth }) {
  const user = auth?.user || { name: 'Mario Alfarizi', email: 'admin@lstyle.id', role: 'Owner / Manager' };

  // Data Mode State: 'kosong' (default) vs 'demo'
  const [dataMode, setDataMode] = useState('kosong');
  const [memberFilter, setMemberFilter] = useState('semua'); // 'semua' | 'black' | 'gold' | 'silver'
  const [searchQuery, setSearchQuery] = useState('');
  const [toastMessage, setToastMessage] = useState(null);

  // Modals state
  const [showAddPromoModal, setShowAddPromoModal] = useState(false);
  const [showAddRewardModal, setShowAddRewardModal] = useState(false);
  const [showConfigPointModal, setShowConfigPointModal] = useState(false);

  // Notifications & User Menu
  const [showNotificationDrawer, setShowNotificationDrawer] = useState(false);
  const [showUserMenu, setShowUserMenu] = useState(false);

  const showToast = (msg) => {
    setToastMessage(msg);
    setTimeout(() => setToastMessage(null), 4000);
  };

  // Demo vs Empty Data Sets
  const demoData = {
    stats: {
      totalMember: 642,
      totalSub: '📈 +14% MoM vs bulan lalu',
      poinBeredar: '148.500',
      poinBeredarSub: 'Valuasi Rp 14.850.000',
      ditukarkanBulanIni: '42.100',
      ditukarkanSub: '28.3% rotasi',
      retensiRate: '91.2%',
      retensiSub: '⭐ 8.4x Kunjungan / Kuartal'
    },
    tierList: [
      {
        id: 'silver',
        name: 'Silver Sovereign',
        badge: 'ENTRY PATRON',
        memberCount: 320,
        sub: 'Langkah awal menikmati pengalaman atelier berstandar presisi.',
        kualifikasi: '0 - 500 Poin / Pengeluaran Rp 0 - Rp 1.000.000',
        benefits: [
          'Diskon 5% untuk semua treatment styling',
          'Complimentary Welcome Artisan Coffee & Tea',
          'Akses reservasi prioritas H-2 via WhatsApp'
        ],
        btnLabel: 'Kelola Syarat Silver',
        btnClass: 'bg-slate-100 hover:bg-slate-200 text-slate-800 border border-slate-200'
      },
      {
        id: 'gold',
        name: 'Gold Priority',
        badge: 'MOST POPULAR',
        memberCount: 215,
        sub: 'Perawatan berkesinambungan dengan fleksibilitas antrean tanpa jeda.',
        kualifikasi: '501 - 2.000 Poin / Pengeluaran Rp 1jt - Rp 3.5jt',
        benefits: [
          'Diskon 10% Semua Treatment & Produk',
          'Free Artisan Tonic & Essential Hot Towel',
          'Priority Chair Queue (Lewati Antrean Walk-in)',
          'Bonus Dobel Poin di Hari Ulang Tahun'
        ],
        btnLabel: 'Kelola Syarat Gold Priority',
        btnClass: 'bg-amber-700 hover:bg-amber-800 text-white font-bold',
        isPopular: true
      },
      {
        id: 'black',
        name: 'Black Diamond Sovereign',
        badge: 'APEX SOVEREIGN',
        memberCount: 107,
        sub: 'Kemewahan tertinggi atelier: privasi paripurna & dedicated bespoke concierge.',
        kualifikasi: '> 2.000 Poin / Pengeluaran > Rp 3.500.000',
        benefits: [
          'Diskon 15% VIP Seluruh Treatment & Ritel',
          'Complimentary VIP Private Lounge Room Suites',
          'Birthday Special Gift Set (L-Style Signature Grooming)',
          'Dedicated Master Stylist Concierge & Home Call Access'
        ],
        btnLabel: 'Kelola Eksklusivitas Diamond',
        btnClass: 'bg-amber-500 hover:bg-amber-400 text-slate-950 font-black',
        isDark: true
      }
    ],
    memberList: [
      { id: 1, initials: 'ST', nama: 'Sarah Tiffany', phone: '+62 812-4491-0988', tier: 'Black Tier', tierClass: 'bg-slate-900 text-amber-400', points: '1.450 Pts', expiry: 'Des 2026', status: 'Aktif' },
      { id: 2, initials: 'JA', nama: 'Jessica Aurelia', phone: '+62 811-9032-1144', tier: 'Black Tier', tierClass: 'bg-slate-900 text-amber-400', points: '3.120 Pts', expiry: 'Nov 2026', status: 'Aktif' },
      { id: 3, initials: 'DP', nama: 'Dimas Pratama', phone: '+62 878-1200-8842', tier: 'Gold Tier', tierClass: 'bg-amber-100 text-amber-900 border border-amber-300', points: '1.450 Pts', expiry: 'Des 2025', status: 'Aktif' },
      { id: 4, initials: 'BS', nama: 'Bimo Santoso', phone: '+62 813-7729-0112', tier: 'Black Tier', tierClass: 'bg-slate-900 text-amber-400', points: '1.450 Pts', expiry: 'Okt 2026', status: 'Aktif' },
      { id: 5, initials: 'KW', nama: 'Kevin Wijaya', phone: '+62 856-3392-1090', tier: 'Silver Tier', tierClass: 'bg-slate-100 text-slate-700 border border-slate-200', points: '420 Pts', expiry: 'Agu 2025', status: 'Aktif' }
    ],
    rewardList: [
      { id: 1, name: 'Voucher Diskon Rp 50.000', points: 500, count: 48, btnClass: 'bg-slate-100 hover:bg-slate-200 text-slate-800' },
      { id: 2, name: 'Complimentary Scalp Treatment', points: 800, count: 26, btnClass: 'bg-slate-100 hover:bg-slate-200 text-slate-800' },
      { id: 3, name: 'Free Sovereign Matte Clay', points: 1200, count: 19, btnClass: 'bg-slate-100 hover:bg-slate-200 text-slate-800' },
      { id: 4, name: 'Full VIP Grooming Package', points: 2500, count: 8, btnClass: 'bg-amber-800 text-white hover:bg-amber-900 font-bold' }
    ]
  };

  const emptyData = {
    stats: {
      totalMember: 0,
      totalSub: 'Belum ada member terdaftar',
      poinBeredar: '0 Pts',
      poinBeredarSub: 'Valuasi Rp 0',
      ditukarkanBulanIni: '0 Pts',
      ditukarkanSub: '0% rotasi',
      retensiRate: '0%',
      retensiSub: 'Target: 85%'
    },
    tierList: [
      { id: 'silver', name: 'Silver Sovereign', badge: 'ENTRY PATRON', memberCount: 0, sub: 'Langkah awal menikmati pengalaman atelier berstandar presisi.', kualifikasi: '0 - 500 Poin / Pengeluaran Rp 0 - Rp 1.000.000', benefits: ['Diskon 5% untuk semua treatment styling', 'Complimentary Welcome Artisan Coffee & Tea', 'Akses reservasi prioritas H-2 via WhatsApp'], btnLabel: 'Kelola Syarat Silver', btnClass: 'bg-slate-100 hover:bg-slate-200 text-slate-800 border border-slate-200' },
      { id: 'gold', name: 'Gold Priority', badge: 'MOST POPULAR', memberCount: 0, sub: 'Perawatan berkesinambungan dengan fleksibilitas antrean tanpa jeda.', kualifikasi: '501 - 2.000 Poin / Pengeluaran Rp 1jt - Rp 3.5jt', benefits: ['Diskon 10% Semua Treatment & Produk', 'Free Artisan Tonic & Essential Hot Towel', 'Priority Chair Queue (Lewati Antrean Walk-in)', 'Bonus Dobel Poin di Hari Ulang Tahun'], btnLabel: 'Kelola Syarat Gold Priority', btnClass: 'bg-amber-700 hover:bg-amber-800 text-white font-bold', isPopular: true },
      { id: 'black', name: 'Black Diamond Sovereign', badge: 'APEX SOVEREIGN', memberCount: 0, sub: 'Kemewahan tertinggi atelier: privasi paripurna & dedicated bespoke concierge.', kualifikasi: '> 2.000 Poin / Pengeluaran > Rp 3.500.000', benefits: ['Diskon 15% VIP Seluruh Treatment & Ritel', 'Complimentary VIP Private Lounge Room Suites', 'Birthday Special Gift Set (L-Style Signature Grooming)', 'Dedicated Master Stylist Concierge & Home Call Access'], btnLabel: 'Kelola Eksklusivitas Diamond', btnClass: 'bg-amber-500 hover:bg-amber-400 text-slate-950 font-black', isDark: true }
    ],
    memberList: [],
    rewardList: []
  };

  const [currentData, setCurrentData] = useState(emptyData);

  useEffect(() => {
    if (dataMode === 'demo') {
      setCurrentData(demoData);
    } else {
      setCurrentData(emptyData);
    }
  }, [dataMode]);

  // Form State for Add Reward
  const [newRewardForm, setNewRewardForm] = useState({ name: '', points: 500 });
  const handleAddReward = (e) => {
    e.preventDefault();
    if (!newRewardForm.name) return;

    const newReward = {
      id: currentData.rewardList.length + 1,
      name: newRewardForm.name,
      points: Number(newRewardForm.points),
      count: 0,
      btnClass: 'bg-slate-100 hover:bg-slate-200 text-slate-800'
    };

    setCurrentData(prev => ({
      ...prev,
      rewardList: [...prev.rewardList, newReward]
    }));

    setShowAddRewardModal(false);
    setNewRewardForm({ name: '', points: 500 });
    showToast(`Hadiah Reward "${newReward.name}" berhasil ditambahkan!`);
  };

  const handleLogout = () => {
    router.post('/logout');
  };

  // Filtered member list
  const filteredMembers = currentData.memberList.filter(m => {
    const matchesSearch = m.nama.toLowerCase().includes(searchQuery.toLowerCase()) || m.phone.includes(searchQuery);
    if (memberFilter === 'black') return matchesSearch && m.tier.includes('Black');
    if (memberFilter === 'gold') return matchesSearch && m.tier.includes('Gold');
    if (memberFilter === 'silver') return matchesSearch && m.tier.includes('Silver');
    return matchesSearch;
  });

  return (
    <div className="min-h-screen bg-[#F4F5F7] font-sans text-slate-800 flex flex-col md:flex-row">
      <Head title="Program Loyalitas & Sovereign Membership - L-Style ATELIER SUITE" />

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
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-slate-900 text-white shadow-sm font-semibold transition-all"
              >
                <Award className="w-4 h-4 text-white" />
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
                <Crown className="w-3.5 h-3.5 text-amber-500" />
                <span>PRIVILEGE TIER & REWARD ARCHITECTURE</span>
              </p>
              <h2 className="text-2xl font-black text-slate-900 tracking-tight">Program Loyalitas & Sovereign Membership</h2>
              <p className="text-xs text-slate-500 font-medium mt-0.5">
                Konfigurasi tier keanggotaan, penukaran poin reward, dan pertumbuhan member eksklusif atelier.
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

              {/* Pengaturan Konversi Poin */}
              <button
                onClick={() => showToast('Membuka Pengaturan Ratio Konversi Poin')}
                className="px-4 py-2 bg-white hover:bg-slate-50 text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-xs flex items-center gap-2"
              >
                <Coins className="w-4 h-4 text-amber-600" />
                <span>Pengaturan Konversi Poin</span>
                <span className="text-[9px] font-bold px-1.5 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-200">1 Poin = Rp 100</span>
              </button>

              {/* + Buat Promo Tier Baru */}
              <button
                onClick={() => showToast('Membuka Form Tambah Promo Tier Baru')}
                className="px-4 py-2 bg-slate-950 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-md flex items-center gap-2"
              >
                <Plus className="w-4 h-4" />
                <span>+ Buat Promo Tier Baru</span>
              </button>
            </div>
          </div>

          {/* Top 4 Summary Cards Grid */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {/* Stat 1: TOTAL MEMBER AKTIF */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">TOTAL MEMBER AKTIF</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.totalMember} <span className="text-xs font-medium text-slate-400">Patrons</span></h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-0.5">{currentData.stats.totalSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <Users className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 2: POIN BEREDAR */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">POIN BEREDAR</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.poinBeredar} <span className="text-xs font-medium text-slate-400">Pts</span></h3>
                <p className="text-[11px] text-slate-500 font-medium mt-0.5">{currentData.stats.poinBeredarSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <Coins className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 3: DITUKARKAN BULAN INI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">DITUKARKAN BULAN INI</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.ditukarkanBulanIni} <span className="text-xs font-medium text-slate-400">Pts</span></h3>
                <div className="w-full bg-slate-100 rounded-full h-1.5 mt-1.5">
                  <div className="bg-amber-600 h-1.5 rounded-full" style={{ width: currentData.stats.ditukarkanSub.includes('28') ? '28.3%' : '0%' }}></div>
                </div>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <Gift className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 4: RETENSI MEMBER */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">RETENSI MEMBER</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.retensiRate} <span className="text-xs font-semibold text-emerald-600">Tier LTV Prime</span></h3>
                <p className="text-[11px] text-slate-500 font-medium mt-0.5">{currentData.stats.retensiSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <CheckCircle className="w-5 h-5" />
              </div>
            </div>
          </div>

          {/* MIDDLE SECTION: TIER PROGRAM SOVEREIGN CLUB (3 TIER CARDS) */}
          <div className="space-y-4">
            <div className="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200/60 pb-3">
              <div>
                <h3 className="font-extrabold text-slate-900 text-base">Tier Program Sovereign Club</h3>
                <p className="text-xs text-slate-500 font-medium">Skema kualifikasi loyalitas dan hak istimewa eksklusif salon atelier</p>
              </div>
              <span className="text-[10px] font-bold tracking-widest uppercase text-slate-400">AUTOMATED TIER PROGRESSION</span>
            </div>

            {/* 3 Tier Cards Grid */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
              {currentData.tierList.map((tier) => (
                <div
                  key={tier.id}
                  className={`rounded-3xl p-6 border transition-all flex flex-col justify-between space-y-6 ${
                    tier.isDark
                      ? 'bg-slate-950 text-white border-slate-800 shadow-xl'
                      : tier.isPopular
                      ? 'bg-amber-50/60 border-amber-300 ring-2 ring-amber-400/40 shadow-sm'
                      : 'bg-white border-slate-200/80 shadow-xs'
                  }`}
                >
                  <div className="space-y-4">
                    {/* Tier Card Top Badge */}
                    <div className="flex items-center justify-between text-xs">
                      <span className={`px-2.5 py-0.5 rounded text-[10px] font-bold tracking-wider ${
                        tier.isDark ? 'bg-amber-500 text-slate-950' : (tier.isPopular ? 'bg-amber-800 text-white font-bold' : 'bg-slate-100 text-slate-700')
                      }`}>
                        {tier.badge}
                      </span>
                      <span className={`text-[11px] font-semibold flex items-center gap-1 ${tier.isDark ? 'text-slate-400' : 'text-slate-500'}`}>
                        <Users className="w-3.5 h-3.5" />
                        <span>{tier.memberCount} Member</span>
                      </span>
                    </div>

                    {/* Title & Sub */}
                    <div>
                      <h4 className={`text-xl font-black tracking-tight ${tier.isDark ? 'text-white' : 'text-slate-900'}`}>
                        {tier.name}
                      </h4>
                      <p className={`text-xs mt-1 font-medium leading-relaxed ${tier.isDark ? 'text-slate-400' : 'text-slate-500'}`}>
                        {tier.sub}
                      </p>
                    </div>

                    {/* Box Kualifikasi Tier */}
                    <div className={`p-3.5 rounded-2xl text-xs space-y-1 ${
                      tier.isDark ? 'bg-slate-900 border border-slate-800' : (tier.isPopular ? 'bg-amber-100/70 border border-amber-200' : 'bg-slate-50 border border-slate-200/60')
                    }`}>
                      <p className={`text-[9px] font-bold uppercase tracking-wider ${tier.isDark ? 'text-slate-400' : 'text-slate-500'}`}>KUALIFIKASI TIER</p>
                      <p className={`font-extrabold text-xs ${tier.isDark ? 'text-amber-400' : 'text-slate-900'}`}>{tier.kualifikasi}</p>
                    </div>

                    {/* Benefit Utama */}
                    <div className="space-y-2 text-xs">
                      <p className={`text-[9px] font-bold uppercase tracking-wider ${tier.isDark ? 'text-amber-400' : 'text-amber-900'}`}>
                        {tier.isDark ? 'HAK ISTIMEWA SOVEREIGN VIP' : (tier.isPopular ? 'BENEFIT UTAMA GOLD' : 'BENEFIT UTAMA')}
                      </p>
                      <ul className="space-y-2">
                        {tier.benefits.map((bf, idx) => (
                          <li key={idx} className="flex items-start gap-2">
                            <Check className={`w-4 h-4 shrink-0 mt-0.5 ${tier.isDark ? 'text-amber-400' : 'text-amber-700'}`} />
                            <span className={`font-medium ${tier.isDark ? 'text-slate-300' : 'text-slate-700'}`}>{bf}</span>
                          </li>
                        ))}
                      </ul>
                    </div>
                  </div>

                  {/* Button */}
                  <button
                    onClick={() => showToast(`Mengelola konfigurasi ${tier.name}`)}
                    className={`w-full py-3 rounded-2xl text-xs font-bold transition-all shadow-xs ${tier.btnClass}`}
                  >
                    {tier.btnLabel}
                  </button>
                </div>
              ))}
            </div>
          </div>

          {/* BOTTOM SECTION: 2 COLUMNS (DAFTAR MEMBER VIP & KATALOG REWARD) */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {/* LEFT 2 COLS: Daftar Member VIP & Riwayat Saldo Table */}
            <div className="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
              <div className="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-3">
                <div>
                  <h3 className="font-extrabold text-slate-900 text-base">Daftar Member VIP & Riwayat Saldo</h3>
                  <p className="text-xs text-slate-500 font-medium">Database patron terdaftar dan saldo poin tersimpan</p>
                </div>

                {/* Filter Pills */}
                <div className="flex items-center gap-1.5 text-xs font-semibold">
                  <button
                    onClick={() => setMemberFilter('semua')}
                    className={`px-3 py-1.5 rounded-xl transition-all ${
                      memberFilter === 'semua' ? 'bg-slate-950 text-white font-bold' : 'text-slate-500 hover:text-slate-900'
                    }`}
                  >
                    Semua
                  </button>
                  <button
                    onClick={() => setMemberFilter('black')}
                    className={`px-3 py-1.5 rounded-xl transition-all ${
                      memberFilter === 'black' ? 'bg-slate-950 text-white font-bold' : 'text-slate-500 hover:text-slate-900'
                    }`}
                  >
                    Black
                  </button>
                  <button
                    onClick={() => setMemberFilter('gold')}
                    className={`px-3 py-1.5 rounded-xl transition-all ${
                      memberFilter === 'gold' ? 'bg-slate-950 text-white font-bold' : 'text-slate-500 hover:text-slate-900'
                    }`}
                  >
                    Gold
                  </button>
                  <button
                    onClick={() => setMemberFilter('silver')}
                    className={`px-3 py-1.5 rounded-xl transition-all ${
                      memberFilter === 'silver' ? 'bg-slate-950 text-white font-bold' : 'text-slate-500 hover:text-slate-900'
                    }`}
                  >
                    Silver
                  </button>
                </div>
              </div>

              {/* Table */}
              <div className="overflow-x-auto">
                <table className="w-full text-left text-xs">
                  <thead>
                    <tr className="border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                      <th className="pb-3 pl-2">NAMA PATRON</th>
                      <th className="pb-3">TIER</th>
                      <th className="pb-3">SALDO POIN</th>
                      <th className="pb-3">KEDALUWARSA</th>
                      <th className="pb-3 pr-2 text-right">STATUS</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-slate-100">
                    {filteredMembers.length > 0 ? (
                      filteredMembers.map((m) => (
                        <tr key={m.id} className="hover:bg-slate-50/80 transition-all cursor-pointer">
                          <td className="py-3.5 pl-2">
                            <div className="flex items-center gap-3">
                              <div className="w-9 h-9 rounded-xl bg-slate-900 text-white font-bold flex items-center justify-center text-xs shrink-0">
                                {m.initials}
                              </div>
                              <div>
                                <p className="font-extrabold text-slate-900 text-xs">{m.nama}</p>
                                <p className="text-[10px] text-slate-500 font-mono">{m.phone}</p>
                              </div>
                            </div>
                          </td>
                          <td className="py-3.5">
                            <span className={`px-2 py-0.5 rounded text-[10px] font-bold ${m.tierClass}`}>
                              {m.tier}
                            </span>
                          </td>
                          <td className="py-3.5 font-extrabold text-slate-900">
                            {m.points}
                          </td>
                          <td className="py-3.5 text-slate-500 font-medium">
                            {m.expiry}
                          </td>
                          <td className="py-3.5 pr-2 text-right">
                            <span className="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                              <span className="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                              <span>{m.status}</span>
                            </span>
                          </td>
                        </tr>
                      ))
                    ) : (
                      <tr>
                        <td colSpan="5" className="py-12 text-center text-slate-400 font-semibold">
                          Belum ada member patron terdaftar.
                        </td>
                      </tr>
                    )}
                  </tbody>
                </table>
              </div>

              {/* Table Footer */}
              <div className="flex items-center justify-between border-t border-slate-100 pt-3 text-xs font-medium text-slate-500">
                <span>Menampilkan {filteredMembers.length} dari {currentData.stats.totalMember} patron loyalitas</span>
                <div className="flex items-center gap-2">
                  <button className="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold hover:bg-slate-200">Sebelumnya</button>
                  <button className="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold hover:bg-slate-200">Berikutnya</button>
                </div>
              </div>
            </div>

            {/* RIGHT 1 COL: Katalog Penukaran Hadiah */}
            <div className="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4 flex flex-col justify-between">
              <div className="space-y-4">
                <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                  <div>
                    <h3 className="font-extrabold text-slate-900 text-base">Katalog Penukaran Hadiah</h3>
                    <p className="text-xs text-slate-500 font-medium">Voucher & ritual eksklusif yang dapat ditebus patron</p>
                  </div>
                  <button className="p-1.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-500 hover:bg-slate-100">
                    <Filter className="w-4 h-4" />
                  </button>
                </div>

                {/* Reward Items List */}
                <div className="space-y-3">
                  {currentData.rewardList.length > 0 ? (
                    currentData.rewardList.map((rw) => (
                      <div key={rw.id} className="p-3.5 bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center justify-between gap-3">
                        <div className="flex items-center gap-3">
                          <div className="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0 border border-amber-200">
                            <Gift className="w-5 h-5" />
                          </div>
                          <div>
                            <h5 className="font-bold text-slate-900 text-xs leading-tight">{rw.name}</h5>
                            <p className="text-[10px] text-slate-500 mt-0.5">
                              <span className="font-bold text-amber-700">{rw.points} Poin</span> • {rw.count}x ditukar
                            </p>
                          </div>
                        </div>

                        <button
                          onClick={() => showToast(`Penukaran ${rw.name} diproses`)}
                          className={`px-3 py-1.5 rounded-xl text-xs transition-all shrink-0 ${rw.btnClass}`}
                        >
                          Tukarkan
                        </button>
                      </div>
                    ))
                  ) : (
                    <div className="py-12 text-center text-slate-400 space-y-2 border border-dashed border-slate-200 rounded-2xl">
                      <Gift className="w-8 h-8 mx-auto text-slate-300" />
                      <p className="text-xs font-semibold">Belum ada katalog hadiah reward.</p>
                    </div>
                  )}
                </div>
              </div>

              {/* Bottom Add Reward Button */}
              <button
                onClick={() => setShowAddRewardModal(true)}
                className="w-full py-3 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold rounded-2xl text-xs border border-slate-200 transition-all flex items-center justify-center gap-2"
              >
                <Plus className="w-4 h-4 text-slate-600" />
                <span>+ Tambah Hadiah Reward Baru</span>
              </button>
            </div>

          </div>

        </main>
      </div>

      {/* ==========================================
          MODAL TAMBAH HADIAH REWARD
      ========================================== */}
      {showAddRewardModal && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4 border border-slate-200">
            <div className="flex items-center justify-between border-b border-slate-100 pb-3">
              <h3 className="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                <Gift className="w-5 h-5 text-amber-500" />
                <span>+ Tambah Hadiah Reward Baru</span>
              </h3>
              <button onClick={() => setShowAddRewardModal(false)} className="text-slate-400 hover:text-slate-600">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleAddReward} className="space-y-3 text-xs">
              <div>
                <label className="font-bold text-slate-700 block mb-1">Nama Voucher / Reward</label>
                <input
                  type="text"
                  required
                  placeholder="Misal: Voucher Diskon Rp 50.000"
                  value={newRewardForm.name}
                  onChange={(e) => setNewRewardForm({ ...newRewardForm, name: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Jumlah Poin Diperlukan</label>
                <input
                  type="number"
                  required
                  placeholder="500"
                  value={newRewardForm.points}
                  onChange={(e) => setNewRewardForm({ ...newRewardForm, points: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl font-bold focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div className="pt-2 flex justify-end gap-2">
                <button
                  type="button"
                  onClick={() => setShowAddRewardModal(false)}
                  className="px-4 py-2 bg-slate-100 text-slate-700 font-bold rounded-xl"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="px-5 py-2 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-xl shadow-md"
                >
                  Simpan Hadiah Reward
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

    </div>
  );
}
