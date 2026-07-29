import React from 'react';
import { Head, Link, usePage } from '@inertiajs/react';
import {
  Home, GraduationCap, FileText, Info, Contact, Settings, 
  HelpCircle, LogOut, Search, Bell, MessageSquare, Plus, 
  Box, CheckCircle2, FileEdit, Filter, Inbox, ChevronLeft, ChevronRight, MessageCircle
} from 'lucide-react';

// =========================================================
// REUSABLE STAT CARD COMPONENT
// =========================================================
const StatCard = ({ title, value, icon: Icon, iconBg, iconColor }) => (
  <div className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
    <div>
      <p className="text-[11px] text-slate-400 font-bold uppercase tracking-wider mb-1">{title}</p>
      <h3 className="text-3xl font-extrabold text-slate-800">{value}</h3>
    </div>
    <div className={`w-14 h-14 rounded-2xl flex items-center justify-center ${iconBg} ${iconColor}`}>
      <Icon className="w-7 h-7" />
    </div>
  </div>
);

// =========================================================
// SIDEBAR COMPONENT
// =========================================================
const Sidebar = () => {
  const { url } = usePage();
  const isActive = (path) => url.startsWith(path);

  return (
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
        <Link href="/dashboard" className={`flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all ${isActive('/dashboard') ? 'bg-blue-600 text-white shadow-sm shadow-blue-200' : 'text-slate-600 hover:bg-slate-50'}`}>
          <Home className={`w-5 h-5 ${isActive('/dashboard') ? 'text-white' : 'text-slate-400'}`} /> Beranda
        </Link>
        
        <Link href="/program-khusus" className={`flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all ${isActive('/program-khusus') ? 'bg-blue-600 text-white shadow-sm shadow-blue-200' : 'text-slate-600 hover:bg-slate-50'}`}>
          <GraduationCap className={`w-5 h-5 ${isActive('/program-khusus') ? 'text-white' : 'text-slate-400'}`} /> Program Khusus
        </Link>
        
        <Link href="/artikel" className={`flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all ${isActive('/artikel') ? 'bg-blue-600 text-white shadow-sm shadow-blue-200' : 'text-slate-600 hover:bg-slate-50'}`}>
          <FileText className={`w-5 h-5 ${isActive('/artikel') ? 'text-white' : 'text-slate-400'}`} /> Artikel
        </Link>
        
        {/* Menu Aktif: Tentang Kami */}
        <Link href="/tentang-kami" className={`flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all ${isActive('/tentang-kami') ? 'bg-blue-600 text-white shadow-sm shadow-blue-200' : 'text-slate-600 hover:bg-slate-50'}`}>
          <Info className={`w-5 h-5 ${isActive('/tentang-kami') ? 'text-white' : 'text-slate-400'}`} /> Tentang Kami
        </Link>
        
        <Link href="#" className="flex items-center gap-3 text-slate-600 hover:bg-slate-50 px-4 py-3 rounded-xl text-sm font-medium transition-all">
          <Contact className="w-5 h-5 text-slate-400" /> Kontak
        </Link>
      </nav>

      {/* Footer Links & New Program Button */}
      <div className="p-4 mx-2 mb-2 border-t border-slate-100 mt-auto space-y-2">
        <button className="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-xl py-2.5 flex items-center justify-center gap-2 text-sm font-semibold shadow-sm transition-all mb-4">
          <Plus className="w-4 h-4" /> New Program
        </button>

        <Link href="#" className="flex items-center gap-3 text-slate-600 hover:bg-slate-50 px-4 py-2.5 rounded-xl text-sm font-medium transition-all">
          <HelpCircle className="w-5 h-5 text-slate-400" /> Help Center
        </Link>
        <Link href={route('logout')} method="post" as="button" className="w-full flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-2.5 rounded-xl text-sm font-medium transition-all">
          <LogOut className="w-5 h-5" /> Logout
        </Link>
      </div>
    </aside>
  );
};

