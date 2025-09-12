<x-layouts.admin>
    <form action="{{ route('admin.certificate.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full flex flex-col justify-center items-center">
            <div class="bg-gray-900 text-gray-300 w-2/3 p-12 rounded-lg flex flex-col-reverse justify-center items-center">
                <table class="w-full">
                    <tr>
                        <td><label for="name">Name</label></td>
                        <td><p>:</p></td>
                        <td class="p-2">
                            <input class="w-full text-gray-950" type="text" name="name" placeholder="Name" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="issued_by">Issued By</label></td>
                        <td><p>:</p></td>
                        <td class="p-2">
                            <input class="w-full text-gray-950" type="text" name="issued_by" placeholder="Issued By" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="issued_at">Issued At</label></td>
                        <td><p>:</p></td>
                        <td class="p-2">
                            <input class="w-full text-gray-950" type="date" name="issued_at" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="description">Description</label></td>
                        <td><p>:</p></td>
                        <td class="p-2">
                            <textarea class="w-full text-gray-950" name="description" placeholder="Description"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="file">Certificate File (PDF Only)</label></td>
                        <td><p>:</p></td>
                        <td class="p-2">
                            <input class="w-full text-gray-950" type="file" name="file" accept="application/pdf" id="fileInput" required>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="w-2/3 flex justify-end">
                <button class="text-white bg-gray-900 my-6 py-2 px-6 rounded-md" type="submit">Tambah Sertifikat</button>
            </div>
        </div>
    </form>
</x-layouts.admin>
