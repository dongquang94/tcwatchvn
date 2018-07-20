<?php
    include("../connection.ini");
    $sliID = @$_GET["sliID"];

    if(isset($_POST["edit"])){
        $img ="";
        if(isset($_FILES["sliImage"]) and $_FILES["sliImage"]["size"]>0)
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
        	$imgName = $datetime."-".$_FILES["sliImage"]["name"];
            copy($_FILES["sliImage"]["tmp_name"],"../image/".$datetime."-".$_FILES["sliImage"]["name"]);
            $img = ", sliImage='".$imgName."'";
        }
        $sliID = $_POST["sliID"];
        $sliTitle = $_POST["sliTitle"];
        $sliShow = $_POST["sliShow"];
        $sliSort = $_POST["sliSort"];
        if($sliShow==1){
            $sql = "update slide set sliTitle='".$sliTitle."'$img, sliShow=1, sliSort='".$sliSort."' where sliID='".$sliID."'";
        }else{
            $sql = "update slide set sliTitle='".$sliTitle."'$img, sliShow=0, sliSort=100 where sliID='".$sliID."'";
        }
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Sửa thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=slide";
                </script>
            <?php
        }else{
            echo "<script>alert('Sửa thất bại!');</script>";
            ?>
                <script>
                    window.location = "?mod=slide";
                </script>
            <?php
        }
    }
?>
