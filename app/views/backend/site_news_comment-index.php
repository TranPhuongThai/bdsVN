<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */
 
?>
<div class="content content-news padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <?php echo _breadcrumbs($breadcrumbs);?>
    <div class="clear-both"></div>
    <table border="0" cellpadding="0" cellspacing="0" class="table-list-item">
        <tr class="head">
            <td class="row-1"><?php echo lang('backend.no');?></td>
            <td class="row-2"><?php echo lang('backend.id');?></td>
            <td class="row-3">Name/Email</td>
            <td class="row-4">Tiêu đề</td>
            <td class="row-5">Nội dung</td>
            <td class="row-8"><?php echo lang('backend.status');?></td>
            <td class="row-9">
            </td>
        </tr>
        <?php 
        $stt = 1; 
        foreach($comment_list as $row){ 
            $type="";
            $check="";
            if($row['Type'] == 1){
                $type = 'news';
                $check = $this->msite_news->getDataByID($row['News']);
            }elseif($row['Type'] == 2){
                $type = 'real';
                $check = $this->msite_real->getDataByID($row['News']);
            }
        ?>
        <tr class="row">
            <td class="row-1 text-align-center"><?php echo $stt;?></td>
            <td class="row-2 text-align-center"><?php echo $row['ID'];?></td>
            <td class="row-3"><a href="<?php echo base_url("admin/site_news_comment/edit/".$row['ID']);?>" title="<?php echo lang('backend.edit');?>" class="color-blue hover-underline"><?php echo 'Tên: ',$row['Name'],'<br />Email: ',$row['Email'];?></a></td>
            <td class="row-4"><a href="<?php echo base_url(_setURL($check['Name']).'-'.$type.'-'.$row['News'].'.html');?>" target="_blank" title="<?php echo $check['Name'];?>" class="color-blue hover-underline"><?php echo $check['Name'];?></a></td>
            <td class="row-5" width="30%"><?php echo _subStr($row['Content'],100);?></td>
            <td class="row-8"><?php if($row['Status'] == 1) echo "<div class=\"bntActive\"></div>";else echo "<div class=\"bntNoActive\"></div>";?></td>
            <td class="row-9">
                <a href="<?php echo base_url()."admin/site_news_comment/edit/".$row['ID'];?>" title="<?php echo lang('backend.edit');?>" class="bntEdit color-black hover-color-blue"><?php echo lang('backend.edit');?></a>
                <a href="<?php echo base_url()."admin/site_news_comment/delete/".$row['ID'];?>" onclick="if(confirm('<?php echo lang('backend.alertdelete');?>')) return true; else return false;" title="<?php echo lang('backend.delete');?>" class="bntDelete color-black hover-color-blue"><?php echo lang('backend.delete');?></a>
            </td>
        </tr>
        <?php $stt++; } ?>
    </table>
    <div class="clear-both"></div>
    <div class="pagination"><?php echo $this->pagination->create_links(); ?><div class="clear-both"></div></div>
    <div class="clear-both"></div>
</div>