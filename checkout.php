<?php
session_start();

if(isset($_SESSION["cart"]))
{
    echo "<h2>สรุปรายการสินค้า</h2>";
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
    echo "<h3>ราคาสินค้า $total บาท</h3>";

    echo "<h3>ข้อมูลผู้สั่งซื้อ</h3>";
?>
        <form action="order.php" method="post">
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname" value=""><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" value=""><br>
        <lable for="address">Address:</label><br>
<textarea id="address" name="address"  rows="4" cols="50"></textarea><br>
        <lable for="mobile">mobile number:</label><br>
        <input type="text" id="mobile" name="mobile" value=""><br>
        <input type="submit" value="Submit">
        </form> 
<?php
}
?>