<?php
    include("../connection.ini");
    $sql = "select * from catalogues where catIDParent=0 order by catSort";
    $result = mysqli_query($conn, $sql);
    $sql_2 = "select * from catalogues where catIDParent=0 order by catID";
    $result_2 = mysqli_query($conn, $sql_2);

    function search_info_category($id){
        include("../connection.ini");
        $sql_3 = "select * from catalogues where catID='".$id."'";
        $result_3 = mysqli_query($conn, $sql_3);
        $row_3 = mysqli_fetch_array($result_3, MYSQLI_ASSOC);
        return $row_3;
    }
?>
<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Quản lý danh mục
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Quản trị</a>
                </li>
                <li class="active">
                    <i class="fa fa-list-ul"></i> Quản lý danh mục
                </li>
            </ol>
        </div>
    </div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <h2>Danh sách danh mục</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên danh mục</th>
                        <th>Danh mục gốc</th>
                        <th>Danh mục con</th>
                        <th>Hiển thị</th>
                        <th>Thứ tự hiển thị</th>
                        <th colspan="2" class="text-center"><a href="void(0)" id="btn-create-category" class="btn btn-default" data-toggle="modal" data-target="#CreateCategory"><i class="fa fa-plus"></i> Thêm mới</a></th>
                        <!-- modals create -->
                        <!-- Modal -->
                            <div class="modal fade" id="CreateCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Thêm mới danh mục</h4>
                                  </div>
                                  <form action="?mod=catalog&act=new" method="post">
                                  <div class="modal-body">
                                    <div class="">
                                        <div class="col-md-10 col-md-offset-2">
                                            <?php 
                                                if(isset($error)) {
                                                    echo '<li>' . $error . '</li>';
                                                }
                                             ?>
                                            <div class="form-group">
                                                <label>Tên danh mục mới</label>
                                                <input class="form-control" type="text" name="catName" required="" id="txtInput">
                                            </div>
                                            <div class="form-group">
                                                <label>Chọn danh mục gốc:</label>
                                                <select class="form-control" name="catIDParent" id="cboSelect">
                                                    <option value="0">Đặt làm danh mục gốc</option>
                                                    <?php
                                                        while($row_2 = mysqli_fetch_array($result_2, MYSQLI_ASSOC)){
                                                    ?>
                                                    <option value="<?php echo $row_2["catID"]; ?>"><?php echo $row_2["catName"]; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tùy chọn hiển thị:</label>
                                                <div class="">
                                                    <input class="col-md-1" type="radio" name="catShow" value="1" checked="true" /> <span class="col-md-3 radio-btn">Hiển thị</span>
                                                    <input class="col-md-1 col-md-offset-3" type="radio" name="catShow" value="0" /> <span class="col-md-4 radio-btn">Không hiển thị</span>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label>Thứ tự hiển thị:</label>
                                                <input class="form-control" type="number" step="1" min="1" max="100" name="catSort" id="txtInput" value="1"/>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    ?>
                        <tr>
                            <td><?php echo $row["catName"]; ?></td>
                            <td>Có</td>
                            <td></td>
                            <td><?php if($row["catShow"]==1){?> Có <?php }else {?> Không <?php }?></td>
                            <td><?php echo $row["catSort"]; ?></td>
                            <td><a href="void(0)" data-toggle="modal" data-target="#editCategory_<?php echo $row["catID"];?>"><i class="fa fa-pencil"></i> Sửa</a>
                                <!-- modals edit categories -->
                                    <?php
                                        $info = search_info_category($row["catID"]);
                                    ?>
                                     <!-- Modal -->
                                        <div class="modal fade" id="editCategory_<?php echo $row["catID"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Chỉnh sửa danh mục</h4>
                                              </div>
                                              <form action="?mod=catalog&act=edit&catID=<?php echo $row["catID"]; ?>" method="post">
                                              <div class="modal-body">
                                                <div class="">
                                                    <div class="col-md-10 col-md-offset-2">
                                                        <?php
                                                            if(isset($error)) {
                                                                echo '<li>' . $error . '</li>';
                                                            }
                                                         ?>
                                                        <div class="form-group">
                                                            <label>Tên danh mục</label>
                                                            <input class="form-control" type="text" name="catName" required="" value="<?php echo $info[1] ?>" id="txtInput">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Chọn danh mục gốc:</label>
                                                            <select class="form-control" name="catIDParent" id="cboSelect">

                                                                <?php if ($info["2"] == 0) { ?>
                                                                    <option value="0" selected>Root</option>
                                                                <?php } else {
                                                                     ?>
                                                                    <option value="<?php echo $info["2"]; ?>"><?php echo $info[1]; ?></option>
                                                                <?php
                                                                }
                                                                    $query_show = mysqli_query($conn, "select * from catalogues where catIDParent=0 and catID!='".$row["catID"]."' order by catID");
                                                                    while($row_show = mysqli_fetch_array($query_show, MYSQLI_ASSOC)){
                                                                ?>
                                                                        <option value="<?php echo $row_show["catID"]; ?>"><?php echo $row_show["catName"]; ?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tùy chọn hiển thị:</label>
                                                            <div class="">
                                                                <?php
                                                                    if($info[3]==1){
                                                                ?>
                                                                    <input class="col-md-1" type="radio" name="catShow" value="1" checked="true" /> <span class="col-md-3 radio-btn">Hiển thị</span>
                                                                    <input class="col-md-1 col-md-offset-3" type="radio" name="catShow" value="0" /> <span class="col-md-4 radio-btn">Không hiển thị</span>
                                                                <?php } else { ?>
                                                                    <input class="col-md-1" type="radio" name="catShow" value="1" /> <span class="col-md-3 radio-btn">Hiển thị</span>
                                                                    <input class="col-md-1 col-md-offset-3" type="radio" name="catShow" checked="true" value="0" /> <span class="col-md-4 radio-btn">Không hiển thị</span>
                                                                <?php } ?>
                                                            </div>
                                                        </div><br>
                                                        <div class="form-group">
                                                            <label>Thứ tự hiển thị:</label>
                                                            <input class="form-control" type="number" step="1" min="1" max="100" name="catSort" id="txtInput" value="<?php echo $info[4]; ?>"/>
                                                        </div>
                                                        <input type="hidden" name="catID" value="<?php echo $info[0]; ?>"/>
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
                                    <!-- end Modals create -->


                                <!-- end modals edit -->
                            </td>
                            <td><a href="?mod=catalog&act=delete&catID=<?php echo $row["catID"]; ?>" onClick="if(!confirm('Bạn có chắc chắn muốn xóa?')) return false;"><i class="fa fa-times"></i> Xóa</a></td>
                        </tr>
                    <?php
                        $sql2 = "select * from catalogues where catIDParent='".$row["catID"]."' order by catSort";
                        $result2 = mysqli_query($conn, $sql2);
                        while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                    ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?php echo $row2["catName"]; ?></td>
                            <td></td>
                            <td></td>
                            <td><a href="void(0)" data-toggle="modal" data-target="#editCategory_<?php echo $row2["catID"];?>"><i class="fa fa-pencil"></i> Sửa</a>
                                <!-- modals edit categories -->
                                    <?php
                                        $info = search_info_category($row2["catID"]);
                                    ?>
                                     <!-- Modal -->
                                        <div class="modal fade" id="editCategory_<?php echo $row2["catID"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Chỉnh sửa danh mục</h4>
                                              </div>
                                              <form action="?mod=catalog&act=edit&catID=<?php echo $row2["catID"]; ?>" method="post">
                                              <div class="modal-body">
                                                <div class="">
                                                    <div class="col-md-10 col-md-offset-2">
                                                        <?php
                                                            if(isset($error)) {
                                                                echo '<li>' . $error . '</li>';
                                                            }
                                                         ?>
                                                        <div class="form-group">
                                                            <label>Tên danh mục</label>
                                                            <input class="form-control" type="text" name="catName" required="" value="<?php echo $info[1] ?>" id="txtInput">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Chọn danh mục gốc:</label>
                                                            <select class="form-control" name="catIDParent" id="cboSelect">
                                                                <?php if ($info["2"] == 0) { ?>
                                                                    <option value="0" selected>Root</option>
                                                                <?php } else {
                                                                     ?>
                                                                    <option value="<?php echo $info["2"]; ?>"><?php echo $info[1]; ?></option>
                                                                <?php
                                                                }
                                                                    $query_show = mysqli_query($conn, "select * from catalogues where catIDParent=0 and catID!='".$row["catID"]."' order by catID");
                                                                    while($row_show = mysqli_fetch_array($query_show, MYSQLI_ASSOC)){
                                                                ?>
                                                                        <option value="<?php echo $row_show["catID"]; ?>"><?php echo $row_show["catName"]; ?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="catID" value="<?php echo $info[0]; ?>"/>
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
                                    <!-- end Modals create -->


                                <!-- end modals edit -->

                            </td>
                            <td><a href="?mod=catalog&act=delete&catID=<?php echo $row2["catID"]; ?>" onClick="if(!confirm('Bạn có chắc chắn muốn xóa?')) return false;"><i class="fa fa-times"></i> Xóa</a></td>
                        </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
