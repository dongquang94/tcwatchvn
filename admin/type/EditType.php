<?php
    include("../connection.ini");
    if(isset($_POST["edit"])){
        $typeID = $_POST["typeID"];
        $typeName = $_POST["typeName"];
        $sql1 = "update types set typeName='".$typeName."' where typeID='".$typeID."'";
        if(mysqli_query($conn, $sql1)){
            echo "<script>alert('Sửa thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=type";
                </script>
            <?php
        }else{
            echo "<script>alert('Sửa thất bại!');</script>";
            ?>
                <script>
                    window.location = "?mod=type";
                </script>
            <?php
        }
    }
?>   
