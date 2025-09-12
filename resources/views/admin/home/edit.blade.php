<!-- Form Edit -->
<x-layouts.admin>
    <form action="{{ route('admin.home.update', $home->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Menandakan bahwa ini adalah request PUT -->
        <div class="w-full flex flex-col justify-center items-center">
            <div class="bg-gray-900 text-gray-300 w-2/3 p-12 rounded-lg flex flex-col justify-center items-center">
                <table class="w-full">
                    <!-- Input untuk Name -->
                    <tr>
                        <td class="w-1/3"><label for="name" class="block mb-1 font-semibold">Name</label></td>
                        <td class="w-1/12 text-center"><p>:</p></td>
                        <td class="w-2/3 p-2">
                            <input type="text" name="name" id="name" class="w-full text-gray-900 p-2 border rounded-md" placeholder="Enter name" value="{{ old('name', $home->name) }}" required>
                        </td>
                    </tr>

                    <!-- Input untuk Skills -->
                    <tr>
                        <td><label for="skills" class="block mb-1 font-semibold">Skills (Keahlian)</label></td>
                        <td class="text-center"><p>:</p></td>
                        <td class="p-2">
                            <textarea name="skills" id="skills" class="w-full text-gray-900 p-2 border rounded-md bg-white" placeholder="Enter skills">{{ old('skills', $home->skills) }}</textarea>
                        </td>
                    </tr>

                    <!-- Input untuk Description -->
                    <tr>
                        <td><label for="description" class="block mb-1 font-semibold">Description</label></td>
                        <td class="text-center"><p>:</p></td>
                        <td class="p-2">
                            <textarea name="description" id="description" class="w-full text-gray-900 p-2 border rounded-md bg-white" placeholder="Enter description">{{ old('description', $home->description) }}</textarea>
                        </td>
                    </tr>

                    <!-- Input untuk Gambar -->
                    <tr>
                        <td><label for="image" class="block mb-1 font-semibold">Image</label></td>
                        <td class="text-center"><p>:</p></td>
                        <td class="p-2">
                            <!-- Menampilkan gambar lama jika ada -->
                            @if($home->image)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $home->image) }}" alt="Home Image" class="w-24 h-24 object-cover rounded-lg">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" class="w-full text-gray-900 p-2 border rounded-md">
                        </td>
                    </tr>
                </table>
            </div>
            <!-- Tombol Submit -->
            <div class="w-2/3 flex justify-end">
                <button type="submit" class="bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700 transition duration-200 mt-4">
                    Update
                </button>
            </div>
        </div>
    </form>
</x-layouts.admin>
