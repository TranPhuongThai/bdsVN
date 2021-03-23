<ul class="news-list news-list-1">
<?php
$i = 0;
foreach($news_list as $row){
    if ($i == 0) {
        echo '<img src="' . $row['Img'] .'">';
    }
?>
    <li>
        <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
    </li>
<?php
    $i++;
}   
?>