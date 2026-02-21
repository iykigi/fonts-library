@extends('layouts.app')

@section('title', 'Renus - Advanced Dashboard')

@section('content')
<main class="max-w-7xl mx-auto p-4 md:p-6 space-y-6 md:space-y-8 min-h-screen bg-gradient-to-br from-gray-50/50 to-white">

    <!-- Header - بە شێوازێکی یەکگرتوو -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 p-5 md:p-6 bg-white/80 backdrop-blur-xl rounded-3xl border border-gray-200/80 hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-500">
        <div class="flex items-center gap-3 md:gap-4">
            <div class="p-3 md:p-3.5 rounded-2xl bg-gradient-to-br from-orange-50 to-amber-50 text-[#E6501B] flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-light text-gray-900">فۆنتەکان</h1>
                <p class="text-gray-500 text-xs md:text-sm mt-0.5 font-light">بەڕێوەبردنی هەموو فۆنتەکان</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-gray-500 text-sm bg-white/80 backdrop-blur-sm px-4 py-3 rounded-xl border border-gray-200/50 shadow-sm">
                <span class="font-light">بەخێربێیت،</span> 
                <strong class="text-gray-900 font-medium">{{ auth()->user()->name }}</strong>
            </div>
        </div>
    </div>

    <!-- کارتەکان - بە هەمان شێواز -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">
        <!-- کارت ١ - کۆی فۆنتەکان -->
        <div class="group p-5 bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/80 hover:border-gray-300 hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="space-y-1.5">
                    <p class="text-xs text-gray-500 font-light tracking-wide">کۆی فۆنتەکان</p>
                    <h3 class="text-3xl font-light text-gray-900">{{ $fontsCount }}</h3>
                    <p class="text-xs text-gray-400 font-light flex items-center gap-1">
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        لە ١ ساڵ
                    </p>
                </div>
                <div class="p-3 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 h-1 w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
        </div>

        <!-- کارت ٢ - سەردانی -->
        <div class="group p-5 bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/80 hover:border-gray-300 hover:shadow-2xl hover:shadow-green-100/50 transition-all duration-500 hover:-translate-y-1 cursor-pointer" id="card-visitors">
            <div class="flex items-center justify-between">
                <div class="space-y-1.5">
                    <p class="text-xs text-gray-500 font-light tracking-wide">سەردانی</p>
                    <h3 class="text-3xl font-light text-gray-900" id="total-visitors-count">{{ $totalVisitors }}</h3>
                    <p class="text-xs text-gray-400 font-light flex items-center gap-1">
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        گشتی
                    </p>
                </div>
                <div class="p-3 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Zm-7.518-.267A8.25 8.25 0 1 1 20.25 10.5M8.288 14.212A5.25 5.25 0 1 1 17.25 10.5" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 h-1 w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
        </div>

        <!-- کارت ٣ - نوێکراوەکان -->
        <div class="group p-5 bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/80 hover:border-gray-300 hover:shadow-2xl hover:shadow-orange-100/50 transition-all duration-500 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="space-y-1.5">
                    <p class="text-xs text-gray-500 font-light tracking-wide">نوێکراوەکان</p>
                    <h3 class="text-3xl font-light text-gray-900">{{ $updatedFontsCount }}</h3>
                    <p class="text-xs text-gray-400 font-light flex items-center gap-1">
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        لە ١ ساڵ
                    </p>
                </div>
                <div class="p-3 bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 h-1 w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
        </div>

        <!-- کارت ٤ - فۆنتە نوێکان -->
        <div class="group p-5 bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/80 hover:border-gray-300 hover:shadow-2xl hover:shadow-purple-100/50 transition-all duration-500 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="space-y-1.5">
                    <p class="text-xs text-gray-500 font-light tracking-wide">فۆنتە نوێکان</p>
                    <h3 class="text-3xl font-light text-gray-900">{{ $yearlyFontsCount }}</h3>
                    <p class="text-xs text-gray-400 font-light flex items-center gap-1">
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        لە ١ ساڵدا
                    </p>
                </div>
                <div class="p-3 bg-gradient-to-br from-purple-50 to-violet-50 rounded-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 h-1 w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
        </div>
    </div>

    <!-- مۆدال - بە شێوازێکی یەکگرتوو -->
    <div id="modal-visitors" class="fixed inset-0 flex items-center justify-center bg-black/30 backdrop-blur-md hidden z-50 transition-all duration-300">
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-8 w-11/12 max-w-lg relative shadow-2xl border border-white/40 scale-95 hover:scale-100 transition-all duration-300">
            <button id="close-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-3xl font-light transition-colors duration-200">&times;</button>
            
            <h2 class="text-2xl font-light text-gray-900 mb-2">زانیاری سەردانەکان</h2>
            <p class="text-gray-500 text-sm font-light mb-8">ئامارەکانی سەردانیکەران بەپێی کات</p>

            <div class="grid grid-cols-2 gap-4">
                <div class="p-5 bg-gradient-to-br from-blue-50/80 to-transparent rounded-2xl border border-blue-100/50 group hover:shadow-lg hover:shadow-blue-100/30 transition-all duration-300">
                    <h3 class="text-gray-500 text-xs font-light mb-2">ئەمڕۆ</h3>
                    <p id="day-visitors" class="text-3xl font-light text-blue-600">{{ $todayVisitors }}</p>
                    <div class="mt-2 h-0.5 w-10 bg-blue-200 rounded-full group-hover:w-full transition-all duration-500"></div>
                </div>
                <div class="p-5 bg-gradient-to-br from-green-50/80 to-transparent rounded-2xl border border-green-100/50 group hover:shadow-lg hover:shadow-green-100/30 transition-all duration-300">
                    <h3 class="text-gray-500 text-xs font-light mb-2">ئەم هەفتەیە</h3>
                    <p id="week-visitors" class="text-3xl font-light text-green-600">{{ $weeklyVisitors }}</p>
                    <div class="mt-2 h-0.5 w-10 bg-green-200 rounded-full group-hover:w-full transition-all duration-500"></div>
                </div>
                <div class="p-5 bg-gradient-to-br from-purple-50/80 to-transparent rounded-2xl border border-purple-100/50 group hover:shadow-lg hover:shadow-purple-100/30 transition-all duration-300">
                    <h3 class="text-gray-500 text-xs font-light mb-2">ئەم مانگە</h3>
                    <p id="month-visitors" class="text-3xl font-light text-purple-600">{{ $monthlyVisitors }}</p>
                    <div class="mt-2 h-0.5 w-10 bg-purple-200 rounded-full group-hover:w-full transition-all duration-500"></div>
                </div>
                <div class="p-5 bg-gradient-to-br from-orange-50/80 to-transparent rounded-2xl border border-orange-100/50 group hover:shadow-lg hover:shadow-orange-100/30 transition-all duration-300">
                    <h3 class="text-gray-500 text-xs font-light mb-2">ئەم ساڵ</h3>
                    <p id="year-visitors" class="text-3xl font-light text-orange-600">{{ $yearlyVisitors }}</p>
                    <div class="mt-2 h-0.5 w-10 bg-orange-200 rounded-full group-hover:w-full transition-all duration-500"></div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-center gap-1">
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            </div>
        </div>
    </div>

    <!-- لیستی فۆنتەکان -->
    <div class="overflow-hidden bg-white/80 backdrop-blur-xl rounded-3xl border border-gray-200/80 hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-500">
        <div class="p-6 border-b border-gray-100/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white/50">
            <div class="flex flex-col md:flex-row md:items-center gap-6 w-full md:w-auto">
                <div class="relative">
                    <h2 class="text-2xl font-light tracking-tight text-gray-900">لیستی فۆنتەکان</h2>
                    <p class="text-gray-500 text-sm mt-1 font-light">{{ $fontsCount }} فۆنت</p>
                    <div class="absolute -top-1 -right-2 w-20 h-20 bg-gradient-to-br from-gray-100 to-transparent rounded-full blur-2xl -z-10"></div>
                </div>  

                <div class="flex justify-center">
    <div class="relative w-full md:w-80">
        <input type="text" name="search" id="font-search" placeholder="گەڕان بۆ فۆنت..."
            value="{{ request('search') }}"
            class="w-full pl-12 pr-5 py-3.5 rounded-2xl border border-gray-200/80 text-sm text-gray-800 placeholder-gray-400 bg-white/70 backdrop-blur-md focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-gray-300 shadow-sm transition-all duration-300 hover:bg-white/90">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
        </svg>
    </div>
