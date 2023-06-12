<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; MacDee Restaurant with Bootstrap SB Admin 2 <?= date('Y'); ?></span>
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
                <h5 class="modal-title" id="exampleModalLabel">Yakin mau keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" di bawah jika kamu yakin sudah selesai.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('autentifikasi/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<script>
// $('.custom-file-input').on('change', function() {
//     let fileName = $(this).val().split('\\').pop();
//     $(this).next('.custom-file-label').addClass("selected").html(fileName);
// });


// $('.form-check-input').on('click', function() {
//     const menuId = $(this).data('menu');
//     const roleId = $(this).data('role');

//     $.ajax({
//         url: "<?php //base_url('admin/changeaccess'); ?>",
//         type: 'post',
//         data: {
//             menuId: menuId,
//             roleId: roleId
//         },
//         success: function() {
//             document.location.href = "<?= base_url('admin/akses-role/'); ?>" + roleId;
//         }
//     });
// });
$(document).ready(function() {
    // $("#table-datatable").dataTable();
    //Jalankan perintah ketika element dengan id Jumlah bayar ada aksi keyboard keyup.
    $("#jumlahBayar").keyup(function() {
        //Aksi yang akan dijalankan
        //Akan menyimpan ke dalam variabel totalHarga dengan nilai dari element id totalHarga
        var totalHarga = $("#totalHarga").val();
        //Akan menyimpan ke dalam variabel kembali dengan nilai dari element id JumlahBayar
        //Dikurangi variabel totalHarga
        var kembali = $(this).val() - totalHarga;
        //Akan menampilkan nilai dari kembali ke dalam element dengan id jumlahKembali
        $("#jumlahKembali").val(kembali);
    })
    //Jalankan perintah ketika element dengan id jenisCC jika ada perubahan
    $("#jenisCC").change(function() {
        //Aksi yang dijalankan adalah function bayarChange()
        bayarChange()
    })
    $("#jenisCash").change(function() {
        //AKsi yang dijalankan adalah bayarChange()
        bayarChange()
    })

    function bayarChange() {
        //Jika element dengan id jenisCC yang diklik
        if ($("#jenisCC").is(":checked")) {
            //Element dengan id jumlahBayar akan ditambahkan atribut readonly=true
            $("#jumlahBayar").attr("readonly", true);
            //Element dengan id JumlahBayar akan bernilai sama dengan Total Harga
            $("#jumlahBayar").val($("#totalHarga").val());
            //Element dengna id Jumlah kembali akan bernilai sama dengan 0
            $("#jumlahKembali").val("0")
        } else {
            //Jika element dengan id jenisCash yang dklik
            //Maka element dengan id jumlahBayar akan dihilangkan attribut readonly
            $("#jumlahBayar").removeAttr("readonly");
            //Element dengan id jumlahBayar akan berisi nilai sama dengan totalHarga
            $("#jumlahBayar").val($("#totalHarga").val());
            //Jumlah bayar dikurangi total harga akan disimpan ke dalam variabel kembali
            var kembali = $("#jumlahBayar").val() - $("#totalHarga").val();
            //Element dengan id jumlahKembali akan diberikan nilai sama dengan variabel kembali
            $("#jumlahKembali").val(kembali);
        }
    }

});
$('.alert-message').alert().delay(3500).slideUp('slow');
</script>

</body>


</html>