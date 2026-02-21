@extends('layouts.app')

@section('content')

<!-- گرافیکی ڕازاوە -->
<div class="fixed top-0 right-0 w-96 h-96 bg-gradient-to-br from-gray-200/20 to-transparent rounded-full blur-3xl -z-10"></div>
<div class="fixed bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-gray-200/10 to-transparent rounded-full blur-3xl -z-10"></div>

<div class="min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-light text-gray-900 mb-3">زیادکردنی فۆنتی نوێ</h1>
            <div class="flex justify-center gap-1 mb-4">
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            </div>
            <p class="text-gray-400 text-sm font-light max-w-md mx-auto">
                فۆنتی خۆت زیاد بکە و لە کۆمەڵگەدا بڵاوی بکەوە
            </p>
        </div>

        <!-- Step Wizard -->
        <form action="{{ route('fonts.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white/80 backdrop-blur-xl border border-gray-200/80 rounded-3xl shadow-xl p-8 space-y-8 hover:shadow-2xl transition-all duration-500">
            @csrf

            <!-- Step 1: File Upload -->
            <div id="step-1" class="step">
                <h2 class="text-xl font-light text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-xl bg-gray-900 text-white flex items-center justify-center text-sm">١</span>
                    فایلەکە دیاری بکە
                </h2>

                <label for="file_path"
                       class="flex flex-col items-center justify-center border-2 border-dashed
                              border-gray-200/80 rounded-2xl p-12 cursor-pointer
                              hover:border-gray-300 hover:bg-gray-50/50 transition-all duration-300 group">

                    <svg class="w-12 h-12 text-gray-400 mb-3 group-hover:scale-110 group-hover:translate-y-[-5px] transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12V4m0 0l-4 4m4-4l4 4"/>
                    </svg>

                    <p id="fileName" class="text-gray-400 text-sm font-light mb-2">فایلەکەت ڕابکێشە یان کرتە بکە</p>
                    <p class="text-xs text-gray-300 font-light">پشتگیری لە .ttf, .otf, .woff, .woff2 دەکات</p>

                    <div class="w-full max-w-xs bg-gray-100 rounded-full h-1.5 mt-6">
                        <div id="progressBar"
                             class="bg-gray-900 h-1.5 w-0 transition-all duration-700 rounded-full"></div>
                    </div>
                </label>

                <input type="file" id="file_path" name="file_path" required
                       accept=".ttf,.otf,.woff,.woff2" class="hidden">

                <div class="flex justify-end mt-8">
                    <button type="button" id="nextStep1"
                            class="group px-8 py-3.5 rounded-xl text-white font-light bg-gray-900 hover:bg-gray-800 transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-xl flex items-center gap-2">
                        <span>بەردەوام بە</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 2: Font Details -->
            <div id="step-2" class="step hidden">
                <h2 class="text-xl font-light text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-xl bg-gray-900 text-white flex items-center justify-center text-sm">٢</span>
                    وردەکاری فۆنت
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-light text-gray-500">ناوی فۆنت</label>
                        <input id="name" name="name" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200/80 bg-white/50 backdrop-blur-sm
                                      focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition-all duration-300
                                      placeholder:text-gray-300 font-light"
                               placeholder="بۆ نموونە: Vazirmatn">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-light text-gray-500">کۆدی فۆنت</label>
                        <input id="code" name="code" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200/80 bg-white/50 backdrop-blur-sm
                                      focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition-all duration-300
                                      placeholder:text-gray-300 font-light font-mono text-sm"
                               placeholder="VAR-001">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-light text-gray-500">ستیلی فۆنت</label>
                        <select id="style" name="style" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200/80 bg-white/50 backdrop-blur-sm
                                       focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition-all duration-300
                                       font-light text-gray-600">
                            <option value="" class="bg-white">-- هەڵبژێرە --</option>
                            <option value="Normal" class="bg-white">Normal</option>
                            <option value="Bold" class="bg-white">Bold</option>
                            <option value="Italic" class="bg-white">Italic</option>
                            <option value="Handwriting" class="bg-white">Handwriting</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 space-y-3">
                        <label class="text-sm font-light text-gray-500">وەسفی فۆنت</label>
                        
                        <!-- Tags -->
                        <div id="tags" class="flex flex-wrap gap-2">
                            <span class="tag bg-white/80 backdrop-blur-sm border border-gray-200/80 px-4 py-2 rounded-xl cursor-pointer hover:bg-gray-100/80 transition-all duration-300 text-xs font-light text-gray-500 hover:text-gray-700 shadow-sm">
                                فۆنتی دەستنووس
                            </span>
                            <span class="tag bg-white/80 backdrop-blur-sm border border-gray-200/80 px-4 py-2 rounded-xl cursor-pointer hover:bg-gray-100/80 transition-all duration-300 text-xs font-light text-gray-500 hover:text-gray-700 shadow-sm">
                                فۆنتی سەر
                            </span>
                            <span class="tag bg-white/80 backdrop-blur-sm border border-gray-200/80 px-4 py-2 rounded-xl cursor-pointer hover:bg-gray-100/80 transition-all duration-300 text-xs font-light text-gray-500 hover:text-gray-700 shadow-sm">
                                فۆنتی نەرم
                            </span>
                            <span class="tag bg-white/80 backdrop-blur-sm border border-gray-200/80 px-4 py-2 rounded-xl cursor-pointer hover:bg-gray-100/80 transition-all duration-300 text-xs font-light text-gray-500 hover:text-gray-700 shadow-sm">
                                خوێندنەوەی ئاسان
                            </span>
                        </div>

                        <!-- Textarea -->
                        <textarea id="description" name="description" rows="4"
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200/80 bg-white/50 backdrop-blur-sm
                                         focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition-all duration-300
                                         font-light text-gray-600 resize-none"
                                  placeholder="وەسفێکی کورت لەسەر فۆنتەکە بنووسە..."></textarea>
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" id="prevStep2"
                            class="group px-8 py-3.5 rounded-xl text-gray-600 font-light bg-white/80 backdrop-blur-sm border border-gray-200/80 hover:bg-gray-100/80 transition-all duration-300 hover:-translate-y-0.5 shadow-sm hover:shadow-md flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                        </svg>
                        <span>گەڕانەوە</span>
                    </button>
                    
                    <button type="submit" id="submitBtn"
                            class="group px-8 py-3.5 rounded-xl text-white font-light bg-gray-900 hover:bg-gray-800 transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-xl flex items-center gap-2">
                        <span>زیادکردنی فۆنت</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 3: Success Message -->
            <div id="step-3" class="step hidden">
                <div class="text-center py-8">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    
                    <h2 class="text-2xl font-light text-gray-900 mb-3">سەرکەوتوو!</h2>
                    <p class="text-gray-400 font-light mb-4">فۆنتەکەت بە سەرکەوتووی زیادکرا.</p>
                    
                    <div class="bg-gray-50/80 backdrop-blur-sm rounded-xl p-4 max-w-xs mx-auto mb-8 border border-gray-200/80">
                        <p class="text-gray-600 font-light text-sm mb-1">ناوی فۆنت:</p>
                        <p class="text-gray-900 font-light text-lg" id="uploadedFontName"></p>
                    </div>

                    <div class="flex justify-center">
                        <a href="{{ route('fonts.index') }}"
                           class="group px-8 py-3.5 rounded-xl text-white font-light bg-gray-900 hover:bg-gray-800 transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-xl flex items-center gap-2">
                            <span>گەڕان بۆ لیست</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const step3 = document.getElementById('step-3');

    const nextStep1 = document.getElementById('nextStep1');
    const prevStep2 = document.getElementById('prevStep2');

    const fileInput = document.getElementById('file_path');
    const fileName = document.getElementById('fileName');
    const progress = document.getElementById('progressBar');

    const codeInput = document.getElementById('code');
    const nameInput = document.getElementById('name');
    const styleInput = document.getElementById('style');
    const uploadedFontName = document.getElementById('uploadedFontName');

    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');

    const textarea = document.getElementById('description');
    const tags = document.querySelectorAll('.tag');

    /* ---------------- TAGS ---------------- */

    tags.forEach(tag => {
        tag.addEventListener('click', () => {

            const text = tag.textContent.trim();

            if (!textarea.value.includes(text)) {
                textarea.value += textarea.value ? ' ' + text : text;
            }

            textarea.focus();

            tag.style.transform = 'scale(0.95)';
            setTimeout(() => tag.style.transform = 'scale(1)', 150);
        });
    });

    /* ---------------- STEP 1 ---------------- */

    nextStep1.addEventListener('click', () => {

        if (fileInput.files.length === 0) {
            showAlert('تکایە فایلێک هەڵبژێرە');
            return;
        }

        step1.classList.add('hidden');
        step2.classList.remove('hidden');
    });

    prevStep2.addEventListener('click', () => {
        step2.classList.add('hidden');
        step1.classList.remove('hidden');
    });

    /* ---------------- FILE CHANGE ---------------- */

    fileInput.addEventListener('change', (e) => {

        const file = e.target.files[0];
        if (!file) return;

        if (file.size > 5 * 1024 * 1024) {
            showAlert('قەبارەی فایل زۆرە (زیاتر لە 5MB)');
            fileInput.value = '';
            progress.style.width = '0%';
            return;
        }

        fileName.textContent = file.name;
        fileName.classList.add('text-gray-600', 'font-medium');

        progress.style.width = '0%';
        setTimeout(() => progress.style.width = '100%', 200);

        const raw = file.name.replace(/\.[^/.]+$/, '');
        const cleanName = raw.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();
        const firstThree = cleanName.substring(0, 3) || 'FNT';
        const randomNumber = Math.floor(Math.random() * 900 + 100);

        codeInput.value = `${firstThree}-${randomNumber}`.toUpperCase();

        if (!nameInput.value) nameInput.value = raw;

        const lower = raw.toLowerCase();
        if (lower.includes('bold')) styleInput.value = 'Bold';
        else if (lower.includes('italic')) styleInput.value = 'Italic';
        else if (lower.includes('hand')) styleInput.value = 'Handwriting';
        else styleInput.value = 'Normal';
    });

    /* ---------------- SUBMIT ---------------- */

    form.addEventListener('submit', function(e) {

        if (!nameInput.value || !codeInput.value || !styleInput.value) {
            e.preventDefault();
            showAlert('تکایە هەموو خانەکان پڕبکەوە');
            return;
        }

        // نیشاندانی Step 3
        step2.classList.add('hidden');
        step3.classList.remove('hidden');

        uploadedFontName.textContent = nameInput.value;

        submitBtn.disabled = true;
        submitBtn.innerHTML = "چاوەڕوان بە...";
    });

    /* ---------------- ALERT FUNCTION ---------------- */

    function showAlert(message) {

        const alert = document.createElement('div');

        alert.className =
            'fixed top-4 right-4 bg-red-50 border border-red-200 text-red-600 px-6 py-3 rounded-xl shadow-lg text-sm font-light animate-fade-in';

        alert.textContent = message;

        document.body.appendChild(alert);

        setTimeout(() => alert.remove(), 3000);
    }

});
</script>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>

@endsection