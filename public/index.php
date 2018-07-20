<?php session_start(); ?>
<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<meta name="author" content="SU1408L" />
    <link rel="shortcut icon" type="image/x-icon" href="../image/logo_demo.png"/>
    <!-- css -->
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/header.css" rel="stylesheet" type="text/css"/>
    <link href="../css/menu-top.css" rel="stylesheet" type="text/css"/>
    <link href="../css/side-bar.css" rel="stylesheet" type="text/css"/>
    <link href="../css/top-view-product.css" rel="stylesheet" type="text/css"/>
    <link href="../css/slide-show.css" rel="stylesheet" type="text/css"/>
    <link href="../css/sale.css" rel="stylesheet" type="text/css"/>
    <link href="../css/top-product.css" rel="stylesheet" type="text/css"/>
    <link href="../css/hot-news.css" rel="stylesheet" type="text/css"/>
    <link href="../css/footer.css" rel="stylesheet" type="text/css"/>
    <link href="../css/pro-detail.css" rel="stylesheet" type="text/css"/>
    <link href="../css/news.css" rel="stylesheet" type="text/css"/>
    <link href="../css/news-detail.css" rel="stylesheet" type="text/css"/>
    <link href="../css/linhnguyen.css" rel="stylesheet" type="text/css"/>

    
    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=vi"> </script>
    <script src="../js/jquery.popup.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(window).load(function() {
            var mod = document.getElementById("mod_get").value;
            console.log(mod);
            if (mod == 1) {
              $('#myModal').linhnguyen($('#myModal').data());
                }
            });
        var map;
        function initialize() {
            var myLatlng = new google.maps.LatLng(21.006588,105.851178);
            var myOptions = {
            zoom: 16,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("maps"), myOptions); 
          // Biến text chứa nội dung sẽ được hiển thị
        var text;
        text= "<b style='color:#00F' " + 
                 "style='text-align:center'>TC Watch<br />" + 
             "<img src='../image/home.png'  /></b>";
           var infowindow = new google.maps.InfoWindow(
            { content: text,
                size: new google.maps.Size(100,50),
                position: myLatlng
            });
               infowindow.open(map);    
            var marker = new google.maps.Marker({
              position: myLatlng, 
              map: map,
              title:"TC Watch"
          });
        }
    </script>

	<title>TC Watch</title>
    <?php
        include("../connection.ini");
    ?>
    <!-- header -->
    <div id="header">
        <?php
            include("home/Header.php");
        ?>
    </div>
    <!-- menu-top -->
    <div id="menu-top">
        <?php
            include("home/MenuTop.php");
        ?>
    </div>
</head>
<body id="container" onLoad="initialize()">
    <!-- side-bar -->
    <div id="side-bar">
        <?php
            include("home/SideBar.php");
        ?>
    </div>
    <?php
        $mod = "";
        if(isset($_GET["mod"])) $mod = $_GET["mod"];
        switch($mod){
            case "product":
                include("product/Product.php");
                break;
            case "product-detail":
                include("product/ProductDetail.php");
                break;
            case "filter":
                include("product/FilterProduct.php");
                break;
            case "news-detail":
                include("news/NewsDetail.php");
                break;
            case "news":
                include("news/News.php");
                break;
            case "guarantee":
                include("other/Guarantee.php");
                break;
            case "guide":
                include("other/Guide.php");
                break;
            case "intros":
                include("other/Intro.php");
                break;
            case "contact":
                include("other/Contact.php");
                break;
            case "type":
                include("type/Type.php");
                break;
            default:
    ?>
                <!-- content -->
                <div id="content">
                <?php
                    include("home/SlideShow.php");
                    include("home/TopViewProduct.php");
                ?>
                </div>
    <?php
                include("home/Home.php");
                if (!isset($_SESSION["popup-show"])) {
                echo '<input type="text" hidden id="mod_get" value="1">';
                echo '<div id="myModal" class="linhnguyen-modal">
            <div class="fb-page" data-href="https://www.facebook.com/TC-WATCH-1183852121631178/" data-width="500" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
            <a class="close-linhnguyen-modal">X</a>
        </div>';
                $_SESSION["popup-show"] = 1;
                }
                break;
        }
    ?>
    <?php
        // update view
        include("updateview/UpdateView.php");
    ?>
</body>
    <!-- facebook -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
<!-- footer -->
<footer>
    <?php
        include("home/Footer.php");
    ?>
</footer>
<!-- popup -->
        
<!-- endpoppup -->

</html>