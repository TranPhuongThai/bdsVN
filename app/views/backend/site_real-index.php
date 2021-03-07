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
$name = array(
    "name"      => "name",
    "value"     => $name,
    "class"     => "text width-140 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$status_list = array("2"=>lang('backend.status'),"1"=>lang('backend.show'),"0"=>lang('backend.hidden'));
$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('backend.search'),
    'class'     => 'bnt bntSearch padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);

?>
<div class="content content-real padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <?php echo _breadcrumbs($breadcrumbs);?>
    <div class="search">
        <?php
            echo form_open(base_url()."/admin/site_real/search",$form);
            echo form_label(lang('backend.search')).form_input($name);
            echo "<select name=\"menu\"><option value=\"0\">Danh mục</option>".$menu_list."</select>";
            echo form_dropdown("status",$status_list,$status);
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
            <td class="row-3"><?php echo lang('backend.name');?></td>
            <td class="row-3"><?php echo lang('backend.name');?></td>
            <td class="row-4"><?php echo lang('backend.img');?></td>
            <td class="row-5"><?php echo lang('backend.hit');?></td>
            <!--<td class="row-6"><?php echo lang('backend.new');?></td>-->
            <td class="row-7"><?php echo lang('backend.hot');?></td>
            <td class="row-8"><?php echo lang('backend.status');?></td>
            <td class="row-9">
                <a href="<?php echo base_url()."/admin/site_real/add";?>" class="bntAddBig  padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue no-underline border-radius-5 hover-border-shadow"><?php echo lang('backend.add');?></a>
            </td>
        </tr>
        <?php $stt = 1; foreach($real_list as $row){ ?>
        <tr class="row">
            <td class="row-1 text-align-center"><?php echo $stt;?></td>
            <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
            <td class="row-3"><a href="<?php echo base_url()."/admin/site_real/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo $row['Name'];?></a></td>
            <td class="row-3"><a href="<?php echo base_url()."/admin/site_real/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><img src="<?php echo $row['Thumb1'];?>"/></a></td>
            <td class="row-4"><a href="<?php echo base_url()."/admin/site_real/menu/".$row['Menu'];?>" title="Lọc theo danh mục <?php echo $row['MName'];?>" class="color-blue hover-underline"><?php echo $row['MName'];?></a></td>
            <td class="row-5"><?php echo $row['Hit'];?></td>
            <!--<td class="row-6"><?php if($row['New'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>-->
            <td class="row-7"><?php if($row['Hot'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
            <td class="row-8"><?php if($row['Status'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
            <td class="row-9">
                <a href="<?php echo base_url()."/admin/site_real/up/".$row['ID'];?>" index-id="<?php echo $row['ID'];?>" title="Up top" class="bntUp color-black hover-color-blue">Up top</a>
                <a href="<?php echo base_url()."/admin/site_real_img/real/".$row['ID'];?>" title="Hình ảnh" class="bntImage color-black hover-color-blue"><?php echo lang('backend.img2');?></a>
                <a href="<?php echo base_url()."/admin/site_real/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
                <a href="<?php echo base_url()."/admin/site_real/delete/".$row['ID'];?>" onclick="if(confirm('<?php echo lang('backend.alertdelete');?>')) return true; else return false;" title="<?php echo lang('backend.delete');?>" class="bntDelete color-black hover-color-blue"><?php echo lang('backend.delete');?></a>
            </td>
        </tr>
        <?php $stt++; } ?>
    </table>
    <div class="clear-both"></div>
    <div class="pagination"><?php echo $this->pagination->create_links(); ?><div class="clear-both"></div></div>
    <div class="clear-both"></div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.table-list-item .bntUp').click(function(){
            id = $(this).attr('index-id');
            $.post("<?php echo base_url();?>/admin/site_real/up/"+id, {
                    'id' : id,
                    'csrf_token_name': $('input[name=csrf_token_name]').val()
                },function(data){
                    if(data =='done')
                        window.location.reload(true);
                });
            return false;
        });
         
    });
        
</script>