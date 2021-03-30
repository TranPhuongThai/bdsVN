                <div class="row m-row margin-top">
                    <table class="table table-bordered addition-information">
                        <thead class="text-left">
                            <tr>
                                <th colspan="2">Các thông tin khác</th >
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span>Mã tin</span><label class="value pull-right">value</label></td>
                                <td><span>Hướng</span><label class="value pull-right">value</label></td>
                            </tr>
                            <tr>
                                <td><span>Loại tin</span><label class="value pull-right">value</label></td>
                                <td><span>Đường trước nhà</span><label class="value pull-right">value</label></td>
                            </tr>
                            <tr>
                                <td><span>Loại BDS</span><label class="value pull-right">value</label></td>
                                <td><span>Pháp lý</span><label class="value pull-right">value</label></td>
                            </tr>
                            <tr>
                                <td><span>Chiều ngang</span><label class="value pull-right">value</label></td>
                                <td><span>Số lầu</span><label class="value pull-right">value</label></td>
                            </tr>
                            <tr>
                                <td><span>Chiều dài</span><label class="value pull-right">value</label></td>
                                <td><span>Số phòng ngủ</span><label class="value pull-right">value</label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row m-row margin-top">
                    <span class="header-title title-support comment-title"><span>BÌNH LUẬN</span></span>
                    <input type="text" class="form-control" name="comment">
                    <div class="row submit-comment">
                        <button class="btn btn-success btn-sm pull-right submit-comment-btn">Đăng</button>
                    </div>
                    <ul class="local-comment-list">
                        <?php foreach ($comments as $comment) { ?>
                            <li>
                            <div class="row">
                                <div class="col-sm-1">
                                    <!-- <div class="row-left m-row-left"> -->
                                        <image class="image" src="https://i.pinimg.com/originals/3a/69/ae/3a69ae3942d4a9da6c3cbc93b1c8f051.jpg">
                                    <!-- </div> -->
                                </div> 

                                <div class="col-sm-8">
                                    <div class="row user-name"><?= $comment['Name']?></div>
                                    <div class="row"><?= $comment['Content']?></div>
                                </div>   
                                </div> 
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="row m-row margin-top">
                    <span class="header-title title-support same-title"><span>Nhà đất cùng chuyên mục</span></span>
                    <div class="clearfix"></div>
                    <?php echo $modreal->userNewlist($district, 6, 0);?>
                    <div class="clearfix"></div>
                </div>

                <div class="row m-row margin-top">
                    <div class="qcao-right">
                        <?php echo $modads->detail(5);?>
                    </div>                  
                </div>