<!-- Content Wrapper. Contains page content -->
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
                <div class="card-header d-none">
                    <h3 class="card-title">Manage <?php echo $this->data['name']; ?></h3>
                    <a href="<?php echo base_url() . $this->controllerPath ?>create"
                        class="btn btn-primary float-right">Add
                        <?php echo $this->data['name']; ?></a>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Sr. No.</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php if ($table_data) : ?>
                                <?php foreach ($table_data as $k => $v) : ?>
                                <tr>
                                    <td><?php echo $i; ?>
                                    </td>
                                    <td class="text-center"><?php 
                                            //  print_r('<pre>');   
                                                // print_r($v); 
                                            //     exit(); 
                                            echo  $v['username']; 

                                           
                                            ?>
                                    </td>
                                    <td class="text-center"><?php echo $v['email']; ?>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?php echo base_url() . $this->controllerPath ?>change_pass/<?php echo $v['id']; ?>"
                                                title="Edit" class="btn btn-primary">Change Password </a>
                                        </center>


                                        <!-- <a onclick="return confirm('Are you sure want to delete this data?');" title="Delete" href="<?php echo base_url() . $this->controllerPath ?>delete/<?php echo $v['id']; ?>" class="btn btn-danger" <?php echo $hide; ?>><i class="fa fa-trash"></i>
                                                </a> -->



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

<script type="text/javascript">
$(document).ready(function() {
    // $("#li-daily").addClass('menu-open');
    // $("#link-daily").addClass('active');
    // $("#li-Master").addClass('menu-open');
    // $("#link-Master").addClass('active');
    // $("#li-Master").addClass('menu-open');
    // $("#link-Master").addClass('active');
    // $("#add_customer").addClass('active');
    $("#change_pass").addClass('active');


});
</script>