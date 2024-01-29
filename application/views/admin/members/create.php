  <!-- Content Wrapper. Contains page content -->



  <!-- <div class="content-wrapper"> -->
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Add <?php 
                      
                    //    print_r('<pre>');   
                    //       print_r('fdsdff'); 
                    //       exit(); 
                      
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

                  <form role="form"
                      action="<?php echo base_url() . $this->controllerPath ?>create"
                      method="post" enctype="multipart/form-data">
                      <div class="card-body row">

                              <div class="form-group col-md-6">
                              <label for="member_name">Member Name</label>
                              <input type="text" class="form-control" id="member_name" name="member_name"
                                  value=""
                                  placeholder="Enter Member Name" >
                          </div>

                          <div class="form-group col-md-6">
                              <label for="address">Address</label>
                              <input type="text" class="form-control" id="address" name="address"
                                  value=""
                                  placeholder="Enter member address" >
                          </div>

                          <div class="form-group col-md-6">
                              <label for="mobile_no">Mobile No.</label>
                              <input type="number" class="form-control" id="mobile_no" name="mobile_no"
                                  value=""
                                  placeholder="Enter member number">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" name="email"
                                  value=""
                                  placeholder="Enter member email">
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

    $("#li-member").addClass('active');
    $("#link-member").addClass('active');

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
(function($) {
    // $("#datepicker").datepicker();
    $( "#datepicker" ).datepicker({  dateFormat: 'dd-mm-yy' });
})(jQuery);
  </script>
  <script>
(function($) {
    // $("#datepicker1").datepicker();
    $( "#datepicker1" ).datepicker({  dateFormat: 'dd-mm-yy' });
})(jQuery);
  </script>