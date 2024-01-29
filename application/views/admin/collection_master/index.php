<!-- Content Wrapper. Contains page content -->

<!-- <div class="content-wrapper">   -->
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage <?php echo $this->data['name']; ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>backend_admin/Dashboard">Home</a>

                    </li>
                    <li class="breadcrumb-item active"><?php echo $this->data['name']; ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12">
            <?php
                // print_r('<pre>');
                // print_r($this->data['name']);
                // exit();
                ?>

            <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } elseif ($this->session->flashdata('error')) { ?>
            <div class="alert alert-error alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>

            <!-- /.box -->
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Sr. No.</th>
                                    <th>Loan Start Date</th>
                                    <th>Loan Closing Date</th>
                                    <th>Group Name</th>
                                    <!-- <th>Group Short Name</th> -->
                                    <th>Loan Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php  $i = 1; ?>
                                <?php if ($table_data) : ?>
                                <?php foreach ($table_data as $k => $v) : ?>
                                <tr>
                                    <td><?php echo $i; ?>
                                    </td>

                                    <td class="text-center"><?php 
                                     $date = date("d-m-Y", strtotime($v['vc_opening_date'])); 
                                    echo $date; ?>
                                    </td>

                                    <td class="text-center">
                                        <?php 
                                         $date = date("d-m-Y", strtotime($v['vc_closing_date'])); 
                                         echo $date; ?>
                                    </td>

                                    <td class="text-center"><?php echo $v['group_name']; ?></td>

                                    <!-- <td class="text-center"><?php echo $v['short_name']; ?></td> -->

                                    <td class="text-center"><?php  echo  $v['name'];  ?></td>

                                    <td>

                                        <?php if($v['status'] == 1){ ?>
                                        <a href="#" style="color:#009100">Active</a>

                                        <?php   } else{ ?>
                                        <a href="#" class="text-danger">Inactive</a>
                                        <?php       } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url() . $this->controllerPath ?>collection_view/<?php echo $v['vc_id'];  ?>"
                                            title="View Transaction" class="btn btn-warning p-2"><i
                                                class="fa fa-eye"></i></a>
                                        <a href="<?php echo base_url() . $this->controllerPath ?>create/<?= $v['vc_id'];  ?>/<?= $v['group_id']; ?>"
                                            class="btn btn-primary float-right">Add
                                            <?php echo $this->data['name']; ?></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /.card-body -->


            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<!-- </div> -->
<!-- /.content-wrapper -->

<script type="text/javascript">
$(document).ready(function() {

    $("#li-coll").addClass('active');

});
</script>