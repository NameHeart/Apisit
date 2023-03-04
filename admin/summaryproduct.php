<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOI_CAFE</title>
</head>
<?php include('h.php'); ?>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include('menutop.php'); ?>
        <?php include('menu_l.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span
                        class="hidden-xs" style="font-family: kanit;">ข้อมูลยอดขายสินค้าร้านKOI CAFE</span>

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
                                                <h3 style="font-family: kanit;">ข้อมูลยอดขายของสินค้า</h3>
                                            </div>
                                            <br />
                                            <div class="card-body">

                                                <form action="" method="GET">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>เริ่มต้น</label>
                                                                <input type="date" name="from_date" value="<?php if (isset($_GET['from_date'])) {
                                                                                                                echo $_GET['from_date'];
                                                                                                            } ?>"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>สิ้นสุด</label>
                                                                <input type="date" name="to_date" value="<?php if (isset($_GET['to_date'])) {
                                                                                                                echo $_GET['to_date'];
                                                                                                            } ?>"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>กดเพื่อค้นหา</label> <br>
                                                                <button type="submit"
                                                                    class="btn btn-primary">ค้นหา</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <table class="table table-borderd">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="width: 25%;">รูปของสินค้า
                                                            </th>
                                                            <th class="text-center" style="width: 25%;">รายการสินค้า
                                                            </th>
                                                            <th class="text-center" style="width: 25%;">
                                                                จำนวนสินค้าที่ขายได้</th>
                                                            <th class="text-center" style="width: 25%;">จำนวนเงิน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php


                                                        if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                                            $from_date = $_GET['from_date'];
                                                            $to_date = $_GET['to_date'];

                                                            $query = "SELECT p.product_id, SUM(d_subtotal) AS d_subtotal, SUM(d_qty) AS d_qty  , p.d_dttm , b.product_name , b.p_img
                                    FROM order_detail as p  
                                    INNER JOIN koi_product as b  ON b.product_id = p.product_id WHERE p.d_dttm BETWEEN '$from_date' AND '$to_date'
                                    GROUP BY p.product_id
                                    ORDER BY d_qty  DESC";
                                                            $query_run = mysqli_query($con, $query) or die("Error in query: $query_run " . mysqli_error($con));

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                                foreach ($query_run as $row) {
                                                        ?>
                                                        <tr>
                                                            <?php echo "<td class='hidden-xs' align='center'>" . "<img src='../p_img/" . $row['p_img'] . "' width='100px' height='100px'>" . "</td>"; ?>
                                                            <td align="center">
                                                                <FONT SIZE='3'><?= $row['product_name']; ?></FONT>
                                                            </td>
                                                            <td align="center">
                                                                <FONT SIZE='3'><?= $row['d_qty']; ?> </FONT>
                                                            </td>
                                                            <td align="right" style="padding-right: 110px;">
                                                                <FONT SIZE='3'>
                                                                    <?php echo number_format($row['d_subtotal']); ?>
                                                                    บาท</FONT>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                                }
                                                            } else {
                                                                echo "No Record Found";
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                            <script
                                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
                            </script>
                        </div>
                    </div>
                </div>
            </section>
</body>

</html>
<?php include('footerjs.php'); ?>
<?php include('footer.php'); ?>