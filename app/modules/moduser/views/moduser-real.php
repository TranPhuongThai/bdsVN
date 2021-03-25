                <span class="header-title">
                    <span class="col-md-12 active">Tin rao của bạn</span>
                </span>
                <div class="content-static">
                    <?php echo $modtext->getTextNoTitle(6);?>
                    <div class="clearfix"></div>
                    <table class="table table-bordered margin-top">
                        <thead>
                            <tr>
                                <th width="60%">Tin rao</th>
                                <th>Ngày đăng</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($real_list as $row){ ?>
                            <tr>
                                <td><a href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" target="_blank"><?php echo $row['Name'];?></a></td>
                                <td><?php echo $row['Dateset'];?></td>
                                <td><?php echo ($row['Status'] == 1) ? 'Hiển thị' : 'Ẩn';?></td>
                                <td>
                                    <a href="<?php echo base_url('user/edit/'.$row['ID']);?>" title="Sửa"><span class="glyphicon glyphicon-edit color-green"></span></a>
                                    <a href="<?php echo base_url('user/delete/'.$row['ID']);?>" title="Xóa" onclick="if(confirm('Bạn muốn xóa tin rao này!!!')) return true; else return false"><span class="glyphicon glyphicon-trash color-red"></span></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    
                    <ul class="pagination">
                        <?php echo $this->pagination->create_links(); ?>
                    </ul>
                </div>