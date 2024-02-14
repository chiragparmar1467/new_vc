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
<!-- Main content -->
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

                <form role="form" id="cash_form" action="<?php echo base_url() . $this->controllerPath ?>/create" method="post" enctype="multipart/form-data">
                    <div class="field_wrapper1">
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="Item Code">Item Code</label>
                                <input type="text" class="form-control" id="item_code" name="item_code" placeholder="Enter Item Code" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Item Name">Item Name</label>
                                <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter Item Name" required>
                            </div>
                        </div>
                        <div class="added_fields_container"></div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- /.row -->
</section>

<section class="content">
    <!-- Small boxes (Stat box) -->
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
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php if ($table_data) : ?>
                                    <?php foreach ($table_data as $k => $v) :

                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?>
                                            </td>
                                            <td class="text-center"><?php echo $v['item_code']; ?>
                                            </td>
                                            <td class="text-center"><?php
                                                                    echo  $v['item_name'];
                                                                    ?>
                                            </td>

                                            <td>
                                                <a href="<?php echo base_url() . $this->controllerPath ?>/edit/<?php echo $v['id'];  ?>" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a onclick="return confirm('Are you sure want to delete this data?');" title="Delete" href="<?php echo base_url() . $this->controllerPath ?>/delete/<?php echo $v['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                </a>
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

<script type="text/javascript">
    $(document).ready(function() {
        $("#li-item_master").addClass('active');
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