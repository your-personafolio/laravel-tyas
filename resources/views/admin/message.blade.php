<x-layouts.admin>
    <div class="container mx-auto flex flex-col justify-center items-center p-4">
        <div class="w-full max-w-6xl">
            <table id="messages-table" class="min-w-full bg-white rounded-lg my-6">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="py-3 px-5 border border-gray-300 text-center">ID</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Nama</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Email</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- ISI DATATABLES -->
                </tbody>
            </table>
        </div>

        <!-- Modal untuk Detail Pesan -->
        <div id="messageModal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-6 w-1/3">
                <h3 class="text-xl font-semibold text-center mb-4">Detail Pesan</h3>
                <div id="messageDetails">
                    <p><strong>Nama:</strong> <span id="modalName"></span></p>
                    <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                    <p><strong>Pesan:</strong> <span id="modalMessage"></span></p>
                </div>
                <div class="flex justify-center mt-4">
                    <button id="closeModalButton" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Tutup</button>
                </div>
            </div>
        </div>

        <div class="flex justify-between mt-4 w-full max-w-6xl items-center">
            <div class="dataTables_info text-gray-700"></div>
            <div class="dataTables_paginate"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#messages-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.message.data") }}',
                columns: [
                    { data: null, render: function(data, type, row, meta) {
                        return '<div class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</div>';
                    }, name: 'id', orderable: false, searchable: false },
                    { data: 'name', name: 'name', render: function(data) {
                        return '<div class="text-center py-6">' + data + '</div>';
                    }},
                    { data: 'email', name: 'email', render: function(data) {
                        return '<div class="text-center">' + data + '</div>';
                    }},
                    { data: null, render: function(data) {
                        return '<div class="flex justify-center items-center py-4 px-2"> \
                                    <button class="text-white text-center detailButton bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white hover:border-blue-600 transition duration-300" data-id="' + data.id + '" data-name="' + data.name + '" data-email="' + data.email + '" data-message="' + data.message + '">Lihat</button> \
                                </div>';
                    }, orderable: false, searchable: false }
                ],
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
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

            // Menampilkan modal dengan data pesan
            $(document).on('click', '.detailButton', function() {
                var name = $(this).data('name');
                var email = $(this).data('email');
                var message = $(this).data('message');

                // Memasukkan data ke dalam modal
                $('#modalName').text(name);
                $('#modalEmail').text(email);
                $('#modalMessage').text(message);

                // Menampilkan modal
                $('#messageModal').removeClass('hidden');
            });

            // Menutup modal
            $('#closeModalButton').click(function() {
                $('#messageModal').addClass('hidden');
            });
        });
    </script>
</x-layouts.admin>
