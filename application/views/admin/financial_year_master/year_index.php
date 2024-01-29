
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View <?php echo $this->data['name']; ?></h1>
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
                        <h3 class="card-title">View <?php echo $this->data['name']; ?></h3>
                        <!-- <a href="<?php echo base_url() . $this->controllerPath ?>create"
                            class="btn btn-primary float-right">Add
                            <?php echo $this->data['name']; ?></a> -->
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Sr. No.</th>
                                        <th>title</th>
                                        <th>start Date</th>
                                        <th>end Date</th>
                                        <th>Status</th>
                                        <!-- <th>View</th>
                                        <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $i = 1; ?>
                                    <?php if ($table_data) : ?>
                                    <?php foreach ($table_data as $k => $v) :
                                        ?>
                                    <tr>
                                        <td><?php echo $i; ?>
                                        </td>
                                        </td>
                                        <td><?php echo $v['title']; ?>
                                        </td>
                                        <td class="text-center"><?php 
                                            $acc_opening_date = date("d-m-Y", strtotime($v['start_date']));  
                                        echo  $acc_opening_date; ?>
                                        </td>
                                        <td class="text-center"><?php 
                                            $acc_closing_date = date("d-m-Y", strtotime($v['end_date']));  
                                        echo  $acc_closing_date; ?>
                                        </td>
                                        <td>
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
                                        </td>

                                        <!-- <td>
                                            <a href="<?php echo base_url() . $this->controllerPath ?>form_view/<?php echo $v['id'];  ?>/<?php echo $v['fk_party_id'] ?>"
                                                title="view" class="btn btn-warning" <?php echo $hide; ?>><i
                                                    class="fa fa-eye"></i></a>

                                            <a href="<?php echo base_url() . $this->controllerPath ?>viewpdf/<?php echo $v['id'];  ?>"
                                                title="PDF view" class="btn btn-danger" <?php echo $hide; ?>><i
                                                    class="fa fa-file-pdf"></i></a>

                                            <a href="<?php echo base_url() . $this->controllerPath ?>downloadpdf/<?php echo $v['id'];?>/<?php echo $v['fk_party_id'] ?>"
                                                title="PDF Download" class="btn btn-info" <?php echo $hide; ?>><i
                                                    class=" fa fa-download"></i></a>
                                        </td> -->

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