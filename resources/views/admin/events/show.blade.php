<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#3b82f6',
                            600: '#2563eb',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white border-r border-gray-200">
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.clubs.index') }}" class="flex items-center py-2 px-4 rounded  hover:bg-gray-100 ">
                            <i class="fas fa-users mr-3"></i> Clubs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.events.index') }}" class="flex items-center py-2 px-4 rounded bg-blue-100 text-blue-700">
                            <i class="fas fa-calendar-alt mr-3"></i> Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.posts.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                            <i class="fas fa-newspaper mr-3"></i> Posts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.messages.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                            <i class="fas fa-envelope mr-3"></i> Messages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                            <i class="fas fa-user mr-3"></i> Users
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Back Button -->
            <a href="{{ route('admin.events.index') }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 mb-6">
                <i class="fas fa-arrow-left mr-2"></i> Back to Events
            </a>

            <!-- Event Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                @if($event->poster)
                <div class="h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('storage/' . $event->poster) }}" alt="Poster" class="w-full h-full object-cover">
                </div>
                @endif
                
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($event->certificated)
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium">
                                <i class="fas fa-certificate mr-1"></i> Certificated
                            </span>
                        @endif
                       
                    </div>
                    
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->title }}</h1>
                    <p class="text-gray-600 mb-4">{{ $event->description }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-start">
                            <div class="bg-primary-50 p-3 rounded-lg mr-4">
                                <i class="fas fa-user-tie text-primary-600"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Intervenant</h3>
                                <p class="text-gray-800">{{ $event->intervenant }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-primary-50 p-3 rounded-lg mr-4">
                                <i class="fas fa-calendar-alt text-primary-600"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Date & Time</h3>
                                <p class="text-gray-800">{{ $event->datetime ? \Carbon\Carbon::parse($event->datetime)->format('M d, Y H:i') : '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-primary-50 p-3 rounded-lg mr-4">
                                <i class="fas fa-map-marker-alt text-primary-600"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Location</h3>
                                <p class="text-gray-800">{{ $event->location }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-primary-50 p-3 rounded-lg mr-4">
                                <i class="fas fa-users text-primary-600"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Organized By</h3>
                                <p class="text-gray-800">{{ $event->club->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        @php
                            $statusColors = [
                                'completed' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'canceled' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$event->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Participants Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Participants ({{ $participants->total() }})</h2>
                    <div class="flex items-center gap-2">
                        <a href="/events/{{ $event->id }}/participants/pdf" target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-download mr-2"></i> Download PDF
                        </a>
                        <div class="relative">
                            <input type="text" placeholder="Search participants..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 w-64">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Classe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($participants as $participant)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($participant->user->avatar ?? false)
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $participant->user->avatar) }}" alt="">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-400"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $participant->user->nom ?? '-' }} {{ $participant->user->prenom ?? '' }}</div>
                                            <div class="text-sm text-gray-500">{{ $participant->user->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $participant->user->numero ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $participant->classe ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        {{ $participant->participation_status ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Page {{ $participants->firstItem() }} of {{ $participants->lastItem() }} 
                    </div>
                    <div class="flex space-x-2">
                        @if($participants->previousPageUrl())
                            <a href="{{ $participants->previousPageUrl() }}" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-chevron-left mr-1"></i> Previous
                            </a>
                        @endif
                        @if($participants->nextPageUrl())
                            <a href="{{ $participants->nextPageUrl() }}" class="inline-flex items-center px-3 py-1 border border-primary-300 rounded-md shadow-sm text-sm font-medium text-primary-700 bg-primary-50 hover:bg-primary-100">
                                Next <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>