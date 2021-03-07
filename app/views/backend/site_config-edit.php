<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */
$form = array(
    "name"      => "fConfig",
    "id"        => "fConfig",
    "class"     => "validate border-1 border-style-solid border-color-ccc background-color-fff padding-10",
); 
$name = array(
    "name"      => "name",
    "value"     => $config_check["Name"],
    "class"     => "required focus text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$content = array(
    "name"      => "content",
    "value"     => $config_check["Content"],
    "class"     => "required textarea width-400 height-100 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$guide = array(
    "name"      => "guide",
    "value"     => $config_check["Guide"],
    "class"     => "textarea width-400 height-100 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
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
<div class="content content-config padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
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
            echo "<div class=\"item item-textarea\">".form_label(lang('backend.content')." <span class=\"color-red\">*</span>").form_textarea($content)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-textarea\">".form_label(lang('backend.guide')).form_textarea($guide)."<div class=\"clear-both\"></div></div>";
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
                <td class="row-5"></td>
            </tr>
            <?php foreach($config_list as $row){ ?>
            <tr class="row">
                <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
                <td class="row-3"><a href="<?php echo base_url()."admin/site_config/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Name'];?></a></td>
                <td class="row-5">
                    <a href="<?php echo base_url()."admin/site_config/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>