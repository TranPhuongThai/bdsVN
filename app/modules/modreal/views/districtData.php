<ul class="news-list news-list-1 news-list-real">
<?php
    foreach($real_list as $row){
?>
    <li>
        <a href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
        <div class="clearfix"></div>
        <label>Giá</label><span>: 2,05 Tỷ</span>
    </li>
<?php
    }
?>