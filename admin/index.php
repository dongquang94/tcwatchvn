<!DOCTYPE HTML>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang quản trị (TC Watch)</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="css/style.css" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php
    session_start();
    if (!isset($_SESSION['username'])) {
       header('Location: Login.php');
    }
?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Trang quản trị TVWatch.vn</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Xin chào: <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="?mod=user"><i class="fa fa-fw fa-user"></i> Thông tin</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Đăng xuất</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Quản trị</a>
                    </li>
                    <li>
                        <a href="?mod=catalog"><i class="fa fa-fw fa-list-ul"></i> Danh mục</a>
                    </li>
                    <li>
                        <a href="?mod=type"><i class="fa fa-fw fa-building"></i> Loại sản phẩm</a>
                    </li>
                    <li>
                        <a href="?mod=product"><i class="fa fa-fw fa-suitcase"></i> Sản phẩm</a>
                    </li>
                    <li>
                        <a href="?mod=news"><i class="fa fa-fw fa-edit"></i> Tin tức</a>
                    </li>
                    <li>
                        <a href="?mod=slide"><i class="fa fa-fw fa-indent"></i> Trình chiếu</a>
                    </li>
                    <li>
                        <a href="?mod=sale"><i class="fa fa-fw fa-bookmark-o"></i> Khuyến mại</a>
                    </li>
                    <li>
                        <a href="?mod=user"><i class="fa fa-fw fa-user"></i> Tài khoản</a>
                    </li>
                    <li>
                        <a href="?mod=other"><i class="fa fa-cogs"></i> Khác</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Đăng xuất</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
            <?php
                $mod = "";
                if(isset($_GET["mod"]))
                    $mod = $_GET["mod"];
                switch($mod){
                    case "catalog":
                        include("catalog/index.php");
                        break;
                    case "type":
                        include("type/index.php");
                        break;
                    case "product":
                        include("product/index.php");
                        break;
                    case "news":
                        include("news/index.php");
                        break;
                    case "slide":
                        include("slide/index.php");
                        break;
                    case "sale":
                        include("sale/index.php");
                        break;
                    case "other":
                        include("other/index.php");
                        break;
                    case "user":
                        include("user/index.php");
                        break;
                    default:
                        include("module/MainContent.php");
                        break;
                }
            ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>