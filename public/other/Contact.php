<?php
	include("../connection.ini");
    $sql = "select * from other where otherID=4";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<div id="content">
    <div id="cont-news-detail">
        <h2 id="title-news-detail"><?php echo $row["otherName"]; ?></h2>
        <span id="content-news-detail"><?php echo $row["otherContent"]; ?></span><br />
    </div>
</div>