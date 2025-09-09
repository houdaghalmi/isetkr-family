<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Participate in Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4">
    <div class="flex flex-col md:flex-row bg-white rounded-2xl shadow-xl overflow-hidden max-w-4xl w-full border border-gray-100">
        
        <!-- Event Poster -->
        <div class="md:w-1/2 w-full h-64 md:h-auto flex items-center justify-center bg-[#2d3480]">
            <img src="{{ $event->poster ? asset('storage/' . $event->poster) : asset('images/logo.png') }}" 
                 alt="Event poster" 
                 class="object-cover w-full h-full">
        </div>

        <!-- Form -->
        <div class="md:w-1/2 w-full p-8 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-[#2d3480] mb-2">Participate in <span class="text-[#f59e0b]">{{ $event->title }}</span></h2>
            <p class="mb-6 text-gray-500">Don’t just hear about it — <span class="text-[#3d4490] font-semibold">be part of it!</span></p>

            <form method="POST" action="{{ route('student.events.participate.submit', $event->id) }}" class="space-y-4">
                @csrf
                
                <!-- First/Last Name -->
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" name="prenom" value="{{ $user->prenom }}" 
                               class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-600 pointer-events-none" readonly>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" name="nom" value="{{ $user->nom }}" 
                               class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-600 pointer-events-none" readonly>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" 
                           class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-600 pointer-events-none" readonly>
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="numero" value="{{ $user->numero }}" 
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#3d4490] focus:border-[#3d4490]" required>
                </div>

                <!-- Class -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                    <input type="text" name="classe" value="{{ old('classe') }}" 
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#3d4490] focus:border-[#3d4490]" required>
                </div>

                <!-- Submit -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-[#2d3480] to-[#3d4490] text-white py-3 rounded-lg font-semibold hover:opacity-90 transition">
                    Participate
                </button>
            </form>
        </div>
    </div>
</body>

</html>
