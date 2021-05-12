<?php
	session_start();
	error_reporting (E_ALL ^ E_NOTICE);
	if ($_SESSION['status']!='admin') {
		echo "<script>alert('session ผิดผลาด'); window.location ='../index.php';</script>";
		exit();
		} else {
		include '../connect.php'; 
		
		$sql = "SELECT * FROM tb_member WHERE id_member = '{$_SESSION['id']}' ";
		$rs = $conn->query( $sql )->fetch_assoc() ;
	}
	
	
	//แก้ไขข้อมูล
	if ($_GET['action']=='edit'){
		$sql = "SELECT * FROM tb_rooms WHERE id_rooms = '{$_POST['idrooms']}' ";
		$meResult = $conn->query( $sql )->fetch_assoc() ;   
		$strYear = date('Y',strtotime($_POST['startdate']))-543;
		$strMonth= date('m',strtotime($_POST['startdate']));
		$strDay= date('d',strtotime($_POST['startdate']));
		$startdate = $strYear.'-'.$strMonth.'-'.$strDay.'T'.$_POST['starttime'].':00';
		
		$endstrYear = date('Y',strtotime($_POST['enddate']))-543;
		$endstrMonth= date('m',strtotime($_POST['enddate']));
		$endstrDay= date('d',strtotime($_POST['enddate']));
		$enddate = $endstrYear.'-'.$endstrMonth.'-'.$endstrDay.'T'.$_POST['endtime'].':00';
		
		$equip = implode(',', $_POST['equip']);
		
		$meSQL = "UPDATE tb_event ";
		$meSQL .="SET rooms='{$_POST['idrooms']}',"
		. "title='{$_POST['title']}',"
		. "start='{$startdate}',"
		. "end='{$enddate}',"
		. "color='{$meResult['color_rooms']}',"
		. "division='{$_POST['division']}',"
		. "people='{$_POST['people']}',"
		. "style='{$_POST['style']}',"
		. "equipment='{$equip}',"
		. "etc='{$_POST['etc']}',"
		. "status='{$_POST['status']}' ";
		$meSQL .= "WHERE id ='{$_POST['id']}' ";
		$meQuery = $conn->query($meSQL);			
		if ($meQuery == TRUE) {
			if ($_GET['report'] != '') {
				echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=report&report=".$_GET['report']."';</script>";
			} else { echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=report';</script>"; }
			} else {
			echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
			exit();
		}
	}	
	
	//ลบข้อมูล
	if ($_GET['action']=='delete'){
		$meSQL = "DELETE FROM tb_event ";
		$meSQL .= "WHERE id='{$_GET['id']}' ";
		$meQuery = $conn->query($meSQL);
		if ($meQuery == TRUE) {
			if ($_GET['report'] != '') {
				echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=report&report=".$_GET['report']."';</script>";
			} else { echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=report';</script>"; }
			} else {
			echo "<script>alert('มีปัญหาการลบข้อมูล '); history.back(-1);</script>";
			exit();
		}
	}	
	//เปลี่ยนสถานะ
	if ($_GET['action']=='change'){
		if ($_GET['status']=='1'){
			$meSQL = "UPDATE tb_event SET status='1'";
			$status_his = "อนุมัติ";
			$line_statis = "อนุมัติ";
			} else if($_GET['status']=='2'){
			$meSQL = "UPDATE tb_event SET status='2'";
			$status_his = "ไม่อนุมัติ";
			$line_statis = "ไม่อนุมัติ";
			} else if($_GET['status']=='3'){
			$meSQL = "UPDATE tb_event SET status='3'";
			$status_his = "ยกเลิก";
			$line_statis = "ยกเลิก";
		}
		$meSQL .= "WHERE id ='{$_GET['id']}' ";
		$meQuery = $conn->query($meSQL);		
		
		$his_user= $rs['title'].$rs['firstname'].'  '.$rs['surname'];
		$status_date=date("d/m/Y H:i:s");
		$meSQL = "INSERT INTO tb_his (his_action_status , his_status_date , his_user , his_room , his_topic , his_client) VALUES ('".$status_his."','".$status_date."','".$his_user."','".$_GET['his_room']."','".$_GET['his_topic']."','".$_GET['his_client']."')"; 
		
		$meQuery = $conn->query($meSQL);
		
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		date_default_timezone_set("Asia/Bangkok");
		$sToken = "6gkrUWiKEsSCoRdLazJLxvS9Ofv7eflYn4lDt6ju137";
		$sMessage = $line_statis ."การจองห้องประชุม เรื่อง ".$_GET['his_topic']." โดย คุณ ".$his_user;
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
	echo "<script>alert('เพิ่มข้อมูลเสร็จเรียบร้อยแล้ว'); window.location ='../index.php?page=report';</script>";
	} else {
	echo "<script>alert('มีปัญหาการบันทึกข้อมูล  กรุณากลับไปบันทึกใหม่');</script>";
	exit();
	}	
	
	}	
	
	
	
	//ปิด
	$conn->close();
	?>
	
		