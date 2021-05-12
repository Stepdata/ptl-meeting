<?php
include '../connect.php';    

//เพิ่มข้อมูล
if ($_GET['action']=='add'){
	
	date_default_timezone_set('Asia/Bangkok');
	
	if (isset($_POST['save'])) {
		echo "<script>alert('มีปัญหาการลบข้อมูล '); history.back(-1);</script>";
	}
	
	
	
	
	
	
	if (strlen($_POST['txtUsername'])<5) {
		echo "<script>alert('ชื่อผู้ใช้ต้องมากกว่า 5 ตัวอักษร'); history.back(-1);</script>";
		exit();
    }			
	if (strlen($_POST['txtPassword'])<6) {
		echo "<script>alert('รหัสผ่านต้องมากกว่า 6 ตัวอักษร'); history.back(-1);</script>";
		exit();
    }
	if($_POST["txtPassword"] != $_POST["txtConPassword"])
	{
		echo "<script>alert('รหัสผ่านไม่ตรงกัน'); window.history.back();</script>";
		exit();
    }
        
	$meSQL = "SELECT * FROM tb_member WHERE username = '".trim($_POST['txtUsername'])."' ";
	$meQuery = $conn->query($meSQL);
	$meResult = mysqli_fetch_array($meQuery,MYSQLI_ASSOC);
	if($meResult)
	{
			echo "<script>alert('ชื่อผู้ใช้นี้ มีในระบบแล้ว');window.history.back();</script>";
	}else{
		$create_date = date('Y-m-d H:i:s');
		$meSQL = "INSERT INTO tb_member (username,password,ntitle,firstname,surname,position,phone,email,status,active,create_date,login_date) VALUES ('".$_POST["txtUsername"]."','".$_POST["txtPassword"]."','".$_POST["title"]."','".$_POST["txtfirstname"]."','".$_POST["txtsurname"]."','".$_POST["position"]."','".$_POST["phone"]."','".$_POST["txtemail"]."','"."user"."','"."0"."','".$create_date."','".$create_date."')";
		$meQuery = $conn->query($meSQL);	
		
            ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			date_default_timezone_set("Asia/Bangkok");
			$sToken = "6gkrUWiKEsSCoRdLazJLxvS9Ofv7eflYn4lDt6ju137";
			$sMessage = " มีการสมัครสมาชิกเข้ามาใหม่ ชื่อ ".$_POST["title"]."".$_POST["txtfirstname"]." ".$_POST["txtsurname"]."  ตำแหน่ง ".$_POST["position"] ."  เบอร์โทร " .$_POST["phone"];
			$chOne = curl_init(); 
			curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt( $chOne, CURLOPT_POST, 1); 
			curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
			$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
			curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
			curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
			$result = curl_exec( $chOne ); 
			//Result error 
			if(curl_error($chOne)) 
			{ 
				echo 'error:' . curl_error($chOne); 
			} 
			else { 
				$result_ = json_decode($result, true); 
				//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
			} 
			curl_close( $chOne ); 
		
		if ($meQuery == TRUE) {
			echo "<script>alert('สมัครเสร็จเรียบร้อยแล้ว'); window.location ='../index.php';</script>";
        } else {
			echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
			exit();
        }
	}		
}
else
{
	echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
}


$conn->close();
?>

