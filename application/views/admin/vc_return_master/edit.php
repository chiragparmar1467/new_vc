<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit <?php echo $this->data['name']; ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . $this->controllerPath  ?>">Home</a>
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


             <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } elseif ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
                        <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>

            <div class="card card-primary">

                <form role="form" action="<?php echo base_url() . $this->controllerPath ?>edit/<?= $edit_data['id']; ?>"
                    method="post" enctype="multipart/form-data">
                    <div class="card-body row">

                        <div class="form-group col-md-6">
                            <label for="collection_date">Select date</label>
                            <input type="text" class="form-control" name="collection_date" id="datepicker"
                                value="<?= $edit_data['collection_date'] ?>" autocomplete="off" required>

                        </div>

                        <div class="form-group col-md-6">
                            <label>Group Name</label>
                            <select class="js-example-basic-single w-100" name="group_name" id="group_name"
                                onchange="get_vc(this)">
                                <option selected disabled hidden>Select Group</option>
                              <?php $q = $this->db->get_where('group_master',array('status' =>1,'deleted' =>0,'fk_financial_year_id'=>$_SESSION['year'])); foreach ($q->result_array() as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php if($v['id'] == $edit_data['fk_group_id']){ echo "selected"; } ?>>
                                    <?php echo $v['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Select Loan </label>
                            <select class="js-example-basic-single w-100" name="vc_name" id="vc_name"
                                onchange="get_member(this)">
                                <option selected disabled hidden>Select Loan</option>
                                <?php $q = $this->db->get_where('vc_master',array('status' =>1,'deleted' =>0,'group_id'=>$edit_data['fk_group_id'])); foreach ($q->result_array() as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php if($v['id'] == $edit_data['fk_vc_id']){ echo "selected"; } ?>>
                                    <?php echo $v['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Select Member Name</label>
                            <select class="js-example-basic-single w-100" name="member_name" id="member_name"
                                onchange="get_month()">
                                <option selected disabled hidden>Select Member Name</option>
                                  <?php $q = $this->db->query("
                                    SELECT map.fk_member_id,map.fk_account_id, mem.member_name FROM account_master AS acc
                                    JOIN member_master AS mem
                                    ON mem.id = acc.fk_member_id
                                    JOIN group_member_mapping_master AS map
                                    ON map.fk_account_id = acc.account_no
                                    WHERE mem.deleted = 0 AND acc.status = 1 AND acc.deleted = 0 
                                    AND map.fk_group_id = 
                                    ".$edit_data['fk_group_id']
                                    ); foreach ($q->result_array() as $k => $v): ?>
                                <option value="<?php echo $v['fk_account_id'] ?>" <?php if($v['fk_account_id'] == $edit_data['fk_acc_id']){ echo "selected"; } ?>>
                                    <?php echo "(".$v['fk_account_id'].")". $v['member_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Select Month</label>
                            <select class="js-example-basic-single w-100" name="month" id="month"
                               >
                                <option selected disabled hidden>Select Month Name</option>
                                <?php $q = $this->db->get_where('month_master',array('status' =>1,'deleted' =>0,'id'=>$edit_data['fk_month_code'])); foreach ($q->result_array() as $k => $v): ?>
                                <option value="<?php echo $v['month_code'] ?>" <?php if($v['month_code'] == $edit_data['fk_month_code']){ echo "selected"; } ?>>
                                    <?php echo $v['month_shortname'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6 d-none">
                            <label>Select Payment Mode</label>
                            <select class="js-example-basic-single w-100" name="payment_mode" id="payment_mode"
                                onchange="cheque(this)">
                                <option selected disabled hidden>Select Payment Mode</option>
                                <?php $q = $this->db->get_where('payment_mode',array('deleted'=>'0','status'=>'1'));foreach ($q->result_array() as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php if( $edit_data['fk_payment_id'] == $v['id']){ echo "selected"; } ?> >
                                    <?php echo $v['payment_mode'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>


                        <div class="form-group col-md-6 d-none" id="bank">
                            <label for="amount">Enter Bank Name</label>

                            <input type="text" class="form-control " id="bank_name" name="bank_name" value="<?= $edit_data['bank_name'] ?>"
                                placeholder="Enter Bank Name" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6 d-none" id="cheque">
                            <label for="amount">Enter Cheque Number</label>

                            <input type="text" class="form-control " id="cheque_no" name="cheque_no" value="<?= $edit_data['cheque_no'] ?>"
                                placeholder="Enter Cheque Number" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="amount">Enter Amount</label>

                            <input type="text" class="form-control" id="amount" name="amount" value="<?= $edit_data['amount'] ?>"
                                placeholder="Enter Amount" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6 d-none" id="cheque_img">
                            <label>Upload Cheque Image</label>
                            <input type="file" name="attachment" class="file-upload-default">
                            <input type="hidden" name="prev_attachment" value="<?= $edit_data['attachment']; ?>">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image" name="attachment">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group col-md-12 d-none">
                            <label>Attachment </label>
                            <?php if($edit_data['attachment'] != NULL){ ?>
                             <table class="table table-striped table-bordered">
                                <tr>
                                    <td style = "width:90%">
                                        <a target="_blank"
                                            href="<?php echo base_url() ?>assets/uploads/<?=  $edit_data['attachment']; ?>">
                                            <?php echo $edit_data['attachment']; ?>
                                        </a>
                                    </td>
                                    <td style = "width:10%">
                                    <a class="btn btn-danger" title="Remove File"
                                        href="<?= base_url() . $this->controllerPath; ?>delete_attachment/<?= $edit_data['id']; ?>">X</a>
                                </td>
                                </tr>


                            </table>
                            <?php } else{ ?>
                            <table class="table table-striped table-bordered">

                                <tr>
                                    <td>
                                        No attachments
                                    </td>

                                </tr>

                            </table>
                            <?php   } ?>
                        </div>         

                    </div>

                    <div class="card-footer">
                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>

                        <input type="button" class="btn btn-warning" onClick="goBack()" value="Back">
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- /.row -->


</section>
<!-- /.content -->


<script type="text/javascript">
$(document).ready(function() {

    $("#li-vc-re").addClass('active');
    var selectedValue = <?php echo $edit_data['fk_payment_id']; ?>;
    // // let selectedValue = $("#payment_mode option:selected").val();
    // alert(selectedValue);
   
if (selectedValue == 1 || selectedValue == 2) {
    $('#bank').removeClass('d-none');
    $('#cheque').removeClass('d-none');
    $('#cheque_img').removeClass('d-none');
} else {
    $('#bank').addClass('d-none');
    $('#cheque').addClass('d-none');
    $('#cheque_img').addClass('d-none');
}

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

function get_vc(group_id) {
    var id = group_id.value;

    $.ajax({
        type: "POST",
        url: "<?php echo base_url().$this->controllerPath ?>get_vc_name",
        data: {
            "id": id,
        },
        success: function(name) {
            $('#vc_name').html(name);

            console.log(name);
        },
        error: function() {
            alert('Something went wrong VC Name can not be found');
        }
    });
}

function cheque(id) {

    var id = id.value;

    if (id == 1 || id == 2) {
        $('#bank').removeClass('d-none');
        $('#cheque').removeClass('d-none');
        $('#cheque_img').removeClass('d-none');
    } else {
        $('#bank').addClass('d-none');
        $('#cheque').addClass('d-none');
        $('#cheque_img').addClass('d-none');
    }
}

function get_member(vc_id) {

    var vc_id = vc_id.value;
    var group_id = document.getElementById("group_name").value;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url().$this->controllerPath ?>get_member_name",
        data: {
            "vc_id": vc_id,
            "group_id": group_id,
        },
        success: function(name) {

            $('#member_name').html(name);
            console.log(name);
        },
        error: function() {
            alert('Something went wrong Members not found');
        }
    });
}

function get_amount() {
    var group_id = document.getElementById("group_name").value;
    var vc_id = document.getElementById("vc_name").value;
    var month_id = document.getElementById("month").value;

    $.ajax({
        type: "POST",
        url: "<?php echo base_url().$this->controllerPath ?>get_amount",
        data: {
            "vc_id": vc_id,
            "group_id": group_id,
            "month_id": month_id,
        },
        success: function(value) {

            $('#amount').val(value);
            console.log(value);
        },
        // error: function() {
        //     alert('Something went wrong Members not found');
        // }
    });
}

function get_month() {
    var group_id = document.getElementById("group_name").value;
    var vc_id = document.getElementById("vc_name").value;
    // var month_id = document.getElementById("month").value;

    $.ajax({
        type: "POST",
        url: "<?php echo base_url().$this->controllerPath ?>get_month",
        data: {
            "vc_id": vc_id,
            "group_id": group_id,
            // "month_id": month_id,
        },
        success: function(value) {

            $('#month').html(value);
            console.log(value);
        },
        // error: function() {
        //     alert('Something went wrong Members not found');
        // }
    });
}
</script>

<script>
    function goBack() {
    // alert('sdv');
    window.history.go(-1);
}
(function($) {
    // $("#datepicker").datepicker();
    $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
    });
})(jQuery);
</script>