<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Message</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .status-badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 12px;
        }
        .pending { background-color: #fff3cd; color: #856404; }
        .open { background-color: #d1ecf1; color: #0c5460; }
        .answered { background-color: #d4edda; color: #155724; }
    </style>
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
                    <a href="{{ route('admin.messages.index') }}" class="flex items-center py-2 px-4 rounded bg-blue-100">
                        <i class="fas fa-envelope mr-3"></i> messages
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-gray-100 ">
                        <i class="fas fa-user mr-3"></i> Users
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col p-8">
        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.messages.index') }}" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Messages
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Reply to Message</h1>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Original Message -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Original Message</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider">From</label>
                        <p class="mt-1 text-gray-900">{{ $message->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Received</label>
                        <p class="mt-1 text-gray-900">{{ $message->created_at }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Message</label>
                        <div class="mt-1 bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-900 whitespace-pre-line break-words max-w-full overflow-x-auto">{{ $message->message }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reply Form -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Send Reply</h2>
                <form action="{{ route('admin.messages.sendReply', $message->id) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="to_email" class="block text-sm font-medium text-gray-500 uppercase tracking-wider">To</label>
                            <input type="email" id="to_email" value="{{ $message->email }}" class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-50" readonly>
                        </div>
                        <div>
                            <label for="reply_message" class="block text-sm font-medium text-gray-500 uppercase tracking-wider">Reply Message</label>
                            <textarea id="reply_message" name="reply_message" rows="8" 
                                      class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Type your reply here..." required></textarea>
                            @error('reply_message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.messages.index') }}" 
                               class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 flex items-center">
                                <i class="fas fa-paper-plane mr-2"></i> Send Reply
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
