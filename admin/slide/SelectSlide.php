
    <?php
        include("../connection.ini");
        $sql = "select * from slide order by sliSort";
        $result = mysqli_query($conn, $sql);
    ?>
<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Trình chiếu
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Quản trị</a>
                </li>
                <li class="active">
                    <i class="fa fa-suitcase"></i> Trình chiếu
                </li>
            </ol>
        </div>
    </div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <h2>Danh sách trình chiếu</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                       <th>Tiêu đề</th>
                        <th>Ảnh</th>
                        <th>Hiển thị</th>
                        <th>Thứ tự hiển thị</th>
                        <th colspan="2" class="text-center"><a href="void(0)" class="btn btn-default" data-toggle="modal" data-target="#Createslideshow"><i class="fa fa-plus"></i> Thêm mới</a>
                            <!-- modals create -->
                        <!-- Modal -->
                            <div class="modal fade" id="Createslideshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Thêm mới trình chiếu</h4>
                                  </div>
                                  <form action="?mod=slide&act=new" class="form-horizontal" method="post" enctype="multipart/form-data">
                                  <div class="modal-body">
                                    <div class="">
                                        <div class="col-md-10 col-md-offset-1">
                                            <?php 
                                                if(isset($error)) {
                                                    echo '<li>' . $error . '</li>';
                                                }
                                             ?>
                                            <div class="form-group">
                                                <label>Tiêu đề slide mới:</label>
                                                <input class="form-control" type="text" name="sliTitle" required="" id="txtInput"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Tùy chọn hiển thị:</label>
                                                <div class="">
                                                    <input class="col-md-1" type="radio" name="sliShow" value="1" checked="true" /> <span class="col-md-3 radio-btn">Hiển thị</span>
                                                    <input class="col-md-1 col-md-offset-3" type="radio" name="sliShow" value="0" /> <span class="col-md-4 radio-btn">Không hiển thị</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Thứ tự hiển thị:</label>
                                                <input class="form-control" type="number" step="1" min="1" max="100" name="sliSort" id="txtInput" value="1"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Ảnh</label>
                                                <input class="form-control" type="file" name="sliImage" required="" id="txtInput"/>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="reset" name="reset" value="Nhập lại" class="btn btn-default">Nhập lại</button>
                                    <button  type="submit" name="addNew" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        <!-- end Modals create -->
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    ?>
                    <tr>
                        <td><?php echo $row["sliTitle"]; ?></td>
            <td><img src="../image/<?php echo $row["sliImage"]; ?>" width="200px" title="Slide Show" alt="Slide Show"/></td>
            <td><?php if($row["sliShow"]==1) {?> Có <?php }else{ ?> Không <?php }?></td>
            <td><?php echo $row["sliSort"]; ?></td>
            <td><a href="void(0)" data-toggle="modal" data-target="#editCategory_<?php echo $row["sliID"]; ?>"><i class="fa fa-pencil"></i> Sửa</a>
                <!-- Modal -->
                            <div class="modal fade" id="editCategory_<?php echo $row["sliID"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Chỉnh sửa trình chiếu</h4>
                                  </div>
                                  <form action="?mod=slide&act=edit&sliID=<?php echo $row["sliID"]; ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                  <div class="modal-body">
                                    <div class="">
                                        <div class="col-md-10 col-md-offset-1">
                                            <?php
                                                $result2 = mysqli_query($conn, "select * from slide where sliID='".$row["sliID"]."'");
                                                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                                if(isset($error)) {
                                                    echo '<li>' . $error . '</li>';
                                                }
                                             ?>
                                             <input type="hidden" name="sliID" value="<?php echo $row2["sliID"]; ?>"/>
                                            <div class="form-group">
                                                <label>Tiêu đề slide mới:</label>
                                                <input class="form-control" value="<?php echo $row2["sliTitle"]; ?>" type="text" name="sliTitle" required="" id="txtInput"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Tùy chọn hiển thị:</label>
                                                <div class="">
                                                    <?php
                                                        if($row2["sliShow"]==1){
                                                    ?>
                                                        <input type="radio" name="sliShow" checked="true" value="1"/> Hiển thị
                                                        <input type="radio" name="sliShow"  value="0"/> Không hiển thị
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <input type="radio" name="sliShow" value="1"/> Hiển thị
                                                        <input type="radio" name="sliShow" checked="true"  value="0"/> Không hiển thị
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Thứ tự hiển thị:</label>
                                                <input class="form-control" type="number" value="<?php echo $row["sliSort"]; ?>" step="1" min="1" max="100" name="sliSort" id="txtInput" value="1"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Ảnh</label>
                                                <img src="../image/<?php echo $row2["sliImage"];?>" width="200px" style="
    margin-bottom: 10px;"/>
                                                <input type="file" name="sliImage"/>
                                                <input name="imgOld" type="hidden" value="<?php echo $row2["sliImage"] ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button  type="submit" name="edit" value="Chỉnh sửa" class="btn btn-primary">Chỉnh sửa</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                          </div>
            </td>

            <td><a href="?mod=slide&act=delete&sliID=<?php echo $row["sliID"]; ?>" onClick="if(!confirm('Bạn có chắc chắn muốn xóa?')) return false;"><i class="fa fa-times"></i> Xóa</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
