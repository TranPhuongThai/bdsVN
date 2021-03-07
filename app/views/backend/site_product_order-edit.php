<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

$form = array(
    "name"      => "fadmin",
    "id"        => "forder",
    "class"     => "validate border-1 border-style-solid border-color-ccc background-color-fff padding-10",
); 
$name = array(
    "name"      => "name",
    "value"     => $order_check['Name'],
    "class"     => "required focus text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$phone = array(
    "name"      => "phone",
    "value"     => $order_check['Phone'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$email = array(
    "name"      => "email",
    "value"     => $order_check['Email'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$address = array(
    "name"      => "address",
    "value"     => $order_check['Address'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$content = array(
    "name"      => "content",
    "value"     => $order_check['Content'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);

$status = array(
    "name"      => "status",
    "class"     => "checkbox border-1 border-color-ccc border-style-solid",
    "value"     => "1",
);
if($order_check['Status'] == 1){
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
<div class="content content-order padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
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
            echo "<div class=\"item item-text\">".form_label(lang('backend.phone')." ").form_input($phone)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.email')).form_input($email)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.address')).form_input($address)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.content')." <span class=\"color-red\">*</span>").form_textarea($content)."<div class=\"clear-both\"></div></div>";
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
                <td class="row-4"><?php echo lang('backend.code');?></td>
                <td class="row-7"><?php echo lang('backend.cost');?></td>
                <td class="row-5"><?php echo lang('backend.amount');?></td>
                <td class="row-8"><?php echo lang('backend.sum');?></td>
            </tr>
            <?php 
                $total = 0;
                $amount = 0;
                foreach($order_product_list as $row){
                    $sum = $row['Cost']* $row['Amount'];
                    $total += $sum;
                    $amount += $row['Amount'];
            ?>
            <tr class="row">
                <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
                <td class="row-3"><?php echo $row['PName'];?></td>
                <td class="row-4"><?php echo $row['Code'];?></td>
                <td class="row-7"><?php echo $row['Cost'];?></td>
                <td class="row-5"><?php echo $row['Amount'];?></td>
                <td class="row-8"><?php echo $sum;?></td>
            </tr>
            <?php } ?>
            <tr class="row">
                <td colspan="4"><?php echo lang('backend.total');?></td>
                <td ><?php echo $amount;?></td>
                <td ><?php echo $total;?></td>
            </tr>
        </table>
        <a href="<?php echo base_url()."admin/site_product_order/exporttoexcel/".$order_check['ID'];?>" target="_blank" title="Export To Excel" class="bntExcel" style="margin-top: 10px;">Export To Excel</a>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>