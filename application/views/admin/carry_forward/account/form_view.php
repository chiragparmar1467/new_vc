  <!-- Content Wrapper. Contains page content -->

  <!-- <div class="content-wrapper"> -->
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1 class="m-0 text-dark"><?php echo $this->data['name']; ?></h1>
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

              <?php if ($this->session->flashdata('success')): ?>
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
              <?php endif; ?>

              <div class="card card-primary">

                  <?php echo validation_errors(); ?>
                  <form role="form"
                      action="<?php echo base_url() . $this->controllerPath ?>edit/<?php echo $vc_master['id']; ?>"
                      method="post">
                      <div class="card-body row">

                          <div class="form-group col-md-6">
                              <label for="acc_opening_date">Select loan opening date</label>
                              <input type="text" class="form-control" name="vc_opening_date" id="datepicker" selected disabled
                                  value="<?= date("d-m-Y", strtotime($vc_master['vc_opening_date'])) ?>" autocomplete="off" required>
                          </div>

                          <div class="form-group col-md-6">
                              <label for="acc_closing_date">Select loan closing date</label>
                              <input type="text" class="form-control" name="vc_closing_date" id="datepicker1" selected disabled
                                  value="<?= date("d-m-Y", strtotime($vc_master['vc_closing_date'])) ?>" autocomplete="off" required>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Select Month</label>
                            <select class="js-example-basic-single w-100" name="month" id="month" selected disabled>
                                <option selected disabled hidden>Select Month Name</option>
                                <?php
                                      $month = $this->db->get_where('month_master',array('status' =>1,'deleted' =>0));
                                        foreach ($month->result_array() as $row) { ?>
                                  <option value="<?= $row['month_code'] ?> " <?php if($vc_master['fk_month_code'] == $row['month_code']){ echo "selected";} ?> >
                                      <?= $row['month_shortname'] ?>
                                  </option>
                                  <?php } ?>
                            </select>
                        </div>

                          <div class="form-group col-md-6">
                              <label for="vc_name">Minimum</label>
                              <input type="text" class="form-control" id="minimum" name="minimum" selected disabled value="<?= $vc_master['minimum_amount'] ?>"
                                  placeholder="Enter Amount">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="vc_name">Maximum</label>
                              <input type="text" class="form-control" id="maximum" name="maximum" selected disabled value="<?= $vc_master['maximum_amount'] ?>"
                                  placeholder="Enter Amount">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="vc_name">Instalment</label>
                              <input type="text" class="form-control" id="instalment" name="instalment" selected disabled value="<?= $vc_master['instalment'] ?>"
                                  placeholder="Enter Amount">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="acc_closing_date">Select loan draw date</label>
                              <input type="text" class="form-control" name="vc_draw_date" id="draw_date" selected disabled
                              value="<?php if($vc_master['vc_draw_date'] != 0000-00-00){ echo date("d-m-Y", strtotime($vc_master['vc_draw_date'])); } ?>"
                                  autocomplete="off" placeholder="Enter VC Draw Date">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="vc_name">Loan Name</label>
                              <input type="text" class="form-control" id="vc_name" name="vc_name" selected disabled
                                  value="<?= $vc_master['name'] ?>" placeholder="Enter Name">
                          </div>

                          <div class="form-group col-md-6">
                              <label>Select Group</label>
                              <select class="js-example-basic-single w-100" name="group" id="group" selected disabled> 
                                  <option selected disabled hidden>Select Group</option>
                                  <?php
                                     $member = $this->db->get_where('group_master',array('status' =>1,'deleted' =>0,'fk_financial_year_id'=>$_SESSION['year']));
                                        foreach ($member->result_array() as $row) { ?>
                                  <option value="<?= $row['id'] ?>" 
                                      <?php if($vc_master['group_id'] == $row['id']){echo "selected"; }?>>
                                      <?= $row['name'] ?>
                                  </option>
                                  <?php } ?>
                              </select>
                          </div>

                          <div class="form-group col-md-6">
                              <label for="gender">Status</label>
                              <div class="radio">
                                  <label>
                                      <input type="radio" name="status" id="active" value="1"
                                          <?php if($vc_master['status'] == 1){ echo "checked"; }  ?>>
                                      Active
                                  </label>
                                  <label>
                                      <input type="radio" name="status" id="inactive" value="0"
                                          <?php if($vc_master['status'] == 0){ echo "checked"; }  ?>>
                                      Inactive
                                  </label>
                              </div>
                          </div>

                      </div>

                      <div class="card-footer">
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
    $("#carry_forward").addClass('active');

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
    // $("#datepicker").datepicker();
    $("#datepicker1").datepicker({
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