<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 h-screen sticky top-0 overflow-y-auto">
        <nav class="p-4" x-data="{ open: { clubs: true, events: false, posts: true, messages: false, users: false }, openEventModal: false, openClubModal: false, openPostModal: false }">
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
                        <li><a href="{{ route('admin.events.index') }}" class="block py-1 px-2 rounded hover:bg-blue-100">View List</a></li>
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
                        <li><a href="{{ route('admin.posts.index') }}" class="block py-1 px-2 rounded hover:bg-blue-100 text-blue-700 font-semibold">View List</a></li>
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
                        <li><a href="{{route('admin.messages.index')}}" class="block py-1 px-2 rounded hover:bg-blue-100">View List</a></li>
                    </ul>
                </li>
                <!-- Users -->
                <li>
                    <button @click="open.users = !open.users" class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-gray-100 focus:outline-none">
                        <span class="flex items-center"><i class="fas fa-user mr-3"></i> Users</span>
                        <svg :class="{'rotate-90': open.users}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                    <ul x-show="open.users" class="ml-8 mt-1 space-y-1" x-cloak>
                        <li><a href="{{route('admin.users.index')}}" class="block py-1 px-2 rounded hover:bg-blue-100">View List</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Club Modal -->
            <div x-show="openClubModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                <div @click.away="openClubModal = false" class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative overflow-y-auto max-h-[90vh]">
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
            <!-- Event Modal -->
            <div x-show="openEventModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                <div @click.away="openEventModal = false" class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative overflow-y-auto max-h-[90vh]">
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
            <div x-show="openPostModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                <div @click.away="openPostModal = false" class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative overflow-y-auto max-h-[90vh]">
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
<!--Main content-->
    <div class="flex-1 p-8">
        <div class="mb-4 flex items-center gap-4">
            <span class="text-lg font-semibold">total posts <span class="bg-purple-100 text-purple-700 rounded px-2 py-1 text-xs ml-1">{{ $posts->total() }} posts</span></span>
            <div class="ml-auto flex gap-2">
                <input type="text" placeholder="Search by club, post title ..." class="border rounded px-3 py-2 w-64">
                <button class="border px-3 py-2 rounded bg-white flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18"/></svg> Filter</button>
            </div>
        </div>
        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Club</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($posts as $post)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $post->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ Str::limit($post->content, 60) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $post->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->user ? $post->user->nom : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->club ? $post->club->name : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a href="{{ route('admin.posts.show', $post) }}" class=" text-gray-400  hover:text-blue-600 mr-2" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-gray-400 hover:text-purple-600 mr-3" title="Edit"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500" title="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
</body>
</html>
