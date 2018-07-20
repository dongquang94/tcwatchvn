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
    $sliID = $_GET["sliID"];
    $sql = "select * from slide where sliID='".$sliID."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if(file_exists($row["sliImage"]))
	{
        echo "Error!";
	}
    else
    {
        unlink("../image/".$row["sliImage"]);
    }
    $sql = "delete from slide where sliID='".$sliID."'";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Xóa thành công');</script>";
        ?>
            <script>
                window.location = "?mod=slide";
            </script>
        <?php
    }else{
        echo "<script>alert('Xóa thất bại');</script>";
        ?>
            <script>
                window.location = "?mod=slide";
            </script>
        <?php
    }
?>
</div>
</body>
</html>