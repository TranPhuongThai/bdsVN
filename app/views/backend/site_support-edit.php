<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

$form = array(
    "name"      => "fadmin",
    "id"        => "fSupport",
    "class"     => "validate border-1 border-style-solid border-color-ccc background-color-fff padding-10",
); 
$name = array(
    "name"      => "name",
    "value"     => $support_check['Name'],
    "class"     => "required focus text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$phone = array(
    "name"      => "phone",
    "value"     => $support_check['Phone'],
    "class"     => "required text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$yahoo = array(
    "name"      => "yahoo",
    "value"     => $support_check['Yahoo'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$skype = array(
    "name"      => "skype",
    "value"     => $support_check['Skype'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$email = array(
    "name"      => "email",
    "value"     => $support_check['Email'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$type = array(
    "1"         => "Yahoo",
    "2"         => "Skype",
);
$level = array(
    "name"      => "level",
    "value"     => $support_check['Level'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
if($support_check['Status'] == 1){
    $status = array(
        "name"      => "status",
        "class"     => "checkbox border-1 border-color-ccc border-style-solid",
        "value"     => "1",
        "checked"   => "checked",
    );
}else{
    $status = array(
        "name"      => "status",
        "class"     => "checkbox border-1 border-color-ccc border-style-solid",
        "value"     => "1",
    );
}

$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('backend.save'),
    'class'     => 'bnt bntSave padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);
$reset = array(
    'name'      => 'bntReset',
    'value'     => lang('backend.reset'),
    'class'     => 'bnt bntReset padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);
?>
<div class="content content-support padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <div class="section-left float-left">
        <?php echo _breadcrumbs($breadcrumbs);?>
        <div class="clear-both"></div>
        <?php 
        
            echo "<div class=\"error red text-align-left\">";
                echo validation_errors();
                if($error !="" )
                    echo "<p>$error</p>";
            echo "</div>";
            echo form_open("",$form);
            echo "<div class=\"item item-text\">".form_label(lang('backend.name')." <span class=\"color-red\">*</span>").form_input($name)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.phone')." <span class=\"color-red\">*</span>").form_input($phone)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.yahoo')." <span class=\"color-red\">*</span>").form_input($yahoo)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.skype')." ").form_input($skype)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.email')." ").form_input($email)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.level')).form_input($level)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.status')).form_checkbox($status)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-submit\">".form_submit($submit).form_reset($reset)."<div class=\"clear-both\"></div></div>";
            echo form_close();
        ?>
        <div class="clear-both"></div>
    </div>
    <div class="section-right float-right">
        <table border="0" cellpadding="0" cellspacing="0" class="table-list-item">
            <tr class="head">
                <td class="row-2"><?php echo lang('backend.id');?></td>
                <td class="row-3"><?php echo lang('backend.name');?></td>
                <td class="row-5"><?php echo lang('backend.yahoo');?></td>
                <td class="row-6"><?php echo lang('backend.skype');?></td>
                <td class="row-7"><?php echo lang('backend.status');?></td>
                <td class="row-8"></td>
            </tr>
            <?php foreach($support_list as $row){ ?>
            <tr class="row">
                <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
                <td class="row-3"><a href="<?php echo base_url()."admin/site_support/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Name'];?></a><br /></td>
                <td class="row-5"><?php echo $row['Yahoo'];?></td>
                <td class="row-5"><?php echo $row['Skype'];?></td>
                <td class="row-7"><?php if($row['Status'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
                <td class="row-8">
                    <a href="<?php echo base_url()."admin/site_support/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
                    <a href="<?php echo base_url()."admin/site_support/delete/".$row['ID'];?>" onclick="if(confirm('<?php echo lang('backend.alertdelete');?>')) return true; else return false;" title="<?php echo lang('backend.delete');?>" class="bntDelete color-black hover-color-blue"><?php echo lang('backend.delete');?></a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>