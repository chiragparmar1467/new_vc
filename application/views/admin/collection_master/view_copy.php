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
    <center>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
               
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

        <div class="row" style="width:80%;">
            <div class="col-12">
                <div class="card card-primary" style="margin: 20px; ">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <table style="width:100%; margin:15px; padding:5px;">
                                <tr>
                                    <td style="text-align:left; font-size: 12px;">
                                        <p><b>LIC. NO. - NVS/GML/237</b></p>
                                    </td>
                                    <td>
                                        <center>
                                            <p style="color:#f3740d;"><b>|| JAI MATA DI ||</b></p>
                                        </center>
                                    </td>
                                    <td style="text-align:right; font-size: 12px;">
                                        <p class="mb-0"><b>RAJEN HIRANI</b></p>
                                        <p class="mb-0"><img src="<?php echo base_url();?>assets/logo/phone.png"
                                                width="10" alt="" srcset="">&nbsp;8490037000
                                        </p>
                                        <p><img src="<?php echo base_url();?>assets/logo/phone.png" width="10" alt=""
                                                srcset="">&nbsp;8140037000
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:33%;"></td>
                                    <td style="width:35%; line-height:25px;">
                                        <center>
                                            <img src="<?php echo base_url();?>assets/logo/logo.jpg"
                                                style="height:150px;">
                                        </center>
                                        <center>
                                            <p><img src="<?php echo base_url();?>assets/logo/home.png" width="11" alt=""
                                                    srcset="">&nbsp;B-9, APMC
                                                Market, Navsari
                                            </p>
                                        </center>
                                    </td>
                                    <td style="width:33%;"></td>
                                </tr>
                            </table>


                        </div>
                        <div class="row">
                            <table style="width:100%;  margin:15px; padding:5px;">
                                <tr>
                                    <td style="width:50%;">
                                        <b>Group Name. :</b> <?php echo $table_data->coll_id; ?>
                                    </td>
                                    <td style="width:40%;">
                                        <label for=" account_number"><b>Collection Date
                                                :</b><?php echo  $table_data->collection_date; ?></label>
                                    </td>
                                </tr>
                              
                                <tr>
                                    <td>
                                        <b>VC Name :</b><?php echo $table_data->name;?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:60%;">
                                            <b>loan No. :</b> <?php echo $loan_master['id'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div> -->
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:100%; ">
                                            <b>Name. :</b> <?php echo $table_data->member_name;  ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:100%; ">
                                            <b>Address. :</b> <?php echo $table_data->address;  ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:60%; ">
                                            <b>Mo. No :</b> <?php echo $table_data->mobile_number; ?>
                                        </td>
                                       
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:60%; ">
                                        <b>Amount : </b> <?php echo $table_data->amount; ?>
                                        </td>
                                        <td style="width:40%; ">
                                            <b>Bank Name :</b> <?php echo $table_data->bank_name; ?><br><br>
                                            <b>Cheque No : </b><?php echo $table_data->cheque_no; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:100%; ">
                                            <?php
                                                
                                                   $number = $table_data->amount;;
                                                 
                                                // $number = $loan_master['final_amount'];
                                                $no = floor($number);
                                                $point = round($number - $no, 2) * 100;
                                                $hundred = null;
                                                $digits_1 = strlen($no);
                                                $i = 0;
                                                $str = array();
                                                $words = array('0' => '', '1' => 'one', '2' => 'two',
                                                '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                                                '7' => 'seven', '8' => 'eight', '9' => 'nine',
                                                '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                                                '13' => 'thirteen', '14' => 'fourteen',
                                                '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                                                '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
                                                '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                                                '60' => 'sixty', '70' => 'seventy',
                                                '80' => 'eighty', '90' => 'ninety');
                                                $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                                                while ($i < $digits_1) {
                                                    $divider=($i==2) ? 10 : 100;
                                                    $number=floor($no % $divider);
                                                    $no=floor($no / $divider);
                                                    $i +=($divider==10) ? 1 : 2;
                                                    if ($number) {
                                                        $plural=(($counter=count($str)) && $number> 9) ? 's' : null;
                                                        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                                        $str [] = ($number < 21) ? $words[$number] . " " . $digits[$counter] . $plural . " " . $hundred
                                                        : $words[floor($number / 10) * 10] . " " . $words[$number % 10] . " " . $digits[$counter] .
                                                        $plural . " " . $hundred;
                                                    } else $str[]=null;
                                                }
                                                    $str=array_reverse($str);
                                                    $result=implode('', $str);
                                                    // echo ucwords($result) . "Rupees  ";
                                                ?>
                                            <b>(Rs. In Word) :</b> <?php echo ucwords($result) . "Rupees  "; ?>
                                        </td>

                                    </tr>
                                </table>
                            </div>
                          
                        
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <!-- <button name="submit" type="submit" class="btn btn-primary">Submit</button> -->
                       
                        <input type="button" class="btn btn-warning" onClick="goBack()" value="Back">
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </center>
</section>
<!-- /.content -->


<script type="text/javascript">
    function goBack() {
        // alert('sdv');
        window.history.go(-1);
    }
$(document).ready(function() {

    $("#li-coll").addClass('active');

});
</script>