<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="font-semibold text-2xl sm:text-3xl text-slate-800 leading-tight">
                {{ __('User Management') }}
            </h2>
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center px-4 py-2 bg-slate-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-700 active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition ease-in-out duration-150 group">
                <i class="fas fa-plus transition-transform group-hover:scale-110"></i>
                <span class="hidden sm:inline ml-2">Add New User</span>
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 rounded-xl">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-3"></i>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Users Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-users text-blue-500 mr-3 text-xl"></i>
                            <h3 class="text-lg font-semibold text-slate-800">All Users</h3>
                        </div>
                        <span class="px-3 py-1 bg-slate-200 text-slate-700 text-sm font-medium rounded-full">
                            {{ $users->total() }} total
                        </span>
                    </div>
                </div>

                @if ($users->count() > 0)
                    <!-- Desktop Table View -->
                    <div class="hidden md:block">
                        <table class="min-w-full">
                            <thead class="bg-slate-50/50">
                                <tr class="border-b border-slate-200">
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        User</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Roles</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Joined Date</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-slate-200 flex-shrink-0 flex items-center justify-center">
                                                    @if ($user->avatar)
                                                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                                            class="w-full h-full rounded-full object-cover">
                                                    @else
                                                        <span
                                                            class="font-semibold text-slate-600">{{ substr($user->name, 0, 1) }}</span>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-slate-900">{{ $user->name }}
                                                    </div>
                                                    <div class="text-sm text-slate-500">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($user->getRoleNames() as $role)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        {{ $role }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600">
                                            {{ $user->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="text-blue-600 hover:text-blue-800">Edit</a>
                                            {{-- Mencegah Super Admin dihapus --}}
                                            @if (!$user->hasRole('Super Admin'))
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?');" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-800">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden divide-y divide-slate-200">
                        @foreach ($users as $user)
                            <div class="p-4">
                                <div class="flex items-center mb-3">
                                    <div
                                        class="h-10 w-10 rounded-full bg-slate-200 flex-shrink-0 flex items-center justify-center mr-4">
                                        @if ($user->avatar)
                                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                                class="w-full h-full rounded-full object-cover">
                                        @else
                                            <span
                                                class="font-semibold text-slate-600">{{ substr($user->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-800">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <span class="text-xs text-slate-500">Roles:</span>
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @forelse($user->getRoleNames() as $role)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                {{ $role }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-slate-400">No roles assigned.</span>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-slate-500">Joined:
                                        {{ $user->created_at->format('d M Y') }}</span>
                                    <div class="flex justify-end space-x-4">
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                            class="text-sm font-medium text-blue-600 hover:underline">Edit</a>
                                        @if (!$user->hasRole('Super Admin'))
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?');" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-sm font-medium text-red-600 hover:underline">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if ($users->hasPages())
                        <div class="p-6 border-t border-slate-200">
                            {{ $users->links() }}
                        </div>
                    @endif
                @else
                    {{-- Empty State --}}
                    <div class="text-center py-16 px-6">
                        <i class="fas fa-users-slash text-slate-400 text-5xl mb-4"></i>
                        <h3 class="text-xl font-medium text-slate-800 mb-2">No Other Users Found</h3>
                        <p class="text-slate-500 mb-6">You are the only user here. Add a new user to assign roles and
                            permissions.</p>
                        <a href="{{ route('admin.users.create') }}"
                            class="inline-flex items-center px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 group">
                            <i class="fas fa-user-plus mr-2 transition-transform group-hover:scale-110"></i>
                            Add First User
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
