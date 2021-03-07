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
        <div class="container">
            <div class="col-md-12">
                <?php echo $moduser->active();?>
            </div>
        </div>
    </div>
    <?php echo $zone->bot();?>
</body>
</html>