<nav class="bg-gradient-to-r from-[#2d3480] to-[#3d4490] shadow-lg rounded-b-lg mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Navigation Links -->
            <div class="flex space-x-6 mx-auto">
                <a href="{{ route('responsible.dashboard') }}" class="text-white font-semibold relative transition duration-300 hover:text-[#f59e0b] group">
                    Dashboard
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#f59e0b] transition-all duration-300 group-hover:w-full"></span>
                </a>

                <a href="{{ route('student.clubs.index') }}" class="text-white font-semibold relative transition duration-300 hover:text-[#f59e0b] group">
                    Clubs
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#f59e0b] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('student.events.index') }}" class="text-white font-semibold relative transition duration-300 hover:text-[#f59e0b] group">
                    Events
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#f59e0b] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('student.posts.index') }}" class="text-white font-semibold relative transition duration-300 hover:text-[#f59e0b] group">
                    Posts
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#f59e0b] transition-all duration-300 group-hover:w-full"></span>
                </a>

                <a href="{{ route('responsible.clubs.index') }}" class="text-white font-semibold relative transition duration-300 hover:text-[#f59e0b] group">
                    My Clubs
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#f59e0b] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('responsible.events.index') }}" class="text-white font-semibold relative transition duration-300 hover:text-[#f59e0b] group">
                    My Events
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#f59e0b] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('responsible.posts.index') }}" class="text-white font-semibold relative transition duration-300 hover:text-[#f59e0b] group">
                    My Posts
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#f59e0b] transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>
        </div>
    </div>
</nav>
