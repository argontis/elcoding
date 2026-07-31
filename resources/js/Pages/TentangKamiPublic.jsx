import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { 
  Calendar, ArrowRight, MapPin, Phone, Mail, 
  Clock, MessageCircle, ChevronDown, Award, Cpu, Briefcase, CheckCircle2
} from 'lucide-react';

export default function TentangKamiPublic() {
  const portfolios = [
    {
      id: 1,
      title: 'Film Islami Kemenag',
      category: 'Coding',
      img: 'https://placehold.co/600x400/1e293b/ffffff?text=Film+Islami+Kemenag'
    },
    {
      id: 2,
      title: 'TOSTEM Prima Cipta',
      category: 'Desain Grafis',
      img: 'https://placehold.co/600x400/334155/ffffff?text=TOSTEM+Prima+Cipta'
    },
    {
      id: 3,
      title: 'Tutur Bangsa',
      category: 'Bahasa',
      img: 'https://placehold.co/600x400/475569/ffffff?text=Tutur+Bangsa'
    }
  ];

  const mechanisms = [
    { step: '1', title: 'Pendaftaran & Konsultasi Karir', desc: 'Memilih program kelas yang tepat dan berkonsultasi mengenai jalur karier impian Anda.' },
    { step: '2', title: 'Pembelajaran Praktik (80%)', desc: 'Mengikuti sesi mentoning intensif berbasis studi kasus industri terkini.' },
    { step: '3', title: 'Pembuatan Final Project', desc: 'Menyelesaikan proyek nyata untuk membangun portofolio profesional yang solid.' },
    { step: '4', title: 'Penyaluran Kerja & Magang', desc: 'Lulusan disalurkan magang atau bekerja langsung di jaringan mitra perusahaan kami.' }
  ];

  return (
    <div className="bg-[#f8fafc] min-h-screen font-sans text-slate-800 selection:bg-blue-600 selection:text-white relative">
      <Head title="Tentang Kami - Elcoding Academy" />

      {/* ================= NAVBAR ================= */}
      <nav className="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div className="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
          <div className="flex items-center gap-2">
            <span className="text-xl font-bold text-blue-700 tracking-tight">Elcoding Academy</span>
          </div>

          <div className="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600 h-full">
            <Link href="/" className="hover:text-blue-600 transition-colors">Beranda</Link>
            <Link href="/program-kursus" className="hover:text-blue-600 transition-colors">Program Kursus</Link>
            <Link href="/artikel-publik" className="hover:text-blue-600 transition-colors">Artikel</Link>
            
            <Link href="/tentang-kami-publik" className="text-blue-600 border-b-2 border-blue-600 h-full flex items-center">
              Tentang Kami
            </Link>
            
            <Link href="/kontak-publik" className="hover:text-blue-600 transition-colors">Kontak</Link>
          </div>

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

      {/* ================= PROFIL & VISI MISI SECTION ================= */}
      <section className="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <span className="text-blue-600 text-xs font-bold tracking-wider uppercase block mb-2">Profil Lembaga</span>
          <h1 className="text-4xl font-extrabold text-slate-900 mb-2">Elcoding</h1>
          <p className="text-sm font-medium text-slate-500 mb-6">Learn and Code with the Best</p>

          <h2 className="text-xl font-bold text-slate-900 mb-3">Visi dan Misi</h2>
          <div className="space-y-4 text-sm text-slate-600 leading-relaxed mb-6">
            <p><strong>Visi:</strong> Menjadi pusat pelatihan IT dan pengembangan skill digital terdepan yang menghasilkan SDM unggul, kompeten, dan siap kerja di era digital.</p>
            <p><strong>Misi:</strong> Menyediakan program pembelajaran berbasis praktik nyata dan magang untuk membekali talenta muda dengan keterampilan kerja, serta menghadirkan solusi IT profesional untuk bisnis.</p>
          </div>

          <h2 className="text-xl font-bold text-slate-900 mb-3">Goals</h2>
          <div className="space-y-3 text-sm text-slate-600 leading-relaxed mb-6">
            <p>Mencetak lulusan yang memiliki keterampilan teknis mumpuni, portofolio nyata, serta siap bersaing di dunia kerja modern.</p>
            <p>Menjadi mitra strategis bagi individu yang ingin berkarier di bidang teknologi dan bagi pelaku bisnis yang membutuhkan transformasi digital yang inovatif.</p>
          </div>

          <span className="inline-block bg-slate-100 text-slate-600 text-xs font-bold px-4 py-2 rounded-xl">
            Est. 2022 – Tegal
          </span>
        </div>

        {/* Ilustrasi Galeri / Foto Profil */}
        <div className="grid grid-cols-2 gap-4">
          <div className="bg-blue-50 p-4 rounded-3xl h-48 flex items-center justify-center font-bold text-blue-400 border border-blue-100 shadow-sm">
            Ilustrasi Belajar 1
          </div>
          <div className="bg-slate-200 p-4 rounded-3xl h-48 flex items-center justify-center font-bold text-slate-500 shadow-sm">
            Ilustrasi Studio
          </div>
          <div className="bg-indigo-50 p-4 rounded-3xl h-48 flex items-center justify-center font-bold text-indigo-400 border border-indigo-100 shadow-sm">
            Ilustrasi Proyek
          </div>
          <div className="bg-emerald-50 p-4 rounded-3xl h-48 flex items-center justify-center font-bold text-emerald-500 border border-emerald-100 shadow-sm">
            Ilustrasi Tim
          </div>
        </div>
      </section>

      {/* Deskripsi Singkat Kanan Atas */}
      <div className="max-w-7xl mx-auto px-6 mb-16">
        <div className="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm text-slate-600 text-sm leading-relaxed max-w-2xl">
          Elcoding adalah lembaga kursus dan pelatihan IT terbaik di Tegal, berdiri sejak tahun 2022. Kami membantu Anda meraih karier impian di dunia teknologi melalui program kelas yang komprehensif, bimbingan mentor ahli, dan pembuatan portofolio nyata.
        </div>
      </div>

      {/* ================= KEUNGGULAN (3 CARD) ================= */}
      <section className="max-w-7xl mx-auto px-6 mb-20">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start gap-4">
            <div className="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
              <Award className="w-6 h-6" />
            </div>
            <div>
              <h3 className="font-bold text-slate-900 mb-1">Mentor Expert</h3>
              <p className="text-xs text-slate-500 leading-relaxed">Belajar langsung dari praktisi profesional yang aktif di industri.</p>
            </div>
          </div>

          <div className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start gap-4">
            <div className="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center shrink-0">
              <Cpu className="w-6 h-6" />
            </div>
            <div>
              <h3 className="font-bold text-slate-900 mb-1">Fokus Praktik</h3>
              <p className="text-xs text-slate-500 leading-relaxed">Kurikulum dengan 80% praktik untuk unukting problem-solving.</p>
            </div>
          </div>

          <div className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start gap-4">
            <div className="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
              <Briefcase className="w-6 h-6" />
            </div>
            <div>
              <h3 className="font-bold text-slate-900 mb-1">Project Based</h3>
              <p className="text-xs text-slate-500 leading-relaxed">Hasilkan portofolio nyata untuk bersaing di dunia kerja.</p>
            </div>
          </div>
        </div>
      </section>

      {/* ================= MITRA ================= */}
      <section className="py-16 mb-20">
        <div className="max-w-7xl mx-auto px-6 text-center">
          <h2 className="text-2xl font-bold text-slate-900 mb-8">Mitra</h2>
          <div className="flex flex-wrap justify-center items-center gap-6">
            {['Mitra Korporasi 1', 'Universitas Mitra', 'Lembaga Pendidikan'].map((m, i) => (
              <div key={i} className="h-20 px-10 bg-transparent border-2 border-purple-600 rounded-2xl flex items-center justify-center font-bold text-purple-700 text-sm">
                {m}
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ================= PORTOFOLIO KAMI ================= */}
      <section className="max-w-7xl mx-auto px-6 mb-24">
        <div className="text-center mb-10">
          <h2 className="text-3xl font-extrabold text-slate-900 mb-2">Portofolio Kami</h2>
          <p className="text-slate-500 text-sm">Karya nyata dari para siswa dan instruktur Elcoding Academy dalam membangun solusi teknologi yang inovatif.</p>
        </div>

        {/* Filter Tombol */}
        <div className="flex justify-center gap-2 mb-10">
          {['Semua', 'Bahasa', 'Coding', 'Desain Grafis'].map((cat, idx) => (
            <button key={idx} className={`px-5 py-2 rounded-xl text-xs font-semibold ${idx === 0 ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'}`}>
              {cat}
            </button>
          ))}
        </div>

        {/* Grid Portofolio */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {portfolios.map((item) => (
            <div key={item.id} className="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between">
              <div className="h-48 bg-slate-100 overflow-hidden relative">
                <img src={item.img} alt={item.title} className="w-full h-full object-cover" />
              </div>
              <div className="p-6 text-center">
                <h3 className="text-lg font-bold text-slate-900 mb-1">{item.title}</h3>
                <p className="text-xs text-slate-400 font-medium">{item.category}</p>
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* ================= MEKANISME ELCODING ================= */}
      <section className="max-w-7xl mx-auto px-6 mb-24">
        <div className="text-center mb-16">
          <h2 className="text-3xl font-extrabold text-slate-900 mb-2">Mekanisme Elcoding</h2>
          <p className="text-slate-500 text-sm">Tahapan terstruktur untuk mengantar Anda mencapai kesuksesan karier.</p>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative">
          {mechanisms.map((mech, idx) => (
            <div key={idx} className="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex flex-col items-center text-center relative">
              <div className="w-10 h-10 bg-blue-600 text-white rounded-full font-bold flex items-center justify-center text-sm shadow-md mb-4">
                {mech.step}
              </div>
              <h3 className="font-bold text-slate-900 text-base mb-2">{mech.title}</h3>
              <p className="text-xs text-slate-500 leading-relaxed">{mech.desc}</p>
            </div>
          ))}
        </div>
      </section>

      {/* ================= FOOTER ================= */}
      <footer id="kontak" className="bg-[#EAECEF] pt-16">
        <div className="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 pb-12">
          <div>
            <h4 className="font-bold text-slate-900 text-xl mb-4">elcoding.id</h4>
            <p className="text-slate-600 text-sm leading-relaxed mb-6">
              Lembaga kursus dan pelatihan terpadu yang mencakup IT & Coding, Bahasa Asing, hingga Desain Grafis berbasis praktik untuk membantu peserta menguasai keterampilan yang dibutuhkan dunia kerja modern.
            </p>
            
            <h5 className="font-bold text-slate-800 text-sm mb-3 border-b border-slate-300 inline-block pb-1">Jam Operasional</h5>
            <div className="space-y-2 text-sm text-slate-600">
              <p className="flex items-center gap-2"><Clock className="w-4 h-4 text-blue-600" /> Senin - Sabtu (08.00 - 20.00 WIB)</p>
            </div>
          </div>

          <div>
            <h4 className="font-bold text-slate-900 text-sm mb-4 border-b-2 border-blue-600 inline-block pb-1">Quick Links</h4>
            <ul className="space-y-3 text-sm text-slate-600">
              <li><Link href="/tentang-kami-publik" className="text-blue-600 font-bold">Tentang Kami</Link></li>
              <li><a href="#" className="hover:text-blue-600">Portofolio</a></li>
              <li><Link href="/artikel-publik" className="hover:text-blue-600">Artikel</Link></li>
              <li><a href="#kontak" className="hover:text-blue-600">Kontak</a></li>
            </ul>
          </div>

          <div>
            <h4 className="font-bold text-slate-900 text-sm mb-4 border-b-2 border-blue-600 inline-block pb-1">Panduan & Kebijakan</h4>
            <ul className="space-y-3 text-sm text-slate-600">
              <li><a href="#" className="hover:text-blue-600">FAQ</a></li>
              <li><a href="#" className="hover:text-blue-600">Syarat dan Ketentuan</a></li>
              <li><a href="#" className="hover:text-blue-600">Kebijakan Privasi</a></li>
            </ul>
          </div>

          <div>
            <h4 className="font-bold text-slate-900 text-sm mb-4 border-b-2 border-blue-600 inline-block pb-1">Informasi Kontak</h4>
            <div className="space-y-4 text-sm text-slate-600 mb-6">
              <p className="flex items-start gap-3"><MapPin className="w-5 h-5 text-blue-600 shrink-0 mt-0.5" /> <span>Ruko Citraland, Tegal, Jawa Tengah</span></p>
              <p className="flex items-center gap-3"><Phone className="w-4 h-4 text-emerald-500 shrink-0" /> <span>Admin: +62 814-7665-2656</span></p>
              <p className="flex items-center gap-3"><Mail className="w-4 h-4 text-blue-600 shrink-0" /> <span>info@elcodingacademy.com</span></p>
            </div>
            <div className="flex gap-4 text-xs font-bold text-blue-600">
              <a href="#" className="hover:underline">Facebook</a>
              <a href="#" className="hover:underline">Instagram</a>
              <a href="#" className="hover:underline">LinkedIn</a>
            </div>
          </div>
        </div>

        <div className="bg-[#0047b3] text-center py-4 px-6 text-blue-100 text-xs font-medium tracking-wide">
          Copyright © 2026 Elcoding Academy. All Rights Reserved. Membangun Karir IT Masa Depan.
        </div>
      </footer>

      {/* Floating WhatsApp */}
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