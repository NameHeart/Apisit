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
                    <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs" style="font-family: kanit;">ข้อมูลรายได้ร้านKOI
                        CAFE</span>

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
                                                <h3 style="font-family: kanit;">ข้อมูลรายได้ต่อเดือน</h3>
                                            </div>
                                            <br />
                                            <div class="card-body">

                                                <form action="" method="GET">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>เริ่มต้น</label>
                                                                <input type="date" name="from_month" value="<?php if (isset($_GET['from_month'])) {
                                                                                                                echo $_GET['from_month'];
                                                                                                            } ?>"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>สิ้นสุด</label>
                                                                <input type="date" name="to_month" value="<?php if (isset($_GET['to_month'])) {
                                                                                                                echo $_GET['to_month'];
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

                                                            <th class="text-center" style="width: 50%;">เดือน/ปี</th>
                                                            <th class="text-center" style="width: 50%;">จำนวนเงิน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php


                                                        if (isset($_GET['from_month']) && isset($_GET['to_month'])) {
                                                            $from_month = $_GET['from_month'];
                                                            $to_month = $_GET['to_month'];

                                                            $query = "SELECT o_total, SUM(o_total) AS totol, DATE_FORMAT(o_dttm, '%M %Y') AS o_dttm
                                    FROM order_head WHERE o_dttm BETWEEN '$from_month' AND '$to_month'
                                    GROUP BY DATE_FORMAT(o_dttm, '%M%')
                                    ORDER BY DATE_FORMAT(o_dttm, '%M-%Y') DESC
                                        ";
                                                            $query_run = mysqli_query($con, $query) or die("Error in query: $query_run " . mysqli_error($con));
                                                            $result = mysqli_query($con, $query);
                                                            $resultchart = mysqli_query($con, $query);
                                                            //for chart
                                                            $o_dttm = array();
                                                            $totol = array();
                                                            while ($rs = mysqli_fetch_array($resultchart)) {
                                                                $o_dttm[] = "\"" . $rs['o_dttm'] . "\"";
                                                                $totol[] = "\"" . $rs['totol'] . "\"";
                                                            }
                                                            $o_dttm = implode(",", $o_dttm);
                                                            $totol = implode(",", $totol);



                                                            if (mysqli_num_rows($query_run) > 0) {
                                                                foreach ($query_run as $row) {
                                                        ?>
                                                        <tr>
                                                            <td align="center"><?= $row['o_dttm']; ?> <br /></td>
                                                            <td <td align="right" style="padding-right: 245px;">
                                                                <?php echo number_format($row['totol'], 2); ?> บาท<br />
                                                            </td>

                                                        </tr>
                                                        <?php
                                                                    @$amount_total += $row['totol'];
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
                                                                    labels: [<?php echo $o_dttm; ?>

                                                                    ],
                                                                    datasets: [{
                                                                        label: 'รายงานรายได้ต่อเดือน (บาท)',
                                                                        data: [<?php echo $totol; ?>],
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

                                                        <tr class="table-danger">
                                                            <td class="text-center" style="width: 50%;"><b>รวม</b></td>
                                                            <td class="text-center" style="width: 50%;"><b>
                                                                    <?php echo number_format($amount_total, 2); ?>
                                                                    บาท</b></td>
                                                            </td>
                                                        </tr>
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