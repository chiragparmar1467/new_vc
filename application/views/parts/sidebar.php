<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        
         <?php 
        //   $financial_year = $this->session->userdata('year');
       $financial_year = $this->db->query("SELECT * FROM financial_year_master WHERE status = 1")->row();
       
          ?>

          <select class="js-example-basic-single w-100" id="fk_financial_year_id" name="fk_financial_year_id">
              <!-- <option value="">Select Fiancial Year</option> -->
              <?php  $q = $this->db->get('financial_year_master');foreach ($q->result_array() as $k => $v): ?>
              <option value="<?php echo $v['id'] ?>" <?php if($financial_year->id == $v['id']) { echo "selected"; } ?>>
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

        <li class="nav-item" id="li-member">
            <a class="nav-link" href="<?php echo base_url('backend_admin/member_master/member'); ?>" id="link-member">
                <i class="fa fa-user menu-icon"></i>
                <span class="menu-title">Members</span>
            </a>
        </li>

        <li class="nav-item" id="li-account">
            <a class="nav-link" href="<?php echo base_url('backend_admin/account_master/Account'); ?>" id="link-account">
                <i class="fa fa-book menu-icon"></i>
                <span class="menu-title">Accounts</span>
            </a>
        </li>

        <li class="nav-item" id="li-group">
            <a class="nav-link" href="<?php echo base_url('backend_admin/group_master/groups'); ?>" id="link-group">
                <i class="fa fa-users menu-icon"></i>
                <span class="menu-title">Groups</span>
            </a>
        </li>

        <li class="nav-item" id="li-vc">
            <a class="nav-link" href="<?php echo base_url('backend_admin/vc_master/Vc_master'); ?>" id="link-vc">
                <i class="fa fa-bandcamp menu-icon"></i>
                <span class="menu-title">Loan Master</span>
            </a>
        </li>

        <li class="nav-item" id="li-coll">
            <a class="nav-link" href="<?php echo base_url('backend_admin/collection_master/collection'); ?>"
                id="link-coll">
                <i class="fa fa-archive menu-icon"></i>
                <span class="menu-title">Collections</span>
            </a>
        </li>

        <li class="nav-item" id="li-cre-deb">
            <a class="nav-link" href="<?php echo base_url('backend_admin/credit_debit_money_mst/Credit_debit_money_mst'); ?>"
                id="link-coll">
                <i class="fa fa-archive menu-icon"></i>
                <span class="menu-title">Credit debit money</span>
            </a>
        </li>

        <li class="nav-item" id="li-vc-re">
            <a class="nav-link" href="<?php echo base_url('backend_admin/vc_return_master/Vc_return_master'); ?>"
                id="link-coll">
                <i class="fa fa-bandcamp menu-icon"></i>
                <span class="menu-title">Loan Return Master</span>
            </a>
        </li>

        
      

         <li class="nav-item" id="li-report">
            <a class="nav-link" href="<?php echo base_url('backend_admin/report_master/report'); ?>" id="link-report">
                <i class="fa fa-file menu-icon"></i>
                <span class="menu-title">Report</span>
            </a>
        </li>

         <!-- <li class="nav-item" id="li-yearly-report">
            <a class="nav-link" href="<?php echo base_url('backend_admin/report_master/Yearly_report'); ?>" id="link-yerly-report">
                <i class="fa fa-file menu-icon"></i>
                <span class="menu-title">Yearly Report</span>
            </a>
        </li> -->

         <li class="nav-item" id="li-credit_report">
            <a class="nav-link" href="<?php echo base_url('backend_admin/report_master/credit_debit_report'); ?>" id="link-report">
                <i class="fa fa-file menu-icon"></i>
                <span class="menu-title">Rojmer (Credit Debit Report)</span>
            </a>
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

       <!-- <li class="nav-item" id="li-pay">
            <a class="nav-link" href="<?php echo base_url('backend_admin/payment_mode/Payment_mode'); ?>"
                id="link-coll">
                <i class="fa fa-credit-card  menu-icon"></i>
                <span class="menu-title">Payment Mode</span>
            </a>
        </li> -->

    </ul>
</nav>

<div class="main-panel">
    <div class="content-wrapper">