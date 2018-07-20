<?php
    include("../connection.ini");
    $catID = $_GET["catID"];
    $check = mysqli_query($conn, "select * from catalogues where catIDParent='".$catID."'");
    if(mysqli_num_rows($check)!=0){
         echo "<script>alert('Bạn không thể xóa danh mục gốc, hãy vui lòng xóa các danh mục con của danh mục này trước khi xóa danh mục này!');</script>";
        ?>
            <script>
                window.location = "?mod=catalog";
            </script>
        <?php
    }else{
        $sql = "delete from catalogues where catID='".$catID."'";
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Xóa thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=catalog";
                </script>
            <?php
        }else{
            echo "<script>alert('Xóa thất bại');</script>";
            ?>
                <script>
                    window.location = "?mod=catalog";
                </script>
            <?php
        }
    }
?>