<?php

session_start();



include '../condb.php';



$product_id = mysqli_real_escape_string($con, $_GET['product_id']);

$act = mysqli_real_escape_string($con, $_GET['act']);



// add to cart





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









<body>



                                    <div class="card mt-12">

                                        <div class="card-header">

                                        </div>

                                        <div class="card-body">



                                            <form id="frmcart" name="frmcart" method="post" action="?act=update">

                                            <h4><i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs" style="font-family: kanit;" >ระบบการขายสินค้า</span></h4>

                                            <table id="example1" class="table table-borderd">

    

    <tr>

      <td class="text-center"  >รูป</td>

      

      <td class="text-center"  colspan="4">สินค้า</td>

      <td class="text-center"   >ราคา(บาท)</td>

      <td class="text-center"   >จำนวน</td>

      <td class="text-center"   >รวม(บาท)</td>

      <td class="text-center"    >ลบ</td>

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

																echo "<td  class='hidden-xs' align='center'>" . "<img src='../p_img/" . $row['p_img'] . "' width='70px' height= '70px'>" . "</td>";

																echo "<td  align='center' colspan='4'>" . $row["product_name"] . "</td>";

																

																echo "<td   align='center'>" . number_format($row["price"]) . "</td>";

																echo "<td   align='center'>";

																echo "<input type='number' name='amount[$product_id]' value='$qty' size='2' style='width: 60px;' /></td>";

																echo "<td align='center' >" . number_format($sum) . "</td>";

																//remove product

																echo "<td align='center' ><a href='saleproduct.php?product_id=$product_id&act=remove' class='btn btn-danger'>ลบ</a>   

  </td> ";

																echo "</tr>";

															}

															echo "<tr>";

                                                            echo "<td  ></td>";

                                                            echo "<td  ></td>";                                          

															echo "<td colspan='4'><b>ราคารวม</b></td>";

                                                            echo "<td  ></td>";

															echo "<td >" . "<b>" . number_format($total) . "</b>" . " บาท</td>";

															echo "<td  ></td>";

															echo "</tr>";

														}

														?>

                                                        

                                                            <?php

                                                        if($qty == 0){

                                                            echo"

                                                            <td   align='center' colspan='3'>

                                                                <input style='width: 100px; height: 37px;' type='submit'

                                                                    name='button' id='button' value='ปรับปรุง'

                                                                    class='btn btn-primary btn-sm' disabled />

                                                            </td>

                                                            

                                                            <td   align='center' colspan='4'>



                                                                <input style='width: 100px;' type='button'

                                                                    name='Submit2' value='สั่งซื้อ'

                                                                    onclick='window.location='confirm.php';'

                                                                    class='btn btn-success'  disabled />







                                                            </td> 

                                                            <td  align='right' colspan='2'>

                                                                <input type='button' name='btncancel'

                                                                    value='ยกเลิกการสั่งซื้อ'

                                                                    onclick='indow.location='saleproduct.php?act=cancel';'

                                                                    class='btn btn-danger' disabled />

                                                            </td>



                                                        </tr>";

                                                        }else{



                                                        

                                                        

                                                        ?>

                                                            <td  align="center" colspan='3'>

                                                                <input style="width: 150px; height: 37px;" type="submit"

                                                                    name="button" id="button" value="ปรับปรุง"

                                                                    class="btn btn-primary btn-sm" />

                                                            </td>

                                                        

                                                            <td   align="center" colspan='4'>



                                                                <input style="width: 150px;" type="button" 

                                                                    name="Submit2" value="สั่งซื้อ"

                                                                    onclick="window.location='confirm.php';"

                                                                    class="btn btn-success" />







                                                            </td>

                                                            <td  align="right" colspan='2'>

                                                                <input type="button" name="btncancel" 

                                                                    value="ยกเลิกการสั่งซื้อ"

                                                                    onclick="window.location='saleproduct.php?act=cancel';"

                                                                    class="btn btn-danger" />

                                                            </td>



                                                        </tr><?php ;} ?>

                                                </table>

                                            </form>

</body>



</html>

