<?php
session_start();
$servername="localhost";
$username="root";
$password="First2545.";
$dbname="shop";
$per_page=5;
if(isset($_GET["page"])) $start_page=$_GET["page"]*$per_page;
else $start_page=0;

$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
echo "<h2>รายการสินค้า</h2>";
$sql="SELECT * FROM product";
$result=mysqli_query($con,$sql);
$numrow=mysqli_num_rows($result);
echo $numrow." รายการ<br>";
for($i=0;$i<ceil($numrow/$per_page);$i++)
    echo "<a href='show_product.php?page=$i'>[".($i+1)."]</a>";

echo "<br>";
$sql="SELECT * FROM product LIMIT $start_page,$per_page";
$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){
    
    echo "<table border=1>
            <tr>
            <th>id</th>
            <th>name</th>
            <th>description</th>
            <th>price</th>
            <th></th>
            </tr>";
    while($row=mysqli_fetch_assoc($result)){
    echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>";
    echo $row["description"]."</td><td>".$row["price"]."</td>";

    echo "<td><a href='add_product.php?id=".$row["id"]."'><input type=\"submit\" style=\"font-size:15px; background-color:#0099FF	; color:white; border-color:#0099FF	 ;\" name=\"Submit\" value=\"ใส่ตระกร้า\" ></a></td></tr>";
    
    }
    echo "</table>";
}else{
    echo "0 results";
}
if(isset($_SESSION["cart"])){
$total=0;
echo "<h3>ตระกร้าสินค้า</h3>";
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
        $item=$_SESSION["cart"][$i];
        echo "<tr><td>".($i+1)."</td>";
        echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;".$item['id']."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
        echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;".$item['name']."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
        echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;".$item['description']."&nbsp;&nbsp;&nbsp;&nbsp;</td>";
        echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;".$item['price']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                
        echo "<td><a href='del_cart.php?i=".$i."'><input type=\"submit\" style=\"width:40px; height:25; font-size:15px; background-color:red; color:white; border-color:red;\" name=\"Submit\" value=\"X\" ></a></td></tr>";
        $total+=$item['price'];
    }

    

echo "</table>";

echo "<br>";

echo "<a href='del_all.php'><input type=\"submit\" name=\"Submit\" style=\"font-size:20px; background-color:#FF6600; color:white; border-color:orange;\" value=\"ลบสินค้าทั้งหมด\"></a>";
echo "<h3>ราคาสิ้นค้า $total บาท</h3>";



echo "<a href='checkout.php'><input type=\"submit\" name=\"Submit\" style=\"width:85px; height:45; font-size:20px; background-color:green; color:white; border-color:green;\" value=\"สั่งซื้อ\" ></a>";
}
mysqli_close($con);
?>