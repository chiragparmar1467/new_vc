
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
                          method="post">
                          <div class="card-body row">

                              <?php echo validation_errors(); ?>

                              <div class="form-group col-md-6">
                                  <label for="bank_name">Enter Title</label>
                                  <input type="text" class="form-control" id="title" name="title"
                                      value="<?= $edit_data['title'] ?>" placeholder="Enter Bank Name">
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="acc_opening_date">Select Start Date</label>
                                  <input type="text" class="form-control" name="start_date" id="datepicker"
                                      value="<?=  date("d-m-Y", strtotime($edit_data['start_date'])) ?>"
                                      autocomplete="off" required>

                              </div>

                              <div class="form-group col-md-6">
                                  <label for="acc_closing_date">Select End Date</label>
                                  <input type="text" class="form-control" name="end_date" id="datepicker1"
                                      value="<?php echo  date("d-m-Y", strtotime($edit_data['end_date']))  ?>"
                                      autocomplete="off" required>

                              </div>

                              <div class="form-group col-md-6">
                                  <label for="bank_name">Enter Year</label>
                                  <input type="text" class="form-control" id="year" name="year"
                                      value="<?= $edit_data['year'] ?>" placeholder="Enter Bank Name">
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


  <script type="text/javascript">
$(document).ready(function() {
    // $("#loan").addClass('menu-open');
    // $("#li-loan").addClass('active');
    // $("#loan-list").addClass('menu-open');
    // $("#loan-master").addClass('active');
    // $("#addloanaccounts").addClass('active');
    // $("#add_customer").addClass('active');
    // $("#manage-loan_master").addClass('active');
    $("#financial_year_master").addClass('active');


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