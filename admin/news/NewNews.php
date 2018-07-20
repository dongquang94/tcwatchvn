<script type="text/javascript" src="../ckeditor/sample.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

<?php
    include("../connection.ini");
    if(isset($_POST["addNew"])){
        $newsDate = date_create()->format('Y-m-d');
        $datetime = date_create()->format('Y-m-d-H-i-s');
        $imgName = $_FILES["newsImage"]["name"];
        $img = $datetime."-".$imgName;
        copy($_FILES["newsImage"]["tmp_name"],"../image/".$datetime."-".$_FILES["newsImage"]["name"]);

        $newsTitle = $_POST["newsTitle"];
        $newsDescription = $_POST["newsDescription"];
        $newsContent = $_POST["newsContent"];
        $sql = "insert into news(newsTitle, newsDescription, newsContent, newsImage, newsDate) values('".$newsTitle."','".$newsDescription."','".$newsContent."','".$img."','".$newsDate."')";
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Thêm mới thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=news";
                </script>
            <?php
        }else{
            echo "<script>alert('Thêm mới thất bại!');</script>";
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
                    Thêm mới tin tức
                </li>
            </ol>
        </div>
    </div>
<!-- /.row -->
<h3>Thêm mới tin tức</h3>
<form action="?mod=news&act=new" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Tiêu đề:</label>
            <div class="col-sm-10">
              <input type="text" name="newsTitle" required="" id="txtInput" class="form-control" placeholder="Tiêu Đề">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Vắn tắt:</label>
            <div class="col-sm-10">
               <textarea name="newsDescription" cols="100" rows="5" required=""></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Nội dung:</label>
            <div class="col-sm-10">
               <textarea class="ckeditor" name="newsContent" rows="20" cols="70" required=""> </textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Ảnh</label>
            <div class="col-sm-6">
               <input type="file" name="newsImage" required=""/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
               <input type="submit" class="btn btn-primary" name="addNew" value="Thêm mới" id="btnSubmit"/>
               <input type="reset" class="btn btn-default" name="reset" value="Nhập lại" id="btnSubmit"/>
            </div>
        </div>
</form>