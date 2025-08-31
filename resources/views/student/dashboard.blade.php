<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white border-r shadow-sm flex flex-col justify-between">
            <!-- Logo & Create Club -->
            <div>
                <div class="flex items-center gap-3 px-6 py-6">
                    <img src="/images/logo.png" alt="ISETKR Family Logo" class=" object-contain" />
                </div>

                <div class="px-6">
                    <a href="{{ route('student.clubs.create') }}"
                        class="flex items-center bg-gradient-to-b from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Create Your Club
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="mt-8 space-y-1 px-4">
                    <a href="/student/dashboard"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-home w-5 text-#2d3480"></i> Dashboard
                    </a>
                    <a href="/posts"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-edit w-5 text-#2d3480"></i> posts
                    </a>
                    <a href="/events"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-calendar-alt w-5 text-#2d3480"></i> Events
                    </a>
                    <a href="/clubs"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-users w-5 text-#2d3480"></i> Clubs
                    </a>
                </nav>
            </div>


        </aside>
        <script src="https://kit.fontawesome.com/a2d9a66f5d.js" crossorigin="anonymous"></script>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-gray-50 min-h-screen">
            <!-- Top bar with profile -->
            <div class="flex justify-end items-center mb-10 relative">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="focus:outline-none">
                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}"
                            class="w-10 h-10 rounded-full object-cover border-2 border-purple-200 shadow-sm hover:shadow-md transition" alt="Profile">
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg py-2 z-50 ring-1 ring-gray-100"
                        x-transition>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">Edit Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">Logout</button>
                        </form>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
            </div>

            <!-- Clubs Section -->
            <section class="mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">My Clubs</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($joinedClubs as $club)
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ $club->logo ? asset('storage/' . $club->logo) : asset('images/default-avatar.png') }}"
                                alt="Club Logo"
                                class="w-14 h-14 rounded-full object-cover border border-gray-300 shadow-sm">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $club->name }}</h3>
                                <p class="text-sm text-gray-500 line-clamp-2">{{ $club->description }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between text-center text-sm text-gray-600 mb-4">
                            <div>
                                <div class="font-semibold text-indigo-600 text-lg">{{ $club->members_count }}</div>
                                <div>Members</div>
                            </div>
                            <div>
                                <div class="font-semibold text-indigo-600 text-lg">{{ $club->events_count }}</div>
                                <div>Events</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2 border-t border-gray-200 mt-4">
                            <a href="{{ route('student.clubs.show', $club->id) }}"
                                class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition">Show Details</a>
                            <form method="POST" action="{{ route('student.clubs.leave', $club->id) }}">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center gap-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 px-4 py-2 rounded-xl shadow-sm hover:bg-red-100 hover:text-red-700 active:scale-[0.98] transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                                    </svg>
                                    Leave
                                </button>

                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>


            <!-- Events Section -->
             
          <section class="mb-16">
    <h2 class="text-3xl font-bold text-gray-800 mb-8">My Events</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
        @foreach($registeredEvents as $event)
        @if ($event->status==='pending')
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-4 flex gap-6 items-start">
            <!-- Left side: Event Info -->
            <div class="flex-1 space-y-4">
                <div class="flex items-center gap-4">
                <h3 class="text-xl font-semibold text-gray-900 hover:text-indigo-700 transition">{{ $event->title }}</h3>
                    @if($event->certificated)
                    <span class="ml-auto inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                        <i class="fas fa-certificate"></i> Certificated
                    </span>
                    @endif

                </div>
                <p class="text-sm text-gray-500 line-clamp-2">{{ $event->description }}</p>
                <p class="text-sm text-gray-500 line-clamp-2">by : {{ $event->intervenant }}</p>




                <div class="text-sm text-gray-600 space-y-1">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar-alt text-#2d3480"></i>
                        {{ $event->datetime->format('d/m/Y H:i') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-#2d3480"></i>
                        {{ $event->location ?? 'N/A' }}
                    </div>
                     <div>
                        <div class="text-sm text-gray-600 flex items-center gap-1">
                            <i class="fas fa-users text-#2d3480"></i> Participants :<span >{{ $event->participants_count ?? 0 }}</span>

                        </div>
                    </div>
                    <div class="flex items-center gap-2 ">
                        <img src="{{ $event->club->logo ? asset('storage/' . $event->club->logo) : asset('images/default-avatar.png') }}"
                             alt="Club Logo"
                             class="w-10 h-10 rounded-full object-cover border border-gray-300" />
                        <span>{{ $event->club->name }}</span>
                    </div>
                </div>

            </div>

            <!-- Right side: Poster -->
            @if($event->poster)
            <div class="w-50 h-60 flex-shrink-0 rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                <img src="{{ asset('storage/' . $event->poster) }}" alt="Event Poster"
                     class="w-full h-full object-cover rounded-xl" />
            </div>
            @endif
        </div>
        @endif
        @endforeach
    </div>
</section>

        </main>


    </div>
</body>

</html>