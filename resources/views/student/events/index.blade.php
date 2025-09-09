<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events - Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
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
            <h1 class="text-3xl md:text-4xl font-bold text-[#2d3480] mb-2">Our Events at ISET Kairouan</h1>
            <p class="text-lg text-[#3d4490]">Discover and participate in our student activities</p>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($events as $event)
            @if ($event->status !== 'canceled')
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col border border-gray-100">
                    <div class="relative">
                        <img src="{{ $event->poster ? asset('storage/' . $event->poster) : asset('images/logo.png') }}" 
                             alt="Event poster" 
                             class="h-40 w-full object-cover">

                        @if($event->certificated)
                            <div class="absolute top-2 right-2 bg-[#f59e0b] text-white text-xs font-bold px-2 py-1 rounded-full flex items-center shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Certified
                            </div>
                        @endif
                    </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <!-- Status/Tag -->
                        <div class="flex items-center gap-2 mb-2">
                            @if($event->status === 'pending')
                                <span class="inline-block text-xs px-2 py-1 rounded bg-[#fef3c7] text-[#f59e0b] font-semibold">Pending</span>
                            @elseif($event->status === 'completed')
                                <span class="inline-block text-xs px-2 py-1 rounded bg-green-100 text-green-700 font-semibold">Completed</span>
                            @endif
                        </div>

                        <!-- Title -->
                        <a href="#" class="font-bold text-lg mb-1 text-[#2d3480] hover:text-[#f59e0b] transition flex items-center">
                            {{ $event->title }}
                        </a>

                        <!-- Intervenant -->
                        <div class="text-xs text-gray-500 mb-1">
                            By: <span class="font-semibold text-[#3d4490]">{{ $event->intervenant }}</span>
                        </div>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-2 flex-1">{{ Str::limit($event->description, 80) }}</p>

                        <!-- DateTime, Location, Club -->
                        <div class="flex flex-wrap items-center text-xs text-gray-500 mt-2 mb-4 gap-x-2 gap-y-1">
                            <span>{{ \Carbon\Carbon::parse($event->datetime)->format('d M Y, H:i') }}</span>
                            <span>•</span>
                            <span>{{ $event->location }}</span>
                        </div>

                        <div class="flex items-center text-xs text-gray-500 mt-2 mb-4 gap-x-2">
                            <img src="{{ $event->club && $event->club->logo ? asset('storage/' . $event->club->logo) : asset('images/isetkr.jpg') }}" 
                                 alt="Club Logo" 
                                 class="h-7 w-7 rounded-full object-cover border border-gray-200">
                            <span class="font-semibold text-[#2d3480]">{{ $event->club->name ?? 'Club Name' }}</span>
                        </div>

                        @if($event->status === 'pending' && !in_array($event->id, $registeredEventIds))
                            <a href="{{ route('student.events.participate', $event->id) }}" 
                               class="block w-full text-center bg-[#2d3480] text-white py-2 rounded-lg font-semibold hover:bg-[#3d4490] transition">
                                Participate in Event
                            </a>
                        @endif

                        @if(in_array($event->id, $registeredEventIds))
                            <div class="block w-full text-center bg-green-100 text-green-700 py-2 rounded-lg font-semibold mt-2">
                                You are registered
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </div>
</body>
</html>
