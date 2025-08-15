<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event - Responsible</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-50 min-h-screen">
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-primary">Edit Event</h1>
            <a href="{{ route('responsible.events.index') }}" 
               class="text-primary hover:text-primary-dark flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('responsible.events.update', $event->id) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @csrf
            @method('PUT')

            <!-- Form Fields -->
            <div class="md:col-span-2 space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Event Title *
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $event->title) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                           required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="intervenant" class="block text-sm font-medium text-gray-700 mb-2">
                            Speaker *
                        </label>
                        <input type="text" 
                               id="intervenant" 
                               name="intervenant" 
                               value="{{ old('intervenant', $event->intervenant) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                               required>
                    </div>

                    <div>
                        <label for="club_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Responsible Club *
                        </label>
                        <select id="club_id" 
                                name="club_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                                required>
                            <option value="">Select a club</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}" 
                                        {{ old('club_id', $event->club_id) == $club->id ? 'selected' : '' }}>
                                    {{ $club->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="datetime" class="block text-sm font-medium text-gray-700 mb-2">
                            Date & Time *
                        </label>
                        <input type="datetime-local" 
                               id="datetime" 
                               name="datetime" 
                               value="{{ old('datetime', $event->datetime ? $event->datetime->format('Y-m-d\TH:i') : '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                               required>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            Location *
                        </label>
                        <input type="text" 
                               id="location" 
                               name="location" 
                               value="{{ old('location', $event->location) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                               required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>
                        <select id="status" 
                                name="status" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="pending" {{ old('status', $event->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="canceled" {{ old('status', $event->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>

                    <div class="flex items-center mt-6">
                        <input type="checkbox" 
                               id="certificated" 
                               name="certificated" 
                               value="1"
                               {{ old('certificated', $event->certificated) ? 'checked' : '' }}
                               class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="certificated" class="ml-2 block text-sm text-gray-700">
                            Certified Event
                        </label>
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description *
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                              required>{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('responsible.events.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition">
                        Update
                    </button>
                </div>
            </div>

            <!-- Poster Preview -->
            <div>
                <label for="poster" class="block text-sm font-medium text-gray-700 mb-2">
                    Event Poster
                </label>

                <img id="posterPreview" 
                     src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://via.placeholder.com/300x400?text=No+Poster' }}" 
                     alt="Event Poster" 
                     class="w-full h-auto rounded-lg border mb-4">

                <input type="file" 
                       id="poster" 
                       name="poster" 
                       accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                       onchange="previewPoster(event)">
                <p class="text-sm text-gray-500 mt-1">Leave empty to keep the current poster</p>
            </div>
        </form>
    </div>
</div>

<script>
    function previewPoster(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('posterPreview').src = URL.createObjectURL(file);
        }
    }
</script>
</body>
</html>
