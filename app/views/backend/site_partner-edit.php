<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

$form = array(
    "name"      => "fadmin",
    "id"        => "fPartner",
    "class"     => "validate border-1 border-style-solid border-color-ccc background-color-fff padding-10",
); 
$name = array(
    "name"      => "name",
    "value"     => $partner_check['Name'],
    "class"     => "required focus text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$img = array(
    "name"      => "img",
    "value"     => $partner_check['Img'],
    "id"        => "IMAGES",
    "class"     => "required text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$content = array(
    "name"      => "content",
    "value"     => $partner_check['Content'],
    "id"        => "CONTENT",
    "class"     => "text width-400 height-160 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$link = array(
    "name"      => "link",
    "value"     => $partner_check['Link'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$level = array(
    "name"      => "level",
    "value"     => $partner_check['Level'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$status = array(
    "name"      => "status",
    "class"     => "checkbox border-1 border-color-ccc border-style-solid",
    "value"     => "1",
);
if($partner_check['Status'] == 1){
    $status["checked"] = "checked";
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
<script src="<?php echo base_url();?>public/js/Editor/imgmanager/js/mcimagemanager.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/js/Editor/scripts/innovaeditor.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/js/editor.js" type="text/javascript"></script>
<div class="content content-partner padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
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
            echo "<div class=\"item item-text\">".form_label(lang('backend.img')." <span class=\"color-red\">*</span>").form_input($img)."<input type=\"button\" value=\"\" onclick=\"mcImageManager.open('fadmin','IMAGES');\" id=\"bntImg\" name=\"bntImg\" class=\"iconImg\" /><div class=\"clear-both\"></div></div>";
            if($partner_check['Img']) {echo "<div class=\"item item-text\">".form_label("&nbsp;")."<img src=\"{$partner_check['Img']}\" height=\"90\"/><div class=\"clear-both\"></div></div>";}
            echo "<div class=\"item item-text\">".form_label(lang('backend.link')).form_input($link)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.level')).form_input($level)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.status')).form_checkbox($status)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.content'))."<div class=\"clear-both\"></div>".form_textarea($content)."<script type=\"text/javascript\">var fullVi = new InnovaEditor(\"fullVi\");FullEditor(fullVi, \"CONTENT\", 400);</script><div class=\"clear-both\"></div></div>";
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
                <td class="row-4"><?php echo lang('backend.link');?></td>
                <td class="row-7"><?php echo lang('backend.status');?></td>
                <td class="row-8"></td>
            </tr>
            <?php foreach($partner_list as $row){ ?>
            <tr class="row">
                <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
                <td class="row-3"><a href="<?php echo base_url()."admin/site_partner/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Name'];?></a><br /></td>
                <td class="row-4"><?php echo $row['Link'];?></td>
                <td class="row-7"><?php if($row['Status'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
                <td class="row-8">
                    <a href="<?php echo base_url()."admin/site_partner/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
                    <a href="<?php echo base_url()."admin/site_partner/delete/".$row['ID'];?>" onclick="if(confirm('<?php echo lang('backend.alertdelete');?>')) return true; else return false;" title="<?php echo lang('backend.delete');?>" class="bntDelete color-black hover-color-blue"><?php echo lang('backend.delete');?></a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>