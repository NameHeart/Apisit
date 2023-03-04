<?php 
include('../condb.php');
 if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=product.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=product.php" />';
  }

$query = "SELECT * FROM koi_product as p
INNER JOIN koi_type as t ON p.type_id = t.type_id
ORDER BY p.product_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
    echo "<tr class=''>
      <th width='3%'  class='hidden-xs'>ID</th>
      <th width='8%' class='hidden-xs'>รูป</th>
       <th width='20%'>ชื่อสินค้า</th>
       <th width='30%' class='hidden-xs'>ประเภท</th>
      <th>ราคาสินค้า</th>
       <th></th>
      <th width='7%'>-</th>
    </tr>";
  echo "</thead>";
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td  class='hidden-xs'>" .$row["product_id"] .  "</td> ";
    echo "<td class='hidden-xs'>"."<img src='../p_img/".$row['p_img']."' width='100%'>"."</td>";
    echo "<td> ชื่อ: " .$row["product_name"] .
    "<br>ประเภท: <font color='blue'>".$row["type_name"] ."</font>".
      "</td class='hidden-xs'> ";
    echo "<td class='hidden-xs'>" .$row["type_name"] ."</td> ";
       echo "<td> ราคา " .$row["price"] ." บาท".    
      "</td> ";
      "</td> ";
 
        echo "<td><a href='product.php?act=edit&ID=$row[product_id]' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-edit'></span></a> 
        <a href='product_del_db.php?ID=$row[product_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-trash'></span></a>        
    </td> ";
    
  }
echo "</table>";
mysqli_close($con);
?>