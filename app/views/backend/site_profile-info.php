<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

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
    "value"     => $user_check['Username'],
    "class"     => "required email text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
    "disabled"  => "disabled",
);
$name = array(
    "name"      => "name",
    "value"     => $user_check['Name'],
    "class"     => "required focus text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$img = array(
    "name"      => "img",
    "value"     => $user_check['Img'],
    "id"        => "IMAGES",
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$address = array(
    "name"      => "address",
    "value"     => $user_check['Address'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$province_attr = 'id="province_list"';
$province = $province_list;
$district_attr = 'id="district_list"';
$district = $district_list;
$phone = array(
    "name"      => "phone",
    "value"     => $user_check['Phone'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$birthday = array(
    "name"      => "birthday",
    "value"     => _dataToDate($user_check['Birthday']),
    "class"     => "datepicker text width-200 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
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
<script>
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
            echo "<div class=\"item item-text\">".form_label(lang('backend.fullname')." <span class=\"color-red\">*</span>").form_input($name)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.username')." <span class=\"color-red\">*</span>").form_input($username)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.img')).form_input($img)."<input type=\"button\" value=\"\" onclick=\"mcImageManager.open('fadmin','IMAGES');\" id=\"bntImg\" name=\"bntImg\" class=\"iconImg\" /><div class=\"clear-both\"></div></div>";
            if($user_check['Img']) {echo "<div class=\"item item-text\">".form_label("&nbsp;")."<img src=\"{$user_check['Img']}\" height=\"90\"/><div class=\"clear-both\"></div></div>";}
            echo "<div class=\"item item-text\">".form_label(lang('backend.address')).form_input($address)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.province')).form_dropdown("province",$province,$user_check['Province'],$province_attr)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.district')).form_dropdown("district",$district,$user_check['District'],$district_attr)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.phone')).form_input($phone)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.birthday')).form_input($birthday)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-submit\">".form_submit($submit).form_reset($reset)."<div class=\"clear-both\"></div></div>";
            echo form_close();
        ?>
        <div class="clear-both"></div>
    </div>
    <div class="section-right float-right">
        <div class="right-info background-color-fff border-1 border-style-solid border-color-ccc border-radius-5 padding-10">
            <div class="item item_img">
                <div class="display-img text-align-center background-color-fff border-1 border-style-solid border-color-ccc border-radius-5">
                    <img src="<?php if($user_check["Img"]) echo $user_check["Img"]; else echo base_url()."public/i/no-avatar.png" ;?>"/><br />
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