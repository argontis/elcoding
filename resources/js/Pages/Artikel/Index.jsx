import React from 'react';
import { Head, Link } from '@inertiajs/react';
import {
  Home, GraduationCap, FileText, Info, Contact, Settings, 
  HelpCircle, LogOut, Search, Bell, MessageSquare, Plus, 
  FileEdit, Eye, Filter, Download, Inbox, ChevronLeft, ChevronRight, TrendingUp, Clock
} from 'lucide-react';

// =========================================================
// REUSABLE COMPONENTS
// =========================================================

const StatCard = ({ title, value, icon: Icon, iconBg, iconColor, subtext, subtextIcon: SubIcon, subtextColor }) => (
  <div className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between relative overflow-hidden">
    {/* Dekorasi Background Icon (Opsional) */}
    <Icon className={`absolute -bottom-4 -right-4 w-24 h-24 ${iconColor} opacity-5`} strokeWidth={1.5} />
    
    <div className="flex justify-between items-start mb-4 relative z-10">
      <div>
        <p className="text-[11px] text-slate-400 font-bold uppercase tracking-wider mb-2">{title}</p>
        <h3 className="text-4xl font-extrabold text-slate-800">{value}</h3>
      </div>
      <div className={`w-12 h-12 rounded-xl flex items-center justify-center ${iconBg} ${iconColor}`}>
        <Icon className="w-6 h-6" />
      </div>
    </div>
    
    <div className={`flex items-center gap-1.5 text-[11px] font-medium mt-2 relative z-10 ${subtextColor}`}>
      {SubIcon && <SubIcon className="w-3.5 h-3.5" />}
      <span>{subtext}</span>
    </div>
  </div>
);

// =========================================================
// SIDEBAR COMPONENT
// =========================================================
const Sidebar = () => (
  <aside className="w-64 bg-white border-r border-slate-200 flex flex-col h-screen fixed left-0 top-0 z-20">
    {/* Logo Area */}
    <div className="p-6 flex items-center gap-3">
      <div className="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center shadow-sm">
        <GraduationCap className="w-6 h-6" />
      </div>
      <div className="leading-tight">
        <h1 className="text-[15px] font-bold text-blue-700">Elcoding<br />Academy</h1>
        <p className="text-[10px] font-medium text-slate-500">Admin Console</p>
      </div>
    </div>

    {/* Navigation Links */}
    <nav className="flex-1 px-4 space-y-1 mt-2 overflow-y-auto">
      {/* Ke Dashboard */}
      <Link href="/dashboard" className="flex items-center gap-3 text-slate-600 hover:bg-slate-50 px-4 py-3 rounded-xl text-sm font-medium transition-all">
        <Home className="w-5 h-5 text-slate-400" /> Beranda
      </Link>
      
      {/* Ke Program Khusus */}
      <Link href="/program-khusus" className="flex items-center gap-3 text-slate-600 hover:bg-slate-50 px-4 py-3 rounded-xl text-sm font-medium transition-all">
        <GraduationCap className="w-5 h-5 text-slate-400" /> Program Khusus
      </Link>
      
      {/* Menu Aktif: Artikel */}
      <Link href="/artikel" className="flex items-center gap-3 bg-blue-600 text-white px-4 py-3 rounded-xl text-sm font-medium shadow-sm shadow-blue-200 transition-all">
        <FileText className="w-5 h-5" /> Artikel
      </Link>
      
      <Link href="/tentang-kami" className="flex items-center gap-3 text-slate-600 hover:bg-slate-50 px-4 py-3 rounded-xl text-sm font-medium transition-all">
        <Info className="w-5 h-5 text-slate-400" /> 
        <span className="leading-tight">Tentang Kami<br/><span className="text-[11px] font-normal text-slate-400">(Portfolio)</span></span>
      </Link>
      
      <Link href="#" className="flex items-center gap-3 text-slate-600 hover:bg-slate-50 px-4 py-3 rounded-xl text-sm font-medium transition-all">
        <Contact className="w-5 h-5 text-slate-400" /> Kontak
      </Link>
      
      {/* Settings sesuai gambar terbaru */}
      <Link href="#" className="flex items-center gap-3 text-slate-600 hover:bg-slate-50 px-4 py-3 mt-6 rounded-xl text-sm font-medium transition-all">
        <Settings className="w-5 h-5 text-slate-400" /> Settings
      </Link>
    </nav>

    {/* Footer Links */}
    <div className="p-4 mx-2 mb-2 border-t border-slate-100 mt-auto space-y-1">
      <Link href="#" className="flex items-center gap-3 text-slate-600 hover:bg-slate-50 px-4 py-2.5 rounded-xl text-sm font-medium transition-all">
        <HelpCircle className="w-5 h-5 text-slate-400" /> Help Center
      </Link>
      <Link href={route('logout')} method="post" as="button" className="w-full flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-2.5 rounded-xl text-sm font-medium transition-all">
        <LogOut className="w-5 h-5" /> Logout
      </Link>
    </div>
  </aside>
);

