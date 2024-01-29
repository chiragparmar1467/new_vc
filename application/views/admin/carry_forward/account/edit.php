  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark">Edit <?php echo $this->data['name']; ?></h1>
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

                  <!-- <?php if ($this->session->flashdata('success')): ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                              aria-hidden="true">&times;</span></button>
                      <?php echo $this->session->flashdata('success'); ?>
                  </div>
                  <?php elseif ($this->session->flashdata('error')): ?>
                  <div class="alert alert-error alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                              aria-hidden="true">&times;</span></button>
                      <?php echo $this->session->flashdata('error'); ?>
                  </div>
                  <?php endif; ?> -->

                  <div class="card card-primary">
                      <div class="card-header">
                          <h3 class="card-title">Edit <?php echo $this->data['name']; ?></h3>
                      </div>
                      <form role="form"
                          action="<?php echo base_url() . $this->controllerPath ?>edit/<?php echo $edit_data['id']; ?>"
                          method="post" enctype="multipart/form-data">
                          <div class="card-body row">

                              <?php echo validation_errors(); ?>

                              <div class="form-group col-md-6">
                                  <label for="acc_opening_date">Select account opening date</label>
                                  <input type="text" class="form-control" name="acc_opening_date" id="datepicker"
                                      value="<?= $edit_data['acc_opening_date'] ?>" autocomplete="off" required>

                              </div>

                              <div class="form-group col-md-6">
                                  <label for="acc_closing_date">Select account closing date</label>
                                  <input type="text" class="form-control" name="acc_closing_date" id="datepicker1"
                                      value="<?php echo $edit_data['acc_closing_date']  ?>" autocomplete="off" required>

                              </div>

                              <div class="form-group col-md-6">
                                  <label for="department">Select Party Name</label>
                                  <select class="form-control select2bs4" id="party_name" name="party_name" required>
                                      <option value="">Select Party Name</option>
                                      <?php $q = $this->db->get_where('loan_party_master',array('deleted'=>'0','status'=>'1'));foreach ($q->result_array() as $k => $v): ?>
                                      <option value="<?php echo $v['id'] ?>"
                                          <?php if($edit_data['fk_party_id'] == $v['id']) { echo 'selected'; } ?>>
                                          <?php echo $v['account_name'] ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="account_number">Account Number</label>
                                  <input type="text" class="form-control" id="account_number" name="account_number"
                                      value="<?= $edit_data['account_no'] ?>"
                                      placeholder="Select party name account number is auto increment"
                                      autocomplete="off" disabled>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="account_number">Loan Number</label>
                                  <input type="text" class="form-control" id="loan_no" name="loan_no"
                                      value="<?= $edit_data['id'] ?>"
                                      placeholder="Select party name account number is auto increment"
                                      autocomplete="off" disabled>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="bank_name">Enter Bank Name</label>
                                  <input type="text" class="form-control" id="bank_name" name="bank_name"
                                      value="<?= $edit_data['bank_name'] ?>" placeholder="Enter Bank Name">
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="cheque_no">Enter Cheque No</label>
                                  <input type="text" class="form-control" id="cheque_no" name="cheque_no"
                                      value="<?= $edit_data['cheque_no'] ?>" placeholder="Enter Cheque Number">
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="front_image">Cheque Image</label>
                                  <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="cheque_image"
                                          id="cheque_image">
                                      <label class="custom-file-label" for="customFile">Choose file</label>
                                  </div>
                                  <?php if($edit_data['cheque_image']) { ?>

                                  <a href="<?php echo base_url() ?>assets/uploads/document/<?php echo $edit_data['id'] ?>"
                                      target="_blank" rel="noopener noreferrer">
                                      <img class="mt-1 ml-3 img-fluid"
                                          src="<?php echo base_url() ?>assets/uploads/document/<?php echo $edit_data['cheque_image'] ?>"
                                          alt="Item" style="width: 250px; height: 300px;">
                                  </a>
                                  <input type="hidden" name="cheque_image"
                                      value="<?php echo $edit_data['cheque_image']; ?>">
                                  <?php } ?>
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="department">Select Category Name</label>
                                  <select class="form-control select2bs4" id="category_name" name="category_name"
                                      required onchange="cat()">
                                      <option value="">Select Category Name</option>
                                      <?php $q = $this->db->get_where('loan_category_master',array('deleted'=>'0','status'=>'1'));foreach ($q->result_array() as $k => $v): ?>
                                      <option value="<?php echo $v['id'] ?>"
                                          <?php if($edit_data['fk_loan_category_id'] == $v['id']) { echo 'selected'; } ?>>
                                          <?php echo $v['title'] ?></option>
                                      <?php endforeach ?>
                                  </select>
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="enter_loan_amount">Enter Loan Amount</label>
                                  <input type="text" class="form-control" id="enter_loan_amount"
                                      name="enter_loan_amount" value="<?= $edit_data['loan_amount'] ?>"
                                      placeholder="Enter Loan Amount" autocomplete="off" onkeyup="totalamount()">

                              </div>

                              <div class="form-group col-md-6">
                                  <label for="interest_amount">Enter Interest</label>
                                  <input type="text" class="form-control" id="interest_amount" name="interest_amount"
                                      value="<?= $edit_data['interest_amount'] ?>" placeholder="Enter Interest"
                                      autocomplete="off" onkeyup="totalamount()">
                              </div>


                              <div class="form-group col-md-6">
                                  <label for="amount">Enter Month</label>
                                  <input type="text" class="form-control" id="month" name="month"
                                      value="<?= $edit_data['month'] ?>" placeholder="Enter Amount" autocomplete="off"
                                      onkeyup="totalamount()">
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="gender">Status</label>
                                  <div class="radio">
                                      <label>
                                          <input type="radio" name="status" id="active" value="1"
                                              <?php if($edit_data['status'] == 1){ echo "checked"; }  ?>>
                                          Active
                                      </label>
                                      <label>
                                          <input type="radio" name="status" id="inactive" value="0"
                                              <?php if($edit_data['status'] == 0){ echo "checked"; }  ?>>
                                          Inactive
                                      </label>
                                  </div>
                              </div>
                              <div class="form-group col-md-6" id="total"> </div>
                              <div class="form-group col-md-6" id="monthly"> </div>
                              <div class="form-group col-md-6" id="fullamount"> </div>
                          </div>

                          <div class="card-footer">
                              <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
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
    // $("#add_customer").addClass('active');
    $("#carry_forward").addClass('active');

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
    // $( "#datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
});
  </script>
  <script>
function totalamount() {
    var loan_amount = parseInt(document.getElementById("enter_loan_amount").value);
    var interest_amount = parseFloat(document.getElementById("interest_amount").value);
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