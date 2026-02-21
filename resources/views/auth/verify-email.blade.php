@extends('layouts.guest')

@section('title', 'renus - register')

@section('lore')
    <div class="min-h-screen bg-gradient-to-br from-gray-50/50 to-white py-8 px-4">
        
        <!-- گرافیکی ڕازاوە -->
        <div class="fixed top-0 right-0 w-96 h-96 bg-gradient-to-br from-gray-200/20 to-transparent rounded-full blur-3xl -z-10"></div>
        <div class="fixed bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-gray-200/10 to-transparent rounded-full blur-3xl -z-10"></div>
        <div class="fixed top-1/2 left-1/4 w-64 h-64 bg-gradient-to-tr from-gray-100/20 to-transparent rounded-full blur-3xl -z-10"></div>

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
                <h1 class="text-3xl font-light text-gray-900 mb-2">{{ __('Verify Your Email') }}</h1>
                <div class="flex justify-center gap-1 mb-3">
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                </div>
            </div>

            <!-- Main Card -->
            <div class="bg-white/80 backdrop-blur-xl border border-gray-200/80 rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-all duration-500">
                
                <!-- Info Message -->
                <div class="mb-6 p-4 bg-blue-50/80 backdrop-blur-sm border border-blue-200/80 rounded-xl">
                    <div class="flex items-start gap-3">
                        <div class="p-1.5 bg-blue-100/80 rounded-lg flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500 font-light leading-relaxed">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </p>
                    </div>
                </div>

                <!-- Verification Link Sent Status -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-green-50/80 backdrop-blur-sm border border-green-200/80 rounded-xl animate-fadeIn">
                        <div class="flex items-center gap-3">
                            <div class="p-1.5 bg-green-100/80 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-sm text-green-600 font-light">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-gray-100/80">
                    
                    <!-- Resend Verification Form -->
                    <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                                class="group w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800
                                       text-white px-6 py-3 rounded-xl transition-all duration-300 
                                       hover:-translate-y-0.5 shadow-md hover:shadow-xl font-light">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            <span>{{ __('Resend Verification Email') }}</span>
                        </button>
                    </form>

                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" 
                                class="group w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 
                                       text-gray-400 hover:text-gray-600 transition-all duration-300 font-light
                                       border border-gray-200/80 bg-white/50 backdrop-blur-sm rounded-xl
                                       hover:border-gray-300 hover:bg-gray-100/50 hover:-translate-y-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            <span>{{ __('Log Out') }}</span>
                        </button>
                    </form>
                </div>

                <!-- Help Text -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-gray-400 font-light">
                        {{ __('Please check your spam folder if you don\'t see the email in your inbox.') }}
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
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
@endsection