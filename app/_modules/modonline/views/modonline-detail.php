<div class="module module-online">
    <div class="title"><?php echo lang('frontend.statistic');?> Nhà Đất Dĩ An</div>
    <div class="content">
        <div class="online_sum hidden">
            <?php
                for($i = 0; $i<strlen($online_sum); $i++){
                    echo '<span>',$online_sum[$i],'</span>';
                }
            ?>
        </div>
        <div class="online"><span class="left"><?php echo lang('frontend.online');?></span><span class="right"><?php echo _showMoney((int)$online);?></span></div>
        <div class="online_today"><span class="left">Hôm nay</span><span class="right"><?php echo _showMoney((int)$online_today);?></span></div>
        <div class="online_yesterday hidden"><span class="left">Hôm qua</span><span class="right"><?php echo _showMoney((int)$online_yesterday);?></span></div>
        <div class="online_this_month"><span class="left">Tổng truy cập</span><span class="right"><?php echo _showMoney((int)$online_sum);?></span></div>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>