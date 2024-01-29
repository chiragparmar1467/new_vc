<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage <?php echo $this->data['name']; ?></h1>
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
        <div class="col-12">
            <?php
                // print_r('<pre>');
                // print_r($this->data['name']);
                // exit();
                ?>

            <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } elseif ($this->session->flashdata('error')) { ?>
            <div class="alert alert-error alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
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
                <div class="card-header">


                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Sr. No.</th>
                                    <th>Collection Date</th>
                                    <th>Month</th>
                                    <th>Member Name </th>
                                    <th>Collection</th>
                                    <th>Action</th>
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
                                        
                                            $date= $v['collection_date'];
                                            echo $date;
                                         
                                           
                                            ?>
                                    </td>
                                    <td class="text-center"><?php echo $v['month_name']; ?>
                                    </td>
                                    <td class="text-center"><?php echo $v['member_name']; ?>
                                    </td>


                                    <td class="text-center">
                                        <?php echo $v['amount']; ?>
                                    </td>


                                    <td>
                                        <?php 
                                        $hide = '';
                                        if($v['member_status'] == 0 || $v['group_status'] == 0 || $v['end_date'] < date('Y-m-d')){
                                            $hide = "style='pointer-events: none; opacity: 0.5;'";
                                         }
                                        ?>


                                        <a href="<?php echo base_url() . $this->controllerPath ?>edit/<?php echo $v['coll_id']; ?>"
                                            title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>

                                        <!-- <a href="<?php echo base_url() . $this->controllerPath ?>form_view/<?php echo $v['coll_id'];  ?>/<?php echo $v['fk_member_id'] ?>"
                                            title="view" class="btn btn-primary"><i class="fa fa-eye"></i></a> -->


                                        <a href="<?php echo base_url() . $this->controllerPath ?>viewpdf/<?php echo $v['coll_id'];?>"
                                            target="_blank" title="PDF" class="btn btn-info"><i
                                                class=" fa fa-file-pdf-o"></i></a>

                                        <a href="<?php echo base_url() . $this->controllerPath ?>downloadpdf/<?php echo $v['coll_id'];?>"
                                            target="_blank" title="PDF Download" class="btn btn-success">
                                            <i class=" fa fa-download"></i></a>

                                        <a onclick="return confirm('Are you sure want to delete this data?');"
                                            title="Delete"
                                            href="<?php echo base_url() . $this->controllerPath ?>delete/<?php echo $v['coll_id']; ?>"
                                            class="btn btn-danger"><i class="fa fa-trash"></i>
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
<!-- /.content -->


<script type="text/javascript">
$(document).ready(function() {

    $("#li-coll").addClass('active');

});
</script>