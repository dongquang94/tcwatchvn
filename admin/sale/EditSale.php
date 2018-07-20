
<?php
    include("../connection.ini");
    $saleID = @$_GET["saleID"];

    if(isset($_POST["edit"])){
        $img ="";
        if(isset($_FILES["saleImage"]) and $_FILES["saleImage"]["size"]>0)
        {
        	if(file_exists($_POST["imgOld"]))
        	{
        	  echo "Error!";
        	}
            else
            {
                unlink("../image/".$_POST["imgOld"]);
            }
            $datetime = date_create()->format('Y-m-d-H-i-s');
        	$imgName = $datetime."-".$_FILES["saleImage"]["name"];
            copy($_FILES["saleImage"]["tmp_name"],"../image/".$datetime."-".$_FILES["saleImage"]["name"]);
            $img = ", saleImage='".$imgName."'";
        }
        $saleID = $_POST["saleID"];
        $saleTitle = $_POST["saleTitle"];
        $saleShow = $_POST["saleShow"];
        $saleSort = $_POST["saleSort"];
        if($saleShow==1){
            $sql = "update sales set saleTitle='".$saleTitle."'$img, saleShow=1, saleSort='".$saleSort."' where saleID='".$saleID."'";
        }else{
            $sql = "update sales set saleTitle='".$saleTitle."'$img, saleShow=0, saleSort=100 where saleID='".$saleID."'";
        }
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Sửa thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=sale";
                </script>
            <?php
        }else{
            echo "<script>alert('Sửa thất bại!');</script>";
            ?>
                <script>
                    window.location = "?mod=sale";
                </script>
            <?php
        }
    }
?>
