  <!-- Content Wrapper. Contains page content -->



  <div class="content-wrapper">
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark"><?php 
                      
                    //    print_r('<pre>');   
                    //       print_r('fdsdff'); 
                    //       exit(); 
                      
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
                  <!-- <?php if ($this->session->flashdata('errors')) { ?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                              aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
                  </div>
                  <?php } ?> -->

                  <div class="card card-primary" style="margin: 20px;">
                      <div class="card-header">
                          <h3 class="card-title"><?php echo $this->data['name']; ?></h3>
                      </div>
                      <form role="form"
                          action="<?php echo base_url() . $this->controllerPath ?>create/<?php echo $this->data['table_data']['id']+1 ?>"
                          method="post" enctype="multipart/form-data">
                          <div class="card-body row">
                              <div class="form-group col-md-6">
                                  <label for="department">Select Closing Year</label>
                                  <select class="js-example-basic-single w-100" id="closing_year" name="closing_year">
                                      <option value="" disabled selected hidden>Select Closing Year</option>
                                      <?php  $q = $this->db->get('financial_year_master');foreach ($q->result_array() as $k => $v): ?>
                                      <option value="<?php echo $v['id'] ?>"> 
                                            <?php if($financial_year->id == $v['id']) { echo ""; } ?>
                                            <?php echo $v['title'] ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="department">Select Carry Forward To</label>
                                  <select class="js-example-basic-single w-100" id="cary_forward" name="cary_forward">

                                      <option value="" disabled selected hidden>Select Carry Forward</option>


                                      <?php  $q = $this->db->get('financial_year_master');foreach ($q->result_array() as $k => $v): ?>
                                      <option value="<?php echo $v['id'] ?>"
                                          <?php if($financial_year->id == $v['id']) { echo ""; } ?>>
                                          <?php echo $v['title'] ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>
                              <!-- <div class="form-group col-md-6">
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

                          <div class="card-footer">
                              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                              <a href="<?php echo base_url().$this->controllerPath ?>" class="btn btn-warning">Back</a>
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
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
$(document).ready(function() {

    // $("#loan").addClass('menu-open');
    // $("#li-loan").addClass('active');
    // $("#loan-list").addClass('menu-open');
    // $("#loan-master").addClass('active');
    // $("#addloanaccounts").addClass('active');
    // $("#manage-loan_master").addClass('active');
    $("#carry_forward").addClass('active');


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
    var interest_amount = parseFloat(document.getElementById("interest_amount").value);
    var monthly_amount = parseInt(document.getElementById("month").value);
    var category_id = parseInt(document.getElementById("category_name").value);
    //    alert(interest_amount)
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
        '<label for="total_amount">Per Month Interest</label><input type="text" class="form-control" id="total_amount" name="total_amount" value="' +
        total + '" autocomplete="off" readonly>';
    document.getElementById("monthly").innerHTML =
        '<label for="total_amount">Total Intrest Amount</label><input type="text" class="form-control" id="monthly_amount" name="monthly_amount" value="' +
        monthly + '" autocomplete="off" readonly>';
    document.getElementById("fullamount").innerHTML =
        '<label for="total_amount">Final Amount</label><input type="text" class="form-control" id="final_amount" name="final_amount" value="' +
        fullamount + '" autocomplete="off" readonly>';

}

function cat() {
    $('#enter_loan_amount').val(0);
    $('#interest_amount').val(0);
    $('#month').val(0);
    $('#total').val(0);
    $('#monthly').val(0);
    $('#fullamount').val(0);
    $('#total_amount').val(0);
    $('#monthly_amount').val(0);
    $('#final_amount').val(0);

}
  </script>