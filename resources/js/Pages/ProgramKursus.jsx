import React, { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import { 
  GraduationCap, Check, ArrowRight, Download, 
  MessageCircle, Phone, Mail, MapPin, ChevronDown, ChevronUp, Clock, Users, Award
} from 'lucide-react';

export default function ProgramKursusPage() {
  const [openFaq, setOpenFaq] = useState(null);

  const toggleFaq = (index) => {
    setOpenFaq(openFaq === index ? null : index);
  };

  return (
    <div className="bg-slate-50 min-h-screen font-sans text-slate-700 selection:bg-blue-600 selection:text-white">
      <Head title="Program Kursus - Elcoding Academy" />

      {/* ================= NAVBAR ================= */}
      <nav className="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
        <div className="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
          
          {/* Logo */}
          <div className="flex items-center gap-2">
            <div className="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center shadow-md shadow-blue-200">
              <GraduationCap className="w-6 h-6" />
            </div>
            <span className="text-xl font-extrabold text-blue-700 tracking-tight">Elcoding Academy</span>
          </div>

         {/* Navigation Menu */}
          <div className="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
            <Link href="/" className="hover:text-blue-600 transition-colors">Beranda</Link>
            <Link href="/program-kursus" className="text-blue-600">Program Kursus</Link>
            
            {/* Ubah baris Artikel ini */}
            <Link href="/artikel-publik" className="hover:text-blue-600 transition-colors">Artikel</Link>
            
            <Link href="/tentang-kami-publik" className="hover:text-blue-600 transition-colors">Tentang Kami</Link>
            <Link href="/kontak-publik" className="hover:text-blue-600 transition-colors">Kontak</Link>
          </div>

          {/* Tombol Konsultasi */}
          <div>
            <a
              href="https://wa.me/"
              target="_blank"
              rel="noreferrer"
              className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-500/20 transition-all hover:scale-105 inline-flex items-center gap-2"
            >
              Konsultasi
            </a>
          </div>
        </div>
      </nav>

      {/* ================= HERO SECTION ================= */}
      <section className="max-w-7xl mx-auto px-6 pt-12 pb-16 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <span className="inline-block bg-blue-50 text-blue-600 text-xs font-bold px-3 py-1.5 rounded-full mb-6 border border-blue-100">
            ✨ AKSELERASI INDUSTRI GLOBAL
          </span>
          <h1 className="text-4xl sm:text-5xl font-extrabold text-slate-900 leading-tight mb-6">
            Mastering Full-Stack Web Development
          </h1>
          <p className="text-slate-600 text-sm sm:text-base mb-8 leading-relaxed">
            Akselerasi karier IT Anda dalam 12 minggu. Belajar dari praktik, langsung dengan kurikulum berbasis proyek nyata yang dirancang untuk menjadikan Anda pengembang software siap kerja.
          </p>
          <div className="flex flex-wrap items-center gap-6 text-xs font-semibold text-slate-500 mb-8">
            <div className="flex items-center gap-2"><Clock className="w-4 h-4 text-blue-600" /> 12 MINGGU INTENSIF</div>
            <div className="flex items-center gap-2"><Users className="w-4 h-4 text-blue-600" /> Mentorship 1-on-1</div>
            <div className="flex items-center gap-2"><Award className="w-4 h-4 text-blue-600" /> Sertifikat Resmi</div>
          </div>
          <a href="https://wa.me/" target="_blank" rel="noreferrer" className="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-2xl font-bold text-sm shadow-xl shadow-blue-500/30 transition-all">
            Daftar Sekarang <ArrowRight className="w-4 h-4" />
          </a>
        </div>

        {/* Hero Visual Card */}
        <div className="bg-white p-4 rounded-3xl border border-slate-200 shadow-xl relative overflow-hidden">
          <div className="bg-slate-900 rounded-2xl p-4 text-white flex items-center justify-center min-h-[280px]">
            <div className="text-center">
              <span className="text-3xl">💻</span>
              <p className="font-bold mt-2 text-sm">Interactive Coding Workspace</p>
            </div>
          </div>
          <div className="absolute bottom-6 left-6 bg-white p-3 rounded-xl border border-slate-100 shadow-lg flex items-center gap-3">
            <div className="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center font-bold">✓</div>
            <div>
              <p className="text-xs font-bold text-slate-800">100% Lulusan Terserap</p>
              <p className="text-[10px] text-slate-400">Durasi Kampung & Magang Kerja</p>
            </div>
          </div>
        </div>
      </section>

      {/* ================= PILIHAN PROGRAM / BOOTCAMP ================= */}
      <section className="max-w-7xl mx-auto px-6 py-12">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          {/* Card 1: Full Stack Web Dev */}
          <div className="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between relative overflow-hidden">
            <div>
              <span className="absolute top-4 left-0 bg-purple-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-r-xl uppercase tracking-wider shadow-[0_4px_15px_rgba(139,92,246,0.4)] z-10">★ Recommended</span>
              <h3 className="text-xl font-bold text-slate-900 mt-6 mb-3">Bootcamp Intensif Full Stack Web Dev</h3>
              <ul className="space-y-3 text-xs text-slate-600 mb-8">
                <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Durasi Belajar 4 Bulan</li>
                <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Materi Sesuai Kurikulum Industri</li>
                <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Pembelajaran Project Based</li>
                <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Didampingi Mentor Expert</li>
                <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Mendapat Sertifikat Kompetensi</li>
              </ul>
            </div>
            <div>
              <div className="mb-4">
                <span className="text-xs text-slate-400">Mulai dari</span>
                <h4 className="text-2xl font-extrabold text-blue-600">Rp 2.500.000</h4>
              </div>
              <a href="https://wa.me/" target="_blank" rel="noreferrer" className="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm shadow-md transition-all flex items-center justify-center gap-2">
                Konsultasi Sekarang <ArrowRight className="w-4 h-4" />
              </a>
            </div>
          </div>

          {/* Card 2: UI/UX Design */}
          <div className="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between relative overflow-hidden">
            <div>
              <span className="absolute top-4 left-0 bg-red-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-r-xl uppercase tracking-wider shadow-[0_4px_15px_rgba(239,68,68,0.4)] z-10">🔥 Terlaris</span>
              <h3 className="text-xl font-bold text-slate-900 mt-6 mb-3">Mastering Skill UI/UX Design</h3>
              <ul className="space-y-3 text-xs text-slate-600 mb-8">
                <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Durasi Belajar 3 Bulan</li>
                <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Materi Standard Industri Dunia</li>
              </ul>
            </div>
            <div>
              <div className="mb-4">
                <span className="text-xs text-slate-400">Mulai dari</span>
                <h4 className="text-2xl font-extrabold text-blue-600">Rp 1.800.000</h4>
              </div>
              <a href="https://wa.me/" target="_blank" rel="noreferrer" className="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm shadow-md transition-all flex items-center justify-center gap-2">
                Konsultasi Sekarang <ArrowRight className="w-4 h-4" />
              </a>
            </div>
          </div>

          {/* Card 3: Digital Marketing */}
          <div className="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between relative overflow-hidden">
            <div>
              <span className="absolute top-4 left-0 bg-blue-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-r-xl uppercase tracking-wider shadow-[0_4px_15px_rgba(59,130,246,0.4)] z-10">Professional</span>
              <h3 className="text-xl font-bold text-slate-900 mt-6 mb-3">Professional Class Digital Marketing</h3>
              <ul className="space-y-3 text-xs text-slate-600 mb-8">
                <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Durasi Belajar 2 Bulan</li>
                <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Sertifikasi Meta & Google Ads</li>
              </ul>
            </div>
            <div>
              <div className="mb-4">
                <span className="text-xs text-slate-400">Mulai dari</span>
                <h4 className="text-2xl font-extrabold text-blue-600">Rp 1.500.000</h4>
              </div>
              <a href="https://wa.me/" target="_blank" rel="noreferrer" className="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm shadow-md transition-all flex items-center justify-center gap-2">
                Konsultasi Sekarang <ArrowRight className="w-4 h-4" />
              </a>
            </div>
          </div>

        </div>
      </section>

      {/* ================= KURIKULUM 12 MINGGU ================= */}
      <section className="max-w-7xl mx-auto px-6 py-16">
        <div className="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
          <div>
            <h2 className="text-3xl font-extrabold text-slate-900 mb-2">Kurikulum 12 Minggu</h2>
            <p className="text-slate-500 text-sm">Perjalanan transformasi dari pemula sampai menjadi Full-Stack Developer profesional dalam 3 bulan paling terstruktur.</p>
          </div>
          <a href="#" className="inline-flex items-center gap-2 text-xs font-bold text-blue-600 hover:underline">
            Unduh Silabus Lengkap (PDF) <Download className="w-4 h-4" />
          </a>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          {[
            { weeks: 'MINGGU 1-3', title: 'Foundations & UX', items: ['HTML & Semantic Structure', 'Advanced CSS & Responsive Design', 'UI/UX Basics & Accessibility'] },
            { weeks: 'MINGGU 4-7', title: 'Logic & Interactions', items: ['JavaScript ES6+ Fundamentals', 'DOM Manipulation', 'Asynchronous Programming & APIs'] },
            { weeks: 'MINGGU 8-10', title: 'Modern Frameworks', items: ['React.js & State Management', 'Component Lifecycle', 'Testing with Jest & RTL'] },
            { weeks: 'MINGGU 11-12', title: 'Back-end & Deployment', items: ['Node.js & Express', 'Database (SQL/NoSQL)', 'CI/CD & Cloud Hosting'] }
          ].map((mod, idx) => (
            <div key={idx} className="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
              <span className="bg-purple-50 text-purple-600 text-[10px] font-bold px-2.5 py-1 rounded-md">{mod.weeks}</span>
              <h3 className="text-lg font-bold text-slate-900 mt-3 mb-4">{mod.title}</h3>
              <ul className="space-y-2 text-xs text-slate-500">
                {mod.items.map((item, i) => (
                  <li key={i} className="flex items-center gap-2">
                    <span className="w-1.5 h-1.5 bg-blue-600 rounded-full"></span> {item}
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>
      </section>

      {/* ================= CTA & FAQ ================= */}
      <section className="max-w-7xl mx-auto px-6 mb-20">
        <div className="bg-blue-600 rounded-3xl p-10 sm:p-14 text-white grid grid-cols-1 lg:grid-cols-2 gap-10 items-center shadow-2xl shadow-blue-500/20">
          <div>
            <h2 className="text-3xl sm:text-4xl font-extrabold mb-4">Masih Bingung Memilih Program?</h2>
            <p className="text-blue-100 text-sm leading-relaxed mb-8">Dapatkan konsultasi gratis 15 menit dengan penasihat karier kami untuk menemukan jalur belajar yang paling sesuai dengan tujuan Anda.</p>
            <div className="flex flex-wrap gap-4">
              <a href="https://wa.me/" target="_blank" rel="noreferrer" className="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3.5 rounded-2xl font-bold text-sm shadow-xl transition-all flex items-center gap-2">
                <MessageCircle className="w-5 h-5" /> Chat WhatsApp Kami
              </a>
              <a href="https://wa.me/" target="_blank" rel="noreferrer" className="bg-white text-blue-600 hover:bg-slate-100 px-6 py-3.5 rounded-2xl font-bold text-sm shadow-xl transition-all">
                Jadwalkan Panggilan
              </a>
            </div>
          </div>

          {/* FAQ Accordion */}
          <div className="bg-blue-700/50 backdrop-blur-md p-6 rounded-2xl border border-blue-500/30 space-y-4">
            <h4 className="font-bold text-sm text-blue-200 uppercase tracking-wider mb-2">FAQ Singkat</h4>
            
            <div className="bg-blue-800/40 rounded-xl border border-blue-600/40 overflow-hidden">
              <button onClick={() => toggleFaq(1)} className="w-full p-4 text-left font-semibold text-sm flex justify-between items-center">
                Bisa untuk pemula? {openFaq === 1 ? <ChevronUp className="w-4 h-4" /> : <ChevronDown className="w-4 h-4" />}
              </button>
              {openFaq === 1 && (
                <div className="p-4 pt-0 text-xs text-blue-100 leading-relaxed border-t border-blue-700/40">
                  Tentu saja! Program kami dirancang dari nol (dasar) hingga mahir, cocok bagi pemula yang belum pernah memiliki pengalaman coding sebelumnya.
                </div>
              )}
            </div>

            <div className="bg-blue-800/40 rounded-xl border border-blue-600/40 overflow-hidden">
              <button onClick={() => toggleFaq(2)} className="w-full p-4 text-left font-semibold text-sm flex justify-between items-center">
                Ada jaminan kerja? {openFaq === 2 ? <ChevronUp className="w-4 h-4" /> : <ChevronDown className="w-4 h-4" />}
              </button>
              {openFaq === 2 && (
                <div className="p-4 pt-0 text-xs text-blue-100 leading-relaxed border-t border-blue-700/40">
                  Kami menyediakan fasilitas penyaluran kerja dan magang ke berbagai jaringan mitra perusahaan korporasi yang bekerja sama dengan Elcoding Academy.
                </div>
              )}
            </div>
          </div>
        </div>
      </section>

      {/* ================= FOOTER ================= */}
      <footer className="bg-slate-900 text-slate-400 py-16 px-6 border-t border-slate-800">
        <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 text-sm">
          <div>
            <h4 className="font-extrabold text-white text-base mb-4 flex items-center gap-2">
              <GraduationCap className="w-5 h-5 text-blue-500" /> Elcoding
            </h4>
            <p className="text-xs leading-relaxed mb-6">Mencetak talenta digital berkualitas, disusul akar pendidikan teknologi yang transformatif dan inovatif.</p>
            <div className="flex gap-3">
              <span className="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center font-bold text-slate-300 hover:bg-blue-600 transition-colors cursor-pointer">f</span>
              <span className="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center font-bold text-slate-300 hover:bg-blue-600 transition-colors cursor-pointer">ig</span>
            </div>
          </div>

          <div>
            <h4 className="font-bold text-white text-sm mb-4">Program Kursus</h4>
            <ul className="space-y-2 text-xs">
              <li><a href="#" className="hover:text-white">Full-Stack Web</a></li>
              <li><a href="#" className="hover:text-white">Mobile Development</a></li>
              <li><a href="#" className="hover:text-white">UI/UX Design</a></li>
              <li><a href="#" className="hover:text-white">Data Science</a></li>
            </ul>
          </div>

          <div>
            <h4 className="font-bold text-white text-sm mb-4">Navigasi</h4>
            <ul className="space-y-2 text-xs">
              <li><a href="#" className="hover:text-white">Tentang Kami</a></li>
              <li><a href="#" className="hover:text-white">Karier</a></li>
              <li><a href="#" className="hover:text-white">Profil Berita</a></li>
              <li><a href="#" className="hover:text-white">Pusat Bantuan</a></li>
            </ul>
          </div>

          <div>
            <h4 className="font-bold text-white text-sm mb-4">Hubungi Kami</h4>
            <p className="text-xs mb-2 flex items-center gap-2"><Mail className="w-4 h-4 text-blue-500" /> info@elcoding.com</p>
            <p className="text-xs mb-2 flex items-center gap-2"><Phone className="w-4 h-4 text-blue-500" /> +62 814-7665-2656</p>
            <p className="text-xs mb-2">🕒 Senin - Jumat (09.00 - 16.00)</p>
          </div>
        </div>

        <div className="max-w-7xl mx-auto border-t border-slate-800 mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500">
          <p>© 2026 Elcoding Academy. All rights reserved.</p>
          <div className="flex gap-6 mt-4 sm:mt-0">
            <a href="#" className="hover:underline">Kebijakan Privasi</a>
            <a href="#" className="hover:underline">Syarat & Ketentuan</a>
          </div>
        </div>
      </footer>
    </div>
  );
}