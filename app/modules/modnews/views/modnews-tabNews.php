<div class="module module-news-tabNews">

    <div id="tabs">

        <ul class="title-tabs">

            <?php
                $sttMenu = 1;
                foreach($menu_list as $row){

            ?>

                    <li class="tabs-<?php echo $row['ID']; echo ($sttMenu==1)? ' active' : '';?>" index-tab="tabs-<?php echo $row['ID'];?>">

                        <h3>

                                <?php echo $row['Name'];?>

                        </h3>

                    </li>

            <?php
                $sttMenu++;

                }

            ?>

        </ul>

        <?php
            $sttMenu = 1;
            foreach($menu_list as $row){

        ?>

            <div id="tabs-<?php echo $row['ID'];?>" class="content-tabs<?php echo ($sttMenu==1)? ' active' : '';?>">

                <ul class="content-news-list">

                    <?php

                        $stt = 1;
                        $numSTT = 1;

                        foreach($row['news_list'] as $news){
                            if($numSTT > 4){
                                continue;
                            }

                    ?>

                        <li class="item-<?php echo $stt;?> itemSTT-<?php echo $numSTT;?>">

                            <div class="left">

                                <div class="img"><a href="<?php echo base_url()._setURL($news['Name'])."-news-".$news['ID'].".html";?>" title="<?php echo $news['Name'];?>"><img src="<?php echo $news['Thumb1'];?>" alt="<?php echo $news['Name'];?>" title="<?php echo $news['Name'];?>"/></a></div>

                            </div>

                            <div class="right">
    
                                <div class="text-top">
    
                                    <h4><a class="tit" href="<?php echo base_url()._setURL($news['Name'])."-news-".$news['ID'].".html";?>" title="<?php echo $news['Name'];?>"><?php echo $news['Name'];?></a></h4>
    
                                    <span class="date"><?php echo _dataToDate($news['Dateset']);?></span>
    
                                    <p class="maincontent"><?php echo $news['MainContent'];?></p>
    
                                </div>
    
                                <a class="readmore" href="<?php echo base_url()._setURL($news['Name'])."-news-".$news['ID'].".html";?>" title="<?php echo $news['Name'];?>"><?php echo lang('frontend.readmore');?> &raquo;</a>

                            </div>

                            <div class="clear-both"></div>

                        </li>

                    <?php
                            $numSTT++;
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
                
                <ul class="content-news-list-2">

                    <?php

                        $numSTT = 1;

                        foreach($row['news_list'] as $news){
                            if($numSTT <= 4){
                                $numSTT++;
                                continue;
                            }

                    ?>

                        <li class="itemSTT-<?php echo $numSTT;?>">

                            <h4><a class="tit" href="<?php echo base_url()._setURL($news['Name'])."-news-".$news['ID'].".html";?>" title="<?php echo $news['Name'];?>"><?php echo $news['Name'];?></a></h4>

                        </li>

                    <?php
                            $numSTT++;

                        }

                    ?>

                </ul>

                <div class="clear-both"></div>

            </div>

        <?php

                $sttMenu++;

            }

        ?>

    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            $( "#tabs .title-tabs li" ).click(function(){

                var tabId = $(this).attr('index-tab');
                $( "#tabs .title-tabs li" ).removeClass('active');
                $(this).addClass('active');
                
                $( "#tabs .content-tabs" ).removeClass('active');
                $( "#tabs .content-tabs#"+tabId ).addClass('active');

            });

        })

    </script>

    <div class="clear-both"></div>

</div>