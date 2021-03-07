
<ul class="news-list-3">
<?php foreach($real_list as $row){ ?>
    <li>
        <div class="col-sm-3">
            <div class="row-left m-row-left">
                <a class="img" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><img src="<?php echo $row['Thumb1'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/></a>    
            </div>    
        </div>
        <div class="col-sm-9">
            <div class="row">
                <a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
                <label><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;Giá</label><span class="color-green font-bold">: <?php echo _readMoney($row['Cost']) ?></span><br />
                <label><span class="glyphicon glyphicon-tower"></span>&nbsp;&nbsp;Diện tích</label>: <?php echo (int)($row['LandArea']);?> m<sup>2</sup><br />
                <label><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Vị trí</label>: <?php echo $row['DName'];?>, Bình Dương
                <span class="news-date"><?php echo date("d/m/Y",strtotime($row['DateUp']));?></span>
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