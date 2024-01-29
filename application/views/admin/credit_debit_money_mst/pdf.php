<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Collection Receipt</title>
    <link href="<?php base_url();?>public/pdf/bootstrap.min.css" rel="stylesheet">
    <link href="<?php base_url();?>public/pdf/pdf.css" rel="stylesheet">
</head>

<body>
    <div class="container">

        <div class="row" style="border:1px">
            <table style="width:100%;">
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
                        <b>Account No. :</b> <?php echo $table_data['account_no'] ?>
                    </td>
                    <td style="width:40%; border: 1px solid black;  padding: 15px;">
                        <label for=" account_number"><b>Date :</b><?php echo  date('d-m-Y') ?></label>
                    </td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="width:60%; border: 1px solid black;  padding: 15px;">
                    <b>Group Name :</b> <?php echo $table_data['group_name'] ?>
                    </td>
                    <td style="width:40%; border: 1px solid black;  padding: 15px;">
                    <b>Loan Month :</b> <?php echo $table_data['month_shortname'] ?><br>
                    <b>Loan Name :</b> <?php echo $table_data['name'] ?>
                    </td>
                </tr>

                <tr style="width:100%; border: 1px solid black; ">
                    <td style="width:100%; border: 1px solid black;  padding: 15px;" colspan="2">
                        <b>Name. :</b> <?php echo $table_data['member_name'] ?>
                    </td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="width:60%; border: 1px solid black;  padding: 15px;">
                    <b>Address :</b> <?php echo $table_data['address'] ?>
                    </td>
                    <td style="width:40%; border: 1px solid black;  padding: 15px;">
                    <b>Mo. No. :</b> <?php echo $table_data['mobile_number'] ?><br>
                    
                    </td>
                </tr>

                <!-- <tr>
                    <td style="width:100%; border: 1px solid black;  padding: 15px;" colspan="2">
                        <b>Address. :</b> <?php echo $table_data['address'] ?>
                    </td>
                </tr>

                <tr>
                    <td style="width:100%; border: 1px solid black;  padding: 15px;" colspan="2">
                         <b>Mo. No :</b>  <?php echo $table_data['mobile_number'] ?>
                    </td>
                </tr> -->

                <tr>
                    <td style="width:60%; border: 1px solid black;  padding: 15px;">
                        <p><img src="<?php base_url();?>assets/logo/rupee.png" width="30px" alt="" srcset="">
                        <?php echo $table_data['amount']; ?>
                        </p>
                    </td>
                    <?php if($table_data['payment_mode'] == 'Cheque'){ ?>
                    <td style="width:40%;padding:5px; border: 1px solid black;  padding: 15px;">
                        <b>Bank Name :</b>
                       <?php echo $table_data['bank_name'] ?><br>
                        <b>Cheque No :</b><br>
                        <p><?php echo $table_data['cheque_no'] ?></p>
                    </td>
                    <?php } else { ?>
                        <td style="width:40%;padding:5px; border: 1px solid black;  padding: 15px;">
                        <b>Payment Mode :</b>
                       <?php echo $table_data['payment_mode'] ?>
                    <?php } ?>
                </tr>

                <tr>
                    <td style="width:100%; border: 1px solid black;  padding: 15px;" colspan="2">
                        <?php
                           $number = $table_data['amount'];
                        
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

                <!-- <tr>

                    <td style="width:60%; border: 1px solid black;  padding: 15px;">
                        <b>Duration : </b><?php echo $loan_master['month'] ?> Month<br>
                    </td>
                    <td style="width:40%; border: 1px solid black;  padding: 15px;">
                        <b>ROI : </b><?php echo $loan_master['interest_amount'] ?><span>&#37;</span> <br>
                    </td>
                </tr> -->

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