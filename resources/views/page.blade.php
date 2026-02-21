@extends('layout.nav')

@section('title', $font->name . ' - فۆنت')

@section('content')

<style>
@font-face {
    font-family: '{{ $font->code }}';
    src: url('{{ asset('storage/' . $font->file_path) }}');
    font-display: swap;
}
.font-{{ $font->code }} {
    font-family: '{{ $font->code }}', sans-serif !important;
}
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-50/50 to-white py-8 md:py-12 px-4">

    <!-- گرافیکی ڕازاوە -->
    <div class="fixed top-0 right-0 w-96 h-96 bg-gradient-to-br from-gray-200/20 to-transparent rounded-full blur-3xl -z-10"></div>
    <div class="fixed bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-gray-200/10 to-transparent rounded-full blur-3xl -z-10"></div>

    <div class="w-full max-w-3xl mx-auto">

        <!-- Header -->
        <div class="flex items-center justify-between p-4 pt-2">
            <div class="flex items-center gap-4">
                <div class="flex flex-col">
                    <span class="text-xs text-gray-400 font-light mb-1">فۆنت</span>
                    <h1 class="text-3xl md:text-4xl font-light text-gray-900">{{ $font->name }}</h1>
                </div>
                <span class="px-3 py-1.5 bg-white/80 backdrop-blur-sm border border-gray-200/80 text-gray-500 rounded-xl text-xs font-light shadow-sm">
                    #{{ $font->code }}
                </span>
            </div>

            <!-- Back button -->
            <a href="{{ url()->previous() }}" class="group p-2 hover:bg-white/80 rounded-xl transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-gray-600 group-hover:-translate-x-1 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>

        <!-- Note -->
        <div class="bg-white/50 backdrop-blur-sm border border-gray-200/80 rounded-2xl mt-4 p-4">
            <p class="text-right text-gray-500 text-sm font-light flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                <span class="font-medium text-gray-600">تێبینی:</span>
                لە کاتی بونی هەر کێشەیەک لە فایلی فۆنتەکان ئاگەدارمان بکەنەوە
            </p>
        </div>

        <!-- Text Preview -->
        <div class="bg-white/80 backdrop-blur-sm border border-gray-200/80 rounded-2xl overflow-hidden mt-4 transition-all duration-500">
            <div class="p-8">
                <div id="textBox" contenteditable="true" class="text-center font-{{ $font->code }} transition-all duration-300 min-h-[150px] flex items-center justify-center leading-relaxed text-gray-800 outline-none focus:ring-2 focus:ring-gray-200 rounded-lg p-4" style="font-size: 24px;">
                    سڵاو من کوردە خەڵکی کوردستانم
                </div>
            </div>

            <div class="border-t border-gray-100/80 p-4 bg-white/50 flex items-center justify-between">
                <button onclick="setRandomText()" class="group text-gray-500 hover:text-gray-700 text-sm font-light flex items-center gap-2 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:rotate-180 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                    </svg>
                    گۆڕینی دەق
                </button>

                <div class="flex items-center gap-3 text-gray-400 text-sm font-light">
                    <span id="fontSizeDisplay" class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m0 0l-3-3m3 3l3-3M6 12h12" />
                        </svg>
                        ٢٤ پێکسل
                    </span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span id="fontStyleDisplay" class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>
                        ئاسایی
                    </span>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <div class="bg-white/80 backdrop-blur-sm border border-gray-200/80 rounded-2xl p-6 mt-4 transition-all duration-500">
            <h3 class="text-gray-700 font-light text-lg mb-6 flex items-center gap-2">
                <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                ڕێکخستنەکان
            </h3>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <!-- Right side: Font sizes -->
                <div class="space-y-3">
                    <label class="text-gray-400 text-xs font-light tracking-wide">قەبارەی فۆنت</label>
                    <div class="flex gap-2">
                        @foreach([32, 24, 20, 16, 12] as $size)
                        <button onclick="setFont({{ $size }})" class="control-size w-14 h-12 rounded-xl font-light text-lg transition-all duration-300 hover:bg-gray-100 active:bg-gray-200 hover:border-gray-300 {{ $size == 24 ? 'bg-gray-100 border-gray-300' : 'bg-white border-gray-200/80' }} border shadow-sm hover:shadow" data-size="{{ $size }}">{{ $size }}</button>
                        @endforeach
                    </div>
                </div>

                <!-- Left side: Bold / Italic -->
                <div class="space-y-3">
                    <label class="text-gray-400 text-xs font-light tracking-wide">جۆری فۆنت</label>
                    <div class="flex gap-2">
                        <button onclick="toggleBold()" id="boldBtn" class="control-style w-14 h-12 rounded-xl font-bold text-lg transition-all duration-300 hover:bg-gray-100 active:bg-gray-200 bg-white border border-gray-200/80 hover:border-gray-300 shadow-sm hover:shadow" data-style="bold">B</button>
                        <button onclick="toggleItalic()" id="italicBtn" class="control-style w-14 h-12 rounded-xl italic text-lg transition-all duration-300 hover:bg-gray-100 active:bg-gray-200 bg-white border border-gray-200/80 hover:border-gray-300 shadow-sm hover:shadow" data-style="italic">I</button>
                    </div>
                </div>
            </div>

            <!-- هێڵی ڕازاوە -->
            <div class="mt-6 h-px w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
        </div>

        <!-- Footer with Download Counter -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white/70 backdrop-blur-xl rounded-2xl p-5 border border-gray-200/80 shadow-sm mt-4">
            
            <!-- بەشی ژمارە و دوگمە -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                
                <!-- دوگمەی دابەزاندن -->
                <a href="{{ route('fonts.download', Crypt::encrypt($font->id)) }}" id="downloadBtn" class="relative bg-gray-800 text-white px-6 py-3 rounded-xl font-light hover:from-gray-900 hover:to-black transition-all duration-500 hover:-translate-y-0.5 shadow-md hover:shadow-xl flex items-center gap-2.5 group/btn overflow-hidden">
                    
                    <!-- شەپۆلی ڕووناکی لەسەر دوگمە -->
                    <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover/btn:translate-x-full transition-transform duration-1000"></span>
                    
                    <!-- ئایکۆنی دابەزاندن -->
                    <svg id="downloadIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover/btn:translate-y-1 transition-transform duration-300 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>

                    <!-- سپینەر (شاراوە) -->
                    <span id="spinner" class="hidden h-4 w-4 border-2 border-white/80 border-t-transparent rounded-full animate-spin relative z-10"></span>

                    <!-- تێکستی دوگمە -->
                    <span id="btnText" class="text-sm tracking-wide relative z-10">داگرتن</span>
                    
                    <!-- ئەنیمەیشنی نقطە -->
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-white/30 rounded-full opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></span>
                </a>

                <!-- ژمێرەری دابەزاندن -->
                <div id="downloadCounter" class="flex items-center gap-1.5 px-3.5 py-2 bg-white/40 backdrop-blur-sm rounded-xl border border-white/30 hover:border-gray-200/50 transition-all duration-300 group/counter">
                    
                    <!-- ئایکۆنی بچووک -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-400 group-hover/counter:text-indigo-400 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    
                    <!-- ژمارە -->
                    <span class="text-gray-700 text-sm font-light tabular-nums" id="downloadCount-{{ $font->id }}">
    {{ $font->downloads }}
