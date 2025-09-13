<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Events - Responsible</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900">
    @include('components.responsible-topbar')

    <div class="max-w-6xl mx-auto px-4 py-8">
    

        <!-- Header -->
        <div class="flex justify-between items-center mb-10">
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-bold text-[#2d3480]">My Events</h1>
             
            </div>
            <a href="{{ route('responsible.events.create') }}" 
               class="bg-[#2d3480] text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>Create Event
            </a>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($events as $event)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                    <!-- Event Image -->
                    <div class="relative">
                        <img src="{{ $event->poster ? asset('storage/' . $event->poster) : asset('images/logo.png') }}" 
                             alt="Event poster" 
                             class="h-40 w-full object-cover">
                    </div>

                    <!-- Event Content -->
                    <div class="p-5 flex-1 flex flex-col">
                        <!-- Status Tag and Certification Badge -->
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                @if($event->status === 'pending')
                                    <span class="inline-block text-xs px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-semibold">Pending</span>
                                @elseif($event->status === 'completed')
                                    <span class="inline-block text-xs px-2 py-1 rounded bg-green-100 text-green-700 font-semibold">Completed</span>
                                @elseif($event->status === 'canceled')
                                    <span class="inline-block text-xs px-2 py-1 rounded bg-red-100 text-red-700 font-semibold">Canceled</span>
                                @endif
                                
                                @if($event->certificated)
                                    <span class="inline-block text-xs px-2 py-1 rounded text-blue-700 font-semibold">
                                        <i class="fas fa-certificate mr-1"></i>Certified
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Participant Count -->
                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                <i class="fas fa-users"></i>
                                <span class="font-semibold">{{ $event->participants->count() }}</span>
                                <span>participants</span>
                            </div>
                        </div>

                        <!-- Title, Edit Button & Details Button -->
                        <div class="flex items-start justify-between mb-1 gap-2">
                            <h3 class="font-bold text-lg flex-1">{{ $event->title }}</h3>
                            <div class="flex items-center gap-2">
                                @if($event->status !== 'completed' && $event->status !== 'canceled')
                                    <a href="{{ route('responsible.events.edit', $event->id) }}" 
                                       class="text-gray-400 hover:text-blue-600 transition"
                                       title="Edit">
                                        <i class="fas fa-pen text-sm"></i>
                                    </a>
                                @endif
                                <a href="{{ route('responsible.events.show', $event->id) }}"
                                   class="text-gray-400 hover:text-blue-600 transition"
                                   title="Show Details">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                              
                            </div>
                        </div>

                        <!-- Intervenant -->
                        <div class="text-xs text-gray-500 mb-1">By: <span class="font-semibold text-gray-700">{{ $event->intervenant ?? 'Unknown' }}</span></div>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-2 flex-1">{{ Str::limit($event->description, 80) }}</p>

                        <!-- Date, Location -->
                        <div class="flex flex-wrap items-center text-xs text-gray-500 mt-2 mb-4 gap-x-2 gap-y-1">
                            <span>{{ $event->datetime ? $event->datetime->format('d M Y, H:i') : 'Date not set' }}</span>
                            <span>•</span>
                            <span>{{ $event->location }}</span>
                        </div>

                        <!-- Club Info -->
                        <div class="flex items-center text-xs text-gray-500 gap-2 mb-4">
                            <img src="{{ $event->club && $event->club->logo ? asset('storage/' . $event->club->logo) : asset('images/logo.png') }}" 
                                 alt="Club Logo" 
                                 class="h-7 w-7 rounded-full object-cover border border-gray-200">
                            <span class="font-semibold">{{ $event->club->name ?? 'Club Name' }}</span>
                        </div>

                        <!-- Actions -->
                        @if($event->status === 'pending')
                            <form action="{{ route('responsible.events.cancel', $event->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to cancel this event? This action cannot be undone and the event will be removed from your events list.');"
                                  class="w-full">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition text-sm">
                                    <i class="fas fa-times mr-2"></i>Cancel Event
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-calendar-times text-4xl text-blue-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">No Events Found</h3>
                    <p class="text-gray-500">You have not created any events yet, or all events have been canceled.</p>
                    <a href="{{ route('responsible.events.create') }}" 
                       class="inline-block mt-4 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i>Create Your First Event
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</body>
</html>
