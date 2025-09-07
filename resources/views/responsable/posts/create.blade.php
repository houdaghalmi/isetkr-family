<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post - Responsible</title>
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
<body class="bg-gray-50 min-h-screen text-gray-900">
    @include('components.responsible-topbar')

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg border border-gray-200">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8 bg-gradient-to-r from-primary to-secondary p-6 rounded-t-xl">
                <div>
                    <h1 class="text-2xl font-bold text-white">Create New Post</h1>
                    <p class="text-white/80 mt-1 text-sm">Share your club's activities and updates with the community</p>
                </div>
                <a href="{{ route('responsible.posts.index') }}" class="flex items-center text-accent font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Posts
                </a>
            </div>

            <!-- Form -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2 space-y-6">
                    <form action="{{ route('responsible.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Club Selection -->
                        <div>
                            <label for="club_id" class="block text-sm font-semibold text-primary mb-2">Select Club *</label>
                            <select id="club_id" name="club_id" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent">
                                <option value="">Choose a club...</option>
                                @foreach($clubs as $club)
                                    <option value="{{ $club->id }}" {{ old('club_id') == $club->id ? 'selected' : '' }}>
                                        {{ $club->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-primary mb-2">Post Title *</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent"
                                   placeholder="Enter an engaging title for your post">
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-semibold text-primary mb-2">Post Content *</label>
                            <textarea id="content" name="content" rows="6" required
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent resize-none"
                                      placeholder="Write your post content here...">{{ old('content') }}</textarea>
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-semibold text-primary mb-2">Add Images</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-accent transition">
                                <div class="space-y-4">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium text-primary">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB each</p>
                                    <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden" onchange="previewImages(this)">
                                    <button type="button" onclick="document.getElementById('images').click()"
                                            class="bg-primary text-white px-6 py-2 rounded-md hover:bg-blue-800 transition">
                                        Choose Images
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('responsible.posts.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Cancel</a>
                            <button type="submit" class="px-8 py-3 bg-accent text-white font-semibold rounded-md hover:bg-yellow-700 transition">
                                <i class="fas fa-paper-plane mr-2"></i>Create Post
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right: Images Preview -->
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Images Preview</label>
                    <div id="imagePreview" class="grid grid-cols-2 md:grid-cols-1 gap-4"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImages(input) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}" 
                                 class="w-full h-48 object-cover rounded-md border border-gray-200">
                            <button type="button" onclick="removeImage(${index})"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

        function removeImage(index) {
            const input = document.getElementById('images');
            const dt = new DataTransfer();
            Array.from(input.files).forEach((file, i) => {
                if (i !== index) dt.items.add(file);
            });
            input.files = dt.files;
            previewImages(input);
        }
    </script>
</body>
</html>
