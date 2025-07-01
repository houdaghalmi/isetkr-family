<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
<div class="flex min-h-screen">
    <!-- Sidebar (reuse from index page) -->
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
                        <i class="fas fa-envelope mr-3"></i> messages
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center py-2 px-4 rounded bg-blue-100">
                        <i class="fas fa-user mr-3"></i> Users
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col p-8">
        <div class="max-w-xl mx-auto bg-white rounded-lg shadow p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit User</h2>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Prénom</label>
                    <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Numéro</label>
                    <input type="text" name="numero" value="{{ old('numero', $user->numero) }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Role</label>
                    <select name="role" class="w-full border rounded px-3 py-2">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="club_responsible" {{ old('role', $user->role) == 'club_responsible' ? 'selected' : '' }}>Club Responsible</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Avatar</label>
                    <input type="file" name="avatar" class="w-full border rounded px-3 py-2">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="h-16 w-16 rounded-full mt-2" alt="avatar">
                    @endif
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Clubs responsable</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($clubs as $club)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="clubs[]" value="{{ $club->id }}" {{ $user->clubs->contains($club->id) ? 'checked' : '' }}>
                                <span>{{ $club->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save</button>
                    <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:underline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FontAwesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
