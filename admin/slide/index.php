
<?php
    $act = "";
    if(isset($_GET["act"]))
        $act = $_GET["act"];
    switch($act){
        case "new":
            include("slide/NewSlide.php");
            break;

        case "delete";
            include("slide/DeleteSlide.php");
            break;

        case "edit";
            include("slide/EditSlide.php");
            break;

        default:
            include("slide/SelectSlide.php");
            break;
    }
?>
