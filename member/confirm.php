<?php
session_start();

include '../condb.php';

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
                <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs" style="font-family: kanit;">ระบบการขายสินค้า</span>

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

                                            <form id="frmcart" name="frmcart" method="post" action="saveorder.php">
                                                <table id="example1" class="table table-borderd">
                                                    <thead><br>
                                                        <tr class=>
                                                            <th class="text-center" colspan="6">
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
                                                        </tr>
                                                        <?php
                            $total = 0;
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
                              echo "<td align='center' class='hidden-xs'>" . "<img src='../p_img/" . $row['p_img'] . "' width='100px' height= '100px'>" . "</td>";
                              echo "<td width='200'align='center'><FONT SIZE='4' >" . $row["product_name"] . "</FONT></td>";
                              echo "<td width='334'align='center'><FONT SIZE='4' >" . $row["type_name"] .  "</FONT></td> ";
                              echo "<td width='46' align='center'><FONT SIZE='4' >" . number_format($row["price"], 2) . "</FONT></td>";
                              echo "<td width='93' align='center'><FONT SIZE='4' >" . $qty . "</FONT></td>";
                              echo "<td width='93' align='center'><FONT SIZE='4' >" . number_format($sum, 2) . "</FONT></td>";
                              echo "</tr>";
                            }
                            echo "<tr>";
                            echo "<td colspan='3' align='center' >";
                            echo "รายละเอียดเพิ่มเติม <input type='text' name='detail' id='detail' size='2' style='width: 300px;height: 50px ;'  /></td>";
                            echo "<td colspan='3'  align='right'><FONT SIZE='4' >ราคารวม</FONT></td>";
                            echo "<td >" . "<FONT SIZE='4' >" . number_format($total, 2) . "" . "</FONT></td>";
                            echo "<td  ></td>";
                            echo "</tr>";
                            ?>

                                                        <td colspan="5">
                                                            <input type="button" name="back"
                                                                value="กลับไปหน้าสินค้า"
                                                                onclick="window.location='saleproduct.php';"
                                                                class="btn btn-info" />
                                                        </td>

                                                        <td colspan="3">
                                                            <input type="hidden" name="total"
                                                                value="<?php echo $total; ?>">
                                                            <input style="width: 150px;" type="submit" name="Submit2"
                                                                value="บันทึกคำสั่งซื้อ" class="btn btn-success" />
                                                        </td>
                                                </table>
                                                <p>
                                              


                                            </form>
</body>

</html>
<?php include('footer.php'); ?>