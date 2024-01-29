<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Add <?php 
                      
                  
                      echo $this->data['name']; ?></h1>
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
            <?php if ($this->session->flashdata('errors')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
            </div>
            <?php }   ?>

            <div class="card card-primary" style="margin: 20px;">

                <form role="form" action="<?php echo base_url() . $this->controllerPath ?>create" method="post"
                    enctype="multipart/form-data">
                    <div class="card-body row">

                        <div class="form-group col-md-6">
                            <label for="collection_date">Select date</label>
                            <input type="text" class="form-control" name="collection_date" id="datepicker"
                                value="<?= date('d-m-Y') ?>" autocomplete="off" required>

                        </div>


                        <div class="form-group col-md-6">
                            <label>Select Month</label>
                            <select class="js-example-basic-single w-100" name="month" id="month" >
                            <option selected disabled hidden>Select Month</option>  
                                <?php $q = $this->db->query('SELECT month.month_name,month.month_shortname,month.id,month.month_code FROM
                                 month_master as month WHERE month.deleted = 0'); 
                                // <?php $q = $this->db->query('SELECT month.month_name,month.month_shortname,month.id,month.month_code FROM vc_master as vc
                                //                                 JOIN month_master as month ON month.month_code = vc.fk_month_code
                                //                                 WHERE vc.id ='.$vc_id); 
                                foreach ($q->result_array() as $k => $v): ?>
                                <option value="<?php echo $v['month_code'] ?>" selected>
                                    <?php echo "(" .$v['month_code']. ")" . $v['month_shortname'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Group Name</label>
                            <select class="js-example-basic-single w-100" name="group_name" id="group_name">

                                <?php $q = $this->db->get_where('group_master',array('status' =>1,'deleted' =>0,'id' => $group_id)); foreach ($q->result_array() as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" selected>
                                    <?php echo $v['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Select Loan </label>
                            <select class="js-example-basic-single w-100" name="vc_name" id="vc_name" >
                                <option selected disabled hidden>Select VC</option>
                                <?php $q = $this->db->get_where('vc_master',array('deleted'=>'0','status'=>'1','id'=>$vc_id));foreach ($q->result_array() as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" selected>
                                    <?php echo $v['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Select Member Name</label>
                            <select class="js-example-basic-single w-100" name="member_name" id="member_name" onchange = "get_amount()">
                            <option disabled selected hidden>Select Members</option>
                                  <?php
                                      $member = $this->db->query('SELECT map.fk_member_id,map.fk_account_id, mem.member_name FROM account_master AS acc
                                      JOIN member_master AS mem
                                      ON mem.id = acc.fk_member_id
                                      JOIN group_member_mapping_master AS map
                                      ON map.fk_account_id = acc.account_no
                                      WHERE map.fk_group_id = '.$group_id)->result_array();
                               
       
                                        foreach ($member as $row) {  
                                    ?>
                                  <option value="<?= $row['fk_account_id'] ?>"> 
                                    <?php
                                      echo "(". $row['fk_account_id'] .")" .$row['member_name']; ?>
                                  </option>
                                  <?php
                                 } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6 d-none">
                            <label>Select Payment Mode</label>
                            <select class="js-example-basic-single w-100" name="payment_mode" id="payment_mode"
                                onchange="cheque(this)">
                                <option selected disabled hidden>Select Payment Mode</option>
                                <?php $q = $this->db->get_where('payment_mode',array('deleted'=>'0','status'=>'1'));foreach ($q->result_array() as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>">
                                    <?php echo $v['payment_mode'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>


                        <div class="form-group col-md-6 d-none" id="bank">
                            <label for="amount">Enter Bank Name</label>

                            <input type="text" class="form-control " id="bank_name" name="bank_name" value=""
                                placeholder="Enter Bank Name" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6 d-none" id="cheque">
                            <label for="amount">Enter Cheque Number</label>

                            <input type="text" class="form-control " id="cheque_no" name="cheque_no" value=""
                                placeholder="Enter Cheque Number" autocomplete="off">
                        </div>
                        
                         <div class="form-group col-md-6 d-none" id="credit_bank">
                            <label for="credit_bank">Enter Credit Bank Name</label>
                                <select class="js-example-basic-single w-100" name="credit_bank_name" id="credit_bank_name">
                                <option selected disabled hidden>Select Credit Bank Name</option>
                                <option value="HDFC">HDFC</option>
                                <option value="BOB">BOB</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="amount">Enter Amount</label>

                            <input type="text" class="form-control" id="amount" name="amount" value="0"
                                placeholder="Enter Amount" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6  d-none" id="cheque_img">
                            <label>Upload Cheque Image</label>
                            <input type="file" name="attachment" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image" name="attachment">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
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
    </div>    <!-- /.row -->


</section>
<!-- /.content -->


<script type="text/javascript">
$(document).ready(function() {

    $("#li-coll").addClass('active');

});

function goBack() {
    // alert('sdv');
    window.history.go(-1);
}

function selectAllRecord(params) {
    // $("#view_payment_btn").show();

    if (params.checked) {
        $('.item').prop('checked', true);
    } else {
        $('.item').prop('checked', false);
        // $("#view_payment_btn").hide();
    }
}

function get_amount(group_id) {
  
    var vc_id = document.getElementById('vc_name').value;
    // alert(vc_id);

    $.ajax({
        type: "POST",
        url: "<?php echo base_url().$this->controllerPath ?>get_amount",
        data: {
            "vc_id": vc_id,
        },
        success: function(amount) {
            $('#amount').val(amount);

            console.log(amount);
        },
        error: function() {
            alert('Something went wrong VC Name can not be found');
        }
    });
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

function get_member() {
   var group_id = document.getElementById("group_name").value;
   var vc_id = document.getElementById("vc_name").value;
   var month_id = document.getElementById("month").value;
 
    $.ajax({
        type: "POST",
        url: "<?php echo base_url().$this->controllerPath ?>get_member_name",
        data: {
            "group_id": group_id,
            "vc_id": vc_id,
            "month_id": month_id,
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
</script>

<script>
(function($) {
    // $("#datepicker").datepicker();
    $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
    });
})(jQuery);
</script>