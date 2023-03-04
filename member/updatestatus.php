<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');




	$o_id = mysqli_real_escape_string($con,$_POST['o_id']);
	$o_status = mysqli_real_escape_string($con,$_POST['o_status']);
	$act = mysqli_real_escape_string($con,$_GET['act']);

	

	$sql = "UPDATE  order_head SET 
	o_status=$o_status
	WHERE o_id=$o_id
	";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='order.php';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='order.php';";
    echo '</script>';
}
?>