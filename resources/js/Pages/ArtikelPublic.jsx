import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { 
  Calendar, ArrowRight, MapPin, Phone, Mail, 
  Clock, MessageCircle, ChevronDown 
} from 'lucide-react';

export default function ArtikelPublic() {
  const articles = [
    {
      id: 1,
      tag: 'TEKNOLOGI',
      tagColor: 'bg-blue-100 text-blue-600',
      date: '24 Jun 2026',
      title: 'Mengapa Belajar Pemrograman Adalah...',
      desc: 'Di era digital yang berkembang dengan sangat pesat, kemampuan pemrograman atau coding telah berubah dari sekadar...',
      img: 'https://placehold.co/600x400/e2e8f0/64748b?text=Ilustrasi+Teknologi' 
    },
    {
      id: 2,
      tag: 'EDUKASI',
      tagColor: 'bg-emerald-100 text-emerald-600',
      date: '20 Jun 2026',
      title: '5 Tips Memilih Bootcamp Web Developer yang Tepat',
      desc: 'Memilih bootcamp yang tepat adalah langkah penting. Pastikan Anda mempertimbangkan: Kurikulum yang up-...',
      img: 'https://placehold.co/600x400/e2e8f0/64748b?text=Ilustrasi+Edukasi' 
    },
    {
      id: 3,
      tag: 'DESAIN',
      tagColor: 'bg-indigo-100 text-indigo-600',
      date: '18 Jun 2026',
      title: 'Mengenal Perbedaan UI dan UX Design untuk Pemula',
      desc: 'User Interface (UI) dan User Experience (UX) adalah dua hal yang berbeda. UI fokus pada tampilan antarmuka seperti warna,...',
      img: 'https://placehold.co/600x400/e2e8f0/64748b?text=Ilustrasi+Desain' 
    }
  ];

  return (
    <div className="bg-[#f8fafc] min-h-screen font-sans text-slate-800 selection:bg-blue-600 selection:text-white relative">
      <Head title="Artikel - Elcoding Academy" />

      {/* ================= NAVBAR ================= */}
      <nav className="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div className="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
          
          {/* Logo */}
          <div className="flex items-center gap-2">
            <span className="text-xl font-bold text-blue-700 tracking-tight">Elcoding Academy</span>
          </div>

          {/* Navigation Menu */}
          <div className="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600 h-full">
            <Link href="/" className="hover:text-blue-600 transition-colors">Beranda</Link>
            <Link href="/program-kursus" className="hover:text-blue-600 transition-colors">Program Kursus</Link>
            
            {/* Active Link: Artikel */}
            <Link 
              href="/artikel-publik" 
              className="text-blue-600 border-b-2 border-blue-600 h-full flex items-center"
            >
              Artikel
            </Link>
            
            <Link href="/tentang-kami-publik" className="hover:text-blue-600 transition-colors">Tentang Kami</Link>
            <Link href="/kontak-publik" className="hover:text-blue-600 transition-colors">Kontak</Link>
          </div>

          {/* Tombol Daftar */}
          <div>
            <a
              href="https://wa.me/"
              target="_blank"
              rel="noreferrer"
              className="bg-[#0056D2] hover:bg-blue-800 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition-all"
            >
              Daftar Sekarang
            </a>
          </div>
        </div>
      </nav>

      {/* ================= ARTICLE GRID SECTION ================= */}
      <section className="max-w-7xl mx-auto px-6 py-12">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {articles.map((article) => (
            <div key={article.id} className="bg-white rounded-2xl shadow-[0_4px_20px_rgb(0,0,0,0.05)] overflow-hidden flex flex-col justify-between border border-slate-100">
              
              {/* Image & Tag */}
              <div className="relative h-48 bg-slate-100 overflow-hidden">
                <img 
                  src={article.img} 
                  alt={article.title} 
                  className="w-full h-full object-cover"
                />
                <span className={`absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-bold tracking-wider ${article.tagColor}`}>
                  {article.tag}
                </span>
              </div>

              {/* Content */}
              <div className="p-6 flex flex-col flex-grow">
                <div className="flex items-center gap-2 text-slate-400 text-xs font-medium mb-3">
                  <Calendar className="w-4 h-4" /> {article.date}
                </div>
                <h3 className="text-xl font-bold text-slate-800 mb-3 leading-snug">
                  {article.title}
                </h3>
                <p className="text-slate-500 text-sm leading-relaxed mb-6 flex-grow">
                  {article.desc}
                </p>
                
                <a href="#" className="w-full bg-[#0056D2] hover:bg-blue-800 text-white py-3 rounded-lg font-semibold text-sm transition-colors flex items-center justify-center gap-2 mt-auto">
                  BACA ARTIKEL <ArrowRight className="w-4 h-4" />
                </a>
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* ================= FOOTER ================= */}
      <footer id="kontak" className="bg-[#EAECEF] pt-16 mt-12">
        <div className="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 pb-12">
          
          {/* Column 1: Info */}
          <div>
            <h4 className="font-bold text-slate-900 text-xl mb-4">elcoding.id</h4>
            <p className="text-slate-600 text-sm leading-relaxed mb-6">
              Lembaga kursus dan pelatihan terpadu yang mencakup IT & Coding, Bahasa Asing, hingga Desain Grafis berbasis praktik.
            </p>
            
            <h5 className="font-bold text-slate-800 text-sm mb-3 border-b border-slate-300 inline-block pb-1">Jam Operasional</h5>
            <div className="space-y-2 text-sm text-slate-600">
              <p className="flex items-center gap-2"><Clock className="w-4 h-4 text-blue-600" /> Senin - Sabtu (08.00 - 17.00 WIB)</p>
              <p className="flex items-center gap-2 text-red-500"><Calendar className="w-4 h-4" /> Minggu (Libur)</p>
            </div>
          </div>

          {/* Column 2: Quick Links */}
          <div>
            <h4 className="font-bold text-slate-900 text-sm mb-4 border-b-2 border-blue-600 inline-block pb-1">Quick Links</h4>
            <ul className="space-y-3 text-sm text-slate-600">
              <li><a href="#" className="hover:text-blue-600">Tentang Kami</a></li>

              <li><Link href="/artikel-publik" className="text-blue-600 font-bold">Artikel</Link></li>
              <li><a href="#kontak" className="hover:text-blue-600">Kontak</a></li>
            </ul>
          </div>

          {/* Column 3: Panduan & Kebijakan */}
          <div>
            <h4 className="font-bold text-slate-900 text-sm mb-4 border-b-2 border-blue-600 inline-block pb-1">Panduan & Kebijakan</h4>
            <ul className="space-y-3 text-sm text-slate-600">
              <li><a href="#" className="hover:text-blue-600">FAQ</a></li>
              <li><a href="#" className="hover:text-blue-600">Syarat dan Ketentuan</a></li>
              <li><a href="#" className="hover:text-blue-600">Kebijakan Privasi</a></li>
            </ul>
          </div>

          {/* Column 4: Kontak */}
          <div>
            <h4 className="font-bold text-slate-900 text-sm mb-4 border-b-2 border-blue-600 inline-block pb-1">Informasi Kontak</h4>
            <div className="space-y-4 text-sm text-slate-600 mb-6">
              <p className="flex items-start gap-3">
                <MapPin className="w-5 h-5 text-blue-600 shrink-0 mt-0.5" /> 
                <span>Ruko Citraland, Tegal, Jawa Tengah</span>
              </p>
              <p className="flex items-center gap-3">
                <Phone className="w-4 h-4 text-emerald-500 shrink-0" /> 
                <span>Admin: +62 814-7665-2656</span>
              </p>
              <p className="flex items-center gap-3">
                <Mail className="w-4 h-4 text-blue-600 shrink-0" /> 
                <span>info@elcodingacademy.com</span>
              </p>
            </div>

            {/* Social Text Links Pengganti Ikon */}
            <div className="flex gap-4 text-xs font-bold text-blue-600">
              <a href="#" className="hover:underline">Facebook</a>
              <a href="#" className="hover:underline">Instagram</a>
              <a href="#" className="hover:underline">LinkedIn</a>
            </div>
          </div>
        </div>

        {/* Copyright Bottom Bar */}
        <div className="bg-[#0047b3] text-center py-4 px-6 text-blue-100 text-xs font-medium tracking-wide">
          Copyright © 2026 Elcoding Academy. All Rights Reserved. Membangun Karir IT Masa Depan.
        </div>
      </footer>

      {/* ================= FLOATING WHATSAPP BUTTON ================= */}
      <a 
        href="https://wa.me/6281476652656" 
        target="_blank" 
        rel="noreferrer"
        className="fixed bottom-6 right-6 w-14 h-14 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-emerald-500/30 hover:scale-110 transition-transform z-50"
      >
        <MessageCircle className="w-7 h-7" />
      </a>

    </div>
  );
}