
<?php
    include("../connection.ini");
    $proID = $_GET["proID"];
    $sql = "select * from products where proID='".$proID."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if(file_exists($row["proImage"]))
	{
        echo "Error!";
	}
    else
    {
        unlink("../image/".$row["proImage"]);
    }
    $sql1 = "delete from products where proID='".$proID."'";
    if(mysqli_query($conn, $sql1)){
        echo "<script>alert('Xóa thành công');</script>";
        ?>
            <script>
                window.location = "?mod=product";
            </script>
        <?php
    }else{
        echo "<script>alert('Xóa thất bại');</script>";
        ?>
            <script>
                window.location = "?mod=product";
            </script>
        <?php
    }
?>
