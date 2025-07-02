<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISETLink Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white">
            <div class="p-4 border-b border-blue-700">
                <h1 class="text-2xl font-bold">ISETLink</h1>
            </div>
            <nav class="p-4" x-data="{ open: '' }">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-blue-700">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>
                    <!-- Clubs -->
                    <li>
                        <button @click="open = (open === 'clubs' ? '' : 'clubs')" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-blue-700 focus:outline-none">
                            <span class="flex items-center"><i class="fas fa-users mr-3"></i> Clubs</span>
                            <svg :class="{'rotate-90': open === 'clubs'}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                        <ul x-show="open === 'clubs'" class="ml-8 mt-1 space-y-1" x-cloak>
                            <li><a href="{{ route('admin.clubs.index') }}" class="block py-1 px-2 rounded hover:bg-blue-600">View List</a></li>
                            <li><a href="{{ route('admin.clubs.create') }}" class="block py-1 px-2 rounded hover:bg-blue-600">Create</a></li>
                        </ul>
                    </li>
                    <!-- Events -->
                    <li>
                        <button @click="open = (open === 'events' ? '' : 'events')" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-blue-700 focus:outline-none">
                            <span class="flex items-center"><i class="fas fa-calendar-alt mr-3"></i> Events</span>
                            <svg :class="{'rotate-90': open === 'events'}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                        <ul x-show="open === 'events'" class="ml-8 mt-1 space-y-1" x-cloak>
                            <li><a href="{{ route('admin.events.index') }}" class="block py-1 px-2 rounded hover:bg-blue-600">View List</a></li>
                            <li><a href="{{ route('admin.events.create') }}" class="block py-1 px-2 rounded hover:bg-blue-600">Create</a></li>
                        </ul>
                    </li>
                    <!-- Posts -->
                    <li>
                        <button @click="open = (open === 'posts' ? '' : 'posts')" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-blue-700 focus:outline-none">
                            <span class="flex items-center"><i class="fas fa-newspaper mr-3"></i> Posts</span>
                            <svg :class="{'rotate-90': open === 'posts'}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                        <ul x-show="open === 'posts'" class="ml-8 mt-1 space-y-1" x-cloak>
                            <li><a href="{{ route('admin.posts.index') }}" class="block py-1 px-2 rounded hover:bg-blue-600">View List</a></li>
                            <li><a href="{{ route('admin.posts.create') }}" class="block py-1 px-2 rounded hover:bg-blue-600">Create</a></li>
                        </ul>
                    </li>
                    <!-- Messages -->
                    <li>
                        <button @click="open = (open === 'messages' ? '' : 'messages')" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-blue-700 focus:outline-none">
                            <span class="flex items-center"><i class="fas fa-envelope mr-3"></i> Messages</span>
                            <svg :class="{'rotate-90': open === 'messages'}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                        <ul x-show="open === 'messages'" class="ml-8 mt-1 space-y-1" x-cloak>
                            <li><a href="{{ route('admin.messages.index') }}" class="block py-1 px-2 rounded hover:bg-blue-600">View List</a></li>
                        </ul>
                    </li>
                    <!-- Users -->
                    <li>
                        <button @click="open = (open === 'users' ? '' : 'users')" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-blue-700 focus:outline-none">
                            <span class="flex items-center"><i class="fas fa-user mr-3"></i> Users</span>
                            <svg :class="{'rotate-90': open === 'users'}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                        <ul x-show="open === 'users'" class="ml-8 mt-1 space-y-1" x-cloak>
                            <li><a href="{{ route('admin.users.index') }}" class="block py-1 px-2 rounded hover:bg-blue-600">View List</a></li>
                        </ul>
                    </li>
                
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button class="md:hidden mr-4">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h2 class="text-xl font-semibold">Dashboard</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="p-2 rounded-full hover:bg-gray-200" id="notificationDropdownBtn">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                            <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-2 z-10">
                                <div class="px-4 py-2 text-gray-700 font-semibold">Notifications</div>
                                <div class="px-4 py-2 text-gray-500">No new notifications</div>
                            </div>
                        </div>
                        <div class="relative">
                            <a href="{{ route('admin.messages.index') }}" class="p-2 rounded-full hover:bg-gray-200">
                                <i class="fas fa-envelope"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-blue-500"></span>
                            </a>
                        </div>
                        <div class="relative">
                            <button id="profileDropdown" class="flex items-center space-x-2">
                                @if( $user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover">
                                @else
                                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                                        <span>{{ strtoupper(substr($user->nom,0,1)) }}</span>
                                    </div>
                                @endif
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user-cog mr-2"></i> Profile
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog mr-2"></i> Settings
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Clubs</p>
                                <h3 class="text-2xl font-bold">{{ $stats['clubs'] }}</h3>
                            </div>
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Events</p>
                                <h3 class="text-2xl font-bold">{{ $stats['events'] }}</h3>
                            </div>
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Members</p>
                                <h3 class="text-2xl font-bold">{{ $stats['members'] }}</h3>
                            </div>
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <i class="fas fa-user-friends"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Posts</p>
                                <h3 class="text-2xl font-bold">{{ $stats['posts'] }}</h3>
                            </div>
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Messages Section -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Recent Messages</h3>
                        <a href="#" class="text-blue-600 hover:underline">View All</a>
                    </div>
                    <div class="space-y-4">
                        @forelse($recentMessages as $message)
                        <div class="flex items-start border-b pb-4 last:border-b-0">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                                <i class="fas fa-user text-gray-600"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $message->email }}</p>
                                <p class="text-sm text-gray-500 truncate">{{ Str::limit($message->message, 50) }}</p>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $message->created_at->diffForHumans() }}
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500">No recent messages</p>
                        @endforelse
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Profile dropdown toggle
        document.getElementById('profileDropdown').addEventListener('click', function(event) {
            event.stopPropagation();
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        });
        // Notification dropdown toggle
        document.getElementById('notificationDropdownBtn').addEventListener('click', function(event) {
            event.stopPropagation();
            document.getElementById('notificationDropdown').classList.toggle('hidden');
        });
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownMenu');
            const notificationDropdown = document.getElementById('notificationDropdown');
            if (!event.target.closest('#profileDropdown')) {
                dropdown.classList.add('hidden');
            }
            if (!event.target.closest('#notificationDropdownBtn')) {
                notificationDropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>