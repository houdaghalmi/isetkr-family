<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer un evenement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow mt-10">
        <h2 class="text-2xl font-bold mb-6">creer un evenement</h2>
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-gray-700 font-semibold mb-2">titre</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" placeholder="nom du l'evenement">
                <span class="text-xs text-gray-400 float-right">0/30</span>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">nom du formatrice</label>
                <input type="text" name="intervenant" class="w-full border rounded px-3 py-2" placeholder="nom du formatrice">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">club responsable</label>
                <select name="club_id" class="w-full border rounded px-3 py-2">
                    <option value="">Select club responsable</option>
                    @foreach($clubs as $club)
                        <option value="{{ $club->id }}">{{ $club->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" placeholder="Details about event"></textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Date et heure</label>
                <input type="datetime-local" name="datetime" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Localisation</label>
                <input type="text" name="location" class="w-full border rounded px-3 py-2" placeholder="Lieu de l'événement" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">affiche d'evenement</label>
                <input type="file" name="poster" accept="image/*" class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" id="certificated" name="certificated" class="border rounded">
                <label for="certificated" class="text-gray-700">certificated</label>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" class="bg-gray-200 text-gray-700 px-6 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Create Event</button>
            </div>
        </form>
    </div>
</body>
</html>
