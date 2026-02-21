<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/web.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome for icons (optional but nice) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        body {
            background-color: #fafafa;
        }
        
        .poster {
            background: linear-gradient(135deg, #2e2e2f 0%, #202020 100%);
        }
        
        /* Smooth transitions */
        * {
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

    <!-- NAVBAR - Minimal & Elegant with Alpine.js -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100" 
            x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-row-reverse items-center justify-between h-16">
                <!-- Logo - Minimal -->
                <div class="flex flex-row-reverse items-center gap-2">
                    <span class="font-light text-xl tracking-tight text-gray-800">Renus</span>
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full"></div>
                </div>

                <!-- Desktop Nav - Clean & Spacious -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 relative group">
                        سەرەتا
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gray-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ url('fonts') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 relative group">
                        فۆنت
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gray-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ url('about') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 relative group">
                        دەربارە
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gray-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </nav>

                <!-- Mobile Menu Button - Minimal with Alpine -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="md:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-300">
                    <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                    <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Nav - Smooth Dropdown with Icons -->
        <div x-show="mobileMenuOpen" 
             @click.away="mobileMenuOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden border-t border-gray-100 bg-white/95 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 py-3 space-y-1">
                
                <!-- Home with icon -->
                <a href="{{ url('/') }}" @click="mobileMenuOpen = false" 
                   class="flex items-center gap-3 px-4 py-3 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>سەرەتا</span>
                </a>
                
                <!-- Fonts with icon -->
                <a href="{{ url('fonts') }}" @click="mobileMenuOpen = false" 
                   class="flex items-center gap-3 px-4 py-3 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" />
</svg>

                    <span>فۆنت</span>
                </a>
                
                <!-- About with icon -->
                <a href="{{ url('about') }}" @click="mobileMenuOpen = false" 
                   class="flex items-center gap-3 px-4 py-3 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>دەربارە</span>
                </a>
                
                <!-- Divider -->
                <div class="my-2 border-t border-gray-100"></div>
                
                <!-- Optional: User menu (if logged in) -->
                @auth
                <a href="{{ url('dashboard') }}" @click="mobileMenuOpen = false" 
                   class="flex items-center gap-3 px-4 py-3 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>{{ auth()->user()->name }}</span>
                </a>
                @else
                <a href="{{ url('login') }}" @click="mobileMenuOpen = false" 
                   class="flex items-center gap-3 px-4 py-3 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-all group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>چوونەژوورەوە</span>
                </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content Area with subtle animation -->
    <main class="min-h-screen animate-fadeIn">
        @yield('content')
    </main>

    <!-- Footer -->
    <div class="border-t border-gray-100 py-6">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center text-xs text-gray-400 font-light">
            <span>© 2024 فۆنتەکان</span>
            <div class="flex items-center gap-4">
                <a href="{{ url('about') }}">
                <span class="hover:text-gray-600 transition-colors cursor-pointer flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    دەربارە
                </span></a>
                <a href="mailto:info@renus.com?subject=پەیوەندی لە ڕێگەی فۆنتەوە" 
   class="hover:text-gray-600 transition-colors cursor-pointer flex items-center gap-1 group"
   title="ناردنی ئیمەیل">
    <svg class="w-3.5 h-3.5 group-hover:scale-110 transition-transform duration-200" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke="currentColor">
        <path stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="1.5" 
              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
    </svg>
    <span class="text-sm">پەیوەندی</span>
</a>
                <span class="flex items-center gap-1">
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                </span>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>

    <style>
        /* Custom animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        }

        /* Alpine.js hide until loaded */
        [x-cloak] { display: none !important; }
        
        /* Mobile menu item hover effect */
        .group:hover svg {
            transform: scale(1.1);
        }
    </style>

</body>
</html>