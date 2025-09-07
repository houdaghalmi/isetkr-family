<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Event - Responsible</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: "#2d3480",
            secondary: "#3d4490",
            accent: "#f59e0b",
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
<div class="container mx-auto px-4 py-8">
  <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg border border-gray-200">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8 bg-gradient-to-r from-primary to-secondary p-6 rounded-t-xl">
      <h1 class="text-2xl font-bold text-white">Create Event</h1>
      <a href="{{ route('responsible.events.index') }}"
         class="flex items-center text-accent font-medium">
        <i class="fas fa-arrow-left mr-2"></i> Back
      </a>
    </div>

    <div class="p-6">
      <!-- Error Messages -->
      @if($errors->any())
      <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <!-- Form -->
      <form action="{{ route('responsible.events.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @csrf

        <!-- Left (Form Fields) -->
        <div class="md:col-span-2 space-y-6">
          <!-- Event Title -->
          <div>
            <label for="title" class="block text-sm font-semibold text-primary mb-2">Event Title *</label>
            <input type="text"
                   id="title"
                   name="title"
                   value="{{ old('title') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent"
                   required>
          </div>

          <!-- Speaker + Club -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="intervenant" class="block text-sm font-semibold text-primary mb-2">Speaker *</label>
              <input type="text"
                     id="intervenant"
                     name="intervenant"
                     value="{{ old('intervenant') }}"
                     class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent"
                     required>
            </div>
            <div>
              <label for="club_id" class="block text-sm font-semibold text-primary mb-2">Responsible Club *</label>
              <select id="club_id" name="club_id"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent"
                      required>
                <option value="">Select a club</option>
                @foreach($clubs as $club)
                  <option value="{{ $club->id }}" {{ old('club_id') == $club->id ? 'selected' : '' }}>
                    {{ $club->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- Date + Location -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="datetime" class="block text-sm font-semibold text-primary mb-2">Date & Time *</label>
              <input type="datetime-local"
                     id="datetime"
                     name="datetime"
                     value="{{ old('datetime') }}"
                     class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent"
                     required>
            </div>
            <div>
              <label for="location" class="block text-sm font-semibold text-primary mb-2">Location *</label>
              <input type="text"
                     id="location"
                     name="location"
                     value="{{ old('location') }}"
                     class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent"
                     required>
            </div>
          </div>

          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-semibold text-primary mb-2">Description *</label>
            <textarea id="description"
                      name="description"
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent"
                      required>{{ old('description') }}</textarea>
          </div>

          <!-- Actions -->
          <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('responsible.events.index') }}"
               class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
              Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-accent text-white font-semibold rounded-md hover:bg-yellow-600 transition">
              Create Event
            </button>
          </div>
        </div>

        <!-- Right (Poster Upload + Preview) -->
        <div>
          <label for="poster" class="block text-sm font-semibold text-primary mb-2">Event Poster</label>
          <img id="posterPreview"
               src="https://via.placeholder.com/300x400?text=Preview+Poster"
               alt="Poster Preview"
               class="w-full h-auto rounded-lg border mb-4 shadow-sm hidden">
          <input type="file"
                 id="poster"
                 name="poster"
                 accept="image/*"
                 class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent"
                 onchange="previewPoster(event)">
          <p class="text-sm text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF (max 2MB)</p>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function previewPoster(event) {
    const [file] = event.target.files;
    if (file) {
      const preview = document.getElementById('posterPreview');
      preview.src = URL.createObjectURL(file);
      preview.classList.remove('hidden');
    }
  }
</script>
</body>
</html>
