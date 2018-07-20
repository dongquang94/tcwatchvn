<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
	<meta name="author" content="SU1408L" />
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php
    include("../connection.ini");
    $proID = $_GET["proID"];
    $sql = "select * from products where proID='".$proID."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $cata = mysqli_query($conn, "select catName from catalogues where catID='".$row["catID"]."'");
    $cat = mysqli_fetch_array($cata, MYSQLI_ASSOC);
    $type = mysqli_query($conn, "select typeName from types where typeID='".$row["typeID"]."'");
    $typ = mysqli_fetch_array($type, MYSQLI_ASSOC);
?>
    <div style="float: left; padding: 30px;margin-top: 50px; width: 300px; height: auto;background: red;">
        <img src="../image/<?php echo $row["proImage"]?>" width="300px" height="auto"/>
    </div>
    <div style="padding: 30px; float: left;margin-top: 50px;width: 300px; height: 400px;background: yellow;">
        <b style="font-size: 200%;"><?php echo $row["proName"];?></b><br /><br />
        Giá: <i style="font-size: 150%;"><?php echo $row["proCost"];?></i>&nbsp;&nbsp;&nbsp;<i>VNĐ</i><br /><br />
        <p>Danh mục sản phẩm: <i><?php echo $cat["catName"]; ?></i></p><br />
        <p>Loại sản phẩm: &nbsp;<i><?php echo $typ["typeName"]; ?></i></p><br />
        <p>Số lượng truy cập: <i><?php echo $row["proView"]; ?></i></p>
        <p></p>
    </div>
    <div style="width: 300px; height: auto;float: left;margin-top: 50px;background: blue;">
        <?php echo $row["proInfo"]; ?>
    </div>
    <div style="float: left;width: 500px;height: auto;margin-top: 50px;padding: 30px;background: #FF8040;">
        <?php echo $row["proDescription"]; ?>
        <br /><br /><br />
        <a href="?mod=product" id="back"><- Quay lại</a>
    </div>
</body>
</html>