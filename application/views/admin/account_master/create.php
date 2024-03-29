<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Add <?php
                                                echo $this->data['name']; ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>backend_admin/account">Home</a>
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
        <div class="col-md-12 col-xs-12">
            <?php if ($this->session->flashdata('errors')) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <div class="card card-primary" style="margin: 20px;">

                <form role="form" action="<?php echo base_url() . $this->controllerPath ?>/create/<?php echo $this->data['account_no'] + 1  ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body row">
                        <div class="form-group col-md-6 ">
                            <label for="account_no">Account Number</label>
                            <input type="text" class="form-control" id="account_no" name="account_no" readonly value="<?php echo $this->data['account_no'] + 1  ?>" placeholder="Select party name account number is auto increment">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="member_name">Member Name</label>
                            <input type="text" class="form-control" id="member_name" name="member_name" value="" placeholder="Enter Member Name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="" placeholder="Enter member address">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="mobile_no">Mobile No.</label>
                            <input type="number" class="form-control" id="mobile_no" name="mobile_no" value="" placeholder="Enter member number">
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter member email">
                        </div> -->
                        <div class="form-group col-md-6">
                            <label for="opening_balance">Enter Opening Balance</label>

                            <input type="text" class="form-control " id="opening_balance" name="opening_balance" value="0" placeholder="Enter Opening Balance" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="Transaction">Transaction</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" class="transaction" name="transaction" id="transaction" value="1" required>
                                    Recipt
                                </label>
                                <label>
                                    <input type="radio" class="transaction" name="transaction" id="transaction" value="0" checked required>
                                    Payment
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <a href="<?php echo base_url() . $this->controllerPath ?>" class="btn btn-warning">Back</a>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- /.row -->


</section>
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } elseif ($this->session->flashdata('errors')) { ?>
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('errors'); ?>
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
                    <!-- <a href="<?php echo base_url() . $this->controllerPath ?>/create/"
                        class="btn btn-primary float-right">Add
                        <?php echo $this->data['name']; ?></a> -->
                    <h1 class="m-0 text-dark" style="display: inline-block">Manage <?php echo $this->data['name']; ?>
                    </h1>
                    <a class="btn btn-primary float-right" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="display: inline-block">Add
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
                                    <th>Transaction</th>
                                    <th>Status</th>
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
                                                <?php if ($v['transaction'] == 1) { ?>
                                                    <a href="#" style="color:#009100">Recipt</a>

                                                <?php   } else { ?>
                                                    <a href="#" class="text-danger">Payment</a>
                                                <?php       } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $hide = '';
                                                if ($v['status'] == 0) {

                                                    $hide = "style='color:red;pointer-events: none; opacity: 0.5;'";
                                                }
                                                ?>
                                                <?php if ($v['status'] == 1) { ?>
                                                    <a href="#" style="color:#009100">Active</a>

                                                <?php   } else { ?>
                                                    <a href="#" class="text-danger" <?php echo $hide; ?>>Inactive</a>
                                                <?php       } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $hide = '';
                                                if ($v['member_status'] == 0) {
                                                    $hide = "style='pointer-events: none; opacity: 0.5;'";
                                                }
                                                ?>
                                                <a href="<?php echo base_url() . $this->controllerPath ?>/edit/<?php echo $v['account_no'];  ?>" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <!-- <a href="<?php echo base_url() . $this->controllerPath ?>/edit/<?php echo $v['account_no'];  ?>"
                                            title="Edit" class="btn btn-warning" <?php echo $hide; ?>><i
                                                class="fa fa-edit"></i></a> -->

                                                <a onclick="return confirm('Are you sure want to delete this data?');" title="Delete" href="<?php echo base_url() . $this->controllerPath ?>/delete/<?php echo $v['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i>
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

<script type="text/javascript">
    $(document).ready(function() {

        $("#li-account").addClass('active');


    });
</script>
<script>
    $(function() {
        $("#datepicker").datepicker();
        // $( "#datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
    });
</script>
<script>
    $(function() {
        $("#datepicker1").datepicker();
    });
</script>