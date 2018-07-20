<?php
    include("../connection.ini");
    if(isset($_POST["addNew"])){
        $datetime = date_create()->format('Y-m-d-H-i-s');
        $img = $datetime."-".$_FILES["sliImage"]["name"];
        copy($_FILES["sliImage"]["tmp_name"],"../image/".$datetime."-".$_FILES["sliImage"]["name"]);

        $sliTitle = $_POST["sliTitle"];
        $sliShow = $_POST["sliShow"];
        $sliSort = $_POST["sliSort"];
        if($sliShow==1){
            $sql = "insert into slide(sliTitle, sliImage, sliShow, sliSort) values('".$sliTitle."','".$img."',1,'".$sliSort."')";
        }else{
            $sql = "insert into slide(sliTitle, sliImage, sliShow, sliSort) values('".$sliTitle."','".$img."',0,100)";
        }
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Thêm mới thành công');</script>";
            ?>
                <script>
                     window.location = "?mod=slide";
                </script>
            <?php
        }else{
            echo "<script>alert('Thêm mới thất bại!');</script>";
            ?>
                <script>
                    window.location = "?mod=slide";
                </script>
            <?php
        }
    }
?>
