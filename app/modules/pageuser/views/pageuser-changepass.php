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
    <?php echo $zone->head($seo);?>
    <meta name="robots" content="noindex, nofollow">
</head>

<body role="document">

    <!-- Fixed navbar -->
    <?php echo $zone->top($menu);?>
    <div class="wrapper">
        <div class="container user-page">
            <div class="col-md-12">
                <div class="col-md-3">
                    <?php echo $zone->leftUser('changepass');?>
                </div>
                <div class="col-md-9 col-sm-6 m-margin-top">
                    <?php echo $moduser->changepass();?>
                </div>
            </div>
        </div>
    </div>
    <?php echo $zone->bot();?>
</body>
</html>