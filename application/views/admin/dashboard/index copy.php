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
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box card card-dark-blue">
                    <div class="inner" style="padding:20px">
                        <p class="fs-30 mb-2">
                            <?php  echo count($customer_data);  ?>
                        </p>
                        <p>Total Members</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box card card-tale">
                    <div class="inner" style="padding:20px">
                        <p class="fs-30 mb-2">
                            <?php  echo count($account_data);  ?>
                        </p>
                        <p>Total Accounts</p>
                    </div>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box card card-light-danger">
                    <div class="inner" style="padding:20px">

                        <p class="fs-30 mb-2">
                            <?php  echo count($collection_data); 
                                $total_coll = 0;
                                foreach($collection_data as $total){
                                    $total_coll = $total_coll + $total['amount'];
                                }
                            
                                echo '(₹'.$total_coll.')';
                                ?>
                        </p>
                        <p>Total Collection</p>
                    </div>
                    <div class="icon">
                        <!-- <i class="ion ion-person-add"></i> -->
                    </div>

                </div>
            </div>

        </div>
        <!-- Daily Small boxes (Stat box) -->

    </div>
</section>



<br>
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- <h3 class="info-box-text text-center" style="margin-top:1rem">Details</h3> -->

                    <!-- <hr> -->
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <hr>
                       <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="text-center">
                                       
                                        <th>Group Name</th>
                                        <th>Total Collection</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php foreach($groups as $grp){  ?>
                                    <tr class="text-center">
                                       
                                     
                                        <td><?= $grp['name']; ?></td>
                                        <td><?php $total_coll =0; foreach($groups_coll as $total){ 
                                                if($total['fk_group_id'] == $grp['id']){
                                         $total_coll = $total_coll + $total['amount'];
                                            } }echo '(₹'.$total_coll .')'; ?></td>
                                    </tr>
                                <?php }?>

                                </tbody>
                            </table>
                            <hr>
                        </div>
                    </div>
                    <!-- /.card-body -->


                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- <a href="<?php echo base_url().$this->controllerPath ?>/reminder" class="btn btn-warning">reminder</a> -->
</section>


<!-- </div> -->

<script type="text/javascript">
$(document).ready(function() {

    $("#li-dashboard").addClass('active');
});
</script>