<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Management <?php

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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
            </div>
            <?php } ?>

            <div class="card card-primary" style="margin: 20px;">

                <form role="form" id="cash_form"
                    action="<?php echo base_url() . $this->controllerPath ?>/create/<?php $lastVoucherNumber = end($this->data['table_data'])['bill_no'] + 1; echo $lastVoucherNumber;  ?>"
                    method="post" enctype="multipart/form-data">
                    <div class="field_wrapper1">
                        <div class="card-body row">
                            <div class="form-group col-md-2">
                                <label for="voucher_number">Bill No.</label>
                                <input type="text" class="form-control bill_no" id="bill_no" name="bill_no[]"
                                    value="<?php  $lastVoucherNumber = end($this->data['table_data'])['bill_no'] + 1; echo $lastVoucherNumber;   ?>"
                                    placeholder="Enter Voucher Number" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="cash_date">Date</label>
                                <input type="text" class="form-control" name="cash_date[]" id="datepicker"
                                    value="<?= date('d-m-Y') ?>" autocomplete="off" required>

                            </div>
                            <div class="form-group col-md-3">
                                <label>Select Member Name</label>
                                <select class="js-example-basic-single w-100" name="member_name[]" id="member_name"
                                    required>
                                    <option disabled selected hidden>Select Members</option>
                                    <?php
                                    $member = $this->db->query('select * from account_master where deleted = 0 AND status = 1')->result_array();
                                    foreach ($member as $row) {
                                    ?>
                                    <option value="<?= $row['id'] ?>">
                                        <?php
                                            echo "(" . $row['id'] . ")" . $row['member_name']; ?>
                                    </option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount[]"
                                    placeholder="Enter Amount">
                            </div>


                            <div class="form-group col-md-1">
                                <label for="amount"></label>
                                <a href="javascript:void(0);" class="add_button1 btn btn-primary"
                                    style="margin-left:10px; margin-top:25px" title="Add field"
                                    style="margin-left:10px; border-radius: 10px;"><i
                                        class="fa fa-plus ms-2 fs-2"></i></a>
                            </div>
                        </div>
                        <div class="added_fields_container"></div>
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


<script type="text/javascript">
$(document).ready(function() {

    // $("#li-account").addClass('active');
    $("#link-Transaction").removeClass('collapsed');
    $("#link-Transaction").attr("aria-expanded", true);
    $("#ui-basic").addClass('show');
    $("#purchase_management").addClass('active');
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
$(document).ready(function() {
    var maxField = 100; // Input fields increment limitation
    var addButton1 = $('.add_button1'); // Add button selector
    var wrapper1 = $('.field_wrapper1'); // Input field wrapper
    var addedFieldsContainer = $('.added_fields_container'); // Container for dynamically added fields
    
    var x = 1; // Initial field counter is 1
    



    // Once add button is clicked
    $(addButton1).click(function() {
        var bill_no = $('.bill_no').val();
     
        var fieldHTML1 = '<div class="added_fields">' +
        '<div class="card-body row">' +

        '<div class="form-group col-md-2">' +
        '<label for="voucher_number">Voucher No.</label>' +
        '<input type="text" class="form-control bill_no" id="bill_no" value="'+(x + 1) +'" name="bill_no[]" placeholder="Enter Voucher Number" required>' +
        '</div>' +

        '<div class="form-group col-md-3">' +
        '<label for="cash_date">Cash Date</label>' +
        '<input type="text" class="form-control" name="cash_date[]" id="datepicker" value="<?= date("d-m-Y") ?>" autocomplete="off" required>' +
        '</div>' +

        '<div class="form-group col-md-3">' +
        '<label>Select Member Name</label>' +
        '<select class="js-example-basic-single w-100 member_name"  name="member_name[]" id="member_name_'+ x +'" required>' +
        '<option disabled selected hidden>Select Members</option>' +
        '<?php foreach ($member as $row) { ?>' +
        '<option value="<?= $row["id"] ?>">' +
        '<?php echo "(" . $row['id'] . ")" . $row['member_name']; ?>' +
        '</option>' +
        '<?php } ?>' +
        '</select>' +
        '</div>' +

        '<div class="form-group col-md-3">' +
        '<label for="amount">Amount</label>' +
        '<input type="number" class="form-control" id="amount" name="amount[]" placeholder="Enter Amount" required>' +
        '</div>' +


        '<div class="form-group col-md-1">' +
        '<label for=""></label>' +
        '<a href="javascript:void(0);" class="remove_button1 btn btn-danger btn-md" style="margin-left:10px; border-radius: 10px;"><i class="fa fa-times ms-2 fs-1"></i></a>' +
        '</div>' +
        '</div>' +

        '</div>';

        // Check maximum number of input fields
        if (x < maxField) {
        //    alert(x);
            var newField = fieldHTML1;
            $(addedFieldsContainer).append(newField);
            // if ($(".js-example-basic-single").length) {
                //     $(".js-example-basic-single").select2();
                // }
                if ($("#member_name_" + x).length) {
                    $("#member_name_" + x).select2();
                }
                x++; // Increment field counter
        }
      
    });

    function updateOrder() {
        $('.bill_no').each(function(index) {
            $(this).val(index + 1);
        });
        // $(".member_name").select2();
        $('.member_name').each(function(ele) {
            console.log(ele);
            $(this).val(index + 1);
            $(this).prop('id', 'newId');
            // if ($("#member_name_" + x).length) {
                    // $("#member_name_" + x).select2();
                // }
        });
    }

    // Once remove button is clicked
    $(wrapper1).on('click', '.remove_button1', function(e) {
        e.preventDefault();
        $(this).closest('.added_fields').remove(); // Remove the entire added fields set
        x--; // Decrement field counter
        $('.member_name').each(function () {
            $(this).select2();
        });
        // Update values to maintain order
        updateOrder();
    });
});
</script>
<script>
(function($) {
    // $("#datepicker").datepicker();
    $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
    });
})(jQuery);
</script>
<script>
function cat() {
    $('#enter_loan_amount').val(0);
    $('#interest_amount').val(0);
    $('#month').val(0);
    $('#total').val(0);
    $('#monthly').val(0);
    $('#fullamount').val(0);

}
</script>