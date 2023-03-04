<?php
	session_start();
	
	include '../condb.php';
	
	$product_id = mysqli_real_escape_string($con,$_GET['product_id']);
	$act = mysqli_real_escape_string($con,$_GET['act']);
    $o_id = mysqli_real_escape_string($con,$_POST['o_id']);
	 
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
        <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs" style="font-family: kanit;">รายการออเดอร์สินค้า</span>
        
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
                    <form action="" method="POST" >
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group" align="center">
                                        <label>Order ID</label>
                                        <input type="text" name="o_id" placeholder="กรอกหมายเลขออเดอร์" class="form-control" style="width: 270px;"><br/>
                                <button type="submit" class="btn btn-primary">ค้นหา</button>
                                <input type="button" name="back" value="กลับไปหน้าสินค้า" onclick="window.location='saleproduct.php';" class="btn btn-info"/>
                                    </div>
                                    
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label></label> <br>                                    
                                    </div>                                   
                                </div>
                                 
                            </div>
                        </form>

                                    
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label></label> <br>                                    
                                    </div>                                   
                                </div>
                               
                        <?php 
                                

                                if(isset($_POST['o_id']))
                                {
                                    $o_id = $_POST['o_id'];
                                    

                                    $query ="SELECT b.o_id, (d_subtotal) AS d_subtotal , product_name , DATE_FORMAT(d_dttm, '%d %M %Y &nbsp %T') AS dttm ,d_qty,p_img, o_status, o_detail, d_qty  FROM order_detail as b
                                    INNER JOIN koi_product as p ON b.product_id = p.product_id
                                    INNER JOIN order_head as h ON b.o_id = h.o_id
                                    WHERE b.o_id LIKE '$o_id'
                                    ORDER BY b.o_id  ASC
                                    
                                    ";
                                    $query_run = mysqli_query($con, $query) or die ("Error in query: $query_run " . mysqli_error($con));
                                    $result = mysqli_query($con, $query);
                                    $resultchart = mysqli_query($con, $query);
                                     ?>  
                                     <?php if($row = mysqli_fetch_array($result)) { ?>
                                        <form action="updatestatus.php" method="POST" >
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group" align="center">
                                        <label>ปรับสถานะออเดอร์</label>
                                        
                                        
                                <?php if ($row['o_status']== 1)
                                {   echo "<br/>";
                                    echo " <button type='submit' class='btn btn-success'disabled >เสร็จสิ้น</button> ";
                                }
                                else
                                {  ?>
                                        <input type="hidden" name="o_status"  value="<?php echo $o_status; ?>">
                                        <input type="hidden" name="o_status" class="form-control" value=1 >
                                </input><br>
                                        <input type="hidden" name="o_id"  value="<?php echo $o_id; ?>" >      
                                <button type="submit" class="btn btn-success"  >เสร็จสิ้น</button> <?php }?>
                                    </div>
                                     
                                </div>
                            </div>
                        </form> <br />
                            </div>
                        </form>
                                        <td align="center">  
                                        <p class="card-title" style="color: black;" ><FONT SIZE='4' ><b>สถานะ: &nbsp;
                            <?php  
                           if ($row['o_status']==0) {  
                                echo "รอดำเนินการ";  
                           }if ($row['o_status']==1) {  
                                echo "เสร็จสิ้น";  
                           }  
                           ?></b></FONT>
                           </p> 
                           
                           <FONT SIZE='3' >หมายเหตุ: <?= $row['o_detail']; ?> </FONT>
                      </td> 
                        </br>
                        <br>

                      <table  class="table table-borderd"  >
                            
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 25%;">หมายเลขออเดอร์</th>
                                    <th class="text-center" style="width: 25%;">รูปภาพของสินค้า</th>
                                    <th class="text-center" style="width: 25%;">รายการสินค้า</th>
                                    <th class="text-center" style="width: 25%;">จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>
                    
                    
                   
                    <?php ;
                    
                    }
                    ?>
                                    

                                  <?php  if(mysqli_num_rows($query_run) > 0)
                                    {
                                        
                                        foreach($query_run as $row)
                                        {
                                            ?>
                                            
                                            <tr>
                                                
                                                <td align="center"><FONT SIZE='4' ><?= $row['o_id']; ?> </FONT><br /></td>
                                                <?php  echo "<td align='center' class='hidden-xs' >"."<img src='../p_img/".$row['p_img']."' width='100px' height= '70px'>"."</td>"; ?>
                                                <td align="center"><FONT SIZE='4' ><?= $row['product_name']; ?> </FONT><br /></td>
                                                <td align="center"><FONT SIZE='4' ><?= $row['d_qty']; ?> </FONT><br /></td>
                                            </tr>
                                            <?php
                                        
                                        }
                                        
                                    }
                                    
                                    else
                                    {
                                        echo "No Record Found";
                                    }
                                    
                                    
                                }
                            ?>
                            
                            
            
            
                           
                            </tbody>
                        
                        </table>
                        
                    </div>
                </div>
</body>
</html>
<?php include('footer.php');?>