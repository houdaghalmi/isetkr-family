<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow mt-10">
        <h2 class="text-2xl font-bold mb-6">Edit Event</h2>
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700 font-semibold mb-2">titre</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" value="{{ $event->title }}">
                <span class="text-xs text-gray-400 float-right">{{ strlen($event->title) }}/30</span>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">nom du formatrice</label>
                <input type="text" name="intervenant" class="w-full border rounded px-3 py-2" value="{{ $event->intervenant }}">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">club responsable</label>
                <select name="club_id" class="w-full border rounded px-3 py-2">
                    @foreach($clubs as $club)
                        <option value="{{ $club->id }}" {{ $event->club_id == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2">{{ $event->description }}</textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Date et heure</label>
                <input type="datetime-local" name="datetime" class="w-full border rounded px-3 py-2" value="{{ $event->datetime ? $event->datetime->format('Y-m-d\TH:i') : '' }}" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Localisation</label>
                <input type="text" name="location" class="w-full border rounded px-3 py-2" value="{{ $event->location }}" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="pending" {{ $event->status == 'pending' ? 'selected' : '' }}>pending</option>
                    <option value="completed" {{ $event->status == 'completed' ? 'selected' : '' }}>completed</option>
                    <option value="canceled" {{ $event->status == 'canceled' ? 'selected' : '' }}>canceled</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">affiche d'evenement</label>
                <input type="file" name="poster" accept="image/*" class="w-full border rounded px-3 py-2">
                @if($event->poster)
                    <img src="{{ asset('storage/' . $event->poster) }}" alt="Affiche" class="mt-2 w-32 h-32 object-cover rounded">
                @endif
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" id="certificated" name="certificated" class="border rounded" {{ $event->certificated ? 'checked' : '' }}>
                <label for="certificated" class="text-gray-700">certificated</label>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" class="bg-gray-200 text-gray-700 px-6 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>
