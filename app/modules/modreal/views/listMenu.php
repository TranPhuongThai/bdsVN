<ul class="menu-real-estate">
<?php
    $stt = 1;
    foreach($menu_list as $row){
?>
        <li class="item item-<?php echo $stt;?>">
            <h2><a href="<?php echo base_url()._setURL($row['Name'])."-rm-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a></h2>
        </li>
<?php
        $stt ++;
    }
?>
</ul>