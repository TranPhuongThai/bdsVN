<span class="header-title"><h2><?php echo ($real_title) ? $real_title : 'Nhà đất Bình Dương Giá rẻ';?></h2></span>
<ul class="news-list-3">
<?php foreach($real_list as $row){ ?>
    <li>
        <div class="col-sm-4">
            <a class="img" href="" title=""><img src="<?php echo $row['Thumb1'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/></a>    
        </div>
        <div class="col-sm-8">
            <div class="row-left m-row-left">
                <a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><h3><?php echo $row['Name'];?></h3></a>
                <span class="info"><?php echo $row['DName'];?> I <?php echo (int)($row['LandArea']);?> m2 I <?php echo $row['Legal'];?> I <?php echo _readMoney($row['Cost']) ?> triệu</span>
                <span class="desc"><?php echo $row['MainContent'];?></span>
            </div>
        </div>
        <div class="clearfix"></div>
    </li>
<?php } ?>
</ul>
<div class="clearfix"></div>
<nav>
    <ul class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </ul>
</nav>