<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $club->name }} - Club</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2d3480',
                        secondary: '#3d4490',
                        accent: '#f59e0b',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-900">
    @if(auth()->user()->role === 'club_responsible')
        @include('components.responsible-topbar')
    @else
        @include('components.topbar')
    @endif

    <div class="max-w-6xl mx-auto px-4 py-10">
        <!-- Page Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-primary mb-3">Meet Our Team</h1>
            @if(in_array($club->id, $joinedClubIds))
                <p class="text-gray-600 mb-5">Welcome home! You’re now part of <span class="text-accent font-semibold">{{ $club->name }}</span>. We’re glad you’re here </p>
                <a href="{{ route('student.clubs.showMembers', $club->id) }}"
                   class="inline-flex items-center bg-accent text-white px-5 py-2 rounded-lg font-medium hover:bg-yellow-500 transition shadow">
                    <i class="fas fa-users mr-2 text-sm"></i> View All Members
                </a>
            @endif
        </div>

        <!-- Members Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($members as $member)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition p-6 flex flex-col items-center text-center relative">
                    <!-- Avatar -->
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-br from-primary to-secondary rounded-full blur opacity-30 group-hover:opacity-60 transition duration-300"></div>
                        <img src="{{ $member->user->avatar && file_exists(public_path('storage/' . $member->user->avatar)) 
                                    ? asset('storage/' . $member->user->avatar) 
                                    : asset('images/default-avatar.png') }}" 
                             alt="Avatar" 
                             class="relative h-24 w-24 rounded-full object-cover border-4 border-white shadow">
                    </div>
                    
                    <!-- Name + Role -->
                    <div class="mt-4">
                        <div class="font-bold text-lg text-gray-900">{{ $member->user->nom . ' ' . $member->user->prenom }}</div>
                        <div class="text-secondary font-semibold">{{ $member->function }}</div>
                    </div>

                    <!-- Bio -->
                    <p class="text-gray-500 text-sm mt-2 mb-4">{{ $member->user->bio ?? '' }}</p>

                    <!-- Social Links -->
                    <div class="flex space-x-4">
                        @if($member->facebook_link)
                            <a href="{{ $member->facebook_link }}" target="_blank" class="text-gray-500 hover:text-blue-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 5.006 3.657 9.128 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 
                                    1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 
                                    22 17.006 22 12"></path>
                                </svg>
                            </a>
                        @endif
                        @if($member->instagram_link)
                            <a href="{{ $member->instagram_link }}" target="_blank" class="text-gray-500 hover:text-pink-500 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 
                                    5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 
                                    4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 
                                    3.25a5.25 5.25 0 1 1 0 10.5a5.25 5.25 0 0 1 0-10.5zm0 1.5a3.75 3.75 0 1 0 0 7.5a3.75 
                                    3.75 0 0 0 0-7.5zm5.25.75a1 1 0 1 1 0 2a1 1 0 0 1 0-2z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
