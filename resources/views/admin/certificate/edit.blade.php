<x-layouts.admin>
    <form action="{{ route('admin.certificate.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex flex-col items-center justify-center w-full">
            <div class="bg-gray-900 text-gray-300 p-12 w-2/3 rounded-lg flex flex-col items-center justify-center">
                <div class="w-full mb-4">
                    <label for="name" class="block mb-2">Name</label>
                    <input class="w-full p-2 text-gray-950 rounded" type="text" name="name" placeholder="Name" value="{{ old('name', $certificate->name) }}" required>
                </div>
                <div class="w-full mb-4">
                    <label for="issued_by" class="block mb-2">Issued By</label>
                    <input class="w-full p-2 text-gray-950 rounded" type="text" name="issued_by" placeholder="Issued By" value="{{ old('issued_by', $certificate->issued_by) }}" required>
                </div>
                <div class="w-full mb-4">
                    <label for="issued_at" class="block mb-2">Date</label>
                    <input class="w-full p-2 text-gray-950 rounded" type="date" name="issued_at" value="{{ old('issued_at', $certificate->issued_at) }}" required>
                </div>
                <div class="w-full mb-4">
                    <label for="description" class="block mb-2">Description</label>
                    <textarea class="w-full p-2 text-gray-950 rounded" name="description" placeholder="Description">{{ old('description', $certificate->description) }}</textarea>
                </div>
                <div class="w-full mb-4">
                    <label for="file" class="block mb-2">File</label>
                    <input class="w-full p-2 text-gray-950 rounded" type="file" name="file" accept=".pdf" id="fileInput">
                </div>

                <!-- Link to view the current file -->
                <div class="w-full mb-4">
                    @if($certificate->file)
                        <p class="text-gray-400">
                            Current File: 
                            <a href="{{ asset('storage/' . $certificate->file) }}" target="_blank" class="text-blue-500 underline">View File</a>
                        </p>
                    @endif
                </div>
            </div>

            <div class="w-2/3 flex justify-end mt-6">
                <button class="bg-gray-900 text-white py-2 px-6 rounded" type="submit">Update Certificate</button>
            </div>
        </div>
    </form>
</x-layouts.admin>
