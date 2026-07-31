import React, { useEffect } from 'react';
import { Head, Link, usePage, router } from '@inertiajs/react';
import {
  Users, GraduationCap, Banknote, Clock,
  LayoutGrid, FilePlus, Briefcase, MapPin, Server,
  MoreVertical, Plus, Home, FileText, Info, Contact, HelpCircle, LogOut,
  Search, Bell, MessageSquare, Award, Cpu, CheckCircle2, AlertCircle
} from 'lucide-react';

// =========================================================
// REUSABLE COMPONENTS
// =========================================================

const StatCard = ({ title, value = '0', trendText, trendType, icon: Icon, iconTheme }) => (
  <div className="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
    <div className="flex items-center justify-between">
      <div className={`w-10 h-10 rounded-xl flex items-center justify-center ${iconTheme}`}>
        <Icon className="w-5 h-5" />
      </div>
      {trendText && (
        <span className={`text-[11px] font-semibold px-2 py-0.5 rounded-md ${
          trendType === 'success' ? 'text-emerald-600 bg-emerald-50' :
          trendType === 'danger' ? 'text-red-600 bg-red-50' : 
          trendType === 'purple' ? 'text-purple-600 bg-purple-50' :
          'text-slate-500 bg-slate-100'
        }`}>
          {trendText}
        </span>
      )}
    </div>
    <div className="mt-4">
      <p className="text-xs text-slate-400 font-medium">{title}</p>
      <h3 className="text-2xl font-bold text-slate-800 mt-1">{value}</h3>
    </div>
  </div>
);

const QuickAction = ({ label, icon: Icon, href = "#" }) => (
  <Link href={href} className="bg-white/10 hover:bg-white/20 p-3 rounded-xl backdrop-blur-sm text-center flex flex-col items-center justify-center transition-all w-full group">
    <Icon className="w-5 h-5 mb-1.5 text-blue-200 group-hover:scale-110 transition-transform" />
    <span className="text-[11px] font-medium leading-tight text-white">{label}</span>
  </Link>
);

// =========================================================
// SIDEBAR COMPONENT
// =========================================================
const Sidebar = () => {
  const { url } = usePage();
  const isActive = (path) => url.startsWith(path);

  return (
    <aside className="w-64 bg-[#F8FAFC] border-r border-slate-200 flex flex-col h-screen fixed left-0 top-0 z-20">
      {/* Logo Area */}
      <div className="p-6 flex items-center gap-3">
        <div className="bg-white rounded-xl px-3 py-2.5 w-full flex items-center justify-center shadow-sm border border-slate-200">
            <img src="/gambar/aset/logo-elcoding.svg" alt="Elcoding" className="h-6 object-contain" />
            <span className="text-[9px] font-bold text-blue-600 uppercase tracking-wider ml-2 bg-blue-50 px-1.5 py-0.5 rounded border border-blue-100">ADMIN</span>
        </div>
      </div>

      {/* Action Button */}
      <div className="px-5 mb-6">
        <a 
          href="/admin/program-kursus/create" 
          className="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-xl py-2.5 flex items-center justify-center gap-2 text-sm font-semibold shadow-sm transition-all"
        >
          <Plus className="w-4 h-4" /> New Program
        </a>
      </div>

      {/* Navigation Links */}
      <nav className="flex-1 px-3 space-y-1 overflow-y-auto">
        <Link 
          href="/dashboard" 
          className={`flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all ${
            isActive('/dashboard') || url === '/'
              ? 'bg-blue-600 text-white shadow-sm shadow-blue-200' 
              : 'text-slate-600 hover:bg-slate-100'
          }`}
        >
          <Home className={`w-5 h-5 ${isActive('/dashboard') || url === '/' ? 'text-white' : 'text-slate-400'}`} /> Beranda
        </Link>
        
        <a 
          href="/admin/mitra" 
          className="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all text-slate-600 hover:bg-slate-100"
        >
          <Users className="w-5 h-5 text-slate-400" /> Klien & Mitra
        </a>

        <a 
          href="/admin/program-kursus" 
          className="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all text-slate-600 hover:bg-slate-100"
        >
          <GraduationCap className="w-5 h-5 text-slate-400" /> Program Kursus
        </a>
        
        <a 
          href="/admin/artikel" 
          className="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all text-slate-600 hover:bg-slate-100"
        >
          <FileText className="w-5 h-5 text-slate-400" /> Blog & Artikel
        </a>
      </nav>

      {/* Footer Links */}
      <div className="p-4 mx-3 mb-2 border-t border-slate-200 mt-auto">
        <Link href="#" className="flex items-center gap-3 text-slate-600 hover:bg-slate-100 px-4 py-3 rounded-xl text-sm font-medium transition-all">
          <HelpCircle className="w-5 h-5 text-slate-400" /> Help Center
        </Link>
        <Link 
          href={typeof route !== 'undefined' ? route('logout') : '/logout'} 
          method="post" 
          as="button" 
          className="w-full flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-3 rounded-xl text-sm font-medium transition-all"
        >
          <LogOut className="w-5 h-5" /> Logout
        </Link>
      </div>
    </aside>
  );
};

