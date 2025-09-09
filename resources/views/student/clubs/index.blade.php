<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Clubs - Student</title>
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

    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-primary mb-2">Our Clubs at ISET Kairouan</h1>
            <p class="text-gray-600">Discover, join, and connect with your favorite clubs</p>
        </div>

        <!-- Clubs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($clubs as $club)
                @if ($club->status === 'active')
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden flex flex-col items-center p-6 border-t-4 border-primary">
                        <!-- Club Logo -->
                        <img src="{{ $club->logo ? asset('storage/' . $club->logo) : asset('images/logo.png') }}" 
                             alt="Club Logo" 
                             class="h-20 w-20 rounded-full object-cover border-4 border-secondary mb-4 shadow-md">

                        <!-- Club Name -->
                        <h1 class="text-xl font-bold text-primary mb-2">{{ $club->name }}</h1>

                        <!-- Club Description -->
                        <p class="text-gray-600 text-sm mb-4 text-center">
                            {{ Str::limit($club->description, 80) }}
                        </p>

                        <!-- Join/Leave Button -->
                        @if(in_array($club->id, $joinedClubIds))
                            <a href="{{ route('student.clubs.leave', $club->id) }}" 
                               class="w-full block text-center bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                                Leave
                            </a>
                        @else
                            <a href="{{ route('student.clubs.join.form', $club->id) }}" 
                               class="w-full block text-center bg-primary text-white py-2 rounded-lg font-semibold hover:bg-secondary transition">
                                Join
                            </a>
                        @endif

                        <!-- Footer -->
                        <div class="flex justify-between items-center w-full mt-4 border-t pt-3">
                            <div class="flex space-x-2">
                                @if($club->facebook_link)
                                    <a href="{{ $club->facebook_link }}" target="_blank" class="text-blue-600 hover:text-blue-800" title="Facebook">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.632.771-1.632 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12"></path>
                                        </svg>
                                    </a>
                                @endif
                                @if($club->instagram_link)
                                    <a href="{{ $club->instagram_link }}" target="_blank" class="text-pink-500 hover:text-pink-700" title="Instagram">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 3.25a5.25 5.25 0 1 1 0 10.5a5.25 5.25 0 0 1 0-10.5zm0 1.5a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5zm5.25.75a1 1 0 1 1 0 2a1 1 0 0 1 0-2z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                            <a href="{{ route('student.clubs.show', $club->id) }}" 
                               class="text-sm text-accent hover:underline font-semibold">
                                Meet the Team
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</body>

</html>
