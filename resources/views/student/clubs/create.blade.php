<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Club Creation Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        purple: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'input-focus': '0 0 0 3px rgba(139, 92, 246, 0.25)',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .animate-bounce-in {
            animation: bounceIn 0.5s;
        }
        @keyframes bounceIn {
            0% { transform: scale(0.95); opacity: 0; }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body class="font-sans antialiased bg-purple-50">
    <div class="min-h-screen flex items-center justify-center p-4 py-8">
        <div class="w-full max-w-6xl flex flex-col lg:flex-row gap-8 animate-bounce-in">
            <!-- Left Side - Image with Gradient Overlay -->
            <div class="lg:w-1/2 rounded-2xl overflow-hidden shadow-xl relative">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-900/30 to-purple-600/20 z-10"></div>
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87" 
                     alt="Student community"
                     class="w-full h-full object-cover min-h-[300px] lg:min-h-[600px]">
                <div class="absolute bottom-0 left-0 right-0 p-6 text-white z-20">
                    <h2 class="text-2xl font-bold">Build Your Community</h2>
                    <p class="text-purple-100">Be more than a student be a dreamer, a leader.</p>
                </div>
            </div>
            
            <!-- Right Side - Enhanced Form -->
            <div class="lg:w-1/2">
                <!-- Header Section with Decorative Element -->
                <div class="text-center mb-10 relative">
                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-purple-300 rounded-full"></div>
                    <div class="mb-4">
                        <a href="{{ url('/#contact') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800 font-medium transition-colors group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 group-hover:animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            Contact us
                        </a>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-purple-900 mb-3 bg-gradient-to-r from-purple-600 to-purple-800 bg-clip-text text-transparent">
                        New Club Creation Request
                    </h1>
                    <p class="text-lg text-purple-700/80 max-w-md mx-auto">
                        You're not just starting a club, you're creating a community.
                    </p>
                </div>

                <!-- Enhanced Form Section -->
                <form action="{{ route('student.clubs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 rounded-2xl shadow-lg border border-purple-100/50 hover:shadow-xl transition-shadow duration-300">
                    @csrf
                    
                    <!-- Personal Information Section -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-purple-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Personal Information
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-purple-900/90 mb-1">Last Name</label>
                                <input type="text" value="{{ auth()->user()->nom }}" readonly 
                                       class="w-full border border-purple-200/70 rounded-lg px-4 py-3 bg-purple-50/50 text-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all duration-200">
                            </div>
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-purple-900/90 mb-1">First Name</label>
                                <input type="text" value="{{ auth()->user()->prenom }}" readonly 
                                       class="w-full border border-purple-200/70 rounded-lg px-4 py-3 bg-purple-50/50 text-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all duration-200">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-purple-900/90 mb-1">Email</label>
                                <input type="email" value="{{ auth()->user()->email }}" readonly 
                                       class="w-full border border-purple-200/70 rounded-lg px-4 py-3 bg-purple-50/50 text-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all duration-200">
                            </div>
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-purple-900/90 mb-1">Phone Number</label>
                                <input type="text" name="numero" value="{{ auth()->user()->numero }}" 
                                       class="w-full border border-purple-200/70 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all duration-200" 
                                       placeholder="e.g. 06 12 34 56 78">
                            </div>
                        </div>
                    </div>

                    <!-- Club Information Section -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-purple-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                            </svg>
                            Club Information
                        </h3>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-purple-900/90 mb-1">
                                Club Name <span class="text-purple-600">*</span>
                            </label>
                            <input type="text" name="name" required 
                                   class="w-full border border-purple-200/70 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all duration-200" 
                                   placeholder="Enter the official name of your club">
                        </div>

                        <!-- Logo Upload -->
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-purple-900/90 mb-1">
                                Club Logo <span class="text-purple-600">*</span>
                            </label>
                            <div class="border-2 border-dashed border-purple-300 rounded-xl p-6 text-center hover:border-purple-400 transition-all duration-300 bg-purple-50/30 relative group">
                                <div id="uploadArea" class="flex flex-col items-center justify-center space-y-3">
                                    <div class="relative">
                                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div class="absolute -inset-1 bg-purple-100 rounded-full opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                                    </div>
                                    <div>
                                        <p class="text-sm text-purple-700 font-medium">Click to upload</p>
                                        <p class="text-xs text-purple-500">or drag and drop your logo here</p>
                                    </div>
                                    <input type="file" name="logo" accept="image/*" class="hidden" id="logoInput" required>
                                    <label for="logoInput" class="cursor-pointer bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                                        Choose a file
                                    </label>
                                    <p class="text-xs text-purple-400">PNG, JPG, JPEG (Max. 5MB)</p>
                                </div>
                                <img id="logoPreview" src="#" alt="Logo preview" class="mt-4 rounded-lg shadow-md w-full max-w-[200px] mx-auto object-contain hidden transition-all duration-300"/>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-purple-900/90 mb-1">
                                Description <span class="text-purple-600">*</span>
                            </label>
                            <textarea name="description" required rows="4" 
                                      class="w-full border border-purple-200/70 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all duration-200" 
                                      placeholder="Introduce your club in a few words"></textarea>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-purple-900/90 mb-1">
                                Club Objectives <span class="text-purple-600">*</span>
                            </label>
                            <textarea name="objective" required rows="3" 
                                      class="w-full border border-purple-200/70 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all duration-200" 
                                      placeholder="What kind of impact do you want your club to make?"></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white py-3.5 rounded-lg font-semibold text-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Submit Your Request
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const logoInput = document.getElementById('logoInput');
        const logoPreview = document.getElementById('logoPreview');
        const uploadArea = document.getElementById('uploadArea');

        logoInput.addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('File is too large (max 5MB)');
                    this.value = '';
                    return;
                }
                
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    alert('Only JPG, PNG and JPEG files are accepted');
                    this.value = '';
                    return;
                }
                
                logoPreview.src = URL.createObjectURL(file);
                logoPreview.classList.remove('hidden');
                logoPreview.classList.add('animate-bounce-in');
                uploadArea.classList.add('hidden');
            }
        });

        const dropArea = document.querySelector('.border-dashed');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropArea.classList.add('border-purple-500', 'bg-purple-100/50');
            dropArea.classList.remove('border-purple-300');
        }

        function unhighlight() {
            dropArea.classList.remove('border-purple-500', 'bg-purple-100/50');
            dropArea.classList.add('border-purple-300');
        }

        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            logoInput.files = files;
            const event = new Event('change');
            logoInput.dispatchEvent(event);
        }
    </script>
</body>
</html>
