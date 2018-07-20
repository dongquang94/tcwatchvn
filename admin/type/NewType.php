<?php
    include("../connection.ini");
    if(isset($_POST["addNew"])){
        $typeName = $_POST["typeName"];
        $sql = "insert into types(typeName) values('".$typeName."')";
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Thêm mới thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=type";
                </script>
            <?php
        }else{
            echo "<script>alert('Thêm mới thất bại!');</script>";
            ?>
                <script>
                    window.location = "?mod=type";
                </script>
            <?php
        }
    }
?>