<div id="fontModal" class="fixed inset-0 bg-black/30 backdrop-blur-md flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-500">
    <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl w-full max-w-lg mx-4 transform transition-all duration-500 scale-95 border border-white/30" id="modalContent">
        
        <!-- Header -->
        <div class="p-6 border-b border-gray-100/80 bg-gradient-to-br from-white to-gray-50/50 rounded-t-3xl">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-light text-gray-900">زیادکردنی فۆنتی نوێ</h3>
                        <p class="text-xs text-gray-400 font-light mt-1">فۆنتەکە باربکە و زانیاری بنووسە</p>
                    </div>
                </div>
                <button onclick="closeFontModal()" 
                    class="p-2 hover:bg-gray-100/80 rounded-xl transition-all duration-300 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-gray-600 group-hover:rotate-90 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- فرم -->
        <form id="addFontForm" action="{{ route('fonts.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <!-- فایل فۆنت -->
            <div class="space-y-3">
                <label class="block text-sm font-light text-gray-500 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                    </svg>
                    فایلی فۆنت <span class="text-red-400 text-xs">*</span>
                </label>
                
                <div id="fileUploadArea" 
                    class="border-2 border-dashed border-gray-200/80 rounded-2xl p-8 text-center hover:border-gray-300 transition-all duration-500 bg-white/50 hover:bg-gray-50/50 cursor-pointer group"
                    onclick="document.getElementById('fontFile').click()">
                    
                    <input type="file" id="fontFile" name="font_file" accept=".ttf,.otf,.woff,.woff2" 
                           class="hidden" onchange="handleFileSelect(event)">
                    
                    <div class="flex flex-col items-center justify-center space-y-4">
                        <div class="p-4 bg-gradient-to-br from-gray-100 to-gray-50 rounded-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600 font-light">کلیک بکە بۆ بارکردنی فایلی فۆنت</p>
                            <p class="text-xs text-gray-400 font-light mt-1">پشتگیری: .ttf, .otf, .woff, .woff2</p>
                        </div>
                    </div>
                </div>
                
                <!-- نمایش فایل هەڵبژێردراو -->
                <div id="selectedFileInfo" class="hidden">
                    <div class="flex items-center justify-between bg-gradient-to-br from-green-50/80 to-emerald-50/80 border border-green-100/80 rounded-xl p-4 backdrop-blur-sm">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-green-100/80 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p id="fileName" class="font-light text-gray-900"></p>
                                <p id="fileSize" class="text-xs text-gray-400 font-light"></p>
                            </div>
                        </div>
                        <button type="button" onclick="removeSelectedFile()" 
                                class="p-2 hover:bg-red-50/80 rounded-lg transition-all duration-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-red-500 group-hover:rotate-90 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- ناوی فۆنت -->
            <div class="space-y-2">
                <label for="fontName" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                    ناوی فۆنت <span class="text-red-400 text-xs">*</span>
                </label>
                <input type="text" id="fontName" name="name" required
                    class="w-full px-4 py-3 border border-gray-200/80 bg-white/50 backdrop-blur-sm rounded-xl focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none transition-all duration-300 placeholder:text-gray-300 font-light"
                    placeholder="بۆ نموونە: Vazirmatn">
            </div>
            
            <!-- کۆدی فۆنت -->
            <div class="space-y-2">
                <label for="fontCode" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 18l6-6-6-6M8 6l-6 6 6 6"/>
                    </svg>
                    کۆدی فۆنت <span class="text-red-400 text-xs">*</span>
                </label>
                <input type="text" id="fontCode" name="code" required
                    class="w-full px-4 py-3 border border-gray-200/80 bg-white/50 backdrop-blur-sm rounded-xl focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none transition-all duration-300 placeholder:text-gray-300 font-light font-mono"
                    placeholder="vazir-001"
                    oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9-]/g, '')">
                <p class="text-xs text-gray-400 font-light flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    تەنها پیت، ژمارە و هێڵ
                </p>
            </div>
            
            <!-- دکمەکان -->
            <div class="flex gap-3 pt-4 border-t border-gray-100/50">
                <button type="button" onclick="closeFontModal()"
                    class="flex-1 px-4 py-3 border border-gray-200/80 text-gray-500 rounded-xl hover:bg-gray-100/50 transition-all duration-300 font-light hover:-translate-y-0.5">
                    ڕەتکردنەوە
                </button>
                <button type="submit" id="submitBtn"
                    class="flex-1 px-4 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-xl font-light flex items-center justify-center gap-2 group">
                    <span>زیادکردن</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
    // کردنەوەی مۆدال
    function openFontModal() {
        const modal = document.getElementById('fontModal');
        const content = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);
        
        setTimeout(() => {
            document.getElementById('fontName').focus();
        }, 300);
    }
    
    // داخستنی مۆدال
    function closeFontModal() {
        const modal = document.getElementById('fontModal');
        const content = document.getElementById('modalContent');
        
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        modal.classList.remove('opacity-100');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            resetForm();
        }, 500);
    }
    
    // هەڵبژاردنی فایل
    function handleFileSelect(event) {
        const file = event.target.files[0];
        if (!file) return;
        
        // پشکنینی پاشگری فایل
        const validExtensions = ['ttf', 'otf', 'woff', 'woff2'];
        const fileExtension = file.name.split('.').pop().toLowerCase();
        
        if (!validExtensions.includes(fileExtension)) {
            showNotification('تکایە فایلێکی فۆنتی ڕاست هەڵبژێرە (TTF, OTF, WOFF, WOFF2)', 'error');
            event.target.value = '';
            return;
        }
        
        // پیشاندانی زانیاری فایل
        document.getElementById('selectedFileInfo').classList.remove('hidden');
        document.getElementById('fileName').textContent = file.name;
        document.getElementById('fileSize').textContent = formatFileSize(file.size);
        
        // دروستکردنی ناوی فۆنت لە ناوی فایل
        const fontName = file.name
            .replace(/\.[^/.]+$/, "")
            .replace(/[-_]/g, ' ')
            .replace(/\s+/g, ' ')
            .trim();
        
        document.getElementById('fontName').value = fontName;
        
        // دروستکردنی کۆدی فۆنت
        const fontCode = fontName
            .toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '-');
        
        document.getElementById('fontCode').value = fontCode;
        
        showNotification('فایل بە سەرکەوتوویی هەڵبژێردرا', 'success');
    }
    
    // سڕینەوەی فایل
    function removeSelectedFile() {
        document.getElementById('fontFile').value = '';
        document.getElementById('selectedFileInfo').classList.add('hidden');
    }
    
    // فۆرمەت‌بەندی قەبارەی فایل
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 بایت';
        const k = 1024;
        const sizes = ['بایت', 'کیلۆبایت', 'مێگابایت'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }
    
    // ڕێستکردنی فۆرم
    function resetForm() {
        document.getElementById('addFontForm').reset();
        document.getElementById('selectedFileInfo').classList.add('hidden');
    }
    
    // پیشاندانی نوتیفیکەیشن
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 left-1/2 transform -translate-x-1/2 px-6 py-3 rounded-xl text-sm font-light shadow-lg backdrop-blur-sm z-50 transition-all duration-500 ${
            type === 'success' 
                ? 'bg-green-50/90 border border-green-200 text-green-700' 
                : 'bg-red-50/90 border border-red-200 text-red-700'
        }`;
        notification.textContent = message;
        notification.style.animation = 'slideDown 0.3s ease-out';
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translate(-50%, -20px)';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }
    
    // داخستنی مۆدال بە کلیک لە دەرەوە
    document.getElementById('fontModal').addEventListener('click', (e) => {
        if (e.target.id === 'fontModal') {
            closeFontModal();
        }
    });
    
    // داخستنی مۆدال بە کلیلی Esc
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !document.getElementById('fontModal').classList.contains('hidden')) {
            closeFontModal();
        }
    });
    
    // دراگ و درۆپ
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fontFileInput = document.getElementById('fontFile');
    
    fileUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileUploadArea.classList.add('border-gray-300', 'bg-gray-50/50');
    });
    
    fileUploadArea.addEventListener('dragleave', (e) => {
        e.preventDefault();
        fileUploadArea.classList.remove('border-gray-300', 'bg-gray-50/50');
    });
    
    fileUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        fileUploadArea.classList.remove('border-gray-300', 'bg-gray-50/50');
        
        if (e.dataTransfer.files.length) {
            fontFileInput.files = e.dataTransfer.files;
            handleFileSelect({ target: fontFileInput });
        }
    });
    
    // ناردنی فۆرم
    document.getElementById('addFontForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // پشکنینی بوونی فایل
        if (!document.getElementById('fontFile').files.length) {
            showNotification('تکایە فایلێکی فۆنت هەڵبژێرە', 'error');
            return;
        }
        
        const formData = new FormData(this);
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        
        // خستنەخولی لۆدینگ
        submitBtn.innerHTML = `
            <span>بەردەوام... </span>
            <svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        `;
        submitBtn.disabled = true;
        
        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            const result = await response.json();
            
            if (response.ok) {
                showNotification('✅ فۆنت بە سەرکەوتوویی زیادکرا!');
                closeFontModal();
                
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                let errorMsg = result.message || 'هەڵەیەک ڕوویدا';
                if (result.errors) {
                    errorMsg = Object.values(result.errors)[0][0];
                }
                showNotification('❌ ' + errorMsg, 'error');
            }
        } catch (error) {
            showNotification('❌ هەڵە لە پەیوەندی بە سێرڤەر', 'error');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
</script>

<!-- ستایلەکان -->
<style>
    /* ئەنیمەیشنی مۆدال */
    #fontModal {
        animation: fadeIn 0.5s ease-out;
    }
    
    #modalContent {
        animation: slideUp 0.5s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translate(-50%, -30px);
        }
        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }
    
    /* ستایلی فیلدەکان */
    input:focus {
        box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.1);
    }
    
    /* ستایلی بۆتنی لۆدینگ */
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>