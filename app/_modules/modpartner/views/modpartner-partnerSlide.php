<div class="module module-partner">
    <div class="title">
        Đối tác nhà đất Bình Dương
    </div>
    <div class="content">
        <ul id="partnerSlide" class="jcarousel-skin-tango">
        <?php foreach($partner_list as $row){ ?>
                <li>
                    <a class="img" target="_blank" href="<?php echo base_url()."project/".$row['ID']."/"._setURL($row['Name']).".html";?>" title="<?php echo $row['Name'];?>"><img src="<?php echo $row['Img'];?>" alt="<?php echo $row['Name'];?>"/></a>
                    <a class="tit" target="_blank" href="<?php echo base_url()."project/".$row['ID']."/"._setURL($row['Name']).".html";?>" title="<?php echo $row['Name'];?>"><h2><?php echo _substr($row['Name'], 30);?></h2></a>
                </li>
        <?php } ?>
        </ul>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
    <script src="<?php echo base_url();?>public/slide/jcarousel/jquery.jcarousel.min.js" type="text/javascript" ></script>
    <link href="<?php echo base_url();?>public/slide/jcarousel/skin.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>public/slide/jcarousel/jquery.jcarousel.partner.js" type="text/javascript" ></script>
</div>