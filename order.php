<?php
session_start();
$fname= $_POST["fname"];
$lname= $_POST["lname"];
$address= $_POST["address"];
$mobile= $_POST["mobile"];
$servername="localhost";
$username="root";
$password="First2545.";
$dbname="shop";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
//echo "Connect mysql successfully!";

$sql="INSERT INTO order_product (fname, lname, address,mobile)";
$sql.="VALUES ('$fname', '$lname', '$address','$mobile');";
//echo $sql;

$sql2="SELECT * FROM order_product";
$result=mysqli_query($con,$sql2);

$row=mysqli_fetch_assoc($result);

if (mysqli_query($con, $sql)) 
{
    $last_id = mysqli_insert_id($con);
   
    $sql1="INSERT INTO order_details (order_id,product_id) VALUES ";

    for($i=0;$i<count($_SESSION["cart"]);$i++){
        $item_id=$_SESSION["cart"][$i]['id'];
        $sql1.="('$last_id','$item_id')";
        if($i<count($_SESSION["cart"])-1)
         $sql1.=",";
        else
         $sql.=";";
    }
    //echo $sql1;
    if(mysqli_query($con,$sql1)) 
      echo "<h3>สั่งซื้อสำเร็จ </h3>";
      echo "ชื่อผู้ซื้อ : ".$fname."    ".$lname."<br>";
      echo "ที่อยู่ในการจัดส่งสินค้า : ".$address."<br>";
      echo "หมายเลขโทรศัพท์ติดต่อ : ".$mobile."<br>";
      echo "วันเวลาที่ทำการสั่งซื้อ : ".$row["order_date"]."<br><br>";


      if(isset($_SESSION["cart"])){
        echo "<h3>รายการสินค้าที่สั่งซื้อ</h3>";
        $total=0;
        
        
        echo "<table>
              <tr>
              <th>ลำดับ&nbsp;</th>
              <th>&nbsp;&nbsp;&nbsp;&nbsp;id&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>&nbsp;&nbsp;&nbsp;&nbsp;name &nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>&nbsp;&nbsp;&nbsp;&nbsp;description &nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>&nbsp;&nbsp;&nbsp;&nbsp;price &nbsp;&nbsp;&nbsp;&nbsp;</th>
              </tr>";
            for($i=0;$i<count($_SESSION["cart"]);$i++)
            {
                $item=$_SESSION["cart"][$i];
                echo "<tr><td>".($i+1)."</td>";
                echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;".$item['id']."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;".$item['name']."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;".$item['description']."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;".$item['price']."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                
                $total+=$item['price'];
            }
        echo "</table>";
        echo "<h3>ราคาสิ้นค้าที่ต้องชำระ $total บาท</h3>";
      }
    else "เกิดข้อผิดพลาดในการสั่งซื้อ";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  mysqli_close($conn);
//$result=mysqli_query($con,$sql);
//$numrow=mysqli_num_rows($result);
?>