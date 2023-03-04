<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOI_CAFE</title>
</head>
<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
        <?php include('menu_l.php');?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs" style="font-family: kanit;">ข้อมูลรายได้ร้านKOI CAFE</span>
        
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
                        <h3 style="font-family: kanit;">ข้อมูลยอดขายของพนักงาน</h3>
                    </div>
                    <br />
                    <div class="card-body">
                    
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>เริ่มต้น</label>
                                        <input type="date" name="from_month"  value="<?php if(isset($_GET['from_month'])){ echo $_GET['from_month']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>สิ้นสุด</label>
                                        <input type="date" name="to_month" value="<?php if(isset($_GET['to_month'])){ echo $_GET['to_month']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>กดเพื่อค้นหา</label> <br>
                                      <button type="submit" class="btn btn-primary">ค้นหา</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <table  class="table table-borderd" >
                            <thead>
                                <tr>  
                                <th class="text-center" style="width: 20%;">ชื่อของพนักงาน</th>
                                    <th class="text-center" style="width: 20%;">จำนวนสินค้าที่ขายได้</th>
                                    <th class="text-center" style="width: 20%;">จำนวนเงิน</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php 
                                

                                if(isset($_GET['from_month']) && isset($_GET['to_month']))
                                {
                                    $from_month = $_GET['from_month'];
                                    $to_month = $_GET['to_month'];

                                    $query = "SELECT SUM(d_subtotal) AS totol, SUM(d_qty) AS d_qty ,DATE_FORMAT(d_dttm, '%M %Y') AS o_dttm ,m_name
                                    FROM order_detail as p
                                    INNER JOIN koi_user as b  ON b.user_id = p.user_id
                                    WHERE d_dttm BETWEEN '$from_month' AND '$to_month'
                                    GROUP BY b.user_id
                                    ORDER BY d_qty DESC
                                        ";
                                    $query_run = mysqli_query($con, $query) or die ("Error in query: $query_run " . mysqli_error($con));
                                    $result = mysqli_query($con, $query);
                                    $resultchart = mysqli_query($con, $query);
                                     //for chart
                                    $m_name = array();
                                    $d_qty = array();
                                    while($rs = mysqli_fetch_array($resultchart)){
                                    $m_name[] = "\"".$rs['m_name']."\"";
                                    $d_qty[] = "\"".$rs['d_qty']."\"";
                                    }
                                    $m_name = implode(",", $m_name);
                                    $d_qty = implode(",", $d_qty);

                                    

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            ?>
                                            <tr>
                                            <td align="center"><?= $row['m_name']; ?> <br /></td>
                                            <td align="center"><?= $row['d_qty']; ?> <br /></td>
                                            <td align="center"><?php echo number_format($row['totol']);?> บาท<br /></td>

                                            </tr>
                                            <?php
                                            @$amount_total += $row['totol'];
                                            @$amount_qty += $row['d_qty'];
                                        }
                                        
                                    }
                                    
                                    else
                                    {
                                        echo "No Record Found";
                                    }
                                    
                                }
                            ?>
                            
            
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
            <hr>
            <p align="center">
                <!--devbanban.com-->
                <canvas id="myChart" width="800px" height="300px"></canvas>
                <script>
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                labels: [<?php echo $m_name;?>
                
                ],
                datasets: [{
                label: 'จำนวนสินค้าที่ขายได้',
                data: [<?php echo $d_qty;?>
                ],
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
                beginAtZero:true
                }
                }]
                }
                }
                });
                </script>
            </p>
            
            <tr class="table-danger">
                        <td class="text-center" style="width: 30%;"><b>รวม</b></td>
                        <td class="text-center" style="width: 20%;"><b><?php echo number_format($amount_qty);?> </b></td>
                        <td class="text-center" style="width: 20%;" ><b>
                        <?php echo number_format($amount_total,2);?> บาท</b></td>
                    </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
  </html>
  <?php include('footerjs.php');?>
  <?php include('footer.php');?>