  <style>
h4 {
    text-align: center;
    margin: top 0;
}
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark">View <?php 
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
                          <h3 class="card-title">View <?php echo $this->data['name']; ?></h3>
                      </div>
                      <form role="form"
                          action="<?php echo base_url() . $this->controllerPath ?>create/<?php echo $this->data['table_data']['account_no']+1 ?>"
                          method="post" enctype="multipart/form-data">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      <p style="display: inline-block;">LIC.NO. NVS/GML/237</p>
                                  </div>
                                  <div class="col-md-5 ">
                                      <center>
                                          <h4 style="color:#FC7300; display: inline-block;">|| JAI MATA DI ||
                                          </h4>
                                          <img src="<?php echo base_url() ?>assets/logo/logo.jpg" alt="logo"
                                              class="mt-0" style="width:500px; height: 300px;">
                                      </center>
                                  </div>
                                  <div class="col-md-4" align="right">
                                      <P class="mb-0">RAJEN HIRANI</P>
                                      <P class="mb-0"><i class='fa fa-phone'></i> 8490037000</P>
                                      <P><i class='fa fa-phone'></i> 8140037000</P>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group col-md-8 mt-3">
                                      <label for="account_number">Account Number :</label>
                                      <?php ?>
                                  </div>
                                  <div class="form-group col-md-4 mt-3">
                                      <label for="account_number">Date :</label>
                                      <?php echo  date('d-m-Y') ?>
                                  </div>
                              </div>
                              <label for="account_number">Name :</label><br>
                              <label for="account_number">Address :</label><br>
                              <label for="account_number">Mo. No :</label><br>
                              <label for="account_number">ID Proof</label><br>
                              <div class="row">
                              </div>

                              <div class="card-footer">
                                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                  <a href="<?php echo base_url().$this->controllerPath ?>"
                                      class="btn btn-warning">Back</a>
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
    $("#manage-loan_master").addClass('active');


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