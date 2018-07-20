<!-- sale -->
<div id="sale">
    <?php
		include("../connection.ini");
        $sql = "select * from sales order by saleSort ASC limit 3";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
        <div class="sale-item">
            <img class="img_zoom" src="../image/<?php echo $row["saleImage"]; ?>" width="100%" height="100%" alt="Sale Image" title="<?php echo $row["saleTitle"]; ?>"/>
        </div>
    <?php
        }
    ?>
</div>

<!-- top-product -->
<div id="top-product">
    <?php
        $sql = "select * from catalogues where catIDParent=0 order by catSort limit 20";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
    <div id="cont-top-product" >
        <div id="catalog-top-product">
            <a href="?mod=product&id=<?php echo $row["catID"]; ?>"><h1><?php echo $row["catName"]; ?></h1></a>
        </div>
        <?php
            $s = "select * from catalogues where catIDParent='".$row["catID"]."' order by catID";
            $q = mysqli_query($conn, $s);
            if(mysqli_num_rows($q)==0){
                echo "";
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
                $sql2 = "select * from products where catID in (".$str.") order by proSale DESC limit 4";
                $result2 = mysqli_query($conn, $sql2);
        ?>
        <div id="row-top-product">
            <?php
                while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
            ?>
                <div class="item-top-product">
                    <div class="item-top-product-img">
                        <a href="?mod=product-detail&id=<?php echo $row2["proID"]; ?>"><img class="img_zoom" src="../image/<?php echo $row2["proImage"]; ?>" width="100%" height="100%" alt="Product Image" title="<?php echo $row2["proName"]; ?>"/></a>
                    </div>
                    <div class="item-top-product-name">
                        <span><?php echo $row2["proName"]; ?></span>
                    </div>
                    <div class="item-top-product-cost">
                        <span id="top-product-cost"><?php if($row2["proSale"]==0) { echo ""; } else{ echo number_format($row2["proCost"]); ?><sup>đ</sup><?php  } ?></span>
                        <span id="top-product-cost-sale"><?php echo number_format($row2["proCost"]-(($row2["proSale"]*$row2["proCost"])/100)); ?> <sup>đ</sup></span>
                    </div>
                    <?php
                        if($row2["proSale"]==0){
                        }else{
                    ?>
                    <div class="item-top-product-sale-off">
                        <p>. Giảm</p>
                        <strong>.. <?php echo $row2["proSale"]; ?>%</strong>
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
        <?php
        }
        ?>
    </div>
    <?php
        }
    ?>
</div>

<!-- hot-news -->
<div id="hot-news">
    <?php
        $sqlhot = "select * from news order by newsView DESC limit 1";
        $resulthot = mysqli_query($conn, $sqlhot);
        $rowhot = mysqli_fetch_array($resulthot, MYSQLI_ASSOC);
    ?>
    <div id="hot-hot-news">
        <div id="header-hot-hot-news">
            <a><h1>Bài viết nổi bật</h1></a>
        </div>
        <div id="top-1-hot-hot-news">
            <div id="top-1-hot-hot-news-img">
                <a href="?mod=news-detail&id=<?php echo $rowhot["newsID"]; ?>"><img src="../image/<?php echo $rowhot["newsImage"]; ?>" width="100%" height="100%" alt="News Image" title="<?php echo $rowhot["newsTitle"]; ?>"/></a>
            </div>
            <div id="title-top-1-hot-hot-news">
                <a href="?mod=news-detail&id=<?php echo $rowhot["newsID"]; ?>"><h2><?php echo $rowhot["newsTitle"]; ?></h3></a>
            </div>
        </div>
        <?php
            $sqlhot2 = "select * from news order by newsView DESC limit 1,2";
            $resulthot2 = mysqli_query($conn, $sqlhot2);
            while($rowhot2 = mysqli_fetch_array($resulthot2, MYSQLI_ASSOC)){
        ?>
        <div class="top-hot-hot-news">
            <div class="top-hot-hot-news-img">
                <a href="?mod=news-detail&id=<?php echo $rowhot2["newsID"]; ?>"><img src="../image/<?php echo $rowhot2["newsImage"]; ?>" width="100%" height="100%" alt="News Image" title="<?php echo $rowhot2["newsTitle"]; ?>"/></a>
            </div>
            <div class="cont-top-hot-hot-news">
                <div class="title-top-hot-hot-news">
                    <a href="?mod=news-detail&id=<?php echo $rowhot2["newsID"]; ?>"><h3><?php echo $rowhot2["newsTitle"]; ?></h3></a>
                </div>
                <div class="des-top-hot-hot-news">
                    <span><?php echo $rowhot2["newsDescription"]; ?></span>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <?php
        $sqlnew = "select * from news order by newsDate DESC limit 1";
        $resultnew = mysqli_query($conn, $sqlnew);
        $rownew = mysqli_fetch_array($resultnew, MYSQLI_ASSOC);
    ?>
    <div id="new-hot-news">
        <div id="header-new-hot-news">
            <a href="?mod=news"><h1>Bài viết mới nhất</h1></a>
        </div>
        <div id="top-1-new-hot-news">
            <div id="top-1-new-hot-news-img">
                <a href="?mod=news-detail&id=<?php echo $rownew["newsID"]; ?>"><img src="../image/<?php echo $rownew["newsImage"]; ?>" width="100%" height="100%" alt="News Image" title="<?php echo $rownew["newsTitle"]; ?>"/></a>
            </div>
            <div id="title-top-1-new-hot-news">
                <a href="?mod=news-detail&id=<?php echo $rownew["newsID"]; ?>"><h2><?php echo $rownew["newsTitle"]; ?></h3></a>
            </div>
        </div>
        <?php
            $sqlnew2 = "select * from news order by newsDate DESC limit 1,2";
            $resultnew2 = mysqli_query($conn, $sqlnew2);
            while($rownew2 = mysqli_fetch_array($resultnew2, MYSQLI_ASSOC)){
        ?>
        <div class="top-new-hot-news">
            <div class="top-new-hot-news-img">
                <a href="?mod=news-detail&id=<?php echo $rownew2["newsID"]; ?>"><img src="../image/<?php echo $rownew2["newsImage"]; ?>" width="100%" height="100%" alt="News Image" title="<?php echo $rownew2["newsTitle"]; ?>"/></a>
            </div>
            <div class="cont-top-new-hot-news">
                <div class="title-top-new-hot-news">
                    <a href="?mod=news-detail&id=<?php echo $rownew2["newsID"]; ?>"><h3><?php echo $rownew2["newsTitle"]; ?></h3></a>
                </div>
                <div class="des-top-new-hot-news">
                    <span><?php echo $rownew2["newsDescription"]; ?></span>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>