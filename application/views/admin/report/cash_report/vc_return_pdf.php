<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cash Report</title>
    <link rel="stylesheet" href="<?php echo base_url('public/pdf/bootstrap.min.css'); ?>">
    <!-- <style>
        p {
            margin-bottom: 0;
            font-family: "Courier New", monospace;
        }

        .styled-table {
            border-collapse: separate;
            width: 100%;
            /* margin-bottom: 5px; */
        }

        .styled-table thead tr {
            background-color: #0275D8;
            color: #FFFFFF;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 5px;
            font-size: 12px;
        }

        .right {
            text-align: right;

        }
    </style> -->
    <style>
        p {
            margin-bottom: 0;
            font-family: "Courier New", monospace;
        }

        .styled-table {
            border-collapse: collapse;
            width: 100%;
        }

        .styled-table th,
        .styled-table td {
            /* border: 1px solid #000; */
            /* Add border to each cell */
            padding: 5px;
            font-size: 12px;
        }

        .styled-table thead tr {
            background-color: #0275D8;
            color: #FFFFFF;
            text-align: left;
        }

        .right {
            text-align: right;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="card border-0">
            <div style="text-align:center;">
                <h2 style="font-family: Courier New, monospace;"><b>KUSH ENTERPRISE</b></h2>
                <p style="text-align: center;">
                    SHOP NO.11, A.P.M.C. MARKET, VIRAVAL ROAD,
                </p>
                <p>VIRAVAL ROAD,</p>
                <p style="text-align: center;">
                    <?php $year = $this->db->query('SELECT * FROM `financial_year_master` where id = ' . $_SESSION['year'])->row_array();
                    echo $year['title'];
                    ?>
                </p>
            </div>
            <table class="styled-table">
                <?php if (!empty($from) || !empty($to)) {
                    if ($from != 'dd-mm-yyyy') {
                ?>
                        <tr>
                            <td style="font-size: 1em;">From : <?php echo $from; ?></td>
                            <?php if ($to != 'dd-mm-yyyy') { ?>
                                <td style="font-size: 1em;">To : <?php echo $to; ?></td>
                            <?php } ?>
                        </tr>
                <?php }
                } ?>
                <?php if (!empty($member)) { ?>
                    <tr>
                        <td style="font-size: 1em;"><?php echo $member; ?></td>
                        <td class="right" style="font-size: 1em;"><?php echo $table_data['account_no']; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <div style="border-bottom: 4px double #333"></div>

            <table class="table text-center styled-table" style="margin-top:10px;text-align: center;">
                <tr>
                    <!-- <td width="15%">Sr.No</td> -->
                    <td width="15%">DATE</td>
                    <td width="15%">Voucher No</td>
                    <td width="40%">NAME & NARRATION</td>
                    <td width="15%">CREDIT DEBIT</td>
                    <td width="15%">DEBIT DEBIT</td>
                </tr>
                <tr>
                    <td colspan="7" style="border-bottom: 2px solid black;"></td>
                </tr>
                <?php if ($opening_balance == true) { ?>
                    <tr>
                        <td><?php echo $created_at_date; ?></td>
                        <td>Open Bal.</td>
                        <td></td>
                        <td></td>
                        <td><?php echo $opening_balance; ?></td>
                    </tr>
                <?php }
                $i = 1; ?>
                <?php if (!empty($table_data) || !empty($opening_balance)) { ?>
                    <?php foreach ($table_data as $k => $v) :   ?>
                        <tr class="border-0">
                            <!-- <td> <?php echo $i; ?></td> -->
                            <td><?php echo $v['cash_date']; ?></td>
                            <td><?php echo $v['voucher_no']; ?></td>

                            <?php if ($v['transaction'] == 0) { ?>
                                <td>SALE</td>
                            <?php } else { ?>
                                <td>CASH</td>
                            <?php } ?>
                            <td><?php echo $v['credit']; ?></td>
                            <td><?php echo $v['debit']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>

                <?php } else { ?>
                    <tr>
                        <td colspan="5"><?php echo "No Data Found"; ?>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" style="border-bottom: 2px solid black; "></td>
                </tr>
                <tr class="">
                    <td colspan="3" style="text-align:left; font-size:medium"><b>Total</b></td>
                    <?php
                    foreach ($table_data as $row) {
                        $credit += $row['credit'];
                    }
                    if (!empty($credit)) {
                    ?>

                        <td><b><?php echo $credit; ?></b></td>
                    <?php } else { ?>
                        <td><b>0</b></td>
                    <?php } ?>
                    <?php
                    foreach ($table_data as $row) {
                        $debit += $row['debit'];
                    }
                    $debitopnbal =  $debit + $opening_balance;
                    if (!empty($debitopnbal)) {
                    ?>
                        <td><b><?php echo $debitopnbal; ?></b></td>
                    <?php } else { ?>
                        <td><b>0</b></td>
                    <?php } ?>
                </tr>
            </table>
            <table class="table text-center styled-table w-100">
                <tr>
                    <th style="text-align: left; width:70%">Net Baki... </b></th>
                    <th style="text-align: center; width:15%"><?php echo $total = $debitopnbal - $credit; ?>
                        </b></th>
                    <th style="text-align: left; width:15%"></th>
                </tr>


            </table>
            <table class="table text-center styled-table w-100">
                <tr>
                    <td colspan="5" style="border-bottom: 4px double #333"></td>
                    <!-- <td></td> -->
                </tr>
                <tr>
                    <td><b>Net Receivable : <?php echo $total; ?></b></td>
                    <td><b>
                        </b></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>