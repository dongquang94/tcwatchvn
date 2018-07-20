<?php
    include("../connection.ini");
    $row_per_page=10;
    if(isset($_GET["start"]))
        $start=$_GET["start"];
    else
        $start=0;
    $page=1;
    if(isset($_POST["loc"])){
        $catID = $_POST["catID"];
        if($catID==0){
            $sql1 = "select * from products order by proID";
            $result1 = mysqli_query($conn, $sql1);
            $rows=mysqli_num_rows($result1);
            if($rows>$row_per_page)
                $page=ceil($rows/$row_per_page);
            $sql = "select * from products order by proView DESC limit $start,$row_per_page";
        }else{
            $sql2 = "select * from catalogues where catIDParent='".$catID."'";
            $re = mysqli_query($conn, $sql2);
            if(mysqli_num_rows($re)==0){
                $sql1 = "select * from products where catID='".$catID."'";
                $result1 = mysqli_query($conn, $sql1);
                $rows=mysqli_num_rows($result1);
                if ($rows>$row_per_page)
                    $page=ceil($rows/$row_per_page);
                $sql = "select * from products where catID='".$catID."' order by proView DESC limit $start,$row_per_page";
            }else{
                $arr = array();
                $i = 0;
                while($rowc = mysqli_fetch_array($re, MYSQLI_ASSOC)){
                    $arr[$i] = $rowc["catID"];
                    $i++;
                }
                $str = "";
                for($i=0;$i<count($arr);$i++){
                    if($i==count($arr)-1){
                        $str = $str.$arr[$i];
                    }else{
                        $str = $str.$arr[$i].",";
                    }
                }
                $sql1 = "select * from products where catID in (".$str.") order by proID ASC";
                $result1 = mysqli_query($conn, $sql1);
                $rows=mysqli_num_rows($result1);
                if($rows>$row_per_page)
                    $page=ceil($rows/$row_per_page);
                $sql = "select * from products where catID in (".$str.") order by proView DESC limit $start,$row_per_page";
            }
        }
    }else{
        $sql1 = "select * from products order by proID";
        $result1 = mysqli_query($conn, $sql1);
        $rows=mysqli_num_rows($result1);
        if ($rows>$row_per_page)
            $page=ceil($rows/$row_per_page);
        $sql = "select * from products order by proView DESC limit $start,$row_per_page";
    }
    $result = mysqli_query($conn, $sql);
?>


<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Sản phẩm
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Quản trị</a>
                </li>
                <li class="active">
                    <i class="fa fa-suitcase"></i> Sản phẩm
                </li>
            </ol>
        </div>
    </div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <form action="" method="post">
            <select name="catID" class="cboSelect" style="width: 200px; height: 32px; border-radius: 5px;">
                <option value="0">-- Tất cả danh mục --</option>
                <?php
                    $s = "select * from catalogues where catIDParent=0 order by catSort";
                    $r = mysqli_query($conn, $s);
                    while($ro = mysqli_fetch_array($r, MYSQLI_ASSOC)){
                ?>
                    <option value="<?php echo $ro["catID"]; ?>"><?php echo $ro["catName"]; ?></option>
                    <?php
                        $s2 = "select * from catalogues where catIDParent='".$ro["catID"]."' order by catID";
                        $r2 = mysqli_query($conn, $s2);
                        while($ro2 = mysqli_fetch_array($r2, MYSQLI_ASSOC)){
                    ?>
                        <option value="<?php echo $ro2["catID"]; ?>"><?php echo " -- ".$ro2["catName"]; ?></option>
                <?php
                        }
                    }
                ?>
            </select>
            <input type="submit" class="btn btn-default" name="loc" value="Lọc sản phẩm" id="btnSubmit"/>
        </form>
        <h2>Danh sách sản phẩm</h2>
        <div class="table-responsive">
            <h5>Số lượng sản phẩm hiện có: <?php echo mysqli_num_rows($result);?></h5>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Ảnh</th>
                        <th>Trạng thái</th>
                        <th>Khuyến mại</th>
                        <th>Lượt xem</th>
                        <th colspan="3" class="text-center"><a href="?mod=product&act=new" class="btn btn-default"><i class="fa fa-plus"></i> Thêm mới</a></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                    <tr>
                        <td class="col-lg-2"><?php echo $row["proName"]; ?></td>
                        <td class="col-lg-2"><?php echo $row["proCost"]; ?> VNĐ</td>
                        <td class="col-lg-3"><img src="../image/<?php echo $row["proImage"]; ?>" width="30%" alt="<?php echo $row["proName"]; ?>" title="<?php echo $row["proName"]; ?>"/></td>
                        <td class="col-lg-1"><?php if($row["proStatus"]==1){ ?> Còn hàng <?php }else{ ?> Hết hàng <?php } ?></td>
                        <td class="col-lg-1"><?php echo $row["proSale"]."%"; ?></td>
                        <td class="col-lg-1"><?php echo $row["proView"]; ?></td>
                        <td><a href="../public/index.php?mod=product-detail&id=<?php echo$row["proID"]; ?>" target="_blank"><i class="fa fa-search"></i> Xem</a></td>
                        <td><a href="?mod=product&act=edit&proID=<?php echo $row["proID"]; ?>"><i class="fa fa-pencil"></i> Sửa</a></td>
                        <td><a href="?mod=product&act=delete&proID=<?php echo $row["proID"]; ?>" onClick="if(!confirm('Bạn có chắc chắn muốn xóa?')) return false;"><i class="fa fa-times"></i> Xóa</a></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div style="width: 300px; height: auto; color: black; font-size: 20px; padding-bottom: 20px; padding-top: 20px; text-align: center; width: 100%; clear: both; ">
    <?php
        $page_cr=($start/$row_per_page)+1;
        $min = $page_cr - 2;
        $max = $page_cr + 2;
        if ($min < 2) {
            $minview = 1;
        } else {
            $minview=$min;
            $dot_left = 1;
        }
        if( $max<$page ) {
            $maxview = $max;
            $dot_right = 1;
        } else {
            $maxview = $page;
        }
        if (isset($dot_left)) {
            if ($min >=2 ) {
                echo "<a href='?mod=product&start=0' style='text-decoration: none;'>1&nbsp;</a>";
            } if ($min != 2){
             echo "<span>.. </span>";
            }
        }
        for($i=1;$i<=$page;$i++)
        {
            if($i>=$minview && $i <=$maxview) {
                if ($page_cr!=$i)
                    echo "<a href='?mod=product&start=".$row_per_page*($i-1)."' style='text-decoration: none;'>$i&nbsp;</a>";
                else
                    echo "&nbsp;[ ".$i." ]&nbsp;";
            }
        }
        if(isset($dot_right)){
            echo "<span>..</span>";
        }
    ?>
    </div>