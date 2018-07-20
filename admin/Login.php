<?php
    session_start();
    if (isset($_SESSION['username']))
        header('Location: index.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="../css/sb-admin.css" rel="stylesheet"> -->

    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="css/style.css" rel="stylesheet" type="text/css"/>

</head>

<body>
    <?php
        include("../connection.ini");
        if (isset($_POST["btnLogin"])) {
            $username = $_POST["username"];
            $password = md5($_POST["password"]);
            $username = strip_tags($username);
            $username = addslashes($username);
            $password = strip_tags($password);
            $password = addslashes($password);

            if ($username == "" || $password =="") {
                $error =  "Tài khoản hoặc mật khẩu bạn không được để trống!";
            } else {
                $sql = "select * from users where username = '".$username."' and password = '".$password."'";
                $query = mysqli_query($conn, $sql);
                $num_rows = mysqli_num_rows($query);
                if ($num_rows==0) {
                    $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
                } else {
                    $_SESSION['username'] = $username;
                    header('Location: ../admin/index.php');
                }
            }
        }
    ?>
    <div id="wrapper">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 wrapper_login">
                <form role="form" method="POST" action="Login.php">
                    <h2 style="text-align: center">Trang đăng nhập</h2>
                    <?php
                        if(isset($error)) {
                            echo '<li>' . $error . '</li>';
                        }
                     ?>
                    <div class="form-group">
                        <label>Tài khoản</label>
                        <input class="form-control" type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <button type="submit" name="btnLogin" class="btn btn-default col-md-12">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../js/plugins/morris/raphael.min.js"></script>
    <script src="../js/plugins/morris/morris.min.js"></script>
    <script src="../js/plugins/morris/morris-data.js"></script>

</body>

</html>