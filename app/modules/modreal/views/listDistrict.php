<ul class="menu-real-estate">
<?php
    $stt = 1;
    foreach($district_list as $row){
?>
        <li class="item item-<?php echo $stt;?>">
            <h2><a href="<?php echo base_url('nha-dat-')._setURL($row['Name'])."-rd-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>">Nhà đất <?php echo $row['Name'];?></a></h2>
        </li>
<?php
        $stt ++;
    }
?>
</ul>