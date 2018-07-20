<?php
    $act = "";
    if(isset($_GET["act"]))
        $act = $_GET["act"];
    switch($act){
        case "new":
            include("product/NewProduct.php");
            break;

        case "delete";
            include("product/DeleteProduct.php");
            break;

        case "edit";
            include("product/EditProduct.php");
            break;

        case "view":
            include("product/ViewProduct.php");
            break;

        default:
            include("product/SelectProduct.php");
            break;
    }
?>
</html>