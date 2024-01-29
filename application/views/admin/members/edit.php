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
                    
                      <form role="form"
                          action="<?php echo base_url() . $this->controllerPath ?>edit/<?php echo $edit_data['id']; ?>"
                          method="post">
                          <div class="card-body row">

                              <?php echo validation_errors(); ?>

                              <div class="form-group col-md-6">
                              <label for="member_name">Member Name</label>
                              <input type="text" class="form-control" id="member_name" name="member_name"
                                  value="<?= $edit_data['member_name'] ?>"
                                  placeholder="Enter Member Name" >
                          </div>

                          <div class="form-group col-md-6">
                              <label for="address">Address</label>
                              <input type="text" class="form-control" id="address" name="address"
                                  value="<?= $edit_data['address'] ?>"
                                  placeholder="Enter member address" >
                          </div>

                          <div class="form-group col-md-6">
                              <label for="mobile_no">Mobile No.</label>
                              <input type="number" class="form-control" id="mobile_no" name="mobile_no"
                                  value="<?= $edit_data['mobile_number'] ?>"
                                  placeholder="Enter member number">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" name="email"
                                  value="<?= $edit_data['email'] ?>"
                                  placeholder="Enter member email">
                          </div>

                       
                          <div class="form-group col-md-6">
                              <label for="gender">Status</label>
                              <div class="radio">
                                  <label>
                                      <input type="radio" name="status" id="active" value="1" <?php if($edit_data['status'] == 1){ echo "checked"; }  ?>>
                                      Active
                                  </label>
                                  <label>
                                      <input type="radio" name="status" id="inactive" value="0" <?php if($edit_data['status'] == 0){ echo "checked"; }  ?>>
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
    $("#li-member").addClass('active');
    $("#link-member").addClass('active');
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