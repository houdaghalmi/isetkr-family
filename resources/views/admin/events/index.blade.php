<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans flex">
    <div class="flex min-h-screen">

    <!-- Sidebar  -->
      <aside class="w-64 bg-white border-r border-gray-200 h-screen sticky top-0 overflow-y-auto">
        <nav class="p-4" x-data="{ open: { clubs: true, events: false, posts: false, messages: false, users: false }, openEventModal: false, openClubModal: false, openPostModal: false }">
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
                        <li><button type="button" @click.stop="openClubModal = true" class="block py-1 px-2 rounded hover:bg-blue-100 w-full text-left">Create</button></li>
                    </ul>
                </li>
                <!-- Events -->
                <li>
                    <button @click="open.events = !open.events" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-gray-100 focus:outline-none">
                        <span class="flex items-center"><i class="fas fa-calendar-alt mr-3"></i> Events</span>
                        <svg :class="{'rotate-90': open.events}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                    <ul x-show="open.events" class="ml-8 mt-1 space-y-1" x-cloak>
                        <li><a href="{{ route('admin.events.index') }}" class="block py-1 px-2 rounded hover:bg-blue-100  text-blue-700 font-semibold"">View List</a></li>
                        <li><button type="button" @click.stop="openEventModal = true" class="block py-1 px-2 rounded hover:bg-blue-100 w-full text-left">Create</button></li>
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
                        <li><button type="button" @click.stop="openPostModal = true" class="block py-1 px-2 rounded hover:bg-blue-100 w-full text-left">Create</button></li>
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
            <!-- Club Modal -->
            <div x-show="openClubModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50" style="z-index: 9999;">
                <div @click.away="openClubModal = false" class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative overflow-y-auto max-h-[90vh] z-50" style="z-index: 10000;">
                    <button @click="openClubModal = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
                    <h2 class="text-2xl font-bold mb-6">Create Club</h2>
                    <form action="{{ route('admin.clubs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Name</label>
                            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Logo</label>
                            <input type="file" name="logo" accept="image/*" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Description</label>
                            <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Objective</label>
                            <textarea name="objective" class="w-full border rounded px-3 py-2"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Responsible User</label>
                            <select name="responsable_user_id" class="w-full border rounded px-3 py-2" required>
                                @foreach($responsibles as $user)
                                    <option value="{{ $user->id }}">{{ $user->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Status</label>
                            <select name="status" class="w-full border rounded px-3 py-2">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="openClubModal = false" class="bg-gray-200 text-gray-700 px-6 py-2 rounded">Cancel</button>
                            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700">Create Club</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Event Modal (moved here for global control) -->
            <div x-show="openEventModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50" style="z-index: 9999;">
                <div @click.away="openEventModal = false" class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative overflow-y-auto max-h-[90vh] z-50" style="z-index: 10000;">
                    <button @click="openEventModal = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
                    <h2 class="text-2xl font-bold mb-6">Créer un évènement</h2>
                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">titre</label>
                            <input type="text" name="title" class="w-full border rounded px-3 py-2" placeholder="nom du l'evenement">
                            <span class="text-xs text-gray-400 float-right">0/30</span>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">nom du formatrice</label>
                            <input type="text" name="intervenant" class="w-full border rounded px-3 py-2" placeholder="nom du formatrice">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">club responsable</label>
                            <select name="club_id" class="w-full border rounded px-3 py-2">
                                <option value="">Select club responsable</option>
                                @foreach($clubs as $club)
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Description</label>
                            <textarea name="description" class="w-full border rounded px-3 py-2" placeholder="Details about event"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Date et heure</label>
                            <input type="datetime-local" name="datetime" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Localisation</label>
                            <input type="text" name="location" class="w-full border rounded px-3 py-2" placeholder="Lieu de l'événement" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Status</label>
                            <select name="status" class="w-full border rounded px-3 py-2">
                                <option value="pending">pending</option>
                                <option value="completed">completed</option>
                                <option value="canceled">canceled</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">affiche d'evenement</label>
                            <input type="file" name="poster" accept="image/*" class="w-full border rounded px-3 py-2">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="certificated" name="certificated" class="border rounded">
                            <label for="certificated" class="text-gray-700">certificated</label>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="openEventModal = false" class="bg-gray-200 text-gray-700 px-6 py-2 rounded">Cancel</button>
                            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                Create Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Post Modal -->
            <div x-show="openPostModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50" style="z-index: 9999;">
                <div @click.away="openPostModal = false" class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative overflow-y-auto max-h-[90vh] z-50" style="z-index: 10000;">
                    <button @click="openPostModal = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
                    <h2 class="text-2xl font-bold mb-6">Create Post</h2>
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Title</label>
                            <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Club</label>
                            <select name="club_id" class="w-full border rounded px-3 py-2" required>
                                <option value="">Select club</option>
                                @foreach($clubs as $club)
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Image</label>
                            <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Content</label>
                            <textarea name="content" class="w-full border rounded px-3 py-2" rows="4" required></textarea>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="openPostModal = false" class="bg-gray-200 text-gray-700 px-6 py-2 rounded">Cancel</button>
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </aside>
    
    <!-- Main Content -->
    <div class="flex-1 p-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6 ">
            <h1 class="text-xl font-bold text-gray-800">Total Events 
                <span class="ml-2 px-2 py-1 rounded-full bg-purple-100 text-purple-700 text-sm font-semibold">
                    {{ $events->total() }} events
                </span>
            </h1>
                <a href="/admin/events/pdf" target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-download mr-2 text-xs"></i> Download PDF Report
                </a>
        </div>
        
        <!-- Search and Filter Section -->

            <div class="flex justify-between items-center mb-4">
                <div class="relative w-72">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" placeholder="Search by club, event name..." 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                </div>
                <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
        </div>
        
        <!-- Events Table -->
        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poster</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intervenant</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Certificated</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Club</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($events as $event)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($event->poster)
                                    <img src="{{ asset('storage/' . $event->poster) }}" alt="Poster" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $event->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $event->intervenant }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($event->certificated)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                                        <i class="fas fa-check-circle mr-1"></i> Yes
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">
                                        <i class="fas fa-times-circle mr-1"></i> No
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($event->status == 'completed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                                        <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span> Completed
                                    </span>
                                @elseif($event->status == 'pending')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-50 text-yellow-700">
                                        <span class="h-2 w-2 rounded-full bg-yellow-500 mr-2"></span> Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">
                                        <span class="h-2 w-2 rounded-full bg-red-500 mr-2"></span> Canceled
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                {{ $event->club->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                {{ $event->location }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700 font-medium">
                                {{ $event->datetime ? $event->datetime->format('d M Y H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                               
                                <div class="flex items-center justify-center space-x-2">
                                     <a href="{{ route('admin.events.show', $event->id) }}" class="text-gray-400 hover:text-blue-900 mr-2" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                    <a href="{{ route('admin.events.edit', $event->id) }}" 
                                       class="text-gray-400 hover:text-blue-600 transition-colors duration-200"
                                       title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                        
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure want to remove it ?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-gray-400 hover:text-red-600 transition-colors duration-200"
                                                title="Cancel">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                No events found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-6 py-4 border-t border-gray-200">
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
        </div>
    </div>


    </div>
</body>
</html>