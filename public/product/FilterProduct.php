<div id="content">
    <?php
		include("../connection.ini");
        $name = $_POST["name"];
        $sql1 = "select * from products where proName like '%".$name."%' order by proSale DESC";
        $result1 = mysqli_query($conn, $sql1);
        //
        $row_per_page=10;
        $rows=mysqli_num_rows($result1);
        if ($rows>$row_per_page)
            $page=ceil($rows/$row_per_page);
        else
            $page=1;
        if(isset($_GET["start"]))
            $start=$_GET["start"];
        else
            $start=0;
        //
        $sql = "select * from products where proName like '%".$name."%' order by proSale DESC limit $start,$row_per_page";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
            <div class="item-top-product" id="item-top-product-2">
                <div class="item-top-product-img">
                    <a href="?mod=product-detail&id=<?php echo $row["proID"]; ?>"><img src="../image/<?php echo $row["proImage"]; ?>" width="100%" height="100%" alt="Product Image" title="<?php echo $row["proName"]; ?>"/></a>
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
    <div style="width: 300px; height: auto; margin: auto; color: black; font-size: 20px; margin-top: 50px; clear: both;">
    <?php
        $page_cr=($start/$row_per_page)+1;

        for($i=1;$i<=$page;$i++)
        {
                if ($page_cr!=$i)
                    echo "<a href='?mod=news&start=".$row_per_page*($i-1)."'>$i&nbsp;</a>";
                else
                    echo "&nbsp;[ ".$i." ]&nbsp;";
            
        }

    ?>
    </div>
</div>