// =========================================================
// MOCK DATA FALLBACKS (JIKA DATABASE MASIH KOSONG)
// =========================================================
const DEFAULT_ACTIVITIES = [
  {
    id: 1,
    title: 'Rizky Pratama enrolled in Full Stack Web Dev',
    subtitle: 'Student Registration',
    status: 'Success',
    statusType: 'success',
    timestamp: '2 mins ago',
    icon: Users,
    iconBg: 'bg-blue-50 text-blue-600'
  },
  {
    id: 2,
    title: 'New Portfolio published: E-commerce App',
    subtitle: 'Student Submission',
    status: 'Pending Review',
    statusType: 'warning',
    timestamp: '15 mins ago',
    icon: Briefcase,
    iconBg: 'bg-purple-50 text-purple-600'
  },
  {
    id: 3,
    title: 'Admin updated course: Cyber Security',
    subtitle: 'System Update',
    status: 'Active',
    statusType: 'active',
    timestamp: '1 hour ago',
    icon: Cpu,
    iconBg: 'bg-emerald-50 text-emerald-600'
  },
  {
    id: 4,
    title: 'Siti Aminah completed UI/UX Design',
    subtitle: 'Course Graduation',
    status: 'Graduated',
    statusType: 'teal',
    timestamp: '3 hours ago',
    icon: Award,
    iconBg: 'bg-teal-50 text-teal-600'
  }
];

