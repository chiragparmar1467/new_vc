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
                              <label for="acc_opening_date">Select group opening date</label>
                              <input type="text" class="form-control" name="acc_opening_date" id="datepicker" value="<?php   $date = date("d-m-Y", strtotime($edit_data['start_date'])); 
                                    echo $date;  ?>" autocomplete="off" required>

                          </div>

                          <div class="form-group col-md-6">
                              <label for="acc_closing_date">Select group closing date</label>
                              <input type="text" class="form-control" name="acc_closing_date" id="datepicker1" value="<?php   $date = date("d-m-Y", strtotime($edit_data['end_date'])); 
                                    echo $date;  ?>" autocomplete="off" required>
                          </div>

                          <div class="form-group col-md-6">
                              <label for="group_name">Total Months</label>
                              <input type="number" class="form-control" id="months" name="months" value="<?= $edit_data['total_month']; ?>"
                                  placeholder="Enter Months">
                          </div>


                          <div class="form-group col-md-6">
                              <label for="group_name">Group Name</label>
                              <input type="text" class="form-control" id="group_name" name="group_name"
                                  value="<?= $edit_data['name'] ?>" placeholder="Enter Group Name">
                          </div>

                          <div class="form-group col-md-6">
                              <label for="group_short_name">Group Short Name</label>
                              <input type="text" class="form-control" id="group_short_name" name="group_short_name"
                                  value="<?= $edit_data['short_name'] ?>" placeholder="Enter Group Short Name">
                          </div>

                          <div class="form-group col-md-6">
                              <label>Select Member Name</label>
                              <select class="js-example-basic-multiple w-100" multiple="multiple" name="members_name[]"
                                  id="members_name">
                                  <option disabled hidden>Select Members</option>
                                  <?php 
                                   $member = $this->db->query('SELECT mem.id as mem_id,acc.account_no as acc_no,mem.member_name FROM `member_master` as mem
                                   JOIN account_master as acc ON acc.fk_member_id = mem.id 
                                   WHERE acc.status = 1 AND acc.deleted = 0 
                                   AND mem.status = 1 AND mem.deleted = 0;')->result_array();
                                        $selected = $this->db->query("SELECT map.fk_member_id,map.fk_account_id, mem.member_name FROM account_master AS acc
                                        JOIN member_master AS mem
                                        ON mem.id = acc.fk_member_id
                                        JOIN group_member_mapping_master AS map
                                        ON map.fk_account_id = acc.account_no
                                        WHERE map.fk_group_id = ".$edit_data['id'])->result_array();

                                 foreach ($member as $row) { ?>
                                  <option value="<?= $row['acc_no'] ?>"  
                                  <?php foreach($selected as $s){if($s['fk_account_id'] == $row['acc_no']) 
                                    { echo 'selected'; }} ?> >
                                      <?php echo "(". $row['acc_no'] .")" .$row['member_name']; ?>
                                  </option>
                                  <?php } ?>
                              </select>
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
    $("#li-group").addClass('active');
    $("#link-group").addClass('active');
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