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
            <?php
                // print_r('<pre>');
                // print_r($this->data['name']);
                // exit();
                ?>

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

                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="<?php echo base_url() . $this->controllerPath ?>create" method="post"
                        enctype="multipart/form-data">
                        <div class="card-body row">

                            <div class="form-group col-md-2">
                                <label>Select Report Type</label>
                                <select class="js-example-basic-single w-100" name="report_type" id="report_type">

                                    <option value="Collection">Collection</option>
                                    <option value="Return">Return</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="account_name">From Date</label>
                                <!-- <input type="text" class="form-control" id="datepicker" name="from_date" value="Select From Date" autocomplete="off"> -->
                                <input type="text" class="form-control" id="datepicker" name="from_date"
                                    value="dd-mm-yyyy" autocomplete=" off">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="account_name">To Date</label>
                                <!-- <input type="text" class="form-control" id="datepicker1" name="to_date" value="Select To Date" autocomplete="off"> -->
                                <input type="text" class="form-control" id="datepicker1" name="to_date"
                                    value="dd-mm-yyyy" autocomplete="off">
                            </div>

                            <div class="form-group col-md-3">
                                <label>Group Name</label>
                                <select class="js-example-basic-single w-100" name="group_name" id="group_name"
                                    onchange="get_vc()">
                                    <option selected disabled hidden>Select Group</option>
                                    <?php $q = $this->db->get_where('group_master',array('status' =>1,'deleted' =>0,'fk_financial_year_id'=>$_SESSION['year'])); foreach ($q->result_array() as $k => $v): ?>
                                    <option value="<?php echo $v['id'] ?>">
                                        <?php echo $v['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Select VC </label>
                                <select class="js-example-basic-single w-100" name="vc_name" id="vc_name">
                                    <option selected disabled hidden>Select VC</option>
                                    <?php $q = $this->db->get_where('vc_master',array('deleted'=>'0','status'=>'1','fk_financial_year_id'=>$_SESSION['year']));foreach ($q->result_array() as $k => $v): ?>
                                    <option value="<?php echo $v['id'] ?>">
                                        <?php echo $v['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3 ">
                                <label>Select Member Name</label>
                                <select class="js-example-basic-single w-100" name="member_name" id="member_name" onchange ="get_account()">
                                    <option selected disabled hidden>Select Member Name</option>
                                    <?php $q = $this->db->get_where('member_master',array('deleted'=>'0','status'=>'1'));foreach ($q->result_array() as $k => $v): 
                                    ?>
                                    <option value="<?php echo $v['id'] ?>">
                                        <?php echo $v['member_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3 ">
                                <label>Select Account No</label>
                                <select class="js-example-basic-single w-100" name="acc_no" id="acc_no">
                                    <option selected disabled hidden>Select Account No</option>
                                    <?php $q = $this->db->get_where('account_master',array('deleted'=>'0','status'=>'1'));foreach ($q->result_array() as $k => $v): 
                                    ?>
                                    <option value="<?php echo $v['account_no'] ?>">
                                        <?php echo $v['account_no'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                        </div>


                        <div class="card-footer">
                            <button name="submit" formtarget="_blank" type="submit"
                                class="btn btn-primary">Submit</button> &nbsp;
                            <a href="<?php echo base_url().$this->controllerPath ?>" class="btn btn-warning">Reset</a>
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
    $("#li-report").addClass('active');
    // $("#link-report").addClass('active');


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

function get_vc() {
    var group_id = $("#group_name").val();
    // alert(group_id);
    $.ajax({
        type: "POST",
        url: "<?php echo base_url().$this->controllerPath ?>get_vc",
        data: {
            group_id: group_id
        },
        success: function(data) {
            $('#vc_name').html(data);

            console.log(data);
        }
    });
    $.ajax({
        type: "POST",
        url: "<?php echo base_url().$this->controllerPath ?>get_member",
        data: {
            group_id: group_id
        },
        success: function(data) {
            $('#member_name').html(data);

            console.log(data);
        }
    });
    $.ajax({
        type: "POST",
        url: "<?php echo base_url().$this->controllerPath ?>get_acc",
        data: {
            group_id: group_id
        },
        success: function(data) {
            $('#acc_no').html(data);

            console.log(data);
        }
    });
};

</script>
<script>
function get_account(){
    var group_id = $("#group_name").val();
    var member_id = $("#member_name").val();
    // alert(group_id);
    // alert(member_id);
    $.ajax({
        type: "POST",
        url: "<?php echo base_url().$this->controllerPath ?>get_acc",
        data: {
            group_id: group_id,
            member_id: member_id
        },
        success: function(data) {
            $('#acc_no').html(data);

            console.log(data);
        }
    });
}
</script>