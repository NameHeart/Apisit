<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if($_SESSION['m_level']!='admin'){
	Header("Location: index.php");
}
	$product_id = mysqli_real_escape_string($con,$_POST["product_id"]);
	$product_name = mysqli_real_escape_string($con,$_POST["product_name"]);
	$type_id = mysqli_real_escape_string($con,$_POST["type_id"]);
	$price = mysqli_real_escape_string($con,$_POST["price"]);
	$date1 = date("Ymd_His");
	$numrand = (mt_rand());

	
	$p_img = (isset($_POST['p_img']) ? $_POST['p_img'] : '');
	$upload=$_FILES['p_img']['name'];
	if($upload !='') { 

		$path="../p_img/";
		$type = strrchr($_FILES['p_img']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../p_img/".$newname;
		move_uploaded_file($_FILES['p_img']['tmp_name'],$path_copy);  
	}else{
		$newname=$p_img2;
	}

	$sql = "UPDATE koi_product SET 
	product_name='$product_name',
	type_id='$type_id',
	price='$price',
	p_img='$newname'
	WHERE product_id=$product_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='product.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='product.php?act=add&do=f';";
    echo '</script>';
}
?>