<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Posts - Responsible</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .slide-container {
            position: relative;
            overflow: hidden;
        }
        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .slide.active {
            opacity: 1;
            position: absolute;
            inset: 0;
        }
        .dots {
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 6px;
        }
        .dots button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: none;
            background-color: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .dots button.active {
            background-color: #fff;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    @include('components.responsible-topbar')

    <div class="max-w-7xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-purple-100 border border-purple-400 text-purple-700 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold text-purple-800">My Posts</h1>
            <a href="{{ route('responsible.posts.create') }}" 
               class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition shadow-lg">
                <i class="fas fa-plus mr-2"></i>Create Post
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="slide-container h-64 bg-gray-200 relative" data-post-id="{{ $post->id }}">
                        @if($post->images && count($post->images) > 0)
                            @foreach($post->images as $index => $image)
                                <div class="slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                         alt="Post image {{ $index + 1 }}" 
                                         class="w-full h-full object-cover">
                                </div>
                            @endforeach
                            
                            @if(count($post->images) > 1)
                                <button class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition"
                                        onclick="changeSlide('{{ $post->id }}', -1)">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition"
                                        onclick="changeSlide('{{ $post->id }}', 1)">
                                    <i class="fas fa-chevron-right"></i>
                                </button>

                                <div class="dots">
                                    @foreach($post->images as $index => $image)
                                        <button class="{{ $index === 0 ? 'active' : '' }}" 
                                                onclick="goToSlide('{{ $post->id }}', '{{ $index }}')"></button>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <div class="flex items-center justify-center h-full">
                                <i class="fas fa-image text-6xl text-gray-300"></i>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <img src="{{ $post->club && $post->club->logo ? asset('storage/' . $post->club->logo) : asset('images/isetlink.jpg') }}" 
                                 alt="Club Logo" 
                                 class="h-8 w-8 rounded-full object-cover border border-gray-200">
                            <span class="text-sm font-semibold text-purple-600">{{ $post->club->name ?? 'Club Name' }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">{{ $post->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($post->content, 120) }}</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <span><i class="fas fa-calendar mr-1"></i>{{ $post->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('responsible.posts.edit', $post->id) }}" 
                               class="flex-1 bg-purple-100 text-purple-700 py-2 px-4 rounded-lg hover:bg-purple-200 transition text-center font-medium">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </a>
                            <form action="{{ route('responsible.posts.destroy', $post->id) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.');"
                                  class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-red-100 text-red-700 py-2 px-4 rounded-lg hover:bg-red-200 transition font-medium">
                                    <i class="fas fa-trash mr-2"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <i class="fas fa-newspaper text-6xl text-purple-300 mb-6"></i>
                    <h3 class="text-2xl font-medium text-gray-600 mb-3">No Posts Found</h3>
                    <p class="text-gray-500 mb-6">You haven't created any posts yet. Start sharing your club's activities!</p>
                    <a href="{{ route('responsible.posts.create') }}" 
                       class="inline-block bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition shadow-lg">
                        <i class="fas fa-plus mr-2"></i>Create Your First Post
                    </a>
                </div>
            @endforelse
        </div>

        @if($posts->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    <script>
        function changeSlide(postId, direction) {
            const container = document.querySelector(`[data-post-id="${postId}"]`);
            if (!container) return;

            const slides = container.querySelectorAll('.slide');
            const activeSlide = container.querySelector('.slide.active');
            let currentIndex = parseInt(activeSlide.dataset.slide);
            let newIndex = (currentIndex + direction + slides.length) % slides.length;

            slides[currentIndex].classList.remove('active');
            slides[newIndex].classList.add('active');

            const dots = container.querySelectorAll('.dots button');
            if (dots.length) {
                dots.forEach((dot, i) => dot.classList.toggle('active', i === newIndex));
            }
        }

        function goToSlide(postId, slideIndex) {
            const container = document.querySelector(`[data-post-id="${postId}"]`);
            if (!container) return;

            const slides = container.querySelectorAll('.slide');
            const index = parseInt(slideIndex); // convert string to number
            slides.forEach((slide, i) => slide.classList.toggle('active', i === index));

            const dots = container.querySelectorAll('.dots button');
            if (dots.length) {
                dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
            }
        }

        setInterval(() => {
            document.querySelectorAll('.slide-container').forEach(container => {
                const slides = container.querySelectorAll('.slide');
                if (slides.length > 1) {
                    const activeSlide = container.querySelector('.slide.active');
                    let currentIndex = parseInt(activeSlide.dataset.slide);
                    let nextIndex = (currentIndex + 1) % slides.length;

                    slides[currentIndex].classList.remove('active');
                    slides[nextIndex].classList.add('active');

                    const dots = container.querySelectorAll('.dots button');
                    if (dots.length) {
                        dots.forEach((dot, i) => dot.classList.toggle('active', i === nextIndex));
                    }
                }
            });
        }, 5000);
    </script>
</body>
</html>
