<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Club - Club Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }
        .btn-primary {
            background: linear-gradient(90deg, #2d3480, #3d4490);
            color: #fff;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #1a216b;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        }
        .form-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid #e5e7eb;
        }
        .header-title {
            color: #2d3480;
        }
    </style>
</head>
<body>
<div class="max-w-4xl mx-auto px-6 py-10">
    
    <!-- Header -->
    <div class="flex justify-between items-center mb-8 border-b pb-4">
        <div>
            <h1 class="text-2xl font-semibold header-title">Create New Club</h1>
            <p class="text-gray-600 text-sm">Start by telling us about your new club</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card p-8">
        <form action="{{ route('student.clubs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Club Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Club Name *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#f59e0b] focus:border-[#f59e0b]"
                    placeholder="Enter club name" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#f59e0b] focus:border-[#f59e0b]"
                    placeholder="Brief description about the club"
                    required>{{ old('description') }}</textarea>
            </div>

            <!-- Objective -->
            <div>
                <label for="objective" class="block text-sm font-medium text-gray-700 mb-2">Objective</label>
                <textarea 
                    id="objective" 
                    name="objective" 
                    rows="2" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#f59e0b] focus:border-[#f59e0b]"
                    placeholder="Club's main objectives">{{ old('objective') }}</textarea>
            </div>

            <!-- Social Media Links -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="facebook_link" class="block text-sm font-medium text-gray-700 mb-2">Facebook Link</label>
                    <input type="url" id="facebook_link" name="facebook_link" value="{{ old('facebook_link') }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#f59e0b] focus:border-[#f59e0b]" 
                        placeholder="https://facebook.com/club-name">
                </div>
                <div>
                    <label for="instagram_link" class="block text-sm font-medium text-gray-700 mb-2">Instagram Link</label>
                    <input type="url" id="instagram_link" name="instagram_link" value="{{ old('instagram_link') }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#f59e0b] focus:border-[#f59e0b]" 
                        placeholder="https://instagram.com/club-name">
                </div>
            </div>

            <!-- Logo -->
            <div>
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Club Logo *</label>
                <input type="file" id="logo" name="logo" accept="image/*" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#f59e0b] focus:border-[#f59e0b]" required>
            </div>

            <!-- Actions -->
            <div class="flex justify-end pt-6 border-t border-gray-200">
                <button type="submit" class="btn-primary px-6 py-3 rounded-lg font-medium flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Create Club
                </button>
            </div>
        </form>
    </div>

</div>
</body>
</html>
