<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stories - Student Posts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN for quick styling (remove if you use Laravel Mix/Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-50 text-gray-900">
@if(auth()->user()->role === 'club_responsible')
    @include('components.responsible-topbar')
@else
    @include('components.topbar')
@endif
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="text-sm text-purple-700 font-semibold mb-2">Our Event</div>
            <h1 class="text-4xl font-bold mb-2">Stories</h1>
            <p class="text-gray-500 mb-6">Missed it? Don’t worry  the recap’s here .</p>
        </div>
        <!-- Recent event posts -->
        <div class="mb-12">
            <h2 class="text-lg font-semibold mb-4">Recent Event Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($recentPosts as $post)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                        {{-- Image carousel --}}
                        @if($post->images && count($post->images) > 0)
                            <div class="w-full h-40 bg-gray-100 flex items-center justify-center relative" x-data="{ idx: 0, images: {{ json_encode($post->images) }} }">
                                <template x-if="images.length > 0">
                                    <img :src="'/storage/' + images[idx]" class="object-cover w-full h-40" alt="Post image">
                                </template>
                                <template x-if="images.length > 1">
                                    <button @click="idx = (idx === 0 ? images.length - 1 : idx - 1)" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-2 shadow hover:bg-opacity-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                                    </button>
                                </template>
                                <template x-if="images.length > 1">
                                    <button @click="idx = (idx === images.length - 1 ? 0 : idx + 1)" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-2 shadow hover:bg-opacity-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                                    </button>
                                </template>
                                <template x-if="images.length > 1">
                                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1">
                                        <template x-for="(img, i) in images" :key="i">
                                            <span :class="{'bg-blue-600': idx === i, 'bg-gray-300': idx !== i}" class="w-2 h-2 rounded-full block"></span>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                        <div class="p-4 flex-1 flex flex-col">
                            <div class="flex items-center text-xs text-gray-500 mb-2">
                                <span class="font-semibold text-purple-700">{{ $post->club->name ?? 'Club Name' }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $post->created_at->format('d M Y') }}</span>
                            </div>
                            <a href="#" class="font-bold text-lg mb-1 hover:text-purple-700 transition">{{ $post->title }}</a>
                            <p class="text-sm text-gray-600 mb-2 flex-1">{{ Str::limit($post->description, 80) }}</p>
                           
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- All event posts -->
        <div>
            <h2 class="text-lg font-semibold mb-4">All Event Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($allPosts as $post)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                        {{-- Image carousel --}}
                        @if($post->images && count($post->images) > 0)
                            <div class="w-full h-32 bg-gray-100 flex items-center justify-center relative" x-data="{ idx: 0, images: {{ json_encode($post->images) }} }">
                                <template x-if="images.length > 0">
                                    <img :src="'/storage/' + images[idx]" class="object-cover w-full h-32" alt="Post image">
                                </template>
                                <template x-if="images.length > 1">
                                    <button @click="idx = (idx === 0 ? images.length - 1 : idx - 1)" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-2 shadow hover:bg-opacity-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                                    </button>
                                </template>
                                <template x-if="images.length > 1">
                                    <button @click="idx = (idx === images.length - 1 ? 0 : idx + 1)" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-2 shadow hover:bg-opacity-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                                    </button>
                                </template>
                                <template x-if="images.length > 1">
                                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1">
                                        <template x-for="(img, i) in images" :key="i">
                                            <span :class="{'bg-blue-600': idx === i, 'bg-gray-300': idx !== i}" class="w-2 h-2 rounded-full block"></span>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        @else
                            <div class="w-full h-32 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                        <div class="p-4 flex-1 flex flex-col">
                            <div class="flex items-center text-xs text-gray-500 mb-2">
                                <span class="font-semibold text-purple-700">{{ $post->club->name ?? 'Club Name' }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $post->created_at->format('d M Y') }}</span>
                            </div>
                            <a href="#" class="font-bold text-base mb-1 hover:text-purple-700 transition">{{ $post->title }}</a>
                            <p class="text-sm text-gray-600 mb-2 flex-1">{{ Str::limit($post->description, 70) }}</p>
                           
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $allPosts->links() }}
            </div>
        </div>
    </div>
</body>
</html>
