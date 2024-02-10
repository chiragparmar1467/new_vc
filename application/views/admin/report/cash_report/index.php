<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo $this->data['name']; ?> Manage</h1>
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
                    <form role="form" action="<?php echo base_url() . $this->controllerPath ?>create" method="post" enctype="multipart/form-data">
                        <div class="card-body row">

                            <div class="form-group col-md-3">
                                <label for="account_name">From Date</label>
                                <!-- <input type="text" class="form-control" id="datepicker" name="from_date" value="Select From Date" autocomplete="off"> -->
                                <input type="text" class="form-control" id="datepicker" name="from_date" value="dd-mm-yyyy" autocomplete=" off">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="account_name">To Date</label>
                                <!-- <input type="text" class="form-control" id="datepicker1" name="to_date" value="Select To Date" autocomplete="off"> -->
                                <input type="text" class="form-control" id="datepicker1" name="to_date" value="dd-mm-yyyy" autocomplete="off">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Select Member Name</label>
                                <select class="js-example-basic-single w-100 member_name" name="member_name" id="member_name" required>
                                    <option disabled selected hidden>Select Members</option>
                                    <?php
                                    $member = $this->db->query('select * from account_master where deleted = 0 AND status = 1  AND fk_financial_year_id =' . $_SESSION['year'])->result_array();
                                    foreach ($member as $row) {
                                    ?>
                                        <option value=" <?php echo $row['account_no']; ?>">
                                            <?php echo $row['member_name']; ?>
                                        </option>
                                    <?php
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Select Voucher No</label>
                                <select class="js-example-basic-single w-100 voucher_no" name="voucher_no" id="voucher_no" required>
                                    <option disabled selected hidden>Select Voucher No</option>
                                    <?php
                                    $voucher_no = $this->db->query('select * from cash_management where deleted = 0 AND status = 1 AND fk_financial_year_id =' . $_SESSION['year'])->result_array();
                                    foreach ($voucher_no as $row) {
                                    ?>
                                        <option value="<?= $row['voucher_no'] ?>">
                                            <?php echo $row['voucher_no']; ?>
                                        </option>
                                    <?php
                                    } ?>
                                </select>
                            </div>

                            <!-- <div class="form-group col-md-3">
                                <label>Select Account No</label>
                                <select class="js-example-basic-single w-100 account_no" name="account_no" id="account_no" required>
                                    <option disabled selected hidden>Select Account No</option>
                                    <?php
                                    $account_no = $this->db->query('select * from account_master where deleted = 0 AND status = 1 AND fk_financial_year_id =' . $_SESSION['year'])->result_array();
                                    foreach ($account_no as $row) {
                                    ?>
                                        <option value="<?= $row['account_no'] ?>">
                                            <?php echo $row['account_no']; ?>
                                        </option>
                                    <?php
                                    } ?>
                                </select>
                            </div> -->
                        </div>

                        <div class="card-footer">
                            <button name="submit" formtarget="_blank" type="submit" class="btn btn-primary">Submit</button> &nbsp;
                            <a href="<?php echo base_url() . $this->controllerPath ?>" class="btn btn-warning">Reset</a>
                        </div>
                    </form>
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
        $("#link-Reports").removeClass('collapsed');
        $("#link-Reports").attr("aria-expanded", true);
        $("#ui-basi").addClass('show');
        $("#li-report-cash").addClass('active');
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
    (function($) {
        // $("#datepicker1").datepicker();
        $("#datepicker1").datepicker({
            dateFormat: 'dd-mm-yy'
        });
    })(jQuery);

    $(document).ready(function() {
        $('#member_name').on('change', function() {
            member_name();
        });
    });


    function member_name() {

        var member_id = $("#member_name").val();
        // alert(member_id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . $this->controllerPath ?>get_voucher/",
            data: {
                member_id: member_id
            },
            success: function(data) {
                $('#voucher_no').html(data);
                // console.log(data);

                console.log(data);
            }
        });
    };
</script>