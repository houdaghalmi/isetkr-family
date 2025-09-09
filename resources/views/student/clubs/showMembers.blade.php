<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meet our members</title>
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
<body class="bg-white text-gray-900">
@if(auth()->user()->role === 'club_responsible')
    @include('components.responsible-topbar')
@else
    @include('components.topbar')
@endif

    <div class="max-w-6xl mx-auto px-4 py-16">
        <!-- Header -->
        <div class="text-center mb-14">
            <h1 class="text-4xl md:text-5xl font-extrabold text-primary mb-3">Meet our members</h1>
            <p class="text-lg md:text-xl text-gray-500">More than members, they are the heartbeat of who we are </p>
        </div>

        <!-- Members Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-10">
            @foreach($members as $member)
                @php
                    $isCenter = $loop->index == $centerIndex;
                @endphp

                <div class="group flex flex-col items-center transition transform hover:scale-105">
                    <!-- Avatar -->
                    <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 
                        {{ $isCenter ? 'border-secondary bg-amber-100 shadow-lg' : 'border-primary bg-gray-100 shadow-sm' }}">
                        <img src="{{ $member->avatar && file_exists(public_path('storage/' . $member->avatar)) 
                                    ? asset('storage/' . $member->avatar) 
                                    : asset('images/default-avatar.png') }}"
                             alt="{{ $member->nom . ' ' . $member->prenom }}"
                             class="object-cover w-full h-full">
                    </div>

                    <!-- Info -->
                    <div class="text-center mt-4">
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-secondary transition">
                            {{ $member->nom . ' ' . $member->prenom }}
                        </h3>
                        <p class="text-sm text-gray-500">{{ $member->pivot->function }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
