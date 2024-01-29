<!DOCTYPE html>
<html>

<head>
    <title><?php echo 'Report PDF';?></title>
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
    <br>
    <?php 
    //  print_r('<pre>');   
    //     print_r($table_data); 
    //     print_r($collection_data); 
    //     exit(); 
    ?>



    <?php $prevGroup = null; $prevVc = null;  $groupCollection = 0; $groupDeduction = 0;    
    foreach($table_data as $v){
    if ($prevGroup != $v['grp_id']) {
        echo '<p style="text-align:center"><b>'. $v['name'] .'</b></p>';
        $prevGroup = $v['grp_id'];
    }
    ?>

    <table class="details">
        <tr class="details">
            <td class="details">
                <b>Loan Name :
                </b><?php echo $v['vc_name']; ?>
            </td>
            <td class="details">
                <b>Loan Start Date : </b><?php echo date('d-m-Y',strtotime($v['vc_opening_date'])); ?>
            </td>
            <td class="details">
                <b>Loan End Date : </b><?php echo date('d-m-Y',strtotime($v['vc_closing_date'])); ?>
            </td>
            <td class="details">
                <b>Month :
                </b><?php echo $v['month_name']; ?></p>
            </td>
        </tr>
        <tr>
            <td class="details">
                <b>Minimum : </b><?php echo $v['minimum_amount']; ?>
            </td>
            <td class="details">
                <b> Maximum :
                </b><?php echo $v['maximum_amount']; ?>
            </td>
            <td class="details">
                <b>Instalment :
                </b><?php echo $v['instalment']; ?>
            </td>
        </tr>

    </table>
    <br>

    <table id="customers">
        <tr>
            <th>Sr. No.</th>
            <th>Transaction Date</th>
            <th>Member Name </th>
            <th>Account No </th>
            <?php if($isAccountSelected != 1){ ?>
            <th>Opening Balance</th>
            <?php } ?>
            <th>Collection</th>
            <th>Deduction</th>
        </tr>
        <?php $total_collection = 0; $total_deduction = 0; $total_opening_balance = 0; $i = 1;
        
        foreach ($report_data as $a => $r) :  
        if($r['vc_id'] == $v['vm_id'] && $r['fk_group_id'] == $v['grp_id']){   
        ?>

        <tr>
            <td><?php echo $i; ?> </td>
            <td class="text-center">
                <?php  
                if($r['transaction_date'] != '' || $r['transaction_date'] != null){                          
                       $date=date('d-m-Y',strtotime($r['transaction_date']));
                       echo $date; 
                }else{
                    echo "----";    
                }       
                ?>
            </td>
            <td class="text-center"><?php echo $r['member_name']; ?></td>
            <td class="text-center"><?php echo $r['account_no']; ?></td>
            <?php if($isAccountSelected != 1){ ?>
            <td class="text-center"><?php $total_opening_balance = $total_opening_balance + $r['opening_balance']; 
            echo $r['opening_balance']; ?></td>
            <?php } else { $total_opening_balance = $r['opening_balance']; }  ?>
            <td class="text-center">
                <?php $total_collection = $total_collection + $r['amount']; 
                echo $r['amount']; ?>
            </td>
            <td class="text-center">
                <?php $total_deduction = $total_deduction + $r['debit_amount']; 
                echo $r['debit_amount']; ?>
            </td>
        </tr>
        <?php $i++; ?>
        <?php } ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="<?php if($isAccountSelected != 1){ echo "5"; } else { echo "4"; } ?>">Total Transaction</td>
            <!-- <?php if($isAccountSelected != 1){ ?>
                <td><?php echo  '₹'.$total_opening_balance;  ?></td>
            <?php } ?> -->
            <td><?php $groupCollection = $groupCollection + $total_collection; echo  '₹'.$total_collection;  ?></td>
            <td>
                <?php $groupDeduction = $groupDeduction + $total_deduction; echo  '₹'.$total_deduction; ?></td>
        </tr>
        <tr>
            <td colspan="<?php if($isAccountSelected != 1){ echo "5"; } else { echo "4"; } ?>">-/+</td>
            <td colspan="2" style="text-align:center;">
                <?php  $diffrence = $total_collection - $total_deduction; echo  '₹'.$diffrence; ?></td>
        </tr>

    </table>
    <br>
    <div style="border-top: 1px dashed #000; margin: 5px 0;"></div>
    <br>
    <?php } ?>
    
    <?php if($isAccountSelected == 1){ ?>
        <div style="text-align:right;">
    <?php   echo  'Opening Balance : ₹'.$total_opening_balance .'<br>';
            echo  'Total Collection : ₹'.$groupCollection .'<br>'; 
            echo  'Total Deduction : ₹'.$groupDeduction .'<br>';
            $sub_total = $groupCollection + $total_opening_balance - $groupDeduction;
            echo  '-/+ : ₹'.$sub_total .'</br>'; ?>
            </div>
        <?php } ?>
