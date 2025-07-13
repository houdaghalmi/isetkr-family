<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Clubs - Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">
    @include('components.topbar')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="text-center mb-10">
            <h1 class="text-xl text-purple-700 font-semibold mb-2">Our Clubs at ISET Kairouan</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($clubs as $club)
            @if ($club->status==='active')
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col items-center p-6">
                <img src="{{ $club->logo ? asset('storage/' . $club->logo) : asset('images/isetlink.jpg') }}" alt="Club Logo" class="h-20 w-20 rounded-full object-cover border mb-4">
                <a href="{{ route('student.clubs.show', $club->id) }}" class="inline-flex items-center text-purple-700 hover:underline font-semibold">
                    {{ $club->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 7l-10 10m0 0h7m-7 0v-7" />
                    </svg>
                </a>
                <p class="text-gray-600 text-sm mb-4 text-center">{{ Str::limit($club->description, 80) }}</p>
                @if(in_array($club->id, $joinedClubIds))
              <a href="{{ route('student.clubs.leave', $club->id) }}" class="w-full block text-center bg-red-600 text-white py-2 rounded-lg font-semibold hover:red-purple-700 transition">
                    Leave
                </a>
                @else
                <a href="{{ route('student.clubs.join.form', $club->id) }}" class="w-full block text-center bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
                    Join
                </a>
                @endif
            </div>
            @endif
            @endforeach
        </div>
    </div>
</body>

</html>