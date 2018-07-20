<?php
	include("../connection.ini");
    $id = "";
    if(isset($_GET["id"])) $id = $_GET["id"];
    $sql = "select * from news where newsID='".$id."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<div id="content">
    <div id="cont-news-detail">
        <h2 id="title-news-detail"><?php echo $row["newsTitle"]; ?></h2>
        <span id="content-news-detail"><?php echo $row["newsContent"]; ?></span><br />
        <span id="date-news-detail"><?php echo $row["newsDate"]; ?></span>
    </div>
</div>