// =========================================================
// MAIN PAGE COMPONENT (KOSONG / DEFAULT 0)
// =========================================================
export default function TentangKamiIndex({ 
  auth, 
  stats = {}, 
  projects = [] // Default array kosong
}) {
  return (
    <div className="flex bg-[#F8F9FD] min-h-screen font-sans text-slate-700">
      <Head title="Manajemen Portofolio" />

      {/* Sidebar Kiri */}
      <Sidebar />

      {/* Area Konten Utama Kanan */}
      <div className="flex-1 flex flex-col ml-64 min-w-0 h-screen overflow-y-auto relative">
        
        {/* Header Navbar */}
        <header className="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center sticky top-0 z-10">
          <h2 className="text-xl font-bold text-slate-800">Admin Dashboard</h2>
          
          <div className="flex items-center gap-6">
            {/* Search Bar */}
            <div className="relative hidden md:block w-80">
              <Search className="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
              <input 
                type="text" 
                placeholder="Cari portofolio..." 
                className="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-blue-100 outline-none transition-all"
              />
            </div>

            {/* Icons */}
            <div className="flex items-center gap-3 border-r border-slate-200 pr-6">
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
                <p className="text-sm font-bold text-slate-700 leading-none">{auth?.user?.name || 'Super Admin'}</p>
                <p className="text-[11px] text-slate-400 mt-1">elcoding.id</p>
              </div>
              <div className="w-10 h-10 bg-slate-200 rounded-full overflow-hidden border-2 border-white shadow-sm">
                <img src={`https://ui-avatars.com/api/?name=${auth?.user?.name || 'Admin'}&background=0D8ABC&color=fff`} alt="Avatar" className="w-full h-full object-cover" />
              </div>
            </div>
          </div>
        </header>

        {/* Isi Halaman */}
        <main className="p-8 max-w-[1400px] mx-auto w-full flex-1 pb-24">
          
          {/* Page Title & Add Button */}
          <div className="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
            <div>
              <h1 className="text-2xl font-bold text-slate-800">Manajemen Portofolio</h1>
              <p className="text-sm text-slate-500 mt-1">Kelola seluruh karya dan proyek sukses Elcoding Academy.</p>
            </div>
            <button className="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2 shadow-sm shadow-blue-200 transition-all">
              <Plus className="w-4 h-4" /> Tambah Portofolio Baru
            </button>
          </div>

          {/* STAT CARDS (Angka 0) */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <StatCard 
              title="TOTAL PORTOFOLIO" 
              value={stats?.total_portofolio || '0'} 
              icon={Box} iconBg="bg-blue-50" iconColor="text-blue-600" 
            />
            <StatCard 
              title="PROYEK SELESAI" 
              value={stats?.proyek_selesai || '0'} 
              icon={CheckCircle2} iconBg="bg-emerald-50" iconColor="text-emerald-600" 
            />
            <StatCard 
              title="DRAFT" 
              value={stats?.draf || '0'} 
              icon={FileEdit} iconBg="bg-purple-50" iconColor="text-purple-600" 
            />
          </div>

          {/* TABLE SECTION */}
          <div className="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            
            {/* Toolbar Filters */}
            <div className="p-5 border-b border-slate-100 flex items-center justify-between">
              <h3 className="font-semibold text-slate-700 text-sm">Daftar Proyek</h3>
              <div className="flex gap-2">
                <button className="p-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-600 rounded-xl transition-colors">
                  <Filter className="w-4 h-4" />
                </button>
              </div>
            </div>

            {/* Table */}
            <div className="overflow-x-auto">
              <table className="w-full text-left border-collapse min-w-[900px]">
                <thead>
                  <tr className="border-b border-slate-100 bg-slate-50/50">
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider w-[20%]">Thumbnail</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider w-[25%]">Nama Proyek</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider w-[20%]">Kategori</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider w-[15%]">Tanggal Selesai</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider w-[10%]">Status</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider w-[10%] text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-100 text-sm">
                  
                  {/* Kondisi Data Kosong */}
                  {projects.length === 0 ? (
                    <tr>
                      <td colSpan="6" className="py-20 text-center">
                        <div className="flex flex-col items-center justify-center text-slate-400">
                          <div className="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                            <Inbox className="w-8 h-8 text-slate-300" />
                          </div>
                          <p className="font-bold text-slate-500">Belum ada portofolio</p>
                          <p className="text-xs mt-1">Silakan klik "Tambah Portofolio Baru" untuk mulai menambahkan data.</p>
                        </div>
                      </td>
                    </tr>
                  ) : (
                    projects.map((item, index) => (
                      <tr key={index}></tr>
                    ))
                  )}

                </tbody>
              </table>
            </div>

            {/* Pagination */}
            <div className="p-5 border-t border-slate-100 flex items-center justify-between">
              <p className="text-sm text-slate-500 font-medium">
                Menampilkan 0 dari 0 proyek
              </p>
              
              <div className="flex items-center gap-1.5">
                <button disabled className="px-3 py-1.5 text-sm font-medium text-slate-400 cursor-not-allowed">
                  Previous
                </button>
                <button className="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm font-bold shadow-sm">
                  1
                </button>
                <button disabled className="px-3 py-1.5 text-sm font-medium text-slate-400 cursor-not-allowed">
                  Next
                </button>
              </div>
            </div>

          </div>

          {/* Footer Copyright */}
          <div className="text-center text-xs font-medium text-slate-400 mt-12">
            © 2026 Elcoding Academy. Panel Administrasi Versi 2.4.0
          </div>

        </main>

        {/* Floating Chat Bubble (Seperti di pojok kanan bawah gambar) */}
        <button className="fixed bottom-6 right-6 w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center shadow-lg transition-transform hover:scale-105 z-50">
          <MessageCircle className="w-5 h-5" />
        </button>

      </div>
    </div>
  );
}