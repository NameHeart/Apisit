<?php
session_start();
include("../condb.php");

?>



<meta charset=utf-8 />

<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php

$total = $_POST["total"];
$dttm = Date("Y-m-d G:i:s");
$user_id = $_SESSION['user_id'];
$detail = $_POST["detail"];
$o_status = 0;

//บันทึกการสั่งซื้อลงใน order_detail
mysqli_query($con, "BEGIN");
$sql1	= "INSERT INTO order_head VALUE(null, '$dttm', '$total','$user_id','$detail','$o_status')";
$query1	= mysqli_query($con, $sql1) or die("Error in query: $sql1 " . mysqli_error($con));
//exit;
//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
$sql2 = "SELECT MAX(o_id) as o_id 
	FROM order_head 
	WHERE o_dttm='$dttm' ";
$query2	= mysqli_query($con, $sql2) or die("Error in query: $sql2 " . mysqli_error($con));
$row = mysqli_fetch_array($query2);
$o_id = $row["o_id"];




//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
foreach ($_SESSION['cart'] as $product_id => $qty) {
	$sql3	= "SELECT * FROM koi_product WHERE product_id=$product_id ";
	$query3	= mysqli_query($con, $sql3) or die("Error in query: $sql3 " . mysqli_error($con));
	$row3	= mysqli_fetch_array($query3);
	$pricetotal = $row3['price'] * $qty;
	$type_id = $row3['type_id'];

	$sql4	= "INSERT INTO order_detail VALUES(null, $o_id, $product_id, $type_id , $qty, '$pricetotal', '$dttm','$user_id')";
	$query4	= mysqli_query($con, $sql4) or die("Error in query: $sql4 " . mysqli_error($con));
}

if ($query1 && $query4) {
	mysqli_query($con, "COMMIT");
	$msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
	foreach ($_SESSION['cart'] as $product_id) {
		unset($_SESSION['cart']);
	}
} else {
	mysqli_query($con, "ROLLBACK");
	$msg = "บันทึกข้อมูลไม่สำเร็จ ";
}
?>
<script type="text/javascript">
alert("<?php echo $msg; ?>");
window.location = 'bill.php';
</script>






</body>

</html>