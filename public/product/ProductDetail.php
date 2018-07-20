<div id="content">
    <?php
		include("../connection.ini");
        $id = "";
        if(isset($_GET["id"])) $id = $_GET["id"];
        $sql = "select * from products where proID='".$id."' order by proSale ASC";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $sql2 = "select * from products where proID!='".$id."' and catID='".$row["catID"]."' order by proSale ASC limit 4";
        $result2 = mysqli_query($conn, $sql2);
    ?>
    <div id="pro-detail-image">
        <img src="../image/<?php echo $row["proImage"]; ?>" width="100%" height="100%" alt="Product Image" title="<?php echo $row["proName"]; ?>"/>
    </div>
    <div id="pro-detail-info">
        <p id="pro-detail-name"><?php echo $row["proName"]; ?></p>
        <p id="pro-detail-status"><?php if($row["proStatus"]==1) echo "Còn hàng"; else echo "Hết hàng"; ?></p>
        <p id="pro-detail-cost"><?php echo number_format($row["proCost"]); ?><sup class="vnd">đ</sup></p>
        <p id="pro-detail-cost-sale">Giá: <?php echo number_format($row["proCost"]-(($row["proSale"]*$row["proCost"])/100)); ?><sup class="vnd">đ</sup></p>
        <br />
        <div>
            <!-- share facebook -->
                <div class="fb-share-button" style="float: left; width: 120px;" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count"></div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            <!-- end share facebook -->
            <!-- facebook like -->
                <div class="fb-like" style="float: left; width: 150px;"></div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            <!-- end facebook -->
        </div>
        </div>
        <div id="detail-info">
            <?php echo $row["proInfo"]?>
        </div>
    </div><br />
    <hr /> <br />
    <div id="pro-detail-des">
        <?php echo $row["proDescription"]; ?>
    </div>

<div id="other-product">
    <div id="catalog-top-product" style="margin-bottom: 15px;">
        <a><h1>SẢN PHẨM CÙNG LOẠI</h1></a>
    </div>
    <div id="row-top-product">
    <?php
        while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
    ?>
        <div class="item-top-product">
            <div class="item-top-product-img">
                <a href="?mod=product-detail&id=<?php echo $row2["proID"]; ?>"><img src="../image/<?php echo $row2["proImage"]; ?>" width="100%" height="100%" alt="Product Image" title="<?php echo $row2["proName"]; ?>"/></a>
            </div>
            <div class="item-top-product-name">
                <span><?php echo $row2["proName"]; ?></span>
            </div>
            <div class="item-top-product-cost">
                <span id="top-product-cost"><?php if($row2["proSale"]==0) { echo ""; } else{ echo $row2["proCost"]; ?><sup>đ</sup><?php  } ?></span>
                <span id="top-product-cost-sale"><?php echo $row2["proCost"]-(($row2["proSale"]*$row2["proCost"])/100); ?> <sup>đ</sup></span>
            </div>
            <?php
                if($row2["proSale"]==0){

                }else{
            ?>
            <div class="item-top-product-sale-off">
                <p>Giảm</p>
                <strong><?php echo $row2["proSale"]; ?>%</strong>
            </div>
            <?php
                }
            ?>
            <div class="item-top-product-detail">
                <a href="?mod=product-detail&id=<?php echo $row2["proID"]; ?>">XEM CHI TIẾT</a>
            </div>
        </div>
    <?php
        }
    ?>
    </div>
</div><br /><br /><br />