// =========================================================
// MAIN PAGE COMPONENT (KOSONG / DEFAULT 0)
// =========================================================
export default function ArtikelIndex({ 
  auth, 
  stats = {}, 
  articles = [] // Default array kosong
}) {
  return (
    <div className="flex bg-[#F8F9FD] min-h-screen font-sans text-slate-700">
      <Head title="Manajemen Artikel" />

      {/* Sidebar Kiri */}
      <Sidebar />

      {/* Area Konten Utama Kanan */}
      <div className="flex-1 flex flex-col ml-64 min-w-0 h-screen overflow-y-auto relative">
        
        {/* Header Navbar */}
        <header className="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center sticky top-0 z-10">
          
          {/* Search Bar (Kiri di Header) */}
          <div className="relative w-96">
            <Search className="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" />
            <input 
              type="text" 
              placeholder="Cari artikel..." 
              className="w-full bg-slate-50/80 border border-slate-200 rounded-full pl-11 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-100 outline-none transition-all"
            />
          </div>

          <div className="flex items-center gap-6">
            {/* Icons */}
            <div className="flex items-center gap-4 border-r border-slate-200 pr-6">
              <button className="relative p-2 text-slate-400 hover:text-slate-600 transition-colors">
                <Bell className="w-5 h-5" />
                <span className="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
              </button>
              <button className="p-2 text-slate-400 hover:text-slate-600 transition-colors">
                <MessageSquare className="w-5 h-5" />
              </button>
            </div>

            {/* User Profile */}
            <div className="flex items-center gap-3">
              <div className="text-right hidden sm:block">
                <p className="text-sm font-bold text-slate-700 leading-none">{auth?.user?.name || 'Admin Elcoding'}</p>
                <p className="text-[11px] text-slate-400 mt-1">Content Manager</p>
              </div>
              <div className="w-10 h-10 bg-slate-200 rounded-full overflow-hidden border-2 border-white shadow-sm">
                <img src={`https://ui-avatars.com/api/?name=${auth?.user?.name || 'Admin'}&background=0D8ABC&color=fff`} alt="Avatar" className="w-full h-full object-cover" />
              </div>
            </div>
          </div>
        </header>

        {/* Isi Halaman */}
        <main className="p-8 max-w-[1400px] mx-auto w-full flex-1">
          
          {/* Page Title & Add Button */}
          <div className="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
            <div>
              <h1 className="text-3xl font-bold text-slate-800 tracking-tight">Manajemen Artikel</h1>
              <p className="text-sm text-slate-500 mt-2">Kelola konten edukatif dan publikasi terbaru Elcoding Academy.</p>
            </div>
            <button className="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2 shadow-sm shadow-blue-200 transition-all">
              <Plus className="w-4 h-4" /> Tambah Artikel Baru
            </button>
          </div>

          {/* STAT CARDS (Angka 0) */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <StatCard 
              title="Total Artikel" 
              value={stats?.total_artikel || '0'} 
              icon={FileText} iconBg="bg-blue-50" iconColor="text-blue-600"
              subtext="+0% bulan ini" subtextIcon={TrendingUp} subtextColor="text-emerald-500"
            />
            <StatCard 
              title="Draf Tersimpan" 
              value={stats?.draf || '0'} 
              icon={FileEdit} iconBg="bg-purple-50" iconColor="text-purple-600" 
              subtext="Belum ada draf" subtextIcon={Clock} subtextColor="text-slate-400"
            />
            <StatCard 
              title="Total Tayangan" 
              value={stats?.tayangan || '0'} 
              icon={Eye} iconBg="bg-emerald-50" iconColor="text-emerald-600" 
              subtext="+0 minggu ini" subtextIcon={TrendingUp} subtextColor="text-emerald-500"
            />
          </div>

          {/* TABLE SECTION */}
          <div className="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
            
            {/* Toolbar Filters */}
            <div className="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <h3 className="font-semibold text-slate-700">Daftar Artikel</h3>
              
              <div className="flex gap-3">
                <button className="flex items-center gap-2 px-4 py-2 bg-white hover:bg-slate-50 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors shadow-sm">
                  <Filter className="w-4 h-4" /> Filter
                </button>
                <button className="flex items-center gap-2 px-4 py-2 bg-white hover:bg-slate-50 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors shadow-sm">
                  <Download className="w-4 h-4" /> Export
                </button>
              </div>
            </div>

            {/* Table */}
            <div className="overflow-x-auto">
              <table className="w-full text-left border-collapse min-w-[900px]">
                <thead>
                  <tr className="bg-slate-50/50 border-b border-slate-100">
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider w-[40%]">Judul / Headline</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Tanggal Terbit</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Status</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-100 text-sm">
                  
                  {/* Kondisi Data Kosong */}
                  {articles.length === 0 ? (
                    <tr>
                      <td colSpan="5" className="py-20 text-center">
                        <div className="flex flex-col items-center justify-center text-slate-400">
                          <div className="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                            <Inbox className="w-8 h-8 text-slate-300" />
                          </div>
                          <p className="font-bold text-slate-500">Belum ada artikel</p>
                          <p className="text-xs mt-1">Silakan klik "Tambah Artikel Baru" untuk membuat postingan pertama Anda.</p>
                        </div>
                      </td>
                    </tr>
                  ) : (
                    // Mapping data akan berada di sini nantinya
                    articles.map((item, index) => (
                      <tr key={index}></tr>
                    ))
                  )}

                </tbody>
              </table>
            </div>

            {/* Pagination (State Kosong / Disabled) */}
            <div className="p-5 border-t border-slate-100 flex items-center justify-between">
              <p className="text-sm text-slate-500 font-medium">
                Menampilkan 0 dari 0 artikel
              </p>
              
              <div className="flex items-center gap-1.5">
                <button disabled className="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 cursor-not-allowed">
                  <ChevronLeft className="w-4 h-4" />
                </button>
                <button className="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm font-bold shadow-sm">
                  1
                </button>
                <button disabled className="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 cursor-not-allowed">
                  <ChevronRight className="w-4 h-4" />
                </button>
              </div>
            </div>
          </div>

          {/* Footer Text */}
          <div className="text-center text-xs font-medium text-slate-400 mt-8 mb-4">
            © 2026 Elcoding Academy Admin Console. Built for educational excellence.
          </div>

        </main>

        {/* Floating Action Button (+) di pojok kanan bawah */}
        <button className="fixed bottom-8 right-8 w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center shadow-lg shadow-blue-500/30 transition-transform hover:scale-105 z-50">
          <Plus className="w-6 h-6" />
        </button>

      </div>
    </div>
  );
}