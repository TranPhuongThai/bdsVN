<div id="z-slide">

    <div class="z-content">

        <?php 

            $district = (isset($district)) ? $district : '';
            $rmenu = (isset($rmenu)) ? $rmenu : '';
            $direction = (isset($direction)) ? $direction : '';
            $area = (isset($area)) ? $area : '';
            $cost = (isset($cost)) ? $cost : '';
            
            echo $modreal->form($district, $rmenu, $direction, $area, $cost);

            echo $modslide->transBanner();

            echo $modnews->listNews();

        ?>

    </div>

    <div class="clear-both"></div>

</div>