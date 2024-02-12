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
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            <div class="card card-primary" style="margin: 20px;">

                <form role="form" id="cash_form" action="<?php echo base_url() . $this->controllerPath ?>/create" method="post" enctype="multipart/form-data">
                    <div class="field_wrapper1">
                        <div class="card-body row">
                            <div class="form-group col-md-4">
                                <label for="voucher_number">Voucher No.</label>
                                <input type="text" class="form-control voucher_no" id="voucher_no" name="row[0][voucher_no]" value="<?php echo $this->data['voucher_no'] + 1;  ?>" placeholder="Enter Voucher Number" required>
                                <input type="hidden" class="form-control" id="is_exist" name="row[0][is_exist]" value="0">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="bank_date">Bank Date</label>
                                <input type="text" class="form-control datepicker" name="row[0][bank_date]" id="datepicker" value="<?php echo date('d-m-Y') ?>" autocomplete="off" required>

                            </div>
                            <div class="form-group col-md-4">
                                <label>Select Member Name</label>
                                <select class="js-example-basic-single w-100 member_name" name="row[0][member_name]" id="member_name" required>
                                    <option disabled selected hidden>Select Members</option>
                                    <?php
                                    $member = $this->db->query('select * from account_master where deleted = 0 AND status = 1 AND fk_financial_year_id=' . $_SESSION['year'])->result_array();
                                    foreach ($member as $row) {
                                    ?>
                                        <option value="<?= $row['account_no'] ?>" <?php if ($accountno == $row['account_no']) { ?> selected<?php } ?>>
                                            <?php echo "(" . $row['account_no'] . ")" . $row['member_name']; ?>
                                        </option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Select Bank Name</label>
                                <select class="js-example-basic-single w-100 bank_name" name="row[0][bank_name]" id="bank_name" required>
                                    <option disabled selected hidden>Select Bank Name</option>
                                    <?php
                                    $member = $this->db->query('select * from bank_master where deleted = 0 AND status = 1 AND fk_financial_year_id=' . $_SESSION['year'])->result_array();
                                    foreach ($member as $row) {
                                    ?>
                                        <option value="<?= $row['id'] ?>" <?php if ($Bank_id == $row['id']) { ?> selected<?php } ?>>
                                            <?php echo "(" . $row['bank_account_no'] . ")" . $row['bank_name']; ?>
                                        </option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="row[0][amount]" placeholder="Enter Amount" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="Transaction">Transaction</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="row[0][transaction]" class="transaction" id="transaction" value="1" <?php if ($transaction == 1) {
                                                                                                                                            echo "checked";
                                                                                                                                        }  ?>>
                                        Recipt
                                    </label>
                                    <label>
                                        <input type="radio" class="transaction" name="row[0][transaction]" id="transaction" value="0" <?php if ($transaction == 0) {
                                                                                                                                            echo "checked";
                                                                                                                                        }  ?>>
                                        Payment
                                    </label>
                                </div>
                            </div>

                            <div class="form-group col-md-1">
                                <label for="amount"></label>
                                <a href="javascript:void(0);" class="add_button1 btn btn-primary" disabled style="margin-left:10px; margin-top:25px" title="Add field" style="margin-left:10px; border-radius: 10px;"><i class="fa fa-plus ms-2 fs-2"></i></a>
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

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } elseif ($this->session->flashdata('error')) { ?>
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                    <th>Voucher Number </th>
                                    <th>Bank Date</th>
                                    <th>Bank Name</th>
                                    <th>Bank Acoount</th>
                                    <th>Member Name</th>
                                    <th>Amount</th>
                                    <th>Transaction</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php if ($table_data) : ?>
                                    <?php foreach ($table_data as $k => $v) :

                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?>
                                            </td>
                                            <td class="text-center"><?php echo $v['voucher_no']; ?>
                                            </td>
                                            <td class="text-center"><?php
                                                                    echo  $v['bank_date'];
                                                                    ?>
                                            </td>
                                            <td class="text-center"><?php
                                                                    echo  $v['bank_name'];
                                                                    ?>
                                            </td>
                                            <td class="text-center"><?php
                                                                    echo  $v['bank_account_no'];
                                                                    ?>
                                            </td>
                                            <td class="text-center"><?php
                                                                    echo  $v['member_name'];
                                                                    ?>
                                            </td>
                                            <td class="text-center"><?php echo $v['amount']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($v['transaction'] == 0) { ?>
                                                    <p style="color:red">Payment</p>
                                                <?php   } else { ?>
                                                    <p style="color:green"> Recipt</p>
                                                <?php } ?>
                                            </td>

                                            <td>
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
    jQuery(document).ready(function($) {

        var maxField = 100; // Input fields increment limitation
        var addButton1 = $('.add_button1'); // Add button selector
        var wrapper1 = $('.field_wrapper1'); // Input field wrapper
        var addedFieldsContainer = $('.added_fields_container'); // Container for dynamically added fields

        var x = 1; // Initial field counter is 1


        // Once add button is clicked
        $(addButton1).click(function() {
            var voucher_no_last = $('#voucher_no').val();
            var voucher_no = parseInt(voucher_no_last) + x;

            var fieldHTML1 = '<div class="added_fields">' +
                '<div class="card-body row">' +

                '<div class="form-group col-md-4">' +
                '<label for="voucher_number">Voucher No.</label>' +
                '<input type="text" class="form-control" id="voucher_no" value="' + voucher_no +
                '" name="row[' + x + '][voucher_no]" placeholder="Enter Voucher Number" required>' +
                '<input type="hidden" class="form-control" id="is_exist" name="row[' + x +
                '][is_exist]" value="0">' +
                '</div>' +

                '<div class="form-group col-md-4">' +
                '<label for="bank_date">Transaction Date</label>' +
                '<input type="text" class="form-control datepicker" name="row[' + x +
                '][bank_date]" id="datepicker' +
                x + '" value="<?= date("d-m-Y") ?>" autocomplete="off" required>' +
                '</div>' +

                '<div class="form-group col-md-4">' +
                '<label>Select Member Name</label>' +
                '<select class="js-example-basic-single w-100 member_name" name="row[' + x +
                '][member_name]" id="member_name_' +
                x + '" required>' +
                '<option disabled selected hidden>Select Members</option>' +
                '<?php $member = $this->db->query('select * from account_master where deleted = 0 AND status = 1 AND fk_financial_year_id=' . $_SESSION['year'])->result_array();
                    foreach ($member as $row) { ?>' +
                '<option value="<?= $row["account_no"] ?>">' +
                '<?php echo "(" . $row['account_no'] . ")" . $row['member_name']; ?>' +
                '</option>' +
                '<?php } ?>' +
                '</select>' +
                '</div>' +

                '<div class="form-group col-md-4">' +
                '<label>Select Bank Name</label>' +
                '<select class="js-example-basic-single w-100 bank_name" name="row[' + x +
                '][bank_name]" id="bank_name_' +
                x + '" required>' +
                '<option disabled selected hidden>Select Bank Name</option>' +
                '<?php $member = $this->db->query('select * from bank_master where deleted = 0 AND status = 1 AND fk_financial_year_id=' . $_SESSION['year'])->result_array();
                    foreach ($member as $row) { ?>' +
                '<option value="<?= $row["id"] ?>">' +
                '<?php echo "(" . $row['bank_account_no'] . ")" . $row['bank_name']; ?>' +
                '</option>' +
                '<?php } ?>' +
                '</select>' +
                '</div>' +

                '<div class="form-group col-md-4">' +
                '<label for="amount">Amount</label>' +
                '<input type="number" class="form-control" id="amount" name="row[' + x +
                '][amount]" placeholder="Enter Amount" required>' +
                '</div>' +

                '<div class = "form-group col-md-3">' +
                '<label for = "Transaction" >Transaction </label>' +
                '<div class = "radio" >' +
                '<label>' +
                '<input type = "radio"name = "row[' + x + '][transaction]" id ="transaction' + x +
                '" value = "1" <?php if ($transaction == 1) {
                                    echo "checked";
                                }  ?> >' +
                'Recipt' +
                '</label>' +
                '<label>' +
                '<input type = "radio" class="ml-1" name = "row[' + x +
                '][transaction]" id = "transaction' + x +
                '" value = "0" <?php if ($transaction == 0) {
                                    echo "checked";
                                }  ?> >' +
                'Payment' +
                '</label>' +
                '</div>' +
                '</div>' +

                '<div class="form-group col-md-1">' +
                '<label for="sdf"></label>' +
                '<a href="javascript:void(0);" id="remove_button_' + x +
                '" class="remove_button1 btn btn-danger btn-md mt-4" style="margin-left:10px; border-radius: 10px;"><i class="fa fa-times ms-2 fs-1"></i></a>' +
                '</div>' +
                '</div>' +

                '</div>';
            // Check maximum number of input fields

            if (x < maxField) {

                // var newField = fieldHTML1;

                var newField = fieldHTML1;
                $(addedFieldsContainer).append(newField);

                if ($("#member_name_" + x).length) {
                    jQuery("#member_name_" + x).select2();
                }
                if ($("#bank_name_" + x).length) {
                    jQuery("#bank_name_" + x).select2();
                }
                $('#datepicker' + x).datepicker({
                    dateFormat: 'dd-mm-yy'
                });

                x++; // Increment field counter
            }

        });



        $(wrapper1).on('click', '.remove_button1', function(e) {
            e.preventDefault();

            // Get the id of the clicked button and extract the index
            var clickedButtonId = $(this).attr('id');
            var index = parseInt(clickedButtonId.split('_').pop());

            // Get the voucher number from the field above the removed ID
            var voucherNumber = null;
            if (index > 1) {
                var prevVoucherField = $('.added_fields').eq(index - 2).find('#voucher_no');
                if (prevVoucherField.length) {
                    voucherNumber = parseInt(prevVoucherField.val()) + 1;
                }
            } else {
                // If removing the first field, get voucher number from the second field
                var nextVoucherField = $('.added_fields').eq(index).find('#voucher_no');
                if (nextVoucherField.length) {
                    voucherNumber = parseInt(nextVoucherField.val()) - 1;
                }
            }

            // Get the values of fields after the removed ID
            var values = [];
            $('.added_fields').each(function() {
                var currentId = parseInt($(this).find('.remove_button1').attr('id').split('_')
                    .pop());
                if (currentId > index) {
                    var fieldValue = $(this).find('[name^="row[' + currentId + ']"]').map(
                        function() {
                            return $(this).val();
                        }).get();
                    values.push(fieldValue);
                }
            });

            console.log('Values after removed ID:', values);

            // Remove the entire added fields set
            $(this).closest('.added_fields').remove();

            // Decrement field counter
            x--;

            // Adjust subsequent field IDs, voucher numbers, and other values
            $('.added_fields').each(function() {
                var currentId = parseInt($(this).find('.remove_button1').attr('id').split('_')
                    .pop());
                if (currentId > index) {
                    var newIndex = currentId - 1;
                    var newId = $(this).find('.remove_button1').attr('id').replace('_' + currentId,
                        '_' + newIndex);
                    $(this).find('.remove_button1').attr('id', newId);
                    $(this).find('#voucher_no').val(voucherNumber++);
                    $(this).find('[name^="row[' + currentId + ']"]').each(function() {
                        var newName = $(this).attr('name').replace('[' + currentId + ']',
                            '[' + newIndex + ']');
                        $(this).attr('name', newName);
                    });
                }
            });

            // Reinitialize Select2
            $('.member_name').select2();
            $('.bank_name').select2();
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
    $(document).ready(function() {
        $('#voucher_no').on('keyup', function() {
            voucher_no();
        });
    });

    function voucher_no() {

        var voucherno = $('#voucher_no').val();

        $.ajax({
            url: '<?= base_url() . $this->controllerPath ?>/ajax_voucher_no/' + voucherno,
            method: "POST",
            async: true,
            dataType: 'json',
            success: function(data) {
                // Handle the response data here
                if (data != null) {
                    console.log(data);
                    $('#datepicker').val(data.date);
                    $('#is_exist').val('1');
                    $("#member_name").val(data.account_no).trigger("change");
                    $("#bank_name").val(data.Bank_id).trigger("change");
                    $("#add_button").removeAttr("href").css("pointer-events", "none").addClass("disabled");
                    $('#amount').val(data.amountno);
                    $('input[name="row[0][transaction]"]').prop('checked', false); // Uncheck all radio buttons
                    $('input[name="row[0][transaction]"][value="' + data.transaction + '"]').prop('checked', true); // Check the appropriate radio button
                } else {
                    var currentDate = new Date();

                    // Format the date as 'dd-mm-yyyy'
                    var formattedDate = currentDate.getDate() + '-' + (currentDate.getMonth() + 1) + '-' +
                        currentDate.getFullYear();
                    $('#datepicker').val(formattedDate);
                    $('#is_exist').val('0');

                    $('#member_name option:not(:first)').removeAttr('selected');

                    $('#member_name option[data-select2-id="4"]').prop('selected', true);

                    $('#member_name').trigger('change');
                    $('#bank_name option:not(:first)').removeAttr('selected');

                    $('#bank_name option[data-select2-id="4"]').prop('selected', true);

                    $('#bank_name').trigger('change');

                    $("#add_button").attr("href", "javascript:void(0);").css("pointer-events", "auto")
                        .removeClass("disabled");
                    $('#amount').val('');

                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>