<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
	<meta name="author" content="SU1408L" />
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<?php
    include("../connection.ini");
    $newsID = $_GET["newsID"];
    $sql = "select * from news where newsID='".$newsID."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if(file_exists($row["newsImage"]))
	{
        echo "Error!";
	}
    else
    {
        unlink("../image/".$row["newsImage"]);
    }
    $sql1 = "delete from news where newsID='".$newsID."'";
    if(mysqli_query($conn, $sql1)){
        echo "<script>alert('Xóa thành công');</script>";
        ?>
            <script>
                window.location = "?mod=news";
            </script>
        <?php
    }else{
        echo "<script>alert('Xóa thất bại');</script>";
        ?>
            <script>
                window.location = "?mod=news";
            </script>
        <?php
    }
?>
</div>
</body>
</html>