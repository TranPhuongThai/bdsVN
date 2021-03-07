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

$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('backend.search'),
    'class'     => 'bnt bntSearch padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#real_list").change(function (){
            var str = "";
            $(this).find("option:selected").each(function () {
                str += $(this).attr("value") + " ";
            });
            if(str){
                window.location = '<?php echo base_url();?>/admin/site_real_img/real/'+str;
            }
            return false;
        });
    });
</script>
<div class="content content-real_img padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <?php echo _breadcrumbs($breadcrumbs);?>
    <div class="search">
        <?php
            /*
            echo form_open(base_url()."admin/site_real/search",$form);
            echo form_label(lang('backend.fill'));
            echo "<select name=\"menu\" id=\"real_list\" class=\"min-width-120\"><option value=\"0\">".lang('backend.all')."</option>".$real_list."</select>";
            //echo form_submit($submit);
            echo form_close();
            */
        ?>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
    <table border="0" cellpadding="0" cellspacing="0" class="table-list-item">
        <tr class="head">
            <td class="row-1"><?php echo lang('backend.no');?></td>
            <td class="row-2"><?php echo lang('backend.id');?></td>
            <td class="row-4"><?php echo lang('backend.name');?></td>
            <td class="row-4"><?php echo lang('backend.img');?></td>
            <td class="row-3"><?php echo lang('backend.real');?></td>
            <td class="row-5"><?php echo lang('backend.dateset');?></td>
            <td class="row-6"><?php echo lang('backend.level');?></td>
            <td class="row-7"><?php echo lang('backend.status');?></td>
            <td class="row-8">
                <a href="<?php echo base_url()."admin/site_real_img/add/$real_chosen";?>" class="bntAddBig  padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue no-underline border-radius-5 hover-border-shadow"><?php echo lang('backend.add');?></a>
            </td>
        </tr>
        <?php $stt = 1; foreach($real_img_list as $row){ ?>
        <tr class="row">
            <td class="row-1 text-align-center"><?php echo $stt;?></td>
            <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
            <td class="row-4"><a href="<?php echo base_url()."admin/site_real_img/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Name'];?></a></td>
            <td class="row-4"><a href="<?php echo base_url()."admin/site_real_img/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><img src="<?php echo $row['Img'];?>"/></a></td>
            <td class="row-3"><?php echo $row['AName'];?></td>
            <td class="row-5"><?php echo _dataToDate($row['Dateset']);?></td>
            <td class="row-6"><?php echo $row['Level'];?></td>
            <td class="row-7"><?php if($row['Status'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
            <td class="row-8">
                <a href="<?php echo base_url()."admin/site_real_img/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
                <a href="<?php echo base_url()."admin/site_real_img/delete/".$row['ID'];?>" onclick="if(confirm('<?php echo lang('backend.alertdelete');?>')) return true; else return false;" title="<?php echo lang('backend.delete');?>" class="bntDelete color-black hover-color-blue"><?php echo lang('backend.delete');?></a>
            </td>
        </tr>
        <?php $stt++; } ?>
    </table>
    <div class="clear-both"></div>
    <div class="pagination"><?php echo $this->pagination->create_links(); ?><div class="clear-both"></div></div>
    <div class="clear-both"></div>
</div>