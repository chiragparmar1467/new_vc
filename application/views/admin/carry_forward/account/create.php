<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo $this->data['name']; ?> Master </h1>
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
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <?php if ($this->session->flashdata('errors')) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <div class="card card-primary" style="margin: 20px;">
                <div class="card-header">
                    <h3 class="card-title"><?php echo $this->data['name']; ?></h3>
                </div>
                <form role="form" action="<?php echo base_url() . $this->controllerPath ?>create/<?php echo $this->data['table_data']['id'] + 1 ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body row">
                        <div class="form-group col-md-6">
                            <label for="department">Select Closing Year</label>
                            <select class="js-example-basic-single w-100" id="closing_year" name="closing_year">
                                <option value="" disabled selected hidden>Select Closing Year</option>
                                <?php $q = $this->db->get_where('financial_year_master',array('id'=>$_SESSION['year']));
                                foreach ($q->result_array() as $k => $v) : ?>
                                    <option value="<?php echo $v['id'] ?>">
                                        <?php if ($financial_year->id == $v['id']) {
                                            echo "";
                                        } ?>
                                        <?php echo $v['title'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="department">Select Carry Forward To</label>
                            <select class="js-example-basic-single w-100" id="cary_forward" name="cary_forward">

                                <option value="" disabled selected hidden>Select Carry Forward</option>


                                <?php $q = $this->db->get_where('financial_year_master',array('id >'=>$_SESSION['year']));
                                foreach ($q->result_array() as $k => $v) : ?>
                                    <option value="<?php echo $v['id'] ?>" <?php if ($financial_year->id == $v['id']) {
                                                                                echo "";
                                                                            } ?>>
                                        <?php echo $v['title'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
<!-- </div> -->


<!-- <div class="content-wrapper"> -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } elseif ($this->session->flashdata('error')) { ?>
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>

            <!-- /.box -->
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Sr. No.</th>
                                    <th>Closing year</th>
                                    <th>Carry Forward Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php if ($table_data) : ?>
                                    <?php foreach ($table_data as $k => $v) : ?>
                                        <tr>
                                            <td><?php echo $i; ?>
                                            </td>
                                            <td class="text-center"><?php
                                                                    echo $v['old_fin_year'];
                                                                    ?>
                                            </td>
                                            <td class="text-center"><?php
                                                                    echo $v['new_fin_year'];
                                                                    ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
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
<script type="text/javascript">
    $(document).ready(function() {

        // $("#loan").addClass('menu-open');
        // $("#li-loan").addClass('active');
        // $("#loan-list").addClass('menu-open');
        // $("#loan-master").addClass('active');
        // $("#addloanaccounts").addClass('active');
        // $("#manage-loan_master").addClass('active');
        $("#carry_forward").addClass('active');


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
    });
</script>