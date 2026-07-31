import { useEffect, useState } from 'react';
import Checkbox from '@/Components/Checkbox';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import { Head, Link, useForm } from '@inertiajs/react';
import { Mail, Lock, Eye, EyeOff, ArrowRight } from 'lucide-react';

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
        <div className="min-h-screen w-full flex items-center justify-center bg-gray-100 p-4 sm:p-6">
            <Head title="Admin Login" />

            {/* Main Card Container */}
            <div className="w-full max-w-5xl bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2 min-h-[600px]">
                
                {/* SISI KIRI - HERO / BANNER */}
                <div className="relative bg-blue-700 text-white p-8 sm:p-12 flex flex-col justify-between overflow-hidden">
                    {/* Background Overlay Effect */}
                    <div className="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-900 opacity-90"></div>
                    <div className="absolute -bottom-10 -left-10 w-40 h-40 bg-blue-500 rounded-full blur-2xl opacity-50"></div>
                    <div className="absolute -top-10 -right-10 w-40 h-40 bg-blue-400 rounded-full blur-2xl opacity-40"></div>

                    {/* Content Banner */}
                    <div className="relative z-10 my-auto text-center flex flex-col items-center">
                        <div className="mb-6 p-4 bg-white backdrop-blur-md rounded-2xl border border-white/20 inline-block shadow-inner">
                            <img src="/gambar/aset/logo-elcoding.svg" alt="Elcoding" className="h-8" />
                        </div>
                        <h1 className="text-3xl lg:text-4xl font-extrabold tracking-tight mb-4 leading-tight">
                            Elevating Code <br /> To Career.
                        </h1>
                        <p className="text-blue-100 text-sm max-w-sm leading-relaxed">
                            Empowering the next generation of IT leaders through structured learning and industrial expertise.
                        </p>
                    </div>

                    {/* Footer Kiri Opsional */}
                    <div className="relative z-10 text-center text-xs text-blue-200">
                        © {new Date().getFullYear()} Elcoding Academy. All rights reserved.
                    </div>
                </div>

                {/* SISI KANAN - FORM LOGIN */}
                <div className="p-8 sm:p-12 flex flex-col justify-between bg-white">
                    <div>
                        {/* Logo Header */}
                        <div className="mb-8">
                            <img src="/gambar/aset/logo-elcoding.svg" alt="Elcoding Academy" className="h-10" />
                        </div>

                        {/* Title Section */}
                        <div className="mb-8">
                            <h2 className="text-2xl font-bold text-gray-900">Admin Login</h2>
                            <p className="text-sm text-gray-500 mt-1">
                                Akses panel kontrol Elcoding Academy
                            </p>
                        </div>

                        {status && (
                            <div className="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-lg">
                                {status}
                            </div>
                        )}

                        {/* Form */}
                        <form onSubmit={submit} className="space-y-5">
                            {/* Input Email / Username */}
                            <div>
                                <label className="block text-xs font-semibold text-gray-700 mb-2">
                                    Username atau Email
                                </label>
                                <div className="relative">
                                    <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <Mail className="w-4 h-4" />
                                    </div>
                                    <input
                                        type="email"
                                        name="email"
                                        value={data.email}
                                        placeholder="admin@elcoding.com"
                                        className="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                                        autoComplete="username"
                                        onChange={(e) => setData('email', e.target.value)}
                                        required
                                    />
                                </div>
                                <InputError message={errors.email} className="mt-2" />
                            </div>

                            {/* Input Password */}
                            <div>
                                <div className="flex justify-between items-center mb-2">
                                    <label className="block text-xs font-semibold text-gray-700">
                                        Password
                                    </label>
                                    {canResetPassword && (
                                        <Link
                                            href={route('password.request')}
                                            className="text-xs font-medium text-blue-600 hover:underline"
                                        >
                                            Lupa Password?
                                        </Link>
                                    )}
                                </div>
                                <div className="relative">
                                    <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <Lock className="w-4 h-4" />
                                    </div>
                                    <input
                                        type={showPassword ? 'text' : 'password'}
                                        name="password"
                                        value={data.password}
                                        placeholder="••••••••"
                                        className="w-full pl-10 pr-10 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                                        autoComplete="current-password"
                                        onChange={(e) => setData('password', e.target.value)}
                                        required
                                    />
                                    <button
                                        type="button"
                                        onClick={() => setShowPassword(!showPassword)}
                                        className="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600"
                                    >
                                        {showPassword ? (
                                            <EyeOff className="w-4 h-4" />
                                        ) : (
                                            <Eye className="w-4 h-4" />
                                        )}
                                    </button>
                                </div>
                                <InputError message={errors.password} className="mt-2" />
                            </div>

                            {/* Checkbox Ingat Saya */}
                            <div className="flex items-center">
                                <label className="flex items-center cursor-pointer">
                                    <Checkbox
                                        name="remember"
                                        checked={data.remember}
                                        onChange={(e) => setData('remember', e.target.checked)}
                                        className="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                    />
                                    <span className="ml-2 text-xs text-gray-600">Ingat Saya</span>
                                </label>
                            </div>

                            {/* Tombol Submit */}
                            <button
                                type="submit"
                                disabled={processing}
                                className="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transition-all duration-200 flex items-center justify-center gap-2 disabled:opacity-50"
                            >
                                <span>Masuk ke Dashboard</span>
                                <ArrowRight className="w-4 h-4" />
                            </button>
                        </form>
                    </div>

                    {/* Footer / Support */}
                    <div className="mt-8 pt-6 border-t border-gray-100 text-center">
                        <p className="text-xs text-gray-500">
                            Bermasalah saat login?{' '}
                            <a href="#" className="font-semibold text-blue-600 hover:underline">
                                Hubungi IT Support
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    );
}