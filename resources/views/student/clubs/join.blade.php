<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join {{ $club->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2d3480',
                        secondary: '#3d4490',
                        accent: '#f59e0b',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="flex flex-col md:flex-row w-full max-w-5xl rounded-2xl shadow-2xl overflow-hidden bg-white">
        
        <!-- Left: Club Info -->
        <div class="md:w-1/2 w-full bg-gradient-to-br from-primary to-secondary flex flex-col justify-center items-center p-10 text-white relative overflow-hidden">
            <!-- Decorative Blobs -->
            <div class="absolute -top-20 -right-20 w-40 h-40 rounded-full bg-accent opacity-20"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 rounded-full bg-white opacity-10"></div>

            <div class="relative z-10 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight tracking-tight">
                    Welcome to our <br>
                    <span class="text-accent">community</span>
                </h1>
                
                @if (!empty($club->objective))
                    <div class="mb-8 bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20 max-w-md mx-auto shadow">
                        <p class="mt-1 text-gray-100">{{ $club->objective }}</p>
                    </div>
                @endif
            </div>

            <!-- Club Logo + Name -->
            <div class="relative z-10 mt-6 flex flex-col items-center">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-accent rounded-full blur opacity-60 group-hover:opacity-100 transition duration-300 animate-pulse"></div>
                    <img src="{{ $club->logo ? asset('storage/' . $club->logo) : asset('images/logo.png') }}" 
                         alt="{{ $club->name }} Logo" 
                         class="relative h-28 w-28 rounded-full object-cover border-4 border-white shadow-xl">
                </div>
                <span class="mt-4 text-2xl font-bold tracking-wide">{{ $club->name }}</span>
            </div>
        </div>

        <!-- Right: Join Form -->
        <div class="md:w-1/2 w-full bg-white p-10 flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-6 text-gray-900 border-b pb-2">Join {{ $club->name }}</h2>

            <form method="POST" action="{{ route('student.clubs.join.submit', $club->id) }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ $user->nom . ' ' . $user->prenom }}" 
                           class="w-full border rounded-lg px-3 py-2 bg-gray-100 focus:ring-2 focus:ring-primary" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" 
                           class="w-full border rounded-lg px-3 py-2 bg-gray-100 focus:ring-2 focus:ring-primary" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="numero" value="{{ $user->numero }}" 
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Facebook Link</label>
                    <input type="url" name="facebook_link" value="{{ old('facebook_link') }}" 
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Instagram Link</label>
                    <input type="url" name="instagram_link" value="{{ old('instagram_link') }}" 
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary">
                </div>

                <button type="submit" 
                        class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-secondary transition transform hover:scale-105 shadow-md">
                    Join Now
                </button>
            </form>
        </div>
    </div>
</body>
</html>
