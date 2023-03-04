<?php

$query_product = "SELECT * FROM koi_product as p
INNER JOIN koi_type as t
ON p.type_id = t.type_id
ORDER BY p.product_id ASC";
$result_product =mysqli_query($con, $query_product) or die ("Error in query: $query_product " . mysqli_error($con));


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

  
?>



<div class="row">
<div id="message"></div>

<?php foreach ($result_product as $row_product ) { ?>
  <a href="saleproduct.php?product_id=<?php echo $row_product['product_id']?>&act=add" >
    <div class="card" style="width: 22rem; margin-top: 5px; margin-left: 10px; position: relative; left:5%;" >
    <img style="height: 200px;" src="../p_img/<?php echo $row_product['p_img'] ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <p class="card-title" style="color: black;" ><FONT SIZE='3' ><b><?php echo $row_product['product_name'] ?></b></FONT></p>
      <p class="card-text" style="color: black;">
        ประเภท: <?php echo $row_product['type_name'] ?>
      </p>
      <p class="card-text" style="color: black;">
        ราคา:<b> <?php echo $row_product['price']  ?> บาท</b>
      </p>
</a>
      <p>
      
      </p>
      </div>
  </div>
<?php } ?>




</div>




