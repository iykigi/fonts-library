@extends('layout.nav')

@section('title', 'renus - font - icone')

@section('content')

@foreach($fonts as $font)
<style>
@font-face {
    font-family: '{{ $font->code }}';
    src: url('{{ asset('storage/' . $font->file_path) }}') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

.font-{{ $font->code }} {
    font-family: '{{ $font->code }}', sans-serif !important;
}
</style>

@endforeach

<!-- HERO SECTION -->
<section class="pt-16 pb-20 bg-gradient-to-br from-white via-gray-50/50 to-white relative overflow-hidden">
    
    <!-- گرافیکی ڕازاوە -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-gray-200/30 to-transparent rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-gray-200/20 to-transparent rounded-full blur-3xl -z-10"></div>
    
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-14 items-center">

        <!-- Text -->
        <div class="space-y-6">
            <span class="inline-block px-4 py-1.5 border border-gray-200/80 bg-white/50 backdrop-blur-sm text-xs font-light rounded-full text-gray-600">
                Font & Platform
            </span>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-light text-gray-900 leading-tight">
                باشترین فۆنت
                <span class="text-gray-400 block mt-2">بۆ دیزاینی پڕۆفیشناڵ</span>
            </h1>

            <p class="text-gray-500 max-w-xl leading-relaxed font-light">
                لێرە فۆنتی کوالیتی بەرز دابەزێنە،
                تایبەت بە وێب، مۆبایل و بەرنامەکان.
            </p>

            <div class="flex flex-wrap gap-4 pt-4">
                <a href="{{ url('fonts') }}"
                    class="group px-6 py-3.5 rounded-xl bg-gray-900 text-white text-sm font-light hover:bg-gray-800 transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-xl flex items-center gap-2">
                    <span>بینینی فۆنتەکان</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-10 border border-gray-200/80 hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
            <p class="text-sm text-gray-400 font-light mb-4 flex items-center gap-2">
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                Font Preview
            </p>
            <p class="text-5xl md:text-6xl font-light text-gray-900">
                Aa Bb Cc
            </p>
            <p class="mt-6 text-gray-400 font-light border-t border-gray-100 pt-6">
                فۆنتەکان بە شێوەی ڕاستەوخۆ تاقی بکەوە.
            </p>
        </div>

    </div>
</section>

<!-- ACCESS SECTION -->
<section id="access" class="max-w-7xl mx-auto px-6 py-20">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-light text-gray-900 mb-4">گەیشتن بە فۆنتەکان</h2>
        <div class="flex justify-center gap-1 mb-4">
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
        </div>
        <p class="text-gray-500 max-w-2xl mx-auto font-light">
            بە شێوازی ئاسان و خێرا فۆنتە کوردییەکان بەدەست بهێنە و لە پرۆژەکانی خۆتدا بەکاری بهێنە
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Step 1 -->
        <div class="group border border-gray-200/80 bg-white/80 backdrop-blur-sm rounded-2xl p-8 text-center hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-50 mx-auto mb-6 flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <h3 class="font-light text-xl text-gray-900 mb-3">گەڕان و دۆزینەوە</h3>
            <p class="text-gray-400 text-sm font-light">
                لە کۆکراوەی فۆنتەکانماندا بگەڕێ و فۆنتی گونجاو بۆ پێویستەکەت بدۆزەرەوە
            </p>
            <div class="mt-4 h-0.5 w-0 group-hover:w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full transition-all duration-700"></div>
        </div>

        <!-- Step 2 -->
        <div class="group border border-gray-200/80 bg-white/80 backdrop-blur-sm rounded-2xl p-8 text-center hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-50 mx-auto mb-6 flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
            </div>
            <h3 class="font-light text-xl text-gray-900 mb-3">داگرتن</h3>
            <p class="text-gray-400 text-sm font-light">
                فۆنتەکە داگرە و لەسەر کۆمپیوتەر یان مۆبایلەکەت دایمەزرێنە
            </p>
            <div class="mt-4 h-0.5 w-0 group-hover:w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full transition-all duration-700"></div>
        </div>

        <!-- Step 3 -->
        <div class="group border border-gray-200/80 bg-white/80 backdrop-blur-sm rounded-2xl p-8 text-center hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-50 mx-auto mb-6 flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <h3 class="font-light text-xl text-gray-900 mb-3">بەکارهێنان</h3>
            <p class="text-gray-400 text-sm font-light">
                فۆنتەکە لە وێبسایت، پرۆژەی دیزاین یان بەرنامەکەتدا بەکاری بهێنە
            </p>
            <div class="mt-4 h-0.5 w-0 group-hover:w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full transition-all duration-700"></div>
        </div>
    </div>

    <!-- CTA Button -->
    <div class="text-center mt-16">
        <a href="{{ url('fonts') }}"
            class="group inline-flex items-center gap-3 bg-white/80 backdrop-blur-sm text-gray-900 hover:shadow-xl px-8 py-4 rounded-2xl border border-gray-200/80 hover:border-gray-300 transition-all duration-500 hover:-translate-y-0.5 font-light">
            <span>دەستبکە بە بینینی فۆنتەکان</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
</section>

<!-- FONT CARDS -->
<div class="max-w-7xl mx-auto px-6">
    <div class="mb-8 text-center">
        <h2 class="text-2xl md:text-3xl font-light text-gray-900 mb-2">فۆنتەکان</h2>
        <p class="text-gray-400 text-sm font-light">هەڵبژاردەیەک لە باشترین فۆنتە کوردییەکان</p>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($fonts as $font)
        <a href="{{ route('fonts.show', Crypt::encrypt($font->id)) }}" class="block group">
            <div class="font-card bg-white/80 backdrop-blur-sm rounded-2xl hover:border-gray-300 hover:shadow-2xl hover:shadow-gray-200/50 p-6 cursor-pointer border border-gray-200/80 transition-all duration-500 hover:-translate-y-1 relative overflow-hidden">
                
                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-gray-100/50 to-transparent rounded-full blur-2xl -z-10 group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-light text-xl text-gray-900">{{ $font->name }}</h3>
                    <span class="text-gray-400 text-xs bg-white/50 backdrop-blur-sm border border-gray-200/80 rounded-xl px-3 py-1.5 font-light">
                        #{{ $font->code }}
                    </span>
                </div>
                
                <p class="text-gray-600 font-{{ $font->code }} bg-white/50 backdrop-blur-sm rounded-xl p-4 text-sm text-center mb-4 leading-relaxed border border-gray-100/80 group-hover:border-gray-200/80 transition-all duration-300">
                    {{ $font->description }}
                </p>
                
                <div class="flex justify-between items-center text-xs text-gray-400 font-light">
                    <span class="flex items-center gap-1 group-hover:gap-2 transition-all duration-300">
                        <span>پیشان دان</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </span>
                </div>
                
                <div class="mt-3 h-0.5 w-0 group-hover:w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full transition-all duration-700"></div>
            </div>
        </a>
        @endforeach
    </div>
</div>

<!-- BRANDS SECTION -->
<section class="bg-gray-50/80 backdrop-blur-sm py-20 mt-16 border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-center text-sm text-gray-400 font-light mb-10 tracking-wide">
            فۆنتی کەناڵەکان
        </p>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-8 items-center opacity-60">
            <div class="text-center font-light text-gray-500 text-lg hover:text-gray-700 hover:opacity-100 transition-all duration-300 cursor-default">RUDAW</div>
            <div class="text-center font-light text-gray-500 text-lg hover:text-gray-700 hover:opacity-100 transition-all duration-300 cursor-default">AVA</div>
            <div class="text-center font-light text-gray-500 text-lg hover:text-gray-700 hover:opacity-100 transition-all duration-300 cursor-default">NRT</div>
            <div class="text-center font-light text-gray-500 text-lg hover:text-gray-700 hover:opacity-100 transition-all duration-300 cursor-default">K24</div>
            <div class="text-center font-light text-gray-500 text-lg hover:text-gray-700 hover:opacity-100 transition-all duration-300 cursor-default">CHANAL 8</div>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section id="about" class="bg-white/50 backdrop-blur-sm py-20">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-2xl md:text-3xl font-light text-gray-900 mb-4">دەربارەی پلاتفۆرم</h2>
        <div class="flex justify-center gap-1 mb-6">
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
        </div>
        <p class="text-gray-400 text-sm leading-7 max-w-2xl mx-auto font-light">
            ئەم سایتە دروستکراوە بۆ دابەزاندنی فۆنتی کوردی و جیهانی بە دیزاینێکی پڕۆفیشنال و UXی باش.
        </p>
    </div>
</section>
@endsection