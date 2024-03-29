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
                      <div class="card-header">
                          <h3 class="card-title">Edit <?php echo $this->data['name']; ?></h3>
                      </div>
                      <form role="form" action="<?php echo base_url() . $this->controllerPath ?>/edit/<?php echo $edit_data['id']; ?>" method="post">
                          <div class="card-body row">
                              <?php echo validation_errors(); ?>

                              <div class="form-group col-md-4">
                                  <label for="Bank Account No">Bank Account No</label>
                                  <input type="number" class="form-control" id="bank_account_no" name="bank_account_no" value="<?php echo $edit_data['bank_account_no'] ?>" placeholder="Enter Bank Account No" required>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="bank_name">Bank Name</label>
                                  <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo $edit_data['bank_name'] ?>" placeholder="Enter Bank Name" required>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="bank_date">Bank IFSC</label>
                                  <input type="text" class="form-control" name="bank_ifsc" id="bank_ifsc" value="<?php echo $edit_data['bank_ifsc'] ?>" placeholder="Enter Bank IFSC" required>

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
          $("#li-bank_master").addClass('active');
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