<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white border-r border-gray-200">
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.clubs.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                        <i class="fas fa-users mr-3"></i> Clubs
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.events.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                        <i class="fas fa-calendar-alt mr-3"></i> Events
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                        <i class="fas fa-newspaper mr-3"></i> Posts
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.messages.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                        <i class="fas fa-envelope mr-3"></i> Messages
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center py-2 px-4 rounded bg-blue-100 text-blue-700">
                        <i class="fas fa-user mr-3"></i> Users
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold mb-6 text-gray-800">Edit User</h2>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" required 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Numéro</label>
                            <input type="text" name="numero" value="{{ old('numero', $user->numero) }}" 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <select name="role" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="club_responsible" {{ old('role', $user->role) == 'club_responsible' ? 'selected' : '' }}>Club Responsible</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Avatar</label>
                            <div class="flex items-center space-x-4">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" class="w-16 h-16 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                @endif
                                <input type="file" name="avatar" 
                                       class="flex-1 text-sm border border-gray-300 rounded-md file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Full Width Field -->
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Clubs Responsable</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach($clubs as $club)
                        <label class="flex items-center space-x-2 p-2 rounded hover:bg-gray-50">
                            <input type="checkbox" name="clubs[]" value="{{ $club->id }}" 
                                   class="h-4 w-4 border-gray-300 rounded text-purple-600 focus:ring-purple-500"
                                   {{ $user->clubs->contains($club->id) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">{{ $club->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 flex justify-end border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-3">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>