</span>

<script>
function formatNumber(num) {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M';
    } else if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'K';
    }
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// بەکارهێنان
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('[id^="downloadCount-"]');
    elements.forEach(el => {
        const num = parseInt(el.textContent);
        el.textContent = formatNumber(num);
    });
});
</script>

                    <!-- تێکست -->
                    <span class="text-gray-400 text-[10px] font-light tracking-wider">دابەزاندن</span>
                </div>
            </div>
            
            <!-- بەشی ڕاست - ئامارە خێراکان -->
            <div class="hidden sm:flex items-center gap-4 text-xs text-gray-400">
                <div class="flex items-center gap-1.5">
                    <span class="w-1 h-1 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="font-light">فۆنت ئامادەیە</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="h-3 w-3 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-light">{{ $font->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <!-- More info -->
        <div class="mt-6 text-center">
            <div class="flex justify-center gap-1">
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            </div>
        </div>
    </div>
</div>

<script>
    // ==================== کۆنترۆڵی فۆنت ====================
    const textBox = document.getElementById("textBox");
    const fontSizeDisplay = document.getElementById("fontSizeDisplay");
    const fontStyleDisplay = document.getElementById("fontStyleDisplay");
    const boldBtn = document.getElementById("boldBtn");
    const italicBtn = document.getElementById("italicBtn");

    const lines = [
        "سڵاو من کوردە خەڵکی کوردستانم",
        "هەموو ڕۆژێک خەونێکی نوێ هەیە",
        "ژینگە خۆشەویست و باشتر دەبێت",
        "بە هەموو هەست و دڵ خۆش بەڕەوە",
        "کوردستانەمان پڕە لە شان و شێوە",
        "دەستی یەکگرتوو بن، کوردستانێکی بەهێز دروست دەکەین",
        "ئەم فۆنتە تایبەتە بە زمانی کوردی",
        "زمانی کوردی زمانێکی دەوڵەمەندە",
        "فۆنتەکان ڕۆڵی گرنگ دەگێڕن لە دیزایندا"
    ];

    let isBold = false;
    let isItalic = false;

    function setRandomText() {
        const randomIndex = Math.floor(Math.random() * lines.length);
        textBox.innerText = lines[randomIndex];
        textBox.style.transform = 'scale(1.02)';
        setTimeout(() => {
            textBox.style.transform = 'scale(1)';
        }, 200);
    }

    function setFont(size) {
        textBox.style.fontSize = size + "px";
        fontSizeDisplay.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m0 0l-3-3m3 3l3-3M6 12h12" /></svg> ${size} پێکسل`;

        document.querySelectorAll('.control-size').forEach(btn => {
            btn.classList.remove('bg-gray-100', 'border-gray-300');
            btn.classList.add('bg-white', 'border-gray-200/80');

            if (parseInt(btn.getAttribute('data-size')) == size) {
                btn.classList.remove('bg-white', 'border-gray-200/80');
                btn.classList.add('bg-gray-100', 'border-gray-300');
            }
        });
    }

    function toggleBold() {
        isBold = !isBold;
        textBox.style.fontWeight = isBold ? 'bold' : 'normal';
        boldBtn.classList.toggle('bg-gray-100', isBold);
        boldBtn.classList.toggle('border-gray-300', isBold);
        boldBtn.classList.toggle('bg-white', !isBold);
        boldBtn.classList.toggle('border-gray-200/80', !isBold);
        updateStyleDisplay();
    }

    function toggleItalic() {
        isItalic = !isItalic;
        textBox.style.fontStyle = isItalic ? 'italic' : 'normal';
        italicBtn.classList.toggle('bg-gray-100', isItalic);
        italicBtn.classList.toggle('border-gray-300', isItalic);
        italicBtn.classList.toggle('bg-white', !isItalic);
        italicBtn.classList.toggle('border-gray-200/80', !isItalic);
        updateStyleDisplay();
    }

    function updateStyleDisplay() {
        let styleText = "ئاسایی";
        let icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" /></svg>';

        if (isBold && isItalic) styleText = "قەڵەو و لار";
        else if (isBold) styleText = "قەڵەو";
        else if (isItalic) styleText = "لار";

        fontStyleDisplay.innerHTML = icon + ' ' + styleText;
    }

    // ==================== کۆنترۆڵی دابەزاندن (چاککراوە) ====================
    const btn = document.getElementById("downloadBtn");
    const spinner = document.getElementById("spinner");
    const icon = document.getElementById("downloadIcon");
    const text = document.getElementById("btnText");
    const downloadCountSpan = document.getElementById("downloadCount");
    const fontId = {{ $font->id }};
    const csrfToken = '{{ csrf_token() }}';
    
    // ڕێگرتن لە فرە کلیک
    let isDownloading = false;

    if (btn) {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            
            // ئەگەر دابەزاندن لە ئارادایە، ڕێگری بکە
            if (isDownloading) return;
            
            // نیشاندانی سپینەر و گۆڕینی تێکست
            isDownloading = true;
            btn.disabled = true;
            spinner.classList.remove("hidden");
            icon.classList.add("hidden");
            text.textContent = "داگرتن...";

            try {
                // ناردنی داواکاری بۆ زیادکردنی ژمارە
                const response = await fetch(`/fonts/${fontId}/increment-download`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    
                    // گۆڕینی ژمارەکە
                    downloadCountSpan.textContent = data.downloads;
                    
                    // زیادکردنی ئەنیمەیشن
                    downloadCountSpan.classList.add('text-indigo-600', 'scale-125', 'font-medium');
                    setTimeout(() => {
                        downloadCountSpan.classList.remove('text-indigo-600', 'scale-125', 'font-medium');
                    }, 800);

                    // نیشاندانی پەیامی سەرکەوتن
                    showToast('فۆنت بە سەرکەوتوویی دابەزی ✓');
                }

                // وەستاندنی سپینەر دوای ٥٠٠ میلیچرکە
                setTimeout(() => {
                    // وەستاندنی سپینەر و گەڕاندنەوەی دوگمە بۆ دۆخی ئاسایی
                    spinner.classList.add("hidden");
                    icon.classList.remove("hidden");
                    text.textContent = "داگرتن";
                    btn.disabled = false;
                    isDownloading = false;
                    
                    // ڕەوانەکردنی بەکارهێنەر بۆ لینکی دابەزاندن
                    window.location.href = btn.href;
                }, 500);

            } catch (error) {
                console.error('Error:', error);
                
                // وەستاندنی سپینەر و گەڕاندنەوەی دوگمە
                spinner.classList.add("hidden");
                icon.classList.remove("hidden");
                text.textContent = "داگرتن";
                btn.disabled = false;
                isDownloading = false;
                
                // نیشاندانی پەیامی هەڵە
                showToast('کێشە ڕوویدا، تکایە دووبارە هەوڵبدەوە');
                
                // ڕەوانەکردنی بەکارهێنەر بۆ لینکی دابەزاندن
                setTimeout(() => {
                    window.location.href = btn.href;
                }, 1000);
            }
        });
    }

    // فانکشنی نیشاندانی پەیام
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-5 right-5 bg-gray-900/95 backdrop-blur-xl text-white px-5 py-3 rounded-xl shadow-2xl transform transition-all duration-500 z-50 flex items-center gap-3 border border-white/10';
        toast.innerHTML = `
            <div class="w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center">
                <svg class="w-3.5 h-3.5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <span class="text-sm font-light tracking-wide">${message}</span>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(1rem) scale(0.95)';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }

    // بارکردنی ژمارەی دابەزاندن لە سەرەتا
    async function loadDownloadCount() {
        try {
            const response = await fetch(`/fonts/${fontId}/download-count`);
            if (response.ok) {
                const data = await response.json();
                downloadCountSpan.textContent = data.downloads;
            }
        } catch (error) {
            console.error('Error loading download count:', error);
        }
    }

    // Initial setup
    setRandomText();
    setFont(24);
    updateStyleDisplay();
    loadDownloadCount();
</script>

<style>
    @keyframes pulse {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }

    #textBox:empty:before {
        content: "لێرە بنووسە...";
        color: #9ca3af;
    }

    .control-size, .control-style {
        transition: all 0.3s ease;
        font-family: system-ui, -apple-system, sans-serif;
    }

    .control-size:hover, .control-style:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .control-size:active, .control-style:active {
        transform: translateY(0);
    }

    #textBox {
        transition: all 0.3s ease;
        font-family: system-ui, -apple-system, sans-serif;
        word-break: break-word;
    }

    .bg-gradient-to-r {
        animation: pulse 3s ease-in-out infinite;
    }

    #downloadCount {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-block;
        font-variant-numeric: tabular-nums;
    }
    
    #downloadCounter {
        transition: all 0.3s ease;
        backdrop-filter: blur(8px);
    }
    
    #downloadCounter:hover {
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.6);
    }
    
    #downloadBtn {
        position: relative;
        isolation: isolate;
    }
</style>

@endsection