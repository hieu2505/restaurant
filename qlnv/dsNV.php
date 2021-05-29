<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <title>QLNV</title>
</head>
<style>
  body{
    background-color:rgb(255, 236, 233);
  }
  table{
    padding:0px;
    margin:0px;
  }
  button{

    background-color: cyan;
    width: 50px;
    height: 30px;
  }
  a{
    text-decoration: none;
  }
</style>
<body>
  <?php
  include 'header.php';

  ?>
  <center>
    <h1 >DANH SÁCH NHÂN VIÊN</h1>
    <form method="POST" action="">
      <input type="text" placeholder="Search" name="search" style="width: 300px;height:30px;background:rgb(220, 216, 229);border:1px solid black;border-radius:8px;margin-top:15px">&nbsp;
      <button style="width: 100px;height:30px;border:1px solid black;border-radius:8px">Search</button><br><br>
    </form>
    <table class= "table-bordered" width="70%">           
      <header></header>
      <tr>
        <th scope="col">STT</th>              
        <th scope="col">Họ và tên</th>
        <th scope="col">Số điện thoại</th>
        <th scope="col">Giờ làm việc</th>
        <th scope="col" colspan="2"><center>Chức năng<br>
          <button style="border-radius:5px"><a href='dangnhap1.php?fphone=$phone'>Thêm</a></button></center></th>
        </tr>
      </header>
      <?php
      $db=mysqli_connect('localhost','root','','demo_db');
      if(!$db){
        echo "Lỗi kết nối";
      }else{
        $sql_hienthi="select * from t_nhanvien";
        if(isset($_POST['search'])){
          $search=$_POST['search']; 
          $sql_hienthi="select * from t_nhanvien where fname like '%$search%'";
        }

        $kq=mysqli_query($db,$sql_hienthi);
        if(mysqli_num_rows($kq)>0){
          $i=0;
          while($r=(mysqli_fetch_array($kq))){
            $i++;
            $phone=$r['fphone'];
            echo "<tbody>";
            echo "<tr>";
            echo "<th>$i</th>";                                                      
            echo "<th>".$r['fname']."</th>";
            echo "<th>".$r['fphone']."</th>";
            echo "<th>".$r['ftime']."</th>";
            echo "<th><center><button style=border-radius:5px><a href='xoaNV.php?fphone=$phone'>Xóa</a></button></center></th>";
            echo "<th><center><button style=border-radius:5px><a href='suaNV.php?fphone=$phone'>Sửa</a></button></center></th>";
            echo "</tr>";
            echo "</tbody>";
          }
        }
      }

      ?>
    </table><br><br>
    
  </center>
</body>
</html>