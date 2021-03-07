<?php if($this->my_auth->is_Admin()){ ?>
<div id="menu" class="jqueryslidemenu">
    <ul class="menu_all float-left">
        <?php echo $this->data['admin_menu_all'];?>
    </ul>
    <div class="action_all float-right">
        <a href="<?php echo base_url()."admin/wb_verify/logout";?>" class="iconLogout no-underline text-align-left color-black-2 hover-blue"><?php echo lang('backend.logout');?></a>
        <a href="<?php echo base_url();?>" target="_blank" class="iconSite no-underline text-align-left color-black-2 hover-blue"><?php echo lang('backend.view_website');?></a>
        <a href="<?php echo base_url()."admin/site_profile";?>" class="iconUser no-underline text-align-left color-black-2 hover-blue"><?php echo lang('backend.profile');?></a>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>
<?php } ?>