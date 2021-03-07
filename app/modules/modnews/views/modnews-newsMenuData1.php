<?php if(isset($news_list[0])){ ?>
<span class="header-title title-<?php echo ($menu_check['Cls']) ? $menu_check['Cls'] : 'menu';?> margin-top"><a href="/<?php echo _setURL($menu_check['Name']).'-mnews-'.$menu_check['ID'];?>.html"><?php echo $menu_check['Name'];?></a></span>
<div class="news-list-4">
    <ul class="news-list-4-1 col-sm-6 col-xs-12">
        <li>
            <a href="<?php echo base_url()._setURL($news_list[0]['Name'])."-news-".$news_list[0]['ID'].".html";?>">
                <img src="<?php echo $news_list[0]['Thumb1'];?>" width="100%" alt="<?php echo $news_list[0]['Name'];?>" title="<?php echo $news_list[0]['Name'];?>"/>
                <strong><?php echo $news_list[0]['Name'];?></strong>
            </a>
        </li>
    </ul>
    <ul class="news-list-4-2 col-sm-6 col-xs-12">
        <?php 
        $stt = 1;
        foreach($news_list as $row){ 
            if($stt == 1){
                $stt++;
                continue;
            }
        ?>
        <li>
            <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>"><?php echo $row['Name'];?></a>
        </li>
        <?php } ?>
    </ul>
    <div class="clearfix"></div>
</div>
<?php } ?>