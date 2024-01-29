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
                <div class="card-header">
                    <!-- <h3 class="card-title">Manage <?php echo $this->data['name']; ?></h3> -->
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
                                    <th>Member Name</th>
                                    <th>Mobile no</th>
                                    <th>Address</th>
                                    <th>Email</th>
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
                          
                                    <td class="text-center"><?php echo $v['member_name']; ?>
                                    </td>
                                    
                                    <td class="text-center"><?php  echo  $v['mobile_number'];  ?>
                                    </td>
                                    <td class="text-center"><?php echo $v['address']; ?>
                                    </td>

                                    

                                    <td class="text-center"><?php echo $v['email']; ?>
                                    </td>

                                    <td>

                                        <?php if($v['status'] == 1){ ?>
                                        <a href="#"
                                            style="color:#009100">Active</a>

                                        <?php   } else{ ?>
                                        <a href="#"
                                            class="text-danger">Inactive</a>
                                        <?php       } ?>
                                    </td>
                                    <td>

                                        <a href="<?php echo base_url() . $this->controllerPath ?>edit/<?php echo $v['id'];  ?>"
                                            title="Edit" class="btn btn-warning p-2"><i class="fa fa-edit"></i></a>


                                        <a onclick="return confirm('Are you sure want to delete this data?');"
                                            title="Delete"
                                            href="<?php echo base_url() . $this->controllerPath ?>delete/<?php echo $v['id']; ?>"
                                            class="btn  btn-danger p-2"><center><i class="fa fa-trash"></i></center>
                                        </a>



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

    // $("#li-group").addClass('menu-open');
    $("#li-member").addClass('active');
    // $("#link-Master").addClass('menu-open');
    // $("#add_customer").addClass('active');
});
</script>