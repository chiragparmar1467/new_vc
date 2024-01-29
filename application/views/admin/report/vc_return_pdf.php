<!DOCTYPE html>
<html>

<head>
    <title><?php echo 'Report PDF';?></title>
    <link rel="icon" href="<?= base_url('assets/uploads/logo/favicon.png') ?>" type="image/gif" sizes="16x16">
    <style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size: 10px;
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
        background-color: #7e71ff;
        color: white;
    }

    /* TABLE FOR RETURN  */
    #vc_return {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size: 10px;
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
        background-color: #719cff;
        color: white;
    }
    /* TABLE FOR RETURN  */

    /* TABLE FOR -/+  */
    #diff_table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size: 10px;
        width: 100%;
    }

    #diff_table td,
    #diff_table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #diff_table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #diff_table tr:hover {
        background-color: #ddd;
    }

    #diff_table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #74cdff;
        color: white;
    }
    /* TABLE FOR -/+   */

    </style>
</head>

<body>
    <p style="text-align:center"><b>KUSH ENTERPRISE</b></p>
    <?= $result_on ?>
    <br>
    <?php 
    //  print_r('<pre>');   
        // print_r($table_data); 
        // print_r($vc_return_data); 
        // exit(); 
    ?>
    <?php
    if(!empty($groups)){
    $total=0; foreach ($groups as $k => $v) : 
    $members = $this->db->query('SELECT DISTINCT acc.account_no,mem.member_name,grp.name,grp.id FROM member_master as mem 
    JOIN account_master as acc ON acc.fk_member_id = mem.id
    JOIN group_member_mapping_master as map ON map.fk_account_id = acc.account_no
    JOIN group_master as grp ON grp.id = map.fk_group_id
    JOIN vc_master as vc ON vc.group_id = grp.id
 	WHERE grp.id = '.$v['id'])->result_array();
    
    ?>
    <p style="text-align:center"><b><?php echo $v['name']; ?></b></p>
    
    <!-- Table For Loan(VC) Details  -->
    <table id="customers">
    <tr>
        <th>Sr. No.</th>
        <th>Loan Name</th>
        <th>Month</th>
        <th>Loan Opening Date</th>
        <th>Loan Closing Date</th>
        <th>Minimum Amount</th>
        <th>Maximum Amount</th>
        <th>Instalment</th>
        <th>Last Date</th>
    </tr>
    <?php $a = 1; foreach($vc as $vc_data): 
        if($vc_data['group_id'] == $v['id']){
        ?>
    <tr>
        <td><?= $a; ?></td>
        <td><?= $vc_data['name']; ?></td>
        <td><?= $vc_data['month_name']; ?></td>
        <td><?= date('d-m-Y',strtotime($vc_data['vc_opening_date'])); ?></td>
        <td><?= date('d-m-Y',strtotime($vc_data['vc_closing_date'])); ?></td>
        <td><?= $vc_data['minimum_amount']; ?></td>
        <td><?= $vc_data['maximum_amount']; ?></td>
        <td><?= $vc_data['instalment']; ?></td>
        <td><?= date('d-m-Y',strtotime($vc_data['vc_draw_date'])); ?></td>
    </tr>
    <?php $a++; } endforeach; ?>
    </table>


 <!-- Table For Loan(VC) Details Close -->

 <!-- Table For Return Details Details  -->
    <br>
    <table id="vc_return">
        <tr>
            <th>Sr. No.</th>
            <th>Payment Date</th>
            <th>Member Name </th>
            <th>Account No </th>
            <th>Payment Status </th>
            <th>Payment Month</th>
            <!-- <th>Collection</th> -->
            <th>Paid Amount</th>
        </tr>
        <?php  $final_coll = 0; $total_collection = 0;  $i = 1;
        foreach ($vc_return_data as $vc_r) : 
            if($v['name'] == $vc_r['name']){
        ?>

        <tr>
            <td><?php echo $i; ?> </td>
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
           
            <!-- <td class="text-center">
            <?php  $total_coll = 0; foreach($collection_data as $coll_data) : 
            
             if($coll_data['group_id'] == $v['id'] && $coll_data['fk_vc_id'] == $vc_r['fk_vc_id']){ 
                 $total_coll = $coll_data['amount'] + $total_coll;
                
          ?>
           <?php   }  
            endforeach;     $final_coll = $final_coll + $total_coll;   echo $total_coll; ?>
            </td> -->
            <td class="text-center">
                <?php $total_collection = $total_collection + $vc_r['amount']; 
                echo $vc_r['amount']; ?>
            </td>



        </tr>
        <?php $i++; ?>
      <?php } endforeach; ?>
        <tr>
            <td colspan="6">Total</td>
            <!-- <td><?php echo  '₹'.$final_coll;
            
             ?></td> -->
            <td><?php echo  '₹'.$total_collection;
            $total = $total + $total_collection; 
             ?></td>
        </tr>

    </table>
    <br>
 <!-- Table For Return Details Details Close-->

            <?php if(!empty($vc_return_data) && empty($memb_filter) && empty($ac_filter) && empty($date_filter) && empty($vc_filter)){ ?>
 <!-- Table For Difference Details  -->
    <table id="diff_table">
    <tr>
        <th>Sr. No.</th>
        <th>Account No</th>
        <th>Member Name</th>
        <th>Collection</th>
        <th>Return</th>
        <th>-/+</th>
    </tr>
  <?php $j = 1; foreach($members as $mem) :    ?>
    <tr>
      <td>
        <?= $j; ?>
      </td>
      <td>
        <?= $mem['account_no']; ?>
      </td>
      <td>
        <?= $mem['member_name']; ?>
      </td>
      <td>
      <?php  $total_coll = 0; foreach($collection_data as $coll_data) : 
        
      if($coll_data['group_id'] == $v['id'] && $coll_data['fk_acc_id'] == $mem['account_no']){ 
        $total_coll = $coll_data['amount'] + $total_coll;
        ?>
      <?php   }  
        endforeach;       echo $total_coll; ?>
      </td>
      <td>
      <?php  $return_total_coll = 0; foreach($vc_return_data as $return_data) : 
        
        if($return_data['group_id'] == $v['id'] && $return_data['fk_acc_id'] == $mem['account_no']){ 
          $return_total_coll = $return_data['amount'] + $return_total_coll;
        //   echo "( Date : ".date('d-m-Y',strtotime($return_data['collection_date']))." )" ;
          ?>
        <?php   }  
          endforeach;       echo $return_total_coll; ?>
      </td>
      <td>
        <?php echo $total_coll - $return_total_coll ; ?>
      </td>
    </tr>
  <?php 
   $j++; 
   endforeach; ?>
   </table>
 <!-- Table For Difference Details Close -->
   <?php } ?>

    <?php endforeach; } else{  ?>
    <?php } ?>
    <br>
   
</body>
</html>