<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

//select tuser
$temp = array();
foreach($user_type as $row){
    $temp[$row['ID']] = $row['Name'];
}
$user_type = $temp;
//select province
$temp = array();
foreach($province_list as $row){
    $temp[$row['ID']] = $row['Name'];
}
$province_list = $temp;
//select district id = 31
$temp = array();
foreach($district_list as $row){
    $temp[$row['ID']] = $row['Name'];
}
$district_list = $temp;
            
$form = array(
    "name"      => "fadmin",
    "id"        => "fUser",
    "class"     => "validate border-1 border-style-solid border-color-ccc background-color-fff padding-10",
); 
$username = array(
    "name"      => "username",
    "value"     => set_value("username"),
    "class"     => "required email text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$password = array(
    "name"      => "password",
    "class"     => "required text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$name = array(
    "name"      => "name",
    "value"     => set_value("name"),
    "class"     => "required focus text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$type = $user_type;
$img = array(
    "name"      => "img",
    "value"     => set_value("img"),
    "id"        => "IMAGES",
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$address = array(
    "name"      => "address",
    "value"     => set_value("address"),
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$province_attr = 'id="province_list"';
$province = $province_list;
$district_attr = 'id="district_list"';
$district = $district_list;
$phone = array(
    "name"      => "phone",
    "value"     => set_value("phone"),
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$birthday = array(
    "name"      => "birthday",
    "value"     => set_value("birthday"),
    "class"     => "datepicker text width-200 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('backend.add'),
    'class'     => 'bnt bntAdd padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);
$reset = array(
    'name'      => 'bntReset',
    'value'     => lang('backend.reset'),
    'class'     => 'bnt bntReset padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#province_list").change(function (){
            var str = "";
            $(this).find("option:selected").each(function () {
                str += $(this).attr("value");
            });
            var cct = $("input[name=csrf_token_name]").val();
            //var cct = $.cookie("csrf_cookie_name");
            $.post("<?php echo base_url();?>/ajax/getOptionDistrict/"+str, {
                    'csrf_token_name': cct
                },function(data){
                    $("#district_list").html(data);
                }); 
            return false;
        });
    });
</script>
<script src="<?php echo base_url();?>public/js/Editor/imgmanager/js/mcimagemanager.js" type="text/javascript"></script>
<div class="content content-user padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
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
            echo "<div class=\"item item-text\">".form_label(lang('backend.username')." <span class=\"color-red\">*</span>").form_input($name)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.account')." <span class=\"color-red\">*</span>").form_input($username)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.password')." <span class=\"color-red\">*</span>").form_password($password)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.permis')." <span class=\"color-red\">*</span>").form_dropdown("type",$type,set_value("type"))."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.img')).form_input($img)."<input type=\"button\" value=\"\" onclick=\"mcImageManager.open('fadmin','IMAGES');\" id=\"bntImg\" name=\"bntImg\" class=\"iconImg\" /><div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.province')).form_dropdown("province",$province,set_value("province"),$province_attr)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.district')).form_dropdown("district",$district,set_value("district"),$district_attr)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.address')).form_input($address)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.phone')).form_input($phone)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.birthday')).form_input($birthday)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-submit\">".form_submit($submit).form_reset($reset)."<div class=\"clear-both\"></div></div>";
            echo form_close();
        ?>
        <div class="clear-both"></div>
    </div>
    <div class="section-right float-right">
        <table border="0" cellpadding="0" cellspacing="0" class="table-list-item">
            <tr class="head">
                <td class="row-2"><?php echo lang('backend.id');?></td>
                <td class="row-3"><?php echo lang('backend.account')." / ".lang('backend.name');?></td>
                <td class="row-4"><?php echo lang('backend.type');?></td>
                <td class="row-6"><?php echo lang('backend.active');?></td>
                <td class="row-7"><?php echo lang('backend.status');?></td>
                <td class="row-8"></td>
            </tr>
            <?php foreach($user_list as $row){ ?>
            <tr class="row">
                <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
                <td class="row-3">
                    <a href="<?php echo base_url()."admin/wb_user/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Username'];?></a><br />
                    <a href="<?php echo base_url()."admin/wb_user/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Name'];?></a>
                </td>
                <td class="row-4"><?php echo $row['TypeName'];?></td>
                <td class="row-6"><?php if($row['Active'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
                <td class="row-7"><?php if($row['Status'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
                <td class="row-8">
                    <a href="<?php echo base_url()."admin/wb_user/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
                    <a href="<?php echo base_url()."admin/wb_user/hidden/".$row['ID'];?>" title="Ẩn" class="bntDelete color-black hover-color-blue">Ẩn</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>