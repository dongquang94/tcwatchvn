<script type="text/javascript" src="../ckeditor/sample.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<?php
    include("../connection.ini");
    $proID = @$_GET["proID"];
    $result = mysqli_query($conn, "select * from products where proID='".$proID."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $myCat = mysqli_query($conn, "select * from catalogues where catID='".$row["catID"]."'");
    $rowC = mysqli_fetch_array($myCat, MYSQLI_ASSOC);
    $myTyp = mysqli_query($conn, "select * from types where typeID='".$row["typeID"]."'");
    $rowT = mysqli_fetch_array($myTyp, MYSQLI_ASSOC);

    $cat = mysqli_query($conn, "select * from catalogues where catID!='".$row["catID"]."' and catIDParent=0 order by catID");
    $typ = mysqli_query($conn, "select * from types where typeID!='".$row["typeID"]."'");

    if(isset($_POST["edit"])){
        $catID = $_POST["catID"];
        $s = "select * from catalogues where catID='".$catID."'";
        $q = mysqli_query($conn, $s);
        $r = mysqli_fetch_array($q, MYSQLI_ASSOC);
        if($r["catIDParent"]==0){
            echo "<script>alert('Bạn hãy chọn một danh mục con!');</script>";
        }else{
            $proID = $_POST["proID"];
            $proName = $_POST["proName"];
            $typeID = $_POST["typeID"];
            $proInfo = $_POST["proInfo"];
            $proDescription = $_POST["proDescription"];
            $proCost = $_POST["proCost"];
            $proStatus = $_POST["proStatus"];
            $proSale = $_POST["proSale"];
            $img ="";
            if(isset($_FILES["proImage"]) and $_FILES["proImage"]["size"]>0)
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
                $imgName = $datetime."-".$_FILES["proImage"]["name"];
                copy($_FILES["proImage"]["tmp_name"],"../image/".$datetime."-".$_FILES["proImage"]["name"]);
                $img = ", proImage='".$imgName."'";
            }
            $sql = "update products set proName='".$proName."', typeID='".$typeID."', proInfo='".$proInfo."', proDescription='".$proDescription."', proCost='".$proCost."'$img, catID='".$catID."', proStatus='".$proStatus."', proSale='".$proSale."' where proID='".$proID."'";
            if(mysqli_query($conn, $sql)){
                echo "<script>alert('Sửa thành công');</script>";
                ?>
                    <script>
                        window.location = "?mod=product";
                    </script>
                <?php
            }else{
                echo "<script>alert('Sửa thất bại!');</script>";
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
                    Chỉnh sửa sản phẩm
                </li>
            </ol>
        </div>
    </div>
<!-- /.row -->
<a href="?mod=product" id="back"><i class="fa fa-reply"></i> Quay lại</a>
<h3>Chỉnh sửa sản phẩm</h3>
    <form class="form-horizontal" action="?mod=product&act=edit" method="post" enctype="multipart/form-data">
            <input type="hidden" name="proID" value="<?php echo $row["proID"]; ?>"/>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Tên sản phẩm:</label>
                <div class="col-sm-10">
                  <input type="text" name="proName" required="" value="<?php echo $row["proName"]; ?>" id="txtInput" class="form-control" placeholder="Tên sản phẩm:">
                </div>
            </div>
            <div class="form-group">
            <label for="" class="col-sm-2 control-label">Danh mục sản phẩm:</label>
                <div class="col-sm-3">
                   <select name="catID" id="cboSelect" class="form-control">
                        <option value="<?php echo $rowC["catID"]; ?>"><?php echo $rowC["catName"];?></option>
                        <?php
                            while($rowC2 = mysqli_fetch_array($cat, MYSQLI_ASSOC)){
                        ?>
                            <option value="<?php echo $rowC2["catID"]; ?>"><?php echo $rowC2["catName"]; ?></option>
                            <?php
                                $sql2 = "select * from catalogues where catIDParent='".$rowC2["catID"]."' and catID!='".$row["catID"]."' order by catIDParent";
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
                        <option value="<?php echo $rowT["typeID"]; ?>"><?php echo $rowT["typeName"]; ?></option>
                        <?php
                            while($rowT2 = mysqli_fetch_array($typ, MYSQLI_ASSOC)){
                        ?>
                                <option value="<?php echo $rowT2["typeID"]; ?>"><?php echo $rowT2["typeName"]; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Chi tiết sản phẩm:</label>
                <div class="col-sm-10">
                  <textarea class="ckeditor" name="proInfo" rows="20" cols="50" required="" > <?php echo $row["proInfo"];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Giới thiệu sản phẩm:</label>
                <div class="col-sm-10">
                   <textarea class="ckeditor" name="proDescription" rows="20" cols="50" required="" ><?php echo $row["proDescription"];?> </textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Giá</label>
                <div class="col-sm-3">
                  <input type="number" name="proCost" required="" min="0" step="any" value="<?php echo $row["proCost"]; ?>" id="txtInput" class="form-control" placeholder="Giá VNĐ" /> 
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Tình Trạng</label>
                <div class="col-sm-10">
                    <?php
                        if($row["proStatus"]==1){
                    ?>
                        <input type="radio" name="proStatus" checked="true" value="1" /> Còn hàng
                        <input type="radio" name="proStatus" value="0" style="margin-left: 25px;"/> Hết hàng
                    <?php
                        }else
                        {
                    ?>
                        <input type="radio" name="proStatus" value="1" /> Còn hàng
                        <input type="radio" name="proStatus" checked="true" value="0" style="margin-left: 25px;"/> Hết hàng
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Khuyến Mại</label>
                <div class="col-sm-3">
                  <input type="number" value="<?php echo $row["proSale"]; ?>" name="proSale" min="0" max="100" step="1" id="txtInput" class="form-control" placeholder="Khuyến Mại" />
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Ảnh Sản Phẩm</label>
                <div class="col-sm-10">
                    <img src="../image/<?php echo $row["proImage"];?>" width="200px" style="
    margin-bottom: 10px;"/>
                    <input type="file" name="proImage" width="50px" height="30px"/>
                    <input name="imgOld" type="hidden" value="<?php echo $row["proImage"] ?>"/>
                </div>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" class="btn btn-primary" name="edit" value="Chỉnh sửa" id="btnSubmit"/>
            </div>
        </div>
    </form>



