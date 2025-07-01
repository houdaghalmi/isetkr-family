<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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
                    <a href="{{ route('admin.clubs.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                        <i class="fas fa-users mr-3"></i> Clubs
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.events.index') }}" class="flex items-center py-2 px-4 rounded bg-blue-100">
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
                        <i class="fas fa-envelope mr-3"></i> messages
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


 <div class="w-full max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-6 text-gray-800">Edit Event</h2>
    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                    <input type="text" name="title" 
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500"
                           value="{{ $event->title }}">
                    <span class="text-xs text-gray-500 float-right mt-1">{{ strlen($event->title) }}/30</span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Speaker</label>
                    <input type="text" name="intervenant" 
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500"
                           value="{{ $event->intervenant }}">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Responsible Club</label>
                    <select name="club_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}" {{ $event->club_id == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date & Time</label>
                    <input type="datetime-local" name="datetime" 
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500"
                           value="{{ $event->datetime ? $event->datetime->format('Y-m-d\TH:i') : '' }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" 
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500"
                           value="{{ $event->location }}" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                            <option value="pending" {{ $event->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $event->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="canceled" {{ $event->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>
<br>
                    <div class="flex items-center">
                        <input type="checkbox" id="certificated" name="certificated" 
                               class="h-4 w-4 border-gray-300 rounded focus:ring-purple-500" {{ $event->certificated ? 'checked' : '' }}>
                        <label for="certificated" class="ml-2 block text-sm text-gray-700">Certificated</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Width Fields -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" 
                          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">{{ $event->description }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Event Poster</label>
                <div class="flex items-center space-x-4">
                    @if($event->poster)
                        <img src="{{ asset('storage/' . $event->poster) }}" alt="Current Poster" class="w-20 h-20 rounded-md object-cover border border-gray-200">
                    @endif
                    <div class="flex-1">
                        <input type="file" name="poster" accept="image/*" 
                               class="w-full text-sm border border-gray-300 rounded-md file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4 flex justify-end border-t border-gray-200">
            <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-3">
                Cancel
            </button>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Save Changes
            </button>
        </div>
    </form>
</div>


    </div>
</body>
</html>
