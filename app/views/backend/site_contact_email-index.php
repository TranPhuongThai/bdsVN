<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

 
?>
<div class="content content-email padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <?php echo _breadcrumbs($breadcrumbs);?>
    <div class="clear-both"></div>
    <table border="0" cellpadding="0" cellspacing="0" class="table-list-item">
        <tr class="head">
            <td class="row-1"><?php echo lang('backend.no');?></td>
            <td class="row-2"><?php echo lang('backend.id');?></td>
            <td class="row-3"><?php echo lang('backend.name');?></td>
            <td class="row-4"><?php echo lang('backend.email');?></td>
            <td class="row-5"><?php echo lang('backend.phone');?></td>
            <td class="row-6"><?php echo lang('backend.status');?></td>
            <td class="row-7">
            </td>
        </tr>
        <?php $stt = 1; foreach($email_list as $row){ ?>
        <tr class="row">
            <td class="row-1 text-align-center"><?php echo $stt;?></td>
            <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
            <td class="row-3"><a href="<?php echo base_url()."admin/site_contact_email/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Name'];?></a></td>
            <td class="row-4"><?php echo $row['Email'];?></td>
            <td class="row-4"><?php echo $row['Phone'];?></td>
            <td class="row-5"><?php if($row['Status'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
            <td class="row-6">
                <a href="<?php echo base_url()."admin/site_contact_email/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
            </td>
        </tr>
        <?php $stt++; } ?>
    </table>
    <div class="clear-both"></div>
</div>