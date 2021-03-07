
            <div class="main-slide col-md-6">
                <div id="carousel-top" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php $stt = 0; foreach($slide_list as $row){ ?>
                            <li data-target="#carousel-top" data-slide-to="<?php echo $stt;?>" class="<?php echo ($stt == 0) ? 'active' : '';?>"></li>
                        <?php $stt++;} ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php $stt = 0;foreach($slide_list as $row){ ?>
                        <div class="item <?php echo ($stt == 0) ? 'active' : '';?>">
                            <img data-src="<?php echo $row['Img'];?>" src="<?php echo $row['Img'];?>" alt="<?php echo $row['Name'];?>">
                        </div>
                        <?php $stt++;} ?>
                    </div>
                    <a class="left carousel-control" href="#carousel-top" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-top" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>