<x-layouts.admin>
    <div class="container mx-auto flex flex-col justify-center items-center p-4">

        <!-- Tabel About -->
        <div class="w-full max-w-6xl">
            <table id="about-table" class="min-w-full bg-white rounded-lg my-6">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="py-3 px-5 border border-gray-300 text-center">NO</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Nama</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Description</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTable will populate here -->
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-between mt-4 w-full max-w-6xl items-center">
        <div class="dataTables_info text-gray-700"></div>
        <div class="dataTables_paginate"></div>
    </div>

    <!-- Modal untuk Detail -->
    <div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg w-1/2">
            <h3 id="detailTitle" class="text-2xl font-semibold mb-4"></h3>
            <p id="detailDescription" class="text-gray-700"></p>
            <button id="closeModal" class="mt-4 py-2 px-4 bg-gray-600 text-white rounded hover:bg-gray-700">Close</button>
        </div>
    </div>

    <!-- Script DataTable dan SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            let table = $('#about-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.about.data') }}", // Pastikan rute data ini sesuai dengan controller
                pagingType: "simple_numbers",
                columns: [
                    { data: 'id', name: 'id', className: 'text-center py-2 px-3' },
                    { data: 'title', name: 'title', className: 'text-left py-2 px-3' },
                    {
                        data: 'description',
                        name: 'description',
                        className: 'text-left py-2 px-2',
                        render: function (data, type, row) {
                            return `
                                <div class="flex justify-center items-center">
                                    <button data-id="${row.id}" class="detail-btn py-1 px-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Detail</button>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center py-2',
                        render: function (data, type, row) {
                            return `
                                <a href="${data.edit_url}" class="font-Poppins py-1 px-3 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition inline-block">Edit</a>
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
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                    infoFiltered: "(disaring dari _MAX_ entri keseluruhan)"
                },
            });

            // Menampilkan data detail di modal
            $(document).on('click', '.detail-btn', function () {
                let id = $(this).data('id');

                $.ajax({
                    url: `/admin/about/${id}`, // Ganti dengan route yang sesuai untuk mengambil detail
                    method: 'GET',
                    success: function (response) {
                        // Isi data ke modal
                        $('#detailTitle').text(response.title);
                        $('#detailDescription').text(response.description); // Menampilkan deskripsi

                        // Tampilkan modal
                        $('#detailModal').removeClass('hidden');
                    },
                    error: function () {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat mengambil data detail.', 'error');
                    }
                });
            });

            // Menutup Modal
            $('#closeModal').click(function () {
                $('#detailModal').addClass('hidden');
            });

            // Tombol Hapus
            $(document).on('click', '.delete-btn', function () {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin ingin menghapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/about/${id}`, // Ganti dengan route yang sesuai untuk penghapusan
                            method: 'DELETE',
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                                    table.ajax.reload(); // Reload DataTable setelah hapus
                                } else {
                                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                                }
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
