<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

 
?>
<div class="content content-menu padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <?php echo _breadcrumbs($breadcrumbs);?>
    <div class="clear-both"></div>
    <table border="0" cellpadding="0" cellspacing="0" class="table-list-item">
        <tr class="head">
            <td class="row-1"><?php echo lang('backend.no');?></td>
            <td class="row-2"><?php echo lang('backend.id');?></td>
            <td class="row-5"><?php echo lang('backend.parent');?></td>
            <td class="row-3"><?php echo lang('backend.name');?></td>
            <td class="row-6"><?php echo lang('backend.level');?></td>
            <td class="row-7"><?php echo lang('backend.status');?></td>
            <td class="row-8">
                <!--<a href="<?php echo base_url()."/admin/site_real_menu/add/".$check_pid['ID'];?>" class="bntAddBig  padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue no-underline border-radius-5 hover-border-shadow"><?php echo lang('backend.add');?></a>-->
            </td>
        </tr>
        <?php $stt = 1; foreach($real_menu_list as $row){ ?>
        <tr class="row">
            <td class="row-1 text-align-center"><?php echo $stt;?></td>
            <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
            <td class="row-5 text-align-center"><?php echo $row['PID'];?></td>
            <td class="row-3"><a href="<?php echo base_url()."/admin/site_real_menu/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Name'];?></a></td>
            <td class="row-6"><?php echo $row['Level'];?></td>
            <td class="row-7"><?php if($row['Status'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
            <td class="row-8">
                <!--<a href="<?php echo base_url()."/admin/site_real_menu/pid/".$row['ID'];?>" title="<?php echo lang('backend.child');?>" class="bntParent color-black hover-color-blue">Con</a>-->
                <a href="<?php echo base_url()."/admin/site_real_menu/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
                <a href="<?php echo base_url()."/admin/site_real_menu/delete/".$row['ID'];?>" onclick="if(confirm('<?php echo lang('backend.alertdelete');?>')) return true; else return false;" title="<?php echo lang('backend.delete');?>" class="bntDelete color-black hover-color-blue"><?php echo lang('backend.delete');?></a>
            </td>
        </tr>
        <?php $stt++; } ?>
    </table>
    <div class="clear-both"></div>
</div>