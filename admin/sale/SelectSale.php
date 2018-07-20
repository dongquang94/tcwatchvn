
<?php
    include("../connection.ini");
    $sql = "select * from sales order by saleSort";
    $result = mysqli_query($conn, $sql);
?>

<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Khuyến mại
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Quản trị</a>
                </li>
                <li class="active">
                    <i class="fa fa-bookmark-o"></i> Khuyến mại
                </li>
            </ol>
        </div>
    </div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <h2>Danh sách khuyến mại</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                       <th>Tiêu đề</th>
                        <th>Ảnh</th>
                        <th>Hiển thị</th>
                        <th>Thứ tự hiển thị</th>
                        <th colspan="2" class="text-center"><a href="void(0)" class="btn btn-default" data-toggle="modal" data-target="#Createsale" ><i class="fa fa-plus"></i> Thêm mới</a>
                                <!-- Modal -->
                            <div class="modal fade" id="Createsale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Thêm mới khuyến mại</h4>
                                  </div>
                                  <form action="?mod=sale&act=new" class="form-horizontal" method="post" enctype="multipart/form-data">
                                  <div class="modal-body">
                                    <div class="">
                                        <div class="col-md-10 col-md-offset-1">
                                            <?php 
                                                if(isset($error)) {
                                                    echo '<li>' . $error . '</li>';
                                                }
                                             ?>
                                            <div class="form-group">
                                                <label>Tiêu đề khuyến mại mới:</label>
                                                <input class="form-control" type="text" name="saleTitle" required="" id="txtInput"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Tùy chọn hiển thị:</label>
                                                <div class="">
                                                    <input class="col-md-1" type="radio" name="saleShow" value="1" checked="true" /> <span class="col-md-3 radio-btn">Hiển thị</span>
                                                    <input class="col-md-1 col-md-offset-3" type="radio" name="saleShow" value="0" /> <span class="col-md-4 radio-btn">Không hiển thị</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Thứ tự hiển thị:</label>
                                                <input class="form-control" type="number" step="1" min="1" max="100" name="saleSort" id="txtInput" value="1"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Ảnh</label>
                                                <input class="form-control" type="file" name="saleImage" required="" id="txtInput"/>
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
                        <td><?php echo $row["saleTitle"]; ?></td>
            <td><img src="../image/<?php echo $row["saleImage"]; ?>" width="200px" title="Khuyến mại" alt="Khuyến mại"/></td>
            <td><?php if($row["saleShow"]==1) {?> Có <?php }else{ ?> Không <?php }?></td>
            <td><?php echo $row["saleSort"]; ?></td>
            <td><a href="" data-toggle="modal" data-target="#editsale<?php echo $row["saleID"]; ?>"><i class="fa fa-pencil"></i> Sửa</a>

                      <!-- Modal -->
                            <div class="modal fade" id="editsale<?php echo $row["saleID"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Chỉnh sửa khuyến mại</h4>
                                  </div>
                                  <form action="?mod=sale&act=edit&saleID=<?php echo $row["saleID"]; ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                  <div class="modal-body">
                                    <div class="">
                                        <div class="col-md-10 col-md-offset-1">
                                            <?php 
                                                $result2 = mysqli_query($conn, "select * from sales where saleID='".$row["saleID"]."'");
                                                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                                if(isset($error)) {
                                                    echo '<li>' . $error . '</li>';
                                                }
                                             ?>
                                             <input type="hidden" name="saleID" value="<?php echo $row2["saleID"]; ?>"/>
                                            <div class="form-group">
                                                <label>Tiêu đề khuyến mại mới:</label>
                                                <input class="form-control" type="text" value="<?php echo $row2["saleTitle"]; ?>" name="saleTitle" required="" id="txtInput"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Tùy chọn hiển thị:</label>
                                                <div class="">
                                                    <?php
                                                        if($row2["saleShow"]==1){
                                                    ?>
                                                        <input type="radio"  name="saleShow" checked="true" value="1"/> Hiển thị
                                                        <input type="radio"  name="saleShow" style="margin-left: 25px;" value="0"/> Không hiển thị
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <input type="radio"  name="saleShow" value="1"/> Hiển thị
                                                        <input type="radio"  name="saleShow" checked="true" style="margin-left: 25px;" value="0"/> Không hiển thị
                                                    <?php
                                                        }
                ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Thứ tự hiển thị:</label>
                                                <input class="form-control" type="number" step="1" min="1" max="100" name="saleSort" id="txtInput" value="<?php echo $row2["saleSort"]; ?>" />
                                            </div>
                                            <div class="form-group">
                                                <img src="../image/<?php echo $row2["saleImage"];?>" width="200px" style="
    margin-bottom: 10px;"/>
                                                <input type="file" name="saleImage"/>
                                                <input name="imgOld" type="hidden" value="<?php echo $row2["saleImage"] ?>"/>
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
            <td><a href="?mod=sale&act=delete&saleID=<?php echo $row["saleID"]; ?>" onClick="if(!confirm('Bạn có chắc chắn muốn xóa?')) return false;"><i class="fa fa-times"></i> Xóa</a></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
