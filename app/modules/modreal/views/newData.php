
<ul class="news-list-3">
<?php foreach($real_list as $row){ ?>
    <li>

    <div class="row">
        <div class="col-sm-8">
            <b><a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a></b>
        </div>
        <div class="col-sm-3 pull-right">
            <span class="news-date sale-news-date"><?php echo date("d/m/Y",strtotime($row['DateUp']));?></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="row-left m-row-left">
            <a class="img" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><img src="<?php echo $row['Thumb1'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/></a>    
        </div>    
    </div>
    <div class="col-sm-9 sale-news-list-detail">
        <div class="row description">
        aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa 
        </div>
        <div class="row">
            <label><span class="glyphicon glyphicon-tower"></span>&nbsp;&nbsp;</label> <?php echo (int)($row['LandArea']);?> m<sup>2</sup><br />
            <label><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;</label> <?php echo $row['DName'];?>, Bình Dương
        </div>
        <div class="row value">
        <label><b>Giá:</b></label><span class="font-bold"> <?php echo _readMoney($row['Cost']) ?></span><br />
        </div>
    </div>
    <div class="clearfix"></div>
    </li>
<?php } ?>
</ul>
<?php if(isset($paginator) && $paginator){ ?>
<ul class="pagination">
    <?php echo $this->pagination->create_links(); ?>
</ul>
<?php } ?>