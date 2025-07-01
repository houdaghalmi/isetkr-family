<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Club</title>
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
                    <a href="{{ route('admin.clubs.index') }}" class="flex items-center py-2 px-4 rounded bg-blue-100">
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
                    <a href="{{ route('admin.messages.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100 ">
                        <i class="fas fa-envelope mr-3"></i> messages
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100">
                        <i class="fas fa-user mr-3"></i> Users
                    </a>
                </li>
            </ul>
        </nav>
    </div>


<div class="w-full bg-white p-8 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-6 text-gray-800">Edit Club</h2>
    <form action="{{ route('admin.clubs.update', $club) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Club Name</label>
                    <input type="text" name="name" value="{{ old('name', $club->name) }}" 
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                    @if($club->logo)
                        <div class="flex items-center space-x-3 mb-2">
                            <img src="{{ asset('storage/' . $club->logo) }}" alt="Current Logo" class="w-12 h-12 rounded-md object-cover border border-gray-200">
                            <span class="text-xs text-gray-500">Current logo</span>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*" 
                           class="w-full text-sm border border-gray-300 rounded-md file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Responsible User</label>
                    <select name="responsable_user_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Select club responsable</option>
                        @foreach($responsibles as $user)
                            <option value="{{ $user->id }}" @if($club->responsable_user_id == $user->id) selected @endif>{{ $user->nom }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        <option value="active" @if($club->status == 'active') selected @endif>Active</option>
                        <option value="inactive" @if($club->status == 'inactive') selected @endif>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Full Width Fields -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">{{ old('description', $club->description) }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Objective</label>
                <textarea name="objective" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-purple-500 focus:border-purple-500">{{ old('objective', $club->objective) }}</textarea>
            </div>
        </div>
        
        <div class="pt-4 flex justify-end border-t border-gray-200">
            <button type="submit" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                Update Club
            </button>
        </div>
    </form>
</div>


    </div>
</body>
</html>
