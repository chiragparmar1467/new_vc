    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php 
                      
                  
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

                <?php if($this->session->flashdata('errors')) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <?php  echo $this->session->flashdata('errors');?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
                </div>
                <?php } ?>

                <div class="card card-primary" style="margin: 20px;">

                    <form action="<?php echo base_url().$this->controllerPath ?>reset/<?php echo $id ?>" method="post">

                        <div class="card-body">

                            <div class="form-group col-md-6">
                                <label for="inputPassword1">Old Password</label>
                                <input type="password" class="form-control" id="inputOldPassword"
                                    placeholder="Old password" name="oldPassword" maxlength="20" required>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword1">New Password</label>
                                <input type="password" class="form-control" id="inputPassword1"
                                    placeholder="New password" name="newPassword" maxlength="20" required>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword2">Confirm New Password</label>
                                <input type="password" class="form-control" id="inputPassword2"
                                    placeholder="Confirm new password" name="cNewPassword" maxlength="20" required>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>

                            <a href="<?php echo base_url().$this->controllerPath .'change_pass' ?>"
                                class="btn btn-warning">Reset</a>
                            <a href="<?php echo base_url().$this->controllerPath ?>" class="btn btn-info">Back</a>

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


    <script type="text/javascript">
$(document).ready(function() {
    $("#change_pass").addClass('active');

});
</script>