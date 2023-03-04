<?php require_once('../condb.php');

	$query_type = "SELECT * FROM koi_type ORDER BY type_id ASC";
	$result_type =mysqli_query($con, $query_type) or die ("Error in query: $query_type " . mysqli_error($con));
		// echo($query_type);
		// exit()

?>

<nav class="navbar navbar-expand-lg navbar-light " style="height: 100px;background-color:bisque;">
  <a class="navbar-brand" href="#">Koi Cafe</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"><i class="fas fa-home"></i>
        <span id="cart-item" class="badge badge-danger"></span>HOME</a></a>
      </li>
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp


      <li class="nav-item active">
        <a class="nav-link" href="order.php"><i class="fas fa-shopping-bag"></i>
        <span id="cart-item" class="badge badge-danger"></span>ORDER</a>
      </li>
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

      <li class="nav-item active">
        <a class="nav-link" a href="../logout.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?');"><i class="fas fa-sign-out-alt"></i>
        <span id="cart-item" class="badge badge-danger"></span>Sign out</a></a>
      </li>
    </ul>
  </div>
  <a class="list-group-item list-group-item-warning" href="saleproduct.php">
        หน้าหลัก</a> 
	<?php
	
		foreach ($result_type as $row )  { ?>

		 <a href="saleproduct.php?act=showbytype&type_id=<?php echo $row['type_id'];?>" class="list-group-item list-group-item-warning" > 
		 	<?php echo $row["type_name"]; ?></a>

	<?php } ?>  
  
</nav>