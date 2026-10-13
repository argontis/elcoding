import React, { useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import {
  LayoutGrid, Calendar, Users, Award, Scissors, ShoppingBag,
  Percent, Bell, MessageSquare, Settings, Search, Plus, CheckCircle,
  Clock, ArrowUpRight, ChevronRight, X, User, CreditCard, ChevronDown,
  Sparkles, Check, DollarSign, RefreshCw, BarChart2, Filter,
  Phone, AlertCircle, Eye, Printer, Trash2, CalendarX, CheckCircle2,
  ChevronLeft, Send, AlertTriangle, Download, Edit3, UserPlus, Tag, Star
} from 'lucide-react';

export default function AtelierPelanggan({ auth }) {
  const user = auth?.user || { name: 'Mario Alfarizi', email: 'admin@lstyle.id', role: 'Owner / Manager' };

  // ==========================================
  // STATE MANAGEMENT
  // ==========================================
  // Mode data: 'kosong' (Default - empty for user to input) vs 'demo' (Pre-populated sample data)
  const [dataMode, setDataMode] = useState('kosong');
  const [filterTab, setFilterTab] = useState('semua'); // 'semua' | 'vip' | 'reguler' | 'followup'
  const [searchQuery, setSearchQuery] = useState('');
  const [toastMessage, setToastMessage] = useState(null);

  // Modals state
  const [showAddModal, setShowAddModal] = useState(false);
  const [selectedPelanggan, setSelectedPelanggan] = useState(null);

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
      totalPelanggan: 1842,
      totalSub: '↗ +28 bln ini',
      memberAktif: 640,
      memberSub: 'Black VIP & Gold',
      tamuLoyal: 412,
      loyalSub: '> 5 Kunjungan',
      retensiRate: '78.4%',
      retensiSub: '↑ +3.2%'
    },
    pelangganList: [
      {
        id: 'L-8819',
        nama: 'Dimas Pratama',
        phone: '0812-9988-8219',
        tier: 'GOLD VIP',
        tierBadgeClass: 'bg-amber-100 text-amber-900 border-amber-300',
        memberSince: 'Nov 2022',
        branch: 'Senopati Branch',
        stylistFav: 'Reza Pratama',
        jumlahDatang: 14,
        points: 1450,
        terakhirKunjungan: 'Kemarin',
        layananTerakhir: 'Gentleman Royal Cut',
        totalBelanja: 4850000,
        totalTransaksiCount: 14,
        siklusKunjungan: 'Tiap 18 Hari',
        siklusSub: 'Siklus disiplin',
        ratingKepuasan: 5.0,
        ulasanCount: 10,
        catatanPreferensi: 'Suka potongan low fade natural, tidak suka produk rambut berbau tajam, minuman favorit: Cold Brew Americano tanpa gula.',
        catatanStylistBy: 'Reza P.',
        tags: ['#LowFade', '#MatteClayOnly', '#ColdBrewFan'],
        nextEstDate: '11 Nov 2024',
        nextEstDays: '18 hari lagi',
        riwayat: [
          { service: 'Gentleman Royal Cut', date: '24 Okt 2024', stylist: 'Reza Pratama', price: 250000, status: 'Selesai' },
          { service: 'Hair Spa Detox & Beard Trim', date: '02 Okt 2024', stylist: 'Reza Pratama', price: 320000, status: 'Selesai' },
          { service: 'Signature Haircut', date: '12 Sep 2024', stylist: 'David Gunawan', price: 180000, status: 'Selesai' }
        ]
      },
      {
        id: 'L-0412',
        nama: 'Jessica Aurelia',
        phone: '0811-9234-5678',
        tier: 'BLACK VIP',
        tierBadgeClass: 'bg-slate-900 text-amber-400 border-slate-700',
        memberSince: 'Jan 2022',
        branch: 'Senopati Branch',
        stylistFav: 'Elena Rose',
        jumlahDatang: 22,
        points: 3120,
        terakhirKunjungan: '24 Okt 2024',
        layananTerakhir: 'Balayage & Gloss',
        totalBelanja: 8650000,
        totalTransaksiCount: 22,
        siklusKunjungan: 'Tiap 14 Hari',
        siklusSub: 'VIP Regular',
        ratingKepuasan: 5.0,
        ulasanCount: 18,
        catatanPreferensi: 'Sensitif scalp, suka warna ash blonde / cold silver tone, selalu sediakan sparkling water.',
        catatanStylistBy: 'Elena R.',
        tags: ['#AshBlonde', '#SensitiveScalp', '#SparklingWater'],
        nextEstDate: '07 Nov 2024',
        nextEstDays: '14 hari lagi',
        riwayat: [
          { service: 'Balayage & Gloss Hair Treatment', date: '24 Okt 2024', stylist: 'Elena Rose', price: 650000, status: 'Selesai' },
          { service: 'Scalp Detox & Hair Blow', date: '10 Okt 2024', stylist: 'Elena Rose', price: 350000, status: 'Selesai' }
        ]
      },
      {
        id: 'L-1099',
        nama: 'Bimo Santoso',
        phone: '0812-9876-5432',
        tier: 'BLACK VIP',
        tierBadgeClass: 'bg-slate-900 text-amber-400 border-slate-700',
        memberSince: 'Mar 2023',
        branch: 'Senopati Branch',
        stylistFav: 'David Gunawan',
        jumlahDatang: 18,
        points: 1450,
        terakhirKunjungan: 'Hari Ini',
        layananTerakhir: 'Signature Cut',
        totalBelanja: 3240000,
        totalTransaksiCount: 18,
        siklusKunjungan: 'Tiap 21 Hari',
        siklusSub: 'Siklus stabil',
        ratingKepuasan: 4.9,
        ulasanCount: 12,
        catatanPreferensi: 'Potongan klasik pompadour, pomade waterbased shine finish.',
        catatanStylistBy: 'David G.',
        tags: ['#Pompadour', '#ShineFinish', '#ClassicCut'],
        nextEstDate: '15 Nov 2024',
        nextEstDays: '22 hari lagi',
        riwayat: [
          { service: 'Signature Cut & Styling', date: '07 Okt 2024', stylist: 'David Gunawan', price: 180000, status: 'Selesai' }
        ]
      },
      {
        id: 'L-3290',
        nama: 'Arif Wibowo',
        phone: '0813-1122-3344',
        tier: 'SILVER',
        tierBadgeClass: 'bg-slate-200 text-slate-800 border-slate-300',
        memberSince: 'Mei 2023',
        branch: 'Senopati Branch',
        stylistFav: 'Barber Dimas',
        jumlahDatang: 7,
        points: 520,
        terakhirKunjungan: '18 Sep 2024',
        layananTerakhir: 'Classic Fade & Shave',
        totalBelanja: 1260000,
        totalTransaksiCount: 7,
        siklusKunjungan: 'Tiap 30 Hari',
        siklusSub: 'Tamu bulanan',
        ratingKepuasan: 4.8,
        ulasanCount: 5,
        catatanPreferensi: 'High fade licin, hot towel shave aroma menthol.',
        catatanStylistBy: 'Dimas P.',
        tags: ['#HighFade', '#HotTowelShave'],
        nextEstDate: '28 Okt 2024',
        nextEstDays: '4 hari lagi',
        riwayat: [
          { service: 'Classic Fade & Shave', date: '18 Sep 2024', stylist: 'Barber Dimas', price: 180000, status: 'Selesai' }
        ]
      },
      {
        id: 'L-4811',
        nama: 'Siska Amelia',
        phone: '0815-5544-3322',
        tier: 'REGULER',
        tierBadgeClass: 'bg-slate-100 text-slate-600 border-slate-200',
        memberSince: 'Agu 2024',
        branch: 'Senopati Branch',
        stylistFav: 'Elena Rose',
        jumlahDatang: 3,
        points: 180,
        terakhirKunjungan: '04 Agu 2024',
        layananTerakhir: 'Wash & Blow Out',
        totalBelanja: 540000,
        totalTransaksiCount: 3,
        siklusKunjungan: 'Tiap 45 Hari',
        siklusSub: 'Tamu berkala',
        ratingKepuasan: 4.7,
        ulasanCount: 2,
        catatanPreferensi: 'Blowout wave lembut, tanpa produk alkohol.',
        catatanStylistBy: 'Elena R.',
        tags: ['#SoftBlowout', '#NonAlcoholProduct'],
        nextEstDate: '01 Nov 2024',
        nextEstDays: '8 hari lagi',
        riwayat: [
          { service: 'Wash & Blow Out', date: '04 Agu 2024', stylist: 'Elena Rose', price: 180000, status: 'Selesai' }
        ]
      }
    ]
  };

  const emptyData = {
    stats: {
      totalPelanggan: 0,
      totalSub: 'Belum ada pelanggan terdaftar',
      memberAktif: 0,
      memberSub: '0 VIP & Gold',
      tamuLoyal: 0,
      loyalSub: '0 Kunjungan',
      retensiRate: '0%',
      retensiSub: 'Target: 80%'
    },
    pelangganList: []
  };

  // Dynamic Data State
  const [currentData, setCurrentData] = useState(emptyData);

  // Sync state when dataMode switches
  useEffect(() => {
    if (dataMode === 'demo') {
      setCurrentData(demoData);
      setSelectedPelanggan(demoData.pelangganList[0]); // Select Dimas Pratama by default in demo mode
    } else {
      setCurrentData(emptyData);
      setSelectedPelanggan(null);
    }
  }, [dataMode]);

  // New Client Form State
  const [newClientForm, setNewClientForm] = useState({
    nama: '',
    phone: '',
    tier: 'GOLD VIP',
    stylistFav: 'Reza Pratama',
    catatanPreferensi: ''
  });

  const handleAddClient = (e) => {
    e.preventDefault();
    if (!newClientForm.nama) return;

    const nextId = `L-${9000 + currentData.pelangganList.length}`;
    const newClient = {
      id: nextId,
      nama: newClientForm.nama,
      phone: newClientForm.phone || '0812-0000-0000',
      tier: newClientForm.tier,
      tierBadgeClass: newClientForm.tier.includes('VIP') ? 'bg-amber-100 text-amber-900 border-amber-300' : 'bg-slate-100 text-slate-600 border-slate-200',
      memberSince: 'Hari Ini',
      branch: 'Senopati Branch',
      stylistFav: newClientForm.stylistFav,
      jumlahDatang: 1,
      points: 100,
      terakhirKunjungan: 'Hari Ini',
      layananTerakhir: 'Registrasi Perdana',
      totalBelanja: 0,
      totalTransaksiCount: 0,
      siklusKunjungan: 'Tiap 30 Hari',
      siklusSub: 'Member Baru',
      ratingKepuasan: 5.0,
      ulasanCount: 1,
      catatanPreferensi: newClientForm.catatanPreferensi || 'Pelanggan baru terdaftar di sistem Atelier.',
      catatanStylistBy: 'Reception desk',
      tags: ['#NewMember', '#FirstVisit'],
      nextEstDate: '30 Hari Lagi',
      nextEstDays: '30 hari lagi',
      riwayat: []
    };

    const updatedList = [newClient, ...currentData.pelangganList];
    const newTotal = currentData.stats.totalPelanggan + 1;
    const newMemberAktif = currentData.stats.memberAktif + (newClient.tier.includes('VIP') ? 1 : 0);

    setCurrentData(prev => ({
      ...prev,
      stats: {
        ...prev.stats,
        totalPelanggan: newTotal,
        memberAktif: newMemberAktif,
        totalSub: '↗ +1 baru hari ini'
      },
      pelangganList: updatedList
    }));

    setSelectedPelanggan(newClient);
    setShowAddModal(false);
    showToast(`Pelanggan baru "${newClient.nama}" (ID: ${newClient.id}) berhasil ditambahkan!`);
  };

  const handleLogout = () => {
    router.post('/logout');
  };

  const formatRupiah = (val) => {
    if (!val) return 'Rp 0';
    if (val >= 1000000) {
      return 'Rp ' + (val / 1000000).toFixed(2) + 'M';
    }
    return 'Rp ' + val.toLocaleString('id-ID');
  };

  // Filter List Logic
  const filteredPelanggan = currentData.pelangganList.filter(item => {
    const matchesSearch = item.nama.toLowerCase().includes(searchQuery.toLowerCase()) ||
                          item.phone.includes(searchQuery) ||
                          item.id.toLowerCase().includes(searchQuery.toLowerCase());
    if (filterTab === 'vip') return matchesSearch && item.tier.includes('VIP');
    if (filterTab === 'reguler') return matchesSearch && !item.tier.includes('VIP');
    if (filterTab === 'followup') return matchesSearch && item.jumlahDatang < 5;
    return matchesSearch;
  });

  return (
    <div className="min-h-screen bg-[#F4F5F7] font-sans text-slate-800 flex flex-col md:flex-row">
      <Head title="Database Pelanggan & Profil VIP - L-Style ATELIER SUITE" />

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
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-slate-900 text-white shadow-sm font-semibold transition-all"
              >
                <Users className="w-4 h-4 text-white" />
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

        {/* Main Body */}
        <main className="p-6 space-y-6">

          {/* Top Breadcrumb & Action Header */}
          <div className="flex flex-wrap items-center justify-between gap-4">
            <div>
              <p className="text-[10px] font-bold uppercase tracking-widest text-slate-400 flex items-center gap-1.5">
                <span className="w-2 h-2 rounded-full bg-amber-500"></span>
                <span>CLIENT RELATIONS ATELIER</span>
              </p>
              <h2 className="text-2xl font-black text-slate-900 tracking-tight">Database Pelanggan & Profil VIP</h2>
              <p className="text-xs text-slate-500 font-medium mt-0.5">
                Kelola data {currentData.stats.totalPelanggan.toLocaleString('id-ID')} tamu terdaftar, riwayat kunjungan, preferensi stylist, dan catatan personal perlakuan.
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

              {/* Export Data CSV */}
              <button
                onClick={() => showToast('Mengeksport Data Pelanggan CSV...')}
                className="px-4 py-2 bg-white hover:bg-slate-50 text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-xs flex items-center gap-2"
              >
                <Download className="w-3.5 h-3.5 text-slate-600" />
                <span>Export Data CSV</span>
              </button>

              {/* + Tambah Pelanggan Baru */}
              <button
                onClick={() => setShowAddModal(true)}
                className="px-4 py-2 bg-slate-950 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-md flex items-center gap-2"
              >
                <UserPlus className="w-4 h-4" />
                <span>+ Tambah Pelanggan Baru</span>
              </button>
            </div>
          </div>

          {/* Top 4 Stat Cards */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {/* Stat 1: TOTAL PELANGGAN */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">TOTAL PELANGGAN</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1 flex items-baseline gap-2">
                  <span>{currentData.stats.totalPelanggan.toLocaleString('id-ID')}</span>
                </h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-0.5">{currentData.stats.totalSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <Users className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 2: MEMBER AKTIF */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">MEMBER AKTIF</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.memberAktif.toLocaleString('id-ID')}</h3>
                <p className="text-[11px] text-slate-500 font-medium mt-0.5">{currentData.stats.memberSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <Award className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 3: TAMU LOYAL */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">TAMU LOYAL</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.tamuLoyal.toLocaleString('id-ID')}</h3>
                <p className="text-[11px] text-slate-500 font-medium mt-0.5">{currentData.stats.loyalSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <Tag className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 4: TINGKAT RETENSI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">TINGKAT RETENSI</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.retensiRate}</h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-0.5">{currentData.stats.retensiSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <RefreshCw className="w-5 h-5" />
              </div>
            </div>
          </div>

          {/* Filter Pills Bar & Local Search */}
          <div className="bg-white p-2 rounded-2xl border border-slate-200/80 shadow-xs flex flex-wrap items-center justify-between gap-4">
            <div className="flex items-center gap-2 text-xs font-semibold">
              <button
                onClick={() => setFilterTab('semua')}
                className={`px-4 py-2 rounded-xl transition-all ${
                  filterTab === 'semua' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'
                }`}
              >
                Semua ({currentData.stats.totalPelanggan})
              </button>

              <button
                onClick={() => setFilterTab('vip')}
                className={`px-4 py-2 rounded-xl transition-all ${
                  filterTab === 'vip' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'
                }`}
              >
                VIP Members ({currentData.stats.memberAktif})
              </button>

              <button
                onClick={() => setFilterTab('reguler')}
                className={`px-4 py-2 rounded-xl transition-all ${
                  filterTab === 'reguler' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'
                }`}
              >
                Reguler ({Math.max(0, currentData.stats.totalPelanggan - currentData.stats.memberAktif)})
              </button>

              <button
                onClick={() => setFilterTab('followup')}
                className={`px-4 py-2 rounded-xl transition-all ${
                  filterTab === 'followup' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900'
                }`}
              >
                Perlu Follow-up (85)
              </button>
            </div>

            <div className="relative w-full max-w-xs">
              <Search className="w-3.5 h-3.5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
              <input
                type="text"
                placeholder="Cari nama, 0812-xxxx, ID sovereign..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="w-full pl-8 pr-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/10 transition-all"
              />
            </div>
          </div>

          {/* MAIN 2-COLUMN LAYOUT */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {/* LEFT 2 COLS: Direktori Klien List */}
            <div className="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
              <div className="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-3">
                <h3 className="font-extrabold text-slate-900 text-base">Direktori Klien</h3>
                <div className="flex items-center gap-3 text-xs text-slate-500 font-medium">
                  <span>Urutkan: Kunjungan Terakhir</span>
                  <span>•</span>
                  <span>Menampilkan {filteredPelanggan.length} dari {currentData.stats.totalPelanggan}</span>
                </div>
              </div>

              {/* Client Cards List */}
              <div className="space-y-3">
                {filteredPelanggan.length > 0 ? (
                  filteredPelanggan.map((client) => (
                    <div
                      key={client.id}
                      onClick={() => setSelectedPelanggan(client)}
                      className={`p-4 rounded-2xl border transition-all cursor-pointer flex flex-wrap items-center justify-between gap-4 ${
                        selectedPelanggan?.id === client.id
                          ? 'bg-slate-50 border-slate-900 ring-2 ring-amber-500/80 shadow-sm'
                          : 'bg-white border-slate-200/80 hover:bg-slate-50/70'
                      }`}
                    >
                      <div className="flex items-center gap-3">
                        <div className="w-12 h-12 rounded-2xl bg-slate-900 text-white font-black flex items-center justify-center text-sm shadow-xs shrink-0">
                          {client.nama.split(' ').map(n => n[0]).join('').slice(0, 2)}
                        </div>
                        <div>
                          <div className="flex items-center gap-2">
                            <h4 className="font-black text-slate-900 text-sm leading-tight">{client.nama}</h4>
                            <span className={`text-[9px] font-bold px-2 py-0.5 rounded border ${client.tierBadgeClass}`}>
                              {client.tier}
                            </span>
                          </div>
                          <p className="text-xs text-slate-500 font-mono mt-0.5">
                            {client.phone} • ID: {client.id}
                          </p>
                          <div className="flex items-center gap-3 text-[11px] text-slate-600 mt-1 font-medium">
                            <span className="flex items-center gap-1">
                              <Scissors className="w-3 h-3 text-amber-600" />
                              <span>Stylist: {client.stylistFav}</span>
                            </span>
                            <span>•</span>
                            <span>{client.jumlahDatang}x Datang</span>
                            <span>•</span>
                            <span className="font-bold text-amber-700">{client.points.toLocaleString('id-ID')} Pts</span>
                          </div>
                        </div>
                      </div>

                      <div className="text-right text-xs shrink-0 flex items-center gap-3">
                        <div>
                          <span className="px-2 py-0.5 bg-slate-100 text-slate-700 text-[10px] font-bold rounded">
                            {client.terakhirKunjungan}
                          </span>
                          <p className="text-xs font-semibold text-slate-800 mt-1">{client.layananTerakhir}</p>
                        </div>
                        <ChevronRight className="w-4 h-4 text-slate-400" />
                      </div>
                    </div>
                  ))
                ) : (
                  <div className="py-16 text-center text-slate-400 space-y-3">
                    <Users className="w-10 h-10 mx-auto text-slate-300" />
                    <p className="text-sm font-semibold">Belum ada pelanggan terdaftar dalam sistem.</p>
                    <button
                      onClick={() => setShowAddModal(true)}
                      className="px-4 py-2 bg-amber-500 text-slate-950 text-xs font-bold rounded-xl shadow-xs transition-all"
                    >
                      + Tambah Pelanggan Pertama
                    </button>
                  </div>
                )}
              </div>

              {/* Pagination Bar */}
              <div className="flex items-center justify-between border-t border-slate-100 pt-4 text-xs font-medium text-slate-500">
                <span>Halaman 1 dari {Math.ceil((currentData.stats.totalPelanggan || 1) / 5)}</span>
                <div className="flex items-center gap-1">
                  <button className="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-slate-50">
                    <ChevronLeft className="w-4 h-4" />
                  </button>
                  <button className="w-7 h-7 rounded-lg bg-slate-950 text-white font-bold flex items-center justify-center">1</button>
                  <button className="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center text-slate-700 hover:bg-slate-50">2</button>
                  <button className="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center text-slate-700 hover:bg-slate-50">3</button>
                  <span>...</span>
                  <button className="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-slate-50">
                    <ChevronRight className="w-4 h-4" />
                  </button>
                </div>
              </div>
            </div>

            {/* RIGHT 1 COL: Selected Client Detail Panel */}
            <div className="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
              {selectedPelanggan ? (
                <div className="space-y-5">
                  {/* Customer Card Header */}
                  <div className="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div className="flex items-center gap-3">
                      <div className="w-14 h-14 rounded-2xl bg-slate-950 text-white font-black flex items-center justify-center text-base shadow-md">
                        {selectedPelanggan.nama.split(' ').map(n => n[0]).join('').slice(0, 2)}
                      </div>
                      <div>
                        <div className="flex items-center gap-2">
                          <h4 className="font-black text-slate-900 text-lg leading-tight">{selectedPelanggan.nama}</h4>
                          <span className={`text-[10px] font-bold px-2 py-0.5 rounded border ${selectedPelanggan.tierBadgeClass}`}>
                            {selectedPelanggan.tier}
                          </span>
                        </div>
                        <p className="text-xs text-slate-500 font-mono mt-0.5">{selectedPelanggan.phone}</p>
                        <p className="text-[10px] text-slate-400 mt-0.5">
                          Member sejak {selectedPelanggan.memberSince} • {selectedPelanggan.branch}
                        </p>
                      </div>
                    </div>
                    <button
                      onClick={() => showToast(`Edit data ${selectedPelanggan.nama}`)}
                      className="p-2 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-500 transition-all border border-slate-200"
                    >
                      <Edit3 className="w-4 h-4" />
                    </button>
                  </div>

                  {/* WhatsApp & Edit Buttons */}
                  <div className="grid grid-cols-2 gap-2">
                    <button
                      onClick={() => showToast(`Membuka WhatsApp ke ${selectedPelanggan.phone}`)}
                      className="py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold rounded-xl text-xs transition-all border border-emerald-200 flex items-center justify-center gap-1.5"
                    >
                      <Send className="w-3.5 h-3.5 text-emerald-600" />
                      <span>Kirim WhatsApp</span>
                    </button>

                    <button
                      onClick={() => showToast(`Membuka Modal Edit Data Klien`)}
                      className="py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold rounded-xl text-xs transition-all border border-slate-200 flex items-center justify-center gap-1.5"
                    >
                      <Edit3 className="w-3.5 h-3.5 text-slate-600" />
                      <span>Edit Data Klien</span>
                    </button>
                  </div>

                  {/* 3 Metric Summary Boxes */}
                  <div className="grid grid-cols-3 gap-2 text-center">
                    <div className="bg-slate-50 p-3 rounded-2xl border border-slate-200/60">
                      <p className="text-[9px] font-bold text-slate-400 uppercase tracking-wider">TOTAL BELANJA</p>
                      <h4 className="font-extrabold text-slate-900 text-sm mt-0.5">{formatRupiah(selectedPelanggan.totalBelanja)}</h4>
                      <p className="text-[10px] text-slate-500 font-medium">{selectedPelanggan.totalTransaksiCount} transaksi</p>
                    </div>

                    <div className="bg-slate-50 p-3 rounded-2xl border border-slate-200/60">
                      <p className="text-[9px] font-bold text-slate-400 uppercase tracking-wider">KUNJUNGAN</p>
                      <h4 className="font-extrabold text-slate-900 text-xs mt-0.5">{selectedPelanggan.siklusKunjungan}</h4>
                      <p className="text-[10px] text-slate-500 font-medium">{selectedPelanggan.siklusSub}</p>
                    </div>

                    <div className="bg-slate-50 p-3 rounded-2xl border border-slate-200/60">
                      <p className="text-[9px] font-bold text-slate-400 uppercase tracking-wider">KEPUASAN</p>
                      <h4 className="font-extrabold text-slate-900 text-sm mt-0.5 flex items-center justify-center gap-1">
                        <span>{selectedPelanggan.ratingKepuasan}</span>
                        <Star className="w-3 h-3 text-amber-500 fill-amber-500" />
                      </h4>
                      <p className="text-[10px] text-slate-500 font-medium">{selectedPelanggan.ulasanCount} Ulasan</p>
                    </div>
                  </div>

                  {/* Sovereign Tier Rewards Dark Box */}
                  <div className="bg-slate-950 text-white rounded-2xl p-4 space-y-3 relative overflow-hidden shadow-lg border border-slate-800">
                    <div className="flex items-center justify-between text-[10px]">
                      <span className="font-bold uppercase tracking-widest text-amber-500">SOVEREIGN TIER REWARDS</span>
                      <span className="font-mono text-slate-400">#SOV-8819</span>
                    </div>

                    <div className="flex items-center justify-between">
                      <h3 className="text-2xl font-black text-white tracking-tight">{selectedPelanggan.points.toLocaleString('id-ID')} <span className="text-xs font-normal text-slate-400">Pts</span></h3>
                      <button
                        onClick={() => showToast('Membuka Katalog Tukar Voucher Rewards')}
                        className="px-3 py-1.5 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-xl shadow-xs transition-all"
                      >
                        Tukar Voucher
                      </button>
                    </div>

                    <div className="space-y-1">
                      <div className="w-full bg-slate-800 rounded-full h-1.5">
                        <div className="bg-amber-500 h-1.5 rounded-full" style={{ width: '72%' }}></div>
                      </div>
                      <div className="flex justify-between text-[9px] text-slate-400">
                        <span>Kurang 550 pts menuju Platinum</span>
                        <span className="font-bold text-amber-400">72% tercapai</span>
                      </div>
                    </div>
                  </div>

                  {/* Preferensi Personal & Catatan Stylist */}
                  <div className="bg-amber-50/50 border border-amber-200/60 rounded-2xl p-3.5 space-y-2">
                    <div className="flex items-center justify-between text-[10px]">
                      <span className="font-bold text-amber-900 uppercase tracking-wider">PREFERENSI PERSONAL & CATATAN STYLIST</span>
                      <span className="text-slate-500">Oleh {selectedPelanggan.catatanStylistBy}</span>
                    </div>
                    <p className="text-xs text-slate-700 italic font-medium leading-relaxed">
                      "{selectedPelanggan.catatanPreferensi}"
                    </p>
                    <div className="flex flex-wrap gap-1.5 pt-1">
                      {selectedPelanggan.tags?.map((tag, idx) => (
                        <span key={idx} className="px-2 py-0.5 bg-amber-100 text-amber-900 text-[10px] font-bold rounded-md">
                          {tag}
                        </span>
                      ))}
                    </div>
                  </div>

                  {/* Riwayat Treatment & Kunjungan */}
                  <div className="space-y-2">
                    <div className="flex items-center justify-between text-xs border-b border-slate-100 pb-2">
                      <h5 className="font-extrabold text-slate-900">Riwayat Treatment & Kunjungan</h5>
                      <button className="text-[11px] font-bold text-amber-700 hover:underline">Lihat Semua ({selectedPelanggan.riwayat?.length || 0})</button>
                    </div>

                    <div className="space-y-2 text-xs">
                      {selectedPelanggan.riwayat?.length > 0 ? (
                        selectedPelanggan.riwayat.map((rw, idx) => (
                          <div key={idx} className="p-2.5 bg-slate-50 rounded-xl border border-slate-200/60 flex items-center justify-between">
                            <div className="flex items-center gap-2">
                              <Scissors className="w-4 h-4 text-amber-600" />
                              <div>
                                <h6 className="font-bold text-slate-900 text-xs">{rw.service}</h6>
                                <p className="text-[10px] text-slate-500">{rw.date} • {rw.stylist}</p>
                              </div>
                            </div>
                            <div className="text-right">
                              <p className="font-bold text-slate-900 text-xs">Rp {rw.price.toLocaleString('id-ID')}</p>
                              <span className="text-[9px] font-bold text-emerald-600">{rw.status}</span>
                            </div>
                          </div>
                        ))
                      ) : (
                        <p className="text-xs text-slate-400 italic py-2 text-center">Belum ada riwayat kunjungan.</p>
                      )}
                    </div>

                    <div className="grid grid-cols-2 gap-2 pt-2">
                      <button
                        onClick={() => showToast(`Buat janji baru untuk ${selectedPelanggan.nama}`)}
                        className="py-2.5 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-xl text-xs transition-all shadow-xs flex items-center justify-center gap-1.5"
                      >
                        <Calendar className="w-3.5 h-3.5 text-amber-400" />
                        <span>Buat Janji Baru</span>
                      </button>

                      <button
                        onClick={() => showToast(`Buka Riwayat Kasir POS`)}
                        className="py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold rounded-xl text-xs transition-all border border-slate-200 flex items-center justify-center gap-1.5"
                      >
                        <ShoppingBag className="w-3.5 h-3.5 text-slate-600" />
                        <span>Buka Riwayat Kasir</span>
                      </button>
                    </div>
                  </div>

                  {/* Next Visit Schedule Banner */}
                  <div className="p-3.5 bg-amber-50/70 border border-amber-200/70 rounded-2xl flex items-center justify-between text-xs">
                    <div className="flex items-center gap-2.5">
                      <Clock className="w-5 h-5 text-amber-600 shrink-0" />
                      <div>
                        <p className="font-bold text-slate-900">Jadwal Perawatan Berikutnya</p>
                        <p className="text-[10px] text-slate-600">Estimasi: {selectedPelanggan.nextEstDate} ({selectedPelanggan.nextEstDays})</p>
                      </div>
                    </div>
                    <button
                      onClick={() => showToast(`WhatsApp Reminder dikirim ke ${selectedPelanggan.phone}`)}
                      className="px-3 py-1.5 bg-white text-slate-800 font-bold text-[11px] rounded-xl border border-slate-200 hover:bg-slate-100 transition-all"
                    >
                      Kirim Reminder
                    </button>
                  </div>

                </div>
              ) : (
                <div className="py-24 text-center text-slate-400 space-y-3">
                  <Users className="w-10 h-10 mx-auto text-slate-300" />
                  <p className="text-sm font-semibold">Pilih Klien untuk Melihat Profil & Preferensi Personal</p>
                  <button
                    onClick={() => setShowAddModal(true)}
                    className="px-4 py-2 bg-amber-500 text-slate-950 text-xs font-bold rounded-xl shadow-xs transition-all"
                  >
                    + Tambah Pelanggan Pertama
                  </button>
                </div>
              )}
            </div>

          </div>

        </main>
      </div>

      {/* ==========================================
          MODAL TAMBAH PELANGGAN BARU
      ========================================== */}
      {showAddModal && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4 border border-slate-200">
            <div className="flex items-center justify-between border-b border-slate-100 pb-3">
              <h3 className="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                <UserPlus className="w-5 h-5 text-amber-500" />
                <span>+ Tambah Pelanggan Baru</span>
              </h3>
              <button onClick={() => setShowAddModal(false)} className="text-slate-400 hover:text-slate-600">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleAddClient} className="space-y-3 text-xs">
              <div>
                <label className="font-bold text-slate-700 block mb-1">Nama Lengkap Pelanggan</label>
                <input
                  type="text"
                  required
                  placeholder="Misal: Dimas Pratama"
                  value={newClientForm.nama}
                  onChange={(e) => setNewClientForm({ ...newClientForm, nama: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Nomor WhatsApp / Phone</label>
                <input
                  type="text"
                  placeholder="0812-9988-8219"
                  value={newClientForm.phone}
                  onChange={(e) => setNewClientForm({ ...newClientForm, phone: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Tier Membership</label>
                  <select
                    value={newClientForm.tier}
                    onChange={(e) => setNewClientForm({ ...newClientForm, tier: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  >
                    <option value="GOLD VIP">GOLD VIP</option>
                    <option value="BLACK VIP">BLACK VIP</option>
                    <option value="SILVER">SILVER</option>
                    <option value="REGULER">REGULER</option>
                  </select>
                </div>

                <div>
                  <label className="font-bold text-slate-700 block mb-1">Stylist Favorit</label>
                  <select
                    value={newClientForm.stylistFav}
                    onChange={(e) => setNewClientForm({ ...newClientForm, stylistFav: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  >
                    <option value="Reza Pratama">Barber Reza Pratama</option>
                    <option value="David Gunawan">Barber David Gunawan</option>
                    <option value="Elena Rose">Stylist Elena Rose</option>
                  </select>
                </div>
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Catatan Preferensi / Sensitivitas</label>
                <textarea
                  rows="3"
                  placeholder="Preferensi potongan, sensitivitas kulit kepala, produk favorit..."
                  value={newClientForm.catatanPreferensi}
                  onChange={(e) => setNewClientForm({ ...newClientForm, catatanPreferensi: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                ></textarea>
              </div>

              <div className="pt-2 flex justify-end gap-2">
                <button
                  type="button"
                  onClick={() => setShowAddModal(false)}
                  className="px-4 py-2 bg-slate-100 text-slate-700 font-bold rounded-xl"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="px-5 py-2 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-xl shadow-md"
                >
                  Simpan Pelanggan Baru
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

    </div>
  );
}
