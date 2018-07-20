<?php
	include("../connection.ini");
    $sql1 = "select * from news order by newsDate";
    $result1 = mysqli_query($conn, $sql1);
    //
    $row_per_page=10;
    $rows=mysqli_num_rows($result1);
    if ($rows>$row_per_page) $page=ceil($rows/$row_per_page);
    else $page=1;

    if(isset($_GET['start']))
         $start=$_GET['start'];
    else $start=0;
    //
    $sql = "select * from news order by newsDate DESC limit $start,$row_per_page";
    $result = mysqli_query($conn, $sql);
?>
<div id="content">
    <?php
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
        <div class="item-news">
            <div class="item-news-img">
                <a href="?mod=news-detail&id=<?php echo $row["newsID"]; ?>"><img src="../image/<?php echo $row["newsImage"]; ?>" width="100%" height="100%" alt="Image News" title="<?php echo $row["newsTitle"]; ?>"/></a>
            </div>
            <div class="item-news-left">
                <div class="item-news-tilte">
                    <a href="?mod=news-detail&id=<?php echo $row["newsID"]; ?>"><?php echo $row["newsTitle"]; ?></a>
                </div>
                <div class="item-news-des">
                    <span><?php echo $row["newsDescription"]; ?></span>
                </div>
            </div>
        </div>
    <?php
        }
    ?>
    <div style="width: 300px; height: auto; margin: auto; color: black; font-size: 20px; margin-top: 50px; padding-bottom: 20px; padding-top: 10px; ">
    <?php
        $page_cr=($start/$row_per_page)+1;
        $min = $page_cr - 2;
        $max = $page_cr + 2;
        if ($min < 2) {
            $minview = 1;
        } else {
            $minview=$min;
            $dot_left = 1;
        }
        if( $max<$page ) {
            $maxview = $max;
            $dot_right = 1;
        } else {
            $maxview = $page;
        }
        if (isset($dot_left)) {
            if ($min >=2 ) {
                echo "<a href='?mod=news&start=0' style='text-decoration: none;'>1&nbsp;</a>";
            } if ($min != 2){
             echo "<span>.. </span>";
            }
        }
        for($i=1;$i<=$page;$i++)
        {
            if($i>=$minview && $i <=$maxview) {
                if ($page_cr!=$i)
                    echo "<a href='?mod=news&start=".$row_per_page*($i-1)."' style='text-decoration: none;'>$i&nbsp;</a>";
                else
                    echo "&nbsp;[ ".$i." ]&nbsp;";
            }
        }
        if(isset($dot_right)){
            echo "<span>..</span>";
        }
    ?>
    </div>
</div>
