<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan<?php 
                                $cid=$certi_data['fk_party_id']; $query=$this->db->query("select * from party_master where id='$cid'");
                                foreach($query->result_array() as $crow){ ?>
        <?=$crow['name'];?>
        <?php } ?>
        (<?php echo $certi_data['certificate_no'];?>)
    </title>
    <link href="<?php base_url();?>public/pdf/bootstrap.min.css" rel="stylesheet">
    <link href="<?php base_url();?>public/pdf/pdf.css" rel="stylesheet">
</head>

<body>
    <div class="container" style="margin:15px 15px;">

        <div class="row" style="border:1px">
            <table style="width:100%;padding:5px;">
                <tr>
                    <th style=" text-align:left; font-size: 12px;">
                        <p><b>LIC. NO. - NVS/GML/237</b></p>
                    </th>
                    <th>
                        <center>
                            <p style="color:#f3740d;"><b>|| JAI MATA DI ||</b></p>
                        </center>
                        </td>
                    <th style="text-align:right; font-size: 12px;">
                        <p><b>RAJEN HIRANI</b></p>
                        <p><img src="<?php echo base_url();?>assets/logo/phone.png" width="10" alt=""
                                srcset="">&nbsp;8490037000
                        </p>
                        <p><img src="<?php echo base_url();?>assets/logo/phone.png" width="10" alt=""
                                srcset="">&nbsp;8140037000
                        </p>
                    </th>
                </tr>
                <tr>
                    <th style="width:33%;">
                    </th>
                    <th style="width:35%; line-height:20px;">
                        <center>
                            <img src="<?php echo base_url();?>assets/logo/logo.jpg" style="height:150px;">
                        </center>
                        <center>
                            <p colspan="2"><img src="<?php echo base_url();?>assets/logo/home.png" width="11" alt=""
                                    srcset="">&nbsp;B-9,
                                APMC
                                Market, Navsari
                            </p>
                        </center>
                    </th>
                    <th style="width:33%;">
                    </th>
                </tr>
            </table>
        </div>

        <div class="row">
            <table style="width:100%; margin:15px;  border: 1px solid black;">
                <tr style="border: 1px solid black;">
                    <td style="width:60%; border: 1px solid black;  padding: 15px;">
                        <b>Account No. :</b> <?php echo $loan_master['account_no'] ?>
                    </td>
                    <td style="width:40%; border: 1px solid black;  padding: 15px;">
                        <label for=" account_number"><b>Date :</b><?php echo  date('d-m-Y') ?></label>
                    </td>
                </tr>
                <!-- </table>
        </div>
        <div class="row">
            <table style="width:100%; padding:5px;"> -->
                <tr style="width:100%; border: 1px solid black; ">
                    <td style="width:100%; border: 1px solid black;  padding: 15px;" colspan="2">
                        <b>Name. :</b> <?php echo $loan_party_master['account_name'] ?>
                    </td>
                </tr>
                <!-- </table>
        </div>
        <div class="row">
            <table style="width:100%; padding:5px;"> -->
                <tr>
                    <td style="width:100%; border: 1px solid black;  padding: 15px;" colspan="2">
                        <b>Address. :</b> <?php echo $loan_party_master['address'] ?>
                    </td>
                </tr>
                <!-- </table>
        </div>
        <div class="row">
            <table style="width:100%; padding:5px;"> -->
                <tr>
                    <td style="width:60%; border: 1px solid black;  padding: 15px;">
                        <b>Mo. No :</b> <?php echo $loan_party_master['mobile_number'] ?>
                    </td>
                    <td style="width:40%; border: 1px solid black;  padding: 15px;">
                        <b>ID Proof :</b> <?php echo $document['document'] ?>
                    </td>
                </tr>
                <!-- </table>
        </div>
        <div class="row">
            <table style="width:100%; padding:5px;"> -->
                <tr>
                    <td style="width:60%; border: 1px solid black;  padding: 15px;">
                        <p><img src="<?php base_url();?>assets/logo/rupee.png" width="30px" alt="" srcset=""><?php if($loan_master['fk_loan_category_id'] == 2)  { echo $loan_master['final_amount']; } 
                                else{
                                    echo $loan_master['loan_amount'];
                                }    ?>
                        </p>
                    </td>
                    <td style="width:40%;padding:5px; border: 1px solid black;  padding: 15px;">
                        <b>Bank Name :</b><br>
                        <p><?php echo $loan_master['bank_name'] ?></p><br>
                        <b>Cheque No :</b><br>
                        <p><?php echo $loan_master['cheque_no'] ?></p>
                    </td>
                </tr>
                <!-- </table>
        </div>
        <div class="row">
            <table style="width:100%; padding:5px;"> -->
                <tr>
                    <td style="width:100%; border: 1px solid black;  padding: 15px;" colspan="2">
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
                        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore'
                    );
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
                <!-- </table>
        </div>
        <div class="row">
            <table style="width:100%; padding:5px;"> -->
                <tr>

                    <td style="width:60%; border: 1px solid black;  padding: 15px;">
                        <b>Duration : </b><?php echo $loan_master['month'] ?> Month<br>
                    </td>
                    <td style="width:40%; border: 1px solid black;  padding: 15px;">
                        <b>ROI : </b><?php echo $loan_master['interest_amount'] ?><span>&#37;</span> <br>
                    </td>
                </tr>
                <!-- </table> -->
                <!-- </div>
        <div class="row">-->
                <!-- <table style="width:100%; padding:5px;"> -->
                <tr>
                    <td style="width:50%; padding: 15px;">
                        <b><u>Customer Sign</u></b>
                        <div style="width: 200px;"></div>
                    </td>
                    <td style="width:50%; padding: 15px;">
                        <p><b><u>For KUSH ENTERPRISE.</u></b></p>
                    </td>
                </tr>
                <tr>
                    <td style="width:50%; padding: 15px;"></td>
                    <td style=" width:50%; text-align:center;  padding-bottom: 15px;"><img
                            src="<?php echo base_url();?>assets/sign/sign1.png" width="120px" alt="" srcset=""></td>
                </tr>
            </table>
        </div>
</body>

</html>