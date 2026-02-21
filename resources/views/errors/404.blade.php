@extends('layout.nav')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50/50 to-white px-4 flex items-center justify-center">
    
    <!-- گرافیکی ڕازاوە -->
    <div class="fixed top-0 right-0 bg-gradient-to-br from-gray-200/20 to-transparent rounded-full blur-3xl -z-10"></div>
    <div class="fixed bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-gray-200/10 to-transparent rounded-full blur-3xl -z-10"></div>
    
    <div class=" mx-auto text-center">
        
        <!-- Main Card -->
        <div class="bg-white/80 backdrop-blur-xl transition-all duration-500 max-w-lg mx-auto">
            
            <!-- Icon -->
            <div class="flex justify-center mb-6">
                <div class="p-4 bg-gradient-to-br from-gray-100 to-gray-50 rounded-2xl shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
            </div>

            <!-- Title & Message -->
            <h3 class="text-3xl md:text-4xl font-light text-gray-900 mb-3">
                {{ __('هیچ داتایەک نییە') }}
            </h3>
            
            <div class="flex justify-center gap-1 mb-6">
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            </div>

            <p class="text-gray-400 font-light text-lg leading-relaxed">
                {{ __("هیچ داتایەک لێرە نییە، لەوانەیە پەڕیەکی هەڵەت هەڵبژاردبیت!") }}
            </p>
        </div>
    </div>
</div>

{{-- Styles --}}
<style>
    @keyframes glitch {
        0% {
            text-shadow: 0.05em 0 0 rgba(255, 0, 0, 0.75),
                        -0.05em -0.025em 0 rgba(0, 255, 0, 0.75),
                        0.025em 0.05em 0 rgba(0, 0, 255, 0.75);
        }
        14% {
            text-shadow: 0.05em 0 0 rgba(255, 0, 0, 0.75),
                        -0.05em -0.025em 0 rgba(0, 255, 0, 0.75),
                        0.025em 0.05em 0 rgba(0, 0, 255, 0.75);
        }
        15% {
            text-shadow: -0.05em -0.025em 0 rgba(255, 0, 0, 0.75),
                        0.025em 0.025em 0 rgba(0, 255, 0, 0.75),
                        -0.05em -0.05em 0 rgba(0, 0, 255, 0.75);
        }
        49% {
            text-shadow: -0.05em -0.025em 0 rgba(255, 0, 0, 0.75),
                        0.025em 0.025em 0 rgba(0, 255, 0, 0.75),
                        -0.05em -0.05em 0 rgba(0, 0, 255, 0.75);
        }
        50% {
            text-shadow: 0.025em 0.05em 0 rgba(255, 0, 0, 0.75),
                        0.05em 0 0 rgba(0, 255, 0, 0.75),
                        0 -0.05em 0 rgba(0, 0, 255, 0.75);
        }
        99% {
            text-shadow: 0.025em 0.05em 0 rgba(255, 0, 0, 0.75),
                        0.05em 0 0 rgba(0, 255, 0, 0.75),
                        0 -0.05em 0 rgba(0, 0, 255, 0.75);
        }
        100% {
            text-shadow: -0.025em 0 0 rgba(255, 0, 0, 0.75),
                        -0.025em -0.025em 0 rgba(0, 255, 0, 0.75),
                        -0.025em -0.05em 0 rgba(0, 0, 255, 0.75);
        }
    }

    .glitch-text {
        animation: glitch 2s infinite;
    }
</style>
@endsection