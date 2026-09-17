import { useEffect, useState } from 'react';
import InputError from '@/Components/InputError';
import { Head, Link, useForm } from '@inertiajs/react';
import { User, Lock, Mail } from 'lucide-react';

export default function Register() {
    const [showPassword, setShowPassword] = useState(false);
    const [showConfirmPassword, setShowConfirmPassword] = useState(false);

    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();
        post(route('register'));
    };

    return (
        <div className="min-h-screen w-full flex items-center justify-center p-4 sm:p-8 bg-[#185ba5]" style={{ background: 'radial-gradient(circle at center, #1860ad 0%, #0c3e75 100%)' }}>
            <Head title="Sign Up" />

            <div className="w-full max-w-5xl bg-white rounded-3xl shadow-2xl relative z-10 min-h-[640px] overflow-hidden flex flex-col md:flex-row">
                
                {/* --- SEAMLESS SVG BACKGROUND FOR LEFT SIDE --- */}
                <div className="absolute inset-0 z-0 pointer-events-none hidden md:block">
                    <svg width="100%" height="100%" viewBox="0 0 1000 640" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="blueGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stopColor="#1974d2" />
                                <stop offset="100%" stopColor="#1155a1" />
                            </linearGradient>
                        </defs>
                        <path 
                            d="M 0 0 
                               L 400 0 
                               C 400 150, 250 200, 350 350 
                               C 450 500, 650 450, 550 640 
                               L 0 640 Z" 
                            fill="url(#blueGradient)" 
                        />
                    </svg>
                    
                    <div className="absolute bottom-[5%] left-[-5%] w-[300px] h-[300px] bg-[#2a85f4] rounded-full mix-blend-screen opacity-30 blur-[2px]"></div>
                </div>

                {/* Mobile Blue Background Fallback */}
                <div className="absolute inset-0 bg-gradient-to-br from-[#1974d2] to-[#1155a1] z-0 md:hidden"></div>

                {/* --- FOREGROUND CONTENT --- */}
                
                {/* LEFT SIDE (BRANDING) */}
                <div className="md:w-[45%] relative text-white p-10 lg:p-14 flex flex-col justify-center items-center z-10">
                    <div className="relative z-20 flex flex-col items-center opacity-90 hover:opacity-100 transition-opacity">
                        <div className="w-20 h-20 mb-6 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-lg hover:scale-105 transition-transform">
                            <User className="w-10 h-10 text-cyan-300 drop-shadow-md" />
                        </div>
                        
                        <h1 className="text-3xl font-bold tracking-tight text-white drop-shadow-md text-center">
                            Portal <span className="text-cyan-300">Register</span>
                        </h1>
                        <p className="text-[12px] text-blue-100 mt-2 font-medium tracking-widest uppercase opacity-80 text-center">
                            elcoding.id
                        </p>
                    </div>
                </div>

                {/* RIGHT SIDE (FORM) */}
                <div className="md:w-[55%] p-10 lg:p-16 flex flex-col justify-center relative z-10">
                    
                    {/* Bottom Right Blue Circle */}
                    <div className="absolute -bottom-16 -right-16 w-64 h-64 bg-[#1466c4] rounded-full pointer-events-none hidden md:block"></div>

                    <div className="w-full max-w-[360px] mx-auto relative z-20 bg-white/70 backdrop-blur-md p-6 -m-6 rounded-2xl shadow-sm md:bg-transparent md:backdrop-blur-none md:p-0 md:m-0 md:shadow-none">
                        <h2 className="text-4xl font-black text-[#1974d2] mb-8 tracking-tight drop-shadow-sm">Sign up</h2>
                        
                        <form onSubmit={submit} className="space-y-4">
                            {/* Full Name */}
                            <div>
                                <div className="relative flex items-center">
                                    <div className="absolute left-4 flex items-center pointer-events-none text-gray-500">
                                        <User className="w-[18px] h-[18px] fill-current" />
                                    </div>
                                    <input
                                        type="text"
                                        name="name"
                                        value={data.name}
                                        placeholder="Full Name"
                                        className="w-full !pl-12 !pr-4 !py-3.5 !bg-[#f0f2f5] !border-0 !rounded-xl text-xs font-semibold text-gray-800 focus:!ring-2 focus:!ring-blue-500 focus:!bg-white transition-all outline-none placeholder-gray-500 shadow-sm"
                                        autoComplete="name"
                                        onChange={(e) => setData('name', e.target.value)}
                                        required
                                        autoFocus
                                    />
                                </div>
                                <InputError message={errors.name} className="mt-2" />
                            </div>

                            {/* Email */}
                            <div>
                                <div className="relative flex items-center">
                                    <div className="absolute left-4 flex items-center pointer-events-none text-gray-500">
                                        <Mail className="w-[18px] h-[18px] fill-current" />
                                    </div>
                                    <input
                                        type="email"
                                        name="email"
                                        value={data.email}
                                        placeholder="Email Address"
                                        className="w-full !pl-12 !pr-4 !py-3.5 !bg-[#f0f2f5] !border-0 !rounded-xl text-xs font-semibold text-gray-800 focus:!ring-2 focus:!ring-blue-500 focus:!bg-white transition-all outline-none placeholder-gray-500 shadow-sm"
                                        autoComplete="email"
                                        onChange={(e) => setData('email', e.target.value)}
                                        required
                                    />
                                </div>
                                <InputError message={errors.email} className="mt-2" />
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
                                        value={data.password}
                                        placeholder="Password"
                                        className="w-full !pl-12 !pr-20 !py-3.5 !bg-[#f0f2f5] !border-0 !rounded-xl text-xs font-semibold text-gray-800 focus:!ring-2 focus:!ring-blue-500 focus:!bg-white transition-all outline-none placeholder-gray-500 shadow-sm"
                                        autoComplete="new-password"
                                        onChange={(e) => setData('password', e.target.value)}
                                        required
                                    />
                                    <button
                                        type="button"
                                        onClick={() => setShowPassword(!showPassword)}
                                        className="absolute right-4 flex items-center text-[#145a9e] font-bold text-[10px] tracking-wider"
                                    >
                                        SHOW
                                    </button>
                                </div>
                                <InputError message={errors.password} className="mt-2" />
                            </div>

                            {/* Confirm Password */}
                            <div>
                                <div className="relative flex items-center">
                                    <div className="absolute left-4 flex items-center pointer-events-none text-gray-500">
                                        <Lock className="w-[18px] h-[18px] fill-current" />
                                    </div>
                                    <input
                                        type={showConfirmPassword ? 'text' : 'password'}
                                        name="password_confirmation"
                                        value={data.password_confirmation}
                                        placeholder="Confirm Password"
                                        className="w-full !pl-12 !pr-20 !py-3.5 !bg-[#f0f2f5] !border-0 !rounded-xl text-xs font-semibold text-gray-800 focus:!ring-2 focus:!ring-blue-500 focus:!bg-white transition-all outline-none placeholder-gray-500 shadow-sm"
                                        autoComplete="new-password"
                                        onChange={(e) => setData('password_confirmation', e.target.value)}
                                        required
                                    />
                                    <button
                                        type="button"
                                        onClick={() => setShowConfirmPassword(!showConfirmPassword)}
                                        className="absolute right-4 flex items-center text-[#145a9e] font-bold text-[10px] tracking-wider"
                                    >
                                        SHOW
                                    </button>
                                </div>
                                <InputError message={errors.password_confirmation} className="mt-2" />
                            </div>

                            {/* Sign up Button */}
                            <button
                                type="submit"
                                disabled={processing}
                                className="w-full py-4 mt-4 bg-[#1f4770] hover:bg-[#163352] text-white font-bold tracking-wide text-sm rounded-xl shadow-md transition-all duration-200 disabled:opacity-50"
                            >
                                Sign up
                            </button>

                            {/* Login Link */}
                            <div className="mt-4 text-center text-xs text-gray-600">
                                Sudah punya akun?{' '}
                                <Link href="/login" className="font-bold text-[#145a9e] hover:underline">
                                    Sign in Di Sini &rarr;
                                </Link>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    );
}
