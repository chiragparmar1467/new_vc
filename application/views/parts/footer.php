</div>
<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. <a
                href="#" > <?php echo $company_data['company_name']; ?></a>. All rights reserved.</span>
    </div>
</footer>
</div>
<!-- main panel -->
</div>
<!-- container-fluid page-body-wrapper -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= base_url() ?>assets/vendors/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="<?= base_url() ?>assets/js/dataTables.select.min.js"></script>


<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
<script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
<script src="<?= base_url() ?>assets/js/template.js"></script>
<script src="<?= base_url() ?>assets/js/settings.js"></script>
<script src="<?= base_url() ?>assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?= base_url() ?>assets/js/dashboard.js"></script>
<script src="<?= base_url() ?>assets/js/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->

<script src="<?= base_url() ?>assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/select2/select2.min.js"></script>

<script src="<?= base_url() ?>assets/js/file-upload.js"></script>
<script src="<?= base_url() ?>assets/js/typeahead.js"></script>
<script src="<?= base_url() ?>assets/js/select2.js"></script>

<!-- data table -->
<script>
$(function() {
    $("#example1").DataTable({
        "autoWidth": false,
    });
});
</script>
<!-- data table close  -->
</body>

</html>