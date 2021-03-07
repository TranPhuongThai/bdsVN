
                    <ul class="news-list">
                    <?php
                        foreach($news_list as $row){
                    ?>
                        <li>
                            <a href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
                            <span><?php echo $row['MName'];?></span>
                        </li>
                    <?php
                        }
                    ?>
                    </ul>