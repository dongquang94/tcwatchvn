<?php
    $act = "";
    if(isset($_GET["act"]))
        $act = $_GET["act"];
    switch($act){
        case "new":
            include("catalog/NewCatalog.php");
            break;
        case "delete";
            include("catalog/DeleteCatalog.php");
            break;
        case "edit";
            include("catalog/EditCatalog.php");
            break;
        default:
            include("catalog/SelectCatalog.php");
            break;
    }
?>