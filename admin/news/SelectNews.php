<?php
    include("../connection.ini");
    $sql1 = "select * from news order by newsID";
    $result1 = mysqli_query($conn, $sql1);
    //
    $row_per_page=10;
    $rows=mysqli_num_rows($result1);
    if ($rows>$row_per_page)
        $page=ceil($rows/$row_per_page);
    else
        $page=1;
    if(isset($_GET["start"]))
        $start=$_GET["start"];
    else
        $start=0;
    //
    $sql = "select * from news order by newsView DESC limit $start,$row_per_page";
    $result = mysqli_query($conn, $sql);
?>

<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Tin tức
            </h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Quản trị</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Tin tức
                </li>
            </ol>
        </div>
    </div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <h2>Danh sách tin tức</h2>
        <div class="table-responsive">
            <h5>Số lượng tin đã đăng: <?php echo $rows;?></h5>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tiêu đề</th>
                        <th>Vắn tắt</th>
                        <th>Ảnh</th>
                        <th>Ngày đăng</th>
                        <th>Số lượt xem</th>
                        <th colspan="3" class="text-center"><a href="?mod=news&act=new" class="btn btn-default"><i class="fa fa-plus"></i> Thêm mới</a></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                    <tr>
                        <td class="col-lg-2"><?php echo $row["newsTitle"]; ?></td>
                        <td class="col-lg-3"><?php echo $row["newsDescription"]; ?></td>
                        <td class="col-lg-3"><img src="../image/<?php echo $row["newsImage"]; ?>" width="200px" alt="Product Image" title="Product Image"/></td>
                        <td class="col-lg-1"><?php echo $row["newsDate"]; ?></td>
                        <td class="col-lg-1"><?php echo $row["newsView"]; ?></td>
                        <td><a href="../public/index.php?mod=news-detail&id=<?php echo $row["newsID"]; ?>" target="_blank"><i class="fa fa-search"></i> Xem</a></td>
                        <td><a href="?mod=news&act=edit&newsID=<?php echo $row["newsID"]; ?>"><i class="fa fa-pencil"></i> Sửa</a></td>
                        <td><a href="?mod=news&act=delete&newsID=<?php echo $row["newsID"]; ?>" onClick="if(!confirm('Bạn có chắc chắn muốn xóa?')) return false;"><i class="fa fa-times"></i> Xóa</a></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div style="width: 300px; height: auto; color: black; font-size: 20px; padding-bottom: 20px; padding-top: 20px; text-align: center; width: 100%; clear: both; ">
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