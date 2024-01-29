  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
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
              <?php } ?>

              <div class="card card-primary" style="margin: 20px;">

                  <form role="form" action="<?php echo base_url() . $this->controllerPath ?>create" method="post"
                      enctype="multipart/form-data">
                      <div class="card-body row">

                          <div class="form-group col-md-6">
                              <label for="acc_opening_date">Select loan opening date</label>
                              <input type="text" class="form-control" name="vc_opening_date" id="datepicker"
                                  value="<?= date('d-m-Y') ?>" autocomplete="off" required>
                          </div>

                          <div class="form-group col-md-6">
                              <label for="acc_closing_date">Select loan closing date</label>
                              <input type="text" class="form-control" name="vc_closing_date" id="datepicker1"
                                  value="<?= date('d-m-Y') ?>" autocomplete="off" required>
                          </div>

                          <div class="form-group col-md-6">
                              <label>Select Month</label>
                              <select class="js-example-basic-single w-100" name="month" id="month">
                                  <option selected disabled hidden>Select Month Name</option>
                                  <?php
                                      $month = $this->db->get_where('month_master',array('status' =>1,'deleted' =>0));
                                        foreach ($month->result_array() as $row) { ?>
                                  <option value="<?= $row['month_code'] ?>">
                                      <?= $row['month_shortname'] ?>
                                  </option>
                                  <?php } ?>
                              </select>
                          </div>

                          <div class="form-group col-md-6">
                              <label for="vc_name">Minimum</label>
                              <input type="text" class="form-control" id="minimum" name="minimum" value=""
                                  placeholder="Enter Amount">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="vc_name">Maximum</label>
                              <input type="text" class="form-control" id="maximum" name="maximum" value=""
                                  placeholder="Enter Amount">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="vc_name">Instalment</label>
                              <input type="number" class="form-control" id="instalment" name="instalment" value=""
                                  placeholder="Enter Amount" onkeyup="get_amount()">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="acc_closing_date">Select loan draw date</label>
                              <input type="text" class="form-control" name="vc_draw_date" id="draw_date"
                                  value="<?= date('d-m-Y') ?>" autocomplete="off" placeholder="Enter VC Draw Date">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="vc_name">Loan Name</label>
                              <input type="text" class="form-control" id="vc_name" name="vc_name" value=""
                                  placeholder="Enter Name">
                          </div>

                          <div class="form-group col-md-6">
                              <label>Select Group</label>
                              <select class="js-example-basic-single w-100" name="group" id="group"
                                  onchange="get_amount()">
                                  <option selected disabled hidden>Select Group</option>
                                  <?php
                                     $member = $this->db->get_where('group_master',array('status' =>1,'deleted' =>0,'fk_financial_year_id'=>$_SESSION['year']));
                                        foreach ($member->result_array() as $row) { ?>
                                  <option value="<?= $row['id'] ?>"
                                      data-custom-value="<?php echo $row['total_month'] ?>">
                                      <?= $row['name'] ?>
                                  </option>
                                  <?php } ?>
                              </select>
                              <input type="hidden" id="total_amnt" name="total_amnt" value="">
                          </div>

                          <div class="form-group col-md-6 d-none">
                              <label>Total Amount</label>
                              <input type="text" class="form-control" id="total_amount" name="total_amount" value=""
                                  placeholder="Enter Amount">
                              <!-- this field is for the amount of installement * total months of group -->
                          </div>

                          <div class="form-group col-md-6">
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
                          </div>



                      </div>

                      <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
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
  <!-- </div> -->
  <!-- /.content-wrapper -->

  <script type="text/javascript">
$(document).ready(function() {

    $("#li-vc").addClass('active');
    $("#link-vc").addClass('active');

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

function get_amount() {
    var group_id = $('#group').val();
    var installment_amount = $('#instalment').val();
    var total_month = $('#group option:selected').data('custom-value');
      
      var total_amount =  total_month * installment_amount;
   
      $('#total_amnt').val(total_amount);

}
  </script>

  <script>
(function($) {
    // $("#datepicker").datepicker();
    $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
    });
})(jQuery);
(function($) {
    // $("#datepicker").datepicker();
    $("#draw_date").datepicker({
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