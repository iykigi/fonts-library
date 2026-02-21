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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-light text-gray-900 mb-2">{{ __('Confirm Password') }}</h1>
                <div class="flex justify-center gap-1 mb-3">
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                </div>
                <p class="text-sm text-gray-400 font-light max-w-sm mx-auto">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>
            </div>

            <!-- Main Card -->
            <div class="bg-white/80 backdrop-blur-xl border border-gray-200/80 rounded-3xl hover:shadow-gray-200/50 p-8 hover:shadow-2xl transition-all duration-500">
                
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            {{ __('Password') }}
                        </label>

                        <div class="relative group">
                            <input id="password" 
                                   type="password" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                          focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                          transition-all duration-300 placeholder:text-gray-300 font-light
                                          group-hover:border-gray-300"
                                   placeholder="••••••••">
                            
                            <button type="button" 
                                    onclick="togglePassword(this)" 
                                    class="absolute inset-y-0 left-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Error Message -->
                        @if ($errors->get('password'))
                            <div class="mt-2 p-3 bg-red-50/80 backdrop-blur-sm border border-red-200/80 rounded-xl">
                                <div class="flex items-center gap-2 text-sm text-red-500 font-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                    <span>{{ $errors->first('password') }}</span>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ __('Confirm') }}
                        </button>
                    </div>

                    <!-- Additional Links -->
                    <div class="text-center">
                        <a href="{{ route('password.request') }}" 
                           class="text-sm text-gray-400 hover:text-gray-600 transition-colors duration-300 font-light">
                            {{ __('Forgot your password?') }}
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
                    {{ __('Secure area • Please verify your identity') }}
                </p>
            </div>
        </div>
    </div>

    <!-- JavaScript for password toggle -->
    <script>
        function togglePassword(button) {
            const input = button.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            button.innerHTML = type === 'password' 
                ? `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>`
                : `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21" />
                    </svg>`;
        }
    </script>

    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0px 1000px rgba(255, 255, 255, 0.5) inset;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
@endsection