<section x-data="{ saved: false, showVerificationDropdown: false }" class="bg-white/80 backdrop-blur-xl border border-gray-200/80 p-8 rounded-3xl w-full max-w-lg space-y-6 hover:shadow-gray-200/50 hover:shadow-xl transition-all duration-500 relative">
    
    {{-- Header with Verification Badge --}}
    <div class="flex items-center gap-4 mb-8">
        <div class="bg-gradient-to-br from-gray-100 to-gray-50 p-3 text-gray-500 rounded-2xl shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
        </div>

        <div class="flex-1">
            <h2 class="text-2xl font-light text-gray-900">
                {{ __('Profile Information') }}
            </h2>
            <div class="flex flex-wrap items-center gap-2 mt-1">
                <p class="text-sm text-gray-400 font-light">
                    {{ __("Update your name and email address") }}
                </p>
                
                {{-- Email Verification Status Badge --}}
                @php
                    $user = auth()->user();
                    $isVerified = $user->hasVerifiedEmail();
                @endphp
                
                <div class="flex items-center gap-1.5 px-2 py-1 rounded-lg text-xs font-light
                    {{ $isVerified ? 'bg-green-50/80 text-green-600 border border-green-200/80' : 'bg-red-50/80 text-red-600 border border-red-200/80' }}">
                    
                    @if($isVerified)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ __('سەلمیندراو') }}</span>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        <span>{{ __('نەسەلمیندراو') }}</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Advanced Verification Dropdown Button --}}
        @if(!$isVerified && auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
        <div class="relative">
            <button @click="showVerificationDropdown = !showVerificationDropdown" 
                    class="group flex items-center gap-2 bg-amber-50 hover:bg-amber-100 border border-amber-200 
                           text-amber-700 px-4 py-2 rounded-xl transition-all duration-300 
                           hover:-translate-y-0.5 shadow-sm hover:shadow-md font-light text-sm
                           focus:ring-2 focus:ring-amber-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="size-4 group-hover:rotate-12 transition-transform duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.57 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <span>{{ __('سەلماندن') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
                     class="size-4 transition-transform duration-300" 
                     :class="{ 'rotate-180': showVerificationDropdown }">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

            {{-- Advanced Verification Dropdown --}}
            <div x-show="showVerificationDropdown" 
                 @click.away="showVerificationDropdown = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="absolute right-0 mt-2 w-80 z-50">
                
                {{-- Send Verification Form --}}
                <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                </form>
                
                <div class="bg-white/90 backdrop-blur-xl border border-amber-200/80 rounded-2xl shadow-xl p-5 space-y-4">
                    {{-- Header --}}
                    <div class="flex items-center gap-3">
                        <div class="bg-amber-100 p-2 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">{{ __('سەلماندنی ئیمەیڵ') }}</h3>
                            <p class="text-xs text-gray-500 font-light">{{ __('ئیمەیڵەکەت نەسەلمێنراوە') }}</p>
                        </div>
                    </div>

                    {{-- Email Info --}}
                    <div class="bg-gray-50/80 rounded-xl p-3 border border-gray-100">
                        <div class="flex items-center gap-2 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.57 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <span class="font-light text-gray-600">{{ auth()->user()->email }}</span>
                        </div>
                    </div>

                    {{-- Send Button --}}
                    <button type="submit" form="send-verification"
                            class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 
                                   hover:from-amber-600 hover:to-amber-700 text-white px-4 py-3 rounded-xl 
                                   transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-xl 
                                   font-light text-sm group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" 
                             class="size-4 group-hover:translate-x-1 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        {{ __('ناردنی ئیمەیڵی سەلماندن') }}
                    </button>

                    {{-- Footer Note --}}
                    <p class="text-xs text-center text-gray-400 font-light">
                        {{ __('پەیامێکت وەرنەگرت؟ دووبارە هەوڵبدەرەوە') }}
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Main Form --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Name Field --}}
        <div class="space-y-2">
            <label for="name" class="text-sm font-light text-gray-500 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                {{ __('Name') }}
            </label>

            <div class="relative group">
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required 
                       class="w-full rounded-xl bg-white/50 border border-gray-200/80 pl-11 pr-4 py-3
                              focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                              transition-all duration-300 placeholder:text-gray-300 font-light
                              group-hover:border-gray-300">

                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400 group-hover:text-gray-600 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </span>
            </div>

            @error('name')
            <p class="text-sm text-red-400 font-light mt-1 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        {{-- Email Field with Verification Status --}}
        <div class="space-y-2">
            <label for="email" class="text-sm font-light text-gray-500 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                </svg>
                {{ __('Email') }}
            </label>

            <div class="space-y-3">
                <div class="relative group">
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required 
                           class="w-full rounded-xl bg-white/50 border border-gray-200/80 pl-11 pr-4 py-3
                                  focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                  transition-all duration-300 placeholder:text-gray-300 font-light
                                  group-hover:border-gray-300">

                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400 group-hover:text-gray-600 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                        </svg>
                    </span>
                </div>

                {{-- Simple Status Badge inside Email Field (without button) --}}
                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
                    @if(auth()->user()->hasVerifiedEmail())
                        <div class="flex items-center gap-2 rounded-xl bg-green-50/80 border border-green-200/80 px-4 py-2 text-sm backdrop-blur-sm w-fit">
                            <span class="font-light flex items-center gap-1.5 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ __('ئیمەیڵ سەلمیندراوە') }}</span>
                            </span>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-4 pt-6 border-t border-gray-100/50">
            <button type="submit" 
                    class="group inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800
                           text-white px-6 py-3 rounded-xl transition-all duration-300 
                           hover:-translate-y-0.5 shadow-md hover:shadow-xl font-light">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5 group-hover:rotate-12 transition-transform duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
            <span x-data="{ show: true }" 
                  x-init="setTimeout(() => show = false, 2000)" 
                  x-show="show" 
                  x-transition:enter="transition ease-out duration-300"
                  x-transition:enter-start="opacity-0 translate-y-2"
                  x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease-in duration-200"
                  x-transition:leave-start="opacity-100 translate-y-0"
                  x-transition:leave-end="opacity-0 translate-y-2"
                  class="text-sm text-gray-400 font-light flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ __('Saved.') }}
            </span>
            @endif
        </div>
    </form>
    
    {{-- Decorative Dots --}}
    <div class="flex justify-center gap-1 pt-2">
        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
        <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
    </div>
</section>

{{-- Styles --}}
<style>
    [x-cloak] { display: none !important; }
</style>