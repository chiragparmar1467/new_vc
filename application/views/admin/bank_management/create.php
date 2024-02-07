<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo $this->data['name']; ?> Management </h1>
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

                <form role="form" id="cash_form" action="<?php echo base_url() . $this->controllerPath ?>/create"
                    method="post" enctype="multipart/form-data">
                    <div class="field_wrapper1">
                        <div class="card-body row">
                            <div class="form-group col-md-2">
                                <label for="voucher_number">Voucher No.</label>
                                <input type="text" class="form-control voucher_no" id="voucher_no" name="voucher_no[]"
                                    value="<?php echo $this->data['voucher_no'] + 1;  ?>"
                                    placeholder="Enter Voucher Number" required>
                                <input type="hidden" class="form-control" id="is_exist" name="is_exist" value="0">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="bank_date">Bank Date</label>
                                <input type="text" class="form-control datepicker" name="bank_date[]" id="datepicker"
                                    value="<?php echo date('d-m-Y') ?>" autocomplete="off" required>

                            </div>
                            <div class="form-group col-md-3">
                                <label>Select Member Name</label>
                                <select class="js-example-basic-single w-100 member_name" name="member_name[]"
                                    id="member_name" required>
                                    <option disabled selected hidden>Select Members</option>
                                    <?php
                                    $member = $this->db->query('select * from account_master where deleted = 0 AND status = 1')->result_array();
                                    foreach ($member as $row) {
                                    ?>
                                    <option value="<?= $row['account_no'] ?>"
                                        <?php if ($accountno == $row['account_no']) { ?> selected<?php } ?>>
                                        <?php echo "(" . $row['account_no'] . ")" . $row['member_name']; ?>
                                    </option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount[]"
                                    placeholder="Enter Amount">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="Transaction">Transaction</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="transaction[]" id="transaction" value="1" <?php if ($transaction == 1) {
                                                                                                                echo "checked";
                                                                                                            }  ?>>
                                        Recipt
                                    </label>
                                    <label>
                                        <input type="radio" name="transaction[]" id="transaction" value="0" <?php if ($transaction == 0) {
                                                                                                                echo "checked";
                                                                                                            }  ?>>
                                        Payment
                                    </label>
                                </div>
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
                        <!-- <a href="<?php echo base_url() . $this->controllerPath ?>" class="btn btn-warning">Back</a> -->
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
    $("#bank_management").addClass('active');
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
</script>
<script>
$(document).ready(function() {
    var maxField = 100; // Input fields increment limitation
    var addButton1 = $('.add_button1'); // Add button selector
    var wrapper1 = $('.field_wrapper1'); // Input field wrapper
    var addedFieldsContainer = $('.added_fields_container'); // Container for dynamically added fields

    var x = $('#voucher_no').val(); // Initial field counter is 1


    // Once add button is clicked
    $(addButton1).click(function() {
        var integerValue = parseInt(x);

        var bill_no = $('#voucher_no').val();

        var fieldHTML1 = '<div class="added_fields">' +
            '<div class="card-body row">' +

            '<div class="form-group col-md-2">' +
            '<label for="voucher_number">Voucher No.</label>' +
            '<input type="text" class="form-control" id="voucher_no" value="' + (integerValue + 1) +
            '" name="voucher_no[]" placeholder="Enter Voucher Number" required>' +
            '<input type="hidden" class="form-control" id="is_exist" name="is_exist" value="0">' +
            '</div>' +

            '<div class="form-group col-md-2">' +
            '<label for="bank_date">Bank Date</label>' +
            '<input type="text" class="form-control datepicker" name="bank_date[]" id="datepicker_' +
            x + '" value="<?= date("d-m-Y") ?>" autocomplete="off" required>' +
            '</div>' +

            '<div class="form-group col-md-3">' +
            '<label>Select Member Name</label>' +
            '<select class="js-example-basic-single w-100 member_name" name="member_name[]" id="member_name_' +
            x + '" onchange="get_amount()" required>' +
            '<option disabled selected hidden>Select Members</option>' +
            '<?php $member = $this->db->query('select * from account_master where deleted = 0 AND status = 1')->result_array();
                    foreach ($member as $row) { ?>' +
            '<option value="<?= $row["account_no"] ?>">' +
            '<?php echo "(" . $row['account_no'] . ")" . $row['member_name']; ?>' +
            '</option>' +
            '<?php } ?>' +
            '</select>' +
            '</div>' +

            '<div class="form-group col-md-2">' +
            '<label for="amount">Amount</label>' +
            '<input type="number" class="form-control" id="amount" name="amount[]" placeholder="Enter Amount" required>' +
            '</div>' +

            '<div class = "form-group col-md-2">' +
            '<label for = "Transaction" >Transaction </label>' +
            '<div class = "radio" >' +
            '<label>' +
            '<input type = "radio"name = "transaction[]" id ="transaction' + x + '" value = "1" <?php if ($transaction == 1) {
                                                                                                        echo "checked";
                                                                                                    }  ?> >' +
            'Recipt' +
            '</label>' +
            '<label>' +
            '<input type = "radio" class="ml-1" name = "transaction[]" id = "transaction' + x +
            '" value = "0" <?php if ($transaction == 0) {
                                    echo "checked";
                                }  ?> >' +
            'Payment' +
            '</label>' +
            '</div>' +
            '</div>' +

            '<div class="form-group col-md-1">' +
            '<label for="sdf"></label>' +
            '<a href="javascript:void(0);" class="remove_button1 btn btn-danger btn-md mt-4" style="margin-left:10px; border-radius: 10px;"><i class="fa fa-times ms-2 fs-1"></i></a>' +
            '</div>' +
            '</div>' +

            '</div>';
        // Check maximum number of input fields

        if (x < maxField) {

            var newField = fieldHTML1.replace(/transaction\[/g, 'transaction[' + x);
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

        $('.member_name').each(function(ele) {
            console.log(ele);
            $(this).val(index + 1);
            $(this).prop('id', 'newId');

        });
        $('[name^="transaction"]').each(function(index) {
            $(this).prop('id', 'transaction' + index);
            $(this).prop('name', 'transaction[' + index + ']');
        });


    }

    // Once remove button is clicked
    $(wrapper1).on('click', '.remove_button1', function(e) {
        e.preventDefault();
        $(this).closest('.added_fields').remove(); // Remove the entire added fields set
        x--; // Decrement field counter
        $('.member_name').each(function() {
            $(this).select2();
        });
        // Update values to maintain order
        updateOrder();
    });
});
</script>
<script>
(function($) {
    $(document).ready(function() {
        $(".datepicker").each(function() {
            $(this).datepicker({
                dateFormat: 'dd-mm-yy'
            });
        });
    });
})(jQuery);
</script>
<script>
$(document).ready(function() {
    $('#voucher_no').on('keyup', function() {
        voucher_no();
    });

});

function voucher_no() {

    var voucherno = $('#voucher_no').val();
    // alert(voucherno);
    $.ajax({
        url: '<?= base_url() . $this->controllerPath ?>/ajax_voucher_no/' + voucherno,
        method: "POST",
        async: true,
        dataType: 'json',
        success: function(data) {
            // Handle the response data here
            console.log(data);
            $('#datepicker').val(data.date);
            $('#is_exist').val('1');
            $("#member_name").val(data.account_no).trigger("change");
            // $('#member_name').val(data.membername);
            $('#amount').val(data.amountno);
            $('input[name="transaction[]"]').prop('checked', false); // Uncheck all radio buttons
            $('input[name="transaction[]"][value="' + data.transaction + '"]').prop('checked',
            true); // Check the appropriate radio button
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error(xhr.responseText);
        }
    });
}
</script>