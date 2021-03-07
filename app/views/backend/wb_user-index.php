<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

 
$form = array(
    "name"      => "fadmin",
    "id"        => "fSearch",
    "class"     => "validate",
); 
$text = array(
    "name"      => "text",
    "value"     => $text,
    "class"     => "required text width-140 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('backend.search'),
    'class'     => 'bnt bntSearch padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);

?>
<div class="content content-user padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <?php echo _breadcrumbs($breadcrumbs);?>
    <div class="search">
        <?php
            echo form_open(base_url()."admin/wb_user/search",$form);
            echo form_label(lang('backend.search')).form_input($text);
            echo form_submit($submit);
            echo form_close();
        ?>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
    <table border="0" cellpadding="0" cellspacing="0" class="table-list-item">
        <tr class="head">
            <td class="row-1"><?php echo lang('backend.no');?></td>
            <td class="row-2"><?php echo lang('backend.id');?></td>
            <td class="row-3"><?php echo lang('backend.account');?></td>
            <td class="row-4"><?php echo lang('backend.name');?></td>
            <td class="row-5"><?php echo lang('backend.type');?></td>
            <td class="row-6"><?php echo lang('backend.active');?></td>
            <td class="row-7"><?php echo lang('backend.status');?></td>
            <td class="row-8">
                <a href="<?php echo base_url()."admin/wb_user/add";?>" class="bntAddBig  padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue no-underline border-radius-5 hover-border-shadow"><?php echo lang('backend.add');?></a>
            </td>
        </tr>
        <?php $stt = 1; foreach($user_list as $row){ ?>
        <tr class="row">
            <td class="row-1 text-align-center"><?php echo $stt;?></td>
            <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
            <td class="row-3"><a href="<?php echo base_url()."admin/wb_user/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Username'];?></a></td>
            <td class="row-4"><a href="<?php echo base_url()."admin/wb_user/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Name'];?></a></td>
            <td class="row-5"><?php echo $row['TypeName'];?></td>
            <td class="row-6"><?php if($row['Active'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
            <td class="row-7"><?php if($row['Status'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
            <td class="row-8">
                <a href="<?php echo base_url()."admin/wb_user/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
                <a href="<?php echo base_url()."admin/wb_user/hidden/".$row['ID'];?>" title="Ẩn" class="bntDelete color-black hover-color-blue">Ẩn</a>
            </td>
        </tr>
        <?php $stt++; } ?>
    </table>
    <div class="clear-both"></div>
    <div class="pagination"><?php echo $this->pagination->create_links(); ?><div class="clear-both"></div></div>
    <div class="clear-both"></div>
</div>