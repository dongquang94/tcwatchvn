<?php
    include("../connection.ini");
    if(isset($_POST["addNew"])){
        $catName = $_POST["catName"];
        $catIDParent = $_POST["catIDParent"];
        $catShow = $_POST["catShow"];
        $catSort = $_POST["catSort"];
        if($catIDParent==0){
            $sql1 = "insert into catalogues(catName, catIDParent, catShow, catSort) values('".$catName."', '".$catIDParent."','".$catShow."','".$catSort."')";
        }else{
            $sql1 = "insert into catalogues(catName, catIDParent, catShow, catSort) values('".$catName."', '".$catIDParent."',0,100)";
        }
        if(mysqli_query($conn, $sql1)){
            echo "<script>alert('Thêm mới thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=catalog";
                </script>
            <?php
        }else{
            echo "<script>alert('Thêm mới thất bại!');</script>";
            ?>
                <script>
                    window.location = "?mod=catalog";
                </script>
            <?php
        }
    }
?>