
<ul>
    <?php
        foreach($support_list as $row){
    ?>
    <li>
        <div class="name"><?php echo $row['Name'];?></div>
        <div class="email"><a rel="nofollow" href="mailto:<?php echo $row['Email'];?>"><?php echo $row['Email'];?></a></div>
        <?php if($row['Yahoo']){ ?>
        <div class="yahoo">
            <a rel="nofollow" href="ymsgr:sendim?<?php echo $row['Yahoo'];?>">
				<img title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>" align="absmiddle" border="0" src="http://opi.yahoo.com/online?u=<?php echo $row['Yahoo'];?>&m=g&t=1&l=us"/>
			</a>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
        <div class="phone"><?php echo $row['Phone'];?></div>
        <div class="clearfix"></div>
    </li>
    <?php
        }
    ?>
</ul>