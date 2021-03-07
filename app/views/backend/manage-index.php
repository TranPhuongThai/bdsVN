<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */
 
?>

<div class="content content-home padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <div class="section-left float-left">
        <?php foreach($menu_index as $row){ ?>
            <div class="item text-align-center background-color-fff border-1 border-style-solid border-color-ccc border-radius-5 hover-border-shadow _gradient-fff-eee hover-gradient-fff-eee">
                <a href="<?php echo base_url()."admin/".$row['Link'];?>" class="block no-underline text-align-center">
                    <img src="<?php if($row["Img"]) echo $row["Img"]; else echo base_url()."public/i/system/j_login_lock.png" ;?>"/><br />
                    <span class="color-black-3 font-weight-bold font-size-11"><?php echo $row["Name"];?></span>
                </a>
            </div>
        <?php } ?>
        <div class="clear-both"></div>
    </div>
    <div class="section-right float-right">
        <table border="0" cellpadding="0" cellspacing="0" class="table-list-item">
            <tr class="head">
                <td class="row-1" colspan="2"><?php echo lang("backend.statistics");?></td>
                <td class="row-2" colspan="2"><?php echo lang("backend.data");?></td>
            </tr>
            <tr class="row">
                <td style="text-align: left"><?php echo lang("backend.online");?></td>
                <td><?php echo $online;?></td>
                
                <td style="text-align: left">Bài viết</td>
                <td><?php echo $news_sum;?></td>
            </tr>
            <tr class="row">
                <td style="text-align: left"><?php echo lang("backend.today");?></td>
                <td><?php echo $online_today;?></td>
                
                <td style="text-align: left">Công trình</td>
                <td><?php echo $real_sum;?></td>
            </tr>
            <tr class="row">
                <td style="text-align: left"><?php echo lang("backend.this_month");?></td>
                <td><?php echo $online_this_month;?></td>
                
                <td style="text-align: left">Thành viên</td>
                <td><?php echo $user_sum;?></td>
            </tr>
            <tr class="row">
                <td style="text-align: left"><?php echo lang("backend.total");?></td>
                <td><?php echo $online_sum;?></td>
                
                <td style="text-align: left"></td>
                <td></td>
            </tr>
            </tr>
        </table>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>