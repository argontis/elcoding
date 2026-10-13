import React, { useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import {
  LayoutGrid, Calendar, Users, Award, Scissors, ShoppingBag,
  Percent, Bell, MessageSquare, Settings, Search, Plus, CheckCircle,
  Clock, ArrowUpRight, ChevronRight, X, User, CreditCard, ChevronDown,
  Sparkles, Check, DollarSign, RefreshCw, BarChart2, Filter,
  Phone, AlertCircle, Eye, Printer, Trash2, CalendarX, CheckCircle2,
  ChevronLeft, Send, AlertTriangle, Gift, Crown, ShieldCheck, Tag, Star,
  SlidersHorizontal, Coins, Layers, ToggleLeft, ToggleRight, MoreVertical,
  Edit, Download, History, Sparkle
} from 'lucide-react';

export default function AtelierTreatment({ auth }) {
  const user = auth?.user || { name: 'Mario Alfarizi', email: 'admin@lstyle.id', role: 'Owner / Manager' };

  // Data Mode State: 'kosong' (default) vs 'demo'
  const [dataMode, setDataMode] = useState('kosong');
  const [activeCategory, setActiveCategory] = useState('semua'); // 'semua' | 'haircut' | 'coloring' | 'spa'
  const [searchQuery, setSearchQuery] = useState('');
  const [viewMode, setViewMode] = useState('grid'); // 'grid' | 'list'
  const [toastMessage, setToastMessage] = useState(null);

  // Modals state
  const [showAddTreatmentModal, setShowAddTreatmentModal] = useState(false);
  const [showCategoryModal, setShowCategoryModal] = useState(false);
  const [selectedTreatmentToEdit, setSelectedTreatmentToEdit] = useState(null);

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
      totalLayanan: 24,
      totalSub: '● 100% tersinkron POS & Web',
      terpopuler: 'The Sovereign Cut',
      terpopulerSub: '482 order / bulan ini • 📈 +18.4% dari bulan lalu',
      rataDurasi: '52',
      rataDurasiSub: '✓ Optimasi 94% kapasitas chair',
      rerataTiket: '320.000',
      rerataTiketSub: '🏠 Atelier Tier A Standard'
    },
    treatments: [
      {
        id: 1,
        title: 'The Sovereign Haircut',
        badge: '⭐ Signature Best Seller',
        badgeClass: 'bg-amber-100 text-amber-900 border border-amber-300 font-bold',
        category: 'haircut',
        active: true,
        price: 180000,
        priceFormatted: 'Rp 180.000',
        duration: '45 Menit',
        description: 'Konsultasi bentuk wajah, precision haircut, wash organik & scalp massage, hot towel...',
        image: '/images/atelier/barbershop_haircut_sovereign_1791385322314.jpg',
        imageFallback: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=800&q=80',
        imageTag: "✂️ Men's Precision Tailoring",
        stylists: 'David, Reza, Kevin',
        komisiPercent: 35,
        komisiNominal: 'Rp 63.000'
      },
      {
        id: 2,
        title: 'Scalp Purifying Ritual & Hair Spa',
        badge: '🌿 Detox Therapy',
        badgeClass: 'bg-emerald-100 text-emerald-900 border border-emerald-300 font-bold',
        category: 'spa',
        active: true,
        price: 250000,
        priceFormatted: 'Rp 250.000',
        duration: '60 Menit',
        description: 'Eksfoliasi kulit kepala mikroskopik, steam aromatherapy essential oil, deep...',
        image: '/images/atelier/barbershop_scalp_spa_1791385356193.jpg',
        imageFallback: 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80',
        imageTag: '🌿 Botanical Steam Infusion',
        stylists: 'Elena, Reza',
        komisiPercent: 40,
        komisiNominal: 'Rp 100.000'
      },
      {
        id: 3,
        title: 'Creative Hair Coloring & Balayage',
        badge: '🎨 Artisan Color',
        badgeClass: 'bg-orange-100 text-orange-900 border border-orange-300 font-bold',
        category: 'coloring',
        active: true,
        price: 650000,
        priceFormatted: 'Rp 650.000+',
        duration: '120 Menit',
        description: 'Gradasi dimensi multidimensi bebas amonia, perlindungan Olaplex...',
        image: '/images/atelier/barbershop_hair_coloring_1791385558445.jpg',
        imageFallback: 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80',
        imageTag: '🎨 Ammonia-Free Pigment',
        stylists: 'Elena Rose (Master Colorist)',
        komisiPercent: 45,
        komisiNominal: 'Rp 292.500'
      },
      {
        id: 4,
        title: 'Beard Grooming & Royal Hot Towel',
        badge: '💈 Classic Barber',
        badgeClass: 'bg-slate-100 text-slate-800 border border-slate-300 font-bold',
        category: 'haircut',
        active: true,
        price: 85000,
        priceFormatted: 'Rp 85.000',
        duration: '25 Menit',
        description: 'Shaving razor presisi, essential beard oil, compress handuk hangat herbal mint.',
        image: 'https://images.unsplash.com/photo-1621605815971-fbc98d665033?auto=format&fit=crop&w=800&q=80',
        imageFallback: 'https://images.unsplash.com/photo-1621605815971-fbc98d665033?auto=format&fit=crop&w=800&q=80',
        imageTag: '♨️ Hot Mint Compress',
        stylists: 'David, Reza, Dimas',
        komisiPercent: 35,
        komisiNominal: 'Rp 29.750'
      },
      {
        id: 5,
        title: 'Korean Natural Texture Wave Perm',
        badge: '✂️ Modern Styling',
        badgeClass: 'bg-amber-50 text-amber-800 border border-amber-200 font-bold',
        category: 'coloring',
        active: true,
        price: 450000,
        priceFormatted: 'Rp 450.000',
        duration: '90 Menit',
        description: 'Perm rambut gaya Korea modern dengan volume natural dan nutrisi keratin.',
        image: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80',
        imageFallback: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80',
        imageTag: '🌀 Keratin Elasticity Shield',
        stylists: 'Kevin Sanjaya',
        komisiPercent: 40,
        komisiNominal: 'Rp 180.000'
      },
      {
        id: 6,
        title: 'Gentleman Royal Executive Package',
        badge: '💡 Luxury Bundle',
        badgeClass: 'bg-amber-200 text-amber-950 border border-amber-400 font-extrabold',
        category: 'spa',
        active: true,
        price: 380000,
        priceFormatted: 'Rp 380.000',
        duration: '80 Menit',
        description: 'Haircut signature + Hot towel shave + Scalp therapy + Espresso bar complimentary.',
        image: 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?auto=format&fit=crop&w=800&q=80',
        imageFallback: 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?auto=format&fit=crop&w=800&q=80',
        imageTag: '☕ Barista & Grooming Ritual',
        stylists: 'Master Barber Reza',
        komisiPercent: 40,
        komisiNominal: 'Rp 152.000'
      }
    ]
  };

  const emptyData = {
    stats: {
      totalLayanan: 0,
      totalSub: 'Belum ada menu treatment tersimpan',
      terpopuler: '-',
      terpopulerSub: 'Belum ada data transaksi',
      rataDurasi: '0',
      rataDurasiSub: 'Estimasi rata-rata sesi',
      rerataTiket: '0',
      rerataTiketSub: 'Target ATV Rp 300.000+'
    },
    treatments: []
  };

  const [currentData, setCurrentData] = useState(emptyData);

  useEffect(() => {
    if (dataMode === 'demo') {
      setCurrentData(demoData);
    } else {
      setCurrentData(emptyData);
    }
  }, [dataMode]);

  // Form State for Add Treatment
  const [newTreatmentForm, setNewTreatmentForm] = useState({
    title: '',
    category: 'haircut',
    price: '',
    duration: '45',
    komisiPercent: '35',
    badge: '✂️ Signature Service',
    imageTag: '✂️ Tailored Hair Treatment',
    description: '',
    stylists: 'David, Reza, Kevin'
  });

  const handleAddTreatment = (e) => {
    e.preventDefault();
    if (!newTreatmentForm.title || !newTreatmentForm.price) return;

    const priceNum = Number(newTreatmentForm.price);
    const komisiNum = (priceNum * Number(newTreatmentForm.komisiPercent)) / 100;

    const newTreatment = {
      id: currentData.treatments.length + 1,
      title: newTreatmentForm.title,
      badge: newTreatmentForm.badge,
      badgeClass: 'bg-amber-100 text-amber-900 border border-amber-300 font-bold',
      category: newTreatmentForm.category,
      active: true,
      price: priceNum,
      priceFormatted: `Rp ${priceNum.toLocaleString('id-ID')}`,
      duration: `${newTreatmentForm.duration} Menit`,
      description: newTreatmentForm.description || 'Layanan treatment presisi dengan produk pilihan atelier.',
      image: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=800&q=80',
      imageFallback: 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=800&q=80',
      imageTag: newTreatmentForm.imageTag,
      stylists: newTreatmentForm.stylists,
      komisiPercent: Number(newTreatmentForm.komisiPercent),
      komisiNominal: `Rp ${komisiNum.toLocaleString('id-ID')}`
    };

    setCurrentData(prev => ({
      ...prev,
      stats: {
        ...prev.stats,
        totalLayanan: prev.treatments.length + 1
      },
      treatments: [...prev.treatments, newTreatment]
    }));

    setShowAddTreatmentModal(false);
    setNewTreatmentForm({
      title: '',
      category: 'haircut',
      price: '',
      duration: '45',
      komisiPercent: '35',
      badge: '✂️ Signature Service',
      imageTag: '✂️ Tailored Hair Treatment',
      description: '',
      stylists: 'David, Reza, Kevin'
    });
    showToast(`Treatment "${newTreatment.title}" berhasil ditambahkan & tersinkron ke POS!`);
  };

  const toggleTreatmentActive = (id) => {
    setCurrentData(prev => ({
      ...prev,
      treatments: prev.treatments.map(t => t.id === id ? { ...t, active: !t.active } : t)
    }));
    showToast('Status keaktifan treatment diperbarui');
  };

  const handleLogout = () => {
    router.post('/logout');
  };

  // Filtered treatment list
  const filteredTreatments = currentData.treatments.filter(t => {
    const matchesSearch = t.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
                          t.description.toLowerCase().includes(searchQuery.toLowerCase()) ||
                          t.duration.includes(searchQuery);

    if (activeCategory === 'haircut') return matchesSearch && t.category === 'haircut';
    if (activeCategory === 'coloring') return matchesSearch && t.category === 'coloring';
    if (activeCategory === 'spa') return matchesSearch && t.category === 'spa';
    return matchesSearch;
  });

  return (
    <div className="min-h-screen bg-[#F4F5F7] font-sans text-slate-800 flex flex-col md:flex-row">
      <Head title="Katalog Treatment & Manajemen Layanan - L-Style ATELIER SUITE" />

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
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-slate-900 text-white shadow-sm font-semibold transition-all"
              >
                <Scissors className="w-4 h-4 text-white" />
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
                <span className="w-2 h-2 rounded-full bg-amber-500"></span>
                <span>KATALOG ATELIER RESMI</span>
                <span>•</span>
                <span>Musim Q2 2025</span>
              </p>
              <h2 className="text-2xl font-black text-slate-900 tracking-tight">Katalog Treatment & Manajemen Layanan</h2>
              <p className="text-xs text-slate-500 font-medium mt-0.5 max-w-2xl">
                Kelola daftar menu haircut, pewarnaan, perawatan kulit kepala, harga, estimasi durasi, dan komisi stylist dengan presisi studio artisan.
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

              {/* Kategori Layanan */}
              <button
                onClick={() => showToast('Membuka Pengaturan Kategori Layanan')}
                className="px-4 py-2 bg-white hover:bg-slate-50 text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-xs flex items-center gap-2"
              >
                <SlidersHorizontal className="w-4 h-4 text-slate-600" />
                <span>Kategori Layanan</span>
              </button>

              {/* + Tambah Treatment Baru */}
              <button
                onClick={() => setShowAddTreatmentModal(true)}
                className="px-4 py-2 bg-slate-950 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-md flex items-center gap-2"
              >
                <Plus className="w-4 h-4" />
                <span>+ Tambah Treatment Baru</span>
              </button>
            </div>
          </div>

          {/* Top 4 Summary Metric Cards */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {/* Stat 1: TOTAL LAYANAN */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between relative overflow-hidden">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">TOTAL LAYANAN</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.totalLayanan} <span className="text-xs font-medium text-slate-400">Treatment</span></h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-0.5">{currentData.stats.totalSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <Scissors className="w-5 h-5" />
              </div>
              <div className="absolute -right-4 -bottom-4 w-20 h-20 bg-amber-500/5 rounded-full pointer-events-none"></div>
            </div>

            {/* Stat 2: LAYANAN TERPOPULER */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between relative overflow-hidden">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">LAYANAN TERPOPULER</p>
                <h3 className="text-base font-black text-slate-900 mt-1 truncate max-w-[170px]">{currentData.stats.terpopuler}</h3>
                <p className="text-[11px] text-slate-500 font-medium mt-0.5">{currentData.stats.terpopulerSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 border border-amber-200">
                <Star className="w-5 h-5 fill-amber-500 text-amber-600" />
              </div>
              <div className="absolute -right-4 -bottom-4 w-20 h-20 bg-amber-500/10 rounded-full pointer-events-none"></div>
            </div>

            {/* Stat 3: RATA-RATA DURASI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between relative overflow-hidden">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">RATA-RATA DURASI</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.rataDurasi} <span className="text-xs font-medium text-slate-400">Menit / Sesi</span></h3>
                <p className="text-[11px] text-slate-500 font-medium mt-0.5">{currentData.stats.rataDurasiSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <Clock className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 4: RERATA TIKET / ATV */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between relative overflow-hidden">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">RERATA TIKET / ATV</p>
                <h3 className="text-2xl font-black text-slate-900 mt-1">Rp {currentData.stats.rerataTiket}</h3>
                <p className="text-[11px] text-slate-500 font-medium mt-0.5">{currentData.stats.rerataTiketSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <CreditCard className="w-5 h-5" />
              </div>
            </div>
          </div>

          {/* FILTER & SEARCH BAR SECTION */}
          <div className="flex flex-wrap items-center justify-between gap-4 bg-white p-3 rounded-2xl border border-slate-200/80 shadow-xs">
            {/* Filter Categories Pill */}
            <div className="flex items-center gap-2 flex-wrap text-xs font-semibold">
              <button
                onClick={() => setActiveCategory('semua')}
                className={`px-4 py-2 rounded-xl transition-all ${
                  activeCategory === 'semua' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                }`}
              >
                Semua ({currentData.treatments.length})
              </button>
              <button
                onClick={() => setActiveCategory('haircut')}
                className={`px-4 py-2 rounded-xl transition-all ${
                  activeCategory === 'haircut' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                }`}
              >
                Haircut & Styling (8)
              </button>
              <button
                onClick={() => setActiveCategory('coloring')}
                className={`px-4 py-2 rounded-xl transition-all ${
                  activeCategory === 'coloring' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                }`}
              >
                Coloring & Perm (5)
              </button>
              <button
                onClick={() => setActiveCategory('spa')}
                className={`px-4 py-2 rounded-xl transition-all ${
                  activeCategory === 'spa' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                }`}
              >
                Spa & Scalp Detox (6)
              </button>
            </div>

            {/* Right Search Input & View Toggle */}
            <div className="flex items-center gap-2">
              <div className="relative w-60">
                <Search className="w-3.5 h-3.5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                <input
                  type="text"
                  placeholder="Filter nama atau durasi..."
                  value={searchQuery}
                  onChange={(e) => setSearchQuery(e.target.value)}
                  className="w-full pl-8 pr-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slate-900/10"
                />
              </div>

              <div className="flex items-center bg-slate-100 p-1 rounded-xl border border-slate-200 text-slate-500">
                <button
                  onClick={() => setViewMode('grid')}
                  className={`p-1.5 rounded-lg transition-all ${viewMode === 'grid' ? 'bg-white text-slate-900 shadow-xs' : 'hover:text-slate-900'}`}
                >
                  <LayoutGrid className="w-4 h-4" />
                </button>
                <button
                  onClick={() => setViewMode('list')}
                  className={`p-1.5 rounded-lg transition-all ${viewMode === 'list' ? 'bg-white text-slate-900 shadow-xs' : 'hover:text-slate-900'}`}
                >
                  <SlidersHorizontal className="w-4 h-4" />
                </button>
              </div>
            </div>
          </div>

          {/* TREATMENT CARDS GRID */}
          {filteredTreatments.length > 0 ? (
            <div className={viewMode === 'grid' ? "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" : "space-y-4"}>
              {filteredTreatments.map((t) => (
                <div
                  key={t.id}
                  className="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group"
                >
                  {/* Card Header & Badges */}
                  <div className="p-5 space-y-3">
                    <div className="flex items-center justify-between gap-2">
                      <span className={`px-2.5 py-1 rounded-lg text-[10px] uppercase tracking-wider ${t.badgeClass}`}>
                        {t.badge}
                      </span>

                      {/* Active Toggle Switch */}
                      <div className="flex items-center gap-1.5 bg-slate-50 px-2 py-0.5 rounded-full border border-slate-200">
                        <span className="text-[9px] font-extrabold text-slate-500">AKTIF</span>
                        <button
                          onClick={() => toggleTreatmentActive(t.id)}
                          className={`w-8 h-4 rounded-full transition-all relative ${t.active ? 'bg-amber-800' : 'bg-slate-300'}`}
                        >
                          <span className={`w-3 h-3 rounded-full bg-white absolute top-0.5 transition-all ${t.active ? 'right-0.5' : 'left-0.5'}`}></span>
                        </button>
                      </div>
                    </div>

                    {/* Title, Price & Duration */}
                    <div>
                      <h3 className="text-lg font-black text-slate-900 tracking-tight group-hover:text-amber-800 transition-all">
                        {t.title}
                      </h3>
                      <div className="flex items-center gap-2 mt-1">
                        <span className="text-base font-black text-slate-900">{t.priceFormatted}</span>
                        <span className="text-slate-300">•</span>
                        <span className="text-xs font-semibold text-slate-500">{t.duration}</span>
                      </div>
                    </div>

                    {/* Description */}
                    <p className="text-xs text-slate-500 font-medium leading-relaxed line-clamp-2">
                      {t.description}
                    </p>
                  </div>

                  {/* Card Image Banner with Tag Overlay */}
                  <div className="relative h-44 bg-slate-900 overflow-hidden mx-5 rounded-2xl">
                    <img
                      src={t.image}
                      onError={(e) => { e.target.src = t.imageFallback; }}
                      alt={t.title}
                      className="w-full h-full object-cover group-hover:scale-105 transition-all duration-500 opacity-90"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    <div className="absolute bottom-3 left-3 bg-slate-950/80 backdrop-blur-xs px-2.5 py-1 rounded-lg border border-slate-700/60 text-white text-[10px] font-bold flex items-center gap-1.5 shadow-md">
                      <span>{t.imageTag}</span>
                    </div>
                  </div>

                  {/* Card Footer Info (Stylist Kompeten & Komisi) */}
                  <div className="p-5 space-y-4 pt-4">
                    <div className="bg-slate-50 border border-slate-100 p-3 rounded-2xl space-y-1.5 text-xs">
                      <div className="flex items-center justify-between text-[11px]">
                        <span className="text-[9px] font-bold uppercase tracking-wider text-slate-400">STYLIST KOMPETEN</span>
                        <span className="font-bold text-slate-800">{t.stylists}</span>
                      </div>
                      <div className="flex items-center justify-between text-[11px] border-t border-slate-200/60 pt-1.5">
                        <span className="text-[9px] font-bold uppercase tracking-wider text-slate-400">ALOKASI KOMISI</span>
                        <span className="font-extrabold text-amber-800 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                          🏷️ {t.komisiPercent}% ({t.komisiNominal})
                        </span>
                      </div>
                    </div>

                    {/* Action Row */}
                    <div className="flex items-center gap-2">
                      <button
                        onClick={() => { setSelectedTreatmentToEdit(t); showToast(`Membuka form edit ${t.title}`); }}
                        className="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold rounded-xl text-xs border border-slate-200 transition-all flex items-center justify-center gap-2"
                      >
                        <Edit className="w-3.5 h-3.5 text-slate-600" />
                        <span>Edit Layanan</span>
                      </button>

                      <button
                        onClick={() => showToast(`Menu Opsi ${t.title}`)}
                        className="p-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl border border-slate-200 transition-all"
                      >
                        <MoreVertical className="w-4 h-4" />
                      </button>
                    </div>
                  </div>

                </div>
              ))}
            </div>
          ) : (
            <div className="bg-white rounded-3xl p-16 border border-slate-200/80 text-center space-y-4 shadow-xs">
              <div className="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto border border-slate-200">
                <Scissors className="w-8 h-8" />
              </div>
              <div className="space-y-1 max-w-md mx-auto">
                <h3 className="font-extrabold text-slate-900 text-lg">Belum Ada Treatment Tersimpan</h3>
                <p className="text-xs text-slate-500 font-medium">
                  Katalog menu layanan atelier Anda masih kosong. Silakan tambah menu haircut, spa, atau pewarnaan pertama Anda.
                </p>
              </div>
              <div className="pt-2 flex justify-center gap-3">
                <button
                  onClick={() => setShowAddTreatmentModal(true)}
                  className="px-5 py-2.5 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-xl text-xs shadow-md flex items-center gap-2"
                >
                  <Plus className="w-4 h-4" />
                  <span>+ Tambah Treatment Pertama</span>
                </button>
                <button
                  onClick={() => { setDataMode('demo'); showToast('Mode Demo Diaktifkan!'); }}
                  className="px-5 py-2.5 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded-xl text-xs shadow-xs"
                >
                  Tampilkan Contoh Demo
                </button>
              </div>
            </div>
          )}

          {/* BOTTOM BANNER (Sinkronisasi Komisi & Point of Sale) */}
          <div className="bg-amber-50/70 border border-amber-200/80 rounded-3xl p-5 flex flex-wrap items-center justify-between gap-4 shadow-xs">
            <div className="flex items-center gap-4">
              <div className="w-12 h-12 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 border border-amber-300">
                <ShieldCheck className="w-6 h-6" />
              </div>
              <div>
                <h4 className="font-extrabold text-slate-900 text-sm">Sinkronisasi Komisi & Point of Sale Otomatis</h4>
                <p className="text-xs text-slate-600 font-medium mt-0.5">
                  Setiap perubahan harga treatment akan langsung ter-update di tablet kasir Senopati Branch dan buku komisi real-time stylist.
                </p>
              </div>
            </div>

            <div className="flex items-center gap-2">
              <button
                onClick={() => showToast('Mengekspor katalog format CSV')}
                className="px-4 py-2 bg-white hover:bg-slate-50 text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-xs"
              >
                Ekspor Format CSV
              </button>
              <button
                onClick={() => showToast('Membuka riwayat log perubahan harga & komisi')}
                className="px-4 py-2 bg-white hover:bg-slate-50 text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-xs"
              >
                Riwayat Perubahan
              </button>
            </div>
          </div>

        </main>
      </div>

      {/* ==========================================
          MODAL TAMBAH TREATMENT BARU
      ========================================== */}
      {showAddTreatmentModal && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl space-y-4 border border-slate-200">
            <div className="flex items-center justify-between border-b border-slate-100 pb-3">
              <h3 className="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                <Scissors className="w-5 h-5 text-amber-600" />
                <span>+ Tambah Treatment Baru</span>
              </h3>
              <button onClick={() => setShowAddTreatmentModal(false)} className="text-slate-400 hover:text-slate-600">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleAddTreatment} className="space-y-3 text-xs">
              <div>
                <label className="font-bold text-slate-700 block mb-1">Nama Treatment / Layanan</label>
                <input
                  type="text"
                  required
                  placeholder="Misal: Gentleman Royal Haircut"
                  value={newTreatmentForm.title}
                  onChange={(e) => setNewTreatmentForm({ ...newTreatmentForm, title: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Kategori Layanan</label>
                  <select
                    value={newTreatmentForm.category}
                    onChange={(e) => setNewTreatmentForm({ ...newTreatmentForm, category: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  >
                    <option value="haircut">Haircut & Styling</option>
                    <option value="coloring">Coloring & Perm</option>
                    <option value="spa">Spa & Scalp Detox</option>
                  </select>
                </div>

                <div>
                  <label className="font-bold text-slate-700 block mb-1">Badge Spesial</label>
                  <input
                    type="text"
                    placeholder="⭐ Signature Best Seller"
                    value={newTreatmentForm.badge}
                    onChange={(e) => setNewTreatmentForm({ ...newTreatmentForm, badge: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>
              </div>

              <div className="grid grid-cols-3 gap-3">
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Harga (Rp)</label>
                  <input
                    type="number"
                    required
                    placeholder="180000"
                    value={newTreatmentForm.price}
                    onChange={(e) => setNewTreatmentForm({ ...newTreatmentForm, price: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl font-bold focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>

                <div>
                  <label className="font-bold text-slate-700 block mb-1">Durasi (Menit)</label>
                  <input
                    type="number"
                    required
                    placeholder="45"
                    value={newTreatmentForm.duration}
                    onChange={(e) => setNewTreatmentForm({ ...newTreatmentForm, duration: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>

                <div>
                  <label className="font-bold text-slate-700 block mb-1">Komisi Stylist (%)</label>
                  <input
                    type="number"
                    required
                    placeholder="35"
                    value={newTreatmentForm.komisiPercent}
                    onChange={(e) => setNewTreatmentForm({ ...newTreatmentForm, komisiPercent: e.target.value })}
                    className="w-full px-3 py-2 border border-slate-200 rounded-xl font-bold focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                </div>
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Deskripsi Layanan</label>
                <textarea
                  rows="2"
                  placeholder="Deskripsi singkat ritual perawatan yang didapat patron..."
                  value={newTreatmentForm.description}
                  onChange={(e) => setNewTreatmentForm({ ...newTreatmentForm, description: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                ></textarea>
              </div>

              <div className="pt-2 flex justify-end gap-2">
                <button
                  type="button"
                  onClick={() => setShowAddTreatmentModal(false)}
                  className="px-4 py-2 bg-slate-100 text-slate-700 font-bold rounded-xl"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="px-5 py-2 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-xl shadow-md"
                >
                  Simpan Treatment
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

    </div>
  );
}
