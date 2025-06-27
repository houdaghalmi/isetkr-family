<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clubs List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .status-badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 12px;
        }
        .active { background-color: #d4edda; color: #155724; }
        .inactive { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body class="bg-gray-50 font-sans">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white border-r border-gray-200">
        <nav class="p-4" x-data="{ open: { clubs: true, events: false, posts: false, messages: false, users: false } }">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                </li>
                <!-- Clubs -->
                <li>
                    <button @click="open.clubs = !open.clubs" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-gray-100 focus:outline-none">
                        <span class="flex items-center"><i class="fas fa-users mr-3"></i> Clubs</span>
                        <svg :class="{'rotate-90': open.clubs}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                    <ul x-show="open.clubs" class="ml-8 mt-1 space-y-1" x-cloak>
                        <li><a href="{{ route('admin.clubs.index') }}" class="block py-1 px-2 rounded hover:bg-blue-100 text-blue-700 font-semibold">View List</a></li>
                        <li><a href="{{ route('admin.clubs.create') }}" class="block py-1 px-2 rounded hover:bg-blue-100">Create</a></li>
                    </ul>
                </li>
                <!-- Events -->
                <li>
                    <button @click="open.events = !open.events" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-gray-100 focus:outline-none">
                        <span class="flex items-center"><i class="fas fa-calendar-alt mr-3"></i> Events</span>
                        <svg :class="{'rotate-90': open.events}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                    <ul x-show="open.events" class="ml-8 mt-1 space-y-1" x-cloak>
                        <li><a href="{{ route('admin.events.index') }}" class="block py-1 px-2 rounded hover:bg-blue-100">View List</a></li>
                        <li><a href="{{ route('admin.events.create') }}" class="block py-1 px-2 rounded hover:bg-blue-100">Create</a></li>
                    </ul>
                </li>
                <!-- Posts -->
                <li>
                    <button @click="open.posts = !open.posts" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-gray-100 focus:outline-none">
                        <span class="flex items-center"><i class="fas fa-newspaper mr-3"></i> Posts</span>
                        <svg :class="{'rotate-90': open.posts}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                    <ul x-show="open.posts" class="ml-8 mt-1 space-y-1" x-cloak>
                        <li><a href="{{ route('admin.posts.index') }}" class="block py-1 px-2 rounded hover:bg-blue-100">View List</a></li>
                        <li><a href="{{ route('admin.posts.create') }}" class="block py-1 px-2 rounded hover:bg-blue-100">Create</a></li>
                    </ul>
                </li>
                <!-- Messages -->
                <li>
                    <button @click="open.messages = !open.messages" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-gray-100 focus:outline-none">
                        <span class="flex items-center"><i class="fas fa-envelope mr-3"></i> Messages</span>
                        <svg :class="{'rotate-90': open.messages}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                    <ul x-show="open.messages" class="ml-8 mt-1 space-y-1" x-cloak>
                        <li><a href="{{ route('admin.messages.index') }}" class="block py-1 px-2 rounded hover:bg-blue-100">View List</a></li>
                    </ul>
                </li>
                <!-- Users -->
                <li>
                    <button @click="open.users = !open.users" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-gray-100 focus:outline-none">
                        <span class="flex items-center"><i class="fas fa-user mr-3"></i> Users</span>
                        <svg :class="{'rotate-90': open.users}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                    <ul x-show="open.users" class="ml-8 mt-1 space-y-1" x-cloak>
                        <li><a href="{{ route('admin.users.index') }}" class="block py-1 px-2 rounded hover:bg-blue-100">View List</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col p-8">
        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-6">
            <div class="text-2xl font-bold text-gray-800">total clubs <span class="ml-2 px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-sm font-semibold">{{ $clubs->total() }} clubs</span></div>
            <div class="flex items-center gap-2">
                <a href="#" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-download mr-2"></i> Download PDF Report
                </a>
                <a href="{{ route('admin.clubs.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md shadow hover:bg-purple-700">
                    <i class="fas fa-plus mr-2"></i> Add club
                </a>
            </div>
        </div>
        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">responsable</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">nombre d'evenement</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">membre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">date de creation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($clubs as $club)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                                <img src="{{ $club->logo ? asset('storage/' . $club->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($club->name) . '&background=random' }}" alt="logo" class="w-8 h-8 rounded-full">
                                <span class="font-semibold text-gray-800">{{ $club->name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $club->responsable->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $club->events_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $club->members_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $club->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(strtolower($club->status) === 'active')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700"><span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>Active</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500"><span class="h-2 w-2 rounded-full bg-gray-400 mr-2"></span>Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('admin.clubs.edit', $club) }}" class="text-gray-400 hover:text-purple-600 mr-3"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('admin.clubs.destroy', $club) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex justify-between items-center mt-6">
                <div class="text-sm text-gray-500">Page {{ $clubs->currentPage() }} of {{ $clubs->lastPage() }}</div>
                <div class="space-x-2">
                    @if($clubs->previousPageUrl())
                        <a href="{{ $clubs->previousPageUrl() }}" class="px-3 py-1 rounded border border-gray-300 text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                    @endif
                    @if($clubs->nextPageUrl())
                        <a href="{{ $clubs->nextPageUrl() }}" class="px-3 py-1 rounded border border-purple-300 text-purple-700 bg-purple-50 hover:bg-purple-100">Next</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>