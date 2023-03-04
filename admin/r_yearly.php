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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header">
                                            <h3 style="font-family: kanit;">ข้อมูลรายได้ต่อปี</h3>
                                        </div>
                                        <br />
                                        <?php
                                        $query = "SELECT SUM(o_total) AS totol, DATE_FORMAT(o_dttm, '%Y') AS o_dttm
            FROM order_head
            GROUP BY DATE_FORMAT(o_dttm, '%Y%')
            ORDER BY DATE_FORMAT(o_dttm, '%Y') DESC
            ";
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

                                        ?>


                                        <script type="text/javascript"
                                            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js">
                                        </script>
                                        <hr>
                                        <p align="center">
                                            <!--devbanban.com-->
                                            <canvas id="myChart" width="800px" height="300px"></canvas>
                                            <script>
                                            var ctx = document.getElementById("myChart").getContext('2d');
                                            var myChart = new Chart(ctx, {
                                                type: 'bar',
                                                data: {
                                                    labels: [<?php echo $o_dttm; ?>

                                                    ],
                                                    datasets: [{
                                                        label: 'รายงานรายได้ต่อปี (บาท)',
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
                                        <div>

                                            <table class="table table-borderd">
                                                <thead>
                                                    <tr class="table-danger">
                                                        <th class="text-center" style="width: 50%;">ปี</th>
                                                        <th class="text-center" style="width: 50%;">รายได้</th>
                                                    </tr>
                                                </thead>

                                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                <tr>
                                                    <td align="center"><?php echo $row['o_dttm']; ?> <br /></td>
                                                    <td align="right" style="padding-right: 240px;">
                                                        <?php echo number_format($row['totol'], 2); ?> บาท<br /></td>
                                                </tr>
                                                <?php
                                                    @$amount_total += $row['totol'];
                                                }
                                                ?>
                                                <tr class="table-danger">
                                                    <td class="text-center" style="width: 50%;"><b>รวม</b></td>
                                                    <td class="text-center" style="width: 50%;"><b>
                                                            <?php echo number_format($amount_total, 2); ?> บาท</b></td>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php mysqli_close($con); ?>
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