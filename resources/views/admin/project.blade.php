<x-layouts.admin>
    <div class="container mx-auto flex flex-col justify-center items-center p-4">
        <!-- Tombol Tambah Project -->
        <div class="flex justify-center mb-4 w-full">
            <a href="{{ route('admin.project.create') }}" class="py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">Tambah Project</a>
        </div>

        <!-- Tabel Project -->
        <div class="w-full max-w-6xl">
            <table id="project-table" class="min-w-full bg-white rounded-lg my-6">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="py-3 px-5 border border-gray-300 text-center">NO</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Image</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Name</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Description</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Link</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Issued At</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTable akan memuat data di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk menampilkan detail description -->
    <div id="description-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg w-1/3 p-6">
            <h3 class="text-xl font-semibold mb-4">Description</h3>
            <p id="modal-description" class="text-gray-700"></p>
            <button id="close-modal" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">Close</button>
        </div>
    </div>

    <!-- Script DataTable dan SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            // Menampilkan SweetAlert jika ada session success
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif

            let table = $('#project-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.project.data') }}",
                pagingType: "simple_numbers",
                columns: [
                    { data: 'id', name: 'id', className: 'text-center py-2' },
                    {
                        data: 'image',
                        name: 'image',
                        className: 'text-center py-2',
                        render: function(data, type, row) {
                            return data ? `<img src="{{ asset('storage/${data}') }}" alt="Project Image" class="w-20 h-20 object-cover rounded-md mx-auto">` : 'No Image';
                        }
                    },
                    { data: 'name', name: 'name', className: 'text-center py-2' },
                    {
                        data: 'description', // Pastikan data description tersedia
                        name: 'description',
                        className: 'text-center py-2',
                        render: function (data, type, row) {
                            // Membuat tombol Detail dan menyimpan data deskripsi di data-id
                            return `<button class="detail-btn py-1 px-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition" data-description="${data}">Detail</button>`;
                        }
                    },
                    {
                        data: 'link',
                        name: 'link',
                        className: 'text-center py-2',
                        render: function (data, type, row) {
                            return `<a href="${data}" target="_blank" class="py-1 px-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Visit</a>`;
                        }
                    },
                    { data: 'issued_at', name: 'issued_at', className: 'text-center py-2' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center py-2',
                        render: function (data, type, row) {
                            return `
                                <a href="${data.edit_url}" class="py-1 px-3 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Edit</a>
                                <button data-id="${data.delete_id}" class="delete-btn py-1 px-3 bg-red-500 text-white rounded hover:bg-red-600 transition">Hapus</button>
                            `;
                        }
                    }
                ],
                dom: '<"flex justify-between mb-4"<"show_entries"l><"search_filter"f>>t<"flex justify-between mb-4"<"info"i><"pagination"p>>', // Menyusun info dan pagination sejajar
                initComplete: function() {
                    $('div.show_entries select').addClass('ps-2 pe-6 py-1 bg-gray-100 border-gray-800 border-2 rounded-md');
                    $('div.search_filter input').addClass('px-4 py-2 bg-gray-100 border rounded-md border-gray-800 border-2').attr('placeholder', 'Cari'); 
                    $('div.pagination').addClass('py-2 flex items-center gap-2');
                    $('div.pagination').find('a').addClass('px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition');
                    $('div.pagination').find('span').addClass('px-3 py-1 text-gray-600 rounded-md');
                    $('div.info').addClass('py-2 rounded-md');
                },
                language: {
                    search: "",
                    lengthMenu: "Tampilkan _MENU_ Data", 
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri", // Teks info dalam bahasa Indonesia
                    infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri", // Teks ketika tidak ada data
                    infoFiltered: "(disaring dari _MAX_ entri keseluruhan)" // Teks ketika data disaring
                },
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
            });

            // Ketika tombol Detail ditekan
            $(document).on('click', '.detail-btn', function () {
                // Ambil deskripsi dari atribut data-description
                let description = $(this).data('description');
                $('#modal-description').text(description); // Menampilkan deskripsi pada modal
                $('#description-modal').removeClass('hidden'); // Tampilkan modal
            });

            // Menutup modal ketika tombol close ditekan
            $('#close-modal').on('click', function () {
                $('#description-modal').addClass('hidden'); // Menyembunyikan modal
            });

            // SweetAlert untuk Hapus Data
            $(document).on('click', '.delete-btn', function () {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/project/${id}`, // Sesuaikan dengan route delete Anda
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            success: function (response) {
                                Swal.fire('Dihapus!', 'Data berhasil dihapus.', 'success');
                                table.ajax.reload();
                            },
                            error: function () {
                                Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-layouts.admin>
