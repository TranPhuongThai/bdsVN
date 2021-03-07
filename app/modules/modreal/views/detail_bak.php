<div class="module module-real-detail">
    <div class="title">
        <h1><strong><a href="<?php echo current_url();?>" title="<?php echo $real_check['Name'];?>"><?php echo $real_check['Name'];?></a></strong></h1>
        <div class="clear-both"></div>
    </div>
    <div class="content">
        <div class="content-left">
            <img src="<?php echo $real_check['Img'];?>" title="<?php echo $real_check['Name'];?>" alt="<?php echo $real_check['Name'];?>"/>
            <div class="clear-both"></div>
        </div>
        <div class="content-right">
            <div class="content-right-2">
                <span class="date">Ngày đăng: <?php echo _dataToDate($real_check['Dateset']);?></span>
                <span class="code">Mã tin: DA-<?php echo $real_check['ID'];?></span>
                <span class="street">Địa chỉ: <?php echo $real_check['Address'];?></span>
                <span class="direction">Danh mục: <?php echo $real_check['MName'];?></span>
                <span class="area">Diện tích: <?php echo $real_check['LandArea'];?></span>
                <span class="cost" style="display: none;">Giá: <?php echo _readMoney($real_check['Cost']);if($real_check['Unit'] == "m2")echo "/m2";?></span>
                <span class="state">Tình trạng: <?php echo $real_check['State'];?></span>
                <div class="clear-both"></div>
            </div>
        </div>
        <div class="content-bot">
            <div class="mtit">Nội dung tin rao</div>
            <?php echo $real_check['Content'];?>
            <div class="clear-both"></div>
        </div>
        <div class="commentNews">
            <div class="miniTit"><strong>Bình luận:</strong></div>
            <?php echo $modnews->postComment('real',$real_check['ID']);?>
            <div class="comment-list">
                <ul>
                <?php
                    $stt = 1; 
                    foreach($comment_list as $row){
                    if($stt == 5){
                        echo '<div class="comment-more">';
                    }
                    $comment_list_child = $this->mmodnews_site_news_comment->getNewsPIDData($real_check['ID'],$row['ID'],"DESC",99,0)
                ?>
                    <li <?php echo ($cls) ? 'class="item-'.$stt.' '.$cls.'"' : 'class="item-'.$stt.'"';?>>
                        <img src="/public/image/layout/comment.png"/>
                        <p class="info">
                            <span class="name"><?php echo strip_tags($row['Name']);?></span>
                            <span class="date"><?php echo _DataTimeToDateTime($row['Dateset']);?></span>
                            <span class="mcontent"><?php echo strip_tags($row['Content']);?></span>
                        </p>
                        <?php 
                            if($comment_list_child){
                            echo '<ul>';
                            $stt2 = 1; 
                            foreach($comment_list_child as $row2){
                        ?>
                        <li <?php echo 'class="item-'.$stt2.'"';?>>
                            <img src="/public/image/layout/comment.png"/>
                            <p class="info">
                                <span class="name"><?php echo strip_tags($row2['Name']);?></span>
                                <span class="date"><?php echo _DataTimeToDateTime($row2['Dateset']);?></span>
                                <span class="mcontent"><?php echo strip_tags($row2['Content']);?></span>
                            </p>
                        </li>
                        <?php 
                            ++$stt2;
                            }
                            echo '</ul>';
                            } 
                        ?>
                    </li>
                <?php 
                    ++$stt;
                    } 
                    if(count($comment_list) > 4){
                    echo '</div>';
                    }
                ?>
                </ul>
                <?php if(count($comment_list) > 4){ ?>
                <div class="viewmore-comment">
                    <a href="javascript: void(0)">Xem thêm</a>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>
<div class="module module-real-list">
    <div class="title">
        <div class="left">Tin liên quan</div>
        <div class="clear-both"></div>
    </div>
    <div class="content">
        <ul>
        <?php
            $stt = 1;
            foreach($real_list as $row){
        ?>
                <li class="item item-<?php echo $stt;?>">
                    <div class="left">
                        <a class="img" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><img src="<?php echo $row['Thumb1'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/></a>
                        <div class="clear-both"></div>
                    </div>
                    <div class="right">
                        <h3><a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a></h3>
                        <span class="mname"><strong>Danh mục</strong>: <?php echo $row['MName'];?></span>
                        <span class="area"><strong>Diện tích</strong>: <?php echo $row['LandArea'];?></span>
                        <span class="address"><strong>Khu vực</strong>: <?php echo $row['Address'];?></span>
                        <span class="state"><strong>Tình trạng</strong>: <?php echo $row['State'];?></span>
                        <div class="clear-both"></div>
                    </div>
                    <div class="clear-both"></div>
                </li>
        <?php
                if($stt == 1)
                    $stt = 2;
                else{
                    $stt = 1;
                    echo '<div class="clear-both"></div>';
                }
            }
        ?>
        </ul>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>