</div>

<!-- JavaScript بۆ گەڕان -->
<script>
document.getElementById('font-search').addEventListener('input', function(e) {
    const searchValue = e.target.value;
    const url = new URL(window.location.href);
    
    if (searchValue.length > 0) {
        url.searchParams.set('search', searchValue);
    } else {
        url.searchParams.delete('search');
    }
    
    // ڕێگری لە ڕیفرێش بوونی پەیجەکە بکە
    window.location.href = url.toString();
});

// بۆ ئەوەی بە دوای تەواو بوونی نووسین بگەڕێ (بۆ ئەنجامدانی باشتر)
let timeout = null;
document.getElementById('font-search').addEventListener('keyup', function(e) {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        const searchValue = e.target.value;
        const url = new URL(window.location.href);
        
        if (searchValue.length > 0) {
            url.searchParams.set('search', searchValue);
        } else {
            url.searchParams.delete('search');
        }
        
        window.location.href = url.toString();
    }, 500); // ٥٠٠ میلیچرکە دوای وەستانی نووسین
});
</script>
            </div>

            <a class="px-5 py-2.5 bg-gray-900 text-white text-sm font-light rounded-xl hover:bg-gray-800 transition-all duration-300 flex items-center gap-2 shadow-md hover:shadow-lg hover:-translate-y-0.5 group" href="{{ url('/fonts/create') }}">
                <span>زیادکردن</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto p-2">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-center py-4 pr-8 text-xs font-light text-gray-500 uppercase tracking-wider">ناو</th>
                        <th class="text-center py-4 pr-8 text-xs font-light text-gray-500 uppercase tracking-wider">کۆد</th>
                        <th class="text-center py-4 pr-8 text-xs font-light text-gray-500 uppercase tracking-wider">جۆر</th>
                        <th class="text-center py-4 pr-8 text-xs font-light text-gray-500 uppercase tracking-wider">دابەزاندن</th>
                        <th class="text-center py-4 pr-8 text-xs font-light text-gray-500 uppercase tracking-wider">کاتی بلاوکردنەوە</th>
                        <th class="text-center py-4 pr-8 text-xs font-light text-gray-500 uppercase tracking-wider">کردار</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @include('font.partials.font_lab', ['fonts' => $fonts])
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
@if($fonts->hasPages())
<div class="px-6 py-4 border-t border-gray-200 bg-white flex flex-col md:flex-row justify-between items-center gap-3">
    
    <!-- نمایشی ژمارەکان -->
    <div class="text-xs text-gray-500 font-light order-2 md:order-1">
        @if($fonts->total() > 0)
            <span class="bg-gray-50 px-3 py-1.5 rounded-full">
                {{ $fonts->firstItem() }} - {{ $fonts->lastItem() }} 
                <span class="text-gray-400">لە</span> 
                {{ $fonts->total() }} فۆنت
            </span>
        @endif
    </div>

    <!-- لینکەکانی پەیج -->
    <div class="flex items-center gap-2 order-1 md:order-2">
        <!-- دکمەی پێشوو -->
        @if($fonts->onFirstPage())
            <span class="px-3 py-2 text-gray-300 bg-gray-50 rounded-lg text-sm cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
        @else
            <a href="{{ $fonts->previousPageUrl() }}" class="px-3 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @endif

        <!-- ژمارە پەیجەکان -->
        <div class="flex items-center gap-1">
            @foreach(range(1, $fonts->lastPage()) as $page)
                @if($page == $fonts->currentPage())
                    <span class="w-8 h-8 flex items-center justify-center text-sm font-medium text-white bg-gray-800 rounded-lg shadow-sm">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $fonts->url($page) }}" class="w-8 h-8 flex items-center justify-center text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all duration-200">
                        {{ $page }}
                    </a>
                @endif
            @endforeach
        </div>

        <!-- دکمەی دواتر -->
        @if($fonts->hasMorePages())
            <a href="{{ $fonts->nextPageUrl() }}" class="px-3 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @else
            <span class="px-3 py-2 text-gray-300 bg-gray-50 rounded-lg text-sm cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        @endif
    </div>

</div>
@endif

        
        <div class="px-6 py-3 border-t border-gray-100/50 bg-white/30 flex justify-between items-center text-xs text-gray-400 font-light">
            <span>© 2024 فۆنتەکان</span>
            <span class="flex items-center gap-1">
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            </span>
        </div>
    </div>

    <!-- کارتەکانی خوارەوە - بە هەمان شێواز -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5">
        <!-- Latest Fonts Card -->
        <div class="group bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/80 hover:shadow-gray-200/50 hover:shadow-xl p-5 flex flex-col h-full transition-all duration-500 hover:-translate-y-1">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-2.5 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl group-hover:scale-110 transition-transform duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1 4V8h-1m4 8h-1v-4h-1m1 4V8h-1m4 8h-1v-4h-1m1 4V8h-1M3 20h18M4 4h16M4 8h16M4 12h16M4 16h16M4 20h16" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-light">نوێترین فۆنتەکان</p>
                    <h3 class="text-xl font-light text-gray-900">{{ $latestestFonts->count() }}</h3>
                </div>
            </div>
            <ul class="space-y-2 flex-1 overflow-auto">
                @foreach($latestestFonts as $font)
                <li class="flex justify-between items-center bg-gray-50/80 backdrop-blur-sm px-4 py-2 rounded-xl hover:bg-gray-100/80 transition-all duration-300 border border-gray-100/50 group-hover:border-gray-200">
                    <span class="text-sm text-gray-700 font-light">{{ $font->name }}</span>
                    <span class="text-xs text-gray-400 font-light">{{ $font->created_at->format('Y/m/d') }}</span>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Updated Fonts Card -->
        <div class="group bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/80 hover:shadow-gray-200/50 hover:shadow-xl p-5 flex flex-col h-full transition-all duration-500 hover:-translate-y-1">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-2.5 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl group-hover:scale-110 transition-transform duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v16h16M4 4l16 16" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-light">نوێکراوەکان</p>
                    <h3 class="text-xl font-light text-gray-900">{{ $updatedFontsCount }}</h3>
                </div>
            </div>
            <ul class="space-y-2 flex-1 overflow-auto">
                @foreach($latestFonts as $font)
                <li class="flex justify-between items-center bg-gray-50/80 backdrop-blur-sm px-4 py-2 rounded-xl hover:bg-gray-100/80 transition-all duration-300 border border-gray-100/50 group-hover:border-gray-200">
                    <span class="text-sm text-gray-700 font-light">{{ $font->name }}</span>
                    <span class="text-xs text-gray-400 font-light">{{ $font->updated_at->format('Y/m/d') }}</span>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Yearly Stats Card -->
        <div class="group bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/80 hover:shadow-gray-200/50 hover:shadow-xl p-5 flex flex-col h-full transition-all duration-500 hover:-translate-y-1">
            <h3 class="text-sm font-light text-gray-900 mb-4">ئامارەکان لە ماوەی ساڵێك</h3>
            <div class="space-y-2 flex-1 overflow-auto">
                @foreach([
                    ['label' => 'کۆی فۆنتەکان', 'value' => $fontsCount, 'color' => 'text-gray-900'],
                    ['label' => 'فۆنتە نوێکان', 'value' => $yearlyFontsCount, 'color' => 'text-gray-900'],
                    ['label' => 'نوێکراوەکان', 'value' => $updatedFontsCount, 'color' => 'text-gray-900'],
                ] as $stat)
                <div class="flex justify-between items-center bg-gray-50/80 backdrop-blur-sm px-4 py-2 rounded-xl hover:bg-gray-100/80 transition-all duration-300 border border-gray-100/50 group-hover:border-gray-200">
                    <span class="text-sm text-gray-500 font-light">{{ $stat['label'] }}</span>
                    <span class="text-sm font-light {{ $stat['color'] }}">{{ $stat['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</main>

<!-- JavaScript -->
<script>
    (function() {
        const card = document.getElementById('card-visitors');
        const modal = document.getElementById('modal-visitors');
        const closeModal = document.getElementById('close-modal');

        if (card && modal && closeModal) {
            card.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });

            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        }
    })();
</script>
@endsection