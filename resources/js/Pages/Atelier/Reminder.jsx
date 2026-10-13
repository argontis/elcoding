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
  Send as SendIcon, Info, ChevronUp, UserCheck, Smartphone, Lock,
  Paperclip, Mic, Video, Radio, Sparkle, Bot, CheckCheck
} from 'lucide-react';

export default function AtelierReminder({ auth }) {
  const user = auth?.user || { name: 'Mario Alfarizi', email: 'admin@lstyle.id', role: 'Owner / Manager' };

  // Data Mode State: 'kosong' (default) vs 'demo'
  const [dataMode, setDataMode] = useState('kosong');
  const [activeTab, setActiveTab] = useState('reminder'); // 'reminder' | 'promo' | 'history' | 'api'
  const [searchQuery, setSearchQuery] = useState('');
  const [toastMessage, setToastMessage] = useState(null);

  // Form & Campaign State
  const [campaignTitle, setCampaignTitle] = useState('Promo Spesial Weekend Haircut & Free Scalp Tonic');
  const [campaignMessage, setCampaignMessage] = useState(
    "Halo kak Dimas! ✨\n\nSaatnya tampil rapi akhir pekan ini di L-Style Atelier Senopati.\n\nNikmati promo eksklusif: Diskon 20% untuk The Sovereign Haircut + Free Scalp Purifying Tonic khusus member akhir pekan ini!"
  );

  // Modals state
  const [showCreatePromoModal, setShowCreatePromoModal] = useState(false);
  const [showApiConfigModal, setShowApiConfigModal] = useState(false);

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
      pesanTerkirim: '1.240',
      pesanGrowth: '↑+18.4%',
      pesanSub: 'Target bulanan: 2.000 pengiriman',
      openRate: '98.2%',
      openRateSub: '94% dibaca dalam 5 menit pertama',
      industryAvg: 'Industry avg: 75%',
      bookingKembali: '312',
      bookingSub: 'Estimasi omzet kembali: Rp 84.240.000',
      konversiRate: '25.1% konversi',
      saldoKuota: '8.760',
      kuotaSub: 'Cukup untuk estimasi ~4,2 bulan',
      topUpStatus: 'Top Up'
    },
    reminders: [
      {
        id: 1,
        initials: 'BS',
        name: 'Bimo Santoso',
        phone: '0812-9876-5432',
        badge: 'Loyal Member',
        badgeClass: 'bg-amber-100 text-amber-900 border border-amber-300 font-bold',
        triggerTitle: '✂️ Waktunya Haircut Rutin',
        triggerSub: '(Sudah 24 Hari)',
        lastVisit: '30 Sep 2024',
        lastService: 'Signature Cut & Wash (Stylist: Reza)',
        template: 'Template: Haircut Regular V2',
        isScheduled: false
      },
      {
        id: 2,
        initials: 'JA',
        name: 'Jessica Aurelia',
        phone: '0811-9234-5678',
        badge: 'VIP Salon',
        badgeClass: 'bg-purple-100 text-purple-900 border border-purple-300 font-bold',
        triggerTitle: '🎨 Perawatan Re-Touch Balayage',
        triggerSub: '(Sudah 60 Hari)',
        lastVisit: '25 Agu 2024',
        lastService: 'Balayage Blonde Honey & Gloss',
        template: 'Template: Balayage Refresh Care',
        isScheduled: false
      },
      {
        id: 3,
        initials: 'DP',
        name: 'Dimas Pratama',
        phone: '0812-9988-8219',
        badge: 'Gold Tier',
        badgeClass: 'bg-amber-50 text-amber-800 border border-amber-200 font-bold',
        triggerTitle: '🎂 Ulang Tahun Member Gold Besok',
        triggerSub: 'Bonus 2x Poin',
        birthDate: '25 Oktober',
        reward: 'Free Hair Spa Voucher',
        template: 'Otomatis via Cloud Scheduler',
        isScheduled: true,
        scheduledTime: 'Terjadwal Otomatis Besok 09:00 WIB'
      },
      {
        id: 4,
        initials: 'AW',
        name: 'Arif Wibowo',
        phone: '0813-1122-3344',
        badge: 'Booking Online',
        badgeClass: 'bg-slate-100 text-slate-800 border border-slate-300 font-bold',
        triggerTitle: '✓ Konfirmasi Booking Besok Pukul 14:00 WIB',
        triggerSub: 'Slot Antrean No. 04',
        chairInfo: 'Kursi Chair #3',
        lastService: 'Stylist: Fajar (Royal Treatment Package)',
        statusLabel: 'Siap Kirim',
        isScheduled: false
      }
    ]
  };

  const emptyData = {
    stats: {
      pesanTerkirim: '0',
      pesanGrowth: '0%',
      pesanSub: 'Belum ada pesan terkirim',
      openRate: '0%',
      openRateSub: 'Menunggu pengiriman pertama',
      industryAvg: 'Target: 85%+',
      bookingKembali: '0',
      bookingSub: 'Konversi booking ulang',
      konversiRate: '0% konversi',
      saldoKuota: '10.000',
      kuotaSub: 'Kuota awal Meta Business API',
      topUpStatus: 'Aktif'
    },
    reminders: []
  };

  const [currentData, setCurrentData] = useState(emptyData);

  useEffect(() => {
    if (dataMode === 'demo') {
      setCurrentData(demoData);
    } else {
      setCurrentData(emptyData);
    }
  }, [dataMode]);

  const handleSendWaSingle = (name) => {
    showToast(`Pesan WhatsApp Reminder berhasil dikirim ke ${name}!`);
  };

  const handleSendAllBatch = () => {
    showToast(`Batch Broadcast 42 Notifikasi WhatsApp Berhasil Dikirim!`);
  };

  const handleLogout = () => {
    router.post('/logout');
  };

  return (
    <div className="min-h-screen bg-[#F4F5F7] font-sans text-slate-800 flex flex-col md:flex-row">
      <Head title="Automasi Reminder & WhatsApp Marketing - L-Style ATELIER SUITE" />

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
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all font-medium"
              >
                <Percent className="w-4 h-4 text-slate-400" />
                <span>Komisi Pegawai</span>
              </Link>

              <Link
                href="/barbershop/reminder"
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-slate-900 text-white shadow-sm font-semibold transition-all"
              >
                <Bell className="w-4 h-4 text-white" />
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
                <span className="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>WHATSAPP BUSINESS CLOUD API</span>
                <span>/</span>
                <span>Senopati Cluster</span>
              </p>
              <h2 className="text-2xl font-black text-slate-900 tracking-tight">Automasi Reminder & WhatsApp Marketing</h2>
              <p className="text-xs text-slate-500 font-medium mt-0.5 max-w-2xl">
                Jadwalkan pengingat potong rambut otomatis, ucapan ulang tahun member, dan broadcast promosi WhatsApp resmi langsung ke ponsel tamu.
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

              {/* Bot WA API Badge */}
              <div className="px-3.5 py-2 bg-white text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-xs flex items-center gap-2">
                <span className="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Bot WA API: Terhubung</span>
                <SlidersHorizontal className="w-3.5 h-3.5 text-slate-400 ml-1" />
              </div>

              {/* + Buat Kampanye Promo WA */}
              <button
                onClick={() => setShowCreatePromoModal(true)}
                className="px-4 py-2 bg-slate-950 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-md flex items-center gap-2"
              >
                <Plus className="w-4 h-4" />
                <span>+ Buat Kampanye Promo WA</span>
              </button>
            </div>
          </div>

          {/* Navigation Tabs Bar */}
          <div className="flex items-center gap-3 overflow-x-auto pb-1 text-xs font-semibold">
            <button
              onClick={() => setActiveTab('reminder')}
              className={`px-4 py-3 rounded-2xl transition-all shrink-0 flex items-center gap-2 border ${
                activeTab === 'reminder' ? 'bg-white text-slate-900 border-slate-200 shadow-xs font-bold' : 'bg-slate-100/70 text-slate-600 border-transparent hover:bg-slate-200/60'
              }`}
            >
              <Bell className="w-4 h-4 text-amber-600" />
              <span>Reminder Otomatis</span>
              <span className="px-2 py-0.5 rounded text-[10px] font-extrabold bg-amber-100 text-amber-900 border border-amber-200">
                42 Siap Kirim
              </span>
            </button>

            <button
              onClick={() => setActiveTab('promo')}
              className={`px-4 py-3 rounded-2xl transition-all shrink-0 flex items-center gap-2 border ${
                activeTab === 'promo' ? 'bg-white text-slate-900 border-slate-200 shadow-xs font-bold' : 'bg-slate-100/70 text-slate-600 border-transparent hover:bg-slate-200/60'
              }`}
            >
              <MessageSquare className="w-4 h-4 text-purple-600" />
              <span>Promo Broadcast WhatsApp</span>
              <span className="px-2 py-0.5 rounded text-[10px] font-extrabold bg-purple-100 text-purple-900 border border-purple-200">
                3 Kampanye
              </span>
            </button>

            <button
              onClick={() => setActiveTab('history')}
              className={`px-4 py-3 rounded-2xl transition-all shrink-0 flex items-center gap-2 border ${
                activeTab === 'history' ? 'bg-white text-slate-900 border-slate-200 shadow-xs font-bold' : 'bg-slate-100/70 text-slate-600 border-transparent hover:bg-slate-200/60'
              }`}
            >
              <Clock className="w-4 h-4 text-slate-500" />
              <span>Riwayat Pesan Terkirim</span>
            </button>

            <button
              onClick={() => setActiveTab('api')}
              className={`px-4 py-3 rounded-2xl transition-all shrink-0 flex items-center gap-2 border ${
                activeTab === 'api' ? 'bg-white text-slate-900 border-slate-200 shadow-xs font-bold' : 'bg-slate-100/70 text-slate-600 border-transparent hover:bg-slate-200/60'
              }`}
            >
              <ShieldCheck className="w-4 h-4 text-emerald-600" />
              <span>Meta Cloud Verified Tier 2</span>
            </button>
          </div>

          {/* Top 4 Summary Metric Cards */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {/* Stat 1: PESAN TERKIRIM BULAN INI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">PESAN TERKIRIM BULAN INI</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.pesanTerkirim}</h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-0.5">{currentData.stats.pesanGrowth}</p>
                <p className="text-[10px] text-slate-400 mt-2 font-medium">{currentData.stats.pesanSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <SendIcon className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 2: OPEN RATE WHATSAPP */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">OPEN RATE WHATSAPP</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.openRate}</h3>
                <span className="inline-block px-2 py-0.5 rounded text-[9px] font-bold bg-slate-100 text-slate-700 border border-slate-200 mt-0.5">
                  {currentData.stats.industryAvg}
                </span>
                <p className="text-[10px] text-slate-500 mt-2 font-medium">{currentData.stats.openRateSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <MessageSquare className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 3: BOOKING KEMBALI DARI REMINDER */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">BOOKING KEMBALI DARI REMINDER</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.bookingKembali}</h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-0.5">{currentData.stats.konversiRate}</p>
                <p className="text-[10px] text-slate-400 mt-2 font-medium">{currentData.stats.bookingSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <Calendar className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 4: SALDO KUOTA PESAN */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">SALDO KUOTA PESAN</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.saldoKuota} <span className="text-xs font-medium text-slate-400">Kuota</span></h3>
                <span className="inline-block px-2 py-0.5 rounded text-[9px] font-extrabold bg-amber-100 text-amber-900 border border-amber-200 mt-0.5">
                  {currentData.stats.topUpStatus}
                </span>
                <p className="text-[10px] text-slate-500 mt-2 font-medium">{currentData.stats.kuotaSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <Coins className="w-5 h-5" />
              </div>
            </div>
          </div>

          {/* MAIN 2-COLUMN WORKSPACE SECTION */}
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            {/* LEFT 7/12: ANTREAN REMINDER HARI INI */}
            <div className="lg:col-span-7 space-y-4">
              <div className="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs space-y-4">
                <div className="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-3">
                  <div className="flex items-center gap-3">
                    <div className="w-10 h-10 rounded-2xl bg-slate-950 text-white flex items-center justify-center">
                      <MessageSquare className="w-5 h-5 text-emerald-400" />
                    </div>
                    <div>
                      <h3 className="font-extrabold text-slate-900 text-base">Antrean Reminder Hari Ini</h3>
                      <p className="text-xs text-slate-500 font-medium">4 tamu prioritas menunggu notifikasi via WhatsApp official</p>
                    </div>
                  </div>

                  <button
                    onClick={handleSendAllBatch}
                    className="px-4 py-2.5 bg-slate-950 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-md flex items-center gap-2"
                  >
                    <SendIcon className="w-3.5 h-3.5 text-emerald-400" />
                    <span>Kirim Semua (Batch 42 Tamu)</span>
                  </button>
                </div>

                {/* Reminders List */}
                <div className="space-y-3">
                  {currentData.reminders.length > 0 ? (
                    currentData.reminders.map((r) => (
                      <div
                        key={r.id}
                        className="bg-slate-50/90 rounded-2xl p-4 border border-slate-200/80 space-y-3 hover:bg-slate-100/60 transition-all border-l-4 border-l-emerald-600"
                      >
                        <div className="flex flex-wrap items-center justify-between gap-2">
                          <div className="flex items-center gap-3">
                            <div className="w-9 h-9 rounded-xl bg-slate-950 text-white font-bold flex items-center justify-center text-xs shrink-0">
                              {r.initials}
                            </div>
                            <div>
                              <div className="flex items-center gap-2">
                                <h4 className="font-extrabold text-slate-900 text-xs">{r.name}</h4>
                                <span className="text-slate-400 font-mono text-[11px]">{r.phone}</span>
                              </div>
                              <span className={`px-2 py-0.5 rounded text-[9px] ${r.badgeClass} inline-block mt-0.5`}>
                                {r.badge}
                              </span>
                            </div>
                          </div>

                          {!r.isScheduled ? (
                            <button
                              onClick={() => handleSendWaSingle(r.name)}
                              className="px-3.5 py-2 bg-emerald-950 hover:bg-emerald-900 text-white font-bold rounded-xl text-xs transition-all flex items-center gap-1.5 shadow-sm"
                            >
                              <SendIcon className="w-3.5 h-3.5 text-emerald-400" />
                              <span>Kirim WhatsApp Sekarang</span>
                            </button>
                          ) : (
                            <div className="px-3 py-1.5 bg-amber-50 text-amber-900 border border-amber-200 rounded-xl text-[11px] font-bold flex items-center gap-1.5">
                              <Clock className="w-3.5 h-3.5 text-amber-700" />
                              <span>{r.scheduledTime}</span>
                            </div>
                          )}
                        </div>

                        {/* Details Box */}
                        <div className="bg-white p-3 rounded-xl border border-slate-200/60 space-y-1 text-xs">
                          <div className="flex items-center justify-between font-bold text-slate-900">
                            <span className="flex items-center gap-1">
                              <Scissors className="w-3.5 h-3.5 text-amber-600" />
                              <span>{r.triggerTitle}</span>
                            </span>
                            <span className="text-[10px] text-slate-400">{r.triggerSub}</span>
                          </div>

                          <p className="text-[11px] text-slate-500 font-medium">
                            {r.lastVisit && `Terakhir: ${r.lastVisit} • Layanan: ${r.lastService}`}
                            {r.birthDate && `Tanggal Lahir: ${r.birthDate} • Tersedia: ${r.reward}`}
                            {r.chairInfo && `${r.chairInfo} • ${r.lastService}`}
                          </p>
                        </div>

                        <div className="flex items-center justify-between text-[10px] text-slate-400 font-medium">
                          <span>{r.template}</span>
                          <span className="text-emerald-600 font-bold">Meta Business Cloud API Valid</span>
                        </div>
                      </div>
                    ))
                  ) : (
                    <div className="py-12 text-center text-slate-400 space-y-2 border border-dashed border-slate-200 rounded-2xl">
                      <Bell className="w-8 h-8 mx-auto text-slate-300" />
                      <p className="text-xs font-semibold">Belum ada antrean reminder otomatis hari ini.</p>
                    </div>
                  )}
                </div>
              </div>

              {/* Waktu Emas Pengiriman Notifikasi Card */}
              <div className="bg-amber-50/70 border border-amber-200/80 rounded-3xl p-4 flex items-start gap-3.5 text-xs">
                <div className="w-9 h-9 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 border border-amber-300">
                  <Sparkles className="w-5 h-5" />
                </div>
                <div>
                  <h5 className="font-extrabold text-slate-900 text-xs">Waktu Emas Pengiriman Notifikasi</h5>
                  <p className="text-[11px] text-slate-600 font-medium leading-relaxed mt-0.5">
                    Analisis historis pelanggan Senopati menunjukkan bahwa reminder potong rambut yang dikirim pukul <span className="font-bold text-amber-900">11:30 - 13:00</span> dan <span className="font-bold text-amber-900">18:30 - 20:00 WIB</span> menghasilkan konversi booking ulang <span className="font-bold text-emerald-700">41% lebih cepat</span>.
                  </p>
                </div>
              </div>
            </div>

            {/* RIGHT 5/12: CAMPAIGN STUDIO & SMARTPHONE PREVIEW */}
            <div className="lg:col-span-5 space-y-4">
              <div className="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs space-y-4">
                <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                  <div>
                    <span className="text-[9px] font-bold uppercase tracking-widest text-slate-400">CAMPAIGN STUDIO</span>
                    <h3 className="font-extrabold text-slate-900 text-base">{campaignTitle}</h3>
                  </div>
                  <span className="px-2.5 py-1 rounded text-[9px] font-bold bg-purple-100 text-purple-900 border border-purple-200">
                    Broadcast WA
                  </span>
                </div>

                <div className="space-y-1.5 text-xs font-medium text-slate-600">
                  <div className="flex justify-between">
                    <span>Target Audiens:</span>
                    <span className="font-bold text-slate-900">412 Tamu Reguler & Silver Member</span>
                  </div>
                  <div className="flex justify-between">
                    <span>Jadwal Kirim:</span>
                    <span className="font-bold text-amber-800 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                      Sabtu, 26 Okt 2024 • 10:00 WIB
                    </span>
                  </div>
                </div>

                {/* REALISTIC SMARTPHONE MOCKUP */}
                <div className="bg-slate-900 p-3 rounded-[36px] shadow-2xl border-4 border-slate-800 relative max-w-sm mx-auto">
                  {/* Phone Screen Outer */}
                  <div className="bg-slate-100 rounded-[28px] overflow-hidden text-slate-900 space-y-0 text-xs">

                    {/* WA Header Bar */}
                    <div className="bg-[#075E54] text-white p-3 flex items-center justify-between">
                      <div className="flex items-center gap-2">
                        <div className="w-8 h-8 rounded-full bg-slate-950 text-white font-bold flex items-center justify-center text-xs shadow-xs border border-white/30">
                          L
                        </div>
                        <div>
                          <p className="font-bold text-xs flex items-center gap-1">
                            L-Style Atelier Official <CheckCheck className="w-3.5 h-3.5 text-blue-300" />
                          </p>
                          <p className="text-[9px] text-slate-200">Official Business Account</p>
                        </div>
                      </div>

                      <div className="flex items-center gap-2 text-slate-200">
                        <Video className="w-4 h-4" />
                        <Phone className="w-4 h-4" />
                      </div>
                    </div>

                    {/* Chat Bubble Body */}
                    <div className="bg-[#E5DDD5] p-3 space-y-3 min-h-[300px] flex flex-col justify-between">
                      <div className="space-y-2">
                        <div className="bg-amber-100/90 border border-amber-300 text-amber-900 text-[9px] p-1.5 rounded-xl text-center font-semibold">
                          🔒 Pesan ini terenkripsi resmi melalui Meta Business API
                        </div>

                        <div className="text-center">
                          <span className="bg-white/80 px-2 py-0.5 rounded text-[9px] font-bold text-slate-500 uppercase">
                            SABTU, 26 OKTOBER
                          </span>
                        </div>

                        {/* WhatsApp Message Card Bubble */}
                        <div className="bg-white rounded-2xl overflow-hidden shadow-sm p-0 border border-slate-200 text-slate-800 max-w-[260px] mx-auto">
                          {/* Image inside message */}
                          <div className="h-32 bg-slate-900 relative">
                            <img
                              src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=800&q=80"
                              alt="Promo Weekend"
                              className="w-full h-full object-cover"
                            />
                            <div className="absolute bottom-2 left-2 bg-amber-500 text-slate-950 px-2 py-0.5 rounded text-[8px] font-extrabold uppercase">
                              WEEKEND PRIVILEGE
                            </div>
                          </div>

                          {/* Message Body Text */}
                          <div className="p-3 text-[11px] leading-relaxed whitespace-pre-line text-slate-800">
                            {campaignMessage}
                          </div>
                        </div>
                      </div>

                      {/* Mock WA Bottom Input */}
                      <div className="bg-white rounded-full px-3 py-1.5 flex items-center justify-between text-slate-400 text-[10px]">
                        <span>Pratinjau tampilan pesan tamu...</span>
                        <div className="flex items-center gap-1 text-slate-400">
                          <Paperclip className="w-3.5 h-3.5" />
                          <Mic className="w-3.5 h-3.5" />
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                {/* Campaign Action Controls */}
                <div className="space-y-2">
                  <button
                    onClick={() => showToast('Kampanye WhatsApp berhasil dijadwalkan!')}
                    className="w-full py-3.5 bg-slate-950 hover:bg-slate-800 text-white font-black rounded-2xl text-xs shadow-xl transition-all flex items-center justify-center gap-2"
                  >
                    <Calendar className="w-4 h-4 text-amber-400" />
                    <span>Jadwalkan Pengiriman Kampanye</span>
                  </button>

                  <div className="grid grid-cols-2 gap-2 text-xs">
                    <button
                      onClick={() => showToast('Draft kampanye disimpan')}
                      className="py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold rounded-xl border border-slate-200 transition-all"
                    >
                      💾 Simpan Draft
                    </button>

                    <button
                      onClick={() => showToast('Tes pesan terkirim ke WhatsApp Anda!')}
                      className="py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold rounded-xl border border-slate-200 transition-all flex items-center justify-center gap-1"
                    >
                      <Smartphone className="w-3.5 h-3.5 text-emerald-600" />
                      <span>Tes Kirim ke Nomor Saya</span>
                    </button>
                  </div>
                </div>

              </div>

              {/* Compliance Badge */}
              <div className="bg-white rounded-3xl p-4 border border-slate-200/80 text-xs font-semibold text-slate-600 flex items-center gap-2.5 shadow-xs">
                <ShieldCheck className="w-5 h-5 text-emerald-600 shrink-0" />
                <div>
                  <h5 className="font-extrabold text-slate-900 text-xs">Kepatuhan WhatsApp Opt-In</h5>
                  <p className="text-[10px] text-slate-500 font-medium">Setiap pesan broadcast mematuhi standar privasi Meta Business API.</p>
                </div>
              </div>

            </div>

          </div>

        </main>
      </div>

    </div>
  );
}
