    <div class="news-detail margin-top">
    <span class="date pull-right"><?php echo $news_check['Dateset'];?></span> </br></br>
    <h1 class="news-title"><?php echo $news_check['Name'];?></h1>
    <!-- <div class="share "> -->
        <!-- <div class="g-plus"><div class="g-plusone" data-href="<?php echo base_url(_setURL($news_check['Name']).'-mnews-'.$news_check['ID']);?>.html" data-size="medium"></div></div> -->
        <!-- <div class="fb-like" data-href="<?php echo base_url(_setURL($news_check['Name']).'-mnews-'.$news_check['ID']);?>.html" data-share="false" data-send="true" data-layout="button_count" data-width="120" data-show-faces="true"></div> -->
    <!-- </div> -->
    <div class="clearfix"></div>
    <strong><?php echo $news_check['MainContent'];?></strong>
    <div class="news-detail-content">
        <?php echo $news_check['Content'];?>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="clearfix"></div>
    <div class="real-detail-maincontent margin-top-15">
        <div class="fb-comments" data-href="<?php echo base_url(_setURL($news_check['Name']).'-mnews-'.$news_check['ID']);?>.html" data-width="100%" data-numposts="10"></div>
    </div>
</div>
<span class="header-title title-menu margin-top"><a class="relative-news-title" href="<?php echo base_url(_setURL($news_check['MName']).'-mnews-'.$news_check['ID']);?>.html">Tin đăng cùng chuyên mục</a></span>
<div class="news-list-5">
    <ul class="col-sm-12">
    <?php foreach($news_list as $row){ ?>
        <li class="row m-row row-left">
            <div class="col-md-8 col-sm-7 row-left m-row-2">
                <a class="relative-news-item" href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>"><?php echo $row['Name'];?></a>
            </div>
        </li>
    <?php } ?>
</div>  


