<div class="module module-menu module-news-allMenu">

    <div class="title">

        <h2>Lĩnh vực hoạt động</h2>

    </div>

    <div class="content">

        <ul id="browser" class="treeview">

            <?php

                $stt = 1;

                foreach($menu_list as $row){

            ?>

                <li><?php echo (!$row['menu_child']) ? '<a href="'.base_url()._setURL($row['Name']).'-mnews-'.$row['ID'].'.html" title="'.$row['Name'].'">' : '<span>';?><?php echo $row['Name'];?><?php echo (!$row['menu_child']) ? '</a>' : '</span>';?>

                <?php

                    if($row['menu_child']){

                        echo '<ul>';

                        foreach($row['menu_child'] as $child){

                ?>

                    <li class="item">

                        <h3>

                            <a href="<?php echo base_url()._setURL($child['Name'])."-mnews-".$child['ID'].".html";?>" title="<?php echo $child['Name'];?>">

                                <?php echo $child['Name'];?>

                            </a>

                        </h3>

                    </li>    

                <?php

                        } 

                        echo '</ul>';

                    } 

                ?>  

                </li>      

            <?php

                    ++$stt;

                }

            ?>

            <div class="clear-both"></div>

        </ul>

        <div class="clear-both"></div>

    </div>

    <link href="<?php echo base_url();?>public/menu/tree/jquery.treeview.css" rel="stylesheet" />

    <script src="<?php echo base_url();?>public/menu/tree/jquery.cookie.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>public/menu/tree/jquery.treeview.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>public/menu/tree/jquery.treeview.menu.js" type="text/javascript"></script>

    <div class="clear-both"></div>

</div>