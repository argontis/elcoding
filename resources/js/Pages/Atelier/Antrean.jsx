import React, { useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import {
  LayoutGrid, Calendar, Users, Award, Scissors, ShoppingBag,
  Percent, Bell, MessageSquare, Settings, Search, Plus, CheckCircle,
  Clock, ArrowUpRight, ChevronRight, X, User, CreditCard, ChevronDown,
  Sparkles, Check, DollarSign, RefreshCw, BarChart2, Filter,
  Phone, AlertCircle, Eye, Printer, Trash2, CalendarX, CheckCircle2,
  ChevronLeft, Send, AlertTriangle, Tv, Volume2, Play, Pause, FastForward,
  RotateCcw, GripVertical, Radio, Sparkle, MessageCircle, UserPlus, Armchair
} from 'lucide-react';

export default function AtelierAntrean({ auth }) {
  const user = auth?.user || { name: 'Mario Alfarizi', email: 'admin@lstyle.id', role: 'Owner / Manager' };

  // ==========================================
  // STATE MANAGEMENT
  // ==========================================
  // Mode data: 'kosong' (Default - empty for user to input) vs 'demo' (Pre-populated sample data)
  const [dataMode, setDataMode] = useState('kosong');
  const [searchQuery, setSearchQuery] = useState('');
  const [toastMessage, setToastMessage] = useState(null);

  // Broadcast text input state
  const [broadcastText, setBroadcastText] = useState('');

  // Modals state
  const [showAddWalkInModal, setShowAddWalkInModal] = useState(false);
  const [showTvModal, setShowTvModal] = useState(false);
  const [selectedStation, setSelectedStation] = useState(null);

  // Notifications & User Menu
  const [showNotificationDrawer, setShowNotificationDrawer] = useState(false);
  const [showUserMenu, setShowUserMenu] = useState(false);

  // Toast Notification helper
  const showToast = (msg) => {
    setToastMessage(msg);
    setTimeout(() => setToastMessage(null), 4000);
  };

  // Text to speech helper simulation
  const triggerAudioCall = (text) => {
    showToast(`📢 Audio Broadcast: "${text}"`);
    if ('speechSynthesis' in window) {
      try {
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'id-ID';
        utterance.rate = 0.95;
        window.speechSynthesis.speak(utterance);
      } catch (e) {
        console.log('Speech synthesis not supported');
      }
    }
  };

  // ==========================================
  // DEMO VS EMPTY DATA SETS
  // ==========================================
  const demoData = {
    stats: {
      antreanMenunggu: 5,
      antreanMenungguSub: '⚡ 2 Tamu VIP di Priority Lounge',
      waktuTungguAvg: '14',
      waktuTungguUnit: 'Menit',
      waktuTungguSub: 'Target optimal < 20 menit per tamu',
      kursiAktifCount: 4,
      kursiTotalCount: 6,
      kursiUtilitas: '67% Utilitas',
      tamuSelesaiCount: 19,
      tamuSelesaiSub: '📈 +4 dibanding kemarin jam yang sama'
    },
    liveFocus: {
      antreanNo: 'A-015',
      chairNo: 'CHAIR 02',
      stationName: 'STASIUN 02 (VIP SUITE)',
      startTime: 'Dimulai 14:15 WIB',
      nama: 'Dimas Pratama',
      phone: '0812-9988-8219',
      kunjungan: 'Kunjungan ke-14',
      tier: '⭐ Gold VIP Member',
      layanan: 'Gentleman Royal Cut & Beard Sculpting',
      stylist: 'Reza Pratama',
      progressPercent: 65,
      estSelesaiTime: '14:55 WIB',
      sisaMenit: 15,
      nextAntreanNo: 'A-016'
    },
    stations: [
      {
        id: '01',
        name: 'Master Chair 1',
        badge: 'Terisi',
        badgeClass: 'bg-amber-100 text-amber-900 border-amber-300',
        stylist: 'Barber David Gunawan',
        activeItem: { antreanNo: 'A-014', nama: 'Rendy Wijaya', service: 'Executive Fade & Beard Trim', sisaTime: 'Sisa 5 m', progressPercent: 85 }
      },
      {
        id: '02',
        name: 'VIP Suite Chair',
        badge: 'Sedang Aktif',
        badgeClass: 'bg-amber-500 text-slate-950 font-bold',
        isMainFocus: true,
        stylist: 'Reza Pratama',
        activeItem: { antreanNo: 'A-015', nama: 'Dimas Pratama', service: 'Royal Cut & Beard Sculpting', sisaTime: 'Sisa 15 m', progressPercent: 65 }
      },
      {
        id: '03',
        name: 'Atelier Chair 3',
        badge: 'Terisi',
        badgeClass: 'bg-amber-100 text-amber-900 border-amber-300',
        stylist: 'Stylist Elena Rose',
        activeItem: { antreanNo: 'A-013', nama: 'Siska Amelia', service: 'Organic Hair Glossing & Blow', sisaTime: 'Sisa 25 m', progressPercent: 40 }
      },
      {
        id: '04',
        name: 'Grooming Station 4',
        badge: 'Terisi',
        badgeClass: 'bg-amber-100 text-amber-900 border-amber-300',
        stylist: 'Barber Dimas S.',
        activeItem: { antreanNo: 'B-008', nama: 'Anton Hartono', service: 'Signature Clean Shave + Wash', sisaTime: 'Sisa 10 m', progressPercent: 70 }
      },
      {
        id: '05',
        name: 'Styling Chair 5',
        badge: 'STANDBY',
        badgeClass: 'bg-slate-100 text-slate-700 border-slate-300',
        stylist: 'Junior Stylist Tariq',
        activeItem: null,
        standbyTitle: 'Kursi Bersih & Siap Tamu',
        standbySub: 'Kapasitas kosong',
        actionLabel: '+ Isi Tamu Antrean'
      },
      {
        id: '06',
        name: 'Wash & Spa Basin 6',
        badge: 'KOSONG',
        badgeClass: 'bg-slate-100 text-slate-500 border-slate-200',
        stylist: 'Apprentice On Duty',
        activeItem: null,
        standbyTitle: 'Sanitasi & Sterilisasi Alat',
        standbySub: 'Siap dalam 3 menit',
        actionLabel: '+ Siapkan Meja Layanan'
      }
    ],
    queueList: [
      {
        id: 'A-016',
        nama: 'Bagus Wicaksono',
        badgeType: 'Di Lounge',
        badgeClass: 'bg-amber-100 text-amber-900',
        layanan: 'Classic Pompadour Haircut & Head Massage',
        stylist: 'Barber David Gunawan',
        estTime: 'Estimasi: 15:00 WIB',
        hasStartButton: true
      },
      {
        id: 'A-017',
        nama: 'Nadia Salsabila',
        badgeType: 'WA Check-in',
        badgeClass: 'bg-slate-100 text-slate-700 border border-slate-200',
        layanan: 'Keratin Blowout & Hair Spa Botanical',
        stylist: 'Elena Rose',
        estTime: 'Estimasi: 15:30 WIB',
        hasWaIcon: true
      },
      {
        id: 'A-018',
        nama: 'Rifqi Ramadhan',
        badgeType: 'Menunggu',
        badgeClass: 'bg-slate-100 text-slate-600',
        layanan: 'Clean Shave & Facial Mask Therapy',
        stylist: 'Master Barber Reza',
        estTime: 'Estimasi: 16:00 WIB'
      },
      {
        id: 'A-019',
        nama: 'Hendra Kusuma',
        badgeType: 'Booking Online',
        badgeClass: 'bg-purple-50 text-purple-700 border border-purple-200',
        layanan: 'Signature Haircut & Wash + Tonic',
        stylist: 'Barber Dimas',
        estTime: 'Estimasi: 16:15 WIB'
      },
      {
        id: 'A-020',
        nama: 'Kevin Wijaya',
        badgeType: 'Walk-in',
        badgeClass: 'bg-slate-100 text-slate-700',
        layanan: 'Scalp Detox Ritual Aromatherapy',
        stylist: 'Elena Rose',
        estTime: 'Estimasi: 16:45 WIB'
      }
    ]
  };

  const emptyData = {
    stats: {
      antreanMenunggu: 0,
      antreanMenungguSub: 'Tidak ada tamu di lounge',
      waktuTungguAvg: '0',
      waktuTungguUnit: 'Menit',
      waktuTungguSub: 'Layanan berjalan lancar',
      kursiAktifCount: 0,
      kursiTotalCount: 6,
      kursiUtilitas: '0% Utilitas',
      tamuSelesaiCount: 0,
      tamuSelesaiSub: 'Target harian: 25 tamu'
    },
    liveFocus: null,
    stations: [
      { id: '01', name: 'Master Chair 1', badge: 'STANDBY', badgeClass: 'bg-slate-100 text-slate-700 border-slate-300', stylist: 'Barber David Gunawan', activeItem: null, standbyTitle: 'Kursi Bersih & Siap Tamu', standbySub: 'Kapasitas kosong', actionLabel: '+ Isi Tamu Antrean' },
      { id: '02', name: 'VIP Suite Chair', badge: 'STANDBY', badgeClass: 'bg-slate-100 text-slate-700 border-slate-300', stylist: 'Reza Pratama', activeItem: null, standbyTitle: 'Kursi Bersih & Siap Tamu', standbySub: 'VIP Lounge Siap', actionLabel: '+ Isi Tamu Antrean' },
      { id: '03', name: 'Atelier Chair 3', badge: 'STANDBY', badgeClass: 'bg-slate-100 text-slate-700 border-slate-300', stylist: 'Stylist Elena Rose', activeItem: null, standbyTitle: 'Kursi Bersih & Siap Tamu', standbySub: 'Kapasitas kosong', actionLabel: '+ Isi Tamu Antrean' },
      { id: '04', name: 'Grooming Station 4', badge: 'STANDBY', badgeClass: 'bg-slate-100 text-slate-700 border-slate-300', stylist: 'Barber Dimas S.', activeItem: null, standbyTitle: 'Kursi Bersih & Siap Tamu', standbySub: 'Kapasitas kosong', actionLabel: '+ Isi Tamu Antrean' },
      { id: '05', name: 'Styling Chair 5', badge: 'STANDBY', badgeClass: 'bg-slate-100 text-slate-700 border-slate-300', stylist: 'Junior Stylist Tariq', activeItem: null, standbyTitle: 'Kursi Bersih & Siap Tamu', standbySub: 'Kapasitas kosong', actionLabel: '+ Isi Tamu Antrean' },
      { id: '06', name: 'Wash & Spa Basin 6', badge: 'STANDBY', badgeClass: 'bg-slate-100 text-slate-700 border-slate-300', stylist: 'Apprentice On Duty', activeItem: null, standbyTitle: 'Sanitasi & Sterilisasi Alat', standbySub: 'Siap pakai', actionLabel: '+ Siapkan Meja Layanan' }
    ],
    queueList: []
  };

  // Dynamic Data State
  const [currentData, setCurrentData] = useState(emptyData);

  // Sync state when dataMode switches
  useEffect(() => {
    if (dataMode === 'demo') {
      setCurrentData(demoData);
    } else {
      setCurrentData(emptyData);
    }
  }, [dataMode]);

  // Form State for Walk-in Modal
  const [walkInForm, setWalkInForm] = useState({
    nama: '',
    phone: '',
    layanan: 'Gentleman Royal Cut & Beard Sculpting',
    stylist: 'Barber Reza Pratama',
    isVip: false
  });

  const handleAddWalkIn = (e) => {
    e.preventDefault();
    if (!walkInForm.nama) return;

    const nextId = `A-${sprintf('%03d', currentData.queueList.length + 16)}`;
    const newQueueItem = {
      id: nextId,
      nama: walkInForm.nama,
      badgeType: walkInForm.isVip ? 'VIP Walk-in' : 'Walk-in',
      badgeClass: walkInForm.isVip ? 'bg-amber-100 text-amber-900 border border-amber-300 font-bold' : 'bg-slate-100 text-slate-700',
      layanan: walkInForm.layanan,
      stylist: walkInForm.stylist,
      estTime: 'Estimasi: 15:15 WIB',
      hasStartButton: currentData.queueList.length === 0
    };

    const updatedQueue = [...currentData.queueList, newQueueItem];
    const newMenunggu = currentData.stats.antreanMenunggu + 1;

    setCurrentData(prev => ({
      ...prev,
      stats: {
        ...prev.stats,
        antreanMenunggu: newMenunggu,
        antreanMenungguSub: `${newMenunggu} Tamu menunggu di lounge`
      },
      queueList: updatedQueue
    }));

    setShowAddWalkInModal(false);
    showToast(`Antrean ${newQueueItem.id} (${newQueueItem.nama}) berhasil ditambahkan ke antrean live!`);
    triggerAudioCall(`Nomor antrean ${newQueueItem.id}, saudara ${newQueueItem.nama}, telah terdaftar.`);
  };

  const handleFinishLiveSession = () => {
    if (!currentData.liveFocus) return;
    const finishedName = currentData.liveFocus.nama;
    
    // Promote next from queue
    if (currentData.queueList.length > 0) {
      const nextItem = currentData.queueList[0];
      const remainingQueue = currentData.queueList.slice(1);

      setCurrentData(prev => ({
        ...prev,
        stats: {
          ...prev.stats,
          antreanMenunggu: Math.max(0, prev.stats.antreanMenunggu - 1),
          tamuSelesaiCount: prev.stats.tamuSelesaiCount + 1
        },
        liveFocus: {
          antreanNo: nextItem.id,
          chairNo: 'CHAIR 02',
          stationName: 'STASIUN 02 (VIP SUITE)',
          startTime: 'Dimulai Baru Saja',
          nama: nextItem.nama,
          phone: '0812-xxxx-xxxx',
          kunjungan: 'Tamu Antrean',
          tier: nextItem.badgeType,
          layanan: nextItem.layanan,
          stylist: nextItem.stylist,
          progressPercent: 5,
          estSelesaiTime: '15:30 WIB',
          sisaMenit: 45,
          nextAntreanNo: remainingQueue[0]?.id || '-'
        },
        queueList: remainingQueue
      }));
      showToast(`Sesi treatment ${finishedName} selesai! Memulai sesi untuk ${nextItem.nama}`);
      triggerAudioCall(`Panggilan untuk nomor antrean ${nextItem.id}, saudara ${nextItem.nama}, silakan menuju Stasiun VIP Suite.`);
    } else {
      setCurrentData(prev => ({
        ...prev,
        stats: {
          ...prev.stats,
          tamuSelesaiCount: prev.stats.tamuSelesaiCount + 1
        },
        liveFocus: null
      }));
      showToast(`Sesi treatment ${finishedName} selesai! Stasiun VIP Suite sekarang kosong.`);
    }
  };

  const handleBroadcast = (e) => {
    e.preventDefault();
    if (!broadcastText) return;
    triggerAudioCall(broadcastText);
    setBroadcastText('');
  };

  const sprintf = (str, len) => {
    return String(str).padStart(len, '0');
  };

  const handleLogout = () => {
    router.post('/logout');
  };

  return (
    <div className="min-h-screen bg-[#F4F5F7] font-sans text-slate-800 flex flex-col md:flex-row">
      <Head title="Manajemen Antrean Live & Display TV - L-Style ATELIER SUITE" />

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
                className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-slate-900 text-white shadow-sm font-semibold transition-all"
              >
                <Clock className="w-4 h-4 text-white" />
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
                <span>LIVE TELEMETRY & FLOOR CONTROL</span>
              </p>
              <h2 className="text-2xl font-black text-slate-900 tracking-tight">Manajemen Antrean Live & Display TV</h2>
              <p className="text-xs text-slate-500 font-medium mt-0.5">
                Monitoring antrean salon real-time, panggilan suara otomatis, dan status stasiun kursi atelier secara terpadu.
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

              {/* Mode Layar TV Pelanggan */}
              <button
                onClick={() => setShowTvModal(true)}
                className="px-4 py-2 bg-white hover:bg-slate-50 text-slate-800 rounded-xl text-xs font-bold transition-all border border-slate-200 shadow-xs flex items-center gap-2"
              >
                <Tv className="w-4 h-4 text-slate-600" />
                <span>Mode Layar TV Pelanggan</span>
                <span className="text-[9px] font-bold px-1.5 py-0.5 rounded bg-slate-100 text-slate-600">Dual HD</span>
              </button>

              {/* + Tambah Antrean Walk-in */}
              <button
                onClick={() => setShowAddWalkInModal(true)}
                className="px-4 py-2 bg-slate-950 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-md flex items-center gap-2"
              >
                <Plus className="w-4 h-4" />
                <span>+ Tambah Antrean Walk-in</span>
              </button>
            </div>
          </div>

          {/* Top 4 Summary Cards Grid */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {/* Stat 1: TOTAL ANTREAN MENUNGGU */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">TOTAL ANTREAN MENUNGGU</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.antreanMenunggu} <span className="text-xs font-medium text-slate-400">Pelanggan</span></h3>
                <p className="text-[11px] font-semibold text-amber-700 mt-0.5">{currentData.stats.antreanMenungguSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <Users className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 2: WAKTU TUNGGU RATA-RATA */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">WAKTU TUNGGU RATA-RATA</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.waktuTungguAvg} <span className="text-xs font-medium text-slate-400">{currentData.stats.waktuTungguUnit}</span></h3>
                <p className="text-[11px] text-slate-500 font-medium mt-0.5">{currentData.stats.waktuTungguSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <Clock className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 3: KURSI AKTIF / TERISI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">KURSI AKTIF / TERISI</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.kursiAktifCount} / {currentData.stats.kursiTotalCount} <span className="text-xs font-bold text-amber-700">({currentData.stats.kursiUtilitas})</span></h3>
                <div className="w-full bg-slate-100 rounded-full h-1.5 mt-1.5">
                  <div className="bg-amber-600 h-1.5 rounded-full" style={{ width: currentData.stats.kursiUtilitas.includes('67%') ? '67%' : '0%' }}></div>
                </div>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <Armchair className="w-5 h-5" />
              </div>
            </div>

            {/* Stat 4: TAMU SELESAI HARI INI */}
            <div className="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
              <div>
                <p className="text-[10px] font-bold uppercase tracking-wider text-slate-400">TAMU SELESAI HARI INI</p>
                <h3 className="text-3xl font-black text-slate-900 mt-1">{currentData.stats.tamuSelesaiCount} <span className="text-xs font-medium text-slate-400">Tamu</span></h3>
                <p className="text-[11px] font-semibold text-emerald-600 mt-0.5">{currentData.stats.tamuSelesaiSub}</p>
              </div>
              <div className="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                <CheckCircle className="w-5 h-5" />
              </div>
            </div>
          </div>

          {/* MAIN WORKSPACE 2-COLUMN LAYOUT */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {/* LEFT 2 COLS: Live Focus Banner & Stasiun Kursi Grid */}
            <div className="lg:col-span-2 space-y-6">

              {/* SEDANG DILAYANI • LIVE FOCUS CARD */}
              <div className="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
                <div className="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-3">
                  <div className="flex items-center gap-2">
                    <span className="w-2.5 h-2.5 rounded-full bg-amber-500 animate-ping"></span>
                    <span className="font-extrabold text-slate-900 text-sm uppercase tracking-wider">SEDANG DILAYANI • LIVE FOCUS</span>
                    <span className="text-xs text-slate-400 font-medium">• {currentData.liveFocus ? currentData.liveFocus.stationName : 'TIDAK ADA SESI AKTIF'}</span>
                  </div>
                  <span className="text-xs font-semibold text-slate-400">{currentData.liveFocus?.startTime || 'Siap Memulai Sesi'}</span>
                </div>

                {currentData.liveFocus ? (
                  <div className="space-y-4">
                    {/* Live Focus Card Body */}
                    <div className="bg-slate-50 border border-slate-200/80 rounded-2xl p-5 flex flex-wrap md:flex-nowrap items-center gap-5">
                      {/* Left Big Badge */}
                      <div className="w-full md:w-40 p-4 rounded-2xl bg-slate-950 text-white text-center shadow-lg shrink-0 flex flex-col justify-center">
                        <span className="text-[9px] font-bold uppercase tracking-widest text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded border border-amber-500/20 inline-block mb-1">
                          PRIORITY
                        </span>
                        <p className="text-[10px] text-slate-400 font-semibold tracking-wider">NOMOR ANTREAN</p>
                        <h2 className="text-3xl font-black text-amber-400 my-0.5 tracking-tight">{currentData.liveFocus.antreanNo}</h2>
                        <p className="text-[10px] font-mono text-slate-400 uppercase">{currentData.liveFocus.chairNo}</p>
                      </div>

                      {/* Right Details */}
                      <div className="flex-1 space-y-3">
                        <div>
                          <div className="flex items-center gap-2">
                            <h3 className="font-black text-slate-900 text-lg leading-tight">{currentData.liveFocus.nama}</h3>
                            <span className="px-2 py-0.5 bg-amber-100 text-amber-900 text-[10px] font-bold rounded border border-amber-200">
                              {currentData.liveFocus.tier}
                            </span>
                          </div>
                          <p className="text-xs text-slate-500 font-mono mt-0.5">
                            {currentData.liveFocus.phone} • {currentData.liveFocus.kunjungan}
                          </p>
                        </div>

                        <div className="grid grid-cols-2 gap-3 text-xs bg-white p-3 rounded-xl border border-slate-200/60">
                          <div>
                            <p className="text-[9px] font-bold text-slate-400 uppercase tracking-wider">TREATMENT</p>
                            <p className="font-bold text-slate-900 text-xs mt-0.5">{currentData.liveFocus.layanan}</p>
                          </div>
                          <div>
                            <p className="text-[9px] font-bold text-slate-400 uppercase tracking-wider">MASTER STYLIST</p>
                            <p className="font-bold text-slate-900 text-xs mt-0.5 flex items-center gap-1">
                              <Scissors className="w-3.5 h-3.5 text-amber-600" />
                              <span>{currentData.liveFocus.stylist}</span>
                            </p>
                          </div>
                        </div>

                        {/* Progress Bar */}
                        <div className="space-y-1">
                          <div className="w-full bg-slate-200 rounded-full h-2">
                            <div className="bg-amber-500 h-2 rounded-full" style={{ width: `${currentData.liveFocus.progressPercent}%` }}></div>
                          </div>
                          <div className="flex justify-between text-[10px] font-semibold">
                            <span className="text-slate-600">Progress Treatment: {currentData.liveFocus.progressPercent}% Selesai</span>
                            <span className="text-amber-700">Estimasi {currentData.liveFocus.estSelesaiTime} (Sisa {currentData.liveFocus.sisaMenit} Menit)</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    {/* Action Bar Below Live Focus Card */}
                    <div className="flex flex-wrap items-center gap-2 pt-1">
                      <button
                        onClick={() => {
                          const nextNo = currentData.queueList[0]?.id || 'A-016';
                          triggerAudioCall(`Panggilan untuk nomor antrean ${nextNo}, silakan menuju Stasiun VIP Suite.`);
                        }}
                        className="flex-1 py-3 px-4 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-2xl text-xs shadow-md transition-all flex items-center justify-center gap-2"
                      >
                        <Volume2 className="w-4 h-4 text-amber-400 animate-pulse" />
                        <span>Panggil Antrean Berikutnya ({currentData.liveFocus.nextAntreanNo})</span>
                      </button>

                      <button
                        onClick={handleFinishLiveSession}
                        className="py-3 px-5 bg-emerald-50 hover:bg-emerald-100 text-emerald-900 font-bold rounded-2xl text-xs transition-all border border-emerald-200 flex items-center justify-center gap-1.5"
                      >
                        <Check className="w-4 h-4 text-emerald-600" />
                        <span>Selesaikan</span>
                      </button>

                      <button
                        onClick={() => showToast('Sesi treatment di-pause sementara')}
                        className="p-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-2xl text-xs border border-slate-200"
                        title="Pause / Hold Sesi"
                      >
                        <Pause className="w-4 h-4" />
                      </button>

                      <button
                        onClick={() => showToast('Membuka modal alihkan stasiun kursi')}
                        className="p-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-2xl text-xs border border-slate-200"
                        title="Alihkan Stasiun"
                      >
                        <RotateCcw className="w-4 h-4" />
                      </button>
                    </div>
                  </div>
                ) : (
                  <div className="py-12 text-center text-slate-400 space-y-3 bg-slate-50/60 rounded-2xl border border-dashed border-slate-200">
                    <Clock className="w-10 h-10 mx-auto text-slate-300" />
                    <p className="text-sm font-semibold">Tidak ada sesi treatment live di VIP Suite saat ini.</p>
                    <button
                      onClick={() => setShowAddWalkInModal(true)}
                      className="px-4 py-2 bg-amber-500 text-slate-950 text-xs font-bold rounded-xl shadow-xs transition-all"
                    >
                      + Panggil Antrean Pertama
                    </button>
                  </div>
                )}
              </div>

              {/* STASIUN KURSI BARBER & STYLIST (GRID OF 6 STATIONS) */}
              <div className="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
                <div className="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-3">
                  <div>
                    <h3 className="font-extrabold text-slate-900 text-base">Stasiun Kursi Barber & Stylist</h3>
                    <p className="text-xs text-slate-500 font-medium">Klik kartu stasiun untuk intervensi kursi</p>
                  </div>
                  <span className="px-3 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded-xl">
                    6 Total Stasiun
                  </span>
                </div>

                {/* 6 Stations Grid */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                  {currentData.stations.map((st) => (
                    <div
                      key={st.id}
                      onClick={() => setSelectedStation(st)}
                      className={`p-4 rounded-2xl border transition-all space-y-3 cursor-pointer ${
                        st.isMainFocus
                          ? 'bg-amber-50/50 border-amber-500 ring-2 ring-amber-500/40 shadow-sm'
                          : st.activeItem
                          ? 'bg-white border-slate-200/80 hover:bg-slate-50'
                          : 'bg-slate-50/50 border-slate-200/60 hover:bg-slate-50'
                      }`}
                    >
                      <div className="flex items-center justify-between">
                        <div className="flex items-center gap-1.5">
                          <span className="text-[10px] font-bold text-slate-400 font-mono">#{st.id}</span>
                          <h4 className="font-bold text-slate-900 text-xs">{st.name}</h4>
                        </div>
                        <span className={`text-[9px] px-2 py-0.5 rounded border ${st.badgeClass}`}>
                          {st.badge}
                        </span>
                      </div>

                      <p className="text-[11px] text-slate-500 font-medium leading-tight">{st.stylist}</p>

                      {st.activeItem ? (
                        <div className="space-y-2 bg-slate-50 p-2.5 rounded-xl border border-slate-200/60">
                          <div className="flex items-center justify-between text-xs">
                            <span className="font-extrabold text-slate-900 text-[11px]">{st.activeItem.antreanNo} • {st.activeItem.nama}</span>
                            <span className="text-[10px] font-bold text-amber-700">{st.activeItem.sisaTime}</span>
                          </div>
                          <p className="text-[10px] text-slate-600 line-clamp-1">{st.activeItem.service}</p>

                          <div className="space-y-1 pt-1">
                            <div className="w-full bg-slate-200 rounded-full h-1.5">
                              <div className="bg-amber-500 h-1.5 rounded-full" style={{ width: `${st.activeItem.progressPercent}%` }}></div>
                            </div>
                            <div className="flex justify-between text-[9px] text-slate-500 font-semibold">
                              <span>Progress ({st.activeItem.progressPercent}%)</span>
                              <span className="text-amber-700 font-bold">{st.isMainFocus ? 'Fokus Utama' : 'Kelola'}</span>
                            </div>
                          </div>
                        </div>
                      ) : (
                        <div className="py-3 text-center space-y-2">
                          <Armchair className="w-6 h-6 mx-auto text-slate-300" />
                          <div>
                            <p className="text-xs font-bold text-slate-800">{st.standbyTitle}</p>
                            <p className="text-[10px] text-slate-400">{st.standbySub}</p>
                          </div>
                          <button
                            onClick={(e) => { e.stopPropagation(); setShowAddWalkInModal(true); }}
                            className="w-full py-1.5 bg-white hover:bg-slate-100 text-slate-800 text-[10px] font-bold rounded-xl border border-slate-200 transition-all"
                          >
                            {st.actionLabel}
                          </button>
                        </div>
                      )}
                    </div>
                  ))}
                </div>
              </div>

            </div>

            {/* RIGHT 1 COL: Urutan Antrean Queue List & Audio Broadcast */}
            <div className="space-y-6">

              {/* URUTAN ANTREAN QUEUE LIST */}
              <div className="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
                <div className="flex items-center justify-between border-b border-slate-100 pb-3">
                  <div className="flex items-center gap-2">
                    <span className="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <h3 className="font-extrabold text-slate-900 text-base">Urutan Antrean</h3>
                    <span className="px-2 py-0.5 bg-amber-100 text-amber-900 text-[10px] font-bold rounded">
                      {currentData.queueList.length} Antre
                    </span>
                  </div>
                  <span className="text-[10px] text-slate-400 font-medium flex items-center gap-1">
                    <RefreshCw className="w-3 h-3 text-slate-400" />
                    <span>Auto-sync (15s)</span>
                  </span>
                </div>

                <p className="text-[11px] text-slate-500 font-medium">
                  Geser kartu untuk mengubah prioritas layanan tamu atau panggil melalui audio lounge.
                </p>

                {/* Queue Items */}
                <div className="space-y-3">
                  {currentData.queueList.length > 0 ? (
                    currentData.queueList.map((item, index) => (
                      <div key={item.id} className="p-3.5 bg-slate-50 border border-slate-200/80 rounded-2xl space-y-2.5">
                        <div className="flex items-center justify-between">
                          <div className="flex items-center gap-2">
                            <GripVertical className="w-3.5 h-3.5 text-slate-300 cursor-grab" />
                            <span className="w-5 h-5 rounded-full bg-slate-200 text-slate-700 text-[10px] font-bold flex items-center justify-center">
                              {index + 1}
                            </span>
                            <span className="font-black text-slate-900 text-xs">{item.id}</span>
                            <span className="font-extrabold text-slate-900 text-xs">{item.nama}</span>
                          </div>
                          <span className={`text-[9px] px-2 py-0.5 rounded ${item.badgeClass}`}>
                            {item.badgeType}
                          </span>
                        </div>

                        <div className="pl-7 space-y-1">
                          <p className="text-[11px] text-slate-600 font-medium leading-tight">{item.layanan}</p>
                          <p className="text-[10px] text-slate-400">
                            Stylist: {item.stylist} • <span className="text-amber-700 font-semibold">{item.estTime}</span>
                          </p>

                          <div className="flex items-center gap-2 pt-2">
                            <button
                              onClick={() => triggerAudioCall(`Panggilan untuk nomor antrean ${item.id}, saudara ${item.nama}, silakan bersiap.`)}
                              className="px-3 py-1.5 bg-white hover:bg-slate-100 text-slate-800 text-[11px] font-bold rounded-xl border border-slate-200 transition-all flex items-center gap-1.5 shadow-xs"
                            >
                              <Volume2 className="w-3 h-3 text-slate-600" />
                              <span>Panggil Suara</span>
                            </button>

                            {item.hasStartButton && (
                              <button
                                onClick={handleFinishLiveSession}
                                className="px-3 py-1.5 bg-slate-950 hover:bg-slate-800 text-white text-[11px] font-bold rounded-xl transition-all shadow-xs flex items-center gap-1"
                              >
                                <Play className="w-3 h-3 text-amber-400" />
                                <span>Mulai Layanan</span>
                              </button>
                            )}

                            {item.hasWaIcon && (
                              <button
                                onClick={() => showToast(`Membuka WhatsApp ke ${item.nama}`)}
                                className="p-1.5 bg-white text-slate-600 hover:bg-slate-100 rounded-xl border border-slate-200"
                              >
                                <MessageSquare className="w-3.5 h-3.5" />
                              </button>
                            )}
                          </div>
                        </div>
                      </div>
                    ))
                  ) : (
                    <div className="py-12 text-center text-slate-400 space-y-2 border border-dashed border-slate-200 rounded-2xl">
                      <Clock className="w-8 h-8 mx-auto text-slate-300" />
                      <p className="text-xs font-semibold">Tidak ada antrean menunggu di lounge.</p>
                      <button
                        onClick={() => setShowAddWalkInModal(true)}
                        className="px-3.5 py-1.5 bg-amber-500 text-slate-950 text-xs font-bold rounded-xl shadow-xs transition-all"
                      >
                        + Tambah Walk-in
                      </button>
                    </div>
                  )}
                </div>
              </div>

              {/* LOUNGE BROADCAST SPEAKER BOX (TEXT TO SPEECH) */}
              <div className="bg-slate-950 text-white rounded-3xl p-6 shadow-xl border border-slate-800 space-y-3">
                <div className="flex items-center justify-between text-xs">
                  <div className="flex items-center gap-2">
                    <Radio className="w-4 h-4 text-amber-500 animate-pulse" />
                    <h4 className="font-extrabold text-white text-sm">Lounge Broadcast Speaker</h4>
                  </div>
                  <span className="px-2 py-0.5 bg-amber-500/20 text-amber-400 text-[9px] font-bold rounded border border-amber-500/30">
                    Sonos Zone 1 Active
                  </span>
                </div>

                <p className="text-[11px] text-slate-400 leading-relaxed">
                  Kirimkan pemanggilan instan atau pengumuman sambutan atelier menggunakan Text-to-Speech otomatis bahasa Indonesia & Inggris.
                </p>

                <form onSubmit={handleBroadcast} className="space-y-3">
                  <textarea
                    rows="2"
                    placeholder="Ketik pengumuman atau panggil..."
                    value={broadcastText}
                    onChange={(e) => setBroadcastText(e.target.value)}
                    className="w-full p-3 bg-slate-900 border border-slate-800 rounded-2xl text-xs text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/50"
                  ></textarea>

                  <div className="flex justify-end">
                    <button
                      type="submit"
                      className="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs rounded-xl shadow-md transition-all flex items-center gap-1.5"
                    >
                      <Volume2 className="w-4 h-4" />
                      <span>Siarkan</span>
                    </button>
                  </div>
                </form>
              </div>

            </div>

          </div>

        </main>
      </div>

      {/* ==========================================
          MODAL TAMBAH ANTREAN WALK-IN
      ========================================== */}
      {showAddWalkInModal && (
        <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-4 border border-slate-200">
            <div className="flex items-center justify-between border-b border-slate-100 pb-3">
              <h3 className="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                <Plus className="w-5 h-5 text-amber-500" />
                <span>+ Tambah Antrean Walk-in</span>
              </h3>
              <button onClick={() => setShowAddWalkInModal(false)} className="text-slate-400 hover:text-slate-600">
                <X className="w-5 h-5" />
              </button>
            </div>

            <form onSubmit={handleAddWalkIn} className="space-y-3 text-xs">
              <div>
                <label className="font-bold text-slate-700 block mb-1">Nama Tamu Walk-in</label>
                <input
                  type="text"
                  required
                  placeholder="Misal: Bagus Wicaksono"
                  value={walkInForm.nama}
                  onChange={(e) => setWalkInForm({ ...walkInForm, nama: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Nomor WhatsApp / Phone</label>
                <input
                  type="text"
                  placeholder="0812-9988-8219"
                  value={walkInForm.phone}
                  onChange={(e) => setWalkInForm({ ...walkInForm, phone: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                />
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Pilih Layanan</label>
                <select
                  value={walkInForm.layanan}
                  onChange={(e) => setWalkInForm({ ...walkInForm, layanan: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                >
                  <option value="Gentleman Royal Cut & Beard Sculpting">Gentleman Royal Cut & Beard Sculpting</option>
                  <option value="Classic Pompadour Haircut & Head Massage">Classic Pompadour Haircut & Head Massage</option>
                  <option value="Keratin Blowout & Hair Spa Botanical">Keratin Blowout & Hair Spa Botanical</option>
                  <option value="Scalp Detox Ritual Aromatherapy">Scalp Detox Ritual Aromatherapy</option>
                </select>
              </div>

              <div>
                <label className="font-bold text-slate-700 block mb-1">Pilih Master Stylist / Barber</label>
                <select
                  value={walkInForm.stylist}
                  onChange={(e) => setWalkInForm({ ...walkInForm, stylist: e.target.value })}
                  className="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900/10 focus:outline-none"
                >
                  <option value="Barber Reza Pratama">Barber Reza Pratama (VIP Suite)</option>
                  <option value="Barber David Gunawan">Barber David Gunawan (Chair 01)</option>
                  <option value="Elena Rose">Stylist Elena Rose (Chair 03)</option>
                </select>
              </div>

              <div className="flex items-center gap-2 pt-1">
                <input
                  type="checkbox"
                  id="isVipCheck"
                  checked={walkInForm.isVip}
                  onChange={(e) => setWalkInForm({ ...walkInForm, isVip: e.target.checked })}
                  className="rounded text-slate-900 focus:ring-amber-500"
                />
                <label htmlFor="isVipCheck" className="font-bold text-slate-700">Tamu VIP (Prioritas Lounge)</label>
              </div>

              <div className="pt-2 flex justify-end gap-2">
                <button
                  type="button"
                  onClick={() => setShowAddWalkInModal(false)}
                  className="px-4 py-2 bg-slate-100 text-slate-700 font-bold rounded-xl"
                >
                  Batal
                </button>
                <button
                  type="submit"
                  className="px-5 py-2 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-xl shadow-md"
                >
                  Simpan & Panggil
                </button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* ==========================================
          MODAL LAYAR TV PELANGGAN (DISPLAY DISPLAY DUAL HD)
      ========================================== */}
      {showTvModal && (
        <div className="fixed inset-0 bg-slate-950 z-50 p-8 flex flex-col justify-between text-white overflow-hidden">
          <div className="flex items-center justify-between border-b border-slate-800 pb-4">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 rounded-xl bg-amber-500 text-slate-950 font-black text-xl flex items-center justify-center">L</div>
              <div>
                <h1 className="font-black text-xl tracking-tight">L-Style ATELIER SUITE</h1>
                <p className="text-xs text-amber-400 font-bold uppercase tracking-widest">DISPLAY TV PELANGGAN • SENOPATI BRANCH</p>
              </div>
            </div>

            <button onClick={() => setShowTvModal(false)} className="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white font-bold rounded-xl text-xs flex items-center gap-2">
              <X className="w-4 h-4" />
              <span>Tutup Display TV</span>
            </button>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 my-auto">
            {/* Left Big Live Active */}
            <div className="bg-slate-900 border border-slate-800 rounded-3xl p-8 space-y-4 text-center">
              <span className="px-3 py-1 bg-amber-500/20 text-amber-400 text-xs font-bold rounded-full uppercase tracking-widest">SEDANG DILAYANI (VIP SUITE)</span>
              <h2 className="text-6xl font-black text-amber-400 tracking-tight">{currentData.liveFocus?.antreanNo || 'A-015'}</h2>
              <h3 className="text-2xl font-bold text-white">{currentData.liveFocus?.nama || 'Dimas Pratama'}</h3>
              <p className="text-sm text-slate-400 font-medium">{currentData.liveFocus?.layanan || 'Gentleman Royal Cut'}</p>
            </div>

            {/* Right Next Queue */}
            <div className="bg-slate-900 border border-slate-800 rounded-3xl p-8 space-y-4">
              <h3 className="text-sm font-bold text-slate-400 uppercase tracking-widest border-b border-slate-800 pb-2">GILIRAN ANTREAN BERIKUTNYA</h3>
              <div className="space-y-3">
                {currentData.queueList.slice(0, 3).map((q, idx) => (
                  <div key={q.id} className="p-4 bg-slate-800/60 rounded-2xl flex items-center justify-between">
                    <span className="font-black text-2xl text-amber-400">{q.id}</span>
                    <span className="font-bold text-base text-white">{q.nama}</span>
                    <span className="text-xs font-semibold px-2 py-1 bg-slate-700 text-slate-300 rounded-lg">{q.badgeType}</span>
                  </div>
                ))}
              </div>
            </div>
          </div>

          <div className="text-center text-xs text-slate-500 font-medium border-t border-slate-900 pt-4">
            L-Style ATELIER SUITE • Automatic Audio Lounge Broadcast • Senopati Studio
          </div>
        </div>
      )}

    </div>
  );
}
