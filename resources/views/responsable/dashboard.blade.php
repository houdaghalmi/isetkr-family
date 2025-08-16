<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Responsible Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white border-r shadow-sm flex flex-col justify-between">
            <div>
                <!-- Logo -->
                <div class="flex items-center gap-3 px-6 py-6">
                    <img src="/images/logoisetlink.png" alt="ISETLink Logo" class="object-contain" />
                </div>
                <!-- Navigation -->
                <nav class="mt-8 space-y-1 px-4">
                    <a href="/"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-home w-5 text-#2d3480"></i> Home
                    </a>
                    <a href="{{ route('student.clubs.index') }}"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-users w-5 text-#2d3480"></i> Clubs
                    </a>
                    <a href="{{ route('responsible.clubs.index') }}"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-user-cog w-5 text-#2d3480"></i> Manage Clubs
                    </a>
                    <a href="{{ route('student.events.index') }}"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-calendar-alt w-5 text-#2d3480"></i> Events
                    </a>
                    <a href="{{ route('responsible.events.index') }}"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-tasks w-5 text-#2d3480"></i> Manage Events
                    </a>
                    <a href="{{ route('student.posts.index') }}"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-file-alt w-5 text-#2d3480"></i> Posts
                    </a>
                    <a href="{{ route('responsible.posts.index') }}"
                        class="flex items-center gap-3 text-gray-700 font-medium px-3 py-2 rounded-lg hover:bg-purple-50 hover:text-purple-700 transition">
                        <i class="fas fa-edit w-5 text-#2d3480"></i> Manage Posts
                    </a>
                </nav>
            </div>
            <!-- Profile Menu -->
            <div class="px-6 py-6">
                <div class="flex items-center gap-3">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}"
                        class="w-10 h-10 rounded-full object-cover border-2 border-purple-200 shadow-sm" alt="Profile">
                    <div>
                        <div class="font-semibold text-gray-800">{{ auth()->user()->nom }} {{ auth()->user()->prenom }}</div>
                        <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-4 space-y-1">
                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded transition">
                        <i class="fas fa-user-edit mr-2"></i> Edit Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded transition">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-gray-50 min-h-screen">


            <!-- Clubs You Manage -->
            <section class="mb-12">
                <h2 class="text-xl font-medium text-gray-900 mb-6">Managed Clubs</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($responsibleClubs as $club)
                    <div class="bg-white rounded-lg border border-gray-100 p-4 hover:shadow-sm transition-shadow">
                        <div class="flex items-start space-x-4">
                            <img src="{{ $club->logo ? asset('storage/' . $club->logo) : asset('images/isetlink.jpg') }}"
                                alt="Club Logo"
                                class="h-12 w-12 rounded-lg object-cover border border-gray-200">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-medium text-gray-900 truncate">{{ $club->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $club->members_count }} members</p>

                                <div class="flex flex-wrap gap-2 text-xs">
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded">
                                        {{ $club->events_count ?? 0 }} events
                                    </span>
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded">
                                        {{ $club->posts_count ?? 0 }} posts
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-xs text-gray-400">
                                Created {{ $club->created_at ? \Carbon\Carbon::parse($club->created_at)->format('M Y') : '-' }}
                            </span>
                            <a href="{{ route('responsible.clubs.edit', $club->id) }}"
                                class="text-sm text-purple-800 hover:text-[#1a216b] font-medium">
                                Manage
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 py-8 text-center">
                        <p class="text-gray-400">No clubs to manage</p>
                    </div>
                    @endforelse
                </div>
            </section>
            <!-- Recent Members -->
            <section class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Recent Members</h2>
                <div class="bg-white rounded-xl shadow p-6">
                    <ul>
                        @forelse($recentMembers as $member)
                        <li class="flex items-center gap-4 py-2 border-b last:border-b-0">
                            <img src="{{ $member->user && $member->user->avatar ? asset('storage/' . $member->user->avatar) : asset('images/default-avatar.png') }}"
                                class="w-10 h-10 rounded-full object-cover border" alt="Avatar">
                            <div>
                                <div class="font-semibold text-gray-800">
                                    {{ $member->user ? $member->user->nom . ' ' . $member->user->prenom : '-' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $member->user ? $member->user->email : '-' }}
                                </div>
                                <div class="text-xs text-gray-400">
                                    <div class="text-sm text-gray-600">
                                        Joined
                                        @if($member->club)
                                        <span class="font-semibold text-gray-800"> {{ $member->club->name }}</span>
                                        @else
                                        <span class="text-gray-400">-</span>
                                        @endif

                                        @if($member->created_at)
                                        on <span class="text-gray-700">{{ $member->created_at->format('M d, Y') }}</span> at <span class="text-gray-700">{{ $member->created_at->format('H:i') }}</span>
                                        @else
                                        on <span class="text-gray-400">-</span>
                                        @endif
                                    </div>

                                </div>

                            </div>
                        </li>
                        @empty
                        <li class="text-gray-400">No recent members.</li>
                        @endforelse
                    </ul>
                    <div class="mt-4 text-right">
                        <a href="{{ route('responsible.clubs.index') }}" class="text-sm text-purple-700 hover:underline font-medium">See all members &rarr;</a>
                    </div>
                </div>
            </section>
            <!-- Clubs You Joined -->
            <section class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Clubs You Joined</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($joinedClubs as $club)
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition p-6 flex flex-col">
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
                            <div class="flex items-center gap-3">
                                @if($club->facebook_link)
                                <a href="{{ $club->facebook_link }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    <i class="fab fa-facebook fa-lg"></i>
                                </a>
                                @endif
                                @if($club->instagram_link)
                                <a href="{{ $club->instagram_link }}" target="_blank" class="text-pink-500 hover:text-pink-700">
                                    <i class="fab fa-instagram fa-lg"></i>
                                </a>
                                @endif
                            </div>
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
                    @empty
                    <div class="col-span-3 text-center text-gray-400">You have not joined any clubs.</div>
                    @endforelse
                </div>
            </section>

            <!-- Events Participated In -->
            <section id="events" class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Events You Registered For</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
                    @forelse($participatedEvents as $event)
                    @if ($event->status==='pending')

                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-6 flex flex-col md:flex-row gap-6 items-start">
                        <!-- Left: Event Info -->
                        <div class="flex-1 space-y-2">
                            <div class="flex items-center gap-2">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $event->title }}</h3>
                                @if($event->certificated)
                                <span class="ml-2 inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                    <i class="fas fa-certificate"></i> Certificated
                                </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500">{{ $event->description }}</p>
                            <p class="text-sm text-gray-500">by : {{ $event->intervenant }}</p>
                            <div class="text-sm text-gray-600 flex flex-col gap-1">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-#2d3480"></i>
                                    {{ \Carbon\Carbon::parse($event->datetime)->format('d/m/Y H:i') }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-#2d3480"></i>
                                    {{ $event->location ?? 'N/A' }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-users text-#2d3480"></i>
                                    Participants: <span>{{ $event->participants_count ?? 0 }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <img src="{{ $event->club && $event->club->logo ? asset('storage/' . $event->club->logo) : asset('images/default-avatar.png') }}"
                                        alt="Club Logo"
                                        class="w-10 h-10 rounded-full object-cover border border-gray-300" />
                                    <span>{{ $event->club ? $event->club->name : '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- Right: Poster -->
                        @if($event->poster)
                        <div class="w-48 h-48 flex-shrink-0 rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                            <img src="{{ asset('storage/' . $event->poster) }}" alt="Event Poster"
                                class="w-full h-full object-cover rounded-xl" />
                        </div>
                        @endif
                    </div>
                    @endif

                    @empty
                    <div class="col-span-2 text-center text-gray-400">No event participation found.</div>
                    @endforelse
                </div>
            </section>
        </main>
    </div>
</body>

</html>