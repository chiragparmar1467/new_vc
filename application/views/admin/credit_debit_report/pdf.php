<!DOCTYPE html>
<html>

<head>
    <title><?php echo 'Credit Debit Report';?></title>
    <link rel="icon" href="<?= base_url('assets/uploads/logo/favicon.png') ?>" type="image/gif" sizes="16x16">
    <style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size: 12px;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }

    #vc_return {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size: 12px;
        width: 100%;
    }

    #vc_return td,
    #vc_return th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #vc_return tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #vc_return tr:hover {
        background-color: #ddd;
    }

    #vc_return th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: blue;
        color: white;
    }

    table.details {
        width: 100%;
        border-collapse: collapse;
    }

    td.details {
        width: 33%;
        font-size: 14px;
        padding-top: 8px;
        padding-bottom: 8px;
    }

    table.details,
    td.details {
        font-size: 14px;
        border: 1px solid black;
    }
    </style>
</head>

<body>
    <p style="text-align:center"><b>KUSH ENTERPRISE</b></p>
    <?= $result_on ?>
    <?php if(!empty($ac_filter) && empty($memb_filter) && !empty($data)){ ?>
    <?=  "Member Name = ".$data[0]['member_name'] ?>
    <?php } ?>
    <br>
    <?php 
//   print_r('<pre>');   
//   print_r($collection_data); 
//   exit(); 
    ?>

  
    <br>
    <table id="customers">
        <tr>
            <th>Sr. No.</th>
            <th>Collection Date</th>
            <?php if(empty($memb_filter) && empty($ac_filter)){ ?>
            <th>Member Name </th>
            <?php } ?>
            <?php if(empty($ac_filter)){ ?>
            <th>Member Account No </th>
            <?php } ?>
            <th>Group Name</th>
            <?php if(empty($vc_filter)){ ?>
            <th>VC</th>
            <?php } ?>
            <th>Credit Amount</td>
            <th>Debit Amount</td>
        </tr>
        <?php $total_credit = 0; $tota_debit = 0; $i = 1;
        foreach($collection_data as $data){
        ?>

        <tr>
            <td><?php echo $i; ?> </td>
            <td class="text-center">
                <?php                            
                       $date=date('d-m-Y',strtotime($data['collection_date']));
                       echo $date;        
                ?>
            </td>
            <?php if(empty($memb_filter) && empty($ac_filter) ){ ?>
            <td class="text-center"><?php echo $data['member_name']; ?></td>
            <?php } ?>
            <?php if(empty($ac_filter)){ ?>
            <td class="text-center"><?php echo $data['fk_acc_id']; ?></td>
            <?php } ?>
            <td class="text-center"><?php echo $data['name']; ?></td>
            <?php if(empty($vc_filter)){ ?>
            <td class="text-center"><?php echo $data['vc_name']; ?></td>
            <?php } ?>
            <td class="text-center"><?php echo $data['collected_amount']; 
             $total_credit = $total_credit + $data['collected_amount']; ?></td>
            <td class="text-center"><?php echo $data['payed_amount']; 
              $tota_debit = $tota_debit + $data['payed_amount'];?></td>

        </tr>
        <?php $i++; ?>
        <?php } ?>

        <?php 
        if(!empty($credit_debit_mst_data)){ 
        // $total_credit = 0; $tota_debit = 0; $i = 1; ?>
        <tr>
            <td colspan="5">This Are Other Credit Debit Transaction</td>
        </tr>
       <?php foreach($credit_debit_mst_data as $data){
        ?>
        <tr>
            <td><?php echo $i; ?> </td>
            <td class="text-center">
                <?php                            
                       $date=date('d-m-Y',strtotime($data['collection_date']));
                       echo $date;        
                ?>
            </td>
            <?php if(empty($memb_filter) && empty($ac_filter) ){ ?>
            <td class="text-center"><?php echo $data['member_name']; ?></td>
            <?php } ?>
            <?php if(empty($ac_filter)){ ?>
            <td class="text-center"><?php echo $data['account_no']; ?></td>
            <?php } ?>
            <?php if(empty($vc_filter)){ ?>
            <td class="text-center">-----</td>
            <?php } ?>
            <td class="text-center">-----</td>
            <!-- <td class="text-center" style="width:160px"><?php echo $data['payment_mode']; 
            if($r['payment_mode'] == 'Cheque' || $r['payment_mode'] == 'RTGS'){
                echo "<br> ( Bank Name = ". $data['bank_name'] .") ";
                echo "<br> ( Cheque Number = ". $data['cheque_no'] .") ";
            } 
            ?>
            </td> -->
            <td class="text-center"><?php echo $data['credit_amount']; 
             $total_credit = $total_credit + $data['credit_amount']; ?></td>
            <td class="text-center"><?php echo $data['debit_amount']; 
              $tota_debit = $tota_debit + $data['debit_amount'];?></td>

        </tr>
        <?php $i++; ?>
        <?php } } ?>


        <tr>
            <?php $colspan = 0 ;
            if(!empty($vc_filter)){ $colspan++ ; } 
            if(!empty($memb_filter)){ $colspan++; } 
            if(!empty($ac_filter)){ if(empty($memb_filter)){ $colspan++; } $colspan++ ; } 
            ?>
            <td colspan="<?php if($colspan == 3){echo '3';}else if($colspan == 2){echo "4";}else if($colspan == 1){echo "5";}else{echo "6";} ?>">
                Total</td>
            <td><?php 
            echo  '₹'.$total_credit;
             ?></td>
            <td><?php echo  '₹'.$tota_debit;
             ?></td>
        </tr>
        <tr>
            <td colspan="<?php if($colspan == 3){echo '3';}else if($colspan == 2){echo "4";}else if($colspan == 1){echo "5";}else{echo "6";} ?>">-/+</td>
            <td colspan="2" style="text-align:center;"><?php 
            $net_baki = $total_credit - $tota_debit; 
            echo  '₹'.$net_baki ;
             ?></td>

        </tr>

    </table>
    <br>

    <br>
</body>

</html>