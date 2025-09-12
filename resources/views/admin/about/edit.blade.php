<x-layouts.admin>
    <form action="{{ route('admin.about.update', $about->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-col items-center justify-center w-full">
            <div class="bg-gray-900 text-gray-300 p-12 w-2/3 rounded-lg flex flex-col items-center justify-center">
                <!-- Title Field -->
                <div class="w-full mb-4">
                    <label for="title" class="block mb-2">Nama</label>
                    <input class="w-full p-2 text-gray-950 rounded" type="text" name="title" placeholder="Title" value="{{ old('title', $about->title) }}" required>
                </div>

                <!-- Description Field -->
                <div class="w-full mb-4">
                    <label for="description" class="block mb-2">Deskripsi About</label>
                    <textarea class="w-full p-2 text-gray-950 rounded bg-white" name="description" placeholder="Deskripsi" rows="4" required>{{ old('description', $about->description) }}</textarea>
                </div>
            </div>

            <div class="w-2/3 flex justify-end mt-6">
                <button class="bg-gray-900 text-white py-2 px-6 rounded" type="submit">Update About</button>
            </div>
        </div>
    </form>
</x-layouts.admin>
