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
                    <div class="header-title title-news">
                        Nhà đất Bình Dương Giá rẻ
                        <form>
                            <span>Sắp xếp theo</span>
                            <select name="fSortReal">
                                <option data-fSort="DateUp" data-fOrder="DESC">Thông thường</option>
                                <option data-fSort="ID" data-fOrder="DESC" <?php echo (isset($_COOKIE['fSort']) && $_COOKIE['fSort'] == 'ID' && $_COOKIE['fOrder'] == 'DESC') ? 'selected="selected"' : '';?>>Tin mới nhất</option>
                                <option data-fSort="Cost" data-fOrder="ASC" <?php echo (isset($_COOKIE['fSort']) && $_COOKIE['fSort'] == 'Cost' && $_COOKIE['fOrder'] == 'ASC') ? 'selected="selected"' : '';?>>Giá thấp nhất</option>
                                <option data-fSort="Cost" data-fOrder="DESC" <?php echo (isset($_COOKIE['fSort']) && $_COOKIE['fSort'] == 'Cost' && $_COOKIE['fOrder'] == 'DESC') ? 'selected="selected"' : '';?>>Giá cao nhất</option>
                                <option data-fSort="usableArea" data-fOrder="ASC" <?php echo (isset($_COOKIE['fSort']) && $_COOKIE['fSort'] == 'Area' && $_COOKIE['fOrder'] == 'ASC') ? 'selected="selected"' : '';?>>Diện tích nhỏ nhất</option>
                                <option data-fSort="usableArea" data-fOrder="DESC" <?php echo (isset($_COOKIE['fSort']) && $_COOKIE['fSort'] == 'Area' && $_COOKIE['fOrder'] == 'DESC') ? 'selected="selected"' : '';?>>Diện tích lớn nhất</option>
                            </select>
                        </form>
                    </div>
                    <?php echo $modreal->newData(10, 0, true);?>
                </div>
            </div>
            <div class="col-md-4 margin-top">
                <?php echo $zone->right2();?>
            </div>
        </div>
    </div>
    <?php echo $zone->bot();?>

</body>
</html>