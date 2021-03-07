<div class="module module-support-top">

    <!--<script type="text/javascript" src="//cdn.dev.skype.com/uri/skype-uri.js"></script>-->

    <?php

        $stt = "first";

        foreach($support_list as $row){

    ?>

        <div class="item item-<?php echo $stt;?>">

            <div class="name"><?php echo $row['Name'];?></div>
            <?php if($row['Yahoo']){ ?>
            <div class="yahoo">

                <a rel="nofollow" href="ymsgr:sendim?<?php echo $row['Yahoo'];?>">

					<img alt="<?php echo $row['Name'];?>" title="<?php echo $row['Name'];?>" align="absmiddle" border="0" src="http://opi.yahoo.com/online?u=<?php echo $row['Yahoo'];?>&m=g&t=1&l=us"/>

				</a>

            </div>
            <?php } ?>

            <div class="clear-both"></div>

            <div class="phone"><?php echo $row['Phone'];?></div>

            <!--

            <div class="skype">

                <div id="SkypeButton_Chat_<?php echo $row['Skype'];?>_1">

                  <script type="text/javascript">

                    Skype.ui({

                      "name": "chat",

                      "element": "SkypeButton_Chat_<?php echo $row['Skype'];?>_1",

                      "participants": ["<?php echo $row['Skype'];?>"]

                    });

                  </script>

                </div>

            </div>

            -->

            <div class="email"><a rel="nofollow" href="mailto:<?php echo $row['Email'];?>"><?php echo $row['Email'];?></a></div>

            <div class="clear-both"></div>

        </div>

    <?php

            $stt = "second";

        }

    ?>

    <div class="clear-both"></div>

</div>