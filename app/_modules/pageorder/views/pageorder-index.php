<?php
/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox
 * @copyright 2013
 */
//echo '<pre>',print_r($seo),'</pre>';exit;
?>
<?php echo $zone->head($seo);?>
<body>
    <div id="body">
    <div class="wrap wrap-order">
        <?php echo $zone->top($menu);?>
        <div id="z-mid">
            <div class="z-content">
                <?php echo $zone->leftHome();?>
                <div id="z-right">
                    <?php echo $modcontact->orderSendMail();?>
                </div>
                <div class="clear-both"></div>
            </div>
            <div class="clear-both"></div>
        </div>
        <?php echo $zone->bot();?>
        <div class="clear-both"></div>
    </div>
    </div>
</body>
</html>