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
                                                <h3 style="font-family: kanit;">ข้อมูลยอดขายสินค้าแยกตามประเภท</h3>
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
                                                            <th class="text-center" style="width: 30%;">ประเภทสินค้า
                                                            </th>
                                                            <th class="text-center" style="width: 20%;">จำนวนที่ขายได้
                                                            </th>
                                                            <th class="text-center" style="width: 20%;">จำนวนเงิน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php


                                                        if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                                            $from_date = $_GET['from_date'];
                                                            $to_date = $_GET['to_date'];

                                                            $query = "SELECT p.product_id, SUM(d_subtotal) AS totol, SUM(d_qty) AS d_qty  , p.d_dttm , b.type_name 
                                    FROM order_detail as p  
                                    INNER JOIN koi_type as b  ON b.type_id = p.type_id WHERE p.d_dttm BETWEEN '$from_date' AND '$to_date'
                                    GROUP BY p.type_id
                                    ORDER BY d_qty  DESC";
                                                            $query_run = mysqli_query($con, $query) or die("Error in query: $query_run " . mysqli_error($con));
                                                            $result = mysqli_query($con, $query);
                                                            $resultchart = mysqli_query($con, $query);
                                                            //for chart
                                                            $type_name = array();
                                                            $d_qty = array();
                                                            while ($rs = mysqli_fetch_array($resultchart)) {
                                                                $type_name[] = "\"" . $rs['type_name'] . "\"";
                                                                $d_qty[] = "\"" . $rs['d_qty'] . "\"";
                                                            }
                                                            $type_name = implode(",", $type_name);
                                                            $d_qty = implode(",", $d_qty);



                                                            if (mysqli_num_rows($query_run) > 0) {
                                                                foreach ($query_run as $row) {
                                                        ?>
                                                        <tr>
                                                            <td align="center"><?= $row['type_name']; ?> <br /></td>
                                                            <td align="center"><?= $row['d_qty']; ?> <br /></td>
                                                            <td align="right" style="padding-right: 130px;">
                                                                <?php echo number_format($row['totol']); ?> บาท<br />
                                                            </td>

                                                        </tr>
                                                        <?php
                                                                }
                                                            } else {
                                                                echo "No Record Found";
                                                            }
                                                        }
                                                        ?>


                                                        <script type="text/javascript"
                                                            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js">
                                                        </script>
                                                        <hr>
                                                        <p align="center">
                                                            <!--devbanban.com-->
                                                            <canvas id="myChart" width="800px" height="300px"></canvas>
                                                            <script>
                                                            var ctx = document.getElementById("myChart").getContext(
                                                                '2d');
                                                            var myChart = new Chart(ctx, {
                                                                type: 'bar',
                                                                data: {
                                                                    labels: [<?php echo $type_name; ?>

                                                                    ],
                                                                    datasets: [{
                                                                        label: 'จำนวนที่ขายได้',
                                                                        data: [<?php echo $d_qty; ?>],
                                                                        backgroundColor: [
                                                                            'rgba(255, 99, 132, 0.2)',
                                                                            'rgba(54, 162, 235, 0.2)',
                                                                            'rgba(255, 206, 86, 0.2)',
                                                                            'rgba(75, 192, 192, 0.2)',
                                                                            'rgba(153, 102, 255, 0.2)',
                                                                            'rgba(255, 159, 64, 0.2)'
                                                                        ],
                                                                        borderColor: [
                                                                            'rgba(255,99,132,1)',
                                                                            'rgba(54, 162, 235, 1)',
                                                                            'rgba(255, 206, 86, 1)',
                                                                            'rgba(75, 192, 192, 1)',
                                                                            'rgba(153, 102, 255, 1)',
                                                                            'rgba(255, 159, 64, 1)'
                                                                        ],
                                                                        borderWidth: 1
                                                                    }]
                                                                },
                                                                options: {
                                                                    scales: {
                                                                        yAxes: [{
                                                                            ticks: {
                                                                                beginAtZero: true
                                                                            }
                                                                        }]
                                                                    }
                                                                }
                                                            });
                                                            </script>
                                                        </p>


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
</body>

</html>
<?php include('footerjs.php'); ?>
<?php include('footer.php'); ?>