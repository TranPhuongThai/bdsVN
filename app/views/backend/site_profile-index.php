<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */
 
?>

<div class="content content-home padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <div class="section-left float-left">
        <?php foreach($menu_index as $row){ ?>
            <div class="item text-align-center background-color-fff border-1 border-style-solid border-color-ccc border-radius-5 hover-border-shadow _gradient-fff-eee hover-gradient-fff-eee">
                <a href="<?php echo base_url()."admin/".$row['Link'];?>" class="block no-underline text-align-center">
                    <img src="<?php if($row["Img"]) echo $row["Img"]; else echo base_url()."public/i/header/icon-48-user-profile.png" ;?>"/><br />
                    <span class="color-black-3 font-weight-bold font-size-11"><?php echo $row["Name"];?></span>
                </a>
            </div>
        <?php } ?>
        <div class="clear-both"></div>
    </div>
    <div class="section-right float-right">
        <div class="right-info background-color-fff border-1 border-style-solid border-color-ccc border-radius-5 padding-10">
            <div class="item item_img">
                <div class="display-img text-align-center background-color-fff border-1 border-style-solid border-color-ccc border-radius-5">
                    <a href="<?php echo base_url()."admin/site_profile/info";?>">
                        <img src="<?php if($user_check["Img"]) echo $user_check["Img"]; else echo base_url()."public/i/no-avatar.png" ;?>"/><br />
                    </a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="item item_name">
                <div class="left"><?php echo lang('backend.username');?> : </div>
                <div class="right"><?php echo $user_check['Username'];?></div>
                <div class="clear-both"></div>
            </div>
            <div class="item item_name">
                <div class="left"><?php echo lang('backend.fullname');?> : </div>
                <div class="right"><?php echo $user_check['Name'];?></div>
                <div class="clear-both"></div>
            </div>
            <div class="item item_name">
                <div class="left"><?php echo lang('backend.birthday');?> (dd/mm/yy) : </div>
                <div class="right"><?php echo _dataToDate($user_check['Birthday']);?></div>
                <div class="clear-both"></div>
            </div>
            <div class="item">
                <div class="left"><?php echo lang('backend.phone');?> : </div>
                <div class="right"><?php echo $user_check['Phone'];?></div>
                <div class="clear-both"></div>
            </div>
            <div class="item">
                <div class="left"><?php echo lang('backend.address');?> : </div>
                <div class="right"><?php echo $user_check['Address'].", ".$user_check_district['Name'].", ".$user_check_province['Name'];?></div>
                <div class="clear-both"></div>
            </div>
        </div>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>