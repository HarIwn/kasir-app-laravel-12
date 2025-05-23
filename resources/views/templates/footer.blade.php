</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>


<!-- Custom scripts for all pages-->
{{--
<script src="{{ asset('assets') }}/js/sb-admin-2.min.js"></script> --}}

<!-- Page level plugins -->
<script src="{{ asset('assets') }}/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets') }}/js/demo/chart-area-demo.js"></script>
<script src="{{ asset('assets') }}/js/demo/chart-pie-demo.js"></script>

<!-- Toastr JS -->
<script src="{{ asset('assets') }}/vendor/toastr/js/toastr.min.js"></script>
<script>
    // Toastr Produk
    @if (session('success'))
        toastr.success("{{ session('success') }}", 'Berhasil', {
            "closeButton": true,
            "progressBar": true,
            "timeOut": 5000, // durasi tampil
            "extendedTimeOut": 1000, // saat hover
            "positionClass": "toast-top-right",
        });
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}", 'Gagal', {
            "closeButton": true,
            "progressBar": true,
            "timeOut": 5000, // durasi tampil
            "extendedTimeOut": 1000, // saat hover
            "positionClass": "toast-top-right",
        });
    @endif

    // Live Search Produk
    $(document).ready(function () {
        $('#search').on('keyup', function () {
            var keyword = $(this).val().toLowerCase();
            var found = false; // Variabel untuk cek jika ada produk ditemukan

            // Menampilkan kata kunci search
            $('#searchQuery').text(keyword); 

            // Cari produk dalam tabel tbody
            $('#table-list-produk tbody tr').each(function () {
                var rowText = $(this).text().toLowerCase();
                var isMatch = rowText.indexOf(keyword) > -1;

                $(this).toggle(isMatch); // Menampilkan hanya baris yang cocok dengan keyword

                // Jika ada produk, set found = true
                if (isMatch) {
                    found = true;
                }
            });

            // Cek jika ada produk yang ditemukan
            if (!found && keyword != "") {
                // Tampilkan pesan jika tidak ada produk
                $('#noProdukMsg').show();
            } else {
                // Sembunyikan pesan jika ada produk
                $('#noProdukMsg').hide();
            }
        });
    });

</script>
</body>

</html>