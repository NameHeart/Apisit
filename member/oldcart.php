<?php
session_start();

include '../condb.php';

$product_id = mysqli_real_escape_string($con, $_GET['product_id']);
$act = mysqli_real_escape_string($con, $_GET['act']);

// add to cart
if ($act == 'add' && !empty($product_id)) {
	if (isset($_SESSION['cart'][$product_id])) {
		$_SESSION['cart'][$product_id]++;
	} else {
		$_SESSION['cart'][$product_id] = 1;
	}
}

//remove
if ($act == 'remove' && !empty($product_id))  //ยกเลิกการสั่งซื้อ
{
	unset($_SESSION['cart'][$product_id]);
}

//update
if ($act == 'update') {
	$amount_array = $_POST['amount'];
	foreach ($amount_array as $product_id => $amount) {
		$_SESSION['cart'][$product_id] = $amount;
	}
	echo '<script type="text/javascript">';

	echo ' alert("อัพเดทสินค้าสำเร็จ")';  //not showing an alert box.

	echo '</script>';
}

//cancle
if ($act == 'cancel')  //ยกเลิกการสั่งซื้อ
{
	unset($_SESSION['cart']);
	echo '<script type="text/javascript">';

	echo ' alert("ยกเลิกรายการสินค้าสำเร็จ")';  //not showing an alert box.

	echo '</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>KOI_CAFE</title>
</head>
<style>
body {
    background-image: url('https://png.pngtree.com/background/20210714/original/pngtree-copper-penny-color-background-design-watercolor-background-design-picture-image_1223700.jpg');
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

<?php include('hcart.php'); ?>

<body>
    <?php include('menutop.php'); ?>

    <!-- Main Header -->
    <div>
        <section class="content-header">
            <h1>
                <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs">ระบบการขายสินค้า</span>

            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="card mt-5">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body">

                                            <form id="frmcart" name="frmcart" method="post" action="?act=update">
                                                <table id="example1" class="table table-borderd">
                                                    <thead><br>
                                                        <tr class=>
                                                            <th class="text-center" colspan="7">
                                                                <h3><a class="logo">
                                                                        <span class="logo-lg"><b>ตะกร้าสินค้า
                                                                            </b></span>
                                                                    </a></span></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center" style="width: 20%; ">รูปภาพของสินค้า
                                                            </th>
                                                            <th class="text-center" style="width: 20%; ">สินค้า</th>
                                                            <th class="text-center" style="width: 15%; ">ประเภท</th>
                                                            <th class="text-center" style="width: 15%;">ราคา(บาท)</th>
                                                            <th class="text-center" style="width: 10%;">จำนวน</th>
                                                            <th class="text-center" style="width: 15%;">รวม(บาท)</th>
                                                            <th class="text-center" style="width: 15%;">ลบ</th>
                                                        </tr>

                                                        <?php
														$total = 0;
														if (!empty($_SESSION['cart'])) {
															foreach ($_SESSION['cart'] as $product_id => $qty) {
																$query_product = "SELECT * FROM koi_product as p
		INNER JOIN koi_type as t
		ON p.type_id = t.type_id
		WHERE product_id = $product_id
		ORDER BY p.product_id";
																$result_product = mysqli_query($con, $query_product) or die("Error in query: $query_product " . mysqli_error($con));
																$row = mysqli_fetch_array($result_product);
																$sum = $row['price'] * $qty;
																$total += $sum;
																echo "<tr>";
																echo "<td align='center' class='hidden-xs' >" . "<img src='../p_img/" . $row['p_img'] . "' width='100px' height= '100px'>" . "</td>";
																echo "<td width='200'align='center' ><FONT SIZE='4' >" . $row["product_name"] . "</FONT></td>";
																echo "<td width='334'align='center' ><FONT SIZE='4' >" . $row["type_name"] .  "</FONT></td> ";
																echo "<td width='46' align='center' ><FONT SIZE='4' >" . number_format($row["price"], 2) . "</FONT></td>";
																echo "<td width='57' align='center' >";
																echo "<input type='number' name='amount[$product_id]' value='$qty' size='2' style='width: 100px;' /></td>";
																echo "<td width='93' align='center' ><FONT SIZE='4' >" . number_format($sum, 2) . "</FONT></td>";
																//remove product
																echo "<td align='center' ><a href='cart.php?product_id=$product_id&act=remove' class='btn btn-danger'>ลบ</a>   
  </td> ";
																echo "</tr>";
															}
															echo "<tr>";
															echo "<td colspan='5' align='right'><b>ราคารวม</b></td>";
															echo "<td align='right' >" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
															echo "<td align='left' ></td>";
															echo "</tr>";
														}
														?>
                                                        
                                                        <tr>
                                                            <td colspan="1">
                                                                <input type="button" name="back"
                                                                    value="กลับไปหน้าสินค้า"
                                                                    onclick="window.location='index.php';"
                                                                    class="btn btn-info" />
                                                            </td>
                                                            <?php
                                                        if($qty == 0){
                                                            echo"
                                                            <td colspan='2' align='center'>
                                                                <input style='width: 150px; height: 37px;' type='submit'
                                                                    name='button' id='button' value='ปรับปรุง'
                                                                    class='btn btn-primary btn-sm' disabled />
                                                            </td>
                                                            
                                                            <td colspan='2' align='center'>

                                                                <input style='width: 150px;' type='button'
                                                                    name='Submit2' value='สั่งซื้อ'
                                                                    onclick='window.location='confirm.php';'
                                                                    class='btn btn-success'  disabled />



                                                            </td> 
                                                            <td colspan='2' align='right'>
                                                                <input type='button' name='btncancel'
                                                                    value='ยกเลิกการสั่งซื้อ'
                                                                    onclick='indow.location='cart.php?act=cancel';'
                                                                    class='btn btn-danger' disabled />
                                                            </td>

                                                        </tr>";
                                                        }else{

                                                        
                                                        
                                                        ?>
                                                            <td colspan="2" align="center">
                                                                <input style="width: 150px; height: 37px;" type="submit"
                                                                    name="button" id="button" value="ปรับปรุง"
                                                                    class="btn btn-primary btn-sm" />
                                                            </td>
                                                        
                                                            <td colspan="2" align="center">

                                                                <input style="width: 150px;" type="button"
                                                                    name="Submit2" value="สั่งซื้อ"
                                                                    onclick="window.location='confirm.php';"
                                                                    class="btn btn-success" (if($qty=0)) />



                                                            </td>
                                                            <td colspan="2" align="right">
                                                                <input type="button" name="btncancel"
                                                                    value="ยกเลิกการสั่งซื้อ"
                                                                    onclick="window.location='cart.php?act=cancel';"
                                                                    class="btn btn-danger" />
                                                            </td>

                                                        </tr><?php ;} ?>
                                                </table>
                                            </form>
</body>

</html>
<?php include('footer.php'); ?>