<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />

<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>backend_admin/Dashboard">Home</a>

                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>


<section class="content">
    <div class="container-fluid">
        <!-- Daily Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-6">
                <div class="small-box card card-dark-blue">
                    <div class="inner" style="padding:20px">
                        <p class="fs-30 mb-2">
                            <?php echo count($customer_data);  ?>
                        </p>
                        <p>Total Members</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-6">

                <div class="small-box card card-light-danger">
                    <div class="inner" style="padding:20px">

                        <p class="fs-30 mb-2">
                            <?php

                            $total_coll = 0;
                            foreach ($customer_data as $total) {
                                $total_coll += $total['opening_balance'];
                            }

                            echo '(₹' . $total_coll . ')';
                            ?>
                        </p>
                        <p>Total Open Bal.</p>
                    </div>
                    <div class="icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {

    $("#li-dashboard").addClass('active');
});
</script>