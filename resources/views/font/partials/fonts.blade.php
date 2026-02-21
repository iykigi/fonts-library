@forelse($fonts as $fon)
<style>
@font-face {
    font-family: '{{ $fon->code }}';
    src: url('{{ asset('storage/' . $fon->file_path) }}');
    font-display: swap;
}
.font-{{ $fon->code }} {
    font-family: '{{ $fon->code }}', sans-serif !important;
}
</style>

<a href="{{ route('fonts.show', Crypt::encrypt($fon->id)) }}" class="block group">
    <div class="font-card bg-white/80 backdrop-blur-sm rounded-2xl hover:border-gray-300 hover:shadow-2xl hover:shadow-gray-200/50 p-6 cursor-pointer border border-gray-200/80 transition-all duration-500 hover:-translate-y-1 relative overflow-hidden">
        
        <!-- گرافیکی بۆ جوانکاری -->
        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-gray-100/50 to-transparent rounded-full blur-2xl -z-10 group-hover:scale-150 transition-transform duration-700"></div>
        <div class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-gray-100/30 to-transparent rounded-full blur-xl -z-10"></div>
        
        <div class="flex justify-between items-start mb-4 relative">
            <h3 class="font-light text-xl text-gray-900 group-hover:text-gray-700 transition-colors duration-300">{{ $fon->name }}</h3>
            <span class="text-gray-400 text-xs bg-white/80 backdrop-blur-sm border border-gray-200/80 rounded-lg px-3 py-1.5 font-light">
                #{{ $fon->code }}
            </span>
        </div>
        
        <p class="text-gray-600 font-{{ $fon->code }} bg-gray-100/40 backdrop-blur-sm rounded-xl p-4 text-sm text-center mb-4 leading-relaxed border border-gray-100 group-hover:border-gray-200/80 transition-all duration-300">
            {{ $fon->description }}
        </p>
        
        <div class="flex justify-between items-center text-xs text-gray-400 font-light">
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                {{ $fon->created_at->format('Y/m/d') }}
            </span>
            <span class="flex items-center gap-1 group-hover:gap-2 transition-all duration-300">
                <span>پیشان دان</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </span>
        </div>
        
        <!-- هێڵی ڕازاوە لە ژێر کارتدا -->
        <div class="mt-3 h-0.5 w-0 group-hover:w-full bg-gradient-to-r from-transparent via-gray-200 to-transparent rounded-full transition-all duration-700"></div>
    </div>
</a>
@empty
<div class="col-span-full flex flex-col items-center justify-center py-12 px-4">
    <div class="bg-white/50 backdrop-blur-sm rounded-2xl border border-gray-200/80 p-8 text-center max-w-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <p class="text-gray-500 text-sm font-light mb-2">هیچ فۆنتێک نەدۆزرایەوە</p>
        <p class="text-gray-400 text-xs font-light">تکایە دووبارە هەوڵ بدەوە یان فیلتەرەکان بگۆڕە</p>
        <div class="mt-4 flex justify-center gap-1">
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
        </div>
    </div>
</div>
@endforelse