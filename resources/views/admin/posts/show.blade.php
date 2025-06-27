<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
<div class="max-w-2xl mx-auto py-10">
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <!-- Image slider -->
        @if($post->images && count($post->images) > 0)
            <div class="w-full h-64 bg-gray-100 flex items-center justify-center relative" x-data="{ idx: 0, images: {{ json_encode($post->images) }} }">
                <template x-if="images.length > 0">
                    <img :src="'/storage/' + images[idx]" class="object-cover w-full h-64" alt="Post image">
                </template>
                <template x-if="images.length > 1">
                    <button @click="idx = (idx === 0 ? images.length - 1 : idx - 1)" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-2 shadow hover:bg-opacity-100">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </template>
                <template x-if="images.length > 1">
                    <button @click="idx = (idx === images.length - 1 ? 0 : idx + 1)" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-2 shadow hover:bg-opacity-100">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </template>
                <template x-if="images.length > 1">
                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1">
                        <template x-for="(img, i) in images" :key="i">
                            <span :class="{'bg-blue-600': idx === i, 'bg-gray-300': idx !== i}" class="w-2 h-2 rounded-full block" :style="'background-color:' + (idx === i ? '#2563eb' : '#d1d5db')"></span>
                        </template>
                    </div>
                </template>
            </div>
        @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
        @endif
        <div class="p-8">
            <div class="flex items-center gap-2 mb-4">
                <img src="{{ $post->club->logo ? asset('storage/'.$post->club->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($post->club->name) }}" class="w-8 h-8 rounded-full mr-2">
                <span class="text-blue-700 font-semibold">{{ $post->club->name }}</span>
                <span class="text-gray-400 text-sm">• {{ $post->created_at->format('d M Y') }}</span>
            </div>
            <h1 class="text-2xl font-bold mb-2">{{ $post->title }}</h1>
            <p class="text-gray-600 mb-6">{{ $post->content }}</p>
            <div>
                <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-blue-600 hover:underline"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg> Back to posts</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
