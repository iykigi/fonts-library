<section class="bg-white/80 backdrop-blur-xl border border-gray-200/80 rounded-3xl p-8 w-full max-w-lg space-y-6 hover:shadow-gray-200/50 hover:shadow-xl transition-all duration-500">
    <!-- Header -->
    <header>
        <h2 class="text-2xl font-light text-gray-900 flex items-center gap-3">
            <!-- Trash Icon -->
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3"/>
            </svg>
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-2 text-sm text-gray-400 font-light">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please download any data you wish to retain.') }}
        </p>
    </header>

    <button
        id="openModal"
        class="group bg-white/50 border border-red-200/80 text-red-500 hover:bg-red-50/80 hover:border-red-300 px-6 py-3 rounded-xl transition-all duration-300 hover:-translate-y-0.5 shadow-sm hover:shadow-md font-light flex items-center gap-2"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
        </svg>
        {{ __('Delete Account') }}
    </button>
    
    <!-- گرافیکی بچووک -->
    <div class="flex justify-center gap-1 pt-2">
        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
        <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
    </div>
</section>

<!-- Modal -->
<div
    id="modal"
    class="fixed inset-0 bg-black/30 backdrop-blur-md hidden items-center justify-center z-50 opacity-0 transition-opacity duration-300"
>
    <div
        class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl w-full max-w-md p-8 space-y-6
               transform scale-95 opacity-0 transition-all duration-500 border border-white/30"
        id="modalContent"
    >
        <div class="flex items-center gap-3">
            <div class="p-2 bg-red-50/80 rounded-xl">
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>
            <h2 class="text-2xl font-light text-gray-900">
                {{ __('Are you sure?') }}
            </h2>
        </div>

        <p class="text-sm text-gray-400 font-light leading-relaxed">
            {{ __('This action is permanent. All your data will be deleted and cannot be recovered. Please enter your password to confirm.') }}
        </p>

        <!-- Password input -->
        <div class="space-y-2">
            <label for="password" class="text-sm font-light text-gray-500 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
                {{ __('Password') }}
            </label>
            <div class="relative group">
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-gray-200/80 bg-white/50 backdrop-blur-sm px-4 py-3
                           focus:ring-2 focus:ring-red-300 focus:border-red-300 outline-none transition-all duration-300
                           placeholder:text-gray-300 font-light group-hover:border-gray-300"
                >
                <button type="button" onclick="togglePassword(this)" class="absolute inset-y-0 left-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100/50">
            <button
                id="closeModal"
                class="px-6 py-2.5 rounded-xl border border-gray-200/80 bg-white/50 backdrop-blur-sm
                       text-gray-500 hover:bg-gray-100/50 transition-all duration-300 font-light hover:-translate-y-0.5"
            >
                {{ __('Cancel') }}
            </button>

            <form method="POST" action="{{ route('profile.destroy') }}" id="deleteForm">
                @csrf
                @method('DELETE')
                <input type="hidden" name="password" id="hiddenPassword">
                <button
                    type="submit"
                    id="deleteBtn"
                    disabled
                    class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-red-500 to-red-600 text-white font-light
                           opacity-50 cursor-not-allowed transition-all duration-300 flex items-center gap-2
                           hover:from-red-600 hover:to-red-700 hover:-translate-y-0.5 shadow-md hover:shadow-lg"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                    </svg>
                    {{ __('Delete Account') }}
                </button>
            </form>
        </div>
        
        <!-- گرافیکی بچووک -->
        <div class="flex justify-center gap-1">
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
        </div>
    </div>
</div>

<!-- JS -->
<script>
    const openModal = document.getElementById('openModal');
    const closeModal = document.getElementById('closeModal');
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modalContent');
    const passwordInput = document.getElementById('password');
    const hiddenPassword = document.getElementById('hiddenPassword');
    const deleteBtn = document.getElementById('deleteBtn');
    const deleteForm = document.getElementById('deleteForm');

    // تۆگڵی پیشاندانی پاسوۆرد
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

    // پیشاندانی مۆدال
    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
            passwordInput.focus();
        }, 10);
    }

    // داخستنی مۆدال
    function hideModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modal.classList.remove('opacity-100');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            passwordInput.value = '';
            hiddenPassword.value = '';
            deleteBtn.disabled = true;
            deleteBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }, 300);
    }

    openModal.addEventListener('click', showModal);
    closeModal.addEventListener('click', hideModal);

    // داخستن بە کلیک لە دەرەوە
    modal.addEventListener('click', (e) => {
        if (e.target === modal) hideModal();
    });

    // داخستن بە کلیلی ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            hideModal();
        }
    });

    // چالاککردنی بۆتنی سڕینەوە کاتێک پاسوۆرد هەیە
    passwordInput.addEventListener('input', () => {
        if (passwordInput.value.trim().length > 0) {
            deleteBtn.disabled = false;
            deleteBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            hiddenPassword.value = passwordInput.value;
        } else {
            deleteBtn.disabled = true;
            deleteBtn.classList.add('opacity-50', 'cursor-not-allowed');
            hiddenPassword.value = '';
        }
    });

    // ناردنی فۆرم بۆ Laravel
    deleteForm.addEventListener('submit', function(e) {
        if (deleteBtn.disabled) {
            e.preventDefault();
            return;
        }
        
        // پیشاندانی نوتیفیکەیشنی لۆدینگ
        deleteBtn.innerHTML = `
            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ __('Deleting...') }}
        `;
        deleteBtn.disabled = true;
    });
</script>

<style>
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    /* ستایلی بۆ ئینپووت */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0px 1000px rgba(255, 255, 255, 0.5) inset;
        transition: background-color 5000s ease-in-out 0s;
    }
</style>