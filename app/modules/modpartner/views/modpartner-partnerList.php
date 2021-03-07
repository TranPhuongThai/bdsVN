<div class="module module-partner">
    <div class="title">
        Đối tác nhà đất Bình Dương
    </div>
    <div class="content">
        <ul>
        <?php $stt = 1; foreach($partner_list as $row){ ?>
            <li class="item-<?php echo $stt;?>">
                <a class="img" href="<?php echo $row['Link'];?>" target="_blank" title="<?php echo $row['Name'];?>"><img src="<?php echo $row['Img'];?>" alt="<?php echo $row['Name'];?>"/></a>
            </li>
        <?php $stt++;} ?>
        </ul>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>