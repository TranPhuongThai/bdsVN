<ul class="news-list news-list-1">
<?php
    foreach($news_list as $row){
?>
    <li>
        <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
    </li>
<?php
    }
?>
<!--
<div class="module module-news-newsHot">

    <div class="title">

        <?php echo lang('frontend.news_hot');?>

    </div>

    <div class="content">

        <ul class="content-news-hot">

        <?php

            $stt = 1;

            foreach($news_list as $row){

        ?>

            <li class="item item-<?php echo $stt;?>">

                <a class="img" href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><img src="<?php echo $row['Thumb1'];?>" alt="<?php echo $row['Name'];?>" title="<?php echo $row['Name'];?>"/></a>

                <h4><a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a></h4>

                <span class="date"><?php echo _dataToDate($row['Dateset']);?></span>

                <div class="clear-both"></div>

            </li>

        <?php

                ++$stt;

            }

        ?>

        </ul>

        <a class="viewmore" href="<?php echo base_url()."news";?>"><?php echo lang('frontend.viewmore');?> &raquo;</a>

        <div class="clear-both"></div>

    </div>

    <div class="clear-both"></div>

</div>
-->