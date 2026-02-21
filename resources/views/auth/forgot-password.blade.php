@extends('layouts.guest')

@section('title', 'renus')

@section('lore')
    <div class="min-h-screen bg-gradient-to-br from-gray-50/50 to-white py-8 px-4">
        
        <!-- گرافیکی ڕازاوە -->
        <div class="fixed top-0 right-0 w-96 h-96 bg-gradient-to-br from-gray-200/20 to-transparent rounded-full blur-3xl -z-10"></div>
        <div class="fixed bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-gray-200/10 to-transparent rounded-full blur-3xl -z-10"></div>

        <div class="max-w-md mx-auto">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="p-3 bg-gradient-to-br from-gray-100 to-gray-50 rounded-2xl shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-light text-gray-900 mb-2">{{ __('Forgot Password?') }}</h1>
                <div class="flex justify-center gap-1 mb-3">
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                </div>
                <p class="text-sm text-gray-400 font-light leading-relaxed max-w-sm mx-auto">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>
            </div>

            <!-- Main Card -->
            <div class="bg-white/80 backdrop-blur-xl border border-gray-200/80 rounded-3xl hover:shadow-gray-200/50 p-8 hover:shadow-2xl transition-all duration-500">
                
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50/80 backdrop-blur-sm border border-green-200/80 rounded-xl">
                        <div class="flex items-center gap-2 text-sm text-green-600 font-light">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            {{ __('Email Address') }}
                        </label>

                        <div class="relative group">
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus
                                   class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                          focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                          transition-all duration-300 placeholder:text-gray-300 font-light
                                          group-hover:border-gray-300"
                                   placeholder="your@email.com">
                        </div>

                        <!-- Error Message -->
                        @if ($errors->get('email'))
                            <div class="mt-2 p-3 bg-red-50/80 backdrop-blur-sm border border-red-200/80 rounded-xl">
                                <div class="flex items-center gap-2 text-sm text-red-500 font-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                    <span>{{ $errors->first('email') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 border-t border-gray-100/50">
                        <button type="submit"
                                class="group w-full inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800
                                       text-white px-6 py-3 rounded-xl transition-all duration-300 
                                       hover:-translate-y-0.5 shadow-md hover:shadow-xl font-light">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <span>{{ __('Send Reset Link') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </div>

                    <!-- Back to Login Link -->
                    <div class="text-center">
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-gray-600 transition-colors duration-300 font-light group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            <span>{{ __('Back to Login') }}</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <div class="flex justify-center gap-1">
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                </div>
                <p class="text-xs text-gray-400 font-light mt-2">
                    {{ __('Password Recovery • We\'ll send you a reset link') }}
                </p>
            </div>
        </div>
    </div>

    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0px 1000px rgba(255, 255, 255, 0.5) inset;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
@endsection