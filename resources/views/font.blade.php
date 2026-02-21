@extends('layout.nav')

@section('title', 'Renus - Font')

@section('content')

<section class="max-w-7xl mx-auto pt-8 px-6">

    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl md:text-4xl font-light text-gray-900 mb-2">گەڕانی فۆنت</h1>
        <p class="text-gray-500 text-sm font-light">دۆزینەوە و هەڵبژاردنی فۆنتی دڵخواز</p>
        <div class="mt-3 flex justify-center gap-1">
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            <span class="w-2 h-1 bg-blue-400 rounded-full"></span>
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
        </div>
    </div>

    <!-- Search + Filter Form -->
    <form id="fontSearchForm" method="GET" action="{{ route('font.search') }}" class="relative flex items-center gap-3 max-w-3xl mx-auto">

        <!-- Filter Dropdown -->
        <div class="relative">
            <button type="button" id="filterButton"
                class="group border border-gray-200 bg-white rounded-2xl px-5 py-4 text-sm text-gray-700 flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-blue-200 hover:border-blue-300 hover:shadow-md transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 group-hover:rotate-180 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                </svg>
                فیلتر
            </button>

            <div id="filterDropdown"
                class="hidden absolute mt-3 w-72 bg-white border border-gray-200 rounded-2xl shadow-xl z-10 p-5">

                <div class="flex flex-col gap-3">
                    @php
                        $styles = [
                            'Normal' => 'ئاسایی',
                            'Bold' => 'تۆخ',
                            'Italic' => 'لار',
                            'Handwriting' => 'دەست نووسین'
                        ];
                    @endphp
                    
                    @foreach($styles as $style => $label)
                    <label class="flex items-center cursor-pointer bg-gray-50 rounded-xl p-3 hover:bg-blue-50 transition-all duration-200">
                        <input type="checkbox" name="style[]" value="{{ $style }}"
                            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 filter-checkbox">
                        <span class="mr-3 text-gray-700 text-sm font-light">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>

                <button type="button" id="applyFilterBtn"
                    class="mt-5 w-full bg-blue-600 text-white text-sm font-light py-3 rounded-xl hover:bg-blue-700 transition-all duration-300">
                    جاری بکە
                </button>
            </div>
        </div>

        <!-- Search Input -->
        <div class="relative flex-1">
            <input type="text" id="fontSearchInput" name="search" placeholder="گەڕان بۆ فۆنت..." value="{{ request('search') }}"
                class="w-full border border-gray-200 bg-white rounded-2xl px-6 py-4 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-300 pr-16 transition-all duration-300">
            
            <!-- Loading Spinner -->
            <div id="searchSpinner" class="absolute inset-y-0 right-2 flex items-center hidden">
                <div class="w-5 h-5 border-2 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>
            </div>
            
            <button type="submit"
                class="absolute inset-y-2 p-3 left-2 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 hover:text-blue-800 hover:bg-blue-100 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </div>
    </form>
</section>

<!-- FONT GRID -->
<div id="font-wrapper" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6 max-w-7xl mx-auto">
    @include('font.partials.fonts', ['fonts' => $fonts])
</div>

<!-- Load More Button -->
@if (isset($fonts) && $fonts->hasMorePages())
<div class="text-center mb-12">
    <button id="load-more" data-next-page="{{ $fonts->nextPageUrl() }}"
        class="group bg-white text-gray-900 px-8 py-3.5 rounded-2xl border border-gray-200 hover:border-blue-300 shadow-md hover:shadow-lg transition-all duration-300 font-light flex items-center gap-2 mx-auto">
        <span>زیاتر پیشان بدە</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 group-hover:translate-y-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>
</div>
@endif

