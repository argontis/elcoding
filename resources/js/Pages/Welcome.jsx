import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { 
  GraduationCap, Award, Cpu, Briefcase, Users, 
  BookOpen, Code, ShieldCheck, ArrowRight, CheckCircle2, 
  MessageCircle, Phone, Mail, MapPin, Globe, Check
} from 'lucide-react';

export default function Welcome({ canLogin, canRegister }) {
  return (
    <div className="bg-slate-50 min-h-screen font-sans text-slate-700 selection:bg-blue-600 selection:text-white">
      <Head title="Elcoding Academy - Kuasai Keahlian IT & Bangun Karier Impian" />

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
            <Link href="/" className="text-blue-600">Beranda</Link>
            <Link href="/program-kursus" className="hover:text-blue-600 transition-colors">Program Kursus</Link>
            
            {/* Ubah baris Artikel ini */}
            <a href="/artikel-publik" className="hover:text-blue-600 transition-colors">Artikel</a>
            
            <Link href="/tentang-kami-publik" className="hover:text-blue-600 transition-colors">Tentang Kami</Link>
            <Link href="/kontak-publik" className="hover:text-blue-600 transition-colors">Kontak</Link>
          </div>

          {/* Tombol Konsultasi (Menggantikan Daftar/Masuk) */}
          <div>
            <a
              href="https://wa.me/"
              target="_blank"
              rel="noreferrer"
              className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-500/20 transition-all hover:scale-105 inline-flex items-center gap-2"
            >
              <MessageCircle className="w-4 h-4" /> Konsultasi
            </a>
          </div>
        </div>
      </nav>

      {/* ================= HERO SECTION ================= */}
      <section className="max-w-7xl mx-auto px-6 pt-12 pb-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <span className="inline-block bg-blue-50 text-blue-600 text-xs font-bold px-3 py-1.5 rounded-full mb-6 border border-blue-100">
            🚀 Platform Pelatihan IT Terbaik
          </span>
          <h1 className="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
            Kuasai Keahlian IT, Bangun Karier Impian Bersama <span className="text-blue-600">Elcoding Academy</span>
          </h1>
          <p className="text-slate-600 text-base sm:text-lg mb-8 leading-relaxed">
            Lembaga kursus dan pelatihan IT terbaik di Tegal, berdiri sejak 2022. Kami membantu Anda meriah karier impian di dunia teknologi melalui program kelas komprehensif dan praktik magang langsung.
          </p>
          <div className="flex flex-wrap gap-4">
            <a href="#program" className="bg-blue-600 hover:bg-blue-700 text-white px-7 py-3.5 rounded-2xl font-bold text-sm shadow-xl shadow-blue-500/30 transition-all flex items-center gap-2">
              Mulai Belajar Sekarang <ArrowRight className="w-4 h-4" />
            </a>
            {/* Mengubah link Lihat Program ke halaman /program-kursus */}
            <Link href="/program-kursus" className="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-7 py-3.5 rounded-2xl font-bold text-sm shadow-sm transition-all">
              Lihat Program
            </Link>
          </div>
        </div>

        {/* Ilustrasi Hero Card */}
        <div className="relative">
          <div className="bg-gradient-to-tr from-blue-600 to-indigo-500 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
            <div className="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-2xl"></div>
            <div className="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/20 mb-6">
              <div className="flex items-center gap-4 mb-4">
                <div className="w-12 h-12 bg-white text-blue-600 rounded-xl flex items-center justify-center font-bold text-xl shadow">💻</div>
                <div>
                  <h4 className="font-bold text-lg">Fullstack Developer</h4>
                  <p className="text-xs text-blue-100">Batch 14 • Segera Dibuka</p>
                </div>
              </div>
              <div className="w-full bg-black/20 rounded-full h-2">
                <div className="bg-emerald-400 h-2 rounded-full w-3/4"></div>
              </div>
            </div>
            <p className="text-sm font-medium text-blue-50">"Kurikulum dirancang langsung oleh praktisi senior untuk memastikan Anda siap menghadapi dunia kerja."</p>
          </div>
        </div>
      </section>

      {/* ================= MENGAPA BELAJAR DI ELCODING ================= */}
      <section className="bg-white py-20 border-y border-slate-100">
        <div className="max-w-7xl mx-auto px-6 text-center">
          <h2 className="text-3xl font-extrabold text-slate-900 mb-3">Mengapa Belajar di Elcoding?</h2>
          <p className="text-slate-500 text-sm max-w-xl mx-auto mb-16">Kami menyediakan sistem pembelajaran dirancang khusus untuk mengantarkan Anda bertransformasi berkarier di dunia digital.</p>

          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-left">
            {[
              { icon: Award, title: 'Mentor Expert', desc: 'Belajar langsung dari praktisi profesional yang aktif di industri.' },
              { icon: Cpu, title: 'Fokus Praktik', desc: 'Kurikulum dengan 80% praktik untuk unukting problem-solving.' },
              { icon: Briefcase, title: 'Project Based', desc: 'Hasilkan portofolio nyata untuk bersaing di dunia kerja.' },
              { icon: Users, title: 'Penyaluran Kerja', desc: 'Peluang magang & disalurkan bekerja ke berbagai mitra perusahaan.' }
            ].map((item, idx) => (
              <div key={idx} className="bg-slate-50 p-6 rounded-2xl border border-slate-100 hover:shadow-lg transition-all group">
                <div className="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-blue-600 group-hover:text-white transition-all">
                  <item.icon className="w-6 h-6" />
                </div>
                <h3 className="font-bold text-slate-800 text-lg mb-2">{item.title}</h3>
                <p className="text-slate-500 text-xs leading-relaxed">{item.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ================= LAYANAN UTAMA KAMI ================= */}
      <section id="program" className="py-20 max-w-7xl mx-auto px-6">
        <div className="text-center mb-16">
          <h2 className="text-3xl font-extrabold text-slate-900 mb-3">Layanan Utama Kami</h2>
          <p className="text-slate-500 text-sm">Pilih program kursus atau konsultasi profesional yang paling tepat untuk masa depan Anda.</p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {[
            { title: 'Pelatihan & Kursus IT', desc: 'Program kursus intensif bersertifikat dengan kurikulum update mengikuti standar industri teknologi terkini.', icon: BookOpen },
            { title: 'Konsultasi Skripsi', desc: 'Bimbingan intensif dan konsultasi masalah teknis skripsi, riset, serta pembuatan software tugas akhir.', icon: Code },
            { title: 'Software House', desc: 'Jasa pembuatan website, aplikasi mobile, dan sistem informasi profesional untuk kebutuhan bisnis Anda.', icon: ShieldCheck }
          ].map((srv, idx) => (
            <div key={idx} className="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between">
              <div>
                <div className="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                  <srv.icon className="w-7 h-7" />
                </div>
                <h3 className="text-xl font-bold text-slate-900 mb-3">{srv.title}</h3>
                <p className="text-slate-500 text-sm leading-relaxed mb-6">{srv.desc}</p>
              </div>
              <a href="#" className="inline-flex items-center gap-2 text-blue-600 font-bold text-sm hover:gap-3 transition-all">
                Detail Program <ArrowRight className="w-4 h-4" />
              </a>
            </div>
          ))}
        </div>
      </section>
      {/* ================= PROGRAM KURSUS (BOOTCAMP) ================= */}
      <section className="bg-slate-50 py-20 border-y border-slate-100">
        <div className="max-w-7xl mx-auto px-6">
          <div className="text-center mb-16">
            <h2 className="text-3xl font-extrabold text-slate-900 mb-3">Pilihan Program Kursus</h2>
            <p className="text-slate-500 text-sm">Program unggulan kami yang dirancang khusus untuk kebutuhan industri saat ini.</p>
          </div>

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
                  <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Pembelajaran Project Based</li>
                  <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Didampingi Mentor Expert</li>
                  <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Mendapat Sertifikat Kompetensi</li>
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
                  <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Pembelajaran Project Based</li>
                  <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Didampingi Mentor Expert</li>
                  <li className="flex items-start gap-2"><Check className="w-4 h-4 text-blue-600 shrink-0 mt-0.5" /> Mendapat Sertifikat Kompetensi</li>
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
        </div>
      </section>
      {/* ================= MITRA ================= */}
      <section id="mitra" className="py-16 bg-white border-y border-slate-100">
        <div className="max-w-7xl mx-auto px-6 text-center">
          <h2 className="text-2xl font-bold text-slate-800 mb-10">Mitra & Kolaborator Kami</h2>
          <div className="flex flex-wrap justify-center items-center gap-8 opacity-75">
            {['Mitra Korporasi 1', 'Universitas Mitra', 'Lembaga Pendidikan', 'Tech Partner', 'Kementerian Terkait'].map((mitra, i) => (
              <div key={i} className="h-16 px-8 bg-slate-50 border border-slate-200 rounded-2xl flex items-center justify-center font-bold text-slate-400 text-sm tracking-wide">
                {mitra}
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ================= PORTOFOLIO KAMI ================= */}
      <section id="portofolio" className="py-20 max-w-7xl mx-auto px-6">
        <div className="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
          <div>
            <h2 className="text-3xl font-extrabold text-slate-900 mb-2">Portofolio & Artikel Terbaru</h2>
            <p className="text-slate-500 text-sm">Karya nyata siswa serta wawasan seputar teknologi terbaru dari instruktur kami.</p>
          </div>
          <div className="flex gap-2">
            {['Semua', 'Bahasa', 'Coding', 'Desain Grafis'].map((cat, idx) => (
              <button key={idx} className={`px-4 py-2 rounded-xl text-xs font-semibold ${idx === 0 ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'}`}>
                {cat}
              </button>
            ))}
          </div>
        </div>

        {/* Grid Artikel / Portofolio Contoh */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {[
            { title: 'Peluang Karier Fullstack Developer di Tahun 2026', cat: 'Coding', date: '29 Jul 2026' },
            { title: 'Tips Pemula Karier UI/UX Designer dari Nol', cat: 'Desain Grafis', date: '25 Jul 2026' },
            { title: 'Mengapa Cyber Security Sangat Dibutuhkan Saat Ini?', cat: 'Teknologi', date: '20 Jul 2026' }
          ].map((art, idx) => (
            <div key={idx} className="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between">
              <div className="h-48 bg-slate-100 flex items-center justify-center text-slate-400 font-bold">
                Thumbnail Artikel
              </div>
              <div className="p-6">
                <div className="flex items-center gap-2 text-xs text-blue-600 font-bold mb-2">
                  <span>{art.cat}</span> • <span>{art.date}</span>
                </div>
                <h3 className="font-bold text-slate-900 text-base leading-snug mb-4">{art.title}</h3>
                <a href="#" className="inline-flex items-center gap-2 text-xs font-bold text-slate-700 hover:text-blue-600">
                  Baca Selengkapnya <ArrowRight className="w-3.5 h-3.5" />
                </a>
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* ================= CTA (SIAP MEMULAI KARIER) ================= */}
      <section className="max-w-7xl mx-auto px-6 mb-20">
        <div className="bg-blue-600 rounded-3xl p-10 sm:p-14 text-white flex flex-col lg:flex-row items-center justify-between shadow-2xl shadow-blue-500/20 relative overflow-hidden">
          <div className="absolute right-0 bottom-0 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
          <div className="max-w-xl mb-8 lg:mb-0 relative z-10">
            <h2 className="text-3xl sm:text-4xl font-extrabold mb-4">Siap Memulai Karier Impianmu?</h2>
            <p className="text-blue-100 text-sm sm:text-base leading-relaxed">Jangan tunda keputusanmu. Bergabunglah dengan ribuan alumni sukses lainnya yang telah siap berkarier di industri digital.</p>
          </div>
          <div className="flex flex-col sm:flex-row gap-4 relative z-10 w-full lg:w-auto">
            <a href="https://wa.me/" target="_blank" rel="noreferrer" className="bg-white text-blue-600 hover:bg-slate-100 px-8 py-4 rounded-2xl font-bold text-center text-sm shadow-xl transition-all">
              Daftar Sekarang
            </a>
            <a href="https://wa.me/" target="_blank" rel="noreferrer" className="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-4 rounded-2xl font-bold text-center text-sm shadow-xl transition-all flex items-center justify-center gap-2">
              <MessageCircle className="w-5 h-5" /> Konsultasi WhatsApp
            </a>
          </div>
        </div>
      </section>

      {/* ================= FOOTER ================= */}
      <footer id="kontak" className="bg-white border-t border-slate-200 py-16 px-6">
        <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 text-sm text-slate-500">
          <div>
            <h4 className="font-extrabold text-blue-700 text-base mb-4 flex items-center gap-2">
              <GraduationCap className="w-5 h-5" /> Elcoding Academy
            </h4>
            <p className="leading-relaxed mb-6">Lembaga kursus dan pelatihan terpadu yang mencakup IT & Coding, Bahasa Asing, hingga Desain Grafis berbasis praktik langsung.</p>
            <div className="flex gap-3">
              <span className="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center font-bold text-slate-600 hover:bg-blue-600 hover:text-white transition-colors cursor-pointer">f</span>
              <span className="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center font-bold text-slate-600 hover:bg-blue-600 hover:text-white transition-colors cursor-pointer">ig</span>
              <span className="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center font-bold text-slate-600 hover:bg-blue-600 hover:text-white transition-colors cursor-pointer">in</span>
            </div>
          </div>

          <div>
            <h4 className="font-bold text-slate-900 text-base mb-4">Program</h4>
            <ul className="space-y-3">
              <li><Link href="/program-kursus" className="hover:text-blue-600">Fullstack Expert</Link></li>
              <li><Link href="/program-kursus" className="hover:text-blue-600">Cyber Security</Link></li>
              <li><Link href="/program-kursus" className="hover:text-blue-600">Digital Marketing</Link></li>
            </ul>
          </div>

          <div>
            <h4 className="font-bold text-slate-900 text-base mb-4">Perusahaan</h4>
            <ul className="space-y-3">

              <li><a href="#" className="hover:text-blue-600">Blog</a></li>
              <li><a href="#" className="hover:text-blue-600">Kebijakan Privasi</a></li>
            </ul>
          </div>

          <div>
            <h4 className="font-bold text-slate-900 text-base mb-4">Hubungi Kami</h4>
            <p className="mb-3 flex items-start gap-2"><MapPin className="w-4 h-4 text-blue-600 shrink-0 mt-1" /> Ruko Citraland, Tegal, Jawa Tengah</p>
            <p className="mb-3 flex items-center gap-2"><Phone className="w-4 h-4 text-blue-600 shrink-0" /> Admin: +62 814-7665-2656</p>
            <p className="mb-3 flex items-center gap-2"><Mail className="w-4 h-4 text-blue-600 shrink-0" /> info@elcodingacademy.com</p>
          </div>
        </div>

        <div className="max-w-7xl mx-auto border-t border-slate-100 mt-12 pt-8 text-center text-xs text-slate-400">
          Copyright © 2026 Elcoding Academy. All Rights Reserved. Membangun Karier IT Masa Depan.
        </div>
      </footer>
    </div>
  );
}