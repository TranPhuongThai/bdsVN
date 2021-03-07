<?php if($news_list){ ?>
<script src="<?php echo base_url();?>public/template-tiendv/plugin/excoloSlider/js/jquery.excoloSlider.js"></script>
<link href="<?php echo base_url();?>public/template-tiendv/plugin/excoloSlider/css/jquery.excoloSlider.css" rel="stylesheet" />
<span class="header-title title-<?php echo ($menu_check['Cls']) ? $menu_check['Cls'] : 'menu';?> m-margin-top"><a href="<?php echo base_url(_setURL($menu_check['Name']).'-mnews-'.$menu_check['ID']);?>.html"><?php echo $menu_check['Name'];?> nổi bật</a></span>
<div class="clearfix"></div>
<div class="wr_project">
    <div class="wr_slide">
        <div class="slideproject">
            <div id="sliderA" class="slider">
            <?php foreach($news_list as $row){ ?>
                <div>
                    <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>">
                        <img src="<?php echo $row['Img'];?>" alt="<?php echo $row['Name'];?>" />
                    </a>
                    <h4><a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a></h4>
                    <p><?php echo $row['MainContent'];?></p>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="thumbSlide margin-top">
        <div class="listproject">
        <?php $stt = 0; foreach($news_list as $row){ ?>
            <div rel="<?php echo $stt;?>" class="act item">
                <a class="tt_project col-xs-4" href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>">
                    <img class="avatar" src="<?php echo $row['Thumb1'];?>" alt="<?php echo $row['Name'];?>" />
                </a>
                <div class="info_project col-xs-8">
                    <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
                    <p><?php echo $row['MainContent'];?></p>
                </div>
                <div class="clearfix"></div>
            </div>
        <?php $stt++; } ?>
        </div>
    </div>
    <div class="clear"></div>
    <script>
        $(function () {
            $("#sliderA").excoloSlider();
        });
    </script>
</div>
<?php } ?>