<?php
    include("../connection.ini");
    if(isset($_POST["addNew"])){
        $datetime = date_create()->format('Y-m-d-H-i-s');
        $img = $datetime."-".$_FILES["saleImage"]["name"];
        copy($_FILES["saleImage"]["tmp_name"],"../image/".$datetime."-".$_FILES["saleImage"]["name"]);

        $saleTitle = $_POST["saleTitle"];
        $saleShow = $_POST["saleShow"];
        $saleSort = $_POST["saleSort"];
        if($saleShow==1){
            $sql = "insert into sales(saleTitle, saleImage, saleShow, saleSort) values('".$saleTitle."','".$img."',1,'".$saleSort."')";
        }else{
            $sql = "insert into sales(saleTitle, saleImage, saleShow, saleSort) values('".$saleTitle."','".$img."',0,100)";
        }
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Thêm mới thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=sale";
                </script>
            <?php
        }else{
            echo "<script>alert('Thêm mới thất bại!');</script>";
            ?>
                <script>
                    window.location = "?mod=sale";
                </script>
            <?php
        }
    }
?>
