<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Clubs - Responsible</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
        @include('components.responsible-topbar')

    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-8 text-purple-700">My Clubs</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($clubs as $club)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition flex flex-col items-center p-6">
                    <img src="{{ $club->logo ? asset('storage/' . $club->logo) : asset('images/logo.png') }}" alt="Club Logo" class="h-20 w-20 rounded-full object-cover border mb-4">
                    <h2 class="text-lg font-semibold text-purple-700 mb-2">{{ $club->name }}</h2>
                    <div class="flex space-x-6 mb-4">
                        <div class="text-center">
                            <div class="text-xs text-gray-500">Members</div>
                            <div class="font-bold">{{ $club->members_count }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xs text-gray-500">Events</div>
                            <div class="font-bold">{{ $club->events_count }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xs text-gray-500">Posts</div>
                            <div class="font-bold">{{ $club->posts_count }}</div>
                        </div>
                    </div>
                    <div class="flex space-x-3 mb-4">
                        @if($club->facebook_link)
                            <a href="{{ $club->facebook_link }}" target="_blank" class="text-blue-600 hover:text-blue-800" title="Facebook">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.632.771-1.632 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12"></path></svg>
                            </a>
                        @endif
                        @if($club->instagram_link)
                            <a href="{{ $club->instagram_link }}" target="_blank" class="text-pink-500 hover:text-pink-700" title="Instagram">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 3.25a5.25 5.25 0 1 1 0 10.5a5.25 5.25 0 0 1 0-10.5zm0 1.5a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5zm5.25.75a1 1 0 1 1 0 2a1 1 0 0 1 0-2z"/></svg>
                            </a>
                        @endif
                    </div>
                    <div class="flex space-x-2 w-full">
                        <a href="{{ route('responsible.clubs.show', $club->id) }}" class="flex-1 text-center bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition">View Members</a>
                        <a href="{{ route('responsible.clubs.edit', $club->id) }}" class="flex-1 text-center bg-gray-200 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">Edit</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
