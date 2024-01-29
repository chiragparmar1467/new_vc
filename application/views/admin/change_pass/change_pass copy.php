<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Change Password
            <small>Set new password for your account</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="card center" style="height:450px; width:500px;">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Enter Details</h3>
                        </div><!-- /.box-header -->
                        <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <?php }elseif($this->session->flashdata('errors')) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <?php  echo $this->session->flashdata('errors');?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
                        </div>
                        <?php } ?>

                        <!-- form start -->
                        <form action="<?php echo base_url().$this->controllerPath ?>reset" method="post">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputPassword1">Old Password</label>
                                            <input type="password" class="form-control" id="inputOldPassword"
                                                placeholder="Old password" name="oldPassword" maxlength="20" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputPassword1">New Password</label>
                                            <input type="password" class="form-control" id="inputPassword1"
                                                placeholder="New password" name="newPassword" maxlength="20" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputPassword2">Confirm New Password</label>
                                            <input type="password" class="form-control" id="inputPassword2"
                                                placeholder="Confirm new password" name="cNewPassword" maxlength="20"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" value="Submit" />
                                <input type="reset" class="btn btn-default" value="Reset" />
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </section>
</div>



<script type="text/javascript">
$(document).ready(function() {
    $("#change_pass").addClass('active');

});
</script>