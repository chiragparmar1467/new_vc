
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
                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Year</th>
                                        <th>Status</th>
                                        <th>View</th>
                                        <th>Action</th>

                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $i = 1; ?>
                                    <?php if ($table_data) : ?>
                                    <?php foreach ($table_data as $k => $v) :
                                    // print_r('<pre>');
                                    // print_r($v);
                                    // exit();
                                        ?>
                                    <tr>
                                        <td><?php echo $i; ?>
                                        </td>
                                        <td class="text-center"><?php        
                                          echo $v['title'];
                                           ?>
                                        </td>

                                        <td class="text-center"><?php
                                        echo  date("d-m-Y", strtotime($v['start_date']));
                                        ?>
                                        </td>
                                        <td class="text-center"><?php
                                        echo  date("d-m-Y", strtotime($v['end_date']));
                                        ?>
                                        </td>
                                        <td class="text-center"><?php        
                                          echo $v['year'];
                                           ?>
                                        </td>
                                        <td>
                                            <?php 
                                        $hide = '';
                                        if($v['status'] == 0 ){
                                            
                                            $hide = "style='color:red;pointer-events: none; opacity: 0.5;'";
                                         }
                                        ?>
                                            <?php if($v['status'] == 1){ ?>
                                            <p class="text-success " style="text-align:center">Active</p>
                                            <?php } else {?>

                                            <p class="text-danger" style="text-align:center">Inactive</p>
                                            <?php } ?>
                                        </td>
                                        <!-- <td>
                                            <?php 
                                        $hide = '';
                                        if($v['status'] == 0 ){
                                            
                                            $hide = "style='color:red;pointer-events: none; opacity: 0.5;'";
                                         }
                                        ?>
                                            <?php if($v['status'] == 1){ ?>
                                            <a href="<?php echo base_url() . $this->controllerPath ?>updateStatus/<?php echo $v['id']; ?>/0"
                                                style="color:#009100">Active</a>

                                            <?php   } else{ ?>
                                            <a href="<?php echo base_url() . $this->controllerPath ?>updateStatus/<?php echo $v['id'];?>/1"
                                                class="text-danger" <?php echo $hide; ?>>Inactive</a>
                                            <?php       } ?>
                                        </td> -->

                                        <td>
                                            <a href="<?php echo base_url() . $this->controllerPath ?>view_financial_year/<?php echo $v['id'];  ?>"
                                                title="view" class="btn btn-warning" <?php echo $hide; ?>><i
                                                    class="fa fa-eye"></i></a>

                                            <!-- <a href="<?php echo base_url() . $this->controllerPath ?>viewpdf/<?php echo $v['id'];  ?>"
                                                title="Edit" class="btn btn-danger" <?php echo $hide; ?>><i
                                                    class="fa fa-file-pdf"></i></a>

                                            <a href="<?php echo base_url() . $this->controllerPath ?>downloadpdf/<?php echo $v['id'];?>/<?php echo $v['fk_party_id'] ?>"
                                                title="Edit" class="btn btn-info" <?php echo $hide; ?>><i
                                                    class=" fa fa-download"></i></a> -->
                                        </td>

                                        <!-- <td>
                                            <?php 
                                        $hide = '';
                                        if($v['status'] == 0 ){
                                            $hide = "style='pointer-events: none; opacity: 0.5;'";
                                         }
                                        ?>
                                            <a href="<?php echo base_url() . $this->controllerPath ?>edit/<?php echo $v['id'];  ?>"
                                                title="Edit" class="btn btn-warning" <?php echo $hide; ?>><i
                                                    class="fa fa-edit"></i></a>


                                            <a onclick="return confirm('Are you sure want to delete this data?');"
                                                title="Delete"
                                                href="<?php echo base_url() . $this->controllerPath ?>delete/<?php echo $v['id']; ?>"
                                                class="btn btn-danger"><i class="fa fa-trash"></i>
                                            </a>
                                        </td> -->

                                        <td>
                                            <?php 
                                        $hide = '';
                                        if($v['status'] == 0 ){
                                            $hide = "style='pointer-events: none; opacity: 0.5;'";
                                         }
                                        ?>
                                            <a href="<?php echo base_url() . $this->controllerPath ?>edit/<?php echo $v['id'];  ?>"
                                                title="Edit" class="btn btn-warning" <?php echo $hide; ?>><i
                                                    class="fa fa-edit"></i></a>


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
    <!-- /.content -->


<script type="text/javascript">
$(document).ready(function() {

    // $("#loan").addClass('menu-open');
    // $("#li-loan").addClass('active');
    // $("#loan-list").addClass('menu-open');
    // $("#loan-master").addClass('active');
    // $("#manage-loan_master").addClass('active');
    $("#financial_year_master").addClass('active');
    // $("#link-Master").addClass('menu-open');
    // $("#add_customer").addClass('active');
});
</script>