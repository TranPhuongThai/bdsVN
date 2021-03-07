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
</head>

<body role="document">

    <!-- Fixed navbar -->
    <?php echo $zone->top($menu);?>
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <div class="text-center">
                    <br />
                    <img src="/public/image/404.png" alt="404 not found"/>
                    <div style="font-size: 20px;color: #23bcea;padding-bottom: 15px;">Chúng tôi rất xin lỗi nhưng</div>
                    <span style="font-size: 15px;line-height: 22px;">Trang bạn tìm kiếm không tồn tại. Vui lòng liên hệ với quản lý website để biết thêm chi tiết. 
                    <br />Chân thành cảm ơn bạn đã sử dụng website!</span>
                    <br />Hệ thống sẽ tự động chuyển về trang chủ sau. 10 giây
                    <br /><br /><br /><br /><br /><br /><br />
                    <script type="text/javascript">
                        setTimeout("window.location.href=\"<?php echo base_url();?>\";", 10000);
                    </script>
                </div>
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