import { useEffect, useState } from 'react';
import Checkbox from '@/Components/Checkbox';
import InputError from '@/Components/InputError';
import { Head, Link, useForm } from '@inertiajs/react';
import { User, Lock } from 'lucide-react';

export default function Login({ status, canResetPassword }) {
    const [showPassword, setShowPassword] = useState(false);

    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();
        post(route('login'));
    };

    return (
        <div className="min-h-screen w-full flex items-center justify-center p-4 sm:p-8 bg-[#185ba5]" style={{ background: 'radial-gradient(circle at center, #1860ad 0%, #0c3e75 100%)' }}>
            <Head title="Sign In" />

            <div className="w-full max-w-5xl bg-white rounded-3xl shadow-2xl relative z-10 min-h-[640px] overflow-hidden flex flex-col md:flex-row">
                
                {/* --- SEAMLESS SVG BACKGROUND FOR LEFT SIDE --- */}
                {/* This single SVG draws the entire complex blue shape perfectly without any gaps or seams */}
                <div className="absolute inset-0 z-0 pointer-events-none hidden md:block">
                    <svg width="100%" height="100%" viewBox="0 0 1000 640" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="blueGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stopColor="#1974d2" />
                                <stop offset="100%" stopColor="#1155a1" />
                            </linearGradient>
                        </defs>
                        {/* 
                            Path description:
                            - Start at top-left (0,0)
                            - Line to top-middle (400,0)
                            - Smooth bezier curve down to (500, 320)
                            - Smooth bezier curve out to form the circle protrusion (650, 500)
                            - Curve back to bottom-middle (450, 640)
                            - Line to bottom-left (0, 640)
                            - Close path
                        */}
                        <path 
                            d="M 0 0 
                               L 400 0 
                               C 400 150, 250 200, 350 350 
                               C 450 500, 650 450, 550 640 
                               L 0 640 Z" 
                            fill="url(#blueGradient)" 
                        />
                    </svg>
                    
                    {/* Decorative inner light blue circle, masked within the SVG area or just placed on top */}
                    <div className="absolute bottom-[5%] left-[-5%] w-[300px] h-[300px] bg-[#2a85f4] rounded-full mix-blend-screen opacity-30 blur-[2px]"></div>
                </div>

                {/* Mobile Blue Background Fallback */}
                <div className="absolute inset-0 bg-gradient-to-br from-[#1974d2] to-[#1155a1] z-0 md:hidden"></div>

                {/* --- FOREGROUND CONTENT --- */}
                
                {/* LEFT SIDE (BRANDING) */}
                <div className="md:w-[45%] relative text-white p-10 lg:p-14 flex flex-col justify-center items-center z-10">
                    <div className="relative z-20 flex flex-col items-center opacity-90 hover:opacity-100 transition-opacity">
                        <div className="w-20 h-20 mb-6 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-lg hover:scale-105 transition-transform">
                            <Lock className="w-10 h-10 text-cyan-300 drop-shadow-md" />
                        </div>
                        
                        <h1 className="text-3xl font-bold tracking-tight text-white drop-shadow-md text-center">
                            Admin <span className="text-cyan-300">Portal</span>
                        </h1>
                        <p className="text-[12px] text-blue-100 mt-2 font-medium tracking-widest uppercase opacity-80 text-center">
                            elcoding.id
                        </p>
                    </div>
                </div>

                {/* RIGHT SIDE (FORM) */}
                <div className="md:w-[55%] p-10 lg:p-16 flex flex-col justify-center relative z-10">
                    
                    {/* Bottom Right Blue Circle (in the white area) */}
                    <div className="absolute -bottom-16 -right-16 w-64 h-64 bg-[#1466c4] rounded-full pointer-events-none hidden md:block"></div>

                    <div className="w-full max-w-[360px] mx-auto relative z-20 bg-white/70 backdrop-blur-md p-6 -m-6 rounded-2xl shadow-sm md:bg-transparent md:backdrop-blur-none md:p-0 md:m-0 md:shadow-none">
                        <h2 className="text-4xl font-black text-[#1974d2] mb-8 tracking-tight drop-shadow-sm">Sign in</h2>
                        
                        {status && (
                            <div className="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-lg">
                                {status}
                            </div>
                        )}

                        <form onSubmit={submit} className="space-y-4">
                            {/* Username */}
                            <div>
                                <div className="relative flex items-center">
                                    <div className="absolute left-4 flex items-center pointer-events-none text-gray-500">
                                        <User className="w-[18px] h-[18px] fill-current" />
                                    </div>
                                    <input
                                        type="email"
                                        name="email"
                                        value={data.email}
                                        placeholder="User Name"
                                        className="w-full !pl-12 !pr-4 !py-3.5 !bg-[#f0f2f5] !border-0 !rounded-xl text-xs font-semibold text-gray-800 focus:!ring-2 focus:!ring-blue-500 focus:!bg-white transition-all outline-none placeholder-gray-500 shadow-sm"
                                        autoComplete="username"
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
                                        autoComplete="current-password"
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

                            {/* Remember Me & Forgot Password */}
                            <div className="flex items-center justify-between mt-2 px-1">
                                <label className="flex items-center cursor-pointer group">
                                    <Checkbox
                                        name="remember"
                                        checked={data.remember}
                                        onChange={(e) => setData('remember', e.target.checked)}
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
                                disabled={processing}
                                className="w-full py-4 mt-4 bg-[#1f4770] hover:bg-[#163352] text-white font-bold tracking-wide text-sm rounded-xl shadow-md transition-all duration-200 disabled:opacity-50"
                            >
                                Sign in
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    );
}
