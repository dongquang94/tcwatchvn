<?php
	include("../connection.ini");
    $mod = "";
    $id = "";
    if(isset($_GET["mod"])) $mod = $_GET["mod"];
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        switch($mod){
            case "product-detail":
                $sql = "select proView from products where proID='".$id."'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $countView = $row["proView"] + 1 ;
                $sql1 = "update products set proView='".$countView."' where proID='".$id."'";
                mysqli_query($conn, $sql1);
                break;
            case "news-detail":
                $module = "news";
                $sql = "select newsView from news where newsID='".$id."'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $countView = $row["newsView"] + 1 ;
                $sql1 = "update news set newsView='".$countView."' where newsID='".$id."'";
                mysqli_query($conn, $sql1);
                break;
            default:
                break;
        }
    }
?>