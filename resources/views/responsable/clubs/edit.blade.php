<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit {{ $club->name }} - Club Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .btn-primary {
            background-color: #2d3480;
            color: white;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background-color: #1a216b;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .input-focus {
            border-color: #c4e9ec;
            box-shadow: 0 0 0 3px rgba(196, 233, 236, 0.3);
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-2xl">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-[#2d3480]">Edit Club</h1>
                <p class="mt-2 text-gray-600">Update details for {{ $club->name }}</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <form action="{{ route('responsible.clubs.update', $club->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                        <!-- Club Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Club Name</label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $club->name) }}" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c4e9ec] focus:border-[#c4e9ec] transition"
                                    placeholder="Enter club name"
                                    required
                                >
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                       
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="3" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c4e9ec] focus:border-[#c4e9ec] transition"
                            placeholder="Brief description about the club"
                            required
                        >{{ old('description', $club->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Objective -->
                    <div>
                        <label for="objective" class="block text-sm font-medium text-gray-700 mb-2">Objective</label>
                        <textarea 
                            id="objective" 
                            name="objective" 
                            rows="2" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c4e9ec] focus:border-[#c4e9ec] transition"
                            placeholder="Club's main objectives"
                        >{{ old('objective', $club->objective) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Facebook Link -->
                        <div>
                            <label for="facebook_link" class="block text-sm font-medium text-gray-700 mb-2">Facebook Link</label>
                            <div class="relative">
                                <input 
                                    type="url" 
                                    id="facebook_link" 
                                    name="facebook_link" 
                                    value="{{ old('facebook_link', $club->facebook_link) }}" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c4e9ec] focus:border-[#c4e9ec] transition"
                                    placeholder="https://facebook.com/club-name"
                                >
                                @if(empty(old('facebook_link', $club->facebook_link)))
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Instagram Link -->
                        <div>
                            <label for="instagram_link" class="block text-sm font-medium text-gray-700 mb-2">Instagram Link</label>
                            <div class="relative">
                                <input 
                                    type="url" 
                                    id="instagram_link" 
                                    name="instagram_link" 
                                    value="{{ old('instagram_link', $club->instagram_link) }}" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c4e9ec] focus:border-[#c4e9ec] transition"
                                    placeholder="https://instagram.com/club-name"
                                >
                                @if(empty(old('instagram_link', $club->instagram_link)))
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Logo -->
                    <div>
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Club Logo</label>
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <input 
                                    type="file" 
                                    id="logo" 
                                    name="logo" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    accept="image/*"
                                >
                                <div class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c4e9ec] focus:border-[#c4e9ec] transition bg-white">
                                    <span class="text-gray-700">Choose file</span>
                                </div>
                            </div>
                            @if($club->logo)
                                <div class="flex-shrink-0 h-16 w-16 rounded-full border-2 border-[#c4e9ec] overflow-hidden">
                                    <img src="{{ asset('storage/' . $club->logo) }}" alt="Club Logo" class="h-full w-full object-cover">
                                </div>
                                <span class="text-sm text-gray-500">Current logo</span>
                            @endif
                            <div id="logo-preview" class="flex-shrink-0 h-16 w-16 rounded-full border-2 border-dashed border-[#c4e9ec] overflow-hidden hidden">
                                <img src="#" alt="New Logo Preview" class="h-full w-full object-cover" id="logo-preview-img">
                            </div>
                        </div>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <script>
                    document.getElementById('logo').addEventListener('change', function(e) {
                        const [file] = e.target.files;
                        if (file) {
                            const preview = document.getElementById('logo-preview');
                            const img = document.getElementById('logo-preview-img');
                            img.src = URL.createObjectURL(file);
                            preview.classList.remove('hidden');
                        }
                    });
                    </script>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                        <a href="{{ url()->previous() }}" class="text-sm font-medium text-[#2d3480] hover:text-[#1a216b] flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary px-6 py-3 rounded-lg font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Club Management System</p>
            </div>
        </div>
    </div>
</body>
</html>