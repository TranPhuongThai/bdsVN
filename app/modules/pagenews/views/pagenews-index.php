<?php

/**

 * @author Do Van Tien

 * @email dovantien2911@gmail.com 

 * @company Webbox

 * @copyright 2015

 */

?><!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $zone->head($seo, $link_canonical);?>
</head>

<body role="document">

    <!-- Fixed navbar -->
    <?php echo $zone->top($menu);?>
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-8">
                    <div class="row">
                        <?php echo $modnews->allNews();?>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php echo $zone->right2();?>
                </div>
            </div>
        </div>
    </div>
    <?php echo $zone->bot();?>
</body>
</html>