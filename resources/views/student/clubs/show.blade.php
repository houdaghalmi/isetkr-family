<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $club->name }} - Club</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">
    @include('components.topbar')

    <div class="max-w-5xl mx-auto px-4 py-10">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-2">Meet our team</h1>
            @if(in_array($club->id, $joinedClubIds))
            <div class="mb-4 text-gray-500 ">Welcome home. You’re now one of us and we’re so glad you’re here.</div>
            <a href="{{ route('student.clubs.showMembers', $club->id) }}"
                class="w-full mb-3 flex items-center justify-center bg-purple-50 text-purple-700 px-4 py-2 rounded-lg font-medium hover:bg-purple-100 transition border border-purple-200">
                <i class="fas fa-users mr-2 text-sm"></i>
                View All Members
            </a>
            <form method="POST" action="{{ route('student.clubs.leave', $club->id) }}" class="inline-block">
                @csrf
                <button type="submit" class="bg-red-100 text-red-700 px-6 py-2 rounded-lg font-semibold hover:bg-red-200 transition">Leave Club</button>
            </form>
            @else
            <div class="mb-4 text-gray-500">When you join us, you’re not just joining a club you’re joining a passion, and a family.</div>
            <a href="{{ route('student.clubs.join.form', $club->id) }}" class="bg-purple-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-purple-700 transition">Join our club</a>
            @endif
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($members as $member)
            <div class="bg-white rounded-xl shadow flex flex-col items-center p-6">
                <img src="{{ $member->user->avatar && file_exists(public_path('storage/' . $member->user->avatar)) ? asset('storage/' . $member->user->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" class="h-20 w-20 rounded-full object-cover border mb-3">
                <div class="font-bold text-lg mb-1">{{ $member->user->nom . ' ' . $member->user->prenom }}</div>
                <div class="text-purple-600 font-semibold mb-1">{{ $member->function }}</div>
                <div class="text-gray-500 text-sm mb-3">{{ $member->user->bio ?? '' }}</div>
                <div class="flex gap-3">
                    <a href="{{ $member->facebook_link }}" target="_blank" class="text-gray-500 hover:text-blue-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 5.006 3.657 9.128 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 17.006 22 12"></path>
                        </svg>
                    </a>
                    <a href="{{ $member->instagram_link }}" target="_blank" class="text-gray-500 hover:text-pink-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5zm4.25 3.25a5.25 5.25 0 1 1 0 10.5a5.25 5.25 0 0 1 0-10.5zm0 1.5a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5zm5.25.75a1 1 0 1 1 0 2a1 1 0 0 1 0-2z" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>