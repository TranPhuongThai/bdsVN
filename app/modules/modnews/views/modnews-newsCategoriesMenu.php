<ul class="news-list news-list-1 news-list-categories">
</br>
<div class="header-title-news-categories">Danh mục tin tức</div>
<li class="<?php echo ($menu_root_check['ID'] == $menu_check['ID']) ? 'active' : '';?>"><a href="<?php echo base_url(_setURL($menu_root_check['Name']).'-mnews-'.$menu_root_check['ID']);?>.html"><?php echo $menu_root_check['Name'];?></a></li>
<?php foreach($menu_list as $row){ ?>
    <li class="<?php echo ($row['ID'] == $menu_check['ID']) ? 'active' : '';?>"><a href="<?php echo base_url(_setURL($row['Name']).'-mnews-'.$row['ID']);?>.html"><?php echo $row['Name'];?></a></li>
<?php } ?>
</ul>