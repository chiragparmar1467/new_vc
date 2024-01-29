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
    <?php
    if(!empty($table_data)){
    $total=0; foreach ($table_data as $k => $v) :  
        if(empty($memb_filter) && empty($ac_filter)){
    $not_collected_member = $this->db->query('SELECT DISTINCT acc.account_no,mem.member_name,grp.name,grp.id FROM member_master as mem 
    JOIN account_master as acc ON acc.fk_member_id = mem.id
    JOIN group_member_mapping_master as map ON map.fk_account_id = acc.account_no
    JOIN group_master as grp ON grp.id = map.fk_group_id
    JOIN vc_master as vc ON vc.group_id = grp.id
    WHERE vc.id = '.$v['fk_vc_id'].'
    AND acc.account_no 
      NOT IN (SELECT col.fk_acc_id FROM collection_master
              AS col WHERE col.fk_vc_id = '.$v['fk_vc_id'].' );')->result_array();
        }        
    ?>
    <p style="text-align:center"><b><?php echo $v['month_name']." (".$v['name'].")"; ?></b></p>

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
            <th>Collection Date</th>
            <th>Member Name </th>
            <th>Account No </th>
            <th>Collection Status </th>
            <th>Payment Mode</th>
            <th>Collection</th>
        </tr>
        <?php $total_collection = 0;  $i = 1;

              foreach ($collection_data as $a => $r) :  
        if($r['fk_vc_id'] == $v['fk_vc_id']){   
           
        ?>

        <tr>
            <td><?php echo $i; ?> </td>
            <td class="text-center">
                <?php                            
                       $date=date('d-m-Y',strtotime($r['collection_date']));
                       echo $date;        
                ?>
            </td>
            <td class="text-center"><?php echo $r['member_name']; ?></td>
            <td class="text-center"><?php echo $r['fk_acc_id']; ?></td>
            <td class="text-center">
                <p style="color:green">Collected</p>
            </td>
            <td class="text-center" style="width:160px"><?php echo $r['payment_mode']; 
            if($r['payment_mode'] == 'Cheque' || $r['payment_mode'] == 'RTGS'){
                echo "<br> ( Bank Name = ". $r['bank_name'] .") ";
                echo "<br> ( Cheque Number = ". $r['cheque_no'] .") ";
            } 
            ?>
            </td>
            <td class="text-center">
                <?php $total_collection = $total_collection + $r['amount']; 
                echo $r['amount']; ?>
            </td>



        </tr>
        <?php $i++; ?>
        <?php } ?>
        <?php endforeach;
           foreach ($not_collected_member as $a => $mem) :  
            if($mem['id'] == $v['grp_id']){ 
        ?>
        <tr>
            <td><?php echo $i; ?> </td>
            <td class="text-center">
                <?php                            
                     
                       echo "--";        
                ?>
            </td>
            <td class="text-center"><?php echo $mem['member_name']; ?></td>
            <td class="text-center"><?php echo $mem['account_no']; ?></td>
            <td class="text-center">
                <p style="color:red">Not Collected</p>
            </td>
            <td class="text-center" style="width:160px">
                --
            </td>
            <td class="text-center">
                --
            </td>
        </tr>
        <?php $i++; ?>
        <?php } ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="6">Collection Of Loan</td>
            <td><?php echo  '₹'.$total_collection;
            $total = $total + $total_collection; 
             ?></td>
        </tr>

    </table>
    <?php  if(!empty($vc_return_data)){
        ?>
    <br>
    <table id="vc_return">
        <tr>
            <th>Sr. No.</th>
            <th>Payment Date</th>
            <th>Member Name </th>
            <th>Account No </th>
            <th>Payment Status </th>
            <th>Payment Month</th>
            <th>Payment Mode</th>
            <th>Paid Amount</th>
        </tr>
        <?php $j = 1; foreach($vc_return_data as $vc_r) : 
        if($v['vc_name'] == $vc_r['vc_name'] && $v['name'] == $vc_r['name']){ ?>
        <tr>
            <td><?php echo $j; ?> </td>
            <td class="text-center">
                <?php                            
                       $date=date('d-m-Y',strtotime($vc_r['collection_date']));
                       echo $date;        
                ?>
            </td>
            <td class="text-center"><?php echo $vc_r['member_name']; ?></td>
            <td class="text-center"><?php echo $vc_r['fk_acc_id']; ?></td>
            <td class="text-center">
                <p style="color:green">Paid</p>
            </td>
            <td class="text-center"><?php echo $vc_r['month_name']; ?></td>
            <td class="text-center" style="width:160px"><?php echo $vc_r['payment_mode']; 
            if($vc_r['payment_mode'] == 'Cheque' || $vc_r['payment_mode'] == 'RTGS'){
                echo "<br> ( Bank Name = ". $vc_r['bank_name'] .") ";
                echo "<br> ( Cheque Number = ". $vc_r['cheque_no'] .") ";
            } 
            ?>
            </td>
            <td class="text-center">
                <?php $total_collection = $total_collection + $vc_r['amount']; 
                echo $vc_r['amount']; ?>
            </td>
        </tr>
        <?php  $j++; } endforeach; ?>
    </table>
    <?php } ?>
    <?php endforeach; } else{  ?>
    <table id="customers">
        <tr>
            <th>Sr. No.</th>
            <th>Collection Date</th>
            <th>Member Name </th>
            <th>Account No </th>
            <th>Collection Status </th>
            <th>Payment Mode</th>
            <th>Collection</th>
        </tr>

        <tr>
            <td colspan="7">NO COLLECTION FOUND</td>
        </tr>

    </table>
    <?php } ?>
    <br>

    <br>
</body>

</html>