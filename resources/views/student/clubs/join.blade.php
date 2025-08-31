<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join {{ $club->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-purple-50 min-h-screen flex items-center justify-center">
    <div class="flex flex-col md:flex-row w-full max-w-5xl rounded-2xl shadow-lg overflow-hidden">
        <!-- Left: Club Info -->
      <div class="md:w-1/2 w-full bg-gradient-to-br from-purple-600 to-indigo-700 flex flex-col justify-center items-center p-8 md:p-12 text-white relative overflow-hidden rounded-xl shadow-xl">
    <!-- Decorative elements -->
    <div class="absolute -top-20 -right-20 w-40 h-40 rounded-full bg-purple-500 opacity-20"></div>
    <div class="absolute -bottom-10 -left-10 w-32 h-32 rounded-full bg-indigo-400 opacity-20"></div>
    
    <div class="relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight tracking-tight">
            Welcome to our<br><span class="text-purple-200">community</span>
        </h1>
        
        @if (!empty($club->objective))
            <div class="mb-8 bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20 max-w-md mx-auto">
            <p class="mt-1 text-white">{{ $club->objective }}</p>
        </div>
        @endif
        
    </div>
    
    <div class="relative z-10 mt-8 flex flex-col items-center">
        <div class="relative group">
            <div class="absolute -inset-1 bg-purple-400 rounded-full blur opacity-75 group-hover:opacity-100 transition duration-200 animate-pulse"></div>
            <img src="{{ $club->logo ? asset('storage/' . $club->logo) : asset('images/logo.png') }}" 
                 alt="{{ $club->name }} Logo" 
                 class="relative h-24 w-24 rounded-full object-cover border-4 border-white shadow-lg">
        </div>
        <span class="mt-4 text-xl font-bold tracking-wide">{{ $club->name }}</span>
    </div>
</div>
        <!-- Right: Join Form -->
        <div class="md:w-1/2 w-full bg-white p-10 flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-4 text-gray-900">Join {{ $club->name }}</h2>

            <form method="POST" action="{{ route('student.clubs.join.submit', $club->id) }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ $user->nom . ' ' . $user->prenom }}" class="w-full border rounded-lg px-3 py-2 bg-gray-100" readonly>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded-lg px-3 py-2 bg-gray-100" readonly>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Phone Number</label>
                    <input type="text" name="numero" value="{{ $user->numero }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Facebook Link</label>
                    <input type="url" name="facebook_link" value="{{ old('facebook_link') }}" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Instagram Link</label>
                    <input type="url" name="instagram_link" value="{{ old('instagram_link') }}" class="w-full border rounded-lg px-3 py-2">
                </div>
                <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition">Join</button>
            </form>
        </div>
    </div>
</body>
</html>
