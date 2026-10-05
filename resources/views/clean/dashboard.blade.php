<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L-Clean - Dashboard Operasional & Fasilitas</title>
    <!-- Tailwind CSS CDN for instant standalone Blade rendering support -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F3F4F8] text-slate-700 antialiased min-h-screen">
    <div className="flex">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col h-screen fixed left-0 top-0 z-30 shadow-sm">
            <div class="p-5 border-b border-slate-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-sky-600 to-cyan-500 flex items-center justify-center text-white shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <h1 class="text-lg font-extrabold text-slate-800 leading-none">L-Clean</h1>
                    <span class="text-[10px] font-bold text-sky-600 tracking-wider">SYSTEM</span>
                </div>
            </div>

            <!-- Facility Selector -->
            <div class="px-4 py-3 bg-slate-50 border-b border-slate-100">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">FACILITY PLANT</div>
                <div class="font-bold text-xs text-slate-800 bg-white border border-slate-200 rounded-lg py-1.5 px-3">
                    Downtown #04
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto text-xs font-semibold">
                <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-sky-600 text-white font-bold shadow-md shadow-sky-600/20">
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100">
                    <span>Orders</span>
                    <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full font-bold">142</span>
                </a>
                <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100">
                    <span>Customers</span>
                </a>
                <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100">
                    <span>Services & Pricing</span>
                </a>
                <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100">
                    <span>Inventory</span>
                </a>
                <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100">
                    <span>Delivery</span>
                    <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full font-bold">18</span>
                </a>
                <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100">
                    <span>Reports</span>
                </a>
                <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100">
                    <span>Settings</span>
                </a>
            </nav>

            <!-- Bottom Widget -->
            <div class="p-4 mx-3 mb-3 bg-slate-900 text-white rounded-2xl shadow-lg border border-slate-700/60 space-y-2 text-xs">
                <div class="flex justify-between items-center text-[11px]">
                    <span class="text-slate-300">Enterprise Tier</span>
                    <span class="font-bold text-cyan-400">84% Capacity</span>
                </div>
                <div class="w-full bg-slate-700 h-2 rounded-full overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-400 to-sky-500 h-full w-[84%]"></div>
                </div>
                <p class="text-[10px] text-slate-400">25.2k of 30k garments processed</p>
                <button class="w-full mt-2 bg-sky-600 hover:bg-sky-500 text-white font-bold py-2 rounded-xl text-center shadow-md">
                    + New Order
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 p-8 flex-1 space-y-6">
            <!-- Header Banner -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-md">
                            MORNING SHIFT ACTIVE + BAY OPERATIONS
                        </span>
                    </div>
                    <h2 class="text-2xl font-extrabold text-slate-800">Good morning, Downtown Hub #04</h2>
                    <p class="text-xs text-slate-400 mt-1">
                        Cycle Period: 08:00 - 14:00 &nbsp;•&nbsp; Lead Supervisor: Elena Rostova &nbsp;•&nbsp; <span class="text-sky-600 font-semibold">Telemetry Synced 34s ago</span>
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <button class="bg-slate-100 text-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl border border-slate-200">Scan RFID / Tag</button>
                    <button class="bg-slate-100 text-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl border border-slate-200">Driver Dispatch</button>
                    <button class="bg-sky-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-md">+ New Walk-In Order</button>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
                    <span class="text-[11px] font-bold text-slate-400">TODAY'S REVENUE</span>
                    <div class="flex items-baseline gap-2 mt-2">
                        <h3 class="text-2xl font-black text-slate-800">$4,892.50</h3>
                        <span class="text-[11px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">+16.2%</span>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">vs. yesterday ($4,214.10)</p>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
                    <span class="text-[11px] font-bold text-slate-400">IN-FACILITY ORDERS</span>
                    <h3 class="text-2xl font-black text-slate-800 mt-2">142</h3>
                    <p class="text-[10px] text-slate-400 mt-1">Capacity: <b class="text-slate-700">84% operational</b></p>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
                    <span class="text-[11px] font-bold text-slate-400">DELIVERED / IN TRANSIT</span>
                    <h3 class="text-2xl font-black text-slate-800 mt-2">86</h3>
                    <p class="text-[10px] text-slate-400 mt-1">Turnaround SLA Target: <b class="text-emerald-600">99.2%</b></p>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
                    <span class="text-[11px] font-bold text-slate-400">ACTIVE CLIENTS TODAY</span>
                    <h3 class="text-2xl font-black text-slate-800 mt-2">128</h3>
                    <p class="text-[10px] text-slate-400 mt-1"><b class="text-slate-800">34 Commercial</b> | 94 Retail VIP</p>
                </div>
            </div>

            <!-- Orders Stream Table -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800">Facility Orders Stream</h3>
                        <p class="text-xs text-slate-400">Live tracking of individual bags, itemized tagging, and stage transitions</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase border-b border-slate-100">
                                <th class="py-3 px-6">ORDER ID / TAG</th>
                                <th class="py-3 px-6">CLIENT / ACCOUNT</th>
                                <th class="py-3 px-6">SERVICE</th>
                                <th class="py-3 px-6">STAGE</th>
                                <th class="py-3 px-6">EST. COMPLETION</th>
                                <th class="py-3 px-6 text-right">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50">
                                <td class="py-3.5 px-6 font-bold text-sky-600">#LC-8942<p class="text-[10px] text-slate-400">RFID: 9024-F8A</p></td>
                                <td class="py-3.5 px-6 font-bold text-slate-800">The Ritz-Carlton Downtown</td>
                                <td class="py-3.5 px-6">Hospitality Linens (Express)</td>
                                <td class="py-3.5 px-6"><span class="bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full">Ironing & Fold</span></td>
                                <td class="py-3.5 px-6 font-bold">11:15 AM</td>
                                <td class="py-3.5 px-6 text-right"><button class="bg-sky-600 text-white px-3 py-1 rounded-lg font-bold">Advance</button></td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="py-3.5 px-6 font-bold text-sky-600">#LC-8941<p class="text-[10px] text-slate-400">RFID: 9024-F4R</p></td>
                                <td class="py-3.5 px-6 font-bold text-slate-800">Alexander Wright</td>
                                <td class="py-3.5 px-6">Executive Dry Cleaning</td>
                                <td class="py-3.5 px-6"><span class="bg-sky-100 text-sky-800 font-bold px-2 py-0.5 rounded-full">Solvent Wash</span></td>
                                <td class="py-3.5 px-6 font-bold">12:30 PM</td>
                                <td class="py-3.5 px-6 text-right"><button class="bg-sky-600 text-white px-3 py-1 rounded-lg font-bold">Advance</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
