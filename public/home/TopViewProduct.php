<?php
	include("../connection.ini");
    $sql = "select * from products order by proView DESC limit 4";
    $result = mysqli_query($conn, $sql);
?>
<div id="top-view-product">
    <div id="header-top-view-product">
        <div id="img-top-view-product">
            <img src="../image/hot-product.png" width="100%" height="100%" alt="Top View Image" title="Sản phẩm bán chạy nhất"/>
        </div>
        <div id="text-top-view-product">
            <span>SẢN PHẨM BÁN CHẠY NHẤT</span>
        </div>
    </div>
    <div id="show-top-view-product">
        <?php
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        ?>
        <div class="item-top-view-product">
            <div class="item-top-view-product-img">
                <a href="?mod=product-detail&id=<?php echo $row["proID"]; ?>"><img class="img_zoom" src="../image/<?php echo $row["proImage"]; ?>" width="100%" height="100%" alt="Product Image" title="<?php echo $row["proName"]; ?>" /></a>
            </div>
            <div class="item-top-view-product-name">
                <span><?php echo $row["proName"]; ?></span><br />
            </div>
            <div class="item-top-view-product-cost">
                <span id="view-product-cost"><?php if($row["proSale"]==0) { echo ""; } else{ echo number_format($row["proCost"]); ?><sup>đ</sup><?php  } ?></span>
                <span id="view-product-cost-sale"><?php echo number_format($row["proCost"]-(($row["proSale"]*$row["proCost"])/100)); ?> <sup>đ</sup></span>
            </div>
            <?php
                if($row["proSale"]==0){
                    
                }else{
            ?>
            <div class="item-top-view-product-sale-off">
                <p>. Giảm</p>
                <strong>.. <?php echo $row["proSale"]; ?>%</strong>
            </div>
            <?php   
                }
            ?>
        </div>
        <?php
            }
        ?>
    </div>
</div>
