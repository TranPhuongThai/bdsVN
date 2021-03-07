<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

?>
<div class="content content-user padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <?php echo _breadcrumbs($breadcrumbs);?>
    <div class="clear-both"></div>
    <table border="0" cellpadding="0" cellspacing="0" class="table-list-item">
        <tr class="head">
            <td class="row-1" colspan="5">
                <?php echo lang('backend.online').": $online";?>&nbsp;&nbsp;|&nbsp;&nbsp;
                <?php echo lang('backend.today').": $online_today";?>&nbsp;&nbsp;|&nbsp;&nbsp;
                <?php echo lang('backend.this_month').": $online_this_month";?>&nbsp;&nbsp;|&nbsp;&nbsp;
                <?php echo lang('backend.total').": $online_sum";?>
            </td>
        </tr>
        <tr class="head">
            <td class="row-1">ID</td>
            <td class="row-2">SessionID</td>
            <td class="row-3">User</td>
            <td class="row-4"><?php echo lang('backend.date_start');?></td>
            <td class="row-5">IP</td>
        </tr>
        <?php 
            foreach($online_list as $row){ 
                if($row['User'] != "guess"){
                    $user_check = $this->mwb_user->getDataByID($row['User']);
                    if($user_check){
                        $user = $user_check['Username'];
                    }else{
                        $user = "guess";
                    }
                }else{
                    $user = "guess";
                }
        ?>
        <tr class="row">
            <td class="row-1"><?php echo $row['ID'];?></td>
            <td class="row-2"><?php echo $row['SessionID'];?></td>
            <td class="row-3"><?php echo $user;?></td>
            <td class="row-4"><?php echo _DataTimeToDateTime_2($row['Dateset']);?></td>
            <td class="row-5"><?php echo $row['IP'];?></td>
       </tr>
        <?php } ?>
    </table>
    <div class="clear-both"></div>
    <div class="pagination"><?php echo $this->pagination->create_links(); ?><div class="clear-both"></div></div>
    <div class="clear-both"></div>
</div>