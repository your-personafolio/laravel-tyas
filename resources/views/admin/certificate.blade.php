<x-layouts.admin>
    <div class="container mx-auto flex flex-col justify-center items-center p-4">
        <div class="flex justify-center mb-4 w-full">
            <a href="{{ route('admin.certificate.create') }}" 
               class="py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                Tambah Sertifikat
            </a>
        </div>

        <div class="w-full max-w-6xl">
            <table id="certificate-table" class="min-w-full bg-white rounded-lg my-6">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="py-3 px-5 border border-gray-300 text-center">NO</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Name</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Issued By</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">File</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Detail</th>
                        <th class="py-3 px-5 border border-gray-300 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTables populates this dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#certificate-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.certificate.data') }}',
                columns: [
                    { 
                        data: 'id', 
                        name: 'id',
                        className: 'text-center py-4',
                        render: function(data, type, row, meta) {
                            return meta.row + 1; // Display row number
                        }
                    },
                    { data: 'name', name: 'name', className: 'text-center py-2' },
                    { data: 'issued_by', name: 'issued_by', className: 'text-center py-2' },
                    { 
                        data: 'file', 
                        name: 'file', 
                        render: function(data) {
                            return `<div class="flex justify-center">
                                        <a href="/storage/${data}" target="_blank" 
                                           class="text-white bg-blue-500 py-1 px-3 rounded-md hover:bg-white hover:border-2 hover:border-blue-500 hover:text-blue-500 transition-all duration-300 ease-in-out">
                                           Lihat File
                                        </a>
                                    </div>`;
                        } 
                    },
                    { 
                        data: 'id', 
                        name: 'detail', 
                        render: function(data, type, row) {
                            return `<div class="flex justify-center">
                                        <button onclick="showCertificateDetails(${data})" 
                                                class="text-white bg-green-500 py-1 px-3 rounded-md hover:bg-white hover:border-2 hover:border-green-500 hover:text-green-500 hover:shadow-md transition-all duration-300 ease-in-out">
                                            Review
                                        </button>
                                    </div>`;
                        },
                        orderable: false, 
                        searchable: false 
                    },
                    { 
                        data: 'action', 
                        name: 'action',
                        render: function(data) {
                            return `<div class="flex justify-center space-x-2">
                                        <a href="${data.edit_url}" 
                                           class="text-white bg-orange-500 py-1 px-3 rounded-md hover:bg-orange-600 transition-all duration-300">
                                            Edit
                                        </a>
                                        <button onclick="confirmDelete(${data.delete_id})" 
                                                class="text-white bg-red-500 py-1 px-3 rounded-md hover:bg-red-600 transition-all duration-300">
                                            Delete
                                        </button>
                                    </div>`;
                        },
                        orderable: false, 
                        searchable: false
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
        });

        function showCertificateDetails(certificateId) {
            $.ajax({
                url: '/admin/certificate/' + certificateId,
                method: 'GET',
                success: function(data) {
                    Swal.fire({
                        title: 'Certificate Details',
                        html: `
                            <p><strong>Name:</strong> ${data.name}</p>
                            <p><strong>Issued by:</strong> ${data.issued_by}</p>
                            <p><strong>Issued at:</strong> ${new Date(data.issued_at).toLocaleDateString()}</p>
                            <p><strong>Description:</strong> ${data.description || 'No description available'}</p>
                        `,
                        icon: 'info',
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to fetch data.',
                        icon: 'error',
                    });
                }
            });
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/admin/certificate/' + id;

                    var methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    form.appendChild(methodInput);

                    var csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    form.appendChild(csrfToken);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        @endif
    </script>
</x-layouts.admin>
