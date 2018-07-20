
<?php
    $act = "";
    if(isset($_GET["act"]))
        $act = $_GET["act"];
    switch($act){
        case "edit";
            include("other/EditOther.php");
            break;

        default:
            include("other/SelectOther.php");
            break;
    }
?>
