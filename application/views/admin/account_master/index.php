<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0 text-dark">Add <?php

                                                echo $this->data['name']; ?></h1> -->
            </div>
            <!-- /.col -->
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
        <div class="wrapper center-block">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading active" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <!-- <div class="col-sm-12">
                                <h1 class="m-0 text-dark">Add <?php echo $this->data['name']; ?></h1>
                            </div> -->
                            <!-- <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne"><i class="icon-layout menu-icon"></i>
                            </a> -->
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                        aria-labelledby="headingOne">
                        <div class="panel-body">


                            <div class="col-md-12 col-xs-12">
                                <?php if ($this->session->flashdata('errors')) { ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
                                </div>
                                <?php } ?>

                                <div class="card card-primary" style="margin: 20px;">
                                    <div class="card-header">
                                        <h1 class="m-0 text-dark" style="display: inline-block">Add
                                            <?php echo $this->data['name']; ?>
                                        </h1>
                                        <!-- <a class="btn btn-primary float-right" role="button" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne" style="display: inline-block">Add
                                            <?php echo $this->data['name']; ?></a> -->

                                    </div>

                                    <form role="form"
                                        action="<?php echo base_url() . $this->controllerPath ?>/create/<?php echo $this->data['table_data']['account_no'] + 1 ?>"
                                        method="post" enctype="multipart/form-data">
                                        <div class="card-body row">
                                            <div class="form-group col-md-2">
                                                <label for="account_number">Account Number</label>
                                                <input type="text" class="form-control" id="account_number"
                                                    name="account_number"
                                                    value="<?php echo $this->data['table_data']['account_no'] + 1  ?>"
                                                    placeholder="Select party name account number is auto increment"
                                                    disabled>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="member_name">Member Name</label>
                                                <input type="text" class="form-control" id="member_name"
                                                    name="member_name" value="" placeholder="Enter Member Name">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="" placeholder="Enter member address">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="mobile_no">Mobile No.</label>
                                                <input type="number" class="form-control" id="mobile_no"
                                                    name="mobile_no" value="" placeholder="Enter member number">
                                            </div>

                                            <!-- <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter member email">
                        </div> -->
                                            <div class="form-group col-md-2">
                                                <label for="opening_balance">Opening Balance</label>

                                                <input type="text" class="form-control " id="opening_balance"
                                                    name="opening_balance" value="0" placeholder="Enter Opening Balance"
                                                    autocomplete="off">
                                            </div>

                                            <!-- <div class="form-group col-md-3">
                                                <label for="gender">Status</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="status" id="active" value="1" checked>
                                                        Active
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="status" id="inactive" value="0">
                                                        Inactive
                                                    </label>
                                                </div>
                                            </div> -->

                                        </div>

                                        <div class="card" style="float:right; display: inline-block;">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            <a href="<?php echo base_url() . $this->controllerPath ?>"
                                                class="btn btn-warning">Back</a>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- /.row -->


</section>


<script type="text/javascript">
$(document).ready(function() {

    $("#li-account").addClass('active');


});

function selectAllRecord(params) {
    // $("#view_payment_btn").show();

    if (params.checked) {
        $('.item').prop('checked', true);
    } else {
        $('.item').prop('checked', false);
        // $("#view_payment_btn").hide();
    }
}

function is_checked() {

}
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
<script>
function totalamount() {
    var loan_amount = parseInt(document.getElementById("enter_loan_amount").value);
    var interest_amount = parseInt(document.getElementById("interest_amount").value);
    var monthly_amount = parseInt(document.getElementById("month").value);
    var category_id = parseInt(document.getElementById("category_name").value);
    // alert(category_id);

    // var interest = (loan_amount * interest_amount)/100;
    if (category_id == 1) {
        var total = (loan_amount * interest_amount) / 100;
        var monthly = (total * monthly_amount);
        var fullamount = (loan_amount + monthly);
    } else {
        var total = (loan_amount * interest_amount) / 100;
        var monthly = (total * monthly_amount);
        var fullamount = (loan_amount + monthly);
    }
    if (category_id == 2) {
        var total = (loan_amount * interest_amount) / 100;
        var monthly = (total * monthly_amount);
        var fullamount = (loan_amount - monthly);
    }



    // alert(total);
    document.getElementById("total").innerHTML =
        '<label for="total_amount">Interest On Loan Amount</label><input type="text" class="form-control" id="total_amount" name="total_amount" value="' +
        total + '" autocomplete="off" disabled>';
    document.getElementById("monthly").innerHTML =
        '<label for="total_amount">Interest Amount * Month Amount</label><input type="text" class="form-control" id="monthly_amount" name="monthly_amount" value="' +
        monthly + '" autocomplete="off" disabled>';
    document.getElementById("fullamount").innerHTML =
        '<label for="total_amount">Final Amount</label><input type="text" class="form-control" id="total_amount" name="total_amount" value="' +
        fullamount + '" autocomplete="off" disabled>';

}

function cat() {
    $('#enter_loan_amount').val(0);
    $('#interest_amount').val(0);
    $('#month').val(0);
    $('#total').val(0);
    $('#monthly').val(0);
    $('#fullamount').val(0);

}
</script>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0 text-dark">Manage <?php echo $this->data['name']; ?></h1> -->
            </div><!-- /.col -->
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>backend_admin/Dashboard">Home</a>

                    </li>
                    <li class="breadcrumb-item active"><?php echo $this->data['name']; ?></li>
                </ol>
            </div> -->
            <!-- /.col -->
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
                    <!-- <a href="<?php echo base_url() . $this->controllerPath ?>/create/"
                        class="btn btn-primary float-right">Add
                        <?php echo $this->data['name']; ?></a> -->
                    <h1 class="m-0 text-dark" style="display: inline-block">Manage <?php echo $this->data['name']; ?>
                    </h1>
                    <a class="btn btn-primary float-right" role="button" data-toggle="collapse" data-parent="#accordion"
                        href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                        style="display: inline-block">Add
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
                                    <th>Email</th>
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
                                    <td class="text-center"><?php echo $v['email']; ?>
                                    </td>

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
                                            title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
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