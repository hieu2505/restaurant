<!DOCTYPE html>
<html>
    <head>
    <link rel="shortcut icon" href="./images/logoD.png">
        <title>Danh sách sản phẩm</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style0.css">
        <style>
          body{
            font-family: arial;
          }
          .container1{
            width: 1200px;
            margin: 0 auto;
          }
          h1{
            text-align: center;
          }
          .product-items{
            border: 1px solid #ccc;
            padding: 30px;
            background-color:#FBBC01;
            
          }
          .product-item{
            float: left;
            width: 250px;
            height:360px;
            margin: 1%;
            padding: 20px;
            box-sizing: border-box;
            border: 3px solid #000;
            line-height: 26px;
          }
          .product-item label{
            font-weight: bold;
          }
          .product-item p{
            margin: 0;
            line-height: 26px;
            max-height: 52px;
            overflow: hidden;
          }
          .product-price{
            color: red;
            font-weight: bold;
          }
          .product-img{
            padding: 1px;
            border: 1px solid #ccc;
            margin-bottom: 5px;
            width:200px;
            height:150px;
          }
          .product-item img{
            width:200px;
            height:150px;
          }
          .product-item ul{
            margin: 0;
            padding: 0;
            border-right: 1px solid #000;
          }
          .product-item ul li{
            float: left;
            width: 33.3333%;
            list-style: none;
            text-align: center;
            border: 1px solid #000;
            border-right: 0;
            box-sizing: border-box;
          }
          .clear-both{
            clear: both;
          }
          a{
            text-decoration: none;
          }
          .buy-button{
            text-align: right;
            margin-top: 10px;
          }
          .buy-button a{
            background: #444;
            padding: 5px;
            color: #fff;
          }
          #pagination{
            text-align: right;
            margin-top: 15px;
          }
          .page-item{
            border: 1px solid #000;
            padding: 5px 9px;
            color: #000;
          }
          .current-page{
            background: #000;
            color: #FFF;
          }
          #footer-contact{
            background-color:rgba(5,5,5,0.8);
            color: #fff;
            font-family: 'Lobster';
            display: inline-block; 
            
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            
          }
          #footer-logo{
           margin-left: 50%;
           margin-right: 50%;
         }
         .footer-box{ 
          position: relative;
          width: 230px;   
          margin: 30px;
          box-sizing: border-box;
          display: inline-block;
          
        }
        .footer-box h3{
          color: orange; 
        }
        #fa-in{
          display: flex;
        }
        ul{
          list-style-type: none;
          line-height: 30px;
        }

        i{
          font-size: 30px;
          margin-right: 10px;
          color: #fff;
        }
      </style>
    </head>
    <body>
    
        <?php
        include 'connect_db.php';
        $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:4;
        $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
        $offset = ($current_page - 1) * $item_per_page;   
        $search = isset($_GET['name']) ? $_GET['name'] : "";
        if ($search) {
            $where = "WHERE `name` LIKE '%" . $search . "%'";
        }
        if ($search) {
            $products = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . $search . "%' ORDER BY `id` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
            $totalRecords = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . $search . "%'");
        } else {
            $products = mysqli_query($con, "SELECT * FROM `product` ORDER BY `id` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
            $totalRecords = mysqli_query($con, "SELECT * FROM `product`");
        }
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        ?>
        <div class="container">
           
            <form id="product-search" method="GET"> 
                <h1>Danh sách món ăn</h1>
                <center>
                    <input id="text-search" type="text" value="<?=isset($_GET['name']) ? $_GET['name'] : ""?>" name="name" placeholder="Tìm kiếm món ăn"/>
                    <input id="text-search" type="text" value="<?=isset($_GET['kindoffood']) ? $_GET['kindoffood'] : ""?>" name="kindoffood" placeholder="Tìm kiếm loại món ăn"/>
                    <input id="click-search" type="submit" value="Tìm kiếm" />
                </center><br>
            </form>
            <div class="product-items">
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <div class="product-item">
                        <div class="product-img">
                            <a href="detail.php?id=<?= $row['id'] ?>"><img src="<?= $row['image'] ?>" title="<?= $row['name'] ?>" /></a>
                        </div>

                        <strong><a href="detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></strong><br/>
                        <label>Giá: </label><span class="product-price"><?= number_format($row['price'], 0, ",", ".") ?> đ</span><br/>
                        <p><strong>Mô tả:</strong><?= $row['content'] ?></p>
                        <p><strong><?= $row['kindoffood'] ?></strong></p>
                        <div class="buy-button">
                            <a href="detail.php?id=<?= $row['id'] ?>">Chi tiết</a>
                        </div>
                    </div>
                <?php } ?>
                <div class="clear-both"></div>
                <?php
                include './pagination.php';
                ?> 
                <div class="clear-both"></div>
            </div>
        </div>
        <div id="footer-contact">

<div id="footer-logo">
  <img src="images/logo.jpg" alt="" >
</div>

<div class="footer-box">
  <h3>Giới thiệu về chúng tôi</h3>
  <h5>Website được vận hành & phát triển bởi nhà hàng WORLD OF MR.D</h5>
  <ul class="fa-in">
    <a href="https://www.facebook.com/RiceMrD">
          <i class="fab fa-facebook"></i>  
        
        </a>
    
        <a href="https://www.instagram.com/rice_mrd/">
          <i class="fab fa-instagram"></i>
        </a>
  </ul>
</div>
<div class="footer-box">
   <h3>Trải nghiệm tuyệt vời</h3>
   <h5>Không gian thoải mái, sang trọng và ấm cúng.<br><br>Món ăn đa dạng và tuyệt vời.</h5>
</div>
<div class="footer-box">
   <h3>Liện hệ</h3> 
   <a href="https://www.google.com/maps/place/149+Ph%E1%BB%91+Hu%E1%BA%BF,+Ng%C3%B4+Th%C3%AC+Nh%E1%BA%ADm,+Hai+B%C3%A0+Tr%C6%B0ng,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam/@21.0142978,105.8496042,17z/data=!3m1!4b1!4m5!3m4!1s0x3135ab8cb9e1e20f:0x2ee166fbd4a8ef0f!8m2!3d21.0142928!4d105.8517929">       
    <i class="fas fa-map-marker-alt"></i>
    <span style="color: #fff;">Số 66,khu2,Giang xá,TT Trạm Trôi,Hoài Đức, Hà Nội</span><br><br> 
  </a>  
    <i class="fas fa-mobile-alt"></i>
    <span>0977.570.403</span>         
</div>
<div class="footer-box">
  <h3>Giờ mở cửa</h3>
  <ul>
    <li>
      <h5>Thứ 2-Thứ 6</h5>
      <span style="color: grey;">8h00'-22h00'</span>
    </li>
    <li>
      <h5>Thứ 7-Chủ nhật</h5>
      <span  style="color: grey;">7h30'-22h30'</span>
    </li>
  </ul>
</div>
</div>

</body>
</html>
    </body>
</html>