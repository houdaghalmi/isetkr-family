<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event Details - Responsible</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-900">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-purple-700">Event Details</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('responsible.events.edit', $event->id) }}"
                        class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <a href="{{ route('responsible.events.index') }}"
                        class="text-purple-600 hover:text-purple-800 px-4 py-2 border border-purple-200 rounded-lg">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </a>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Event Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Event Image -->
                        <div class="relative h-64 bg-gray-200">
                            @if($event->poster)
                            <img src="{{ asset('storage/' . $event->poster) }}"
                                alt="{{ $event->title }}"
                                class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-6xl text-gray-400"></i>
                            </div>
                            @endif

                            <!-- Status Badge -->
                            <div class="absolute top-4 right-4">
                                @if($event->status === 'completed')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                                    Completed
                                </span>
                                @elseif($event->status === 'canceled')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                    <span class="h-2 w-2 rounded-full bg-red-500 mr-2"></span>
                                    Canceled
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                    <span class="h-2 w-2 rounded-full bg-yellow-500 mr-2"></span>
                                    Pending
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Event Content -->
                        <div class="p-6">
                            <!-- Title and Certified Badge -->
                            <div class="flex items-start justify-between mb-4">
                                <h2 class="text-2xl font-bold text-gray-800">{{ $event->title }}</h2>
                                @if($event->certificated)
                                <span class="inline-block text-xs px-2 py-1 rounded text-blue-700 font-semibold">
                                    <i class="fas fa-certificate mr-1"></i>Certified
                                </span>
                                @endif
                            </div>

                            <!-- Event Info Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Speaker</h3>
                                    <p class="text-gray-900">{{ $event->intervenant }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Club</h3>
                                    <p class="text-gray-900">{{ $event->club->name ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Date & Time</h3>
                                    <p class="text-gray-900">
                                        {{ $event->datetime ? $event->datetime->format('l, j M Y \a\t H:i') : 'Not specified' }}
                                    </p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Location</h3>
                                    <p class="text-gray-900">{{ $event->location }}</p>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Description</h3>
                                <p class="text-gray-900 leading-relaxed">{{ $event->description }}</p>
                            </div>

                            <!-- Cancel Button -->
                            @if($event->status === 'pending')
                            <div class="border-t border-gray-200 pt-4">
                                <form action="{{ route('responsible.events.cancel', $event->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to cancel this event?');"
                                    class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                        Cancel Event
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Participants Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-purple-700 mb-4">
                            Participants ({{ $event->participants->count() }})
                        </h3>

                        @if($event->participants->count() > 0)
                        <div class="space-y-3">
                            <div class="flex justify-center mb-2">
                                <a href="{{ route('responsible.events.participants.index', $event->id) }}"
                                    class="inline-flex items-center px-6 py-1 text-sm font-medium rounded-lg text-purple-700 bg-purple-50 border border-purple-200 hover:bg-purple-200 hover:text-purple-900 transition-colors">
                                    View All Participants
                                </a>
                            </div>
                            @foreach($event->participants as $participant)
                            <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                                <img src="{{ asset('images/default-avatar.png') }}"
                                    alt="{{ $participant->user->nom ?? 'User' }}"
                                    class="w-10 h-10 rounded-full border border-purple-200">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">
                                        {{ $participant->user->nom ?? 'Name not available' }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ $participant->user->email ?? 'Email not available' }}
                                    </p>
                                </div>

                            </div>

                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-8">
                            <i class="fas fa-users text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-500">No participants yet</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>