
<?php
    include("../connection.ini");
    $otherID = @$_GET["otherID"];
    if(isset($_POST["edit"])){
        $otherID = $_POST["otherID"];
        $otherContent = $_POST["otherContent"];
        $sql = "update other set otherContent='".$otherContent."' where otherID='".$otherID."'";
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Sửa thành công');</script>";
            ?>
                <script>
                    window.location = "?mod=other";
                </script>
            <?php
        }else{
            echo "<script>alert('Sửa thất bại!');</script>";
            ?>
                <script>
                    window.location = "?mod=other";
                </script>
            <?php
        }
    }
?>
