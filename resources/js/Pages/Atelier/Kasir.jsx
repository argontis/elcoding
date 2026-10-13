import React, { useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import {
  LayoutGrid, Calendar, Users, Award, Scissors, ShoppingBag,
  Percent, Bell, MessageSquare, Settings, Search, Plus, CheckCircle,
  Clock, ArrowUpRight, ChevronRight, X, User, CreditCard, ChevronDown,
  Sparkles, Check, DollarSign, RefreshCw, BarChart2, Filter,
  Phone, AlertCircle, Eye, Printer, Trash2, CalendarX, CheckCircle2,
  ChevronLeft, Send, AlertTriangle, Gift, Crown, ShieldCheck, Tag, Star,
  SlidersHorizontal, Coins, QrCode, QrCode as QrIcon, Receipt, Minus,
  Smartphone, Wallet, Armchair, Sparkle, Banknote
} from 'lucide-react';

export default function AtelierKasir({ auth }) {
  const user = auth?.user || { name: 'Mario Alfarizi', email: 'admin@lstyle.id', role: 'Owner / Manager' };

  // Data Mode State: 'kosong' (default) vs 'demo'
  const [dataMode, setDataMode] = useState('kosong');
  const [activeCategory, setActiveCategory] = useState('semua');
  const [searchQuery, setSearchQuery] = useState('');
  const [toastMessage, setToastMessage] = useState(null);

  // Selected Payment Method & Customer State
  const [paymentMethod, setPaymentMethod] = useState('qris'); // 'qris' | 'cash' | 'card' | 'va'
  const [selectedChair, setSelectedChair] = useState('Chair 04');
  const [applyMemberDiscount, setApplyMemberDiscount] = useState(true);
  const [applyPointRedemption, setApplyPointRedemption] = useState(true);

  // Custom Item Form State
  const [customItem, setCustomItem] = useState({ name: '', price: '' });

  // Notifications & User Menu
  const [showNotificationDrawer, setShowNotificationDrawer] = useState(false);
  const [showUserMenu, setShowUserMenu] = useState(false);
  const [showCustomerModal, setShowCustomerModal] = useState(false);
  const [showChairModal, setShowChairModal] = useState(false);

  const showToast = (msg) => {
    setToastMessage(msg);
    setTimeout(() => setToastMessage(null), 4000);
  };

  // Demo Catalog Items
  const catalogItems = [
    {
      id: 1,
      type: 'service',
      badge: 'LAYANAN UTAMA',
      badgeClass: 'bg-amber-100 text-amber-900 border border-amber-300 font-bold',
      duration: '45m',
      category: 'haircut',
      title: 'L-Style Signature Cut & Wash',
      subtext: 'Konsultasi bentuk wajah, precision scissor/clipper...',
      price: 180000,
      priceLabel: 'TARIF',
      priceFormatted: 'Rp 180.000',
      stylist: 'David Gunawan'
    },
    {
      id: 2,
      type: 'service',
      badge: 'GROOMING',
      badgeClass: 'bg-amber-50 text-amber-800 border border-amber-200 font-bold',
      duration: '25m',
      category: 'haircut',
      title: 'Beard Grooming & Hot Towel',
      subtext: 'Trimming detail, essential oil hot towel compress, razor...',
      price: 85000,
      priceLabel: 'TARIF',
      priceFormatted: 'Rp 85.000',
      stylist: 'David Gunawan'
    },
    {
      id: 3,
      type: 'service',
      badge: 'SCALP SPA',
      badgeClass: 'bg-emerald-100 text-emerald-900 border border-emerald-300 font-bold',
      duration: '60m',
      category: 'spa',
      title: 'Scalp Purifying Spa',
      subtext: 'Detoksifikasi minyak & ketombe, micro-mist...',
      price: 250000,
      priceLabel: 'TARIF',
      priceFormatted: 'Rp 250.000',
      stylist: 'Elena Rose'
    },
    {
      id: 4,
      type: 'service',
      badge: 'TECHNICAL HAIR',
      badgeClass: 'bg-orange-100 text-orange-900 border border-orange-300 font-bold',
      duration: '120m',
      category: 'coloring',
      title: 'Creative Hair Coloring',
      subtext: 'Full toning / ash color / balayage highlights dengan',
      price: 650000,
      priceLabel: 'TARIF MULAI',
      priceFormatted: 'Rp 650.000',
      stylist: 'Elena Rose'
    },
    {
      id: 5,
      type: 'product',
      badge: 'RETAIL PRODUK',
      badgeClass: 'bg-slate-100 text-slate-800 border border-slate-300 font-bold',
      duration: 'Stok: 18 pcs',
      category: 'product',
      title: 'Matte Clay Pomade 100g',
      subtext: 'Extreme hold, zero shine matte natural look, formula...',
      price: 140000,
      priceLabel: 'HARGA RETAIL',
      priceFormatted: 'Rp 140.000',
      stylist: '-'
    },
    {
      id: 6,
      type: 'product',
      badge: 'RETAIL PRODUK',
      badgeClass: 'bg-slate-100 text-slate-800 border border-slate-300 font-bold',
      duration: 'Stok: 9 pcs',
      category: 'product',
      title: 'Hair Tonic Fortifying 150ml',
      subtext: 'Kandungan Panax Ginseng & Biotin, menguatkan akar...',
      price: 185000,
      priceLabel: 'HARGA RETAIL',
      priceFormatted: 'Rp 185.000',
      stylist: '-'
    }
  ];

  // Demo Cart State
  const demoCart = [
    { id: 1, title: 'L-Style Signature Cut & Wash', price: 180000, qty: 1, stylist: 'David Gunawan' },
    { id: 2, title: 'Beard Grooming & Hot Towel', price: 85000, qty: 1, stylist: 'David Gunawan' },
    { id: 5, title: 'Matte Clay Pomade 100g', price: 140000, qty: 1, stylist: '-' }
  ];

  const demoCustomer = {
    initials: 'BS',
    name: 'Bimo Santoso',
    phone: '0812-9876-5432',
    tier: 'Black Tier (VIP)',
    points: 1450
  };

  const [cartItems, setCartItems] = useState([]);
  const [selectedCustomer, setSelectedCustomer] = useState(null);

  useEffect(() => {
    if (dataMode === 'demo') {
      setCartItems(demoCart);
      setSelectedCustomer(demoCustomer);
    } else {
      setCartItems([]);
      setSelectedCustomer(null);
    }
  }, [dataMode]);

  // Cart Management Functions
  const addToCart = (item) => {
    setCartItems(prev => {
      const existing = prev.find(i => i.id === item.id);
      if (existing) {
        return prev.map(i => i.id === item.id ? { ...i, qty: i.qty + 1 } : i);
      }
      return [...prev, { id: item.id, title: item.title, price: item.price, qty: 1, stylist: item.stylist }];
    });
    showToast(`"${item.title}" ditambahkan ke pesanan`);
  };

  const updateQty = (id, delta) => {
    setCartItems(prev =>
      prev.map(item => {
        if (item.id === id) {
          const newQty = item.qty + delta;
          return newQty > 0 ? { ...item, qty: newQty } : null;
        }
        return item;
      }).filter(Boolean)
    );
  };

  const removeFromCart = (id) => {
    setCartItems(prev => prev.filter(item => item.id !== id));
    showToast('Item dihapus dari pesanan');
  };

  const clearCart = () => {
    setCartItems([]);
    showToast('Pesanan dikosongkan');
  };

  const handleAddCustomItem = (e) => {
    e.preventDefault();
    if (!customItem.name || !customItem.price) return;
    const priceNum = Number(customItem.price);
    const newCustom = {
      id: Date.now(),
      title: customItem.name,
      price: priceNum,
      qty: 1,
      stylist: 'Custom Item'
    };
    setCartItems(prev => [...prev, newCustom]);
    setCustomItem({ name: '', price: '' });
    showToast(`Item custom "${newCustom.title}" ditambahkan`);
  };

  // Billing Calculations
  const subtotal = cartItems.reduce((acc, item) => acc + item.price * item.qty, 0);
  const memberDiscount = (applyMemberDiscount && selectedCustomer && subtotal > 0) ? Math.round(subtotal * 0.10) : 0;
  const pointRedemption = (applyPointRedemption && selectedCustomer && subtotal > 0) ? 20000 : 0;
  const taxAndService = subtotal > 0 ? Math.round((subtotal - memberDiscount - pointRedemption) * 0.10) : 0;
  const grandTotal = Math.max(0, subtotal - memberDiscount - pointRedemption + taxAndService);

  const handleProcessPayment = () => {
    if (cartItems.length === 0) {
      showToast('Pesanan masih kosong, tambahkan item terlebih dahulu!');
      return;
    }
    showToast(`Pembayaran Rp ${grandTotal.toLocaleString('id-ID')} Berhasil Diproses!`);
  };

  const handleLogout = () => {
    router.post('/logout');
  };

  // Filtered Catalog Items
  const filteredCatalog = catalogItems.filter(item => {
    const matchesSearch = item.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
                          item.subtext.toLowerCase().includes(searchQuery.toLowerCase());
    if (activeCategory === 'haircut') return matchesSearch && item.category === 'haircut';
    if (activeCategory === 'coloring') return matchesSearch && item.category === 'coloring';
    if (activeCategory === 'spa') return matchesSearch && (item.category === 'spa' || item.category === 'product');
    return matchesSearch;
  });

  return (
    <div className="min-h-screen bg-[#F4F5F7] font-sans text-slate-800 flex flex-col md:flex-row">
      <Head title="Kasir & POS - L-Style ATELIER SUITE" />

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
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-slate-900 text-white shadow-sm font-semibold transition-all"
              >
                <ShoppingBag className="w-4 h-4 text-white" />
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

        {/* Operational Body (2-Column POS Layout) */}
        <main className="p-6">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            {/* ==========================================
                LEFT COLUMN: CATALOG & ITEM SELECTION (7/12)
            ========================================== */}
            <div className="lg:col-span-7 space-y-5">

              {/* Top Order Header Card */}
              <div className="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs flex flex-wrap items-center justify-between gap-4">
                <div className="flex items-center gap-3.5">
                  <div className="w-11 h-11 rounded-2xl bg-slate-950 text-white flex items-center justify-center shadow-md">
                    <Receipt className="w-6 h-6" />
                  </div>
                  <div>
                    <div className="flex items-center gap-2">
                      <h2 className="text-xl font-black text-slate-900 tracking-tight">Order #POS-8821</h2>
                      <span className="px-2 py-0.5 rounded text-[9px] font-extrabold bg-amber-100 text-amber-900 border border-amber-300">
                        BILLING LIVE
                      </span>
                    </div>
                    <p className="text-[11px] text-slate-500 font-medium mt-0.5">
                      🖨️ Kasir 01 (Atelier Front) • 📅 24 Okt 2024, 14:32 WIB
                    </p>
                  </div>
                </div>

                <div className="flex items-center gap-2">
                  <button
                    onClick={() => showToast('Membuka Pilihan Kursi / Chair')}
                    className="px-3.5 py-2 bg-slate-50 hover:bg-slate-100 text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 flex items-center gap-1.5"
                  >
                    <Armchair className="w-3.5 h-3.5 text-slate-600" />
                    <span>Pilih Kursi / {selectedChair}</span>
                  </button>

                  <button
                    onClick={() => showToast('Membuka Form Walk-In Custom')}
                    className="px-4 py-2 bg-slate-950 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-md flex items-center gap-1.5"
                  >
                    <Plus className="w-3.5 h-3.5" />
                    <span>Walk-In Custom</span>
                  </button>
                </div>
              </div>

              {/* Search & Category Filter Bar */}
              <div className="bg-white rounded-3xl p-4 border border-slate-200/80 shadow-xs space-y-3">
                <div className="flex items-center justify-between gap-3">
                  <div className="relative flex-1">
                    <Search className="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                    <input
                      type="text"
                      placeholder="Cari nama haircut, treatment, barcode, atau pomade..."
                      value={searchQuery}
                      onChange={(e) => setSearchQuery(e.target.value)}
                      className="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs text-slate-800 focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                    />
                    <button className="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                      <QrCode className="w-4 h-4" />
                    </button>
                  </div>

                  <div className="text-[10px] font-bold text-slate-400 uppercase tracking-wider text-right shrink-0">
                    <p>KATALOG MODE:</p>
                    <p className="text-slate-800 font-extrabold">Semua Cabang Senopati</p>
                  </div>
                </div>

                {/* Category Pills */}
                <div className="flex items-center gap-2 overflow-x-auto pb-1 text-xs font-semibold">
                  <button
                    onClick={() => setActiveCategory('semua')}
                    className={`px-4 py-2 rounded-xl transition-all shrink-0 flex items-center gap-1.5 ${
                      activeCategory === 'semua' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                    }`}
                  >
                    <Scissors className="w-3.5 h-3.5" />
                    <span>Semua (32)</span>
                  </button>

                  <button
                    onClick={() => setActiveCategory('haircut')}
                    className={`px-4 py-2 rounded-xl transition-all shrink-0 flex items-center gap-1.5 ${
                      activeCategory === 'haircut' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                    }`}
                  >
                    <Scissors className="w-3.5 h-3.5" />
                    <span>Haircut & Beard</span>
                  </button>

                  <button
                    onClick={() => setActiveCategory('coloring')}
                    className={`px-4 py-2 rounded-xl transition-all shrink-0 flex items-center gap-1.5 ${
                      activeCategory === 'coloring' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                    }`}
                  >
                    <Sparkles className="w-3.5 h-3.5 text-amber-500" />
                    <span>Coloring & Perm</span>
                  </button>

                  <button
                    onClick={() => setActiveCategory('spa')}
                    className={`px-4 py-2 rounded-xl transition-all shrink-0 flex items-center gap-1.5 ${
                      activeCategory === 'spa' ? 'bg-slate-950 text-white font-bold shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                    }`}
                  >
                    <Crown className="w-3.5 h-3.5 text-amber-500" />
                    <span>Spa & Treatment</span>
                  </button>
                </div>
              </div>

              {/* Product Grid (3 Columns) */}
              <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                {filteredCatalog.map((item) => (
                  <div
                    key={item.id}
                    className="bg-white rounded-3xl p-4 border border-slate-200/80 shadow-xs hover:shadow-md transition-all flex flex-col justify-between space-y-3 group border-l-4 border-l-slate-900"
                  >
                    <div className="space-y-2">
                      <div className="flex items-center justify-between text-[10px]">
                        <span className={`px-2 py-0.5 rounded font-extrabold uppercase tracking-wider ${item.badgeClass}`}>
                          {item.badge}
                        </span>
                        <span className="text-slate-400 font-semibold flex items-center gap-1">
                          <Clock className="w-3 h-3" />
                          <span>{item.duration}</span>
                        </span>
                      </div>

                      <div>
                        <h4 className="font-extrabold text-slate-900 text-xs leading-snug group-hover:text-amber-800 transition-all">
                          {item.title}
                        </h4>
                        <p className="text-[10px] text-slate-500 font-medium leading-relaxed mt-1 line-clamp-2">
                          {item.subtext}
                        </p>
                      </div>
                    </div>

                    <div className="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                      <div>
                        <p className="text-[8px] font-bold uppercase text-slate-400 tracking-wider">{item.priceLabel}</p>
                        <p className="font-black text-slate-900 text-sm">{item.priceFormatted}</p>
                      </div>

                      <button
                        onClick={() => addToCart(item)}
                        className="px-3 py-1.5 bg-slate-100 hover:bg-slate-900 hover:text-white text-slate-800 font-bold rounded-xl text-xs transition-all flex items-center gap-1 border border-slate-200"
                      >
                        <Plus className="w-3.5 h-3.5" />
                        <span>Tambah</span>
                      </button>
                    </div>
                  </div>
                ))}
              </div>

              {/* Custom Line Item / Biaya Tambahan Box */}
              <div className="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs space-y-3">
                <div className="flex items-center gap-3">
                  <div className="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0">
                    <SlidersHorizontal className="w-4 h-4" />
                  </div>
                  <div>
                    <h4 className="font-extrabold text-slate-900 text-sm">Custom Line Item / Biaya Tambahan</h4>
                    <p className="text-[11px] text-slate-500 font-medium">
                      Tambahkan biaya tip, custom styling, atau produk off-catalog manual.
                    </p>
                  </div>
                </div>

                <form onSubmit={handleAddCustomItem} className="flex flex-wrap items-center gap-2">
                  <input
                    type="text"
                    placeholder="Deskripsi item..."
                    value={customItem.name}
                    onChange={(e) => setCustomItem({ ...customItem, name: e.target.value })}
                    className="flex-1 min-w-[160px] px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                  <input
                    type="number"
                    placeholder="Rp 0"
                    value={customItem.price}
                    onChange={(e) => setCustomItem({ ...customItem, price: e.target.value })}
                    className="w-28 px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                  />
                  <button
                    type="submit"
                    className="px-4 py-2 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-xl text-xs shadow-sm flex items-center gap-1.5"
                  >
                    <Plus className="w-3.5 h-3.5" />
                    <span>Sisipkan</span>
                  </button>
                </form>
              </div>

            </div>

            {/* ==========================================
                RIGHT COLUMN: CART, CUSTOMER & CHECKOUT (5/12)
            ========================================== */}
            <div className="lg:col-span-5 space-y-5">

              {/* Selected Customer Card */}
              <div className="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs space-y-3">
                <div className="flex items-center justify-between text-xs">
                  <span className="text-[10px] font-bold uppercase tracking-wider text-slate-400">PELANGGAN TERPILIH</span>
                  <button
                    onClick={() => {
                      if (selectedCustomer) {
                        setSelectedCustomer(null);
                        showToast('Pelanggan dilepas dari transaksi');
                      } else {
                        setSelectedCustomer(demoCustomer);
                        showToast('Pelanggan Bimo Santoso dipilih');
                      }
                    }}
                    className="font-bold text-amber-800 hover:underline flex items-center gap-1"
                  >
                    <span>⇄ {selectedCustomer ? 'Ganti Pelanggan' : 'Pilih Pelanggan VIP'}</span>
                  </button>
                </div>

                {selectedCustomer ? (
                  <div className="flex items-center justify-between bg-slate-50 p-3.5 rounded-2xl border border-slate-200/70">
                    <div className="flex items-center gap-3">
                      <div className="w-10 h-10 rounded-2xl bg-slate-950 text-white font-black flex items-center justify-center text-sm shadow-sm">
                        {selectedCustomer.initials}
                      </div>
                      <div>
                        <div className="flex items-center gap-1.5">
                          <h4 className="font-extrabold text-slate-900 text-sm">{selectedCustomer.name}</h4>
                          <CheckCircle2 className="w-4 h-4 text-emerald-500 fill-emerald-100" />
                        </div>
                        <p className="text-xs text-slate-500 font-mono">{selectedCustomer.phone}</p>
                      </div>
                    </div>

                    <div className="text-right space-y-1">
                      <span className="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-900 border border-amber-300 block">
                        {selectedCustomer.tier}
                      </span>
                      <p className="text-[10px] font-bold text-amber-800">
                        🏷️ {selectedCustomer.points.toLocaleString('id-ID')} Poin
                      </p>
                    </div>
                  </div>
                ) : (
                  <div className="p-4 bg-slate-50 border border-dashed border-slate-200 rounded-2xl text-center space-y-2">
                    <User className="w-6 h-6 text-slate-400 mx-auto" />
                    <p className="text-xs text-slate-500 font-medium">Belum ada pelanggan terpilih (Transaksi Umum / Guest)</p>
                    <button
                      onClick={() => { setSelectedCustomer(demoCustomer); showToast('Pelanggan Bimo Santoso dipilih'); }}
                      className="px-3 py-1 bg-slate-900 text-white rounded-lg text-xs font-bold"
                    >
                      Pilih Customer Demo
                    </button>
                  </div>
                )}
              </div>

              {/* Cart Summary Card */}
              <div className="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs space-y-4">
                <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                  <div className="flex items-center gap-2">
                    <h3 className="font-extrabold text-slate-900 text-base">Ringkasan Pesanan</h3>
                    <span className="w-6 h-6 rounded-full bg-slate-100 text-slate-900 font-black text-xs flex items-center justify-center border border-slate-200">
                      {cartItems.length}
                    </span>
                  </div>

                  {cartItems.length > 0 && (
                    <button
                      onClick={clearCart}
                      className="text-[10px] font-bold text-red-600 hover:underline uppercase tracking-wider"
                    >
                      KOSONGKAN
                    </button>
                  )}
                </div>

                {/* Cart Items List */}
                <div className="space-y-3 max-h-72 overflow-y-auto pr-1">
                  {cartItems.length > 0 ? (
                    cartItems.map((item) => (
                      <div
                        key={item.id}
                        className="bg-slate-50 p-3.5 rounded-2xl border border-slate-200/70 flex items-center justify-between gap-3 text-xs"
                      >
                        <div className="space-y-0.5 flex-1 min-w-0">
                          <h5 className="font-extrabold text-slate-900 text-xs truncate">{item.title}</h5>
                          <p className="text-[10px] text-slate-500">Stylist: {item.stylist}</p>
                          <p className="font-black text-slate-900 text-xs mt-1">
                            Rp {(item.price * item.qty).toLocaleString('id-ID')}
                          </p>
                        </div>

                        {/* Qty Controls */}
                        <div className="flex items-center gap-1.5">
                          <button
                            onClick={() => updateQty(item.id, -1)}
                            className="w-6 h-6 rounded-lg bg-white border border-slate-300 text-slate-700 font-bold flex items-center justify-center hover:bg-slate-100"
                          >
                            -
                          </button>
                          <span className="w-5 text-center font-bold text-xs">{item.qty}</span>
                          <button
                            onClick={() => updateQty(item.id, 1)}
                            className="w-6 h-6 rounded-lg bg-white border border-slate-300 text-slate-700 font-bold flex items-center justify-center hover:bg-slate-100"
                          >
                            +
                          </button>

                          <button
                            onClick={() => removeFromCart(item.id)}
                            className="p-1 text-slate-400 hover:text-red-600 ml-1"
                          >
                            <Trash2 className="w-4 h-4" />
                          </button>
                        </div>
                      </div>
                    ))
                  ) : (
                    <div className="py-10 text-center text-slate-400 space-y-2 border border-dashed border-slate-200 rounded-2xl">
                      <ShoppingBag className="w-8 h-8 mx-auto text-slate-300" />
                      <p className="text-xs font-semibold">Pesanan belum memiliki item.</p>
                      <p className="text-[11px] text-slate-400">Klik item di sebelah kiri untuk menambah.</p>
                    </div>
                  )}
                </div>

                {/* Billing Breakdown */}
                <div className="border-t border-slate-100 pt-4 space-y-2 text-xs">
                  <div className="flex justify-between text-slate-600 font-medium">
                    <span>Subtotal Pesanan</span>
                    <span className="font-bold text-slate-900">Rp {subtotal.toLocaleString('id-ID')}</span>
                  </div>

                  {memberDiscount > 0 && (
                    <div className="flex justify-between text-emerald-700 font-semibold bg-emerald-50 p-2 rounded-xl border border-emerald-200/60">
                      <span className="flex items-center gap-1">
                        <Star className="w-3.5 h-3.5 fill-emerald-600" />
                        <span>Diskon Member Black (10%)</span>
                      </span>
                      <span>-Rp {memberDiscount.toLocaleString('id-ID')}</span>
                    </div>
                  )}

                  {pointRedemption > 0 && (
                    <div className="flex justify-between text-amber-800 font-semibold bg-amber-50 p-2 rounded-xl border border-amber-200/60">
                      <span className="flex items-center gap-1">
                        <Gift className="w-3.5 h-3.5 text-amber-700" />
                        <span>Tukar 200 Poin Loyalty</span>
                        <span className="text-[9px] font-normal text-slate-500">(Sisa saldo: 1.250 pts)</span>
                      </span>
                      <span>-Rp {pointRedemption.toLocaleString('id-ID')}</span>
                    </div>
                  )}

                  <div className="flex justify-between text-slate-500 font-medium">
                    <span>Pajak PB1 & Service (10%)</span>
                    <span>Rp {taxAndService.toLocaleString('id-ID')}</span>
                  </div>

                  {/* TOTAL PEMBAYARAN CARD */}
                  <div className="bg-slate-950 text-white rounded-2xl p-4 shadow-xl flex items-center justify-between mt-3 border border-slate-800">
                    <div>
                      <p className="text-[10px] font-bold uppercase tracking-wider text-amber-400">TOTAL PEMBAYARAN</p>
                      <p className="text-[10px] text-slate-400">Net setelah diskon & poin</p>
                    </div>
                    <div className="text-right">
                      <p className="text-2xl font-black text-amber-400 tracking-tight">
                        Rp {grandTotal.toLocaleString('id-ID')}
                      </p>
                    </div>
                  </div>
                </div>

                {/* PAYMENT METHOD SELECTOR */}
                <div className="space-y-3 pt-2">
                  <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">METODE PEMBAYARAN</p>
                  <div className="grid grid-cols-2 gap-2 text-xs">
                    {/* QRIS */}
                    <button
                      onClick={() => setPaymentMethod('qris')}
                      className={`p-3 rounded-2xl border text-left transition-all ${
                        paymentMethod === 'qris'
                          ? 'bg-slate-950 text-white border-slate-900 shadow-md ring-2 ring-amber-400/50'
                          : 'bg-white text-slate-800 border-slate-200 hover:bg-slate-50'
                      }`}
                    >
                      <div className="flex items-center gap-2">
                        <QrCode className="w-4 h-4 text-amber-400 shrink-0" />
                        <div>
                          <p className="font-extrabold text-xs leading-tight">QRIS Dinamis</p>
                          <p className={`text-[9px] ${paymentMethod === 'qris' ? 'text-amber-400 font-bold' : 'text-slate-400'}`}>Auto-Verify</p>
                        </div>
                      </div>
                    </button>

                    {/* CASH */}
                    <button
                      onClick={() => setPaymentMethod('cash')}
                      className={`p-3 rounded-2xl border text-left transition-all ${
                        paymentMethod === 'cash'
                          ? 'bg-slate-950 text-white border-slate-900 shadow-md ring-2 ring-amber-400/50'
                          : 'bg-white text-slate-800 border-slate-200 hover:bg-slate-50'
                      }`}
                    >
                      <div className="flex items-center gap-2">
                        <Banknote className="w-4 h-4 text-emerald-400 shrink-0" />
                        <div>
                          <p className="font-extrabold text-xs leading-tight">Tunai / Cash</p>
                          <p className={`text-[9px] ${paymentMethod === 'cash' ? 'text-amber-400 font-bold' : 'text-slate-400'}`}>Kembalian</p>
                        </div>
                      </div>
                    </button>

                    {/* EDC / KARTU */}
                    <button
                      onClick={() => setPaymentMethod('card')}
                      className={`p-3 rounded-2xl border text-left transition-all ${
                        paymentMethod === 'card'
                          ? 'bg-slate-950 text-white border-slate-900 shadow-md ring-2 ring-amber-400/50'
                          : 'bg-white text-slate-800 border-slate-200 hover:bg-slate-50'
                      }`}
                    >
                      <div className="flex items-center gap-2">
                        <CreditCard className="w-4 h-4 text-blue-400 shrink-0" />
                        <div>
                          <p className="font-extrabold text-xs leading-tight">EDC / Kartu</p>
                          <p className={`text-[9px] ${paymentMethod === 'card' ? 'text-amber-400 font-bold' : 'text-slate-400'}`}>BCA, Mandiri</p>
                        </div>
                      </div>
                    </button>

                    {/* VIRTUAL ACCOUNT */}
                    <button
                      onClick={() => setPaymentMethod('va')}
                      className={`p-3 rounded-2xl border text-left transition-all ${
                        paymentMethod === 'va'
                          ? 'bg-slate-950 text-white border-slate-900 shadow-md ring-2 ring-amber-400/50'
                          : 'bg-white text-slate-800 border-slate-200 hover:bg-slate-50'
                      }`}
                    >
                      <div className="flex items-center gap-2">
                        <Wallet className="w-4 h-4 text-purple-400 shrink-0" />
                        <div>
                          <p className="font-extrabold text-xs leading-tight">Virtual Account</p>
                          <p className={`text-[9px] ${paymentMethod === 'va' ? 'text-amber-400 font-bold' : 'text-slate-400'}`}>Instant Link</p>
                        </div>
                      </div>
                    </button>
                  </div>
                </div>

                {/* QRIS DYNAMIC SCAN DISPLAY */}
                {paymentMethod === 'qris' && (
                  <div className="bg-slate-50 p-4 rounded-2xl border border-slate-200/80 text-center space-y-3">
                    {/* SVG QR Code Illustration */}
                    <div className="w-36 h-36 mx-auto bg-white p-2.5 rounded-2xl shadow-md border border-slate-200 flex items-center justify-center">
                      <svg viewBox="0 0 100 100" className="w-full h-full text-slate-900 fill-current">
                        <path d="M0,0 h35 v35 h-35 z M5,5 v25 h25 v-25 z M10,10 h15 v15 h-15 z" />
                        <path d="M65,0 h35 v35 h-35 z M70,5 v25 h25 v-25 z M75,10 h15 v15 h-15 z" />
                        <path d="M0,65 h35 v35 h-35 z M5,70 v25 h25 v-25 z M10,75 h15 v15 h-15 z" />
                        <rect x="40" y="5" width="8" height="8" />
                        <rect x="50" y="5" width="8" height="8" />
                        <rect x="40" y="20" width="16" height="8" />
                        <rect x="5" y="40" width="8" height="16" />
                        <rect x="20" y="45" width="12" height="12" />
                        <rect x="40" y="40" width="20" height="20" rx="3" className="fill-amber-500" />
                        <rect x="65" y="40" width="10" height="10" />
                        <rect x="80" y="40" width="15" height="8" />
                        <rect x="40" y="65" width="8" height="15" />
                        <rect x="55" y="70" width="12" height="12" />
                        <rect x="75" y="65" width="20" height="20" />
                      </svg>
                    </div>

                    <div>
                      <p className="font-extrabold text-slate-900 text-xs">
                        Scan via BCA / GoPay / OVO / Dana / Livin
                      </p>
                      <p className="text-[11px] text-slate-500 font-medium mt-0.5">
                        Menunggu sinyal pembayaran • Berakhir dlm <span className="font-bold text-amber-800">04:58</span>
                      </p>
                    </div>
                  </div>
                )}

                {/* BOTTOM ACTION BUTTONS */}
                <div className="space-y-2 pt-2">
                  <button
                    onClick={handleProcessPayment}
                    className="w-full py-3.5 bg-slate-950 hover:bg-slate-800 text-white font-black rounded-2xl text-xs shadow-xl transition-all flex items-center justify-center gap-2"
                  >
                    <CheckCircle className="w-4 h-4 text-emerald-400" />
                    <span>Proses Pembayaran (Rp {grandTotal.toLocaleString('id-ID')})</span>
                  </button>

                  <div className="grid grid-cols-2 gap-2 text-xs">
                    <button
                      onClick={() => showToast('Mencetak struk thermal POS...')}
                      className="py-2.5 bg-white hover:bg-slate-100 text-slate-800 font-bold rounded-xl border border-slate-200 transition-all flex items-center justify-center gap-1.5"
                    >
                      <Printer className="w-3.5 h-3.5 text-slate-600" />
                      <span>Cetak Thermal</span>
                    </button>

                    <button
                      onClick={() => showToast('Kirim nota digital via WhatsApp...')}
                      className="py-2.5 bg-white hover:bg-slate-100 text-slate-800 font-bold rounded-xl border border-slate-200 transition-all flex items-center justify-center gap-1.5"
                    >
                      <MessageSquare className="w-3.5 h-3.5 text-emerald-600" />
                      <span>Kirim WhatsApp</span>
                    </button>
                  </div>
                </div>

              </div>

            </div>

          </div>
        </main>
      </div>

    </div>
  );
}