// =========================================================
// MAIN DASHBOARD COMPONENT
// =========================================================
export default function Dashboard({ 
  auth, 
  stats = {}, 
  activities = [], 
  systemStatus = {} 
}) {

  // ---------------------------------------------------------
  // REAL-TIME AUTO POLLING DATA DARI DATABASE (SETIAP 5 DETIK)
  // ---------------------------------------------------------
  useEffect(() => {
    const interval = setInterval(() => {
      router.reload({ 
        only: ['stats', 'activities', 'systemStatus'], 
        preserveScroll: true 
      });
    }, 5000); // Merekam pembaruan database setiap 5000ms (5 detik)

    return () => clearInterval(interval);
  }, []);

  // Merge database props dengan fallback dummy
  const currentStats = {
    total_students: stats.total_students || '1,248',
    active_courses: stats.active_courses || '24',
    total_revenue: stats.total_revenue || 'Rp 156.0M',
    pending_consultations: stats.pending_consultations || '8'
  };

  const currentSystemStatus = {
    uptime: systemStatus.uptime || '99.9%',
    storage: systemStatus.storage || '64.2 GB / 100 GB'
  };

  const displayActivities = activities && activities.length > 0 ? activities : DEFAULT_ACTIVITIES;

  return (
    <div className="flex bg-[#F4F7FE] min-h-screen font-sans text-slate-700">
      <Head title="Admin Dashboard" />

      {/* Sidebar Navigation */}
      <Sidebar />

      {/* Main Content Area */}
      <div className="flex-1 flex flex-col ml-64 min-w-0 h-screen overflow-y-auto">
        
        {/* Header Bar */}
        <header className="bg-white border-b border-slate-200 px-8 py-3.5 flex justify-between items-center sticky top-0 z-10 shadow-sm">
          <h2 className="text-xl font-bold text-slate-800">Admin Dashboard</h2>
          
          {/* Search Bar Center */}
          <div className="flex-1 max-w-md mx-8 hidden md:block">
            <div className="relative">
              <Search className="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
              <input 
                type="text" 
                placeholder="Search students, courses, or articles..." 
                className="w-full pl-10 pr-4 py-2 bg-slate-100/70 border border-slate-200/60 rounded-xl text-xs focus:bg-white focus:border-blue-500 focus:outline-none transition-all"
              />
            </div>
          </div>

          {/* Profile & Notifications */}
          <div className="flex items-center gap-3">
            <button className="p-2 text-slate-400 hover:text-slate-600 rounded-xl hover:bg-slate-100 relative">
              <Bell className="w-5 h-5" />
              <span className="w-2 h-2 bg-red-500 rounded-full absolute top-2 right-2 border-2 border-white"></span>
            </button>
            <button className="p-2 text-slate-400 hover:text-slate-600 rounded-xl hover:bg-slate-100">
              <MessageSquare className="w-5 h-5" />
            </button>
            
            <div className="h-6 w-[1px] bg-slate-200 mx-1"></div>

            <div className="flex items-center gap-3 pl-1">
              <div className="text-right leading-tight hidden sm:block">
                <p className="text-xs font-bold text-slate-800">{auth?.user?.name || 'Super Admin'}</p>
                <p className="text-[10px] text-slate-400 font-medium">{auth?.user?.email || 'admin@elcoding.id'}</p>
              </div>
              <div className="w-9 h-9 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold ring-2 ring-blue-100 overflow-hidden">
                <img 
                  src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop" 
                  alt="Avatar" 
                  className="w-full h-full object-cover"
                  onError={(e) => { e.target.onerror = null; e.target.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(auth?.user?.name || 'Admin')}&background=0D8ABC&color=fff`; }}
                />
              </div>
            </div>
          </div>
        </header>

        {/* Dashboard Main Content */}
        <main className="p-8">
          
          {/* 1. REAL-TIME STAT CARDS */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <StatCard 
              title="Total Students" value={currentStats.total_students} 
              trendText="+12% live" trendType="success"
              icon={Users} iconTheme="bg-blue-50 text-blue-600" 
            />
            <StatCard 
              title="Active Courses" value={currentStats.active_courses} 
              trendText="Updated now" trendType="purple"
              icon={GraduationCap} iconTheme="bg-purple-50 text-purple-600" 
            />
            <StatCard 
              title="Total Revenue" value={currentStats.total_revenue} 
              trendText="Real-time" trendType="success"
              icon={Banknote} iconTheme="bg-emerald-50 text-emerald-600" 
            />
            <StatCard 
              title="Pending Consultations" value={currentStats.pending_consultations} 
              trendText="Needs Action" trendType="danger"
              icon={Clock} iconTheme="bg-red-50 text-red-500" 
            />
          </div>

          {/* 2. CHARTS & QUICK OVERVIEW */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            
            {/* Enrollment Trends Vector SVG Chart */}
            <div className="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
              <div className="flex items-center justify-between mb-2">
                <div>
                  <h3 className="text-base font-bold text-slate-800">Enrollment Trends</h3>
                  <p className="text-xs text-slate-400">Monthly student registration statistics</p>
                </div>
                <div className="flex items-center gap-2">
                  <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                  <span className="text-[11px] bg-slate-100 text-slate-600 px-3 py-1 rounded-lg font-medium">
                    Live Data
                  </span>
                </div>
              </div>

              {/* Vector SVG Wave Chart */}
              <div className="h-52 w-full pt-4">
                <svg className="w-full h-full overflow-visible" viewBox="0 0 500 150" preserveAspectRatio="none">
                  <defs>
                    <linearGradient id="blueGradient" x1="0" y1="0" x2="0" y2="1">
                      <stop offset="0%" stopColor="#2563EB" stopOpacity="0.25" />
                      <stop offset="100%" stopColor="#2563EB" stopOpacity="0.0" />
                    </linearGradient>
                  </defs>
                  
                  {/* Grid Lines */}
                  <line x1="0" y1="30" x2="500" y2="30" stroke="#F1F5F9" strokeDasharray="4 4" />
                  <line x1="0" y1="75" x2="500" y2="75" stroke="#F1F5F9" strokeDasharray="4 4" />
                  <line x1="0" y1="120" x2="500" y2="120" stroke="#F1F5F9" strokeDasharray="4 4" />

                  {/* Filled Area */}
                  <path 
                    d="M 0,110 C 80,110 120,95 180,105 C 240,115 300,60 380,80 C 440,95 470,40 500,30 L 500,140 L 0,140 Z" 
                    fill="url(#blueGradient)" 
                  />

                  {/* Smooth Curved Line */}
                  <path 
                    d="M 0,110 C 80,110 120,95 180,105 C 240,115 300,60 380,80 C 440,95 470,40 500,30" 
                    fill="none" 
                    stroke="#2563EB" 
                    strokeWidth="3" 
                    strokeLinecap="round"
                  />
                </svg>

                {/* X-Axis Labels */}
                <div className="flex justify-between text-[11px] font-semibold text-slate-400 mt-2 px-1">
                  <span>JAN</span>
                  <span>FEB</span>
                  <span>MAR</span>
                  <span>APR</span>
                  <span>MAY</span>
                  <span>JUN</span>
                </div>
              </div>
            </div>

            {/* Right Side Widgets */}
            <div className="space-y-6">
              
              {/* Platform Overview */}
              <div className="bg-blue-600 text-white p-5 rounded-2xl shadow-lg shadow-blue-500/20">
                <h3 className="text-base font-bold mb-1">Platform Overview</h3>
                <p className="text-xs text-blue-100 mb-4 leading-relaxed">Manage all academy operations from one central command center.</p>
                <div className="grid grid-cols-2 gap-2.5">
                  <QuickAction label="Manage Paid Courses" icon={LayoutGrid} href="/admin/program-kursus" />
                  <QuickAction label="Post New Article" icon={FilePlus} href="/admin/artikel" />

                  <QuickAction label="Manage Partners" icon={Users} href="/admin/mitra" />
                </div>
              </div>

              {/* System Status */}
              <div className="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                <div className="flex items-center gap-2 mb-3">
                  <Server className="w-4 h-4 text-blue-600" />
                  <h4 className="text-xs font-bold text-slate-800">System Status</h4>
                </div>
                <div className="space-y-3">
                  <div>
                    <div className="flex justify-between text-xs mb-1">
                      <span className="text-slate-400">Server Uptime</span>
                      <span className="font-bold text-emerald-600">{currentSystemStatus.uptime}</span>
                    </div>
                    <div className="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                      <div className="bg-emerald-500 h-1.5 rounded-full" style={{ width: '99.9%' }}></div>
                    </div>
                  </div>
                  <div>
                    <div className="flex justify-between text-xs mb-1">
                      <span className="text-slate-400">Storage Capacity</span>
                      <span className="font-bold text-slate-700">{currentSystemStatus.storage}</span>
                    </div>
                    <div className="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                      <div className="bg-blue-600 h-1.5 rounded-full" style={{ width: '64.2%' }}></div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          {/* 3. RECENT ACTIVITY TABLE (REAL-TIME UPDATING) */}
          <div className="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
            <div className="p-6 flex items-center justify-between border-b border-slate-100">
              <div>
                <h3 className="text-base font-bold text-slate-800">Recent Activity</h3>
                <p className="text-xs text-slate-400">Real-time database updates from students & staff</p>
              </div>
              <Link href="/admin/program-khusus" className="text-xs font-semibold text-blue-600 hover:underline">
                View All Activities
              </Link>
            </div>

            <div className="overflow-x-auto">
              <table className="w-full text-left border-collapse">
                <thead>
                  <tr className="bg-slate-50/70 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                    <th className="py-3 px-6">Action / Event</th>
                    <th className="py-3 px-6">Status</th>
                    <th className="py-3 px-6">Timestamp</th>
                    <th className="py-3 px-4 text-right"></th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-100 text-xs">
                  {displayActivities.map((item, index) => {
                    const ItemIcon = item.icon || Users;
                    return (
                      <tr key={item.id || index} className="hover:bg-slate-50/50 transition-colors">
                        <td className="py-3.5 px-6">
                          <div className="flex items-center gap-3">
                            <div className={`w-9 h-9 rounded-full flex items-center justify-center shrink-0 ${item.iconBg || 'bg-blue-50 text-blue-600'}`}>
                              <ItemIcon className="w-4 h-4" />
                            </div>
                            <div>
                              <p className="font-semibold text-slate-800">{item.title}</p>
                              <p className="text-[11px] text-slate-400">{item.subtitle}</p>
                            </div>
                          </div>
                        </td>
                        <td className="py-3.5 px-6">
                          <span className={`text-[11px] font-semibold px-2.5 py-1 rounded-full ${
                            item.statusType === 'success' || item.status === 'Success' ? 'text-emerald-700 bg-emerald-50' :
                            item.statusType === 'warning' || item.status === 'Pending Review' ? 'text-amber-700 bg-amber-50' :
                            item.statusType === 'active' || item.status === 'Active' ? 'text-emerald-700 bg-emerald-50' :
                            item.statusType === 'teal' || item.status === 'Graduated' ? 'text-teal-700 bg-teal-50' :
                            item.statusType === 'danger' || item.status === 'High-Priority' ? 'text-red-700 bg-red-50' :
                            'text-slate-600 bg-slate-100'
                          }`}>
                            {item.status}
                          </span>
                        </td>
                        <td className="py-3.5 px-6 text-slate-400 font-medium">
                          {item.timestamp}
                        </td>
                        <td className="py-3.5 px-4 text-right">
                          <button className="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-100">
                            <MoreVertical className="w-4 h-4" />
                          </button>
                        </td>
                      </tr>
                    );
                  })}
                </tbody>
              </table>
            </div>
          </div>

          {/* Sub-Footer */}
          <footer className="flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 pt-4 border-t border-slate-200/60 gap-2">
            <p>© 2026 Elcoding Academy. Professional Admin Dashboard.</p>
            <div className="flex gap-4">
              <a href="#" className="hover:underline">Privacy Policy</a>
              <a href="#" className="hover:underline">Terms of Service</a>
              <a href="#" className="hover:underline">System Documentation</a>
            </div>
          </footer>

        </main>
      </div>
    </div>
  );
}