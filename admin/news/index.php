
<?php
    $act = "";
    if(isset($_GET["act"]))
        $act = $_GET["act"];
    switch($act){
        case "new":
            include("news/NewNews.php");
            break;

        case "delete";
            include("news/DeleteNews.php");
            break;

        case "edit";
            include("news/EditNews.php");
            break;

        default:
            include("news/SelectNews.php");
            break;
    }
?>
