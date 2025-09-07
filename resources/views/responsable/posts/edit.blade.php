<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post - Responsible</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2d3480',
                        secondary: '#3d4490',
                        accent: '#f59e0b'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">

<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg border border-gray-200">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8 bg-gradient-to-r from-primary to-secondary p-6 rounded-t-xl">
            <h1 class="text-2xl font-bold text-white">Edit Post</h1>
            <a href="{{ route('responsible.posts.index') }}" class="flex items-center text-accent font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>

        <div class="p-6">
            <!-- Flash Messages -->
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

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
            <form action="{{ route('responsible.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
                  class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @csrf
                @method('PUT')

                <!-- Left (Form Fields) -->
                <div class="md:col-span-3 space-y-6">
                    <!-- Club -->
                    <div>
                        <label for="club_id" class="block text-sm font-semibold text-primary mb-2">Select Club *</label>
                        <select id="club_id" name="club_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent">
                            <option value="">Select a club...</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}" {{ old('club_id', $post->club_id) == $club->id ? 'selected' : '' }}>
                                    {{ $club->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('club_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-primary mb-2">Post Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent">
                        @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-primary mb-2">Content *</label>
                        <textarea id="content" name="content" rows="6" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-accent focus:border-accent resize-none">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Images -->
                    @if($post->images && count($post->images) > 0)
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Current Images</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($post->images as $index => $image)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $image) }}" 
                                     class="w-full h-32 object-cover rounded-md border border-gray-200">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center rounded-md">
                                    <button type="button" onclick="removeCurrentImage('{{ $index }}')"
                                            class="bg-red-500 text-white w-8 h-8 flex items-center justify-center rounded-full hover:bg-red-600">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </div>
                                <input type="hidden" name="current_images[]" value="{{ $image }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- New Images -->
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Add New Images</label>
                        <input type="file" id="newImages" name="new_images[]" multiple accept="image/*" class="hidden" onchange="previewNewImages(this)">
                        <button type="button" onclick="document.getElementById('newImages').click()"
                                class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-800 transition">
                            Choose Images
                        </button>
                        <div id="newImagePreview" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4"></div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('responsible.posts.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-accent text-white font-semibold rounded-md hover:bg-yellow-600 transition">
                            Update
                        </button>
                    </div>
                </div>

           

            </form>
        </div>
    </div>
</div>

<script>
    function previewNewImages(input) {
        const preview = document.getElementById('newImagePreview');
        preview.innerHTML = '';
        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-32 object-cover rounded-md border border-gray-200">
                                     <button type="button" onclick="removeNewImage(${index})"
                                             class="absolute top-2 right-2 bg-red-500 text-white w-6 h-6 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100">
                                             <i class="fas fa-times text-xs"></i>
                                     </button>`;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    function removeNewImage(index) {
        const input = document.getElementById('newImages');
        const dt = new DataTransfer();
        Array.from(input.files).forEach((file, i) => { if(i != index) dt.items.add(file) });
        input.files = dt.files;
        previewNewImages(input);
    }

    function removeCurrentImage(index) {
        const currentImages = document.querySelectorAll('input[name="current_images[]"]');
        if(currentImages[index]) currentImages[index].parentElement.remove();
    }
</script>

</body>
</html>
