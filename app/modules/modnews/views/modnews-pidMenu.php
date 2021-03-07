<div class="module module-menu module-news-allMenu module-news-allMenu-<?php echo $stt;?>">
    <div class="title">
        <h2><a href="<?php echo base_url()._setURL($menu_check['Name']).'-mnews-'.$menu_check['ID'].'.html';?>"><?php echo $menu_check['Name'];?></a></h2>
    </div>
    <div class="content">
        <ul>
            <?php
                $stt = 1;
                foreach($menu_child as $row){
            ?>
                <li>
                    <a href="<?php echo base_url()._setURL($row['Name'])."-mnews-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>">
                        <?php echo $row['Name'];?>
                    </a>
                </li>      
            <?php
                    ++$stt;
                }
            ?>
            <div class="clear-both"></div>
        </ul>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>