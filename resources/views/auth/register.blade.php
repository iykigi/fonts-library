@extends('layouts.guest')

@section('title', 'renus - register')

@section('lore')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .animate-fadeIn {
        animation: fadeIn 0.5s ease-out;
    }

    .animate-slideIn {
        animation: slideIn 0.5s ease-out;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    .alert-animation {
        animation: fadeIn 0.3s ease-out;
    }

    .btn-primary {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-primary::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-primary:active::after {
        width: 300px;
        height: 300px;
    }

    .input-focus:focus {
        box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.1);
    }

    /* Password strength indicator */
    .password-strength {
        height: 4px;
        transition: all 0.3s ease;
        border-radius: 9999px;
    }

    .strength-0 {
        width: 0%;
        background: linear-gradient(to right, #ef4444, #f97316);
    }

    .strength-1 {
        width: 25%;
        background: linear-gradient(to right, #f97316, #eab308);
    }

    .strength-2 {
        width: 50%;
        background: linear-gradient(to right, #eab308, #84cc16);
    }

    .strength-3 {
        width: 75%;
        background: linear-gradient(to right, #84cc16, #22c55e);
    }

    .strength-4 {
        width: 100%;
        background: linear-gradient(to right, #22c55e, #16a34a);
    }

    /* Tooltip */
    .tooltip {
        position: relative;
        display: inline-block;
    }

    .tooltip .tooltip-text {
        visibility: hidden;
        width: 220px;
        background-color: #1f2937;
        color: #f3f4f6;
        text-align: center;
        border-radius: 12px;
        padding: 10px;
        position: absolute;
        z-index: 10;
        bottom: 150%;
        right: 50%;
        transform: translateX(50%);
        opacity: 0;
        transition: opacity 0.3s;
        font-size: 12px;
        font-weight: 300;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .tooltip:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
    }

    .tooltip .tooltip-text::after {
        content: "";
        position: absolute;
        top: 100%;
        right: 50%;
        margin-right: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #1f2937 transparent transparent transparent;
    }

    /* Custom checkbox */
    .checkbox-custom {
        appearance: none;
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        background: white;
        cursor: pointer;
        position: relative;
        transition: all 0.2s ease;
    }

    .checkbox-custom:checked {
        background: #111827;
        border-color: #111827;
    }

    .checkbox-custom:checked::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 6px;
        width: 6px;
        height: 12px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .checkbox-custom:hover {
        border-color: #9ca3af;
    }

    .checkbox-custom:focus {
        outline: none;
        ring: 2px solid #9ca3af;
    }
</style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-gray-50/50 to-white">
    
    <!-- گرافیکی ڕازاوە -->
    <div class="fixed top-0 right-0 w-96 h-96 bg-gradient-to-br from-gray-200/20 to-transparent rounded-full blur-3xl -z-10 animate-float"></div>
    <div class="fixed bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-gray-200/10 to-transparent rounded-full blur-3xl -z-10 animate-float" style="animation-delay: 2s;"></div>
    <div class="fixed top-1/2 left-1/4 w-64 h-64 bg-gradient-to-tr from-gray-100/20 to-transparent rounded-full blur-3xl -z-10"></div>

    <div class="relative z-10 w-full max-w-md animate-fadeIn">
        
        <!-- Validation Errors -->
        @if ($errors->any())
        <div id="validation-alert"
            class="mb-6 p-4 rounded-2xl bg-red-50/80 backdrop-blur-sm border border-red-200/80 text-red-700 flex items-start alert-animation shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 ml-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            <div class="flex-1">
                <p class="text-sm font-light mb-1">تکایە ئەم هەڵانە چاک بکەرەوە:</p>
                <ul class="text-sm font-light list-disc mr-4 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button onclick="closeValidationAlert()" class="text-red-400 hover:text-red-600 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        @endif

        <!-- Register Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl overflow-hidden border border-gray-200/80 hover:shadow-gray-200/50 hover:shadow-2xl transition-all duration-500">
            
            <!-- Card Header -->
            <div class="px-8 pt-8 pb-6 border-b border-gray-100/80 bg-gradient-to-br from-white to-gray-50/50">
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center rounded-2xl shadow-sm mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-light text-gray-900">دروستکردنی هەژمار</h1>
                    <div class="flex justify-center gap-1 mt-2 mb-2">
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    </div>
                    <p class="text-gray-400 text-sm font-light">هەژمارێکی نوێ دروست بکە بۆ دەستپێکردن</p>
                </div>
            </div>

            <!-- Card Body -->
            <div class="px-8 pt-6 pb-8">
                <form method="POST" action="{{ route('register') }}" id="registerForm" class="space-y-5">
                    @csrf

                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            ناو
                        </label>
                        <div class="relative group">
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus
                                   autocomplete="name"
                                   class="w-full pr-4 pl-11 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                          focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                          transition-all duration-300 placeholder:text-gray-300 font-light
                                          group-hover:border-gray-300"
                                   placeholder="ناوی تەواو">
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            ئیمەیڵ
                        </label>
                        <div class="relative group">
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required
                                   autocomplete="username"
                                   class="w-full pr-4 pl-11 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                          focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                          transition-all duration-300 placeholder:text-gray-300 font-light
                                          group-hover:border-gray-300"
                                   placeholder="example@domain.com">
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            وشەی نهێنی
                            <div class="tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                                <span class="tooltip-text">
                                    وشەی نهێنی دەبێت کەم نەبێت لە ٨ پیت<br>
                                    پیتی گەورە، پیتی بچووک، ژمارە و<br>
                                    نیشانەی تایبەتی تێدابێت
                                </span>
                            </div>
                        </label>
                        <div class="relative group">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
                                   class="w-full pr-11 pl-11 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                          focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                          transition-all duration-300 placeholder:text-gray-300 font-light
                                          group-hover:border-gray-300"
                                   placeholder="••••••••"
                                   oninput="checkPasswordStrength()">
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            <button type="button" 
                                    onclick="togglePasswordVisibility('password')" 
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="passwordToggleIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="mt-3">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs text-gray-400 font-light" id="strengthText">بەهێزی وشەی نهێنی</span>
                                <span class="text-xs text-gray-400 font-light" id="strengthPercentage">0%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                <div id="passwordStrength" class="password-strength strength-0"></div>
                            </div>
                        </div>

                        <!-- Password Requirements -->
                        <div class="mt-3 grid grid-cols-2 gap-2">
                            <div class="flex items-center gap-1">
                                <span id="lengthCheck" class="text-red-400 text-xs">✕</span>
                                <span class="text-xs text-gray-400 font-light">کەم نەبێت لە ٨ پیت</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span id="uppercaseCheck" class="text-red-400 text-xs">✕</span>
                                <span class="text-xs text-gray-400 font-light">پیتی گەورە</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span id="lowercaseCheck" class="text-red-400 text-xs">✕</span>
                                <span class="text-xs text-gray-400 font-light">پیتی بچووک</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span id="numberCheck" class="text-red-400 text-xs">✕</span>
                                <span class="text-xs text-gray-400 font-light">ژمارە</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span id="specialCheck" class="text-red-400 text-xs">✕</span>
                                <span class="text-xs text-gray-400 font-light">نیشانەی تایبەتی</span>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            دووبارەکردنەوەی وشەی نهێنی
                        </label>
                        <div class="relative group">
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required
                                   autocomplete="new-password"
                                   class="w-full pr-11 pl-11 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                          focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                          transition-all duration-300 placeholder:text-gray-300 font-light
                                          group-hover:border-gray-300"
                                   placeholder="••••••••"
                                   oninput="checkPasswordMatch()">
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            <button type="button" 
                                    onclick="togglePasswordVisibility('password_confirmation')" 
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="confirmToggleIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Password Match Indicators -->
                        <div id="passwordMatch" class="hidden mt-1 text-xs text-green-500 font-light flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>وشەی نهێنیەکان یەکسانن</span>
                        </div>
                        <div id="passwordMismatch" class="hidden mt-1 text-xs text-red-400 font-light flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span>وشەی نهێنیەکان یەکسان نییە</span>
                        </div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="pt-2">
                        <div class="flex items-start gap-3">
                            <div class="relative flex items-center">
                                <input type="checkbox" 
                                       id="terms" 
                                       name="terms" 
                                       class="checkbox-custom"
                                       required />
                            </div>
                            <label for="terms" class="text-sm text-gray-400 font-light cursor-pointer select-none">
                                من ڕێنماییەکانی
                                <a href="#" class="text-gray-600 hover:text-gray-900 font-light transition-colors duration-300 border-b border-gray-300 hover:border-gray-600">مامەڵەکردن</a>
                                و
                                <a href="#" class="text-gray-600 hover:text-gray-900 font-light transition-colors duration-300 border-b border-gray-300 hover:border-gray-600">نهێنیایی</a>
                                قبوڵ دەکەم
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="btn-primary w-full bg-gray-900 hover:bg-gray-800 text-white font-light py-3.5 px-4 rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 flex items-center justify-center gap-2 group mt-6"
                        id="submitBtn">
                        <span>دروستکردنی هەژمار</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-6 pt-6 border-t border-gray-100/80 text-center">
                    <p class="text-gray-400 text-sm font-light">
                        هەژمارت هەیە؟
                        <a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-gray-900 font-light transition-colors duration-300 border-b border-gray-300 hover:border-gray-600 pb-0.5">
                            چوونەژوورەوە
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <div class="flex justify-center gap-1">
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            </div>
            <p class="text-xs text-gray-400 font-light mt-2">Renus • © 2026 All rights reserved</p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePasswordVisibility(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const isPassword = passwordInput.type === 'password';
            
            passwordInput.type = isPassword ? 'text' : 'password';
            
            // Update icon
            const iconId = fieldId === 'password' ? 'passwordToggleIcon' : 'confirmToggleIcon';
            const icon = document.getElementById(iconId);
            
            if (isPassword) {
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21" />
                `;
            } else {
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                `;
            }
        }

        // Check password strength
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('strengthText');
            const strengthPercentage = document.getElementById('strengthPercentage');

            // Requirements
            const hasMinLength = password.length >= 8;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumbers = /\d/.test(password);
            const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

            // Update requirement icons
            document.getElementById('lengthCheck').className = hasMinLength ? 'text-green-500 text-xs' : 'text-red-400 text-xs';
            document.getElementById('uppercaseCheck').className = hasUpperCase ? 'text-green-500 text-xs' : 'text-red-400 text-xs';
            document.getElementById('lowercaseCheck').className = hasLowerCase ? 'text-green-500 text-xs' : 'text-red-400 text-xs';
            document.getElementById('numberCheck').className = hasNumbers ? 'text-green-500 text-xs' : 'text-red-400 text-xs';
            document.getElementById('specialCheck').className = hasSpecialChar ? 'text-green-500 text-xs' : 'text-red-400 text-xs';

            // Calculate strength (0-4)
            let strength = 0;
            if (hasMinLength) strength++;
            if (hasUpperCase) strength++;
            if (hasLowerCase) strength++;
            if (hasNumbers) strength++;
            if (hasSpecialChar) strength++;

            // Update strength bar
            const strengthClasses = ['strength-0', 'strength-1', 'strength-2', 'strength-3', 'strength-4'];
            const strengthTexts = ['زۆر لاواز', 'لاواز', 'مامناوەند', 'بەهێز', 'زۆر بەهێز'];
            const percentages = ['0%', '25%', '50%', '75%', '100%'];

            strengthBar.className = `password-strength ${strengthClasses[strength]}`;
            strengthText.textContent = `بەهێزی: ${strengthTexts[strength]}`;
            strengthPercentage.textContent = percentages[strength];

            checkPasswordMatch();
        }

        // Check if passwords match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchDiv = document.getElementById('passwordMatch');
            const mismatchDiv = document.getElementById('passwordMismatch');

            if (confirmPassword === '') {
                matchDiv.classList.add('hidden');
                mismatchDiv.classList.add('hidden');
                return;
            }

            if (password === confirmPassword) {
                matchDiv.classList.remove('hidden');
                mismatchDiv.classList.add('hidden');
            } else {
                matchDiv.classList.add('hidden');
                mismatchDiv.classList.remove('hidden');
            }
        }

        // Close validation alert
        function closeValidationAlert() {
            const alert = document.getElementById('validation-alert');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }
        }

        // Form submission
        document.addEventListener('DOMContentLoaded', function () {
            // Auto-hide validation alert
            const validationAlert = document.getElementById('validation-alert');
            if (validationAlert) {
                setTimeout(() => {
                    closeValidationAlert();
                }, 5000);
            }

            // Form validation
            const registerForm = document.getElementById('registerForm');
            if (registerForm) {
                registerForm.addEventListener('submit', function (e) {
                    const password = document.getElementById('password').value;
                    const confirmPassword = document.getElementById('password_confirmation').value;
                    const terms = document.getElementById('terms').checked;

                    if (password !== confirmPassword) {
                        e.preventDefault();
                        alert('تکایە دڵنیابە لە یەکسانی وشەی نهێنیەکان');
                        return;
                    }

                    if (!terms) {
                        e.preventDefault();
                        alert('تکایە ڕێنماییەکانی مامەڵەکردن و نهێنیایی قبوڵ بکە');
                        return;
                    }

                    if (password.length < 8) {
                        e.preventDefault();
                        alert('وشەی نهێنی دەبێت کەم نەبێت لە ٨ پیت');
                        return;
                    }

                    // Show loading state
                    const submitBtn = document.getElementById('submitBtn');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                            <span>دروستکردن...</span>
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        `;
                    }
                });
            }

            // Initialize password strength check
            checkPasswordStrength();
        });

        // CSRF token for AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (csrfToken && typeof axios !== 'undefined') {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        }
    </script>
@endsection