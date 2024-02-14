<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <?php
        //   $financial_year = $this->session->userdata('year');
        $financial_year = $this->db->query("SELECT * FROM financial_year_master WHERE status = 1")->row();

        ?>

        <select class="js-example-basic-single w-100" id="fk_financial_year_id" name="fk_financial_year_id">
            <!-- <option value="">Select Fiancial Year</option> -->
            <?php $q = $this->db->get('financial_year_master');
            foreach ($q->result_array() as $k => $v) : ?>
                <option value="<?php echo $v['id'] ?>" <?php if ($financial_year->id == $v['id']) {
                                                            echo "selected";
                                                        } ?>>
                    <?php echo $v['title'] ?></option>
            <?php endforeach ?>
        </select>

        <hr style="color: white;">

        <script>
            $(document).ready(function() {

                $('#fk_financial_year_id').change(function() {
                    var financial_year_id = $('#fk_financial_year_id').val();

                    window.location.href =
                        "<?php echo base_url('Auth/change_financial_year/'); ?>" +
                        financial_year_id;
                });
            });
        </script>

        <li class="nav-item" id="li-dashboard">
            <a class="nav-link" href="<?php echo base_url('backend_admin/dashboard'); ?>" id="link-dashboard">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>


        <li class="nav-item" id="li-account">
            <a class="nav-link" href="<?php echo base_url('backend_admin/account_master/Account'); ?>" id="link-account">
                <i class="fa fa-book menu-icon"></i>
                <span class="menu-title">Accounts</span>
            </a>
        </li>
        <li class="nav-item" id="li-bank_master">
            <a class="nav-link" href="<?php echo base_url('backend_admin/bank_master/Bank_master'); ?>" id="link-bank">
                <i class="fa fa-book menu-icon"></i>
                <span class="menu-title">Bank Master</span>
            </a>
        </li>
        <li class="nav-item" id="li-item_master">
            <a class="nav-link" href="<?php echo base_url('backend_admin/item_master/Item_master'); ?>" id="link-item">
                <i class="fa fa-shopping-cart menu-icon"></i>
                <span class="menu-title">Item Master</span>
            </a>
        </li>

        <li class="nav-item has-treeview" id="li-Transaction">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" id="link-Transaction" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Transaction</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item" id="Cash_management">
                        <a href="<?php echo base_url('backend_admin/cash_management/Cash_management/'); ?>" class="nav-link" id="Cash_management">
                            <i class="fa fa-book menu-icon"></i>
                            <span class="menu-title">Cash</span>
                        </a>
                    </li>
                    <li class="nav-item" id="purchase_management">
                        <a href="<?php echo base_url('backend_admin/purchase_management/Purchase_management/'); ?>" class="nav-link" id="purchase_management">
                            <i class="fa fa-shopping-cart menu-icon" aria-hidden="true"></i>
                            <span class="menu-title">Purchase Payment</span>
                        </a>
                    </li>
                    <li class="nav-item" id="sell_management">
                        <a href="<?php echo base_url('backend_admin/sell_management/Sell_management/'); ?>" class="nav-link" id="sell_management">
                            <i class="fa fa-shopping-cart menu-icon" aria-hidden="true"></i>
                            <span class="menu-title">Sell</span>
                        </a>
                    </li>
                    <li class="nav-item" id="bank_management">
                        <a href="<?php echo base_url('backend_admin/bank_management/Bank_management/'); ?>" class="nav-link" id="bank_management">
                            <i class="fa fa-shopping-cart menu-icon" aria-hidden="true"></i>
                            <span class="menu-title">Bank</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item has-treeview" id="li-Reports">
            <a class="nav-link" data-toggle="collapse" href="#ui-basi" id="link-Reports" aria-expanded="false" aria-controls="ui-basi">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basi">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item" id="li-report-cash">
                        <a class="nav-link" href="<?php echo base_url('backend_admin/report_master/Cash_Report/'); ?>" id="link-report-cash">
                            <i class="fa fa-file menu-icon"></i>
                            <span class="menu-title">Cash Report</span>
                        </a>
                    </li>
                    <li class="nav-item" id="li-report-Purchase">
                        <a class="nav-link" href="<?php echo base_url('backend_admin/report_master/Purchase_Report/'); ?>" id="link-report-Purchase">
                            <i class="fa fa-file menu-icon"></i>
                            <span class="menu-title">Purchase Report</span>
                        </a>
                    </li>
                    <li class="nav-item" id="li-report-Sell">
                        <a class="nav-link" href="<?php echo base_url('backend_admin/report_master/Sell_Report/'); ?>" id="link-report-Sell">
                            <i class="fa fa-file menu-icon"></i>
                            <span class="menu-title">Sell Report</span>
                        </a>
                    </li>
                    <li class="nav-item" id="li-report-bank">
                        <a class="nav-link" href="<?php echo base_url('backend_admin/report_master/Bank_Report/'); ?>" id="link-report-bank">
                            <i class="fa fa-file menu-icon"></i>
                            <span class="menu-title">Bank Report</span>
                        </a>
                    </li>

                    <li class="nav-item" id="li-report-rojmer">
                        <a class="nav-link" href="<?php echo base_url('backend_admin/report_master/Rojgar_Report/'); ?>" id="link-report-rojmer">
                            <i class="fa fa-file menu-icon"></i>
                            <span class="menu-title">Rojmer Report</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item" id="financial_year_master">
            <a class="nav-link" href="<?php echo base_url('backend_admin/financial_year_master/Financial_year_master'); ?>" id="link-report">
                <i class="fa fa-calendar menu-icon"></i>
                <span class="menu-title">Financial Year</span>
            </a>
        </li>


        <li class="nav-item" id="carry_forward">
            <a class="nav-link" href="<?php echo base_url('backend_admin/carry_forward/Carry_forward'); ?>" id="link-report">
                <i class="fa fa-forward menu-icon"></i>
                <!-- <i class="fa-solid fa-bring-forward"></i> -->
                <span class="menu-title">Carry froward</span>
            </a>
        </li>

        <li class="nav-item" id="change_pass">
            <a class="nav-link" href="<?php echo base_url('backend_admin/change_pass/'); ?>" id="link-coll">
                <i class="fa fa-key menu-icon"></i>
                <span class="menu-title">Change Password</span>
            </a>
        </li>
    </ul>
</nav>

<div class="main-panel">
    <div class="content-wrapper">
        <script>
            const hasTree = $('.has-treeview');

            $.each(hasTree, function() {
                $(this).click(function() {
                    $(this).children('.nav-treeview').slideToggle();
                });
            });
        </script>