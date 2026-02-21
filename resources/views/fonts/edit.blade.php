@extends('layouts.app')

@section('content')

<!-- گرافیکی ڕازاوە -->
<div class="fixed top-0 right-0 w-96 h-96 bg-gradient-to-br from-gray-200/20 to-transparent rounded-full blur-3xl -z-10"></div>
<div class="fixed bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-gray-200/10 to-transparent rounded-full blur-3xl -z-10"></div>

<div class="min-h-screen py-12 px-4">
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-light text-gray-900 mb-3">دەستکاریکردنی فۆنت</h1>
            <div class="flex justify-center gap-1 mb-4">
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            </div>
            <p class="text-gray-400 text-sm font-light max-w-md mx-auto">
                زانیاری فۆنتەکەت نوێ بکەوە
            </p>
        </div>

        <!-- Card -->
        <form action="{{ route('fonts.update', $font->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white/80 backdrop-blur-xl border border-gray-200/80 rounded-3xl p-8 space-y-8 hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Font Name -->
                <div class="space-y-2">
                    <label class="text-sm font-light text-gray-500 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 7h16M4 12h16M4 17h16"/>
                        </svg>
                        ناوی فۆنت
                    </label>
                    <input id="name" name="name" required
                           value="{{ old('name', $font->name) }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200/80 bg-white/50 backdrop-blur-sm
                                  focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition-all duration-300
                                  placeholder:text-gray-300 font-light"
                           placeholder="بۆ نموونە: Vazirmatn">
                </div>

                <!-- Font Code -->
                <div class="space-y-2">
                    <label class="text-sm font-light text-gray-500 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M16 18l6-6-6-6M8 6l-6 6 6 6"/>
                        </svg>
                        کۆدی فۆنت
                    </label>
                    <input id="code" name="code" required
                           value="{{ old('code', $font->code) }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200/80 bg-white/50 backdrop-blur-sm
                                  focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition-all duration-300
                                  placeholder:text-gray-300 font-light font-mono text-sm"
                           placeholder="VAR-001">
                </div>

                <!-- Style -->
                <div class="space-y-2">
                    <label class="text-sm font-light text-gray-500 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 6v12m6-6H6"/>
                        </svg>
                        ستیلی فۆنت
                    </label>
                    <select id="style" name="style" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200/80 bg-white/50 backdrop-blur-sm
                                   focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition-all duration-300
                                   font-light text-gray-600 appearance-none">
                        <option value="" class="bg-white">-- هەڵبژێرە --</option>
                        <option value="Normal" @selected($font->style=='Normal') class="bg-white">Normal</option>
                        <option value="Bold" @selected($font->style=='Bold') class="bg-white">Bold</option>
                        <option value="Italic" @selected($font->style=='Italic') class="bg-white">Italic</option>
                        <option value="Handwriting" @selected($font->style=='Handwriting') class="bg-white">Handwriting</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-light text-gray-500 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                        </svg>
                        وەسفی فۆنت
                    </label>
                    <textarea name="description" rows="4"
                              class="w-full px-4 py-3 rounded-xl border border-gray-200/80 bg-white/50 backdrop-blur-sm
                                     focus:ring-2 focus:ring-gray-300 focus:border-gray-300 transition-all duration-300
                                     font-light text-gray-600 resize-none"
                              placeholder="وەسفێکی کورت لەسەر فۆنتەکە بنووسە...">{{ old('description', $font->description) }}</textarea>
                </div>
            </div>

            <!-- Current file -->
            <div class="bg-gray-50/80 backdrop-blur-sm rounded-xl p-4 border border-gray-200/80">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z"/>
                    </svg>
                    <span class="text-sm font-light text-gray-500">فایلی ئێستا:</span>
                    <span class="text-sm font-light text-gray-700 bg-white/50 px-3 py-1 rounded-lg border border-gray-200/80">
                        {{ $font->file_path }}
                    </span>
                </div>
            </div>

            <!-- File input -->
            <div class="space-y-3">
                <label class="text-sm font-light text-gray-500 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                    </svg>
                    فایلی فۆنت (ئارەزوومەندانە)
                </label>

                <label id="dropZone"
                       for="file_path"
                       class="flex flex-col items-center justify-center border-2 border-dashed
                              border-gray-200/80 rounded-2xl p-10 cursor-pointer
                              hover:border-gray-300 hover:bg-gray-50/50 transition-all duration-300 group">

                    <svg class="w-12 h-12 text-gray-400 mb-3 group-hover:scale-110 group-hover:translate-y-[-5px] transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12V4m0 0l-4 4m4-4l4 4"/>
                    </svg>

                    <p id="fileName" class="text-gray-400 text-sm font-light mb-2">
                        ڕابکێشە یان کرتە بکە بۆ گۆڕینی فایل
                    </p>
                    <p class="text-xs text-gray-300 font-light">پشتگیری لە .ttf, .otf, .woff, .woff2 دەکات</p>

                    <div class="w-full max-w-xs bg-gray-100 rounded-full h-1.5 mt-6">
                        <div id="progressBar"
                             class="bg-gray-900 h-1.5 w-0 transition-all duration-700 rounded-full"></div>
                    </div>
                </label>

                <input type="file" id="file_path" name="font_file" accept=".ttf,.otf,.woff,.woff2" class="hidden">
            </div>

            <!-- Submit -->
            <div class="flex justify-end pt-6 border-t border-gray-100/50">
                <div class="flex gap-3">
                    <a href="{{ route('fonts.index') }}"
                       class="group px-8 py-3.5 rounded-xl text-gray-600 font-light bg-white/80 backdrop-blur-sm border border-gray-200/80 hover:bg-gray-100/80 transition-all duration-300 hover:-translate-y-0.5 shadow-sm hover:shadow-md flex items-center gap-2">
                        <span>ڕەتکردنەوە</span>
                    </a>

                    <button id="submitBtn"
                            class="group px-8 py-3.5 rounded-xl text-white font-light bg-gray-900 hover:bg-gray-800 transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-xl flex items-center gap-2">
                        <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                        </svg>
                        <span>نوێکردنەوەی فۆنت</span>
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
const fileInput = document.getElementById('file_path');
const dropZone = document.getElementById('dropZone');
const fileName = document.getElementById('fileName');
const progressBar = document.getElementById('progressBar');

fileInput.addEventListener('change', function() {
    if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
    } else {
        fileName.textContent = 'ڕابکێشە یان کرتە بکە بۆ گۆڕینی فایل';
    }
});

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('border-gray-400', 'bg-gray-50');
});

dropZone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-gray-400', 'bg-gray-50');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    if (e.dataTransfer.files.length > 0) {
        fileInput.files = e.dataTransfer.files;
        fileName.textContent = e.dataTransfer.files[0].name;
    }
});
</script>

@endsection
