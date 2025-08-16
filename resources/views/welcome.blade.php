<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>IsetLink - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- FullCalendar CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        :root {
            --primary: #2d3480;
            --primary-dark: #1e2456;
            --primary-light: #3d4490;
            --accent: #c4e9ec;
            --accent-dark: #a8d5d9;
            --accent-light: #e1f4f6;
            --secondary: #f59e0b;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-900: #0f172a;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
        }

        .fc-event {
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 8px;
            border: none;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        }

        .fc-event:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 52, 128, 0.3);
        }

        #eventModal {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        #eventModal.active {
            opacity: 1;
            visibility: visible;
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 50%, var(--primary-light) 100%);
            position: relative;
            overflow: hidden;
        }

        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            z-index: 1;
        }

        .gradient-bg>* {
            position: relative;
            z-index: 2;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            transition: all 0.3s ease;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.025em;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 52, 128, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            color: var(--primary);
            transition: all 0.3s ease;
            border-radius: 12px;
            font-weight: 600;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, var(--accent-dark) 0%, var(--accent) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(196, 233, 236, 0.4);
        }

        .card-hover {
            transition: all 0.3s ease;
            border-radius: 16px;
            border: 1px solid rgba(196, 233, 236, 0.3);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--accent);
        }

        .text-accent {
            color: var(--accent-dark);
        }

        .bg-accent {
            background: linear-gradient(135deg, var(--accent-light) 0%, var(--accent) 100%);
        }

        .text-primary {
            color: var(--primary);
        }

        .bg-primary {
            background: var(--primary);
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 50%;
            background: var(--primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .section-title {
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
            border-radius: 2px;
        }

        .club-card {
            transition: all 0.3s ease;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(196, 233, 236, 0.1) 100%);
            border: 1px solid rgba(196, 233, 236, 0.3);
        }

        .club-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 30px rgba(45, 52, 128, 0.15);
            border-color: var(--primary);
        }

        .news-card {
            border-radius: 16px;
            overflow: hidden;
            background: white;
            border: 1px solid rgba(196, 233, 236, 0.3);
            transition: all 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--accent);
        }

        .contact-form {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(196, 233, 236, 0.05) 100%);
            border: 1px solid rgba(196, 233, 236, 0.3);
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .form-input {
            border: 2px solid rgba(196, 233, 236, 0.3);
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(45, 52, 128, 0.1);
            background: white;
        }

        .footer-bg {
            background: linear-gradient(135deg, var(--gray-900) 0%, #1e293b 100%);
        }

        .social-icon {
            transition: all 0.3s ease;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(196, 233, 236, 0.1);
        }

        .social-icon:hover {
            background: var(--accent);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased">
    <!-- Navigation Bar -->
    <nav class="bg-white/95 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo and Brand -->
                <div class="flex items-center space-x-4">
                    <img src="/images/isetlink.jpg" alt="IsetLink" class="h-full w-32 ">
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Home</a>
                    <a href="#events" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Events</a>
                    <a href="#clubs" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Clubs</a>
                    <a href="#news" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Posts</a>
                    <a href="#contact" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Contact</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'club_responsible' ? route('responsible.dashboard') : route('student.dashboard')) }}" class="btn-primary text-white px-6 py-2 rounded-full font-medium">Dashboard</a>
                    @else
                    <a href="/login" class="text-gray-700 hover:text-blue-600 font-medium transition-colors hidden md:block">Login</a>
                    <a href="/register" class="hidden md:block btn-primary text-white px-6 py-2 rounded-full font-medium">Register</a>
                    @endauth

                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none p-2 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 border-t border-gray-100 mt-4">
                <div class="flex flex-col space-y-4 pt-4">
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors py-2">Home</a>
                    <a href="#events" class="text-gray-700 hover:text-blue-600 font-medium transition-colors py-2">Events</a>
                    <a href="#clubs" class="text-gray-700 hover:text-blue-600 font-medium transition-colors py-2">Clubs</a>
                    <a href="#news" class="text-gray-700 hover:text-blue-600 font-medium transition-colors py-2">News</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium transition-colors py-2">Contact</a>
                    <div class="border-t border-gray-200 pt-4 flex flex-col space-y-3">
                        @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'club_responsible' ? route('responsible.dashboard') : route('student.dashboard')) }}" class="btn-primary text-white px-6 py-3 rounded-full font-medium text-center">Dashboard</a>
                        @else
                        <a href="/login" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Login</a>
                        <a href="/register" class="btn-primary text-white px-6 py-3 rounded-full font-medium text-center">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="gradient-bg text-white py-20 min-h-[80vh] flex items-center">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 animate-fade-in">
                    <h1 class="text-5xl lg:text-7xl font-bold mb-6 leading-tight">
                        Live the
                        <span class="bg-gradient-to-r from-cyan-200 to-blue-200 bg-clip-text text-transparent">ISET Kairouan</span>
                        experience
                    </h1>

                    <p class="text-xl lg:text-2xl mb-8 opacity-90 leading-relaxed">
                        join student clubs, take part in unforgettable events, and craft stories worth remembering from your student life.e.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 mt-6">
                        <!-- Explore Events Button -->
                        <a href="#events"
                            class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-8 py-4 rounded-full text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Explore Events
                        </a>

                        <!-- Join Now Button -->
                        <a href="{{ auth()->check() ? (auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'club_responsible' ? route('responsible.dashboard') : route('student.dashboard'))) : route('login') }}"
                            class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-4 rounded-full text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-user-plus mr-2"></i>
                            {{ auth()->check() ? 'Go to Dashboard' : 'Join Now' }}
                        </a>



                    </div>

                </div>

                <div class="lg:w-1/2 flex justify-center animate-slide-up">
                    <div class="relative w-full max-w-md">
                        <div class="hero-card p-8 shadow-2xl">
                            <h3 class="text-2xl font-bold mb-6 flex items-center">
                                Next Event
                            </h3>
                            <div class="flex items-center justify-between mb-6 text-sm">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar-day text-cyan-200"></i>
                                    <span id="nextEventDate" class="font-medium">Loading...</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-map-marker-alt text-cyan-200"></i>
                                    <span id="nextEventLocation" class="font-medium">Loading...</span>
                                </div>
                            </div>
                            <h4 id="nextEventTitle" class="text-2xl font-bold mb-6">Loading event...</h4>
                            <div class="mb-6">
                                <div class="text-sm mb-3 opacity-90">Time remaining:</div>
                                <div class="grid grid-cols-4 gap-3" id="countdown">
                                    <div class="countdown-item px-3 py-4 text-center">
                                        <div id="days" class="font-bold text-2xl">0</div>
                                        <div class="text-xs opacity-80">Days</div>
                                    </div>
                                    <div class="countdown-item px-3 py-4 text-center">
                                        <div id="hours" class="font-bold text-2xl">0</div>
                                        <div class="text-xs opacity-80">Hours</div>
                                    </div>
                                    <div class="countdown-item px-3 py-4 text-center">
                                        <div id="minutes" class="font-bold text-2xl">0</div>
                                        <div class="text-xs opacity-80">Mins</div>
                                    </div>
                                    <div class="countdown-item px-3 py-4 text-center">
                                        <div id="seconds" class="font-bold text-2xl">0</div>
                                        <div class="text-xs opacity-80">Secs</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-16">
        <!-- Upcoming Events Section -->
        <section id="events" class="mb-20">
            <div class="flex justify-between items-center mb-12">
                <h2 class="section-title text-4xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-calendar-alt text-blue-600 mr-4 text-3xl"></i>
                    Upcoming Events
                </h2>
                <a href="{{ route('student.events.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center text-lg group">
                    View All
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                <div class="card-hover overflow-hidden">
                    @if($event->poster)
                    <div class="h-56 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $event->poster) }}" alt="Event poster" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        @if($event->certificated)
                        <div class="absolute top-4 right-4 bg-gradient-to-r from-yellow-400 to-orange-400 text-white text-xs px-3 py-2 rounded-full flex items-center shadow-lg font-semibold">
                            <i class="fas fa-certificate mr-1"></i>
                            Certificated
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-sm text-blue-600 font-semibold bg-blue-50 px-3 py-1 rounded-full">
                                    {{ \Carbon\Carbon::parse($event->datetime)->format('d M Y, h:i A') }}
                                </span>
                                <h3 class="text-xl font-bold text-gray-800 mt-3 leading-tight">{{ $event->title }}</h3>
                            </div>
                            @if($event->club && $event->club->logo)
                            <img src="{{ asset('storage/' . $event->club->logo) }}"
                                alt="Club logo"
                                class="w-12 h-12 rounded-full border-3 border-white shadow-lg">
                            @endif
                        </div>

                        <p class="text-gray-600 mb-4 flex items-center">
                            <i class="fas fa-user-tie text-blue-600 mr-3"></i>
                            <span class="font-medium">{{ $event->intervenant }}</span>
                        </p>

                        <p class="text-gray-700 mb-6 line-clamp-2 leading-relaxed">{{ $event->description }}</p>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                                <span class="text-sm font-medium">{{ $event->location }}</span>
                            </div>


                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Clubs Section -->
        <section id="clubs" class="mb-20">
            <div class="flex justify-between items-center mb-12">
                <h2 class="section-title text-4xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-users text-blue-600 mr-4 text-3xl"></i>
                    Student Clubs
                </h2>
                <a href="{{ route('student.clubs.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center text-lg group">
                    View All
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach($clubs as $club)
                <div class="club-card text-center p-6">
                    @if($club->logo)
                    <div class="w-20 h-20 mx-auto mb-4 rounded-full overflow-hidden border-4 border-gradient-to-r from-blue-400 to-purple-400 p-1">
                        <img src="{{ asset('storage/' . $club->logo) }}"
                            alt="Club logo"
                            class="w-full h-full object-cover rounded-full">
                    </div>
                    @endif

                    <h3 class="text-lg font-bold text-gray-800 mb-3">{{ $club->name }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $club->description }}</p>

                    <a href="{{ route('student.clubs.show', $club->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold group">
                        View Details
                        <i class="fas fa-chevron-right ml-1 text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Recent Posts Section -->
   <section id="news" class="mb-20">
    <div class="flex justify-between items-center mb-12">
        <h2 class="section-title text-4xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-newspaper text-blue-600 mr-4 text-3xl"></i>
            The Campus Lens
        </h2>
        <a href="{{ route('student.posts.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center text-lg group">
            View All
            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
        <div class="news-card">
            @if(is_array($post->images) && count($post->images) > 0)
            <div x-data="carousel({{ count($post->images) }})" x-init="init($el)"
                 class="relative h-56 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden rounded-lg">
                 
                @foreach($post->images as $index => $image)
                <img x-show="active === {{ $index }}"
                     src="{{ asset('storage/' . $image) }}"
                     alt="Post image"
                     class="absolute inset-0 w-full h-full object-cover transition-all duration-500"
                     :class="{ 'opacity-100 scale-100': active === {{ $index }}, 'opacity-0 scale-105': active !== {{ $index }} }">
                @endforeach

                <!-- Indicator Dots -->
                @if(count($post->images) > 1)
                <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                    @foreach($post->images as $index => $image)
                    <span
                        class="w-3 h-3 rounded-full transition-all duration-300"
                        :class="active === {{ $index }} ? 'bg-white scale-110' : 'bg-white bg-opacity-50'">
                    </span>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <div class="p-6">
                <div class="flex items-center mb-4">
                    @if($post->club && $post->club->logo)
                    <img src="{{ asset('storage/' . $post->club->logo) }}"
                         alt="Club logo"
                         class="w-10 h-10 rounded-full mr-3 border-2 border-gray-100">
                    @endif
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $post->club->name ?? 'ISET Kairouan' }}</p>
                        <p class="text-xs text-gray-500">{{ $post->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-3 leading-tight">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-6 line-clamp-2 leading-relaxed">{{ $post->content }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>




        <!-- Calendar Section -->
        <section class="mb-20">
            <h2 class="section-title text-4xl font-bold text-gray-800 mb-12 flex items-center">
                <i class="fas fa-calendar-check text-blue-600 mr-4 text-3xl"></i>
                Event Calendar
            </h2>

            <div class="card-hover p-8">
                <div id="calendar" class="w-full"></div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="max-w-4xl mx-auto">
            <div class="contact-form p-10">
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Contact Us</h2>
                    <p class="text-gray-600 text-lg">Have questions? We'd love to hear from you.</p>
                </div>

                @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-8 flex items-center">
                    <i class="fas fa-check-circle mr-3 text-green-600"></i>
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact.save') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email"
                                class="form-input w-full px-4 py-4 focus:outline-none"
                                placeholder="your@email.com" required>
                            @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="6"
                            class="form-input w-full px-4 py-4 focus:outline-none resize-none"
                            placeholder="Feel free to explain your question here..." required></textarea>
                        @error('message')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="btn-primary w-full py-4 text-white font-bold text-lg rounded-full">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Message
                    </button>
                </form>
            </div>
        </section>
    </main>

    <!-- Event Details Modal -->
    <div id="eventModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0"
            id="modalContent">
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    <h3 id="modalEventTitle" class="text-2xl font-bold text-gray-800"></h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-blue-600 mt-1 mr-4"></i>
                        <p id="modalEventLocation" class="text-gray-700 font-medium"></p>
                    </div>

                    <div class="flex items-start">
                        <i class="fas fa-calendar-day text-blue-600 mt-1 mr-4"></i>
                        <p id="modalEventDate" class="text-gray-700 font-medium"></p>
                    </div>

                    <div id="modalEventClub" class="flex items-start">
                        <i class="fas fa-users text-blue-600 mt-1 mr-4"></i>
                        <p id="modalEventClubName" class="text-gray-700 font-medium"></p>
                    </div>

                    <div id="modalEventCertified" class="hidden">
                        <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-yellow-400 to-orange-400 text-white">
                            <i class="fas fa-certificate mr-2"></i>
                            Certificated Event
                        </div>
                    </div>

                    <p id="modalEventDescription" class="text-gray-600 leading-relaxed"></p>

                    <div class="pt-4">
                        <a href="#" id="modalEventLink" class="btn-primary text-white px-6 py-3 rounded-full font-semibold inline-flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            View Full Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-bg text-white pt-20 pb-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center mb-6">
                        <span class="text-2xl font-bold">ISETLink</span>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed">Where student life meets technology<br> ISET Kairouan, connected</p>
                    <div class="flex space-x-4">
                        <a href="#" class="social-icon text-gray-300 hover:text-blue-600">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon text-gray-300 hover:text-blue-600">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon text-gray-300 hover:text-blue-600">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-6">Quick Links</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors hover:translate-x-1 transform inline-block">Home</a></li>
                        <li><a href="/events" class="text-gray-300 hover:text-white transition-colors hover:translate-x-1 transform inline-block">Events</a></li>
                        <li><a href="/clubs" class="text-gray-300 hover:text-white transition-colors hover:translate-x-1 transform inline-block">Clubs</a></li>
                        <li><a href="/posts" class="text-gray-300 hover:text-white transition-colors hover:translate-x-1 transform inline-block">posts</a></li>
                        <li><a href="#contact" class="text-gray-300 hover:text-white transition-colors hover:translate-x-1 transform inline-block">Contact</a></li>
                    </ul>
                </div>



                <div>
                    <h3 class="text-xl font-bold mb-6">Contact Info</h3>
                    <ul class="space-y-4 text-gray-300">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-4 text-cyan-400"></i>
                            <span>
                                ISET de Kairouan – Campus Universitaire
                                3 199 Raccada – Kairouan</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-4 text-cyan-400"></i>
                            <span>77 323 350 – 77 323 300</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-print mr-4 text-cyan-400"></i>
                            <span>77 323 320</span>
                        </li>

                        <li class="flex items-center">
                            <i class="fas fa-globe mr-4 text-cyan-400"></i>
                            <a href="https://www.isetkr.rnu.tn" target="_blank">isetkr.rnu.tn</a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-16 pt-10 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} ISET Kairouan. All rights reserved. </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Assign PHP variables to JS variables
        const calendarEvents = {!! json_encode($calendarEvents) !!};
        const nextEvent = {!! json_encode($nextEvent) !!};
        const nextEventTime = {!! json_encode(optional($nextEvent)->datetime) !!};

        // FullCalendar with Modal
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Calendar
            const calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 'auto',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,listWeek'
                    },
                    events: calendarEvents,
                    eventClick: function(info) {
                        showModal(
                            info.event.title,
                            info.event.extendedProps.location,
                            info.event.start,
                            info.event.extendedProps.certificated,
                            info.event.extendedProps.description,
                            info.event.extendedProps.club,
                            info.event.url
                        );
                    },
                    eventColor: '#2d3480',
                    eventBorderColor: '#c4e9ec',
                    eventTextColor: '#ffffff'
                });
                calendar.render();
            }

            // Set next event info in hero section
            if (nextEvent) {
                document.getElementById('nextEventTitle').textContent = nextEvent.title;
                document.getElementById('nextEventLocation').textContent = nextEvent.location;

                const eventDate = new Date(nextEvent.datetime.replace(' ', 'T'));
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                document.getElementById('nextEventDate').textContent = eventDate.toLocaleDateString('en-US', options);

                // Only set link if element exists
                const nextEventLink = document.getElementById('nextEventLink');
                if (nextEventLink) {
                    nextEventLink.href = `/events/${nextEvent.id}`;
                }
            }

            // Countdown Timer
            function updateCountdown() {
                if (!nextEventTime) {
                    document.getElementById('countdown').innerHTML =
                        '<div class="col-span-4 text-center text-gray-300 py-4">No upcoming events</div>';
                    return;
                }

                const eventDate = new Date(nextEventTime.replace(' ', 'T'));
                const now = new Date();
                const diff = eventDate - now;

                if (diff <= 0) {
                    document.getElementById('countdown').innerHTML =
                        '<div class="col-span-4 text-center text-green-300 py-4 font-semibold">Event in progress!</div>';
                    return;
                }

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((diff / (1000 * 60)) % 60);
                const seconds = Math.floor((diff / 1000) % 60);

                document.getElementById('days').textContent = days;
                document.getElementById('hours').textContent = hours;
                document.getElementById('minutes').textContent = minutes;
                document.getElementById('seconds').textContent = seconds;
            }

            if (nextEventTime) {
                updateCountdown();
                setInterval(updateCountdown, 1000);
            }

            // Modal Functions
            window.showModal = function(title, location, date, certificated, description, club, eventUrl) {
                const modal = document.getElementById('eventModal');
                const modalContent = document.getElementById('modalContent');

                document.getElementById('modalEventTitle').textContent = title;
                document.getElementById('modalEventLocation').textContent = location;

                const eventDate = new Date(date);
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                document.getElementById('modalEventDate').textContent =
                    eventDate.toLocaleDateString('en-US', options);

                if (description) {
                    document.getElementById('modalEventDescription').textContent = description;
                }

                if (club) {
                    document.getElementById('modalEventClubName').textContent = club.name;
                    document.getElementById('modalEventClub').classList.remove('hidden');
                } else {
                    document.getElementById('modalEventClub').classList.add('hidden');
                }

                const certElement = document.getElementById('modalEventCertified');
                if (certificated) {
                    certElement.classList.remove('hidden');
                } else {
                    certElement.classList.add('hidden');
                }

                if (eventUrl) {
                    document.getElementById('modalEventLink').href = eventUrl;
                    document.getElementById('modalEventLink').classList.remove('hidden');
                } else {
                    document.getElementById('modalEventLink').classList.add('hidden');
                }

                modal.classList.add('active');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            window.closeModal = function() {
                const modal = document.getElementById('eventModal');
                const modalContent = document.getElementById('modalContent');

                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');

                setTimeout(() => {
                    modal.classList.remove('active');
                }, 300);
            }

            // Close modal when clicking outside
            document.getElementById('eventModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
        });

        function carousel(total) {
            return {
                active: 0,
                total: total,
                interval: null,
                init(el) {
                    this.startAuto();
                    // Stop auto when user manually clicks prev/next
                    el.addEventListener('mouseenter', () => clearInterval(this.interval));
                    el.addEventListener('mouseleave', () => this.startAuto());
                },
                startAuto() {
                    clearInterval(this.interval);
                    this.interval = setInterval(() => {
                        this.next();
                    }, 5000); // 5s per slide
                },
                next() {
                    this.active = (this.active + 1) % this.total;
                },
                prev() {
                    this.active = (this.active - 1 + this.total) % this.total;
                },
                goTo(index) {
                    this.active = index;
                }
            }
        }
    </script>
</body>

</html>