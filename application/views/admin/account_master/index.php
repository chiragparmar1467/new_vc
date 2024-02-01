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

                    <a href="<?php echo base_url() . $this->controllerPath ?>/create/"
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
                                    <th>Account Number </th>
                                    <th>Member Name</th>
                                    <th>Mobile Number</th>
                                    <!-- <th>Email</th> -->
                                    <th>Opening Balance</th>
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
                                    <td class="text-center"><?php echo $v['account_no']; ?>
                                </td>
                                <td class="text-center"><?php 
                                            echo  $v['member_name'];       
                                            ?>
                                    </td>

                                    <td class="text-center"><?php echo $v['mobile_number']; ?>
                                    </td>
                                    <!-- <td class="text-center"><?php echo $v['email']; ?>
                                    </td> -->

                                    <td class="text-center"><?php echo $v['opening_balance']; ?>
                                    </td>

                                    <td>
                                        <?php 
                                        $hide = '';
                                        if($v['member_status'] == 0 ){
                                            
                                            $hide = "style='color:red;pointer-events: none; opacity: 0.5;'";
                                         }
                                        ?>
                                        <?php if($v['status'] == 1){ ?>
                                        <a href="#" style="color:#009100">Active</a>

                                        <?php   } else{ ?>
                                        <a href="#" class="text-danger" <?php echo $hide; ?>>Inactive</a>
                                        <?php       } ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $hide = '';
                                        if($v['member_status'] == 0 ){
                                            $hide = "style='pointer-events: none; opacity: 0.5;'";
                                         }
                                        ?>
                                        <a href="<?php echo base_url() . $this->controllerPath ?>/edit/<?php echo $v['account_no'];  ?>"
                                            title="Edit" class="btn btn-warning"><i
                                                class="fa fa-edit"></i></a>
                                        <!-- <a href="<?php echo base_url() . $this->controllerPath ?>/edit/<?php echo $v['account_no'];  ?>"
                                            title="Edit" class="btn btn-warning" <?php echo $hide; ?>><i
                                                class="fa fa-edit"></i></a> -->


                                        <a onclick="return confirm('Are you sure want to delete this data?');"
                                            title="Delete"
                                            href="<?php echo base_url() . $this->controllerPath ?>delete/<?php echo $v['id']; ?>"
                                            class="btn btn-danger"><i class="fa fa-trash"></i>
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


<script type="text/javascript">
$(document).ready(function() {


    $("#li-account").addClass('active');

});
</script>