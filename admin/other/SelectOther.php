
    <?php
        include("../connection.ini");
        $sql = "select * from other order by otherID";
        $result = mysqli_query($conn, $sql);
    ?>
    <script type="text/javascript" src="../ckeditor/sample.js"></script>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Other
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Quản trị</a>
                </li>
                <li class="active">
                    <i class="fa fa-cogs"></i> Khác
                </li>
            </ol>
        </div>
    </div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <h2>Danh sách tin bài</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                       <th>Tiêu đề</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    ?>
                    <tr>
                        <td><?php echo $row["otherName"]; ?></td>
                        <td><a href="void(0)"data-toggle="modal" data-target="#editother<?php echo $row["otherID"]; ?>" ><i class="fa fa-pencil"></i> Sửa</a>
                             <!-- Modal -->
                            <div class="modal fade" id="editother<?php echo $row["otherID"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Chỉnh sửa</h4>
                                  </div>
                                  <form action="?mod=other&act=edit&otherID=<?php echo $row["otherID"]; ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                  <div class="modal-body">
                                    <div class="">
                                        <div class="col-md-10 col-md-offset-1">
                                            <?php
                                                $result2 = mysqli_query($conn, "select * from other where otherID='".$row["otherID"]."'");
                                                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                                if(isset($error)) {
                                                    echo '<li>' . $error . '</li>';
                                                }
                                             ?>
                                            <input type="hidden" name="otherID" value="<?php echo $row2["otherID"]; ?>"/>
                                            <div class="form-group">
                                                <label>Nội dung:</label>
                                                <textarea class="ckeditor" name="otherContent" rows="20" cols="50"><?php echo $row2["otherContent"];?></textarea>
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
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
