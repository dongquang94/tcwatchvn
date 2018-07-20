<?php
    include("../connection.ini");
    $sql = "select * from types order by typeID";
    $result = mysqli_query($conn, $sql);
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Loại sản phẩm
        </h3>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Quản trị</a>
            </li>
            <li class="active">
                <i class="fa fa-fw fa-building"></i> Loại sản phẩm
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h2>Danh sách loại sản phẩm</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Loại sản phẩm</th>
                        <th colspan="2" class="text-center"><a href="void(0)"  data-toggle="modal" data-target="#add_product_type" class="btn btn-default"><i class="fa fa-plus"></i> Thêm mới</a>
                            <!-- Modal -->
                            <div class="modal fade" id="add_product_type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Thêm mới loại sản phẩm</h4>
                                  </div>
                                  <form action="?mod=type&act=new" method="post">
                                  <div class="modal-body">
                                    <div class="">
                                        <div class="col-md-10 col-md-offset-2">
                                            <?php 
                                                if(isset($error)) {
                                                    echo '<li>' . $error . '</li>';
                                                }
                                             ?>
                                            <div class="form-group text-left">
                                                <label style="float:lert;">Thêm loại mới</label>
                                                <input class="form-control" type="text" name="typeName" required="" id="txtInput">
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
                        <td class="text-center"><?php echo $row["typeName"]; ?></td>
                        <td><a href=""  data-toggle="modal" data-target="#edit_product_<?php echo $row["typeID"]; ?>"><i class="fa fa-pencil"></i> Sửa</a>
                            <!-- Modal -->
                            <div class="modal fade" id="edit_product_<?php echo $row["typeID"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Chỉnh sửa loại sản phẩm</h4>
                                  </div>
                                  <form action="?mod=type&act=edit&typeID=<?php echo $row["typeID"]; ?>" method="post">
                                  <div class="modal-body">
                                    <div class="">
                                        <div class="col-md-10 col-md-offset-2">
                                            <?php 
                                                if(isset($error)) {
                                                    echo '<li>' . $error . '</li>';
                                                }
                                                $sql2 = "select * from types where typeID='".$row["typeID"]."'";
                                                $result2 = mysqli_query($conn, $sql2);
                                                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                             ?>
                                            <input type="hidden" name="typeID" value="<?php echo $row2["typeID"]; ?>"/>
                                            <div class="form-group text-left">
                                                <label style="float:lert;">Tên loại sản phẩm</label>
                                                <input class="form-control" type="text" name="typeName" required="" id="txtInput" value="<?php echo $row2["typeName"]; ?>">
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
                        <!-- end Modals create -->

                        </td>
                        <td><a href="?mod=type&act=delete&typeID=<?php echo $row["typeID"]; ?>" onClick="if(!confirm('Bạn có chắc chắn muốn xóa?')) return false;"><i class="fa fa-times"></i> Xóa</a></td>
                    </tr>
                <?php
                    }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
