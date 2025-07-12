<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Participate in Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="flex flex-col md:flex-row bg-white rounded-2xl shadow-lg overflow-hidden max-w-4xl w-full">
        <!-- Event Poster -->
        <div class="md:w-1/2 w-full h-80 md:h-auto flex items-center justify-center bg-gray-100">
            <img src="{{ $event->poster ? asset('storage/' . $event->poster) : asset('images/isetlink.jpg') }}" alt="Event poster" class="object-cover w-full h-full">
        </div>
        <!-- Form -->
        <div class="md:w-1/2 w-full p-8">
            <h2 class="text-3xl font-bold mb-2">Participate in {{ $event->title }}</h2>
            <p class="mb-6 text-gray-500">Don’t just hear about it  be part of it!</p>
            <form method="POST" action="{{ route('student.events.participate.submit', $event->id) }}">
                @csrf
                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-sm font-medium mb-1">First Name</label>
                        <input type="text" name="prenom" value="{{ $user->prenom }}" class="w-full border rounded-lg px-3 py-2 bg-gray-100 pointer-events-none" readonly>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-medium mb-1">Last Name</label>
                        <input type="text" name="nom" value="{{ $user->nom }}" class="w-full border rounded-lg px-3 py-2 bg-gray-100 pointer-events-none" readonly>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded-lg px-3 py-2 bg-gray-100 pointer-events-none" readonly>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Phone Number</label>
                    <input type="text" name="numero" value="{{ $user->numero }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Class</label>
                    <input type="text" name="classe" value="{{ old('classe') }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">Participate</button>
            </form>
        </div>
    </div>
</body>

</html>