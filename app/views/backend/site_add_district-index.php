<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

 
?>
<div class="content content-district padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <?php echo _breadcrumbs($breadcrumbs);?>
    <div class="search hidden">
        <ul class="level-1">
            <li class="level-1"><span class="cursor-pointer font-weight-bold color-blue"><?php echo lang("backend.fill");?></span>
                <ul class="level-2 border-1 border-style-solid border-color-ccc background-color-fff border-radius-4 padding-5">
                    <?php
                        foreach($province_list as $row){
                            echo "<li class=\"level-2\"><a href=".base_url()."admin/site_add_district/fill/".$row['ID']." class=\"color-blue no-underline hover-underline\">".$row['Name']."</a></li>";
                        }
                    ?>
                </ul>
            </li>
        </ul>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
    <table border="0" cellpadding="0" cellspacing="0" class="table-list-item">
        <tr class="head">
            <td class="row-1"><?php echo lang('backend.no');?></td>
            <td class="row-2"><?php echo lang('backend.id');?></td>
            <td class="row-3"><?php echo lang('backend.name');?></td>
            <td class="row-4"><?php echo lang('backend.province');?></td>
            <td class="row-5"><?php echo lang('backend.level');?></td>
            <td class="row-6"><?php echo lang('backend.status');?></td>
            <td class="row-7">
                <a href="<?php echo base_url()."admin/site_add_district/add";?>" class="bntAddBig  padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue no-underline border-radius-5 hover-border-shadow"><?php echo lang('backend.add');?></a>
            </td>
        </tr>
        <?php $stt = 1; foreach($district_list as $row){ ?>
        <tr class="row">
            <td class="row-1 text-align-center"><?php echo $stt;?></td>
            <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
            <td class="row-3"><a href="<?php echo base_url()."admin/site_add_district/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Name'];?></a></td>
            <td class="row-4"><?php echo $row['ProvinceName'];?></td>
            <td class="row-5"><?php echo $row['Level'];?></td>
            <td class="row-6"><?php if($row['Status'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
            <td class="row-7">
                <a href="<?php echo base_url()."admin/site_add_district/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
                <a href="<?php echo base_url()."admin/site_add_district/delete/".$row['ID'];?>" onclick="if(confirm('<?php echo lang('backend.alertdelete');?>')) return true; else return false" title="<?php echo lang('backend.delete');?>" class="bntDelete color-black hover-color-blue"><?php echo lang('backend.delete');?></a>
            </td>
        </tr>
        <?php $stt++; } ?>
    </table>
    <div class="clear-both"></div>
    <div class="pagination"><?php echo $this->pagination->create_links(); ?><div class="clear-both"></div></div>
    <div class="clear-both"></div>
</div>