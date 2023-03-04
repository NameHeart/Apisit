<?php 

include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

$pass = mysqli_real_escape_string($con,$_POST['m_pass']);
$subpass = mysqli_real_escape_string($con,$_POST['m_subpass']);
$user_id = $_POST['user_id'];

	if($pass == $subpass){

		$sql_resetpass = " UPDATE koi_user SET
	        m_pass = '$pass'
	        WHERE user_id = '".$user_id."' ";	
	        $resault_resetpass = mysqli_query($con, $sql_resetpass) or die
			("Error : ".mysqli_error($$con_resetpass));

		if($resault_resetpass){
			//แก้ไขสำเร็จ
			echo '<script>';
			echo "window.location='member.php?do=finish';";
			echo '</script>';
		}else{
			//แก้ไขไม่สำเร็จ
			echo '<script>';
			echo "window.location='member.php?do=wrongpass';";
			echo '</script>';
		}
 	}else{
	 		echo '<script>';
			echo "window.location='member.php?do=wrong';";
			echo '</script>';
 	}
