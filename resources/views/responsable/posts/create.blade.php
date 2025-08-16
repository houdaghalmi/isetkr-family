<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post - Responsible</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900">
    @include('components.responsible-topbar')

    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-purple-800">Create New Post</h1>
                <p class="text-gray-600 mt-2">Share your club's activities and updates with the community</p>
            </div>
            <a href="{{ route('responsible.posts.index') }}" 
               class="text-purple-600 hover:text-purple-700 px-4 py-2 border border-purple-200 rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>Back to Posts
            </a>
        </div>

        <!-- Create Post Form -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('responsible.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Club Selection -->
                <div class="mb-6">
                    <label for="club_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-users mr-2 text-purple-600"></i>Select Club
                    </label>
                    <select id="club_id" name="club_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                        <option value="">Choose a club...</option>
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}" {{ old('club_id') == $club->id ? 'selected' : '' }}>
                                {{ $club->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('club_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-heading mr-2 text-purple-600"></i>Post Title
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                           placeholder="Enter an engaging title for your post">
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left mr-2 text-purple-600"></i>Post Content
                    </label>
                    <textarea id="content" name="content" rows="6" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition resize-none"
                              placeholder="Write your post content here...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-images mr-2 text-purple-600"></i>Post Images
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-purple-400 transition">
                        <div class="space-y-4">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                            <div>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium text-purple-600">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB each</p>
                            </div>
                            <input type="file" id="images" name="images[]" multiple accept="image/*"
                                   class="hidden" onchange="previewImages(this)">
                            <button type="button" onclick="document.getElementById('images').click()"
                                    class="bg-purple-100 text-purple-700 px-6 py-2 rounded-lg hover:bg-purple-200 transition">
                                Choose Images
                            </button>
                        </div>
                    </div>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4" style="display:none;">
                        <!-- Preview images will be inserted here -->
                    </div>
                    
                    @error('images')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('responsible.posts.index') }}" 
                       class="px-6 py-3 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i>Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImages(input) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                preview.style.display = 'grid';
                
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}" 
                                 class="w-full h-32 object-cover rounded-lg border border-gray-200">
                            <button type="button" onclick="removeImage(${index})" 
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                preview.style.display = 'none';
            }
        }

        function removeImage(index) {
            const input = document.getElementById('images');
            const dt = new DataTransfer();
            
            Array.from(input.files).forEach((file, i) => {
                if (i !== index) {
                    dt.items.add(file);
                }
            });
            
            input.files = dt.files;
            previewImages(input);
        }
    </script>
</body>
</html>
