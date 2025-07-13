<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meet our members</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .member-card {
            transition: all 0.3s ease;
        }
        .member-card:hover {
            transform: scale(1.05);
        }
        .member-info {
            text-align: center;
            margin-top: 1rem;
        }
        .member-name {
            font-weight: bold;
            font-size: 1.125rem;
            line-height: 1.2;
        }
        .member-role {
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        .highlight-member .avatar-container {
            border-color: #8B5CF6;
            background-color: #FDE68A;
            box-shadow: 0 4px 6px -1px rgba(139, 92, 246, 0.2);
        }
    </style>
</head>
<body class="bg-white">
    @include('components.topbar')

    <div class="max-w-6xl mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Meet our members</h1>
            <div class="text-xl text-gray-500 mb-8">More than members , they are the heartbeat of who we are</div>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">
            @foreach($members as $member)
            <div class="member-card {{ $loop->index == $centerIndex ? 'highlight-member' : '' }} flex flex-col items-center">
                <div class="avatar-container rounded-full border-4 {{ $loop->index == $centerIndex ? 'border-purple-300 bg-amber-100' : 'border-gray-200 bg-gray-100' }} overflow-hidden w-32 h-32">
                    <img src="{{ $member->avatar && file_exists(public_path('storage/' . $member->avatar)) ? asset('storage/' . $member->avatar) : asset('images/default-avatar.png') }}"
                         alt="{{ $member->nom . ' ' . $member->prenom }}"
                         class="object-cover w-full h-full"
                    >
                </div>
                
                <div class="member-info">
                    <div class="member-name">{{ $member->nom . ' ' . $member->prenom }}</div>
                    <div class="member-role">{{ $member->pivot->function }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>