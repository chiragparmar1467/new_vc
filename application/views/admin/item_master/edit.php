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

                  <?php if ($this->session->flashdata('success')) : ?>
                      <div class="alert alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <?php echo $this->session->flashdata('success'); ?>
                      </div>
                  <?php elseif ($this->session->flashdata('error')) : ?>
                      <div class="alert alert-error alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <?php echo $this->session->flashdata('error'); ?>
                      </div>
                  <?php endif; ?>

                  <div class="card card-primary">
                      
                      <form role="form" action="<?php echo base_url() . $this->controllerPath ?>/edit/<?php echo $edit_data['id']; ?>" method="post">
                          <div class="card-body row">
                              <?php echo validation_errors(); ?>

                              <div class="form-group col-md-6">
                                  <label for="Item Code">Item Code</label>
                                  <input type="text" class="form-control" id="item_code" value="<?php echo $edit_data['item_code'] ?>" name="item_code" placeholder="Enter Item Code" required>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="Item Name">Item Name</label>
                                  <input type="text" class="form-control" id="item_name" value="<?php echo $edit_data['item_name'] ?>" name="item_name" placeholder="Enter Item Name" required>
                              </div>

                          </div>

                          <div class="card-footer">
                              <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
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
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
      $(document).ready(function() {
          $("#li-item_master").addClass('active');
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
          var interest_amount = parseInt(document.getElementById("interest_amount").value);
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
              '<label for="total_amount">Interest On Loan Amount</label><input type="text" class="form-control" id="total_amount" name="total_amount" value="' +
              total + '" autocomplete="off" disabled>';
          document.getElementById("monthly").innerHTML =
              '<label for="total_amount">Interest Amount * Month Amount</label><input type="text" class="form-control" id="monthly_amount" name="monthly_amount" value="' +
              monthly + '" autocomplete="off" disabled>';
          document.getElementById("fullamount").innerHTML =
              '<label for="total_amount">Final Amount</label><input type="text" class="form-control" id="total_amount" name="total_amount" value="' +
              fullamount + '" autocomplete="off" disabled>';

      }

      function cat() {
          $('#enter_loan_amount').val(0);
          $('#interest_amount').val(0);
          $('#month').val(0);
          $('#total').val(0);
          $('#monthly').val(0);
          $('#fullamount').val(0);

      }
  </script>