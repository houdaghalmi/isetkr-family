<nav class="bg-white shadow mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Navigation Links -->
            <div class="flex space-x-6 mx-auto">
                 <a href="{{ url('/') }}" class="text-gray-700 hover:text-purple-700 font-semibold transition">Home</a>
                <a href="{{ route('responsible.dashboard') }}" class="text-gray-700 hover:text-purple-700 font-semibold transition">Dashboard</a>

                 <a href="{{ route('student.clubs.index') }}" class="text-gray-700 hover:text-purple-700 font-semibold transition">Clubs</a>
                <a href="{{ route('responsible.clubs.index') }}" class="text-gray-700 hover:text-purple-700 font-semibold transition">My Clubs</a>

                <a href="{{ route('student.events.index') }}" class="text-gray-700 hover:text-purple-700 font-semibold transition">Events</a>
                <a href="" class="text-gray-700 hover:text-purple-700 font-semibold transition">My Events</a>

                <a href="{{ route('student.posts.index') }}" class="text-gray-700 hover:text-purple-700 font-semibold transition">Posts</a>
                <a href="" class="text-gray-700 hover:text-purple-700 font-semibold transition">My Posts</a>
                
            </div>
        </div>
    </div>
</nav>
