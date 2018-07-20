<?php
    $act = "";
    if(isset($_GET["act"]))
        $act = $_GET["act"];
    switch($act){
        case "new":
            include("type/NewType.php");
            break;
            
        case "delete";
            include("type/DeleteType.php");
            break;
            
        case "edit";
            include("type/EditType.php");
            break;
        
        default:
            include("type/SelectType.php");
            break;
    }
?>
</html>