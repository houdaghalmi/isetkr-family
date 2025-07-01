<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Club</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white border-r border-gray-200">
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.clubs.index') }}" class="flex items-center py-2 px-4 rounded bg-blue-100 text-blue-700">
                            <i class="fas fa-users mr-3"></i> Clubs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.events.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                            <i class="fas fa-calendar-alt mr-3"></i> Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.posts.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                            <i class="fas fa-newspaper mr-3"></i> Posts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.messages.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                            <i class="fas fa-envelope mr-3"></i> Messages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                            <i class="fas fa-user mr-3"></i> Users
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex items-center justify-center mb-6 space-x-4">
    <span>
        <img src="{{ $club->logo ? asset('storage/' . $club->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($club->name) . '&background=random' }}" 
             alt="logo" 
             class="w-16 h-16 rounded-full">
    </span>
    <h2 class="text-2xl font-bold text-gray-800">{{ $club->name }}</h2>
</div>


    <!-- Members List -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Members</h3>
            <span class="text-sm text-gray-500">{{ $members->total() }} members</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Function</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($members as $member)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($member->avatar)
                                        <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $member->avatar) }}" alt="">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $member->nom }} {{ $member->prenom }}</div>
                                    <div class="text-sm text-gray-500">{{ $member->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $member->numero }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $member->pivot->function == 'President' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $member->pivot->function }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($member->pivot->joined_at)->format('M d, Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Members Pagination -->
        <div class="flex justify-between items-center px-6 py-4 border-t border-gray-100">
            <div class="text-sm text-gray-500">Page {{ $members->currentPage() }} of {{ $members->lastPage() }}</div>
            <div class="space-x-2">
                @if($members->previousPageUrl())
                    <a href="{{ $members->previousPageUrl() }}" class="px-3 py-1 rounded border border-gray-300 text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                @endif
                @if($members->nextPageUrl())
                    <a href="{{ $members->nextPageUrl() }}" class="px-3 py-1 rounded border border-purple-300 text-purple-700 bg-purple-50 hover:bg-purple-100">Next</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Events List -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Events</h3>
            <span class="text-sm text-gray-500">{{ $events->total() }} events</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Speaker</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($events as $event)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($event->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $event->intervenant }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($event->datetime)->format('M d, Y H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $event->status == 'completed' ? 'bg-green-100 text-green-800' : ($event->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($event->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="{{ route('admin.events.show', $event->id) }}" class="text-gray-400 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Events Pagination -->
        <div class="flex justify-between items-center px-6 py-4 border-t border-gray-100">
            <div class="text-sm text-gray-500">Page {{ $events->currentPage() }} of {{ $events->lastPage() }}</div>
            <div class="space-x-2">
                @if($events->previousPageUrl())
                    <a href="{{ $events->previousPageUrl() }}" class="px-3 py-1 rounded border border-gray-300 text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                @endif
                @if($events->nextPageUrl())
                    <a href="{{ $events->nextPageUrl() }}" class="px-3 py-1 rounded border border-purple-300 text-purple-700 bg-purple-50 hover:bg-purple-100">Next</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Posts List -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Posts</h3>
            <span class="text-sm text-gray-500">{{ $posts->total() }} posts</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($posts as $post)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">{{ Str::limit($post->content, 70) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    @if($post->user->avatar ?? false)
                                        <img class="h-8 w-8 rounded-full" src="{{ asset('storage/' . $post->user->avatar) }}" alt="">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-400 text-xs"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $post->user->nom ?? 'Unknown' }} {{ $post->user->prenom ?? '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="{{ route('admin.posts.show', $post->id) }}" class="text-gray-400 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Posts Pagination -->
        <div class="flex justify-between items-center px-6 py-4 border-t border-gray-100">
            <div class="text-sm text-gray-500">Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</div>
            <div class="space-x-2">
                @if($posts->previousPageUrl())
                    <a href="{{ $posts->previousPageUrl() }}" class="px-3 py-1 rounded border border-gray-300 text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                @endif
                @if($posts->nextPageUrl())
                    <a href="{{ $posts->nextPageUrl() }}" class="px-3 py-1 rounded border border-purple-300 text-purple-700 bg-purple-50 hover:bg-purple-100">Next</a>
                @endif
            </div>
        </div>
    </div>
</div>
    </div>
</body>
</html>