import { useEffect, useState } from 'react';
import Checkbox from '@/Components/Checkbox';
import InputError from '@/Components/InputError';
import { Head, Link, useForm } from '@inertiajs/react';
import { User, Lock, CreditCard, ArrowLeft, Wrench, Shield, Sparkles, CheckCircle2, ChevronRight, Car, GraduationCap } from 'lucide-react';

export default function Login({ status, canResetPassword }) {
    const [showPassword, setShowPassword] = useState(false);
    // mode: 'credential' | 'bengkel' | 'edupulse' | 'kartu'
    const [mode, setMode] = useState('edupulse');

    const credentialForm = useForm({
        email: 'edupulse',
        password: 'edupulse123',
        remember: false,
        login_method: 'credential',
    });

    const kartuForm = useForm({
        nomor_kartu: '',
        login_method: 'kartu',
    });

    useEffect(() => {
        return () => {
            credentialForm.reset('password');
        };
    }, []);

    const submitCredential = (e) => {
        e.preventDefault();
        credentialForm.post(route('login'));
    };

    const submitKartu = (e) => {
        e.preventDefault();
        kartuForm.post(route('login'));
    };

    const setBengkelDemoCredentials = () => {
        credentialForm.setData({
            ...credentialForm.data,
            email: 'bengkel',
            password: 'bengkel123',
        });
    };

    const setEdupulseDemoCredentials = () => {
        credentialForm.setData({
            ...credentialForm.data,
            email: 'edupulse',
            password: 'edupulse123',
        });
    };

    const isBengkelMode = mode === 'bengkel';
    const isEdupulseMode = mode === 'edupulse';

    return (
        <div 
            className={`min-h-screen w-full flex items-center justify-center p-4 sm:p-8 transition-colors duration-500 ${
                isBengkelMode 
                    ? 'bg-[#0f1115]' 
                    : (isEdupulseMode ? 'bg-[#1e1b4b]' : 'bg-[#185ba5]')
            }`} 
            style={{ 
                background: isBengkelMode 
                    ? 'radial-gradient(circle at center, #1c1d22 0%, #090a0d 100%)' 
                    : (isEdupulseMode ? 'radial-gradient(circle at center, #312e81 0%, #0f172a 100%)' : 'radial-gradient(circle at center, #1860ad 0%, #0c3e75 100%)') 
            }}
        >
            <Head title={isBengkelMode ? "L-Garage Bengkel Login" : (isEdupulseMode ? "EduPulse Academy SaaS Login" : "Sign In")} />

            <div className={`w-full max-w-5xl rounded-3xl shadow-2xl relative z-10 min-h-[660px] overflow-hidden flex flex-col md:flex-row transition-all duration-300 ${
                isBengkelMode ? 'bg-[#16171d] border border-neutral-800' : (isEdupulseMode ? 'bg-[#0f172a] border border-indigo-900/60' : 'bg-white')
            }`}>
                
                {/* NOTIFICATION BADGE */}
                <div className={`absolute top-4 right-4 z-50 backdrop-blur-md px-4 py-2.5 rounded-xl shadow-lg flex items-start gap-3 max-w-[320px] border transition-colors ${
                    isBengkelMode
                        ? 'bg-amber-950/40 border-amber-500/30 text-amber-200'
                        : (isEdupulseMode ? 'bg-indigo-950/60 border-indigo-500/40 text-indigo-200' : 'bg-blue-50/90 border-blue-200 text-blue-800')
                }`}>
                    <div className="mt-0.5">
                        <span className="flex h-2.5 w-2.5 relative">
                            <span className={`animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 ${
                                isBengkelMode ? 'bg-amber-400' : (isEdupulseMode ? 'bg-indigo-400' : 'bg-blue-400')
                            }`}></span>
                            <span className={`relative inline-flex rounded-full h-2.5 w-2.5 ${
                                isBengkelMode ? 'bg-amber-500' : (isEdupulseMode ? 'bg-indigo-500' : 'bg-blue-600')
                            }`}></span>
                        </span>
                    </div>
                    <div>
                        <div className="font-bold text-xs tracking-wide">
                            {isBengkelMode ? 'Portal Khusus Bengkel' : (isEdupulseMode ? 'Portal EduPulse Academy' : 'Info Akses Dashboard')}
                        </div>
                        <div className="text-[10px] mt-0.5 opacity-80 leading-relaxed">
                            {isBengkelMode 
                                ? 'Akses sistem operasional & servis kendaraan L-Garage.' 
                                : (isEdupulseMode ? 'Sistem operasional bimbel, monitoring kelas live & AI tutor.' : 'Dashboard PKL/Magang hanya dapat diakses setelah login dan berlangganan program.')}
                        </div>
                    </div>
                </div>

                {/* --- SEAMLESS SVG BACKGROUND FOR LEFT SIDE --- */}
                <div className="absolute inset-0 z-0 pointer-events-none hidden md:block">
                    <svg width="100%" height="100%" viewBox="0 0 1000 640" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="portalGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stopColor={isBengkelMode ? "#d9531e" : (isEdupulseMode ? "#4338ca" : "#1974d2")} />
                                <stop offset="100%" stopColor={isBengkelMode ? "#1f1411" : (isEdupulseMode ? "#1e1b4b" : "#1155a1")} />
                            </linearGradient>
                        </defs>
                        <path 
                            d="M 0 0 
                               L 400 0 
                               C 400 150, 250 200, 350 350 
                               C 450 500, 650 450, 550 640 
                               L 0 640 Z" 
                            fill="url(#portalGradient)" 
                        />
                    </svg>
                    <div className={`absolute bottom-[5%] left-[-5%] w-[300px] h-[300px] rounded-full mix-blend-screen opacity-30 blur-[2px] ${
                        isBengkelMode ? 'bg-amber-500' : (isEdupulseMode ? 'bg-indigo-500' : 'bg-[#2a85f4]')
                    }`}></div>
                </div>

                {/* Mobile Blue/Dark Background Fallback */}
                <div className={`absolute inset-0 z-0 md:hidden ${
                    isBengkelMode 
                        ? 'bg-gradient-to-br from-[#d9531e] to-[#121316]' 
                        : (isEdupulseMode ? 'bg-gradient-to-br from-[#4338ca] to-[#0f172a]' : 'bg-gradient-to-br from-[#1974d2] to-[#1155a1]')
                }`}></div>

                {/* LEFT SIDE (BRANDING) */}
                <div className="md:w-[45%] relative text-white p-8 lg:p-14 flex flex-col justify-center items-center z-10 text-center">
                    <div className="relative z-20 flex flex-col items-center opacity-95 transition-opacity">
                        <div className={`w-20 h-20 mb-6 rounded-2xl backdrop-blur-md border flex items-center justify-center shadow-lg transition-transform hover:scale-105 ${
                            isBengkelMode 
                                ? 'bg-amber-500/10 border-amber-500/30' 
                                : (isEdupulseMode ? 'bg-indigo-500/10 border-indigo-500/40' : 'bg-white/10 border-white/20')
                        }`}>
                            {isBengkelMode ? (
                                <Wrench className="w-10 h-10 text-amber-400 drop-shadow-md animate-pulse" />
                            ) : (isEdupulseMode ? (
                                <GraduationCap className="w-10 h-10 text-indigo-300 drop-shadow-md animate-pulse" />
                            ) : (
                                <Lock className="w-10 h-10 text-cyan-300 drop-shadow-md" />
                            ))}
                        </div>
                        
                        <h1 className="text-3xl font-black tracking-tight text-white drop-shadow-md">
                            {isBengkelMode ? (
                                <>L-GARAGE <span className="text-amber-400">BENGKEL</span></>
                            ) : (isEdupulseMode ? (
                                <>EDUPULSE <span className="text-indigo-400">ACADEMY</span></>
                            ) : (
                                <>Portal <span className="text-cyan-300">Login</span></>
                            ))}
                        </h1>
                        <p className={`text-[12px] mt-2 font-medium tracking-widest uppercase opacity-85 ${
                            isBengkelMode ? 'text-amber-200/80' : (isEdupulseMode ? 'text-indigo-200' : 'text-blue-100')
                        }`}>
                            {isBengkelMode ? 'Automotive Service & Workshop' : (isEdupulseMode ? 'SaaS Operasional Bimbel & AI Tutor' : 'elcoding.id')}
                        </p>

                        {/* Extra Badge */}
                        {isBengkelMode && (
                            <div className="mt-8 px-4 py-2.5 rounded-full bg-black/40 border border-amber-500/30 text-amber-300 text-xs font-semibold flex items-center gap-2 backdrop-blur-sm">
                                <span className="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                Workshop Management System Active
                            </div>
                        )}
                        {isEdupulseMode && (
                            <div className="mt-8 px-4 py-2.5 rounded-full bg-black/40 border border-indigo-500/30 text-indigo-300 text-xs font-semibold flex items-center gap-2 backdrop-blur-sm">
                                <span className="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                EduPulse Academy Live & AI IRT Active
                            </div>
                        )}
                    </div>
                </div>

                {/* RIGHT SIDE (FORM) */}
                <div className="md:w-[55%] p-6 sm:p-10 lg:p-12 flex flex-col justify-center relative z-10">
                    
                    {/* Bottom Right Glow Circle */}
                    <div className={`absolute -bottom-16 -right-16 w-64 h-64 rounded-full pointer-events-none hidden md:block opacity-20 ${
                        isBengkelMode ? 'bg-amber-500' : (isEdupulseMode ? 'bg-indigo-500' : 'bg-[#1466c4]')
                    }`}></div>

                    <div className="w-full max-w-[400px] mx-auto relative z-20">
                        
                        {/* PORTAL SELECTOR TABS */}
                        <div className="mb-6 p-1 rounded-2xl bg-black/10 backdrop-blur-md flex items-center gap-1 border border-neutral-200/20">
                            <button
                                type="button"
                                onClick={() => setMode('edupulse')}
                                className={`flex-1 py-2 px-2 rounded-xl text-[11px] font-bold transition-all flex items-center justify-center gap-1 ${
                                    isEdupulseMode
                                        ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md shadow-indigo-950/40'
                                        : 'text-neutral-500 hover:text-neutral-800'
                                }`}
                            >
                                <GraduationCap className="w-3.5 h-3.5" />
                                <span>EduPulse</span>
                            </button>
                            <button
                                type="button"
                                onClick={() => setMode('bengkel')}
                                className={`flex-1 py-2 px-2 rounded-xl text-[11px] font-bold transition-all flex items-center justify-center gap-1 ${
                                    isBengkelMode
                                        ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md shadow-orange-950/40'
                                        : 'text-neutral-500 hover:text-neutral-800'
                                }`}
                            >
                                <Wrench className="w-3.5 h-3.5" />
                                <span>Bengkel</span>
                            </button>
                            <button
                                type="button"
                                onClick={() => setMode('credential')}
                                className={`flex-1 py-2 px-2 rounded-xl text-[11px] font-bold transition-all flex items-center justify-center gap-1 ${
                                    mode === 'credential'
                                        ? 'bg-[#1974d2] text-white shadow-md'
                                        : 'text-neutral-500 hover:text-neutral-800'
                                }`}
                            >
                                <User className="w-3.5 h-3.5" />
                                <span>Admin</span>
                            </button>
                            <button
                                type="button"
                                onClick={() => setMode('kartu')}
                                className={`flex-1 py-2 px-2 rounded-xl text-[11px] font-bold transition-all flex items-center justify-center gap-1 ${
                                    mode === 'kartu'
                                        ? 'bg-emerald-600 text-white shadow-md'
                                        : 'text-neutral-500 hover:text-neutral-800'
                                }`}
                            >
                                <CreditCard className="w-3.5 h-3.5" />
                                <span>Kartu</span>
                            </button>
                        </div>

                        {/* ====== EDUPULSE VIEW ====== */}
                        {isEdupulseMode && (
                            <>
                                <div className="mb-4">
                                    <h2 className="text-3xl font-black text-white tracking-tight drop-shadow-sm flex items-center gap-2">
                                        Login EduPulse
                                        <span className="text-xs font-bold px-2 py-0.5 rounded-md bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                            ROLE BIMBEL
                                        </span>
                                    </h2>
                                    <p className="text-indigo-200/80 text-xs mt-1">
                                        Masuk ke sistem EduPulse Academy SaaS, monitoring kelas & AI tutor.
                                    </p>
                                </div>

                                {/* CREDENTIAL NOTICE PLATE */}
                                <div className="mb-5 p-3.5 rounded-2xl bg-indigo-950/70 border border-indigo-500/40 text-left shadow-lg relative overflow-hidden">
                                    <div className="flex items-center justify-between mb-2">
                                        <span className="text-[11px] font-black uppercase tracking-wider text-indigo-300 flex items-center gap-1.5">
                                            <Shield className="w-3.5 h-3.5" /> Akun Demo EduPulse Bimbel:
                                        </span>
                                        <button
                                            type="button"
                                            onClick={setEdupulseDemoCredentials}
                                            className="text-[10px] font-bold px-2 py-1 rounded-md bg-indigo-500 hover:bg-indigo-400 text-white transition active:scale-95"
                                        >
                                            Otomatis Isi
                                        </button>
                                    </div>
                                    <div className="grid grid-cols-2 gap-2 text-xs font-mono">
                                        <div className="bg-black/40 p-2 rounded-lg border border-indigo-900/50">
                                            <div className="text-[10px] text-indigo-300 uppercase font-sans">Username</div>
                                            <div className="text-white font-bold">edupulse</div>
                                        </div>
                                        <div className="bg-black/40 p-2 rounded-lg border border-indigo-900/50">
                                            <div className="text-[10px] text-indigo-300 uppercase font-sans">Password</div>
                                            <div className="text-white font-bold">edupulse123</div>
                                        </div>
                                    </div>
                                    <div className="mt-2 text-[10px] text-indigo-200/80 flex items-center gap-1">
                                        <CheckCircle2 className="w-3 h-3 text-emerald-400 inline" />
                                        <span>Role: <strong>bimbel (Admin Akademik)</strong> &bull; Dashboard operasional lengkap.</span>
                                    </div>
                                </div>

                                {status && (
                                    <div className="mb-4 text-xs font-semibold text-emerald-400 bg-emerald-950/40 border border-emerald-500/30 p-3 rounded-xl">
                                        {status}
                                    </div>
                                )}

                                <form onSubmit={submitCredential} className="space-y-4">
                                    {/* Username */}
                                    <div>
                                        <div className="relative flex items-center">
                                            <div className="absolute left-4 flex items-center pointer-events-none text-indigo-300">
                                                <User className="w-[18px] h-[18px]" />
                                            </div>
                                            <input
                                                type="text"
                                                name="email"
                                                value={credentialForm.data.email}
                                                placeholder="Username (edupulse)"
                                                className="w-full !pl-12 !pr-4 !py-3.5 !bg-indigo-950/50 !border !border-indigo-800/80 !rounded-xl text-xs font-semibold text-white focus:!border-indigo-400 focus:!ring-1 focus:!ring-indigo-400 transition-all outline-none placeholder-indigo-300/50"
                                                autoComplete="username"
                                                onChange={(e) => credentialForm.setData('email', e.target.value)}
                                                required
                                            />
                                        </div>
                                        <InputError message={credentialForm.errors.email} className="mt-2 text-rose-400" />
                                    </div>

                                    {/* Password */}
                                    <div>
                                        <div className="relative flex items-center">
                                            <div className="absolute left-4 flex items-center pointer-events-none text-indigo-300">
                                                <Lock className="w-[18px] h-[18px]" />
                                            </div>
                                            <input
                                                type={showPassword ? 'text' : 'password'}
                                                name="password"
                                                value={credentialForm.data.password}
                                                placeholder="Password (edupulse123)"
                                                className="w-full !pl-12 !pr-20 !py-3.5 !bg-indigo-950/50 !border !border-indigo-800/80 !rounded-xl text-xs font-semibold text-white focus:!border-indigo-400 focus:!ring-1 focus:!ring-indigo-400 transition-all outline-none placeholder-indigo-300/50"
                                                autoComplete="current-password"
                                                onChange={(e) => credentialForm.setData('password', e.target.value)}
                                                required
                                            />
                                            <button
                                                type="button"
                                                onClick={() => setShowPassword(!showPassword)}
                                                className="absolute right-4 flex items-center text-indigo-400 font-bold text-[10px] tracking-wider"
                                            >
                                                {showPassword ? 'HIDE' : 'SHOW'}
                                            </button>
                                        </div>
                                        <InputError message={credentialForm.errors.password} className="mt-2 text-rose-400" />
                                    </div>

                                    {/* Remember Me */}
                                    <div className="flex items-center justify-between mt-2 px-1">
                                        <label className="flex items-center cursor-pointer group">
                                            <Checkbox
                                                name="remember"
                                                checked={credentialForm.data.remember}
                                                onChange={(e) => credentialForm.setData('remember', e.target.checked)}
                                                className="!rounded-sm !border-indigo-700 !bg-indigo-950 !text-indigo-500 focus:!ring-indigo-500 w-[14px] h-[14px] mr-2"
                                            />
                                            <span className="text-[11px] font-bold text-indigo-200/80 group-hover:text-white transition-colors">Ingat saya</span>
                                        </label>
                                    </div>

                                    {/* Sign in Button */}
                                    <button
                                        type="submit"
                                        disabled={credentialForm.processing}
                                        className="w-full py-4 mt-4 bg-gradient-to-r from-indigo-600 via-indigo-700 to-purple-700 hover:from-indigo-500 hover:to-purple-600 text-white font-bold tracking-wide text-sm rounded-xl shadow-lg shadow-indigo-950/60 transition-all duration-200 disabled:opacity-50 flex items-center justify-center gap-2"
                                    >
                                        <GraduationCap className="w-4 h-4" />
                                        <span>Masuk Dashboard EduPulse Bimbel &rarr;</span>
                                    </button>
                                </form>
                            </>
                        )}

                        {/* ====== BENGKEL VIEW ====== */}
                        {isBengkelMode && (
                            <>
                                <div className="mb-4">
                                    <h2 className="text-3xl font-black text-white tracking-tight drop-shadow-sm flex items-center gap-2">
                                        Login Bengkel
                                        <span className="text-xs font-bold px-2 py-0.5 rounded-md bg-amber-500/20 text-amber-400 border border-amber-500/30">
                                            ROLE BENGKEL
                                        </span>
                                    </h2>
                                    <p className="text-neutral-400 text-xs mt-1">
                                        Masuk untuk mengelola servis kendaraan & dashboard bengkel.
                                    </p>
                                </div>

                                {/* CREDENTIAL NOTICE PLATE */}
                                <div className="mb-5 p-3.5 rounded-2xl bg-neutral-900/90 border border-amber-500/40 text-left shadow-lg relative overflow-hidden">
                                    <div className="flex items-center justify-between mb-2">
                                        <span className="text-[11px] font-black uppercase tracking-wider text-amber-400 flex items-center gap-1.5">
                                            <Shield className="w-3.5 h-3.5" /> Akun Demo Bengkel Tersedia:
                                        </span>
                                        <button
                                            type="button"
                                            onClick={setBengkelDemoCredentials}
                                            className="text-[10px] font-bold px-2 py-1 rounded-md bg-amber-500 hover:bg-amber-400 text-neutral-950 transition active:scale-95"
                                        >
                                            Otomatis Isi
                                        </button>
                                    </div>
                                    <div className="grid grid-cols-2 gap-2 text-xs font-mono">
                                        <div className="bg-black/50 p-2 rounded-lg border border-neutral-800">
                                            <div className="text-[10px] text-neutral-400 uppercase font-sans">Username</div>
                                            <div className="text-white font-bold">bengkel</div>
                                        </div>
                                        <div className="bg-black/50 p-2 rounded-lg border border-neutral-800">
                                            <div className="text-[10px] text-neutral-400 uppercase font-sans">Password</div>
                                            <div className="text-white font-bold">bengkel123</div>
                                        </div>
                                    </div>
                                    <div className="mt-2 text-[10px] text-neutral-400 flex items-center gap-1">
                                        <CheckCircle2 className="w-3 h-3 text-emerald-400 inline" />
                                        <span>Role: <strong>bengkel</strong> &bull; Dashboard berisi data awal kosong.</span>
                                    </div>
                                </div>

                                {status && (
                                    <div className="mb-4 text-xs font-semibold text-emerald-400 bg-emerald-950/40 border border-emerald-500/30 p-3 rounded-xl">
                                        {status}
                                    </div>
                                )}

                                <form onSubmit={submitCredential} className="space-y-4">
                                    {/* Username */}
                                    <div>
                                        <div className="relative flex items-center">
                                            <div className="absolute left-4 flex items-center pointer-events-none text-neutral-400">
                                                <User className="w-[18px] h-[18px]" />
                                            </div>
                                            <input
                                                type="text"
                                                name="email"
                                                value={credentialForm.data.email}
                                                placeholder="Username (bengkel)"
                                                className="w-full !pl-12 !pr-4 !py-3.5 !bg-neutral-900/90 !border !border-neutral-700 !rounded-xl text-xs font-semibold text-white focus:!border-amber-500 focus:!ring-1 focus:!ring-amber-500 transition-all outline-none placeholder-neutral-500"
                                                autoComplete="username"
                                                onChange={(e) => credentialForm.setData('email', e.target.value)}
                                                required
                                            />
                                        </div>
                                        <InputError message={credentialForm.errors.email} className="mt-2 text-rose-400" />
                                    </div>

                                    {/* Password */}
                                    <div>
                                        <div className="relative flex items-center">
                                            <div className="absolute left-4 flex items-center pointer-events-none text-neutral-400">
                                                <Lock className="w-[18px] h-[18px]" />
                                            </div>
                                            <input
                                                type={showPassword ? 'text' : 'password'}
                                                name="password"
                                                value={credentialForm.data.password}
                                                placeholder="Password (bengkel123)"
                                                className="w-full !pl-12 !pr-20 !py-3.5 !bg-neutral-900/90 !border !border-neutral-700 !rounded-xl text-xs font-semibold text-white focus:!border-amber-500 focus:!ring-1 focus:!ring-amber-500 transition-all outline-none placeholder-neutral-500"
                                                autoComplete="current-password"
                                                onChange={(e) => credentialForm.setData('password', e.target.value)}
                                                required
                                            />
                                            <button
                                                type="button"
                                                onClick={() => setShowPassword(!showPassword)}
                                                className="absolute right-4 flex items-center text-amber-400 font-bold text-[10px] tracking-wider"
                                            >
                                                {showPassword ? 'HIDE' : 'SHOW'}
                                            </button>
                                        </div>
                                        <InputError message={credentialForm.errors.password} className="mt-2 text-rose-400" />
                                    </div>

                                    {/* Remember Me */}
                                    <div className="flex items-center justify-between mt-2 px-1">
                                        <label className="flex items-center cursor-pointer group">
                                            <Checkbox
                                                name="remember"
                                                checked={credentialForm.data.remember}
                                                onChange={(e) => credentialForm.setData('remember', e.target.checked)}
                                                className="!rounded-sm !border-neutral-600 !bg-neutral-800 !text-amber-500 focus:!ring-amber-500 w-[14px] h-[14px] mr-2"
                                            />
                                            <span className="text-[11px] font-bold text-neutral-400 group-hover:text-white transition-colors">Ingat saya</span>
                                        </label>
                                    </div>

                                    {/* Sign in Button */}
                                    <button
                                        type="submit"
                                        disabled={credentialForm.processing}
                                        className="w-full py-4 mt-4 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold tracking-wide text-sm rounded-xl shadow-lg shadow-orange-950/50 transition-all duration-200 disabled:opacity-50 flex items-center justify-center gap-2"
                                    >
                                        <Wrench className="w-4 h-4" />
                                        <span>Masuk Dashboard Bengkel &rarr;</span>
                                    </button>
                                </form>
                            </>
                        )}

                        {/* ====== REGULAR CREDENTIAL VIEW ====== */}
                        {mode === 'credential' && (
                            <>
                                <h2 className="text-4xl font-black text-[#1974d2] mb-6 tracking-tight drop-shadow-sm">Sign in</h2>
                                
                                {status && (
                                    <div className="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-lg">
                                        {status}
                                    </div>
                                )}

                                <form onSubmit={submitCredential} className="space-y-4">
                                    {/* Username */}
                                    <div>
                                        <div className="relative flex items-center">
                                            <div className="absolute left-4 flex items-center pointer-events-none text-gray-500">
                                                <User className="w-[18px] h-[18px] fill-current" />
                                            </div>
                                            <input
                                                type="text"
                                                name="email"
                                                value={credentialForm.data.email}
                                                placeholder="Username atau Email"
                                                className="w-full !pl-12 !pr-4 !py-3.5 !bg-[#f0f2f5] !border-0 !rounded-xl text-xs font-semibold text-gray-800 focus:!ring-2 focus:!ring-blue-500 focus:!bg-white transition-all outline-none placeholder-gray-500 shadow-sm"
                                                autoComplete="username"
                                                onChange={(e) => credentialForm.setData('email', e.target.value)}
                                                required
                                            />
                                        </div>
                                        <InputError message={credentialForm.errors.email} className="mt-2" />
                                    </div>

                                    {/* Password */}
                                    <div>
                                        <div className="relative flex items-center">
                                            <div className="absolute left-4 flex items-center pointer-events-none text-gray-500">
                                                <Lock className="w-[18px] h-[18px] fill-current" />
                                            </div>
                                            <input
                                                type={showPassword ? 'text' : 'password'}
                                                name="password"
                                                value={credentialForm.data.password}
                                                placeholder="Password"
                                                className="w-full !pl-12 !pr-20 !py-3.5 !bg-[#f0f2f5] !border-0 !rounded-xl text-xs font-semibold text-gray-800 focus:!ring-2 focus:!ring-blue-500 focus:!bg-white transition-all outline-none placeholder-gray-500 shadow-sm"
                                                autoComplete="current-password"
                                                onChange={(e) => credentialForm.setData('password', e.target.value)}
                                                required
                                            />
                                            <button
                                                type="button"
                                                onClick={() => setShowPassword(!showPassword)}
                                                className="absolute right-4 flex items-center text-[#145a9e] font-bold text-[10px] tracking-wider"
                                            >
                                                {showPassword ? 'HIDE' : 'SHOW'}
                                            </button>
                                        </div>
                                        <InputError message={credentialForm.errors.password} className="mt-2" />
                                    </div>

                                    {/* Remember Me & Forgot Password */}
                                    <div className="flex items-center justify-between mt-2 px-1">
                                        <label className="flex items-center cursor-pointer group">
                                            <Checkbox
                                                name="remember"
                                                checked={credentialForm.data.remember}
                                                onChange={(e) => credentialForm.setData('remember', e.target.checked)}
                                                className="!rounded-sm !border-gray-400 !text-[#1c5086] focus:!ring-[#1c5086] shadow-sm w-[14px] h-[14px] mr-2"
                                            />
                                            <span className="text-[11px] font-bold text-gray-600 group-hover:text-gray-900 transition-colors">Remember me</span>
                                        </label>
                                        {canResetPassword && (
                                            <Link
                                                href={route('password.request')}
                                                className="text-[11px] font-bold text-[#145a9e] hover:text-[#0d3f72] hover:underline transition-colors"
                                            >
                                                Forgot Password?
                                            </Link>
                                        )}
                                    </div>

                                    {/* Sign in Button */}
                                    <button
                                        type="submit"
                                        disabled={credentialForm.processing}
                                        className="w-full py-4 mt-4 bg-[#1f4770] hover:bg-[#163352] text-white font-bold tracking-wide text-sm rounded-xl shadow-md transition-all duration-200 disabled:opacity-50"
                                    >
                                        Sign in
                                    </button>
                                </form>
                            </>
                        )}

                        {/* ====== KARTU VIEW ====== */}
                        {mode === 'kartu' && (
                            <>
                                <h2 className="text-3xl font-black text-[#1974d2] mb-2 tracking-tight drop-shadow-sm">Login No Kartu</h2>
                                <p className="text-gray-500 text-xs font-medium mb-6">Masukkan nomor kartu anggota Anda.</p>

                                <form onSubmit={submitKartu} className="space-y-4">
                                    {/* Nomor Kartu */}
                                    <div>
                                        <div className="relative flex items-center">
                                            <div className="absolute left-4 flex items-center pointer-events-none text-gray-500">
                                                <CreditCard className="w-[18px] h-[18px]" />
                                            </div>
                                            <input
                                                type="text"
                                                name="nomor_kartu"
                                                value={kartuForm.data.nomor_kartu}
                                                placeholder="Masukkan nomor kartu"
                                                className="w-full !pl-12 !pr-4 !py-3.5 !bg-[#f0f2f5] !border-0 !rounded-xl text-sm font-semibold text-gray-800 focus:!ring-2 focus:!ring-blue-500 focus:!bg-white transition-all outline-none placeholder-gray-400 shadow-sm tracking-[0.15em] font-mono"
                                                inputMode="numeric"
                                                autoFocus
                                                onChange={(e) => kartuForm.setData('nomor_kartu', e.target.value)}
                                                required
                                            />
                                        </div>
                                        <InputError message={kartuForm.errors.nomor_kartu} className="mt-2" />
                                    </div>

                                    {/* Submit */}
                                    <button
                                        type="submit"
                                        disabled={kartuForm.processing}
                                        className="w-full py-4 mt-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold tracking-wide text-sm rounded-xl shadow-md transition-all duration-200 disabled:opacity-50 flex items-center justify-center gap-2"
                                    >
                                        <CreditCard className="w-4 h-4" />
                                        <span>Masuk dengan Kartu</span>
                                    </button>
                                </form>
                            </>
                        )}

                        {/* RFID Quick Login Section */}
                        <div className={`mt-6 pt-4 border-t text-center ${
                            isBengkelMode ? 'border-neutral-800' : 'border-gray-200'
                        }`}>
                            <div className={`p-3 rounded-xl flex items-center justify-between gap-2 shadow-xs border ${
                                isBengkelMode
                                    ? 'bg-neutral-900 border-neutral-800 text-neutral-300'
                                    : 'bg-gradient-to-r from-emerald-50 to-teal-50 border-emerald-200 text-gray-800'
                            }`}>
                                <div className="flex items-center gap-2.5 text-left">
                                    <div className="w-8 h-8 rounded-lg bg-emerald-500 text-white flex items-center justify-center font-bold shadow-xs">
                                        <span className="text-xs">RFID</span>
                                    </div>
                                    <div>
                                        <div className="text-[11px] font-bold">Quick RFID Tap Login</div>
                                        <div className={`text-[10px] ${isBengkelMode ? 'text-neutral-400' : 'text-gray-500'}`}>
                                            Tempelkan kartu RFID Anda untuk login
                                        </div>
                                    </div>
                                </div>
                                <Link 
                                    href="/presensi-rfid" 
                                    className="px-2.5 py-1.5 text-[10px] font-bold text-emerald-600 hover:text-emerald-500 bg-emerald-500/10 rounded-lg transition"
                                >
                                    Kiosk &rarr;
                                </Link>
                            </div>
                        </div>

                        <div className={`mt-4 text-center text-xs ${
                            isBengkelMode ? 'text-neutral-500' : 'text-gray-600'
                        }`}>
                            Belum punya akun?{' '}
                            <Link href="/register" className={`font-bold hover:underline ${
                                isBengkelMode ? 'text-amber-400' : 'text-[#145a9e]'
                            }`}>
                                Daftar Di Sini &rarr;
                            </Link>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    );
}
