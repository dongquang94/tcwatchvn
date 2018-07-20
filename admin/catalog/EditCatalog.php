<?php
    include("../connection.ini");
    if(isset($_POST["edit"])){
        $catID = $_POST["catID"];
        $catName = $_POST["catName"];
        $catIDParent = $_POST["catIDParent"];
        $catShow = $_POST["catShow"];
        $catSort = $_POST["catSort"];
        if($catIDParent==0){
            $sql1 = "update catalogues set catName='".$catName."',catIDParent='".$catIDParent."',catSort='".$catSort."',catShow='".$catShow."' where catID='".$catID."'";
        }else{
            $sql1 = "update catalogues set catName='".$catName."',catIDParent='".$catIDParent."',catSort=100,catShow=0 where catID='".$catID."'";
        }
        if(mysqli_query($conn, $sql1)){
            echo "<script>alert('Sửa thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=catalog";
                </script>
            <?php
        }else{
            echo "<script>alert('Sửa thất bại!');</script>";
            ?>
                <script>
                    window.location = "?mod=catalog";
                </script>
            <?php
        }
    }
?>   