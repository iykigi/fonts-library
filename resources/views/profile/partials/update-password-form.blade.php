<section class="w-full max-w-lg bg-white/80 backdrop-blur-xl border border-gray-200/80 rounded-3xl p-8 space-y-6 hover:shadow-gray-200/50 hover:shadow-xl transition-all duration-500">

    <!-- Header -->
    <header class="flex items-start gap-4">
        <div class="bg-gradient-to-br from-gray-100 to-gray-50 p-3 rounded-2xl shadow-sm">
            <!-- lock icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
        </div>

        <div>
            <h2 class="text-2xl font-light text-gray-900">
                {{ __('Update Password') }}
            </h2>
            <p class="mt-1 text-sm text-gray-400 font-light">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </div>
    </header>

    <!-- Form -->
    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div class="space-y-2">
            <label class="block text-sm font-light text-gray-500 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.066-1.544.45l-1.883 1.883a.75.75 0 0 1-1.06 0l-1.883-1.883c-.385-.384-.98-.547-1.544-.45A6 6 0 0 1 2.25 8.25m3 0a3 3 0 0 1 3-3m3 0a3 3 0 0 1 3 3" />
                </svg>
                {{ __('Current Password') }}
            </label>
            
            <div class="relative group">
                <input
                    type="password"
                    name="current_password"
                    required
                    class="w-full rounded-xl bg-white/50 border border-gray-200/80 px-4 py-3
                           focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                           transition-all duration-300 placeholder:text-gray-300 font-light
                           group-hover:border-gray-300"
                    placeholder="پاسوۆردی ئێستا">
            </div>
            
            @error('current_password')
                <p class="text-sm text-red-400 font-light mt-1 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- New Password -->
        <div class="space-y-2">
            <label class="block text-sm font-light text-gray-500 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Z" />
                </svg>
                {{ __('New Password') }}
            </label>
            
            <div class="relative group">
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full rounded-xl bg-white/50 border border-gray-200/80 px-4 py-3
                           focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                           transition-all duration-300 placeholder:text-gray-300 font-light
                           group-hover:border-gray-300"
                    placeholder="پاسوۆردی نوێ">
            </div>
            
            @error('password')
                <p class="text-sm text-red-400 font-light mt-1 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <label class="block text-sm font-light text-gray-500 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ __('Confirm Password') }}
            </label>
            
            <div class="relative group">
                <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full rounded-xl bg-white/50 border border-gray-200/80 px-4 py-3
                           focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                           transition-all duration-300 placeholder:text-gray-300 font-light
                           group-hover:border-gray-300"
                    placeholder="پاسوۆردی نوێ دووبارە بکەوە">
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-4 pt-4 border-t border-gray-100/50">
            <button
                type="submit"
                class="group inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800
                       text-white px-6 py-3 rounded-xl transition-all duration-300 
                       hover:-translate-y-0.5 shadow-md hover:shadow-xl font-light"
            >
                <span>{{ __('Save') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </button>

            <!-- Laravel Breeze Success Message -->
            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="text-sm text-green-600 font-light flex items-center gap-2 bg-green-50/80 border border-green-200/80 px-4 py-2 rounded-xl"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('پاسوۆردەکەت بە سەرکەوتوویی گۆڕدرا') }}
                </div>
            @endif
        </div>
    </form>
    
    <!-- گرافیکی بچووک -->
    <div class="flex justify-center gap-1 pt-2">
        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
        <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
    </div>
</section>

<!-- Alpine.js for animations (Laravel Breeze already includes Alpine.js) -->
<script>
    // This is just for the custom notification, but Breeze uses Alpine.js for the success message above
    document.addEventListener('DOMContentLoaded', function() {
        // If you want to add a custom toast notification, you can uncomment this:
        /*
        @if(session('status') === 'password-updated')
            // Custom toast code here
        @endif
        */
    });
</script>

<style>
    /* ستایلی بۆ ئینپووتەکان */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0px 1000px rgba(255, 255, 255, 0.5) inset;
        transition: background-color 5000s ease-in-out 0s;
    }
</style>