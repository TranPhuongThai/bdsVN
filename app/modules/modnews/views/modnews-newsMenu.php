<ul class="menu-news-list">
<li class="<?php echo ($menu_root_check['ID'] == $menu_check['ID']) ? 'active' : '';?>"><a href="<?php echo base_url(_setURL($menu_root_check['Name']).'-mnews-'.$menu_root_check['ID']);?>.html"><?php echo $menu_root_check['Name'];?></a></li>
<?php foreach($menu_list as $row){ ?>
    <li class="<?php echo ($row['ID'] == $menu_check['ID']) ? 'active' : '';?>"><a href="<?php echo base_url(_setURL($row['Name']).'-mnews-'.$row['ID']);?>.html"><?php echo $row['Name'];?></a></li>
<?php } ?>
</ul>
<?php
if(!isset($news_list)){
    foreach($menu_list as $row){
        echo $modnews->newsMenuData1($row['ID'], 5, 0);
    }
}else{
?>
<span class="header-title title-<?php echo ($menu_check['Cls']) ? $menu_check['Cls'] : 'pt';?> margin-top"><a href="<?php echo base_url(_setURL($menu_check['Name']).'-mnews-'.$menu_check['ID']);?>.html"><?php echo $menu_check['Name'];?></a></span>
<div class="news-list-5">
    <ul class="col-sm-12">
        <?php foreach($news_list as $row){ ?>
        <li class="row m-row row-left">
            <div class="col-md-4 col-sm-5 text-center">
                <img src="<?php echo $row['Thumb1'];?>" width="100%" alt="<?php echo $row['Name'];?>" title="<?php echo $row['Name'];?>"/>
            </div>
            <div class="col-md-8 col-sm-7 row-left m-row-2">
                <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>"><strong><?php echo $row['Name'];?></strong></a>
                <p><?php echo $row['MainContent'];?></p>
            </div>
        </li>
        <?php } ?>
        <li>
            <ul class="pagination">
                <?php echo $this->pagination->create_links(); ?>
            </ul>
        </li>
    </ul>
</div>
<?php
}
?>    
