import React, { useState, useRef, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import {
  Activity, Sparkles, Shirt, Droplets, Wind, Flame, CheckCircle, Truck,
  Layers, Users, DollarSign, Package, Settings, BarChart2, Bell, Search,
  HelpCircle, Cpu, Plus, ChevronDown, Check, Zap, AlertTriangle,
  ArrowUpRight, Clock, ShieldCheck, MapPin, Eye, MessageSquare, ChevronRight,
  TrendingUp, Download, Play, FileText, UserPlus, Filter, SlidersHorizontal,
  RefreshCw, AlertCircle, Calendar, BatteryCharging, Navigation, PieChart,
  Printer, Share2, Smartphone, CreditCard, Award, ChevronUp, Copy, ExternalLink, X,
  Key, LogOut, CheckCheck, Trash2, Lock, Shield, User
} from 'lucide-react';

export default function CleanDashboard({
  auth,
  stats = {},
  garmentPipeline = [],
  ordersStream = [],
  customerList = [],
  servicesList = []
}) {
  const userObj = auth?.user || { name: 'Owner Laundry', email: 'clean@lclean.id', role: 'clean' };
  const [activeTab, setActiveTab] = useState('dashboard');
  const [searchQuery, setSearchQuery] = useState('');
  const [toastMessage, setToastMessage] = useState(null);
  const searchInputRef = useRef(null);

  // User Menu & Notification Drawer state
  const [showUserMenu, setShowUserMenu] = useState(false);
  const [showNotificationDrawer, setShowNotificationDrawer] = useState(false);
  const [showChangePasswordModal, setShowChangePasswordModal] = useState(false);

  // Notifications List State
  const [notificationsList, setNotificationsList] = useState([
    {
      id: 1,
      title: 'Order #LC-8842 Selesai',
      desc: 'Cucian Ibu Ani Wijaya telah selesai disetrika & notifikasi WA otomatis dikirim.',
      time: '10 menit yang lalu',
      type: 'success',
      unread: true
    },
    {
      id: 2,
      title: 'Member Baru VIP Registered',
      desc: 'Bpk. Ridwan Firmansyah mendaftar Gold VIP Member (Saldo: Rp 100.000)',
      time: '25 menit yang lalu',
      type: 'info',
      unread: true
    },
    {
      id: 3,
      title: 'WhatsApp Gateway Online',
      desc: 'Koneksi WhatsApp Automation Gateway aktif & terhubung 100%.',
      time: '1 jam yang lalu',
      type: 'system',
      unread: false
    },
    {
      id: 4,
      title: 'Pembayaran QRIS Instant',
      desc: 'Pembayaran QRIS Rp 42.000 untuk Order #LC-8840 berhasil diterima.',
      time: '2 jam yang lalu',
      type: 'payment',
      unread: false
    }
  ]);

  // Password Change Form State
  const [passwordForm, setPasswordForm] = useState({
    current_password: '',
    password: '',
    password_confirmation: ''
  });

  const showNotification = (msg) => {
    setToastMessage(msg);
    setTimeout(() => setToastMessage(null), 4000);
  };

  const safeRoute = (name, params) => {
    try {
      if (typeof window !== 'undefined' && typeof window.route === 'function') {
        return window.route(name, params);
      }
      if (typeof route === 'function') {
        return route(name, params);
      }
    } catch (e) {
      // fallback
    }
    if (name === 'clean.orders.store') return '/clean/orders';
    if (name === 'clean.customers.store') return '/clean/customers';
    if (name === 'clean.services.store') return '/clean/services';
    if (name === 'clean.orders.update_status') return `/clean/orders/${params}/status`;
    if (name === 'clean.orders.whatsapp') return `/clean/orders/${params}/whatsapp`;
    if (name === 'clean.orders.nota') return `/clean/orders/${params}/nota`;
    if (name === 'logout') return '/logout';
    if (name === 'password.update') return '/password';
    return '#';
  };

  // Keyboard shortcut Ctrl+K / Cmd+K to focus search input
  useEffect(() => {
    const handleKeyDown = (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        if (searchInputRef.current) {
          searchInputRef.current.focus();
        }
      }
    };
    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, []);

  // Modals state
  const [showNewOrderModal, setShowNewOrderModal] = useState(false);
  const [showNewCustomerModal, setShowNewCustomerModal] = useState(false);
  const [showNewServiceModal, setShowNewServiceModal] = useState(false);
  const [showNotaModal, setShowNotaModal] = useState(false);
  const [showWaModal, setShowWaModal] = useState(false);

  // Selected Order for Nota / WA
  const [selectedOrderNota, setSelectedOrderNota] = useState(null);
  const [waPayload, setWaPayload] = useState(null);

  // New Service Form state
  const [serviceForm, setServiceForm] = useState({
    name: '',
    tier: 'Express 6 Jam',
    unit: 'kg',
    price_amount: 15000,
    minimum_batch: '3 kg',
    hardware_spec: 'Deterjen Premium + Softener + Setrika Uap'
  });

  // New Customer Form state
  const [custForm, setCustForm] = useState({
    name: '',
    phone: '',
    email: '',
    account_type: 'Gold VIP Member',
    membership_balance: 100000
  });

  // New Order Form state with automatic calculation
  const [orderForm, setOrderForm] = useState({
    client_name: '',
    whatsapp_phone: '',
    service_name: 'Cuci Setrika Express (6 Jam)',
    weight_kg: 3.0,
    weight_items: '3.0 kg',
    amount: 42000,
    payment_method: 'QRIS',
    delivery_type: 'Self Pickup',
    notes: ''
  });

  // Calculate price dynamically: Jenis Layanan (harga/kg) * Berat (kg)
  const getServicePricePerKg = (serviceName) => {
    const srv = servicesList.find(s => s.name === serviceName);
    return srv ? (srv.raw_price || 14000) : 14000;
  };

  const calculateTotalAmount = (serviceName, weightVal) => {
    const pricePerKg = getServicePricePerKg(serviceName);
    const w = parseFloat(weightVal) || 0;
    return Math.round(pricePerKg * w);
  };

  const handleServiceChange = (serviceName) => {
    const newAmount = calculateTotalAmount(serviceName, orderForm.weight_kg);
    setOrderForm(prev => ({
      ...prev,
      service_name: serviceName,
      amount: newAmount
    }));
  };

  const handleWeightChange = (weightVal) => {
    const newAmount = calculateTotalAmount(orderForm.service_name, weightVal);
    setOrderForm(prev => ({
      ...prev,
      weight_kg: weightVal,
      weight_items: `${weightVal} kg`,
      amount: newAmount
    }));
  };

  // Submit New Order
  const handleCreateOrder = (e) => {
    e.preventDefault();
    const payload = {
      ...orderForm,
      weight_items: `${orderForm.weight_kg || 1} kg`
    };
    router.post(safeRoute('clean.orders.store'), payload, {
      onSuccess: () => {
        setShowNewOrderModal(false);
        showNotification(`Order baru untuk ${orderForm.client_name} berhasil dibuat!`);
        setOrderForm({
          client_name: '',
          whatsapp_phone: '',
          service_name: 'Cuci Setrika Express (6 Jam)',
          weight_kg: 3.0,
          weight_items: '3.0 kg',
          amount: 42000,
          payment_method: 'QRIS',
          delivery_type: 'Self Pickup',
          notes: ''
        });
      }
    });
  };

  // Submit New Customer
  const handleCreateCustomer = (e) => {
    e.preventDefault();
    router.post(safeRoute('clean.customers.store'), custForm, {
      onSuccess: () => {
        setShowNewCustomerModal(false);
        showNotification(`Pelanggan ${custForm.name} berhasil ditambahkan!`);
        setCustForm({
          name: '',
          phone: '',
          email: '',
          account_type: 'Gold VIP Member',
          membership_balance: 100000
        });
      }
    });
  };

  // Submit New Service & Pricing
  const handleCreateService = (e) => {
    e.preventDefault();
    router.post(safeRoute('clean.services.store'), serviceForm, {
      onSuccess: () => {
        setShowNewServiceModal(false);
        showNotification(`Layanan ${serviceForm.name} berhasil ditambahkan!`);
        setServiceForm({
          name: '',
          tier: 'Express 6 Jam',
          unit: 'kg',
          price_amount: 15000,
          minimum_batch: '3 kg',
          hardware_spec: 'Deterjen Premium + Softener + Setrika Uap'
        });
      }
    });
  };

  // Advance Order Status
  const handleAdvanceStatus = (orderId, orderCode) => {
    router.post(safeRoute('clean.orders.update_status', orderId), {}, {
      onSuccess: () => {
        showNotification(`Status order ${orderCode} berhasil diperbarui!`);
      }
    });
  };

  // Trigger WhatsApp Modal Simulation
  const handleOpenWaModal = (orderId) => {
    fetch(safeRoute('clean.orders.whatsapp', orderId), {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        'Accept': 'application/json'
      }
    })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          setWaPayload(data);
          setShowWaModal(true);
        }
      })
      .catch(() => showNotification('Gagal menyiapkan pesan WhatsApp.'));
  };

  // Trigger Nota Digital Modal
  const handleOpenNotaModal = (orderId) => {
    fetch(safeRoute('clean.orders.nota', orderId))
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          setSelectedOrderNota(data.nota);
          setShowNotaModal(true);
        }
      })
      .catch(() => showNotification('Gagal mengambil data nota digital.'));
  };

  // Handle Logout
  const handleLogout = () => {
    setShowUserMenu(false);
    try {
      router.post(safeRoute('logout'), {}, {
        onFinish: () => {
          window.location.href = '/login';
        }
      });
    } catch (e) {
      window.location.href = '/login';
    }
  };

  // Handle Password Submit
  const handlePasswordSubmit = (e) => {
    e.preventDefault();
    if (passwordForm.password !== passwordForm.password_confirmation) {
      showNotification('Konfirmasi password baru tidak cocok!');
      return;
    }
    showNotification('Password akun L-Clean berhasil diperbarui!');
    setShowChangePasswordModal(false);
    setPasswordForm({ current_password: '', password: '', password_confirmation: '' });
  };

  // Mark all notifications read
  const markAllNotificationsRead = () => {
    setNotificationsList(prev => prev.map(n => ({ ...n, unread: false })));
    showNotification('Semua notifikasi ditandai telah dibaca.');
  };

  // Clear notifications
  const clearNotifications = () => {
    setNotificationsList([]);
    showNotification('Daftar notifikasi dibersihkan.');
  };

  // Filter orders multi-field search
  const filteredOrders = ordersStream.filter(o => {
    if (!searchQuery) return true;
    const q = searchQuery.toLowerCase().trim();
    return (
      (o.order_id && o.order_id.toLowerCase().includes(q)) ||
      (o.client_name && o.client_name.toLowerCase().includes(q)) ||
      (o.whatsapp_phone && o.whatsapp_phone.toLowerCase().includes(q)) ||
      (o.service && o.service.toLowerCase().includes(q)) ||
      (o.stage && o.stage.toLowerCase().includes(q)) ||
      (o.payment_method && o.payment_method.toLowerCase().includes(q)) ||
      (o.rfid_tag && o.rfid_tag.toLowerCase().includes(q)) ||
      (o.amount && String(o.amount).toLowerCase().includes(q)) ||
      (o.notes && o.notes.toLowerCase().includes(q))
    );
  });

  // Filter customers multi-field search
  const filteredCustomers = customerList.filter(c => {
    if (!searchQuery) return true;
    const q = searchQuery.toLowerCase().trim();
    return (
      (c.name && c.name.toLowerCase().includes(q)) ||
      (c.phone && c.phone.toLowerCase().includes(q)) ||
      (c.email && c.email.toLowerCase().includes(q)) ||
      (c.account_type && c.account_type.toLowerCase().includes(q))
    );
  });

  // Filter services multi-field search
  const filteredServices = servicesList.filter(s => {
    if (!searchQuery) return true;
    const q = searchQuery.toLowerCase().trim();
    return (
      (s.name && s.name.toLowerCase().includes(q)) ||
      (s.tier && s.tier.toLowerCase().includes(q)) ||
      (s.price && s.price.toLowerCase().includes(q)) ||
      (s.hardware_spec && s.hardware_spec.toLowerCase().includes(q))
    );
  });

  const unreadCount = notificationsList.filter(n => n.unread).length;

  return (
    <div className="flex bg-[#0B0F19] text-slate-100 min-h-screen font-sans antialiased relative overflow-x-hidden">
      <Head title="L-Clean - Multi-Tenant SaaS Laundry Platform" />

      {/* Animated Glowing Gradient Backdrops */}
      <div className="fixed -top-40 -left-40 w-[500px] h-[500px] bg-sky-600/15 rounded-full blur-[140px] pointer-events-none animate-pulse"></div>
      <div className="fixed top-1/3 -right-40 w-[550px] h-[550px] bg-indigo-600/15 rounded-full blur-[150px] pointer-events-none animate-pulse delay-1000"></div>
      <div className="fixed -bottom-40 left-1/3 w-[450px] h-[450px] bg-cyan-600/10 rounded-full blur-[130px] pointer-events-none"></div>

      {/* Toast Popup */}
      {toastMessage && (
        <div className="fixed bottom-6 right-6 z-50 bg-slate-900/95 text-white px-5 py-3.5 rounded-2xl shadow-2xl flex items-center gap-3 animate-bounce border border-slate-700/80 backdrop-blur-xl">
          <Sparkles className="w-5 h-5 text-cyan-400" />
          <span className="text-xs font-semibold">{toastMessage}</span>
        </div>
      )}

      {/* ========================================================= */}
      {/* LEFT SIDEBAR NAVIGATION */}
      {/* ========================================================= */}
      <aside className="w-64 bg-[#0F172A]/90 backdrop-blur-xl border-r border-slate-800/80 flex flex-col h-screen fixed left-0 top-0 z-30 shadow-2xl">
        {/* Brand Header */}
        <div className="p-5 border-b border-slate-800/80 flex items-center justify-between">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-2xl bg-gradient-to-tr from-sky-500 via-cyan-500 to-indigo-500 flex items-center justify-center text-white shadow-lg shadow-sky-500/25">
              <Droplets className="w-5 h-5" />
            </div>
            <div>
              <h1 className="text-xl font-black text-white tracking-tight leading-none">
                L-Clean
              </h1>
              <span className="text-[10px] font-extrabold text-cyan-400 tracking-wider">SaaS LAUNDRY</span>
            </div>
          </div>
          <span className="text-[9px] font-black bg-cyan-500/10 text-cyan-300 border border-cyan-500/30 px-2 py-0.5 rounded-full uppercase tracking-wider">
            Pro
          </span>
        </div>

        {/* Navigation Menu */}
        <nav className="flex-1 px-3 py-5 space-y-1.5 overflow-y-auto">
          {[
            { id: 'dashboard', label: 'Dashboard SaaS', icon: Layers },
            { id: 'orders', label: 'Input & Tracking Cucian', icon: Shirt, badge: String(ordersStream.length) },
            { id: 'customers', label: 'Pelanggan & Membership', icon: Users, badge: String(customerList.length) },
            { id: 'services', label: 'Layanan & Tarif', icon: DollarSign, badge: String(servicesList.length) },
            { id: 'saas_presentation', label: 'Ide Produk SaaS & AI', icon: Sparkles, badge: 'SaaS' },
            { id: 'reports', label: 'Laporan Omzet', icon: BarChart2 },
            { id: 'settings', label: 'Pengaturan Tenant', icon: Settings },
          ].map((item) => {
            const IconComp = item.icon;
            const isActive = activeTab === item.id;
            return (
              <button
                key={item.id}
                onClick={() => setActiveTab(item.id)}
                className={`w-full flex items-center justify-between px-3.5 py-3 rounded-xl text-xs font-semibold transition-all ${
                  isActive
                    ? 'bg-gradient-to-r from-sky-600 to-cyan-600 text-white shadow-lg shadow-sky-500/25 font-bold'
                    : 'text-slate-400 hover:bg-slate-800/80 hover:text-white'
                }`}
              >
                <div className="flex items-center gap-3">
                  <IconComp className={`w-4 h-4 ${isActive ? 'text-white' : 'text-slate-400'}`} />
                  <span>{item.label}</span>
                </div>
                {item.badge && (
                  <span className={`text-[10px] px-2 py-0.5 rounded-full font-extrabold ${
                    isActive ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 border border-slate-700/50'
                  }`}>
                    {item.badge}
                  </span>
                )}
              </button>
            );
          })}
        </nav>

        {/* System Info Bottom Card */}
        <div className="p-4 border-t border-slate-800/80">
          <div className="bg-slate-900/80 border border-slate-800 p-3 rounded-xl flex items-center justify-between">
            <div className="flex items-center gap-2">
              <span className="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
              <span className="text-[11px] font-bold text-slate-300">SaaS Node Active</span>
            </div>
            <span className="text-[10px] text-cyan-400 font-mono">v2.4.0</span>
          </div>
        </div>
      </aside>

      {/* ========================================================= */}
      {/* MAIN CONTENT AREA */}
      {/* ========================================================= */}
      <div className="flex-1 ml-64 flex flex-col min-w-0 h-screen overflow-y-auto">
        {/* Top Header Bar */}
        <header className="bg-[#0F172A]/80 backdrop-blur-xl border-b border-slate-800/80 px-8 py-3.5 flex items-center justify-between sticky top-0 z-20 shadow-md">
          
          {/* Enhanced Professional Search UI */}
          <div className="relative w-96">
            <Search className="w-4 h-4 text-sky-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none z-10" />
            <input
              ref={searchInputRef}
              type="text"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              placeholder="Cari Order #LC-, Pelanggan, WA, Status, Layanan..."
              className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl pl-12 pr-10 py-2 text-xs font-semibold text-slate-100 placeholder-slate-500 focus:bg-[#090D16] focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 outline-none transition-all shadow-inner"
            />
            {searchQuery && (
              <button
                onClick={() => setSearchQuery('')}
                className="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white bg-slate-800 hover:bg-slate-700 rounded-full p-1 transition-all"
                title="Reset pencarian"
              >
                <X className="w-3 h-3" />
              </button>
            )}
          </div>

          {/* Header Controls: WA Status, Bell Notifications, User Dropdown */}
          <div className="flex items-center gap-4">
            <div className="hidden sm:flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-3 py-1 rounded-full text-xs font-bold">
              <span className="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
              SaaS Engine & WA Gate Online
            </div>

            {/* Interactive Bell Notification Trigger */}
            <div className="relative">
              <button
                onClick={() => {
                  setShowNotificationDrawer(!showNotificationDrawer);
                  setShowUserMenu(false);
                }}
                className="p-2.5 text-slate-300 hover:text-white rounded-xl hover:bg-slate-800/80 relative transition-all border border-slate-800"
                title="Buka Pemberitahuan"
              >
                <Bell className="w-4 h-4" />
                {unreadCount > 0 && (
                  <span className="w-2.5 h-2.5 bg-rose-500 rounded-full absolute top-1.5 right-1.5 ring-2 ring-[#0F172A]"></span>
                )}
              </button>

              {/* Interactive Notification Drawer Popover */}
              {showNotificationDrawer && (
                <div className="absolute right-0 top-12 w-80 sm:w-96 bg-[#0F172A] border border-slate-800 rounded-2xl shadow-2xl p-4 z-50 animate-in fade-in zoom-in-95 space-y-3">
                  <div className="flex items-center justify-between border-b border-slate-800 pb-3">
                    <div className="flex items-center gap-2">
                      <Bell className="w-4 h-4 text-sky-400" />
                      <h4 className="font-extrabold text-sm text-white">Notifikasi L-Clean Live</h4>
                    </div>
                    <div className="flex items-center gap-2">
                      <button
                        onClick={markAllNotificationsRead}
                        className="text-[10px] text-sky-400 hover:underline font-bold"
                      >
                        Tandai Dibaca
                      </button>
                      <button
                        onClick={clearNotifications}
                        className="text-slate-400 hover:text-rose-400"
                        title="Bersihkan"
                      >
                        <X className="w-4 h-4" />
                      </button>
                    </div>
                  </div>

                  <div className="max-h-72 overflow-y-auto space-y-2 pr-1">
                    {notificationsList.length > 0 ? (
                      notificationsList.map((item) => (
                        <div
                          key={item.id}
                          className={`p-3 rounded-xl border text-xs space-y-1 transition-all ${
                            item.unread
                              ? 'bg-sky-500/10 border-sky-500/30 text-slate-100'
                              : 'bg-slate-900/60 border-slate-800 text-slate-400'
                          }`}
                        >
                          <div className="flex justify-between items-center">
                            <span className="font-extrabold text-white text-xs">{item.title}</span>
                            <span className="text-[10px] text-slate-500">{item.time}</span>
                          </div>
                          <p className="text-[11px] leading-relaxed">{item.desc}</p>
                        </div>
                      ))
                    ) : (
                      <div className="py-8 text-center text-slate-500 text-xs">
                        Tidak ada notifikasi aktif.
                      </div>
                    )}
                  </div>
                </div>
              )}
            </div>

            <div className="h-5 w-[1px] bg-slate-800"></div>

            {/* Clickable User Account Logo & Menu */}
            <div className="relative">
              <button
                onClick={() => {
                  setShowUserMenu(!showUserMenu);
                  setShowNotificationDrawer(false);
                }}
                className="flex items-center gap-3 p-1.5 rounded-xl hover:bg-slate-800/80 border border-transparent hover:border-slate-800 transition-all text-left"
              >
                <div className="w-9 h-9 rounded-full bg-gradient-to-tr from-sky-500 to-indigo-600 text-white flex items-center justify-center font-bold text-xs ring-2 ring-sky-500/30 shadow-md overflow-hidden">
                  <img
                    src={`https://ui-avatars.com/api/?name=${encodeURIComponent(userObj.name)}&background=0284c7&color=fff`}
                    alt={userObj.name}
                    className="w-full h-full object-cover"
                  />
                </div>
                <div className="hidden sm:block">
                  <p className="text-xs font-bold text-white leading-tight flex items-center gap-1">
                    {userObj.name} <ChevronDown className="w-3 h-3 text-slate-400" />
                  </p>
                  <p className="text-[10px] text-cyan-400 font-semibold leading-none mt-0.5">
                    {userObj.email}
                  </p>
                </div>
              </button>

              {/* Account Profile Dropdown Menu */}
              {showUserMenu && (
                <div className="absolute right-0 top-12 w-64 bg-[#0F172A] border border-slate-800 rounded-2xl shadow-2xl p-2 z-50 animate-in fade-in zoom-in-95 space-y-1">
                  <div className="px-3 py-2 border-b border-slate-800 mb-1">
                    <p className="text-xs font-bold text-white">{userObj.name}</p>
                    <p className="text-[10px] text-slate-400">{userObj.email}</p>
                    <span className="inline-block mt-1 text-[9px] font-extrabold bg-sky-500/20 text-sky-400 border border-sky-500/30 px-2 py-0.5 rounded-md uppercase">
                      Role: Clean SaaS Admin
                    </span>
                  </div>

                  <button
                    onClick={() => {
                      setShowUserMenu(false);
                      setShowChangePasswordModal(true);
                    }}
                    className="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-300 hover:bg-slate-800 hover:text-white transition-all text-left"
                  >
                    <Key className="w-4 h-4 text-amber-400" /> Ubah / Lupa Password
                  </button>

                  <button
                    onClick={handleLogout}
                    className="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-rose-400 hover:bg-rose-500/10 transition-all text-left"
                  >
                    <LogOut className="w-4 h-4 text-rose-400" /> Keluar / Logout
                  </button>
                </div>
              )}
            </div>
          </div>
        </header>

        {/* Dynamic Tab Body */}
        <main className="p-8 flex-1 space-y-8">
          {/* ========================================================= */}
          {/* TAB 1: MAIN DASHBOARD VIEW */}
          {/* ========================================================= */}
          {activeTab === 'dashboard' && (
            <>
              {/* Telemetry & SaaS Header Banner */}
              <div className="bg-[#0F172A]/90 border border-slate-800/90 rounded-2xl p-6 shadow-xl backdrop-blur-md flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                  <div className="flex items-center gap-2 mb-1">
                    <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span className="text-[11px] font-bold tracking-wider text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-0.5 rounded-md uppercase">
                      L-CLEAN SAAS MULTI-TENANT ENGINE
                    </span>
                  </div>
                  <h2 className="text-2xl font-black text-white tracking-tight">
                    Dashboard SaaS Laundry & Facilities
                  </h2>
                  <p className="text-xs text-slate-400 mt-1">
                    Sistem Manajemen Laundry Terintegrasi &bull; Nota Digital &bull; WhatsApp Automation &bull; Dashboard Omzet
                  </p>
                </div>

                <div className="flex items-center gap-2.5">
                  <button
                    onClick={() => setShowNewCustomerModal(true)}
                    className="bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 border border-slate-700 transition-all"
                  >
                    <UserPlus className="w-4 h-4 text-sky-400" /> + Member Baru
                  </button>
                  <button
                    onClick={() => setShowNewOrderModal(true)}
                    className="bg-gradient-to-r from-sky-500 to-cyan-500 hover:from-sky-400 hover:to-cyan-400 text-white text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 shadow-lg shadow-sky-500/25 transition-all"
                  >
                    <Plus className="w-4 h-4" /> + Input Order Laundry
                  </button>
                </div>
              </div>

              {/* 4 Cards Stat Omzet & Antrian */}
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div className="bg-[#0F172A]/90 border border-slate-800/90 p-5 rounded-2xl shadow-xl flex flex-col justify-between hover:border-sky-500/40 transition-all">
                  <div>
                    <div className="flex justify-between items-center mb-2">
                      <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        OMZET HARI INI
                      </span>
                      <div className="w-8 h-8 rounded-xl bg-sky-500/10 border border-sky-500/20 text-sky-400 flex items-center justify-center">
                        <DollarSign className="w-4 h-4" />
                      </div>
                    </div>
                    <div className="flex items-baseline gap-2">
                      <h3 className="text-2xl font-black text-white tracking-tight">
                        {stats.today_revenue || 'Rp 1.018.500'}
                      </h3>
                      <span className="text-[11px] font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-1.5 py-0.5 rounded">
                        {stats.revenue_change || '+24.5%'}
                      </span>
                    </div>
                    <p className="text-[10px] text-slate-400 mt-1">Total Omzet: <b className="text-slate-200">{stats.total_omzet}</b></p>
                  </div>

                  <div className="mt-4 pt-3 border-t border-slate-800 flex items-center justify-between text-[10px] text-slate-400 font-semibold">
                    <span>QRIS: <b className="text-sky-400">{stats.qris_omzet}</b></span>
                    <span>Tunai: <b className="text-emerald-400">{stats.cash_omzet}</b></span>
                  </div>
                </div>

                <div className="bg-[#0F172A]/90 border border-slate-800/90 p-5 rounded-2xl shadow-xl flex flex-col justify-between hover:border-amber-500/40 transition-all">
                  <div>
                    <div className="flex justify-between items-center mb-2">
                      <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        STATUS CUCIAN AKTIF
                      </span>
                      <div className="w-8 h-8 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center">
                        <Shirt className="w-4 h-4" />
                      </div>
                    </div>
                    <h3 className="text-2xl font-black text-white tracking-tight">{stats.in_facility_orders || 5} Order</h3>
                    <p className="text-[10px] text-slate-400 mt-1">Sedang diproses dalam fasilitas laundry</p>
                  </div>

                  <div className="mt-4 pt-3 border-t border-slate-800 flex items-center justify-between text-[11px]">
                    <span className="text-amber-400 font-bold bg-amber-500/10 border border-amber-500/20 px-2 py-0.5 rounded">Diterima: {stats.diterima_count}</span>
                    <span className="text-sky-400 font-bold bg-sky-500/10 border border-sky-500/20 px-2 py-0.5 rounded">Proses: {stats.proses_count}</span>
                  </div>
                </div>

                <div className="bg-[#0F172A]/90 border border-slate-800/90 p-5 rounded-2xl shadow-xl flex flex-col justify-between hover:border-emerald-500/40 transition-all">
                  <div>
                    <div className="flex justify-between items-center mb-2">
                      <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        SELESAI & siap diambil
                      </span>
                      <div className="w-8 h-8 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center">
                        <CheckCircle className="w-4 h-4" />
                      </div>
                    </div>
                    <h3 className="text-2xl font-black text-white tracking-tight">{stats.selesai_count || 1} Order</h3>
                    <p className="text-[10px] text-slate-400 mt-1">Sudah siap & dikirim notifikasi WA</p>
                  </div>

                  <div className="mt-4 pt-3 border-t border-slate-800 flex items-center justify-between text-[11px]">
                    <span className="text-purple-400 font-bold bg-purple-500/10 border border-purple-500/20 px-2 py-0.5 rounded">Diambil: {stats.diambil_count}</span>
                    <span className="text-emerald-400 font-bold">100% On-Time SLA</span>
                  </div>
                </div>

                <div className="bg-[#0F172A]/90 border border-slate-800/90 p-5 rounded-2xl shadow-xl flex flex-col justify-between hover:border-indigo-500/40 transition-all">
                  <div>
                    <div className="flex justify-between items-center mb-2">
                      <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        TOTAL PELANGGAN & MEMBERSHIP
                      </span>
                      <div className="w-8 h-8 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center">
                        <Users className="w-4 h-4" />
                      </div>
                    </div>
                    <h3 className="text-2xl font-black text-white tracking-tight">{stats.active_clients_today || 5} Member</h3>
                    <p className="text-[10px] text-slate-400 mt-1"><b className="text-slate-200">{stats.vip_members || 2} VIP Member</b> | {stats.commercial_clients || 2} Corporate</p>
                  </div>

                  <div className="mt-4 pt-3 border-t border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
                    <span>Saldo Deposit Member:</span>
                    <span className="text-indigo-400 font-bold">{stats.membership_omzet}</span>
                  </div>
                </div>
              </div>

              {/* Status Tracking Flow Visualizer */}
              <div className="bg-[#0F172A]/90 border border-slate-800/90 rounded-2xl p-6 shadow-xl space-y-4">
                <div className="flex items-center justify-between border-b border-slate-800 pb-3">
                  <div>
                    <h3 className="text-base font-extrabold text-white tracking-tight">
                      Alur Status Tracking Cucian (Diterima &rarr; Proses &rarr; Selesai &rarr; Diambil)
                    </h3>
                    <p className="text-xs text-slate-400">
                      Live status visualizer untuk memantau cucian dari penerimaan awal hingga diserahkan ke pelanggan
                    </p>
                  </div>
                  <div className="flex items-center gap-2">
                    <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span className="text-[11px] font-bold text-slate-300 bg-slate-800 border border-slate-700 px-3 py-1 rounded-lg">
                      Auto WA Trigger Active
                    </span>
                  </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                  {garmentPipeline.map((node) => (
                    <div
                      key={node.stage}
                      className="p-4 rounded-xl border border-slate-800 bg-slate-900/60 flex flex-col justify-between transition-all"
                    >
                      <div className="flex justify-between items-center">
                        <span className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                          STAGE {node.stage}
                        </span>
                        <span className="text-[10px] font-bold px-2 py-0.5 rounded uppercase bg-sky-500/20 text-sky-300 border border-sky-500/30">
                          {node.name}
                        </span>
                      </div>
                      <div className="mt-3">
                        <h4 className="text-xs font-bold text-slate-200">{node.action}</h4>
                        <div className="flex items-baseline gap-2 mt-1">
                          <span className="text-3xl font-black text-white leading-none">
                            {node.count}
                          </span>
                          <span className="text-[11px] text-slate-400">{node.subtitle}</span>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>

              {/* Data Table Orders Stream */}
              <div className="bg-[#0F172A]/90 border border-slate-800/90 rounded-2xl shadow-xl overflow-hidden">
                <div className="p-6 border-b border-slate-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                  <div>
                    <h3 className="text-base font-extrabold text-white">
                      Daftar Order & Status Tracking Real-Time
                    </h3>
                    <p className="text-xs text-slate-400 mt-0.5">
                      Klik tombol status untuk memperbarui alur cucian & kirim notifikasi WhatsApp otomatis.
                    </p>
                  </div>
                  <button
                    onClick={() => setShowNewOrderModal(true)}
                    className="bg-sky-600 hover:bg-sky-500 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-md"
                  >
                    + Input Order Baru
                  </button>
                </div>

                <div className="overflow-x-auto">
                  <table className="w-full text-left border-collapse">
                    <thead>
                      <tr className="bg-slate-900/80 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-800">
                        <th className="py-3.5 px-6">ORDER ID / TAG</th>
                        <th className="py-3.5 px-6">PELANGGAN / NO WA</th>
                        <th className="py-3.5 px-6">LAYANAN</th>
                        <th className="py-3.5 px-6">BERAT / TOTAL</th>
                        <th className="py-3.5 px-6">STATUS CUCIAN</th>
                        <th className="py-3.5 px-6">METODE BAYAR</th>
                        <th className="py-3.5 px-6 text-right">AKSI & WA</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-slate-800/60 text-xs">
                      {filteredOrders.length > 0 ? (
                        filteredOrders.map((row) => (
                          <tr key={row.id} className="hover:bg-slate-800/40 transition-colors">
                            <td className="py-3.5 px-6 font-bold text-sky-400">
                              {row.order_id}
                              <p className="text-[10px] text-slate-500 font-normal">{row.rfid_tag}</p>
                            </td>
                            <td className="py-3.5 px-6">
                              <p className="font-bold text-white">{row.client_name}</p>
                              <span className="text-[10px] font-semibold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-1.5 py-0.5 rounded">
                                WA: {row.whatsapp_phone}
                              </span>
                            </td>
                            <td className="py-3.5 px-6 font-medium text-slate-300">{row.service}</td>
                            <td className="py-3.5 px-6">
                              <p className="font-bold text-white">{row.amount}</p>
                              <span className="text-[10px] text-slate-400">{row.weight_items}</span>
                            </td>
                            <td className="py-3.5 px-6">
                              <span className={`text-[11px] font-extrabold px-3 py-1 rounded-full border ${
                                row.stage === 'Diterima' ? 'bg-amber-500/10 border-amber-500/30 text-amber-400' :
                                row.stage === 'Proses' ? 'bg-sky-500/10 border-sky-500/30 text-sky-400' :
                                row.stage === 'Selesai' ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400' : 'bg-purple-500/10 border-purple-500/30 text-purple-400'
                              }`}>
                                {row.stage}
                              </span>
                            </td>
                            <td className="py-3.5 px-6 font-semibold text-slate-300">
                              <span className="bg-slate-800 border border-slate-700 px-2 py-0.5 rounded text-[10px]">
                                {row.payment_method}
                              </span>
                            </td>
                            <td className="py-3.5 px-6 text-right space-x-1.5">
                              {row.stage !== 'Diambil' && (
                                <button
                                  onClick={() => handleAdvanceStatus(row.id, row.order_id)}
                                  className="bg-sky-600 hover:bg-sky-500 text-white px-3 py-1 rounded-lg text-[11px] font-bold shadow-xs transition-all"
                                >
                                  &rarr; {row.action_primary}
                                </button>
                              )}
                              <button
                                onClick={() => handleOpenWaModal(row.id)}
                                className="bg-emerald-600 hover:bg-emerald-500 text-white px-2.5 py-1 rounded-lg text-[11px] font-bold shadow-xs transition-all"
                                title="Kirim Notifikasi WA"
                              >
                                <Smartphone className="w-3.5 h-3.5 inline" /> WA
                              </button>
                              <button
                                onClick={() => handleOpenNotaModal(row.id)}
                                className="bg-slate-800 hover:bg-slate-700 text-slate-300 px-2.5 py-1 rounded-lg text-[11px] font-bold border border-slate-700 transition-all"
                                title="Lihat Nota Digital"
                              >
                                <Printer className="w-3.5 h-3.5 inline" /> Nota
                              </button>
                            </td>
                          </tr>
                        ))
                      ) : (
                        <tr>
                          <td colSpan="7" className="py-12 text-center text-slate-400">
                            <Shirt className="w-8 h-8 text-sky-400/50 mx-auto mb-2" />
                            {searchQuery ? (
                              <>
                                <p className="font-semibold text-xs text-slate-300">Tidak ada order yang cocok dengan "{searchQuery}"</p>
                                <button onClick={() => setSearchQuery('')} className="mt-2 text-[11px] text-sky-400 hover:underline font-bold">
                                  Reset Pencarian
                                </button>
                              </>
                            ) : (
                              <>
                                <p className="font-bold text-sm text-white">Belum Ada Transaksi Order Laundry</p>
                                <p className="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Tabel masih kosong. Klik tombol di bawah untuk memasukkan order laundry pertama Anda.</p>
                                <button onClick={() => setShowNewOrderModal(true)} className="mt-3 bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs px-4 py-2 rounded-xl shadow-md transition-all">
                                  + Input Order Baru Pertama
                                </button>
                              </>
                            )}
                          </td>
                        </tr>
                      )}
                    </tbody>
                  </table>
                </div>
              </div>
            </>
          )}

          {/* ========================================================= */}
          {/* TAB 2: INPUT & TRACKING CUCIAN */}
          {/* ========================================================= */}
          {activeTab === 'orders' && (
            <div className="space-y-6">
              <div className="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 bg-[#0F172A]/90 border border-slate-800/90 p-6 rounded-2xl shadow-xl">
                <div>
                  <h2 className="text-2xl font-extrabold text-white tracking-tight">
                    Input & Tracking Cucian L-Clean
                  </h2>
                  <p className="text-xs text-slate-400 mt-1">
                    Kelola antrian cucian, percepat alur status (Diterima &rarr; Proses &rarr; Selesai &rarr; Diambil), serta cetak nota digital.
                  </p>
                </div>
                <button
                  onClick={() => setShowNewOrderModal(true)}
                  className="bg-sky-600 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-md"
                >
                  + Form Input Order Baru
                </button>
              </div>

              {/* Data Table Orders */}
              <div className="bg-[#0F172A]/90 border border-slate-800/90 rounded-2xl shadow-xl overflow-hidden">
                <div className="overflow-x-auto">
                  <table className="w-full text-left border-collapse text-xs">
                    <thead>
                      <tr className="bg-slate-900/80 text-[10px] font-bold text-slate-400 uppercase border-b border-slate-800">
                        <th className="py-3.5 px-6">ORDER ID</th>
                        <th className="py-3.5 px-6">PELANGGAN</th>
                        <th className="py-3.5 px-6">LAYANAN</th>
                        <th className="py-3.5 px-6">BERAT / JUMLAH</th>
                        <th className="py-3.5 px-6">STATUS ALUR</th>
                        <th className="py-3.5 px-6">TOTAL HARGA</th>
                        <th className="py-3.5 px-6 text-right">AKSI</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-slate-800/60">
                      {filteredOrders.map((o) => (
                        <tr key={o.id} className="hover:bg-slate-800/40">
                          <td className="py-3.5 px-6 font-bold text-sky-400">{o.order_id}</td>
                          <td className="py-3.5 px-6">
                            <p className="font-bold text-white">{o.client_name}</p>
                            <p className="text-[10px] text-slate-400">{o.whatsapp_phone}</p>
                          </td>
                          <td className="py-3.5 px-6 font-medium text-slate-300">{o.service}</td>
                          <td className="py-3.5 px-6 font-bold text-white">{o.weight_items}</td>
                          <td className="py-3.5 px-6">
                            <span className={`text-[10px] font-bold px-2.5 py-1 rounded-full border ${
                              o.stage === 'Diterima' ? 'bg-amber-500/10 border-amber-500/30 text-amber-400' :
                              o.stage === 'Proses' ? 'bg-sky-500/10 border-sky-500/30 text-sky-400' :
                              o.stage === 'Selesai' ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400' : 'bg-purple-500/10 border-purple-500/30 text-purple-400'
                            }`}>
                              {o.stage}
                            </span>
                          </td>
                          <td className="py-3.5 px-6 font-extrabold text-white">{o.amount}</td>
                          <td className="py-3.5 px-6 text-right space-x-2">
                            <button
                              onClick={() => handleOpenNotaModal(o.id)}
                              className="bg-slate-800 text-slate-300 px-3 py-1 rounded-lg font-bold text-[11px] border border-slate-700"
                            >
                              Nota Digital
                            </button>
                            <button
                              onClick={() => handleOpenWaModal(o.id)}
                              className="bg-emerald-600 text-white px-3 py-1 rounded-lg font-bold text-[11px]"
                            >
                              Notif WA
                            </button>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          )}

          {/* ========================================================= */}
          {/* TAB 3: PELANGGAN & MEMBERSHIP */}
          {/* ========================================================= */}
          {activeTab === 'customers' && (
            <div className="space-y-6">
              <div className="flex justify-between items-center bg-[#0F172A]/90 border border-slate-800/90 p-6 rounded-2xl shadow-xl">
                <div>
                  <h2 className="text-2xl font-extrabold text-white tracking-tight">
                    Pelanggan, Membership & Saldo Deposit
                  </h2>
                  <p className="text-xs text-slate-400 mt-1">
                    Sistem loyalty member, deposit saldo prabayar, dan riwayat transaksi laundry pelanggan.
                  </p>
                </div>
                <button
                  onClick={() => setShowNewCustomerModal(true)}
                  className="bg-sky-600 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-md"
                >
                  + Tambah Member Baru
                </button>
              </div>

              <div className="bg-[#0F172A]/90 border border-slate-800/90 rounded-2xl shadow-xl overflow-hidden">
                <div className="p-5 border-b border-slate-800 font-bold text-sm text-white">
                  Daftar Pelanggan Terdaftar ({customerList.length})
                </div>

                <div className="overflow-x-auto">
                  <table className="w-full text-left border-collapse text-xs">
                    <thead>
                      <tr className="bg-slate-900/80 text-[10px] font-bold text-slate-400 uppercase border-b border-slate-800">
                        <th className="py-3.5 px-6">NAMA PELANGGAN</th>
                        <th className="py-3.5 px-6">NO TELEPON / WA</th>
                        <th className="py-3.5 px-6">TIER MEMBERSHIP</th>
                        <th className="py-3.5 px-6">SALDO DEPOSIT</th>
                        <th className="py-3.5 px-6">POIN LOYALTY</th>
                        <th className="py-3.5 px-6 text-right">TOTAL TRANSAKSI</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-slate-800/60">
                      {filteredCustomers.length > 0 ? (
                        filteredCustomers.map((c) => (
                          <tr key={c.id} className="hover:bg-slate-800/40">
                            <td className="py-3.5 px-6 font-bold text-white">{c.name}</td>
                            <td className="py-3.5 px-6 text-slate-300">{c.phone}</td>
                            <td className="py-3.5 px-6">
                              <span className="bg-sky-500/20 text-sky-300 border border-sky-500/30 text-[10px] font-bold px-2.5 py-0.5 rounded-full">
                                {c.account_type}
                              </span>
                            </td>
                            <td className="py-3.5 px-6 font-black text-emerald-400">{c.membership_balance}</td>
                            <td className="py-3.5 px-6 font-bold text-amber-400">{c.points} Poin</td>
                            <td className="py-3.5 px-6 text-right font-extrabold text-white">{c.total_spent}</td>
                          </tr>
                        ))
                      ) : (
                        <tr>
                          <td colSpan="6" className="py-12 text-center text-slate-400">
                            <Users className="w-8 h-8 text-sky-400/50 mx-auto mb-2" />
                            {searchQuery ? (
                              <>
                                <p className="font-semibold text-xs text-slate-300">Tidak ada pelanggan yang cocok dengan "{searchQuery}"</p>
                                <button onClick={() => setSearchQuery('')} className="mt-2 text-[11px] text-sky-400 hover:underline font-bold">
                                  Reset Pencarian
                                </button>
                              </>
                            ) : (
                              <>
                                <p className="font-bold text-sm text-white">Belum Ada Pelanggan Terdaftar</p>
                                <p className="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Klik tombol di bawah untuk mendaftarkan member / pelanggan baru.</p>
                                <button onClick={() => setShowNewCustomerModal(true)} className="mt-3 bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs px-4 py-2 rounded-xl shadow-md transition-all">
                                  + Tambah Member Pertama
                                </button>
                              </>
                            )}
                          </td>
                        </tr>
                      )}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          )}

          {/* ========================================================= */}
          {/* TAB 4: LAYANAN & TARIF */}
          {/* ========================================================= */}
          {activeTab === 'services' && (
            <div className="space-y-6">
              <div className="bg-[#0F172A]/90 border border-slate-800/90 p-6 rounded-2xl shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <h2 className="text-2xl font-extrabold text-white tracking-tight">
                    Katalog Layanan & Tarif Laundry
                  </h2>
                  <p className="text-xs text-slate-400 mt-1">
                    Daftar harga kiloan, satuan, express 6 jam, dan dry clean spesialis.
                  </p>
                </div>
                <button
                  onClick={() => setShowNewServiceModal(true)}
                  className="bg-gradient-to-r from-sky-500 to-cyan-500 hover:from-sky-400 hover:to-cyan-400 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-lg shadow-sky-500/25 flex items-center gap-2 transition-all"
                >
                  <Plus className="w-4 h-4" /> + Tambah Layanan & Tarif Baru
                </button>
              </div>

              {filteredServices.length > 0 ? (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                  {filteredServices.map((srv) => (
                    <div key={srv.id} className="bg-[#0F172A]/90 border border-slate-800/90 p-6 rounded-2xl shadow-xl flex flex-col justify-between space-y-4 hover:border-sky-500/40 transition-all">
                      <div>
                        <span className="text-[10px] font-bold text-sky-300 bg-sky-500/20 border border-sky-500/30 px-2.5 py-0.5 rounded-full uppercase">
                          {srv.tier}
                        </span>
                        <h3 className="font-extrabold text-base text-white mt-2">{srv.name}</h3>
                        <p className="text-2xl font-black text-cyan-400 mt-2">{srv.price}</p>
                        <p className="text-xs text-slate-400 mt-2 leading-relaxed">
                          Spesifikasi: {srv.hardware_spec} &bull; Min: {srv.minimum_batch}
                        </p>
                      </div>

                      <div className="pt-3 border-t border-slate-800 flex items-center justify-between">
                        <span className="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded">
                          Aktif di POS
                        </span>
                        <button
                          onClick={() => {
                            setOrderForm(prev => ({ ...prev, service_name: srv.name }));
                            setShowNewOrderModal(true);
                          }}
                          className="bg-sky-600 hover:bg-sky-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition-all"
                        >
                          Pilih untuk Order
                        </button>
                      </div>
                    </div>
                  ))}
                </div>
              ) : (
                <div className="bg-[#0F172A]/90 border border-slate-800 p-10 rounded-2xl text-center space-y-2">
                  <AlertCircle className="w-8 h-8 text-slate-500 mx-auto" />
                  <p className="font-bold text-xs text-slate-300">Tidak ada layanan yang cocok dengan "{searchQuery}"</p>
                  <button onClick={() => setSearchQuery('')} className="text-xs text-sky-400 font-bold hover:underline">
                    Reset Pencarian
                  </button>
                </div>
              )}
            </div>
          )}

          {/* ========================================================= */}
          {/* TAB 5: IDE PRODUK SAAS, AI & AUTOMATION (AGENDA PEMBAHASAN) */}
          {/* ========================================================= */}
          {activeTab === 'saas_presentation' && (
            <div className="space-y-6">
              <div className="bg-gradient-to-r from-slate-900 via-slate-800 to-sky-950 border border-slate-700/80 p-8 rounded-3xl text-white shadow-xl space-y-4">
                <div className="flex items-center gap-2">
                  <Sparkles className="w-5 h-5 text-cyan-400" />
                  <span className="text-xs font-bold text-cyan-400 uppercase tracking-widest">
                    AGENDA PEMBAHASAN SAAS & AI AUTOMATION
                  </span>
                </div>
                <h2 className="text-3xl font-black tracking-tight">
                  L-Clean: Produk Application SaaS Berbasis Langganan (Recurring Revenue)
                </h2>
                <p className="text-sm text-slate-300 max-w-3xl leading-relaxed">
                  L-Clean dirancang sebagai platform **Multi-Tenant SaaS Laundry Platform** yang mudah didemokan ke pengusaha laundry kiloan, satuan, maupun komersial. Dengan fitur unggulan notifikasi WhatsApp otomatis, nota digital, dan manajemen saldo membership.
                </p>
              </div>

              {/* 3 Pillars Strategy */}
              <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div className="bg-[#0F172A]/90 border border-slate-800/90 p-6 rounded-2xl shadow-xl space-y-3">
                  <div className="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 border border-sky-500/30 flex items-center justify-center font-bold">
                    1
                  </div>
                  <h3 className="font-extrabold text-base text-white">Recurring Revenue Model</h3>
                  <p className="text-xs text-slate-400 leading-relaxed">
                    Sistem berlangganan bulanan/tahunan (Starter Rp 99rb/bln, Pro Rp 249rb/bln, Multi-Outlet Enterprise Rp 599rb/bln).
                  </p>
                </div>

                <div className="bg-[#0F172A]/90 border border-slate-800/90 p-6 rounded-2xl shadow-xl space-y-3">
                  <div className="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center font-bold">
                    2
                  </div>
                  <h3 className="font-extrabold text-base text-white">AI & WhatsApp Automation</h3>
                  <p className="text-xs text-slate-400 leading-relaxed">
                    Otomatisasi notifikasi WA saat status cucian berubah (Diterima &rarr; Proses &rarr; Selesai &rarr; Diambil) tanpa mengetik manual.
                  </p>
                </div>

                <div className="bg-[#0F172A]/90 border border-slate-800/90 p-6 rounded-2xl shadow-xl space-y-3">
                  <div className="w-10 h-10 rounded-xl bg-purple-500/20 text-purple-400 border border-purple-500/30 flex items-center justify-center font-bold">
                    3
                  </div>
                  <h3 className="font-extrabold text-base text-white">Multi-Tenant Architecture</h3>
                  <p className="text-xs text-slate-400 leading-relaxed">
                    Dapat mengelola banyak outlet laundry dalam 1 akun owner, mendukung pemisahan data aman dan pelaporan omzet terpusat.
                  </p>
                </div>
              </div>
            </div>
          )}

          {/* General Fallback for other tabs */}
          {['reports', 'settings'].includes(activeTab) && (
            <div className="bg-[#0F172A]/90 border border-slate-800/90 p-12 rounded-2xl shadow-xl text-center space-y-3">
              <div className="w-12 h-12 rounded-2xl bg-sky-500/20 text-sky-400 flex items-center justify-center mx-auto border border-sky-500/30">
                <SlidersHorizontal className="w-6 h-6" />
              </div>
              <h3 className="text-lg font-extrabold text-white capitalize">
                L-Clean {activeTab} Panel
              </h3>
              <p className="text-xs text-slate-400 max-w-md mx-auto">
                Modul {activeTab} terhubung secara langsung dengan database L-Clean SaaS.
              </p>
              <button
                onClick={() => setActiveTab('dashboard')}
                className="bg-sky-600 text-white text-xs font-bold px-4 py-2 rounded-xl"
              >
                Kembali ke Dashboard Utama
              </button>
            </div>
          )}
        </main>
      </div>

      {/* ========================================================= */}
      {/* MODAL: UBAH / LUPA PASSWORD AKUN */}
      {/* ========================================================= */}
      {showChangePasswordModal && (
        <div className="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4">
          <div className="bg-[#0F172A] border border-slate-800 rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-5 text-slate-100">
            <div className="flex justify-between items-center border-b border-slate-800 pb-3">
              <div className="flex items-center gap-2">
                <Key className="w-5 h-5 text-amber-400" />
                <h3 className="font-extrabold text-white text-base">Ubah / Reset Password Akun</h3>
              </div>
              <button onClick={() => setShowChangePasswordModal(false)} className="text-slate-400 hover:text-white">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handlePasswordSubmit} className="space-y-4 text-xs">
              <div>
                <label className="font-bold text-slate-300 block mb-1">Password Saat Ini</label>
                <input
                  type="password"
                  required
                  placeholder="••••••••"
                  value={passwordForm.current_password}
                  onChange={(e) => setPasswordForm({ ...passwordForm, current_password: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3.5 py-2.5 text-white focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-300 block mb-1">Password Baru</label>
                <input
                  type="password"
                  required
                  placeholder="••••••••"
                  value={passwordForm.password}
                  onChange={(e) => setPasswordForm({ ...passwordForm, password: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3.5 py-2.5 text-white focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-300 block mb-1">Konfirmasi Password Baru</label>
                <input
                  type="password"
                  required
                  placeholder="••••••••"
                  value={passwordForm.password_confirmation}
                  onChange={(e) => setPasswordForm({ ...passwordForm, password_confirmation: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3.5 py-2.5 text-white focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 outline-none"
                />
              </div>

              <div className="pt-3 border-t border-slate-800 flex gap-3">
                <button
                  type="button"
                  onClick={() => setShowChangePasswordModal(false)}
                  className="w-1/2 bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-2.5 rounded-xl border border-slate-700"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="w-1/2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold py-2.5 rounded-xl shadow-lg transition-all"
                >
                  Simpan Password
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* ========================================================= */}
      {/* MODAL 1: FORM INPUT ORDER BARU */}
      {/* ========================================================= */}
      {showNewOrderModal && (
        <div className="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4">
          <div className="bg-[#0F172A] border border-slate-800 rounded-3xl max-w-lg w-full p-6 shadow-2xl space-y-5 text-slate-100">
            <div className="flex justify-between items-center border-b border-slate-800 pb-3">
              <div className="flex items-center gap-2">
                <Shirt className="w-5 h-5 text-sky-400" />
                <h3 className="font-extrabold text-white text-base">Input Order Laundry Baru</h3>
              </div>
              <button onClick={() => setShowNewOrderModal(false)} className="text-slate-400 hover:text-white">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleCreateOrder} className="space-y-4 text-xs">
              <div>
                <label className="font-bold text-slate-300 block mb-1">Nama Pelanggan</label>
                <input
                  type="text"
                  required
                  placeholder="Contoh: Bpk. Ridwan Firmansyah"
                  value={orderForm.client_name}
                  onChange={(e) => setOrderForm({ ...orderForm, client_name: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-sky-500 outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-300 block mb-1">No. WhatsApp (Notifikasi WA Auto)</label>
                <input
                  type="text"
                  required
                  placeholder="Contoh: 081234567890"
                  value={orderForm.whatsapp_phone}
                  onChange={(e) => setOrderForm({ ...orderForm, whatsapp_phone: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-sky-500 outline-none"
                />
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="font-bold text-slate-300 block mb-1">Jenis Layanan</label>
                  <select
                    value={orderForm.service_name}
                    onChange={(e) => handleServiceChange(e.target.value)}
                    className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-sky-500 outline-none font-semibold"
                  >
                    {servicesList.map(s => (
                      <option key={s.id} value={s.name}>{s.name} ({s.price})</option>
                    ))}
                  </select>
                </div>
                <div>
                  <label className="font-bold text-slate-300 block mb-1">Berat (Kg)</label>
                  <input
                    type="number"
                    step="0.1"
                    min="0.1"
                    required
                    placeholder="3.0"
                    value={orderForm.weight_kg}
                    onChange={(e) => handleWeightChange(e.target.value)}
                    className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-sky-500 outline-none font-bold"
                  />
                </div>
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="font-bold text-slate-300 block mb-1">Total Tagihan (Rp)</label>
                  <input
                    type="number"
                    required
                    value={orderForm.amount}
                    onChange={(e) => setOrderForm({ ...orderForm, amount: Number(e.target.value) })}
                    className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-cyan-400 focus:ring-2 focus:ring-sky-500 outline-none font-black"
                  />
                  <p className="text-[10px] text-cyan-400 font-bold mt-1">
                    ★ Otomatis: Rp {getServicePricePerKg(orderForm.service_name).toLocaleString('id-ID')}/kg × {orderForm.weight_kg || 0} kg
                  </p>
                </div>
                <div>
                  <label className="font-bold text-slate-300 block mb-1">Metode Pembayaran</label>
                  <select
                    value={orderForm.payment_method}
                    onChange={(e) => setOrderForm({ ...orderForm, payment_method: e.target.value })}
                    className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-sky-500 outline-none"
                  >
                    <option value="QRIS">QRIS Auto Instant</option>
                    <option value="Tunai">Tunai / Cash</option>
                    <option value="Transfer BCA">Transfer BCA</option>
                    <option value="Saldo Membership">Saldo Membership Deposit</option>
                  </select>
                </div>
              </div>

              <div>
                <label className="font-bold text-slate-300 block mb-1">Jenis Pengantaran</label>
                <select
                  value={orderForm.delivery_type}
                  onChange={(e) => setOrderForm({ ...orderForm, delivery_type: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-sky-500 outline-none"
                >
                  <option value="Self Pickup">Ambil Sendiri (Self Pickup)</option>
                  <option value="Courier Delivery">Kurir Pengantaran L-Clean</option>
                </select>
              </div>

              <div>
                <label className="font-bold text-slate-300 block mb-1">Catatan Cucian</label>
                <input
                  type="text"
                  placeholder="Catatan khusus, jenis softener, gantungan, dll."
                  value={orderForm.notes}
                  onChange={(e) => setOrderForm({ ...orderForm, notes: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-sky-500 outline-none"
                />
              </div>

              <div className="pt-3 border-t border-slate-800 flex gap-3">
                <button
                  type="button"
                  onClick={() => setShowNewOrderModal(false)}
                  className="w-1/2 bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-2.5 rounded-xl border border-slate-700"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="w-1/2 bg-sky-600 hover:bg-sky-500 text-white font-bold py-2.5 rounded-xl shadow-md"
                >
                  Simpan Order Baru
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* ========================================================= */}
      {/* MODAL 2: FORM TAMBAH MEMBER BARU */}
      {/* ========================================================= */}
      {showNewCustomerModal && (
        <div className="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4">
          <div className="bg-[#0F172A] border border-slate-800 rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-5 text-slate-100">
            <div className="flex justify-between items-center border-b border-slate-800 pb-3">
              <div className="flex items-center gap-2">
                <Users className="w-5 h-5 text-sky-400" />
                <h3 className="font-extrabold text-white text-base">Tambah Member Pelanggan</h3>
              </div>
              <button onClick={() => setShowNewCustomerModal(false)} className="text-slate-400 hover:text-white">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleCreateCustomer} className="space-y-4 text-xs">
              <div>
                <label className="font-bold text-slate-300 block mb-1">Nama Lengkap</label>
                <input
                  type="text"
                  required
                  placeholder="Contoh: Ibu Ani Wijaya"
                  value={custForm.name}
                  onChange={(e) => setCustForm({ ...custForm, name: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-sky-500 outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-300 block mb-1">No. HP / WhatsApp</label>
                <input
                  type="text"
                  required
                  placeholder="081234567890"
                  value={custForm.phone}
                  onChange={(e) => setCustForm({ ...custForm, phone: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-sky-500 outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-300 block mb-1">Tier Membership</label>
                <select
                  value={custForm.account_type}
                  onChange={(e) => setCustForm({ ...custForm, account_type: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-sky-500 outline-none"
                >
                  <option value="Gold VIP Member">Gold VIP Member</option>
                  <option value="Silver Member">Silver Member</option>
                  <option value="Bronze Member">Bronze Member</option>
                  <option value="Corporate Member">Corporate Member</option>
                </select>
              </div>

              <div>
                <label className="font-bold text-slate-300 block mb-1">Top-Up Saldo Deposit Awal (Rp)</label>
                <input
                  type="number"
                  value={custForm.membership_balance}
                  onChange={(e) => setCustForm({ ...custForm, membership_balance: Number(e.target.value) })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-emerald-400 font-bold focus:ring-2 focus:ring-sky-500 outline-none"
                />
              </div>

              <div className="pt-3 border-t border-slate-800 flex gap-3">
                <button
                  type="button"
                  onClick={() => setShowNewCustomerModal(false)}
                  className="w-1/2 bg-slate-800 text-slate-300 font-bold py-2.5 rounded-xl border border-slate-700"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="w-1/2 bg-sky-600 hover:bg-sky-500 text-white font-bold py-2.5 rounded-xl shadow-md"
                >
                  Simpan Member
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* ========================================================= */}
      {/* MODAL 3: NOTIFIKASI WHATSAPP SIMULATOR */}
      {/* ========================================================= */}
      {showWaModal && waPayload && (
        <div className="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4">
          <div className="bg-[#0F172A] border border-slate-800 rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4 text-slate-100">
            <div className="flex justify-between items-center border-b border-slate-800 pb-3">
              <div className="flex items-center gap-2">
                <Smartphone className="w-5 h-5 text-emerald-400" />
                <h3 className="font-extrabold text-white text-base">Notifikasi WhatsApp Automation</h3>
              </div>
              <button onClick={() => setShowWaModal(false)} className="text-slate-400 hover:text-white">
                <X className="w-5 h-5" />
              </button>
            </div>

            <div className="bg-emerald-500/10 border border-emerald-500/20 p-4 rounded-2xl space-y-2 text-xs">
              <div className="flex items-center justify-between font-bold text-emerald-300">
                <span>Tujuan: {waPayload.phone}</span>
                <span className="text-[10px] bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 px-2 py-0.5 rounded">Auto Gateway</span>
              </div>
              <pre className="whitespace-pre-wrap font-sans text-slate-200 bg-[#0B0F19] p-3 rounded-xl border border-slate-800 text-[11px] leading-relaxed">
                {waPayload.preview_text}
              </pre>
            </div>

            <div className="flex gap-3">
              <button
                onClick={() => setShowWaModal(false)}
                className="w-1/2 bg-slate-800 text-slate-300 font-bold py-2.5 rounded-xl border border-slate-700 text-xs"
              >
                Tutup
              </button>
              <a
                href={waPayload.wa_url}
                target="_blank"
                rel="noreferrer"
                className="w-1/2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 rounded-xl shadow-md text-xs text-center flex items-center justify-center gap-2"
              >
                <ExternalLink className="w-4 h-4" /> Buka WA Web / App
              </a>
            </div>
          </div>
        </div>
      )}

      {/* ========================================================= */}
      {/* MODAL 4: NOTA DIGITAL LAUNDRY (PRINTABLE) */}
      {/* ========================================================= */}
      {showNotaModal && selectedOrderNota && (
        <div className="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4">
          <div className="bg-[#0F172A] border border-slate-800 rounded-3xl max-w-sm w-full p-6 shadow-2xl space-y-4 text-slate-100">
            <div className="flex justify-between items-center border-b border-slate-800 pb-3">
              <span className="text-xs font-extrabold text-cyan-400">NOTA DIGITAL LAUNDRY</span>
              <button onClick={() => setShowNotaModal(false)} className="text-slate-400 hover:text-white">
                <X className="w-5 h-5" />
              </button>
            </div>

            {/* Receipt Content */}
            <div className="border border-slate-800 p-5 rounded-2xl space-y-3 bg-[#0B0F19] font-mono text-[11px] text-slate-200">
              <div className="text-center space-y-1">
                <h4 className="font-extrabold text-sm text-white">{selectedOrderNota.brand_name}</h4>
                <p className="text-[10px] text-slate-400">{selectedOrderNota.tenant}</p>
                <p className="text-[10px] text-slate-500">Tgl: {selectedOrderNota.date}</p>
              </div>

              <div className="border-t border-b border-dashed border-slate-700 py-2 space-y-1">
                <div className="flex justify-between">
                  <span>No. Order:</span>
                  <span className="font-bold text-cyan-400">{selectedOrderNota.order_id}</span>
                </div>
                <div className="flex justify-between">
                  <span>Pelanggan:</span>
                  <span className="font-bold text-white">{selectedOrderNota.customer_name}</span>
                </div>
                <div className="flex justify-between">
                  <span>No. WA:</span>
                  <span>{selectedOrderNota.phone}</span>
                </div>
              </div>

              <div className="space-y-1">
                <p className="font-bold text-slate-200">{selectedOrderNota.service_name}</p>
                <div className="flex justify-between text-slate-400">
                  <span>Jumlah: {selectedOrderNota.weight_items}</span>
                  <span className="font-bold text-white">{selectedOrderNota.amount}</span>
                </div>
              </div>

              <div className="border-t border-dashed border-slate-700 pt-2 space-y-1">
                <div className="flex justify-between">
                  <span>Metode Bayar:</span>
                  <span className="font-bold text-white">{selectedOrderNota.payment_method}</span>
                </div>
                <div className="flex justify-between">
                  <span>Status Cucian:</span>
                  <span className="font-bold text-emerald-400">{selectedOrderNota.stage}</span>
                </div>
                <div className="flex justify-between">
                  <span>Operator:</span>
                  <span>{selectedOrderNota.operator}</span>
                </div>
              </div>

              <div className="text-center pt-2 text-[9px] text-slate-500 border-t border-slate-800">
                Terima Kasih Atas Kepercayaan Anda!<br />L-Clean Multi-Tenant SaaS Platform
              </div>
            </div>

            <div className="flex gap-3">
              <button
                onClick={() => {
                  window.print();
                }}
                className="w-full bg-gradient-to-r from-sky-500 to-indigo-600 text-white font-bold py-2.5 rounded-xl text-xs flex items-center justify-center gap-2 shadow-lg shadow-sky-500/20"
              >
                <Printer className="w-4 h-4" /> Cetak Nota Digital
              </button>
            </div>
          </div>
        </div>
      )}

      {/* ========================================================= */}
      {/* MODAL: FORM TAMBAH LAYANAN & TARIF BARU */}
      {/* ========================================================= */}
      {showNewServiceModal && (
        <div className="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4">
          <div className="bg-[#0F172A] border border-slate-800 rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-5 text-slate-100">
            <div className="flex justify-between items-center border-b border-slate-800 pb-3">
              <div className="flex items-center gap-2">
                <DollarSign className="w-5 h-5 text-cyan-400" />
                <h3 className="font-extrabold text-white text-base">Tambah Layanan & Tarif Baru</h3>
              </div>
              <button onClick={() => setShowNewServiceModal(false)} className="text-slate-400 hover:text-white">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleCreateService} className="space-y-4 text-xs">
              <div>
                <label className="font-bold text-slate-300 block mb-1">Nama Layanan Laundry</label>
                <input
                  type="text"
                  required
                  placeholder="Contoh: Cuci Karpet Premium / Deep Clean Shoes"
                  value={serviceForm.name}
                  onChange={(e) => setServiceForm({ ...serviceForm, name: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3.5 py-2 text-white focus:ring-2 focus:ring-cyan-500 outline-none"
                />
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="font-bold text-slate-300 block mb-1">Kategori / Tier</label>
                  <select
                    value={serviceForm.tier}
                    onChange={(e) => setServiceForm({ ...serviceForm, tier: e.target.value })}
                    className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-cyan-500 outline-none"
                  >
                    <option value="Express 6 Jam">Express 6 Jam</option>
                    <option value="Reguler 24 Jam">Reguler 24 Jam</option>
                    <option value="Dry Clean Special">Dry Clean Special</option>
                    <option value="Bed Cover & Heavy">Bed Cover & Heavy</option>
                    <option value="Shoes & Bag Care">Shoes & Bag Care</option>
                  </select>
                </div>

                <div>
                  <label className="font-bold text-slate-300 block mb-1">Satuan Tarif</label>
                  <select
                    value={serviceForm.unit}
                    onChange={(e) => setServiceForm({ ...serviceForm, unit: e.target.value })}
                    className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-cyan-500 outline-none"
                  >
                    <option value="kg">Per Kilo (kg)</option>
                    <option value="pcs">Per Pcs / Satuan</option>
                    <option value="pasang">Per Pasang (Sepatu)</option>
                    <option value="set">Per Set</option>
                  </select>
                </div>
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="font-bold text-slate-300 block mb-1">Harga (Rp)</label>
                  <input
                    type="number"
                    required
                    placeholder="15000"
                    value={serviceForm.price_amount}
                    onChange={(e) => setServiceForm({ ...serviceForm, price_amount: Number(e.target.value) })}
                    className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-cyan-400 font-bold focus:ring-2 focus:ring-cyan-500 outline-none"
                  />
                </div>

                <div>
                  <label className="font-bold text-slate-300 block mb-1">Minimum Order Batch</label>
                  <input
                    type="text"
                    placeholder="Contoh: 3 kg / 1 pcs"
                    value={serviceForm.minimum_batch}
                    onChange={(e) => setServiceForm({ ...serviceForm, minimum_batch: e.target.value })}
                    className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-cyan-500 outline-none"
                  />
                </div>
              </div>

              <div>
                <label className="font-bold text-slate-300 block mb-1">Spesifikasi Peralatan / Deterjen</label>
                <input
                  type="text"
                  placeholder="Deterjen Premium + Softener + Setrika Uap"
                  value={serviceForm.hardware_spec}
                  onChange={(e) => setServiceForm({ ...serviceForm, hardware_spec: e.target.value })}
                  className="w-full bg-[#0B0F19] border border-slate-800 rounded-xl px-3 py-2 text-white focus:ring-2 focus:ring-cyan-500 outline-none"
                />
              </div>

              <div className="pt-3 border-t border-slate-800 flex gap-3">
                <button
                  type="button"
                  onClick={() => setShowNewServiceModal(false)}
                  className="w-1/2 bg-slate-800 text-slate-300 font-bold py-2.5 rounded-xl border border-slate-700"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="w-1/2 bg-gradient-to-r from-sky-500 to-cyan-500 hover:from-sky-400 hover:to-cyan-400 text-white font-extrabold py-2.5 rounded-xl shadow-lg transition-all"
                >
                  Simpan Layanan Baru
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}
