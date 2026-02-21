@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50/50 to-white py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- گرافیکی ڕازاوە -->
    <div class="fixed top-0 right-0 w-96 h-96 bg-gradient-to-br from-gray-200/20 to-transparent rounded-full blur-3xl -z-10"></div>
    <div class="fixed bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-gray-200/10 to-transparent rounded-full blur-3xl -z-10"></div>

    <div class="max-w-3xl mx-auto">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-light text-gray-900 mb-3">Edit User</h1>
            <div class="flex justify-center gap-1 mb-3">
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <span class="w-2 h-1 bg-gray-400 rounded-full"></span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            </div>
            <p class="text-gray-400 text-sm font-light">Editing: <span class="text-gray-600 font-medium">{{ $user->name }}</span></p>
        </div>

        <!-- Main Card -->
        <div class="bg-white/80 backdrop-blur-xl border border-gray-200/80 rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500">
            
            <!-- Card Header with User Info -->
            <div class="p-6 border-b border-gray-100/80 bg-gradient-to-br from-gray-50/50 to-white">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center shadow-sm">
                        <span class="text-xl font-light text-gray-500">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-light text-gray-900">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-400 font-light">{{ $user->email }}</p>
                    </div>
                    <div class="mr-auto">
                        <span class="px-3 py-1.5 rounded-xl text-xs font-light
                            {{ $user->role === 'admin' 
                                ? 'bg-gradient-to-br from-purple-50 to-purple-100/50 text-purple-600 border border-purple-200/80' 
                                : 'bg-gradient-to-br from-blue-50 to-blue-100/50 text-blue-600 border border-blue-200/80' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="m-6 p-4 bg-red-50/80 backdrop-blur-sm border border-red-200/80 rounded-xl">
                    <div class="flex items-center gap-2 text-red-600 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        <h3 class="font-light">Please fix the following errors:</h3>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-sm text-red-500 font-light">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Message -->
            @if(session('success'))
                <div class="m-6 p-4 bg-green-50/80 backdrop-blur-sm border border-green-200/80 rounded-xl">
                    <div class="flex items-center gap-2 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="font-light">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.users.update', Crypt::encryptString($user->id)) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Name
                    </label>
                    <div class="relative group">
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                   focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                   transition-all duration-300 placeholder:text-gray-300 font-light
                                   group-hover:border-gray-300">
                    </div>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        Email
                    </label>
                    <div class="relative group">
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                   focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                   transition-all duration-300 placeholder:text-gray-300 font-light
                                   group-hover:border-gray-300">
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        Password <span class="text-xs text-gray-400 font-light">(leave blank to keep current)</span>
                    </label>
                    <div class="relative group">
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                   focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                   transition-all duration-300 placeholder:text-gray-300 font-light
                                   group-hover:border-gray-300"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Password Confirmation -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Confirm Password
                    </label>
                    <div class="relative group">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                   focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                   transition-all duration-300 placeholder:text-gray-300 font-light
                                   group-hover:border-gray-300"
                            placeholder="••••••••">
                    </div>
                </div>

                @if ($canEditRoleStatus)
                    <!-- Role -->
                    <div class="space-y-2">
                        <label for="role" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.074-.04.147-.083.22-.128.332-.183.582-.495.645-.869l.213-1.28z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Role
                        </label>
                        <div class="relative group">
                            <select name="role" id="role"
                                class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                       focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                       transition-all duration-300 font-light appearance-none
                                       group-hover:border-gray-300">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }} class="bg-white">User</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }} class="bg-white">Admin</option>
                            </select>
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label for="is_active" class="block text-sm font-light text-gray-500 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Status
                        </label>
                        <div class="relative group">
                            <select name="is_active" id="is_active"
                                class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200/80
                                       focus:ring-2 focus:ring-gray-300 focus:border-gray-300 outline-none 
                                       transition-all duration-300 font-light appearance-none
                                       group-hover:border-gray-300">
                                <option value="1" {{ $user->is_active ? 'selected' : '' }} class="bg-white">Active</option>
                                <option value="0" {{ !$user->is_active ? 'selected' : '' }} class="bg-white">Blocked</option>
                            </select>
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Submit buttons -->
                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-3 sm:space-y-0 pt-6 border-t border-gray-100/50">
                    <button type="submit"
                        class="group flex-1 inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800
                               text-white px-6 py-3 rounded-xl transition-all duration-300 
                               hover:-translate-y-0.5 shadow-md hover:shadow-xl font-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        Save Changes
                    </button>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-white/50 border border-gray-200/80 
                               text-gray-500 hover:text-gray-700 rounded-xl transition-all duration-300 
                               hover:-translate-y-0.5 shadow-sm hover:shadow-md font-light">
                        Cancel
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
            <p class="text-xs text-gray-400 font-light mt-2">Admin • Edit User Information</p>
        </div>
    </div>
</div>

<!-- Alpine.js for animations if needed -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection