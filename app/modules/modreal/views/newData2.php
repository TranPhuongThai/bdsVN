<div class="news-list-10">
<?php foreach($real_list as $row){ ?>
    <div class="col-md-3 col-sm-6">
        <div class="col-sm-12 box-shadow">
            <div class="row m-row">
                <a class="img" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><img src="<?php echo $row['Thumb1'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/></a>    
                
            </div>
            <a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>    
            <span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Vị trí: <?php echo $row['DName'];?>
        <!-- </div> -->
        
            <div class="row detail">
                <div class=" col-sm-6">
                    <label><span class="glyphicon glyphicon-tower"></span>&nbsp;&nbsp;Diện tích</label>: <?php echo (int)($row['LandArea']);?> m<sup>2</sup>
                </div>
                <div class=" col-sm-6">
                <label><span class="glyphicon glyphicon-tower"></span>&nbsp;&nbsp;Hướng</label>: <?php echo $row['Direction'] == "lang('backend.all')"?"":$row['Direction'];?>
                </div>
                <div class="col-sm-12 cast">
                    <label><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;Giá</label><span class="font-bold">: <?php echo $row['Cost']?_readMoney($row['Cost']):"Thương lượng"; ?></span>
                </div>
            <!-- , Bình Dương<br /> -->
                <br />
                
                
            </div>
            <div class="row foot">
            <div class=" col-sm-6">
                    <i class="glyphicon glyphicon-calendar"></i>&nbsp;&nbsp;<span class="news-date"><?php echo date("d/m/Y",strtotime($row['DateUp']));?></span>
                </div>
                <div class=" col-sm-6">
                <i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;<span class="news-date"><?php echo $row['Hit'];?></span>
                </div>
            
            </div>
        </div>
        <!-- <div class="clearfix"></div> -->
    </div>
<?php } ?>
</div>
<!-- <ul class="news-list-3">
<?php foreach($real_list as $row){ ?>
    <li>
        <div class="col-sm-4">
            <a class="img" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title=""><img src="<?php echo $row['Thumb1'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/></a>    
        </div>
        <div class="col-sm-8">
            <div class="row-left m-row-left">
                <a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
                <span class="info"><?php echo $row['DName'];?> I <?php echo (int)($row['LandArea']);?> m2 I <?php echo $row['Legal'];?> I <?php echo _readMoney($row['Cost']) ?> triệu</span>
                <span class="desc"><?php echo $row['MainContent'];?></span>
            </div>
        </div>
        <div class="clearfix"></div>
    </li>
<?php } ?>
</ul> -->