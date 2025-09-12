<x-layouts.admin>
    <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full flex flex-col justify-center items-center">
            <div class="bg-gray-900 text-gray-300 w-2/3 p-12 rounded-lg flex flex-col-reverse justify-center items-center">
                <table class="w-full">
                    <tr>
                        <td><label for="name">Name</label></td>
                        <td><p>:</p></td>
                        <td class="p-2">
                            <input class="w-full text-gray-950 rounded-md" type="text" name="name" placeholder="Project Name" value="{{ old('name') }}" required>
                            @error('name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label for="description">Description</label></td>
                        <td><p>:</p></td>
                        <td class="p-2">
                            <textarea class="w-full text-gray-950 bg-white" name="description" placeholder="Description" required>{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label for="link">Link</label></td>
                        <td><p>:</p></td>
                        <td class="p-2">
                            <input class="w-full text-gray-950 rounded-md" type="url" name="link" placeholder="Project Link" value="{{ old('link') }}" required>
                            @error('link')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label for="issued_at">Issued At</label></td>
                        <td><p>:</p></td>
                        <td class="p-2">
                            <input class="w-full text-gray-950 rounded-md" type="date" name="issued_at" value="{{ old('issued_at') }}" required>
                            @error('issued_at')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label for="image">Image</label></td>
                        <td><p>:</p></td>
                        <td class="p-2">
                            <input type="file" name="image" accept="image/*" class="w-full text-white">
                            @error('image')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>
                </table>
            </div>
    
            <div class="w-2/3 flex justify-end">
                <button class="text-white bg-gray-900 my-6 py-2 px-6 rounded-md" type="submit">Tambah Project</button>
            </div>
        </div>
    </form>
    

    <style>
        table td:nth-child(1) {
            width: 15%;
        }

        table td:nth-child(2) {
            width: 5%;
        }

        table td:nth-child(3) {
            width: 80%;
        }
    </style>
</x-layouts.admin>
