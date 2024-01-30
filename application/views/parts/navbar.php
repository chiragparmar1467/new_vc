<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="#"><img src="<?= base_url() ?>assets/logo/<?=  $company_data['logo']; ?>"
                class="mr-2" alt="logo" width="80px"/></a>
        <a class="navbar-brand brand-logo-mini" href="#"><img
                src="<?= base_url() ?>assets/logo/<?=  $company_data['logo']; ?>" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
       
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="icon-bell mx-0"></i>
                    <?php 
                    $date = date('Y-m-d');   
                    // $grp_data = $this->db->query('select * from group_master where status = 1 AND deleted = 0 AND fk_financial_year_id = '.$_SESSION['year'].' AND end_date < "'.$date.'"')->result_array(); 
                    // $vc_data = $this->db->query('select * from vc_master where status = 1 AND deleted = 0 AND fk_financial_year_id = '.$_SESSION['year'].' AND vc_closing_date < "'.$date.'"')->result_array(); 
                    // $vc_draw_data = $this->db->query('select * from vc_master where status = 1 AND deleted = 0 AND fk_financial_year_id = '.$_SESSION['year'].' AND vc_draw_date < "'.$date.'"')->result_array(); 
                    
                    // $count = count($grp_data) + count($vc_data) + count($vc_draw_data);
                    ?>

                    <span class="count" style="padding: 0;font-size: 10px;width: 15px;height: 15px;line-height: 15px;vertical-align: middle;position: absolute;top: 0;right: 3px;color:white">
                    <?php echo $count ;?>
                    </span>
                    <!-- <span class="count"></span> -->
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">You Have <?= $count ?> Notifications</p>
                   <?php if(!empty($grp_data)){ foreach($grp_data as $noti){ ?>
                    <!-- <a class="dropdown-item preview-item" href="<?= base_url() ?>/backend_admin/group_master/Groups/edit/<?= $noti['id']; ?>">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="ti-info-alt mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Take action on group name "<?= $noti['name']; ?>"</h6>
                        </div>
                    </a> -->
                    <?php } }?>
                   <?php if(!empty($vc_data)){ foreach($vc_data as $noti){ ?>
                    <!-- <a class="dropdown-item preview-item" href="<?= base_url() ?>/backend_admin/vc_master/Vc_master/edit/<?= $noti['id']; ?>">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="ti-info-alt mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Take action on loan name "<?= $noti['name']; ?>"</h6>
                        </div>
                    </a> -->
                    <?php } }?>
                   <?php if(!empty($vc_draw_data)){ foreach($vc_draw_data as $noti){ ?>
                    <!-- <a class="dropdown-item preview-item" href="<?= base_url() ?>/backend_admin/vc_master/Vc_master/edit/<?= $noti['id']; ?>">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="ti-info-alt mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Draw date arrived of loan "<?= $noti['name']; ?>"</h6>
                        </div>
                    </a> -->
                    <?php } }?>
                </div>
            </li>
            
      
            <li class="nav-item nav-profile dropdown">
               
                
                    <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">
                        <i class="ti-power-off text-primary"></i>
                        
                    </a>
               
            </li>
        
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>