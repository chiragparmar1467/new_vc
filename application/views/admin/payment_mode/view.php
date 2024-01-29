<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,
th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(odd) {
    background-color: #dddddd;
}
</style>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">View <?php echo $this->data['name']; ?></h1>
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

            <div class="card">
                <div class="card-header">

                </div>

                <div class="card-body">
                    <p><b>VC DETAILS</b>
                        <a href="<?php echo base_url().$this->controllerPath ?>"
                            class="btn btn-warning float-right p-2">Back</a>
                    </p>
                    <hr>

                    <table>

                        <tr>
                            <td style="font-weight: bold;">Group Start Date</td>
                            <td> <?php 
                                 $date = date("d-m-Y", strtotime($view_data->start_date)); 
                                 echo $date; ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-weight: bold;">Group End Date</td>
                            <td> <?php 
                                 $date = date("d-m-Y", strtotime($view_data->end_date)); 
                                 echo $date; ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-weight: bold;">Group Name</td>
                            <td><?= $view_data->group_name; ?></td>
                        </tr>

                        <tr>
                            <td style="font-weight: bold;">VC Name</td>
                            <td><?= $view_data->name; ?></td>
                        </tr>

                        <tr>
                            <td style="font-weight: bold;">Member Name</td>
                            <td> <?php $i=1; $mapped_member = $this->db->get_where('group_member_mapping_master',array('fk_group_id'=>$view_data->group_id))->result_array();
                               foreach($mapped_member as $member_data){ 
                          $member = $this->db->get_where('member_master',array('id'=>$member_data['fk_member_id']))->row();
                             echo $i.') '.$member->member_name.'<br>'; 
                             $i++; } ?></td>
                        </tr>

                    </table>
                </div>

            </div>
            <!-- /.box -->
        </div>
        <!-- col-md-12 -->
    </div>
    <!-- /.row -->
</section>


<script type="text/javascript">
$(document).ready(function() {
    $("#li-vc").addClass('active');
    $("#link-vc").addClass('active');
});
</script>