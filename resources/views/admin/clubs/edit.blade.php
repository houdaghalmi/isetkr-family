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
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow mt-10">
        <h2 class="text-2xl font-bold mb-6">Edit Club</h2>
        <form action="{{ route('admin.clubs.update', $club) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', $club->name) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Logo</label>
                @if($club->logo)
                    <img src="{{ asset('storage/' . $club->logo) }}" alt="Current Logo" class="w-16 h-16 rounded-full mb-2">
                @endif
                <input type="file" name="logo" accept="image/*" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $club->description) }}</textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Objective</label>
                <textarea name="objective" class="w-full border rounded px-3 py-2">{{ old('objective', $club->objective) }}</textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Responsible User</label>
                <select name="responsable_user_id" class="w-full border rounded px-3 py-2" required>
                    @foreach($responsibles as $user)
                        <option value="{{ $user->id }}" @if($club->responsable_user_id == $user->id) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="active" @if($club->status == 'active') selected @endif>Active</option>
                    <option value="inactive" @if($club->status == 'inactive') selected @endif>Inactive</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700">Update Club</button>
            </div>
        </form>
    </div>
</body>
</html>
