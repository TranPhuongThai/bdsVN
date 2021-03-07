<span class="header-title"><?php echo $menu_check['Name'];?></span>
<ul class="news-list-3">
<?php foreach($news_list as $row){ ?>
    <li>
        <div class="col-sm-4">
            <a class="img" href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title=""><img src="<?php echo $row['Thumb1'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/></a>    
        </div>
        <div class="col-sm-8">
            <div class="row-left m-row-left">
                <a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
                <span class="desc"><?php echo $row['MainContent'];?></span>
            </div>
        </div>
        <div class="clearfix"></div>
    </li>
<?php } ?>
</ul>
<div class="clearfix"></div>
<nav>
    <ul class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </ul>
</nav>