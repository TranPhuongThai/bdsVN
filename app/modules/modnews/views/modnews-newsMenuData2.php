<?php if(isset($news_list[0])){ ?>
<div class="row-left m-row-2">
    <div class="news-list-5-content">
<?php 
$stt = 0;
foreach($news_list as $row){ 
    if($stt < 2){ ?>
        <div class="col-md-6 col-xs-6">
            <ul class="news-list-4-1">
                <li>
                    <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>">
                        <img src="<?php echo $row['Thumb1'];?>" width="100%" alt="<?php echo $row['Name'];?>" title="<?php echo $row['Name'];?>"/>
                        <strong><?php echo $row['Name'];?></strong>
                    </a>
                    <p><?php echo $row['MainContent'];?>...&nbsp;<a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>">Xem thêm</a></p>
                </li>
            </ul>    
        </div>
                
    <?php
    }else{?>
        <div class="col-md-6 col-xs-6">
            <ul class="news-list-5-2">
                <li>
                    <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>">
                        <img src="<?php echo $row['Thumb1'];?>" alt="<?php echo $row['Name'];?>" title="<?php echo $row['Name'];?>"/>
                        <strong><?php echo $row['Name'];?></strong>
                    </a>
                </li>
            </ul>
        </div>
    <?php }
        $stt++;?>
<?php } ?>
    </div>
    <div class="clearfix"></div>
</div>



<?php } ?>