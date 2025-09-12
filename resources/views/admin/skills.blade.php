<x-layouts.admin>
    <div class="container mx-auto flex flex-col justify-center items-center p-4">
        <div class="flex justify-center mb-4 w-full">
            <a href="{{ route('admin.skills.create') }}" class="py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">Tambah Skill</a>
        </div>

        <div class="w-full max-w-6xl">
            <table id="skills-table" class="min-w-full bg-white rounded-lg my-6">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="py-3 px-5 border border-gray-300 text-center">ID</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Title</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Persen</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Action</th>
                    </tr>
                </thead>
                <tbody> 
                    <!-- ISI DATATABLES -->
                </tbody>
            </table>
        </div>

        <div class="flex justify-between mt-4 w-full max-w-6xl items-center">
            <div class="dataTables_info text-gray-700"></div>
            <div class="dataTables_paginate"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#skills-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.skills") }}',
                columns: [
                    { data: null, render: function(data, type, row, meta) {
                        return '<div class="text-center">' + (meta.row + meta.settings._iDisplayStart + 1) + '</div>';
                    }, name: 'id', orderable: false, searchable: false },
                    { data: 'title', name: 'title', render: function(data) {
                        return '<div class="text-center">' + data + '</div>';
                    }},
                    { data: 'persen', name: 'persen', render: function(data) {
                        return '<div class="text-center">' + data + '%</div>'; // Tambahkan persen
                    }},
                    { data: 'action', name: 'action', orderable: false, searchable: false }
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
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                    infoFiltered: "(disaring dari _MAX_ entri keseluruhan)"
                },
            });
        
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session("success") }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-layouts.admin>
