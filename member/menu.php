<?php require_once('../condb.php');

	$query_type = "SELECT * FROM koi_type ORDER BY type_id ASC";
	$result_type =mysqli_query($con, $query_type) or die ("Error in query: $query_type " . mysqli_error($con));
		// echo($query_type);
		// exit()

?>

<nav>


      
	  <?php
	
	foreach ($result_type as $row )  { ?>

	 <a href="saleproduct.php?act=showbytype&type_id=<?php echo $row['type_id'];?>" class="list-group-item list-group-item-warning" style="position: relative; left:15%; width:160px"> 
		 <?php echo $row["type_name"]; ?></a>

<?php } ?>  
      





    
</nav>