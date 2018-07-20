<script>
    $('.cont-slide-show img:gt(0)').hide();
    setInterval(function(){ },4000);
    $('.cont-slide-show :first-child').fadeOut().next('img')
    .fadeIn()
    .appendTo('.cont-slide-show')
    $(function() {
        $('.cont-slide-show img:gt(0)').hide();
        setInterval(function(){
        $('.cont-slide-show :first-child').fadeOut()
        .next('img').fadeIn()
        .end().appendTo('.cont-slide-show');},
        4000);
    })
    /*
    $(function() {
    var $galitem = $('.cont-slide-show').children();
    // Đếm các ảnh trong gallery
    var $galsize = $('.cont-slide-show img').size();
    // Thêm nút Prev và Next vào gallery
    $('.cont-slide-show').append('<div id="galprev">Prev</div><div id="galnext">Next</div>');
    // Ẩn tất cả các ảnh và hiện ảnh đầu tiên
    $('.cont-slide-show img:gt(0)').hide();
    $currentimg = 0;
    // Thêm id để phân biệt riêng từng ảnh
    $galitem.attr("id", function (arr) {
        return "galleryitem" + arr;
    });
    // Thêm sự kiện click vào nút Prev
    $('#galprev').click(function () {
        if ($currentimg > 0) {
            previmg($currentimg);
            $currentimg = $currentimg - 1;
        }
    });
    // Thêm sự kiện click vào nút Next
    $('#galnext').click(function () {
        if ($currentimg < $galsize - 1) {
            nextimg($currentimg, $galsize);
            $currentimg = $currentimg + 1;
        }
    });
})
// Hàm xử lý khi nút Next được ấn
function nextimg($img, $size) {
    $n_img = $img + 1;
    if ($n_img < $size) {
        $('#galleryitem' + $img).fadeOut();
        $('#galleryitem' + $n_img).fadeIn();
    }
}
// Hàm xử lý khi nút Previous được ấn
function previmg($img) {
    $p_img = $img - 1;
    if ($p_img >= 0) {
        $('#galleryitem' + $img).fadeOut();
        $('#galleryitem' + $p_img).fadeIn();
    }
}
*/
</script>
<div class="cont-slide-show">
    <?php
		include("../connection.ini");
        $sql = "select * from slide where sliShow=1 order by sliSort";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
        <img src="../image/<?php echo $row["sliImage"]; ?>" height="100%" width="100%" alt="Slide Show" title="<?php $row["sliTitle"]; ?>"/>
    <?php
        }
    ?>
</div>