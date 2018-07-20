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
    $typeID = $_GET["typeID"];
    $sql = "delete from types where typeID='".$typeID."'";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Xóa thành công');</script>";
        ?>
            <script>
                window.location = "?mod=type";
            </script>
        <?php
    }else{
        echo "<script>alert('Xóa thất bại');</script>";
        ?>
            <script>
                window.location = "?mod=type";
            </script>
        <?php
    }
?>
</div>
</body>
</html>