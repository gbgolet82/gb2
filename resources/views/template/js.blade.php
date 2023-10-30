<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
{{-- <script src="{{ asset('assets/jquery/jquery.js') }}"></script> --}}
<!-- AdminLTE -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- Select2 -->
{{-- <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script> --}}
<script src="{{ asset('tagjs/tagsinput.js') }}"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
<!-- bs-custom-file-input -->
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Daterangepicker -->
<script src="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.js"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            timer: 2000 // Waktu tampilan alert (dalam milidetik)
        });
    </script>
@endif


<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>

<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '/pemasukan-belum-cek',
            method: 'GET',
            success: function(response) {
                $('#jumlah-belum-dicek').text(response.jumlah);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    $(document).ready(function() {
        $.ajax({
            url: '/pemasukan-sudah-cek',
            method: 'GET',
            success: function(response) {
                $('#jumlah-sudah-dicek').text(response.jumlah);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    $(document).ready(function() {
        $.ajax({
            url: '/pengeluaran-belum-cek',
            method: 'GET',
            success: function(response) {
                $('#pengeluaran-belum-dicek').text(response.jumlah);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    $(document).ready(function() {
        $.ajax({
            url: '/pengeluaran-sudah-cek',
            method: 'GET',
            success: function(response) {
                $('#pengeluaran-sudah-dicek').text(response.jumlah);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>

<script>
    $(function() {
        $('[data-toggle="popover"]').popover();

        $(document).on('click', function(e) {
            // Tutup semua popover ketika klik di luar popover
            $('[data-toggle="popover"]').each(function() {
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 &&
                    $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });
    });
    // $(function() {
    //     $('[data-toggle="popover"]').popover()
    // })
    // $(function () {
    // 		$('[data-toggle="tooltip"]').tooltip();
    // 	});
</script>

<!-- Select2 JS -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

{{-- export data akun ke excel --}}
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

<script>
    $(document).ready(function() {
        // $('.select2').select2();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "emptyTable": "No data available in table"
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Get the table and all the select elements
        var table = $('#example2').DataTable();
        var klasifikasiSelect = $('#klasifikasi');
        var usahaSelect = $('#inputGroupSelect01');
        var akunSelect = $('#inputGroupSelect02');

        // Handle filter change for Klasifikasi
        klasifikasiSelect.on('change', function() {
            var selectedKlasifikasi = $(this).val();
            if (selectedKlasifikasi === 'Semua') {
                // Clear the Akun filter
                table.columns(1).search('').draw();
            } else {
                table.columns(1).search(selectedKlasifikasi).draw();
            }
        });

        // Handle filter change for Usaha
        usahaSelect.on('change', function() {
            var selectedUsaha = $(this).val();
            if (selectedUsaha === 'Semua') {
                // Clear the Akun filter
                table.columns(2).search('').draw();
            } else {
                table.columns(2).search(selectedUsaha).draw();
            }
        });

        // Handle filter change for Akun
        akunSelect.on('change', function() {
            var selectedAkun = $(this).val();
            if (selectedAkun === 'Semua') {
                // Clear the Akun filter
                table.columns(3).search('').draw();
            } else {
                table.columns(3).search(selectedAkun).draw();
            }
        });
    });
</script>
