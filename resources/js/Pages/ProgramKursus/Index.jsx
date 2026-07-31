import React from 'react';
import { Head, Link, usePage } from '@inertiajs/react';
import {
  GraduationCap, Home, FileText, Info, Contact, Plus, HelpCircle, LogOut,
  Search, Bell, MessageSquare, Users, Banknote, ChevronDown,
  Edit3, Eye, Trash2, ChevronLeft, ChevronRight, Inbox
} from 'lucide-react';

// =========================================================
// REUSABLE COMPONENTS
// =========================================================

const StatCard = ({ title, value, icon: Icon, iconBg, iconColor }) => (
  <div className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-5">
    <div className={`w-14 h-14 rounded-2xl flex items-center justify-center ${iconBg} ${iconColor}`}>
      <Icon className="w-7 h-7" />
    </div>
    <div>
      <p className="text-[11px] text-slate-400 font-bold uppercase tracking-wider mb-1">{title}</p>
      <h3 className="text-3xl font-extrabold text-slate-800">{value}</h3>
    </div>
  </div>
);

// =========================================================
// SIDEBAR COMPONENT (DIPERBAIKI FINAL)
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
        {/* Beranda */}
        <Link 
          href="/dashboard" 
          className={`flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all ${
            isActive('/dashboard') 
              ? 'bg-blue-600 text-white shadow-sm shadow-blue-200' 
              : 'text-slate-600 hover:bg-slate-50'
          }`}
        >
          <Home className={`w-5 h-5 ${isActive('/dashboard') ? 'text-white' : 'text-slate-400'}`} /> Beranda
        </Link>
        
        {/* Program Khusus (Aktif Berwarna Biru) */}
        <Link 
          href="/admin/program-khusus" 
          className={`flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all ${
            isActive('/program-khusus') 
              ? 'bg-blue-600 text-white shadow-sm shadow-blue-200' 
              : 'text-slate-600 hover:bg-slate-50'
          }`}
        >
          <GraduationCap className={`w-5 h-5 ${isActive('/program-khusus') ? 'text-white' : 'text-slate-400'}`} /> Program Khusus
        </Link>
        
        {/* Artikel (Diperbaiki dari href="#" menjadi href="/admin/artikel" agar bisa diklik) */}
        <Link 
          href="/admin/artikel" 
          className={`flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all ${
            isActive('/artikel') 
              ? 'bg-blue-600 text-white shadow-sm shadow-blue-200' 
              : 'text-slate-600 hover:bg-slate-50'
          }`}
        >
          <FileText className={`w-5 h-5 ${isActive('/artikel') ? 'text-white' : 'text-slate-400'}`} /> Artikel
        </Link>
        
        <Link href="/admin/tentang-kami" className="flex items-center gap-3 text-slate-600 hover:bg-slate-50 px-4 py-3 rounded-xl text-sm font-medium transition-all">
          <Info className="w-5 h-5 text-slate-400" /> 
          <span className="leading-tight">Tentang Kami<br/><span className="text-[11px] font-normal text-slate-400">(Portfolio)</span></span>
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
export default function ProgramKursus({ 
  auth, 
  stats = {}, 
  programs = [] 
}) {
  
  return (
    <div className="flex bg-[#F8F9FD] min-h-screen font-sans text-slate-700">
      <Head title="Manajemen Program Kursus" />

      {/* Sidebar Kiri */}
      <Sidebar />

      {/* Area Konten Utama Kanan */}
      <div className="flex-1 flex flex-col ml-64 min-w-0 h-screen overflow-y-auto">
        
        {/* Header Navbar */}
        <header className="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center sticky top-0 z-10">
          <h2 className="text-xl font-bold text-blue-700">Manajemen Program Kursus</h2>
          
          <div className="flex items-center gap-6">
            {/* Search Bar */}
            <div className="relative hidden md:block w-72">
              <Search className="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
              <input 
                type="text" 
                placeholder="Cari program..." 
                className="w-full bg-slate-50 border-none rounded-xl pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-blue-100 outline-none transition-all"
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
                <p className="text-[11px] text-slate-400 mt-1">{auth?.user?.email || 'elcoding.academy@mail.com'}</p>
              </div>
              <div className="w-10 h-10 bg-slate-200 rounded-full overflow-hidden border-2 border-white shadow-sm">
                <img src={`https://ui-avatars.com/api/?name=${auth?.user?.name || 'Admin'}&background=0D8ABC&color=fff`} alt="Avatar" className="w-full h-full object-cover" />
              </div>
            </div>
          </div>
        </header>

        {/* Isi Halaman */}
        <main className="p-8 max-w-[1400px] mx-auto w-full">
          
          {/* Page Title & Add Button */}
          <div className="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
            <div>
              <h1 className="text-2xl font-bold text-slate-800">Daftar Program Kursus Berbayar</h1>
              <p className="text-sm text-slate-500 mt-1">Kelola kurikulum, harga, dan pendaftaran siswa dalam satu tempat.</p>
            </div>
            <button className="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2 shadow-sm shadow-blue-200 transition-all">
              <Plus className="w-4 h-4" /> Tambah Program Baru
            </button>
          </div>

          {/* STAT CARDS (Angka 0) */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <StatCard 
              title="Total Program" 
              value={stats?.total_program || '0'} 
              icon={GraduationCap} iconBg="bg-blue-50" iconColor="text-blue-600" 
            />
            <StatCard 
              title="Siswa Aktif" 
              value={stats?.siswa_aktif || '0'} 
              icon={Users} iconBg="bg-purple-50" iconColor="text-purple-600" 
            />
            <StatCard 
              title="Pendapatan Bulan Ini" 
              value={stats?.pendapatan || 'Rp 0'} 
              icon={Banknote} iconBg="bg-emerald-50" iconColor="text-emerald-600" 
            />
          </div>

          {/* TABLE SECTION */}
          <div className="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            
            {/* Toolbar Filters */}
            <div className="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div className="flex gap-3">
                <button className="flex items-center gap-2 px-4 py-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors">
                  Semua Kategori <ChevronDown className="w-4 h-4 text-slate-400" />
                </button>
                <button className="flex items-center gap-2 px-4 py-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors">
                  Status: Semua <ChevronDown className="w-4 h-4 text-slate-400" />
                </button>
              </div>
              <p className="text-sm text-slate-500 font-medium">
                Menampilkan 0 dari 0 Program
              </p>
            </div>

            {/* Table */}
            <div className="overflow-x-auto">
              <table className="w-full text-left border-collapse min-w-[800px]">
                <thead>
                  <tr className="border-b border-slate-100">
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider w-[35%]">Nama Program</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Harga</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-center">Total Siswa</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Status</th>
                    <th className="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-100 text-sm">
                  
                  {/* Kondisi Data Kosong */}
                  {programs.length === 0 ? (
                    <tr>
                      <td colSpan="6" className="py-16 text-center">
                        <div className="flex flex-col items-center justify-center text-slate-400">
                          <div className="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                            <Inbox className="w-8 h-8 text-slate-300" />
                          </div>
                          <p className="font-bold text-slate-500">Belum ada program kursus</p>
                          <p className="text-xs mt-1">Silakan klik "Tambah Program Baru" untuk memulai.</p>
                        </div>
                      </td>
                    </tr>
                  ) : (
                    programs.map((item, index) => (
                      <tr key={index}></tr>
                    ))
                  )}

                </tbody>
              </table>
            </div>

            {/* Pagination */}
            <div className="p-5 border-t border-slate-100 flex items-center justify-between">
              <button disabled className="flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-slate-400 cursor-not-allowed">
                <ChevronLeft className="w-4 h-4" /> Sebelumnya
              </button>
              
              <div className="flex items-center gap-2">
                <button className="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm font-bold shadow-sm">
                  1
                </button>
              </div>

              <button disabled className="flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-slate-400 cursor-not-allowed">
                Selanjutnya <ChevronRight className="w-4 h-4" />
              </button>
            </div>

          </div>

        </main>
      </div>
    </div>
  );
}