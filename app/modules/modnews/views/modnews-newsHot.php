<ul class="news-list-4-1 col-sm-6 col-xs-12">
    <li>
        <a href="<?php echo base_url()._setURL($news_list[0]['Name'])."-news-".$news_list[0]['ID'].".html";?>" title="<?php echo $news_list[0]['Name'];?>">
            <img src="<?=$news_list[0]['Img']?>" width="100%" alt="" title=""/>
            <strong><?php echo $news_list[0]['Name'];?></strong>
            
        </a>
        <p><?php echo $news_list[0]['MainContent'];?>...&nbsp;<a href="<?php echo base_url()._setURL($news_list[0]['Name'])."-news-".$news_list[0]['ID'].".html";?>">Xem thêm</a></p>
        
    </li>
</ul>
<ul class="news-list-4-2 col-sm-6 col-xs-12">
<?php
$i = 0;
foreach($news_list as $row){
    if ($i == 0) {
        $i++;
        continue;
        // echo '<img src="' . $row['Img'] .'">';
    }
?>
    <li>
        <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
    </li>
<?php
    $i++;
}   
?>
</ul>
<!-- <ul class="news-list news-list-1"> -->