<!-- No Results Template -->
<template id="no-results-template">
    <div class="col-span-full text-center py-12">
        <div class="inline-block p-4 bg-gray-100 rounded-full mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </div>
        <h3 class="text-lg font-light text-gray-600">هیچ فۆنتێک نەدۆزرایەوە</h3>
        <p class="text-sm text-gray-400">تکایە شێوازی گەڕان بگۆڕە</p>
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // DOM Elements
    const elements = {
        fontWrapper: document.getElementById('font-wrapper'),
        loadMoreBtn: document.getElementById('load-more'),
        searchInput: document.getElementById('fontSearchInput'),
        filterCheckboxes: document.querySelectorAll('.filter-checkbox'),
        filterButton: document.getElementById('filterButton'),
        filterDropdown: document.getElementById('filterDropdown'),
        applyFilterBtn: document.getElementById('applyFilterBtn'),
        searchSpinner: document.getElementById('searchSpinner'),
        searchForm: document.getElementById('fontSearchForm')
    };

    // Check if essential elements exist
    if (!elements.fontWrapper || !elements.searchInput) {
        console.error('Essential elements not found');
        return;
    }

    // State
    let currentRequest = null;
    let searchTimeout = null;
    let currentPage = 2; // Start from page 2 for load more

    // Toggle filter dropdown
    if (elements.filterButton && elements.filterDropdown) {
        elements.filterButton.addEventListener('click', function(e) {
            e.stopPropagation();
            elements.filterDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!elements.filterButton.contains(event.target) && 
                !elements.filterDropdown.contains(event.target)) {
                elements.filterDropdown.classList.add('hidden');
            }
        });
    }

    // Build query parameters
    function getQueryParams(resetPage = true) {
        const params = new URLSearchParams();
        
        // Add search
        if (elements.searchInput.value.trim()) {
            params.append('search', elements.searchInput.value.trim());
        }
        
        // Add filters
        elements.filterCheckboxes.forEach(cb => {
            if (cb.checked) {
                params.append('style[]', cb.value);
            }
        });
        
        // Add page
        params.append('page', resetPage ? 1 : currentPage);
        
        return params;
    }

    // Fetch fonts function
    async function fetchFonts(reset = false) {
        // Abort previous request
        if (currentRequest) {
            currentRequest.abort();
        }

        // Create new abort controller
        currentRequest = new AbortController();

        // Show loading spinner
        if (elements.searchSpinner) {
            elements.searchSpinner.classList.remove('hidden');
        }

        try {
            const params = getQueryParams(reset);
            const url = `{{ route('font.search') }}?${params.toString()}`;
            
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                signal: currentRequest.signal
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const html = await response.text();
            
            // Update DOM
            if (reset) {
                elements.fontWrapper.innerHTML = html;
                currentPage = 2;
            } else {
                elements.fontWrapper.insertAdjacentHTML('beforeend', html);
                currentPage++;
            }

            // Check if there are more results
            if (elements.loadMoreBtn) {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                const hasMore = tempDiv.querySelector('.font-card') !== null;
                
                if (!hasMore) {
                    elements.loadMoreBtn.remove();
                }
            }

        } catch (error) {
            if (error.name === 'AbortError') {
                console.log('Request aborted');
            } else {
                console.error('Fetch error:', error);
            }
        } finally {
            // Hide loading spinner
            if (elements.searchSpinner) {
                elements.searchSpinner.classList.add('hidden');
            }
            currentRequest = null;
        }
    }

    // Live search with debounce
    elements.searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            fetchFonts(true);
        }, 500); // 500ms debounce
    });

    // Apply filters
    if (elements.applyFilterBtn) {
        elements.applyFilterBtn.addEventListener('click', function() {
            fetchFonts(true);
            elements.filterDropdown.classList.add('hidden');
        });
    }

    // Prevent form submission
    if (elements.searchForm) {
        elements.searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            fetchFonts(true);
        });
    }

    // Load more button
    if (elements.loadMoreBtn) {
        elements.loadMoreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (!currentRequest) {
                fetchFonts(false);
            }
        });
    }

    // Load filter states from URL on page load
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    if (searchParam) {
        elements.searchInput.value = searchParam;
    }

    // Check filter checkboxes based on URL
    const styleParams = urlParams.getAll('style[]');
    elements.filterCheckboxes.forEach(cb => {
        if (styleParams.includes(cb.value)) {
            cb.checked = true;
        }
    });

});
</script>

<style>
/* Animations */
@keyframes spin {
    to { transform: rotate(360deg); }
}
.animate-spin {
    animation: spin 0.6s linear infinite;
}

/* Loading states */
#searchSpinner {
    transition: opacity 0.2s;
}

/* Button hover effects */
button {
    cursor: pointer;
}

/* Ensure dropdown is above other content */
#filterDropdown {
    z-index: 50;
}

/* Responsive grid */
@media (max-width: 640px) {
    #font-wrapper {
        gap: 1rem;
        padding: 1rem;
    }
}

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}
</style>
@endsection