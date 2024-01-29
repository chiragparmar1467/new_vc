  <!-- Content Wrapper. Contains page content -->

  <!-- <div class="content-wrapper"> -->
  <!-- Content Header (Page header) -->
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
                      action="<?php echo base_url() . $this->controllerPath ?>edit/<?php echo $edit_data['id']; ?>"
                      method="post">
                      <div class="card-body row">



                          <div class="form-group col-md-6">
                              <label for="vc_name">Payment Mode</label>
                              <input type="text" class="form-control" id="payment_mode" name="payment_mode"
                                  value="<?= $edit_data['payment_mode'] ?>" placeholder="Enter Payment Mode Name">
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
                      </div>

                      <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Save Changes</button>
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
  </script>
  <script>
$(function() {
    // $("#datepicker").datepicker();
    $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
    });
});
  </script>
  <script>
$(function() {
    // $("#datepicker1").datepicker();
    $("#datepicker1").datepicker({
        dateFormat: 'dd-mm-yy'
    });
});
  </script>