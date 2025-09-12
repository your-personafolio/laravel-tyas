<x-layouts.admin>

    <form action="{{ route('admin.contact.store') }}" method="POST">
        @csrf
        <div class="w-full flex justify-center items-center">
            <div class="bg-gray-900 text-white rounded-xl px-12 py-6 w-1/2">
                <table class="w-full">
                    <tr>
                        <td><label for="sosmed">Sosial Media</label></td>
                        <td><label for="sosmed">:</label></td>
                        <td class="py-3">
                            <input type="text" name="sosmed" id="sosmed" required class="w-full bg-white text-black" placeholder="Masukkan nama sosial media">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="name">Name</label></td>
                        <td><label for="name">:</label></td>
                        <td class="py-3">
                            <input type="text" name="name" id="name" required class="w-full bg-white text-black" placeholder="Masukkan nama pengguna">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="link">Link</label></td>
                        <td><label for="link">:</label></td>
                        <td class="py-3">
                            <input type="url" name="link" id="link" required class="w-full bg-white text-black" placeholder="Masukkan link sosial media">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="issued_at">Issued At</label></td>
                        <td><label for="issued_at">:</label></td>
                        <td class="py-3">
                            <input type="date" name="issued_at" id="issued_at" required class="w-full bg-white text-black">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right py-3">
                            <button type="submit" class="bg-white text-black py-2 px-6 rounded-md hover:bg-gray-800 hover:text-white transition">
                                Tambah Contact
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

    <style>
        table td:nth-child(1) {
            width: 25%;
        }

        table td:nth-child(2) {
            width: 5%;
        }

        table td:nth-child(3) {
            width: 70%;
        }
    </style>
</x-layouts.admin>
