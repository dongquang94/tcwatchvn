<?php
	include("../connection.ini");
    $id = "";
    if(isset($_GET["id"]))
        $id = $_GET["id"];
    $or = "";
    $row_per_page=15;
    if(isset($_GET["start"]))
        $start=$_GET["start"];
    else
        $start=0;
    $page=1;

    if(isset($_POST["btnLoc"])){
    $loc = $_POST["loc"];
    $id = $_POST["id"];
    switch($loc){
        case 0:
            $or = "";
            break;
        case 1:
            $or = " order by proCost DESC";
            break;
        case 2:
            $or = " order by proCost ASC";
            break;
        case 3:
            $or = " order by proSale DESC";
            break;
        case 4:
            $or = " order by proSale ASC";
            break;
    }
}
?>
<div id="content">
<div style="width: 500px; height: auto; margin: auto;">
    <form method="post" action="?mod=product">
        <select name="loc" style="width: 200px; height: 30px; border-radius: 5px;">
            <option value="0">-- Tùy chọn sắp xếp --</option>
            <option value="1">Sắp xếp theo giá giảm dần</option>
            <option value="2">Sắp xếp theo giá tăng dần</option>
            <option value="3">Sắp xếp theo khuyến mại giảm dần</option>
            <option value="4">Sắp xếp theo khuyến mại tăng dần</option>
        </select>
        <input type="hidden" value="<?php echo $id ?>" name="id"/>
        <input type="submit" name="btnLoc" value="Lọc sản phẩm" style="width: 150px; height: 30px; padding: 5px; background: white; border: 1px solid silver; border-radius: 5px; margin-left: 50px;"/>
    </form>
</div>
    <?php
        $s = "select * from catalogues where catIDParent='".$id."' order by catSort";
        $q = mysqli_query($conn, $s);
        if(mysqli_num_rows($q)==0){
            $sql1 = "select * from products where catID='".$id."'".$or;
            $result1 = mysqli_query($conn, $sql1);
            $rows=mysqli_num_rows($result1);
            if ($rows>$row_per_page)
                $page=ceil($rows/$row_per_page);
            $sql = "select * from products where catID='".$id."'".$or." limit $start,$row_per_page";
        }else{
            $arr = array();
            $i = 0;
            while($rowc = mysqli_fetch_array($q, MYSQLI_ASSOC)){
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
            $sql1 = "select * from products where catID in (".$str.")".$or;
            $result1 = mysqli_query($conn, $sql1);
            $rows=mysqli_num_rows($result1);
            if ($rows>$row_per_page)
                $page=ceil($rows/$row_per_page);
            $sql = "select * from products where catID in (".$str.")".$or." limit $start,$row_per_page";
        }
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
            <div class="item-top-product" id="item-top-product-2">
                <div class="item-top-product-img">
                    <a href="?mod=product-detail&id=<?php echo $row["proID"]; ?>"><img class="img_zoom" src="../image/<?php echo $row["proImage"]; ?>" width="100%" height="100%" alt="Product Image" title="<?php echo $row["proName"]; ?>"/></a>
                </div>
                <div class="item-top-product-name">
                    <span><?php echo $row["proName"]; ?></span>
                </div>
                <div class="item-top-product-cost">
                    <span id="top-product-cost"><?php if($row["proSale"]==0) { echo ""; } else{ echo number_format($row["proCost"]); ?><sup>đ</sup><?php  } ?></span>
                    <span id="top-product-cost-sale"><?php echo number_format($row["proCost"]-(($row["proSale"]*$row["proCost"])/100)); ?> <sup>đ</sup></span>
                </div>
                <?php
                    if($row["proSale"]==0){
                    }else{
                ?>
                <div class="item-top-product-sale-off">
                    <p>Giảm</p>
                    <strong>. <?php echo $row["proSale"]; ?>%</strong>
                </div>
                <?php
                    }
                ?>
                <div class="item-top-product-detail">
                    <a href="?mod=product-detail&id=<?php echo $row["proID"]; ?>">XEM CHI TIẾT</a>
                </div>
            </div>
    <?php
        }
    ?>
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
</div>