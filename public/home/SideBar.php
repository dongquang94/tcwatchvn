<?php
	include("../connection.ini");
    $sql = "select * from catalogues where catIDParent=0 order by catSort limit 8,32";
    $result = mysqli_query($conn, $sql);
?>
<div id="header-sidebar">
    <span id="text-header-sidebar">DANH MỤC SẢN PHẨM</span>
</div>
<div id="menu-sidebar">
    <nav>
        <ul>
        <?php
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        ?>
            <li class="li-sidebar-child" >
                <a href="?mod=product&id=<?php echo $row["catID"]; ?>" ><?php echo $row["catName"]; ?></a>
            </li>
        <?php
            }
        ?>
        </ul>
    </nav>
</div>