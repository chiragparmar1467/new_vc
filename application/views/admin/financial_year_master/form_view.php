<link href="<?php base_url();?>public/pdf/bootstrap.min.css" rel="stylesheet">
<link href="<?php base_url();?>public/pdf/pdf.css" rel="stylesheet">
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
        <center>
            <div class="row" style="width:70%;">

                <div class="col-md-12 col-xs-12">
                    <!-- <?php if ($this->session->flashdata('errors')) { ?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                              aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>
                  </div>
                  <?php } ?> -->
                    <div class="card card-primary" style="margin: 20px; ">
                        <div class="card-header">
                            <h3 class="card-title">View <?php echo $this->data['name']; ?></h3>
                        </div>
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
                                            <p><img src="<?php echo base_url();?>assets/logo/phone.png" width="10"
                                                    alt="" srcset="">&nbsp;8140037000
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
                                                <p><img src="<?php echo base_url();?>assets/logo/home.png" width="11"
                                                        alt="" srcset="">&nbsp;B-9, APMC
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
                                        <td style="width:60%;">
                                            <b>Account No. :</b> <?php echo $slider_data['title'] ?>
                                        </td>
                                        <td style="width:40%;">
                                            <label for=" account_number"><b>Date
                                                    :</b><?php echo  date('d-m-Y') ?></label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:60%;">
                                            <b>Account No. :</b> <?php echo $slider_data['start_date'] ?>
                                        </td>
                                        <td style="width:60%;">
                                            <b>Account No. :</b> <?php echo $slider_data['end_date'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:60%;">
                                            <b>loan No. :</b> <?php echo $slider_data['st'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:60%; ">
                                            <p><img src="<?php echo base_url();?>assets/logo/rupee.png" width="20px"
                                                    alt="" srcset=""><?php if($loan_master['fk_loan_category_id'] == 1)  { echo $loan_master['loan_amount']; } 
                                else{
                                    echo $loan_master['final_amount'];
                                }    ?>
                                            </p>
                                        </td>
                                        <td style="width:40%; ">
                                            <b>Bank Name :</b> <?php echo $loan_master['bank_name'] ?><br>
                                            <b>Cheque No : </b><?php echo $loan_master['cheque_no'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:100%; ">
                                            <?php
                                                 if($loan_master['fk_loan_category_id'] == 2){
                                                    $number = $loan_master['final_amount']; 
                                                   } 
                                               else{
                                                   $number = $loan_master['loan_amount'];
                                               }  
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
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>

                                        <td style="width:60%; ">
                                            <b>Duration : </b><?php echo $loan_master['month'] ?> Month<br>
                                        </td>
                                        <td style="width:40%; ">
                                            <b>ROI :
                                            </b><?php echo $loan_master['interest_amount'] ?><span>&#37;</span><br>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <table style="width:100%;  margin:15px; padding:5px;">
                                    <tr>
                                        <td style="width:50%;">
                                            <b><u>Customer Sign</u></b>
                                            <div style="width: 200px;"></div>
                                        </td>
                                        <td style="width:50%; text-align:right;">
                                            <p><b><u>For KUSH ENTERPRISE.</u></b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td style="width:50%; text-align:right;"><img
                                                src="<?php echo base_url();?>assets/sign/sign1.png" width="120px" alt=""
                                                srcset=""></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo base_url().$this->controllerPath ?>view_loan/<?php echo $loan_party_master['id'];?>"
                                class="btn btn-warning">Back</a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
        </center>
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