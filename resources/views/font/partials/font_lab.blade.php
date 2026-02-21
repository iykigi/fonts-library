<tbody id="fonts-table" class="divide-y divide-gray-100/50">
    @forelse($fonts as $font)
    <tr class="group hover:bg-white/50 transition-all duration-300 relative">
        <!-- ناوی فۆنت و وەسف -->
        <td class="py-3 px-6">
            <div class="flex items-center gap-3">
                <div
                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-gray-50 to-gray-100/50 flex items-center justify-center shadow-sm group-hover:scale-105 group-hover:shadow-md transition-all duration-300">
                    <span class="font-medium text-gray-500 text-xs">{{ mb_substr($font->name, 0, 1) }}</span>
                </div>
                <div class="min-w-0">
                    <div class="text-gray-700 text-sm font-light truncate max-w-[150px]">{{ $font->name }}</div>
                    @if($font->description)
                    <div class="text-gray-400 text-[10px] mt-0.5 font-light truncate max-w-[150px]">
                        {{ Str::limit($font->description, 20) }}
                    </div>
                    @endif
                </div>
            </div>
        </td>

        <!-- کۆدی فۆنت -->
        <td class="py-3 px-6">
            <div
                class="text-gray-400 text-[10px] bg-white border border-gray-100 px-2 py-1 rounded-lg font-mono inline-block">
                #{{ $font->code }}
            </div>
        </td>

        </td>
        <!-- ستایلی فۆنت -->
        <td class="py-3 px-6">
            @php
            $styleColors = [
            'Normal' => 'bg-blue-50 text-blue-600 border-blue-100',
            'Bold' => 'bg-purple-50 text-purple-600 border-purple-100',
            'Italic' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
            'Handwriting' => 'bg-amber-50 text-amber-600 border-amber-100',
            'default' => 'bg-gray-50 text-gray-600 border-gray-100'
            ];
            $styleClass = $styleColors[$font->style] ?? $styleColors['default'];
            @endphp
            <span
                class="text-[10px] px-2 py-1 rounded-lg font-light border {{ $styleClass }} inline-block whitespace-nowrap">
                {{ $font->style }}
            </span>
        </td>

        <!-- کۆدی فۆنت و ژمارەی داگرتن -->
<td class="py-3 px-6">
    <div class="flex items-center gap-2">
        <!-- ژمارەی داگرتن -->
        <div class="download-container flex items-center gap-1 text-[10px] px-2 py-1 rounded-lg border"
             data-downloads="{{ $font->downloads }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-3 h-3">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
            <span class="download-number">{{ $font->downloads }}</span>
        </div>
    </div>
</td>

<script>
    function formatDownloads(number) {
        if (number >= 1000000000) {
            return (number / 1000000000).toFixed(1) + 'B';
        } else if (number >= 1000000) {
            return (number / 1000000).toFixed(1) + 'M';
        } else if (number >= 1000) {
            return (number / 1000).toFixed(1) + 'K';
        }
        return number.toString();
    }

    function getDownloadColor(number) {
        if (number >= 1000000000) {
            return 'text-purple-600 bg-purple-50 border-purple-200';
        } else if (number >= 1000000) {
            return 'text-blue-600 bg-blue-50 border-blue-200';
        } else if (number >= 1000) {
            return 'text-emerald-600 bg-emerald-50 border-emerald-200';
        }
        return 'text-gray-500 bg-gray-50 border-gray-100';
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.download-container').forEach(function(container) {
            const downloads = parseInt(container.dataset.downloads);
            const numberSpan = container.querySelector('.download-number');
            
            // گۆڕینی ژمارە
            numberSpan.textContent = formatDownloads(downloads);
            
            // گۆڕینی ڕەنگ
            container.className = `download-container flex items-center gap-1 text-[10px] px-2 py-1 rounded-lg border ${getDownloadColor(downloads)}`;
        });
    });
</script>

        <!-- کاتی دروستکردن -->
        <td class="py-3 px-6">
            <div class="flex items-center gap-1 text-[10px] text-gray-400 whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                {{ $font->created_at ? $font->created_at->diffForHumans() : '--' }}
            </div>
        </td>

        <!-- دوگمەکانی کارکردن -->
        <td class="py-3 px-6">
            <div class="flex items-center gap-0.5">
                <a href="{{ route('fonts.show', Crypt::encrypt($font->id)) }}"
                    class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-lg transition-all duration-200"
                    title="پیشان دان">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </a>

                <a href="{{ route('fonts.edit', $font->id) }}"
                    class="p-1.5 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all duration-200"
                    title="دەستکاری">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487a2.25 2.25 0 1 1 3.182 3.182L7.5 20.213H4.5v-3l12.362-12.726z" />
                    </svg>
                </a>

                <form action="{{ route('fonts.destroy', $font->id) }}" method="POST" class="inline"
                    onsubmit="return confirm('دڵنیایت لە سڕینەوەی ئەم فۆنتە؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-200"
                        title="سڕینەوە">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9M6 5h12M5 5h14l-1 16H6L5 5z" />
                        </svg>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="py-12 text-center">
            <div class="flex flex-col items-center justify-center gap-3">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-light">هیچ فۆنتێک نەدۆزرایەوە</p>
                    <p class="text-gray-400 text-xs font-light mt-1">یەکەم فۆنت زیاد بکە</p>
                </div>
                <a href="{{ url('/fonts/create') }}"
                    class="mt-2 px-4 py-2 bg-gray-900 text-white text-xs rounded-lg hover:bg-gray-800 transition-all duration-200 hover:shadow-md inline-flex items-center gap-1.5">
                    <span>زیادکردنی فۆنت</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </a>
            </div>
        </td>
    </tr>
    @endforelse
</tbody>
