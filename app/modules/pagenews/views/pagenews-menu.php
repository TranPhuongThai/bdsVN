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
            <div class="col-md-8 margin-top">
                <div class="row-left m-row-left">
                    <?php echo $modnews->newsMenu($menuid, 7, 0);?>
                </div>
            </div>
            <div class="col-md-4 margin-top">
                <?php echo $zone->right4();?>
            </div>
        </div>
    </div>
    <?php echo $zone->bot();?>

</body>
</html>