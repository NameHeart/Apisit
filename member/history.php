<?php
	session_start();
	
	include '../condb.php';
	
	$product_id = mysqli_real_escape_string($con,$_GET['product_id']);
	$act = mysqli_real_escape_string($con,$_GET['act']);

// add to cart
	if($act=='add' && !empty($product_id))
	{
		if(isset($_SESSION['cart'][$product_id]))
		{
			$_SESSION['cart'][$product_id]++;
		}
		else
		{
			$_SESSION['cart'][$product_id]=1;
		}
	}

	//remove
	if($act=='remove' && !empty($product_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['cart'][$product_id]);
	}

	//update
	if($act=='update')
	{
		$amount_array = $_POST['amount'];
		foreach($amount_array as $product_id=>$amount)
		{
			$_SESSION['cart'][$product_id]=$amount;
		}
	}

	//cancle
	if($act=='cancel')  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['cart']);
		
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
    background-image:url('https://png.pngtree.com/background/20210714/original/pngtree-copper-penny-color-background-design-watercolor-background-design-picture-image_1223700.jpg');
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>
<?php include('hcart.php');?>
<body>
<?php include('menutop.php');?>

    <!-- Main Header -->
		<div >
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs" style="font-family: kanit;">ประวัติการขาย</span>
        
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
                    
                    <div class="card-body" >
                        <br>
                    </div>
                </div>
                <div class="card mt-4" align="center">
                    <div class="card-body">
                    <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>เริ่มต้น</label>
                                        <input type="date" name="from_date"  value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>สิ้นสุด</label>
                                        <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label></label> <br>
                                      <button type="submit" class="btn btn-primary">ค้นหา</button>
                                      <input type="button" name="back" value="กลับไปหน้าสินค้า" onclick="window.location='saleproduct.php';" class="btn btn-info"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card md-4">
                    <div class="card-body">
                        <table  class="table table-borderd" align="center"  >
                            <thead>
                                <tr>
                                <th class="text-center" style="width: 20%;">หมายเลขออเดอร์</th>
                                    <th class="text-center" style="width: 20%;">วัน/เดือน/ปี</th>
                                    <th class="text-center" style="width: 30%;">จำนวนเงิน</th>
                                    <th class="text-center" style="width: 30%;">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php 
                                

                                if(isset($_GET['from_date']) && isset($_GET['to_date']))
                                {
                                    $from_date = $_GET['from_date'];
                                    $to_date = $_GET['to_date'];
                                    $user_id = $_SESSION['user_id'];

                                    $query = "SELECT o_total, (o_total) AS totol, DATE_FORMAT(o_dttm, '%d %M %Y &nbsp %T') AS o_dttm , m_name, o_id,o_status
                                    FROM order_head  as p
                                    INNER JOIN koi_user as b  ON b.user_id = p.user_id
                                    WHERE o_dttm BETWEEN '$from_date' AND '$to_date'AND p.user_id = $user_id
                                    ORDER BY o_id DESC
                                        ";
                                    $query_run = mysqli_query($con, $query) or die ("Error in query: $query_run " . mysqli_error($con));
                                    $result = mysqli_query($con, $query);
                                    $resultchart = mysqli_query($con, $query);
                                     //for chart
                                    $o_dttm = array();
                                    $totol = array();
                                    while($rs = mysqli_fetch_array($resultchart)){
                                    $o_dttm[] = "\"".$rs['o_dttm']."\"";
                                    $totol[] = "\"".$rs['totol']."\"";
                                    }
                                    $o_dttm = implode(",", $o_dttm);
                                    $totol = implode(",", $totol);

                                    

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            ?>
                                            <tr>
                                            <td align="center"><?= $row['o_id']; ?> <br /></td>
                                                <td align="center"><?= $row['o_dttm']; ?> <br /></td>
                                                <td align="center"><?php echo number_format($row['totol'],2);?> บาท<br /></td>
                                                <td align="center"><?php  
                           if ($row['o_status']==0) {  
                                echo "รอการจัดทำ";  
                           }if ($row['o_status']==1) {  
                                echo "เสร็จสิ้น";  
                           }  
                           ?> <br /></td>
                                         

                                            </tr>
                                            <?php
                                            @$amount_total += $row['totol'];
                                        }
                                        
                                    }
                                    
                                    else
                                    {
                                        echo "No Record Found";
                                    }
                                    
                                }
                            ?>
                            
            
            
                            <tr class="table-danger">
                        <td class="text-center" style="width: 20%;"><b>รวม</b></td>
                        <td class="text-center" style="width: 20%;"><b></b></td>
                        <td class="text-center" style="width: 30%;" ><b>
                        <?php echo number_format($amount_total,2);?> บาท</b></td></td>
                        
                        
                    </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
</html>
<?php include('footer.php');?>