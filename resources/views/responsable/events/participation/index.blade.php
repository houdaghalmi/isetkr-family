<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Participants - {{ $event->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900">
    @include('components.responsible-topbar')

    <div class="max-w-7xl mx-auto px-4 py-8">
    

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('responsible.events.index') }}" 
                       class="text-gray-600 hover:text-purple-700 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Events
                    </a>
                </div>
                <h1 class="text-3xl font-bold ">{{ $event->title }} Participants</h1>
                <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                    <span><i class="fas fa-calendar mr-1"></i>{{ $event->datetime ? $event->datetime->format('d M Y, H:i') : 'Date not set' }}</span>
                    <span><i class="fas fa-map-marker-alt mr-1"></i>{{ $event->location }}</span>
                    <span><i class="fas fa-users mr-1"></i>{{ $participants->total() }} participants</span>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('responsible.events.participants.pdf', $event->id) }}" 
                   class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                    <i class="fas fa-download mr-2"></i>Download PDF
                </a>
            </div>
        </div>

        <!-- Participants Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Participant
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Phone Number
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Class
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($participants as $participant)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($participant->user->avatar ?? false)
                                                <img class="h-10 w-10 rounded-full object-cover" 
                                                     src="{{ asset('storage/' . $participant->user->avatar) }}" 
                                                     alt="Avatar">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-purple-200 flex items-center justify-center">
                                                    <i class="fas fa-user text-purple-600"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $participant->user->nom ?? 'N/A' }} {{ $participant->user->prenom ?? '' }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ $participant->user->email ?? 'N/A' }}</div>
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
                                    @if($participant->participation_status === 'registered')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Registered
                                        </span>
                                    @elseif($participant->participation_status === 'attended')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Attended
                                        </span>
                                    @elseif($participant->participation_status === 'absent')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Absent
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Unknown
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openEditModal({{ $participant->id }}, '{{ addslashes($participant->classe) }}', '{{ addslashes($participant->participation_status) }}')"
                                                class="text-gray-400 hover:text-purple-600 transition"
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('responsible.events.participants.destroy', ['event' => $event->id, 'participant' => $participant->id]) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to remove this participant?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-gray-400 hover:text-red-600 transition"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <i class="fas fa-users text-4xl mb-4 text-gray-300"></i>
                                        <p class="text-lg font-medium">No participants found</p>
                                        <p class="text-sm">This event doesn't have any participants yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($participants->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $participants->links() }}
            </div>
        @endif
    </div>

    <!-- Edit Participant Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Participant</h3>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="classe" class="block text-sm font-medium text-gray-700 mb-2">Class</label>
                        <input type="text" 
                               id="classe" 
                               name="classe" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                               required>
                    </div>
                    
                    <div class="mb-6">
                        <label for="participation_status" class="block text-sm font-medium text-gray-700 mb-2">Participation Status</label>
                        <select id="participation_status" 
                                name="participation_status" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                                required>
                            <option value="registered">Registered</option>
                            <option value="attended">Attended</option>
                            <option value="absent">Absent</option>
                        </select>
                    </div>
                    
                    <div class="flex justify-end gap-3">
                        <button type="button" 
                                onclick="closeEditModal()"
                                class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(participantId, classe, status) {
            document.getElementById('classe').value = classe;
            document.getElementById('participation_status').value = status;
            document.getElementById('editForm').action = `/responsible/events/{{ $event->id }}/participants/${participantId}`;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</body>
</html>
