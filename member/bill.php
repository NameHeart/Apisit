
<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOI_CAFE</title>

<style type="text/css">
    @media print{
        #hid{
            display:none;
        }
    }
    </style>
</head>
<?php include('hbill.php');?>

<body >

  
    <!-- Main Header -->
    <div >
      <section class="content-header">
        <h1 align="center">
        <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs">ใบเสร็จร้านKOI CAFE</span></h1>
        <button class="btn btn-info" id="hid" onclick="window.print()">พิมพ์ใบเสร็จ</button>
        <input type="button" id="hid" name="back" value="กลับไปหน้าสินค้า" onclick="window.location='saleproduct.php';" class="btn btn-success"/>
        
        <?php

            $query ="SELECT o_id, (d_subtotal) AS d_subtotal , (d_dttm) AS dttm, product_name , m_name , d_qty FROM order_detail as b
            INNER JOIN koi_product as p ON b.product_id = p.product_id
            INNER JOIN koi_user as m  ON b.user_id = m.user_id
            WHERE o_id =  (SELECT MAX(o_id) FROM order_detail WHERE o_id = o_id)
            ORDER BY o_id  DESC
            
            ";
            $result = mysqli_query($con, $query);
            $resultchart = mysqli_query($con, $query);
            ?>
            
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
            
                        
                    </div>
                    <br />
                    <?php if($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                    <h4 align="center" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">KOI CAFE <br /> <br /></td> </h3>
                    <h5 align="center" style="font-family: kanit; font-size: 18px">หมายเลขบิล : <td align="center"><?php echo $row['o_id'];?> <br /></td> </h3>
                    <h5 align="center" style="font-family: kanit; font-size: 18px">วันที่ : <td align="center"><?php echo $row['dttm'];?> <br /></td> </h3>
                    <h5 align="center" style="font-family: kanit; font-size: 18px">พนักงานขาย : <td align="center"><?php echo $row['m_name'];?> <br /></td> </h3>
                    
                    
                   
                    <?php ;
                    
                    }
                    ?>
            <div >
        
            </div>
           
                   
                        <table  class="table table-borderd" style="width: 500px;" align="center" >
                            <thead>
                                <tr>
                                    <th class="text-center" >สินค้า</th>
                                    <th class="text-center" >จำนวน</th>
                                    <th class="text-center" >ราคา</th>
                                </tr>
                            </thead>
                            <tbody>

            <?php foreach($result as $row) { ?>
                    
                <tr>
                                                <td align="center"><?= $row['product_name']; ?> <br /></td>
                                                <td align="center"><?= $row['d_qty']; ?> <br /></td>
                                                <td align="center"><?= $row['d_subtotal']; ?> บาท<br /></td>
                                                

                                            </tr>
                    
                    <?php ;
                    @$amount_total += $row['d_subtotal'];
                    @$amount_qty += $row['d_qty'];
                    }
                    ?>
                    </tr>

                    <tr class="table-danger">
                        <td class="text-center"><b>รวม</b></td>
                        <td class="text-center" ><b> <?php echo number_format($amount_qty);?></b></td>
                        <td class="text-center"><b>
                        <?php echo number_format($amount_total);?> บาท</b></td></td>
                    </tr>
                    <?php

            $query ="SELECT * FROM order_head";
            $result = mysqli_query($con, $query);
            $resultchart = mysqli_query($con, $query);
            ?>
             <?php foreach($result as $row)  ?>
                    
                    <tr>
                    <td align="center"> </td>
                    <td align="center"><h5 align="center" style="font-family: kanit;" >หมายเหตุ :<?= $row['o_detail']; ?> <br /></td>
                    <td align="center"> </td>                
    
                 </tr>
            <?php mysqli_close($con);?>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

  </html>
