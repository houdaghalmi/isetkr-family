<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">

     <!-- Sidebar (reuse from index page) -->
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
                    <a href="{{ route('admin.events.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                        <i class="fas fa-calendar-alt mr-3"></i> Events
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.index') }}" class="flex items-center py-2 px-4 rounded bg-blue-100">
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
<div class="w-full bg-white p-8 rounded-lg shadow-sm">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Post</h2>
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" x-data="{ images: {{ json_encode($post->images ?? []) }} }" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-s font-medium text-gray-600 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" 
                   class="w-full text-m border border-gray-300 rounded px-4 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500" required>
        </div>

        <div>
            <label class="block text-s font-medium text-gray-600 mb-1">Content</label>
            <textarea name="content" rows="3" 
                      class="w-full text-m border border-gray-300 rounded px-3 py-1.5 focus:ring-1 focus:ring-purple-500 focus:border-purple-500" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div x-data>
            <label class="block text-s font-medium text-gray-600 mb-1">Current Images</label>
            <div class="flex flex-wrap gap-2 mb-2">
                <template x-for="(img, i) in images" :key="i">
                    <div class="relative w-20 h-20">
                        <img :src="'/storage/' + img" class="w-20 h-20 object-cover rounded border border-gray-200">
                        <button type="button" @click="images.splice(i, 1)" 
                                class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-s">
                            <i class="fas fa-times"></i>
                        </button>
                        <input type="hidden" name="keep_images[]" :value="img">
                    </div>
                </template>
                <template x-if="images.length === 0">
                    <span class="text-s text-gray-400">No images</span>
                </template>
            </div>
        </div>

        <div>
            <label class="block text-s font-medium text-gray-600 mb-1">Add Images</label>
            <input type="file" name="images[]" multiple accept="image/*" 
                   class="w-full text-s border border-gray-300 rounded file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-s file:font-medium file:bg-gray-50 file:text-gray-600 hover:file:bg-gray-100">
        </div>

        <div class="pt-3 flex justify-end border-t border-gray-100">
            <a href="{{ route('admin.posts.index') }}" 
               class="px-3 py-1.5 text-m font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50 mr-2">
                Cancel
            </a>
            <button type="submit" 
                    class="px-3 py-1.5 bg-purple-600 text-white text-m font-medium rounded hover:bg-purple-700 focus:outline-none focus:ring-1 focus:ring-blue-500">
                Update Post
            </button>
        </div>
    </form>
</div>
    </div>
</body>
</html>
