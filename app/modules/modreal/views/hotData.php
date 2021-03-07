
<ul class="news-list-2">
<?php foreach($real_list as $row){ ?>
    <li class="col-sm-3">
        <div class="row-left m-row-left">
            <a href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>">
                <img src="<?php echo $row['Thumb1'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/>
                <span class="name"><?php echo $row['Name'];?></span>
            </a>
            <span>Khu vực: <?php echo $row['DName'];?></span>
            <span>Diện tích: <?php echo (int)($row['LandArea']);?> m2</span>
            <span>Giấy tờ: <?php echo $row['Legal'];?></span>
            <span>Giá: <?php echo _readMoney($row['Cost']) ?></span>
        </div>
    </li>
<?php } ?>
</ul>