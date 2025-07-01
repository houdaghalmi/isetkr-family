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
<div class="max-w-xl mx-auto py-10">
    <div class="bg-white rounded-xl shadow p-8">
        <h2 class="text-2xl font-bold mb-6">Edit Post</h2>
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" x-data="{ images: {{ json_encode($post->images ?? []) }} }">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Content</label>
                <textarea name="content" class="w-full border rounded px-3 py-2" rows="4" required>{{ old('content', $post->content) }}</textarea>
            </div>
            <div class="mb-4" x-data>
                <label class="block text-gray-700 font-semibold mb-2">Current Images</label>
                <div class="flex flex-wrap gap-4 mb-2">
                    <template x-for="(img, i) in images" :key="i">
                        <div class="relative w-24 h-24">
                            <img :src="'/storage/' + img" class="w-24 h-24 object-cover rounded">
                            <button type="button" @click="images.splice(i, 1)" class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center"><i class="fas fa-times"></i></button>
                            <input type="hidden" name="keep_images[]" :value="img">
                        </div>
                    </template>
                    <template x-if="images.length === 0">
                        <span class="text-gray-400">No images</span>
                    </template>
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Add Images</label>
                <input type="file" name="images[]" multiple accept="image/*" class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.posts.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Post</button>
            </div>
        </form>
    </div>
</div>
    </div>
</body>
</html>
