<?php
	include("../connection.ini");
    $sql = "select * from catalogues where catIDParent=0 and catShow=1 order by catSort limit 8";
    $result = mysqli_query($conn, $sql);
?>
<div class="main_menu">
    <a href="index.php" class="home"><img src="../image/home.png" width="30px" height="30px" alt="Home Image" title="Trang chủ"/></a>
    <ul>
        
        <li><a href="?mod=type&id=0">Loại sản phẩm</a>
        <ul>
        <?php
            $s = "select * from types order by typeID";
            $r = mysqli_query($conn, $s);
            while($ro = mysqli_fetch_array($r, MYSQLI_ASSOC)){    
        ?>
                <li><a href="?mod=type&id=<?php echo $ro["typeID"]; ?>"><?php echo $ro["typeName"]; ?></a></li>
        <?php
            }
        ?>
        </ul>
        </li>
        <?php
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        ?>
            <li><a href="?mod=product&id=<?php echo $row["catID"]; ?>"><?php echo $row["catName"]; ?></a>
                <ul>
                    <?php
                        $sql2 = "select * from catalogues where catIDParent='".$row["catID"]."' order by catID";
                        $result2 = mysqli_query($conn, $sql2);
                        while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                    ?>
                       <li><a href="?mod=product&id=<?php echo $row2["catID"]; ?>"><?php echo $row2["catName"]?></a></li> 
                    <?php
                        }
                    ?>
                </ul>
            </li>
        <?php
            }
        ?>
    </ul>
</div>




