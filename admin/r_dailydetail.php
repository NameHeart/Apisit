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
                                                <h3 style="font-family: kanit;">ข้อมูลรายละเอียดรายได้</h3>
                                            </div>
                                            <br />
                                            <div class="card-body">

                                                <form action="" method="GET">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>เริ่มต้น</label>
                                                                <input type="datetime-local" name="from_date"
                                                                    value="<?php if (isset($_GET['from_date'])) {
                                                                                                                            echo $_GET['from_date'];
                                                                                                                        } ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>สิ้นสุด</label>
                                                                <input type="datetime-local" name="to_date"
                                                                    value="<?php if (isset($_GET['to_date'])) {
                                                                                                                        echo $_GET['to_date'];
                                                                                                                    } ?>" class="form-control">
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
                                                            <th class="text-center" style="width: 20%;">วัน/เดือน/ปี
                                                            </th>
                                                            <th class="text-center" style="width: 20%;">หมายเลขออเดอร์
                                                            </th>
                                                            <th class="text-center" style="width: 30%;">จำนวนเงิน</th>
                                                            <th class="text-center" style="width: 30%;">พนักงานขาย</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php


                                                        if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                                            $from_date = $_GET['from_date'];
                                                            $to_date = $_GET['to_date'];

                                                            $query = "SELECT o_total, (o_total) AS totol, DATE_FORMAT(o_dttm, '%d %M %Y &nbsp %T') AS o_dttm , m_name, o_id
                                    FROM order_head  as p
                                    INNER JOIN koi_user as b  ON b.user_id = p.user_id
                                    WHERE o_dttm BETWEEN '$from_date' AND '$to_date'
                                    ORDER BY o_id DESC
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
                                                            <td align="center"><?= $row['o_id']; ?> <br /></td>
                                                            <td align="right" style="padding-right: 130px;">
                                                                <?php echo number_format($row['totol'], 2); ?> บาท<br />
                                                            </td>
                                                            <td align="center"><?= $row['m_name']; ?> <br /></td>

                                                        </tr>
                                                        <?php
                                                                    @$amount_total += $row['totol'];
                                                                }
                                                            } else {
                                                                echo "No Record Found";
                                                            }
                                                        }
                                                        ?>



                                                        <tr class="table-danger">
                                                            <td class="text-center" style="width: 20%;"><b>รวม</b></td>
                                                            <td class="text-center" style="width: 20%;"><b></b></td>
                                                            <td class="text-center" style="width: 30%;"><b>
                                                                    <?php echo number_format($amount_total, 2); ?>
                                                                    บาท</b></td>
                                                            </td>
                                                            <td class="text-center" style="width: 30%;"><b></b></td>

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