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
    <?php echo $zone->top();?>
    <div class="wrapper">
        <div class="container">
            <div class="col-md-8 margin-top">
                <div class="row-left m-row-left">
                    <?php echo $modreal->detail($real_check['ID']);?>
                </div>
            </div>
            <div class="col-md-4 margin-top">
                <?php echo $zone->right5($real_check['District']);?>
            </div>
        </div>
    </div>
    <?php echo $zone->bot();?>

</body>
</html>