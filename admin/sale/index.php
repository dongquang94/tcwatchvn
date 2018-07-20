<?php
    $act = "";
    if(isset($_GET["act"]))
        $act = $_GET["act"];
    switch($act){
        case "new":
            include("sale/NewSale.php");
            break;

        case "delete";
            include("sale/DeleteSale.php");
            break;

        case "edit";
            include("sale/EditSale.php");
            break;

        default:
            include("sale/SelectSale.php");
            break;
    }
?>
