
<ul class="news-list">
<?php
    foreach($news_list as $row){
?>
    <li>
        <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
    </li>
<?php
    }
?>
</ul>
<!--
<div class="module module-news-list module-news-newsMenu">

    <div class="title">

        <div class="left">

            <h2>Tin tức nhà đất</h2>

        </div>

        <div class="clear-both"></div>

    </div>

    <div class="content">

        <ul class="content-news-list">

            <?php

                $stt = 1;

                foreach($news_list as $row){

            ?>

                    <li class="item-<?php echo $stt;?>">

                        <div class="left">

                            <div class="img"><a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><img src="<?php echo $row['Thumb1'];?>" alt="<?php echo $row['Name'];?>" title="<?php echo $row['Name'];?>"/></a></div>

                        </div>

                        <div class="right">

                            <div class="text-top">

                                <h4><a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a></h4>

                                <span class="date"><?php echo _dataToDate($row['Dateset']);?></span>

                                <p class="maincontent"><?php echo $row['MainContent'];?></p>

                            </div>

                            <a class="readmore" href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo lang('frontend.readmore');?> &raquo;</a>

                        </div>

                        <div class="clear-both"></div>

                    </li>

            <?php

                    if($stt == 1){

                        $stt = 2;

                    }else{

                        $stt = 1;

                        echo '<div class="clear-both"></div>';

                    }

                }

            ?>

            <div class="clear-both"></div>

        </ul>

        <div class="clear-both"></div>

    </div>

    <div class="clear-both"></div>

</div>
-->