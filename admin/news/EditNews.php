
<script type="text/javascript" src="../ckeditor/sample.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

<?php
    include("../connection.ini");
    $newsID = @$_GET["newsID"];
    $result = mysqli_query($conn, "select * from news where newsID='".$newsID."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if(isset($_POST["edit"])){
        $newsID = $_POST["newsID"];
        $newsTitle = $_POST["newsTitle"];
        $newsContent = $_POST["newsContent"];
        $newsDescription = $_POST["newsDescription"];
        $img ="";
        if(isset($_FILES["newsImage"]) and $_FILES["newsImage"]["size"]>0)
        {
        	if(file_exists($_POST["imgOld"]))
        	{
        	  echo "Error!";
        	}
            else
            {
                unlink("../image/".$_POST["imgOld"]);
            }
            $datetime = date_create()->format('Y-m-d-H-i-s');
        	$imgName = $datetime."-".$_FILES["newsImage"]["name"];
            copy($_FILES["newsImage"]["tmp_name"],"../image/".$datetime."-".$_FILES["newsImage"]["name"]);
            $img = ", newsImage='".$imgName."'";
        }
        $sql = "update news set newsTitle='".$newsTitle."', newsDescription='".$newsDescription."'$img, newsContent='".$newsContent."' where newsID='".$newsID."'";
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Sửa thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=news";
                </script>
            <?php
        }else{
            echo "<script>alert('Sửa thất bại!');</script>";
            ?>
                <script>
                    window.location = "?mod=news";
                </script>
            <?php
        }
    }
?>
<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                News
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Quản trị</a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>  <a href="index.php?mod=news">Tin tức</a>
                </li>
                <li class="active">
                    Chỉnh sửa tin tức
                </li>
            </ol>
        </div>
    </div>
<!-- /.row -->
<a href="?mod=news" id="back"><i class="fa fa-reply"></i> Quay lại</a>
<h3>Chỉnh sửa tin tức</h3>
    <form action="?mod=news&act=edit" class="form-horizontal" method="post" enctype="multipart/form-data">
            <input type="hidden" name="newsID" value="<?php echo $row["newsID"]; ?>"/>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Tiêu đề:</label>
                <div class="col-sm-10">
                  <input type="text" name="newsTitle" value="<?php echo $row["newsTitle"]; ?>" required="" id="txtInput" class="form-control" placeholder="Tiêu Đề">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Vắn tắt:</label>
                <div class="col-sm-6">
                   <textarea name="newsDescription" cols="100" rows="5" required=""><?php echo $row["newsDescription"];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Nội dung:</label>
                <div class="col-sm-10">
                   <textarea class="ckeditor" name="newsContent" rows="20" cols="70" required=""> <?php echo $row["newsContent"];?> </textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Ảnh</label>
                <div class="col-sm-6">
                    <img src="../image/<?php echo $row["newsImage"];?>" width="200px" style="
    margin-bottom: 10px;"/>
                    <input type="file" name="newsImage"/>
                    <input name="imgOld" type="hidden" value="<?php echo $row["newsImage"] ?>"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                   <input type="submit" class="btn btn-primary"sss name="edit" value="Chỉnh sửa" id="btnSubmit"/>
                </div>
            </div>
    </form>

