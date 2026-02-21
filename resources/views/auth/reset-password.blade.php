@extends('layouts.guest')

@section('title', 'renus - reset password')

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

    /* Password strength meter */
    .password-strength-meter {
        height: 4px;
        border-radius: 9999px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .strength-bar {
        height: 100%;
        border-radius: 9999px;
        transition: all 0.3s ease;
    }

    /* Tooltip */
    .tooltip {
        position: relative;
        display: inline-block;
    }

    .tooltip .tooltip-text {
        visibility: hidden;
        width: 200px;
        background-color: #1f2937;
        color: #f3f4f6;
        text-align: center;
        border-radius: 12px;
        padding: 8px;
        position: absolute;
        z-index: 10;
        bottom: 150%;
        left: 50%;
        transform: translateX(-50%);
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
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #1f2937 transparent transparent transparent;
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
            <div id="validation-alert" class="mb-6 p-4 rounded-2xl bg-red-50/80 backdrop-blur-sm border border-red-200/80 text-red-700 flex items-start alert-animation shadow-sm">
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

        <!-- Session Status -->
        @if (session('status'))
            <div id="session-alert" class="mb-6 p-4 rounded-2xl bg-green-50/80 backdrop-blur-sm border border-green-200/80 text-green-700 flex items-start alert-animation shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 ml-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-1 text-sm font-light">
                    {{ session('status') }}
                </div>
                <button onclick="closeSessionAlert()" class="text-green-400 hover:text-green-600 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Reset Password Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl overflow-hidden border border-gray-200/80 hover:shadow-2xl transition-all duration-500">

            <!-- Card Header -->
            <div class="px-8 pt-8 pb-6 border-b border-gray-100/80 bg-gradient-to-br from-white to-gray-50/50">
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center rounded-2xl shadow-sm mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.066-1.544.45l-1.883 1.883a.75.75 0 01-1.06 0l-1.883-1.883c-.385-.384-.98-.547-1.544-.45A6 6 0 012.25 8.25m3 0a3 3 0 013-3m3 0a3 3 0 013 3" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-light text-gray-900">گۆڕینی وشەی نهێنی</h1>
                    <div class="flex justify-center gap-1 mt-2 mb-2">
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    </div>
                    <p class="text-gray-400 text-sm font-light">وشەی نهێنی نوێ بنووسە بۆ هەژمارەکەت</p>
                </div>
            </div>

            <!-- Card Body -->
            <div class="px-8 pt-6 pb-8">
                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            ئیمەیڵ
                        </label>
                        <div class="relative group">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $request->email) }}"
                                required 
                                autofocus 
                                autocomplete="username"
                                class="w-full pr-4 pl-11 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                       focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                       transition-all duration-300 placeholder:text-gray-300 font-light
                                       group-hover:border-gray-300"
                                placeholder="example@domain.com"
                            >
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-sm text-red-400 font-light mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            وشەی نهێنی نوێ
                            <div class="tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                                <span class="tooltip-text">
                                    وشەی نهێنی دەبێت کەم نەبێت لە ٨ پیت<br>
                                    پیتی گەورە، پیتی بچووک، ژمارە<br>
                                    و نیشانەی تایبەتی تێدابێت
                                </span>
                            </div>
                        </label>
                        <div class="relative group">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                autocomplete="new-password"
                                class="w-full pr-11 pl-11 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                       focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                       transition-all duration-300 placeholder:text-gray-300 font-light
                                       group-hover:border-gray-300"
                                placeholder="••••••••"
                                oninput="checkPasswordStrength(this.value)"
                            >
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            <button 
                                type="button" 
                                id="togglePassword" 
                                class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-300"
                                onclick="togglePasswordVisibility('password')"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="passwordToggleIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Password Strength Meter -->
                        <div class="mt-3">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs text-gray-400 font-light">بەهێزی وشەی نهێنی:</span>
                                <span id="password-strength-text" class="text-xs font-light"></span>
                            </div>
                            <div class="password-strength-meter bg-gray-200 w-full">
                                <div id="password-strength-bar" class="strength-bar" style="width: 0%;"></div>
                            </div>
                        </div>

                        <!-- Password Requirements -->
                        <div class="mt-3 grid grid-cols-2 gap-2">
                            <div class="flex items-center gap-1">
                                <span id="length-check" class="text-red-400 text-xs">✕</span>
                                <span class="text-xs text-gray-400 font-light">کەم نەبێت لە ٨ پیت</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span id="uppercase-check" class="text-red-400 text-xs">✕</span>
                                <span class="text-xs text-gray-400 font-light">پیتی گەورە</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span id="lowercase-check" class="text-red-400 text-xs">✕</span>
                                <span class="text-xs text-gray-400 font-light">پیتی بچووک</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span id="number-check" class="text-red-400 text-xs">✕</span>
                                <span class="text-xs text-gray-400 font-light">ژمارە</span>
                            </div>
                        </div>

                        @error('password')
                            <p class="text-sm text-red-400 font-light mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            دووبارەکردنەوەی وشەی نهێنی
                        </label>
                        <div class="relative group">
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                class="w-full pr-11 pl-11 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                       focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                       transition-all duration-300 placeholder:text-gray-300 font-light
                                       group-hover:border-gray-300"
                                placeholder="••••••••"
                                oninput="checkPasswordMatch()"
                            >
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            <button 
                                type="button" 
                                id="toggleConfirmPassword" 
                                class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-300"
                                onclick="togglePasswordVisibility('password_confirmation')"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="confirmToggleIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Password Match Indicator -->
                        <div id="password-match-indicator" class="hidden mt-1 text-xs flex items-center gap-1"></div>

                        @error('password_confirmation')
                            <p class="text-sm text-red-400 font-light mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="btn-primary w-full bg-gray-900 hover:bg-gray-800 text-white font-light py-3.5 px-4 rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 flex items-center justify-center gap-2 group mt-6"
                        id="submitBtn"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        <span>گۆڕینی وشەی نهێنی</span>
                    </button>
                </form>

                <!-- Back to Login -->
                <div class="text-center mt-6">
                    <a 
                        href="{{ route('login') }}" 
                        class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-gray-600 transition-colors duration-300 font-light group"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        <span>گەڕانەوە بۆ چوونەژوورەوە</span>
                    </a>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-100/80 text-center">
                <p class="text-gray-400 text-sm font-light flex items-center justify-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    وشەی نهێنیەکەت بە پارێزراوی هەڵبژێرە
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <div class="flex justify-center gap-1">
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            </div>
            <p class="text-xs text-gray-400 font-light mt-2">Renus • {{ date('Y') }} All rights reserved</p>
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
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');

            // Check requirements
            const hasMinLength = password.length >= 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasLowercase = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

            // Update requirement icons
            updateRequirementIcon('length-check', hasMinLength);
            updateRequirementIcon('uppercase-check', hasUppercase);
            updateRequirementIcon('lowercase-check', hasLowercase);
            updateRequirementIcon('number-check', hasNumber);

            // Calculate strength (0-4)
            let strength = 0;
            if (hasMinLength) strength++;
            if (hasUppercase) strength++;
            if (hasLowercase) strength++;
            if (hasNumber) strength++;

            // Update strength bar
            const percentages = ['0%', '25%', '50%', '75%', '100%'];
            const colors = ['bg-gray-300', 'bg-red-500', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500'];
            const texts = ['هیچ', 'زۆر لاواز', 'لاواز', 'بەهێز', 'زۆر بەهێز'];

            strengthBar.style.width = percentages[strength];
            strengthBar.className = `strength-bar ${colors[strength]}`;
            strengthText.textContent = texts[strength];
            strengthText.className = strength >= 4 ? 'text-xs font-light text-green-600' : 
                                   strength >= 3 ? 'text-xs font-light text-blue-600' : 
                                   strength >= 2 ? 'text-xs font-light text-yellow-600' : 
                                   'text-xs font-light text-gray-400';

            // Check password match
            checkPasswordMatch();
        }

        // Update requirement icon
        function updateRequirementIcon(elementId, isValid) {
            const icon = document.getElementById(elementId);
            if (icon) {
                icon.className = isValid ? 'text-green-500 text-xs' : 'text-red-400 text-xs';
                icon.textContent = isValid ? '✓' : '✕';
            }
        }

        // Check if passwords match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchIndicator = document.getElementById('password-match-indicator');

            if (confirmPassword === '') {
                matchIndicator.classList.add('hidden');
                return;
            }

            matchIndicator.classList.remove('hidden');
            
            if (password === confirmPassword) {
                matchIndicator.className = 'mt-1 text-xs flex items-center gap-1 text-green-500 font-light';
                matchIndicator.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>وشەی نهێنیەکان یەکسانن</span>
                `;
            } else {
                matchIndicator.className = 'mt-1 text-xs flex items-center gap-1 text-red-400 font-light';
                matchIndicator.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>وشەی نهێنیەکان یەکسان نین</span>
                `;
            }
        }

        // Close session alert
        function closeSessionAlert() {
            const alert = document.getElementById('session-alert');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
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

        // Auto-hide alerts
        document.addEventListener('DOMContentLoaded', function() {
            // Session alert
            const sessionAlert = document.getElementById('session-alert');
            if (sessionAlert) {
                setTimeout(() => {
                    closeSessionAlert();
                }, 5000);
            }

            // Validation alert
            const validationAlert = document.getElementById('validation-alert');
            if (validationAlert) {
                setTimeout(() => {
                    closeValidationAlert();
                }, 5000);
            }

            // Form submission
            const resetForm = document.querySelector('form');
            if (resetForm) {
                resetForm.addEventListener('submit', function(e) {
                    const password = document.getElementById('password').value;
                    const confirmPassword = document.getElementById('password_confirmation').value;

                    if (password !== confirmPassword) {
                        e.preventDefault();
                        alert('تکایە دڵنیابەرەوە لەوەی وشەی نهێنیەکان یەکسانن');
                        return;
                    }

                    if (password.length < 8) {
                        e.preventDefault();
                        alert('وشەی نهێنی دەبێت کەم نەبێت لە ٨ پیت');
                        return;
                    }

                    const submitBtn = document.getElementById('submitBtn');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>گۆڕین...</span>
                        `;
                    }
                });
            }

            // Initialize password strength check
            const passwordInput = document.getElementById('password');
            if (passwordInput && passwordInput.value) {
                checkPasswordStrength(passwordInput.value);
            }

            // Initialize password match check
            const confirmInput = document.getElementById('password_confirmation');
            if (confirmInput && confirmInput.value) {
                checkPasswordMatch();
            }
        });
    </script>
@endsection