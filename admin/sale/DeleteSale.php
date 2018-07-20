<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
	<meta name="author" content="SU1408L" />
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
 
<div id="main-content">
<?php
    include("../connection.ini");
    $saleID = $_GET["saleID"];
    $sql = "select * from sales where saleID='".$saleID."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if(file_exists($row["saleImage"]))
	{
        echo "Error!";
	}
    else
    {
        unlink("../image/".$row["saleImage"]);
    }
    $sql = "delete from sales where saleID='".$saleID."'";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Xóa thành công');</script>";
        ?>
            <script>
                window.location = "?mod=sale";
            </script>
        <?php
    }else{
        echo "<script>alert('Xóa thất bại');</script>";
        ?>
            <script>
                window.location = "?mod=sale";
            </script>
        <?php
    }
?>
</div>
</body>
</html>