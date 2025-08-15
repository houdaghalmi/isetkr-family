<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Event - Responsible</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900">
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-purple-800">Create Event</h1>
            <a href="{{ route('responsible.events.index') }}" 
               class="text-gray-600 hover:text-gray-800 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('responsible.events.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Event Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Event Title *
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                               required>
                    </div>

                    <!-- Speaker -->
                    <div>
                        <label for="intervenant" class="block text-sm font-medium text-gray-700 mb-2">
                            Speaker *
                        </label>
                        <input type="text" 
                               id="intervenant" 
                               name="intervenant" 
                               value="{{ old('intervenant') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                               required>
                    </div>

                    <!-- Club -->
                    <div>
                        <label for="club_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Responsible Club *
                        </label>
                        <select id="club_id" 
                                name="club_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                                required>
                            <option value="">Select a club</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}" 
                                        {{ old('club_id') == $club->id ? 'selected' : '' }}>
                                    {{ $club->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date & Time -->
                    <div>
                        <label for="datetime" class="block text-sm font-medium text-gray-700 mb-2">
                            Date & Time *
                        </label>
                        <input type="datetime-local" 
                               id="datetime" 
                               name="datetime" 
                               value="{{ old('datetime') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                               required>
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            Location *
                        </label>
                        <input type="text" 
                               id="location" 
                               name="location" 
                               value="{{ old('location') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                               required>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description *
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                                  required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Poster -->
                    <div class="md:col-span-2">
                        <label for="poster" class="block text-sm font-medium text-gray-700 mb-2">
                            Event Poster
                        </label>
                        <input type="file" 
                               id="poster" 
                               name="poster" 
                               accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <p class="text-sm text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF (max 2MB)</p>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('responsible.events.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition">
                        Create Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
