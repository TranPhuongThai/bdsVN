<?php foreach($ads_list as $row){ ?>
    <a href="<?php echo $row['Link'];?>" target="_blank" rel="nofollow" title="<?php echo $row['Name'];?>"><?php echo _showAds($row['Img'],$row['Link'],$row['Name']);?></a>
<?php } ?>