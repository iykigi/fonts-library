@extends('layouts.app')

@section('content')
<div x-data="userTable()" class="min-h-screen bg-gradient-to-br from-gray-50/50 to-white py-8 px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="max-w-7xl mx-auto mb-10 text-center">
        <h1 class="text-4xl md:text-5xl font-light text-gray-900 mb-4">Admin Dashboard</h1>
        <p class="text-gray-400 text-sm font-light">
            بەڕێوەبردنی هەموو بەکارهێنەران و ڕێکخستنی ڕۆڵ و دۆخیان
        </p>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="bg-white/80 backdrop-blur-xl border border-gray-200/80 rounded-3xl overflow-hidden">

            <!-- Top Controls -->
            <div class="p-6 border-b border-gray-100 flex flex-wrap justify-between gap-4">

                <!-- Search -->
                <div class="relative">
                    <input x-model="search"
                           type="text"
                           placeholder="Search users..."
                           class="w-64 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm outline-none focus:ring-2 focus:ring-gray-300">
                </div>

                <!-- Filter -->
                <div class="flex gap-2">
                    <button @click="filter='all'"
                        :class="filter=='all' ? activeBtn : normalBtn">
                        هەموو
                    </button>

                    <button @click="filter='verified'"
                        :class="filter=='verified' ? activeBtn : normalBtn">
                        سەلمێندراوە
                    </button>

                    <button @click="filter='not_verified'"
                        :class="filter=='not_verified' ? activeBtn : normalBtn">
                        نەسەلمێندراوە
                    </button>
                </div>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b bg-gray-50 text-xs text-gray-500 uppercase">
                            <th class="py-4 px-6 text-left">Name</th>
                            <th class="py-4 px-6 text-left">Email</th>
                            <th class="py-4 px-6 text-left">Role</th>
                            <th class="py-4 px-6 text-left">Status</th>
                            <th class="py-4 px-6 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @foreach ($users as $user)
                        <tr x-show="showUser(
                                '{{ strtolower($user->name) }}',
                                '{{ strtolower($user->email) }}',
                                {{ $user->hasVerifiedEmail() ? 'true' : 'false' }}
                            )"
                            class="hover:bg-gray-50 transition">

                            <!-- Name -->
                            <td class="py-4 px-6 text-sm text-gray-900">
                                {{ $user->name }}
                            </td>

                            <!-- Email -->
                            <td class="py-4 px-6 text-sm text-gray-400">
                                {{ $user->email }}
                            </td>

                            <!-- Role -->
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-xl text-xs
                                    {{ $user->role == 'admin'
                                        ? 'bg-purple-100 text-purple-600'
                                        : 'bg-blue-100 text-blue-600' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <!-- STATUS (UPDATED) -->
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-xl text-xs flex items-center gap-1 w-fit
                                    {{ $user->hasVerifiedEmail()
                                        ? 'bg-green-100 text-green-600'
                                        : 'bg-red-100 text-red-600' }}">

                                    <span class="w-1.5 h-1.5 rounded-full
                                        {{ $user->hasVerifiedEmail()
                                            ? 'bg-green-500'
                                            : 'bg-red-500' }}">
                                    </span>

                                    {{ $user->hasVerifiedEmail()
                                        ? 'سەلمێندراوە'
                                        : 'نەسەلمێندراوە' }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6">
                                <div class="flex gap-2">

                                    <a href="{{ route('admin.users.edit', Crypt::encryptString($user->id)) }}"
                                       class="px-3 py-1 text-xs rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.users.destroy', Crypt::encryptString($user->id)) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 text-xs rounded-lg bg-red-50 text-red-600 hover:bg-red-100">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</div>

<!-- Alpine -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
function userTable() {
    return {
        search: '',
        filter: 'all',

        activeBtn: 'px-3 py-1 text-xs rounded-xl bg-gray-900 text-white',
        normalBtn: 'px-3 py-1 text-xs rounded-xl bg-gray-100 text-gray-600',

        showUser(name, email, verified) {

            let matchSearch =
                name.includes(this.search.toLowerCase()) ||
                email.includes(this.search.toLowerCase());

            if (this.filter === 'verified') {
                return matchSearch && verified;
            }

            if (this.filter === 'not_verified') {
                return matchSearch && !verified;
            }

            return matchSearch;
        }
    }
}
</script>

@endsection
