@extends('layout.nav')

@section('title', 'renus - icone')

@section('content')

<!-- گرافیکی ڕازاوە -->
<div class="fixed top-0 right-0 w-96 h-96 bg-gradient-to-br from-gray-200/20 to-transparent rounded-full blur-3xl -z-10"></div>
<div class="fixed bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-gray-200/10 to-transparent rounded-full blur-3xl -z-10"></div>

<!-- Container -->
<div class="max-w-5xl mx-auto px-6 py-20">

    <!-- Header -->
    <div class="text-center mb-20">
        <h1 class="text-4xl md:text-5xl font-light text-gray-900 mb-4">دەربارەی Renus</h1>
        <div class="flex justify-center gap-1 mb-6">
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
        </div>
        <p class="text-gray-500 text-lg font-light max-w-2xl mx-auto leading-relaxed">
            زانیاری گشتی دەربارەی وێبسایتی ڕێنوس (renus.org)
        </p>
    </div>

    <!-- About Section -->
    <div class="grid md:grid-cols-2 gap-8">

        <!-- Card 1 - دەربارەی سایت -->
        <div class="group bg-white/80 backdrop-blur-sm border border-gray-200/80 rounded-2xl p-8 hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 hover:-translate-y-1 relative overflow-hidden">
            
            <!-- گرافیکی بچووک -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-gray-100/50 to-transparent rounded-full blur-2xl -z-10 group-hover:scale-150 transition-transform duration-700"></div>
            
            <div class="p-2 bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl w-12 h-12 flex items-center justify-center mb-5 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                </svg>
            </div>

            <h2 class="text-2xl font-light text-gray-900 mb-3">وێبسایتی Renus</h2>
            <p class="text-gray-400 font-light leading-relaxed">
                Renus.org وێبسایتێکی تایبەتە بە فۆنت، کە ئامانجی
                ئاسانکردنی بەکارهێنانی دیزاینی مۆدێرن بۆ وێب و ئەپلیکەیشنەکانە.
            </p>
            
            <!-- هێڵی ڕازاوە -->
            <div class="mt-6 h-0.5 w-0 group-hover:w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full transition-all duration-700"></div>
        </div>

        <!-- Card 2 - ساڵی دەستپێکردن -->
        <div class="group bg-white/80 backdrop-blur-sm border border-gray-200/80 rounded-2xl p-8 hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 hover:-translate-y-1 relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-gray-100/50 to-transparent rounded-full blur-2xl -z-10 group-hover:scale-150 transition-transform duration-700"></div>
            
            <div class="p-2 bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl w-12 h-12 flex items-center justify-center mb-5 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
            </div>

            <h2 class="text-2xl font-light text-gray-900 mb-3">ساڵی دەستپێکردن</h2>
            <p class="text-gray-400 font-light">
                وێبسایتی Renus لە ساڵی
                <span class="font-medium text-gray-900">2024</span>
                دەستی بە کارکردن کردووە.
            </p>
            
            <div class="mt-6 h-0.5 w-0 group-hover:w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full transition-all duration-700"></div>
        </div>

        <!-- Card 3 - دروستکەری سایت -->
        <div class="group bg-white/80 backdrop-blur-sm border border-gray-200/80 rounded-2xl p-8 hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 hover:-translate-y-1 relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-gray-100/50 to-transparent rounded-full blur-2xl -z-10 group-hover:scale-150 transition-transform duration-700"></div>
            
            <div class="p-2 bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl w-12 h-12 flex items-center justify-center mb-5 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>

            <h2 class="text-2xl font-light text-gray-900 mb-3">دروستکەری سایت</h2>
            <p class="text-gray-400 font-light">
                ئەم سایتە دروست کراوە لە لایەن 
                <a href="#" class="text-gray-900 font-medium hover:text-gray-700 transition-colors duration-300 border-b border-gray-200 hover:border-gray-400 pb-0.5">نیاز</a>
            </p>
            
            <div class="mt-6 h-0.5 w-0 group-hover:w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full transition-all duration-700"></div>
        </div>

        <!-- Card 4 - پەیوەندی -->
        <div class="group bg-white/80 backdrop-blur-sm border border-gray-200/80 rounded-2xl p-8 hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 hover:-translate-y-1 relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-gray-100/50 to-transparent rounded-full blur-2xl -z-10 group-hover:scale-150 transition-transform duration-700"></div>
            
            <div class="p-2 bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl w-12 h-12 flex items-center justify-center mb-5 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
            </div>

            <h2 class="text-2xl font-light text-gray-900 mb-3">پەیوەندی</h2>
            <p class="text-gray-400 font-light mb-4">
                بۆ پەیوەندی کردن لەگەڵ ئێمە:
            </p>
            <a href="mailto:info@renus.org" 
               class="inline-flex items-center gap-2 text-gray-900 font-light hover:text-gray-700 transition-all duration-300 group-hover:gap-3 border border-gray-200/80 bg-white/50 backdrop-blur-sm px-5 py-2.5 rounded-xl hover:border-gray-300 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                info@renus.org
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
            
            <div class="mt-6 h-0.5 w-0 group-hover:w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full transition-all duration-700"></div>
        </div>

    </div>

</div>

@endsection