<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .status-badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 12px;
        }
        .pending { background-color: #fff3cd; color: #856404; }
        .open { background-color: #d1ecf1; color: #0c5460; }
        .answered { background-color: #d4edda; color: #155724; }
    </style>
</head>
<body class="bg-gray-50 font-sans">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white border-r border-gray-200">
        <nav class="p-4" x-data="{ open: { clubs: false, events: false, posts: false, messages: true, users: false } }">
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
                        <li><a href="{{ route('admin.clubs.index') }}" class="block py-1 px-2 rounded hover:bg-blue-100">View List</a></li>
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
            <div class="text-2xl font-bold text-gray-800">
                Contact Messages 
                <span class="ml-2 px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                    {{ $totalMessages }} total messages
                </span>
                @if($unreadMessages > 0)
                    <span class="ml-2 px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                        {{ $unreadMessages }} unread
                    </span>
                @endif
            </div>
        </div>

        <!-- Messages Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($messages as $message)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $message->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ Str::limit($message->message, 100) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-badge {{ $message->status }}">
                                        {{ ucfirst($message->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $message->created_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                       
                                        <a href="{{ route('admin.messages.reply', $message->id) }}" 
                                           class="text-green-600 hover:text-green-900" 
                                           title="Reply to Message">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                        @if($message->status === 'pending')
                                            <form action="{{ route('admin.messages.markAsRead', $message->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-orange-600 hover:text-orange-900" title="Mark as Read">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                                    onclick="return confirm('Are you sure you want to delete this message?')"
                                                    title="Delete Message">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No messages found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($messages->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
