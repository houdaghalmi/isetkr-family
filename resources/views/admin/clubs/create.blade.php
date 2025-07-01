<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Club</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow mt-10">
        <h2 class="text-2xl font-bold mb-6">Create Club</h2>
        <form action="{{ route('admin.clubs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Logo</label>
                <input type="file" name="logo" accept="image/*" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Objective</label>
                <textarea name="objective" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Responsible User</label>
                <select name="responsable_user_id" class="w-full border rounded px-3 py-2" required>
                    @foreach($responsibles as $user)
                        <option value="{{ $user->id }}">{{ $user->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700">Create Club</button>
            </div>
        </form>
    </div>
</body>
</html>
