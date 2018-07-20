
<script type="text/javascript" src="../ckeditor/sample.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<?php
    include("../connection.ini");
    $cata = mysqli_query($conn, "select * from catalogues where catIDParent=0 order by catSort");
    $type = mysqli_query($conn, "select * from types");
    if(isset($_POST["addNew"])){
        $catID = $_POST["catID"];
        $s = "select * from catalogues where catID='".$catID."'";
        $q = mysqli_query($conn, $s);
        $r = mysqli_fetch_array($q, MYSQLI_ASSOC);
        if($r["catIDParent"]==0){
            echo "<script>alert('Bạn hãy chọn một danh mục con!');</script>";
        }else{
            $datetime = date_create()->format('Y-m-d-H-i-s');
            $img = $datetime."-".$_FILES["proImage"]["name"];
            copy($_FILES["proImage"]["tmp_name"],"../image/".$datetime."-".$_FILES["proImage"]["name"]);
            $proName = $_POST["proName"];
            $typeID = $_POST["typeID"];
            $proInfo = $_POST["proInfo"];
            $proDescription = $_POST["proDescription"];
            $proCost = $_POST["proCost"];
            $proStatus = $_POST["proStatus"];
            $proSale = $_POST["proSale"];
            $sql = "insert into products(proName,typeID,proInfo,proDescription,proCost,proImage,catID,proView,proStatus,proSale) values('".$proName."','".$typeID."','".$proInfo."','".$proDescription."','".$proCost."','".$img."','".$catID."',0,'".$proStatus."','".$proSale."')";
            if(mysqli_query($conn, $sql)){
                echo "<script>alert('Thêm mới thành công');</script>";
                ?>
                    <script>
                        window.location = "?mod=product";
                    </script>
                <?php
            }else{
                echo "<script>alert('Thêm mới thất bại!');</script>";
                ?>
                    <script>
                        window.location = "?mod=product";
                    </script>
                <?php
            }
        }
    }
?>
<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Products
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Quản trị</a>
                </li>
                <li>
                    <i class="fa fa-suitcase"></i>  <a href="index.php?mod=product">Sản phẩm</a>
                </li>
                <li class="active">
                    Thêm mới sản phẩm
                </li>
            </ol>
        </div>
    </div>
<!-- /.row -->
    <h3>Thêm mới sản phẩm</h3>
    <form action="?mod=product&act=new" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Tên sản phẩm:</label>
                <div class="col-sm-10">
                  <input type="text" name="proName" required="" id="txtInput" class="form-control" placeholder="Tên sản phẩm:">
                </div>
            </div>
            <div class="form-group">
            <label for="" class="col-sm-2 control-label">Danh mục sản phẩm:</label>
                <div class="col-sm-3">
                   <select name="catID" id="cboSelect" class="form-control">
                        <?php
                            while($row1 = mysqli_fetch_array($cata, MYSQLI_ASSOC)){
                        ?>
                            <option value="<?php echo $row1["catID"]; ?>"><?php echo $row1["catName"]; ?></option>
                            <?php
                                $sql2 = "select * from catalogues where catIDParent='".$row1["catID"]."' order by catIDParent";
                                $result2 = mysqli_query($conn, $sql2);
                                while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                            ?>
                                <option value="<?php echo $row2["catID"]; ?>"><?php echo " --- ".$row2["catName"]; ?></option>
                            <?php
                                }
                            ?>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Loại sản phẩm:</label>
                <div class="col-sm-3">
                    <select name="typeID" id="cboSelect" class="form-control">
                        <?php
                            while($row2 = mysqli_fetch_array($type, MYSQLI_ASSOC)){
                        ?>
                                <option value="<?php echo $row2["typeID"]; ?>"><?php echo $row2["typeName"]; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Chi tiết sản phẩm:</label>
                <div class="col-sm-10">
                  <textarea class="ckeditor" name="proInfo" rows="20" cols="100" required="" > </textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Giới thiệu sản phẩm:</label>
                <div class="col-sm-10">
                   <textarea class="ckeditor" name="proDescription" rows="50" cols="100" required="" > </textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Giá</label>
                <div class="col-sm-3">
                  <input type="number" name="proCost" required="" min="0" step="any" id="txtInput" class="form-control" placeholder="Giá VNĐ"> 
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Tình Trạng</label>
                <div class="col-sm-10">
                    <input type="radio" name="proStatus" checked="true" value="1" /> Còn hàng
                    <input type="radio" name="proStatus" value="0" style="margin-left: 25px;"/> Hết hàng
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Khuyến Mại</label>
                <div class="col-sm-3">
                  <input type="number" value="0" name="proSale" min="0" max="100" step="1" id="txtInput" class="form-control" placeholder="Khuyến Mại">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Ảnh Sản Phẩm</label>
                <div class="col-sm-10">
                  <input type="file" name="proImage" required="">
                </div>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" class="btn btn-primary" name="addNew" value="Thêm mới" id="btnSubmit"/>
            </div>
        </div>
    </form>
