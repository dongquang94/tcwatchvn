<div id="content">
    <?php
		include("../connection.ini");
        $id = "";
        if(isset($_GET["id"])) $id = $_GET["id"];
        
        if($id==0){
            $sql = "select * from products order by proSale DESC";
            $result = mysqli_query($conn, $sql);
        }else{
            $sql = "select * from products where typeID='".$id."' order by proSale DESC";
            $result = mysqli_query($conn, $sql);
        }
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
                    <span id="top-product-cost"><?php if($row["proSale"]==0) { echo ""; } else{ echo $row["proCost"]; ?><sup>đ</sup><?php  } ?></span>
                    <span id="top-product-cost-sale"><?php echo $row["proCost"]-(($row["proSale"]*$row["proCost"])/100); ?> <sup>đ</sup></span>
                </div>
                <?php
                    if($row["proSale"]==0){
                        
                    }else{
                ?>
                <div class="item-top-product-sale-off">
                    <p>Giảm</p>
                    <strong><?php echo $row["proSale"]; ?>%</strong>
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
</div>