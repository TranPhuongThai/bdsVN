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
                <?php echo $modtext->getText($id);?>
            </div>
        </div>
    </div>
    <?php echo $zone->bot();?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/docs.min.js"></script>
    <script src="public/js/script.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="public/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>