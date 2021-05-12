<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	if ($_SESSION['status']!='admin' and $_SESSION['status']!='user') {
		echo "<script>alert('session ผิดผลาด'); window.location ='../index.php';</script>";
		exit();
		} else {
		include '../connect.php'; 
		include '../function.php';
	}
	
	//เพิ่มข้อมูล
	if ($_GET['action']=='add'){
		
		$sql = "SELECT * FROM tb_rooms WHERE id_rooms = '{$_POST['idrooms']}' ";
		$meResult = $conn->query( $sql )->fetch_assoc() ;   
		$strYear = date('Y',strtotime($_POST['startdate']))-543;
		$strMonth= date('m',strtotime($_POST['startdate']));
		$strDay= date('d',strtotime($_POST['startdate']));
		$startdate = $strYear.'-'.$strMonth.'-'.$strDay.'T'.$_POST['starttime'].':00';
		$tmpstartdate = $strYear.'-'.$strMonth.'-'.$strDay;
		
		$endstrYear = date('Y',strtotime($_POST['enddate']))-543;
		$endstrMonth= date('m',strtotime($_POST['enddate']));
		$endstrDay= date('d',strtotime($_POST['enddate']));
		$enddate = $endstrYear.'-'.$endstrMonth.'-'.$endstrDay.'T'.$_POST['endtime'].':00';
		
		$status_date=thai_date(strtotime(date("Y/m/d")));
		
		
		if (is_array($_POST['equip']))
        {
			$equip = implode(',', $_POST['equip']);	
		}
		
		// เช็คคนจองซ้ำ
		$meSQL = "
		
		SELECT COUNT(n.id) AS count1 FROM tb_event n
		WHERE n.rooms = '".$_POST['idrooms']."'
		AND (	
				STR_TO_DATE(n.`start`,'%Y-%m-%d') BETWEEN  STR_TO_DATE('".$startdate."','%Y-%m-%d') AND STR_TO_DATE('".$enddate."','%Y-%m-%d')
			OR 
				STR_TO_DATE(n.`end`,'%Y-%m-%d') BETWEEN  STR_TO_DATE('".$startdate."','%Y-%m-%d') AND STR_TO_DATE('".$enddate."','%Y-%m-%d')
			)
		AND ( 	
				STR_TO_DATE(SUBSTRING(n.`start`, 12) ,'%H:%i:%s') BETWEEN STR_TO_DATE(SUBSTRING('".$startdate."', 12) ,'%H:%i:%s') AND STR_TO_DATE(SUBSTRING('".$enddate."', 12) ,'%H:%i:%s')
			OR 
				STR_TO_DATE(SUBSTRING(n.`end`  , 12) ,'%H:%i:%s') BETWEEN STR_TO_DATE(SUBSTRING('".$startdate."', 12) ,'%H:%i:%s') AND STR_TO_DATE(SUBSTRING('".$enddate."', 12) ,'%H:%i:%s')
			)";
		
		$meQuery = $conn->query($meSQL)->fetch_assoc();
	
	
	
	// echo '<script type="text/javascript">alert("หหห'.$meQuery['count1'].'");</script>';
	if ($meQuery['count1'] == 0) {
	$meSQL = "INSERT INTO tb_event (id_member,rooms,title,start,end,color,division,people,style,equipment,member,etc,status_date,path_img) VALUES ('".$_POST['memberid']."','".$_POST['idrooms']."','".$_POST['title']."','".$startdate."','".$enddate."','".$meResult['color_rooms']."','".$_POST['division']."','".$_POST['people']."','".$_POST['style']."','".$equip."','".$_POST['member']."','".$_POST['etc']."','".$status_date."','../signature/signatures/fixbug.png')";
	$meQuery = $conn->query($meSQL);	
	
	
	
	ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			date_default_timezone_set("Asia/Bangkok");
			$sToken = "6gkrUWiKEsSCoRdLazJLxvS9Ofv7eflYn4lDt6ju137";
			$sMessage = " รอการอนุมัติ  มีการจองห้องประชุมเรื่อง ".$_POST['title']." โดย คุณ".$_POST['member'];
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
	echo "<script>alert('เพิ่มข้อมูลรียบร้อย กรุณาปริ้นคำขอ'); window.location ='../index.php?page=mybooking';</script>";
	//echo "<script>alert('เพิ่มข้อมูลเสร็จเรียบร้อยแล้ว'); window.location ='../signature/index.php?memberid=".$_POST['memberid']."&title=".$_POST['title']."';</script>";
	} else {
	echo "<script>alert('มีปัญหาการบันทึกข้อมูล  กรุณากลับไปบันทึกใหม่');</script>";
	exit();
	}
	} 
	else 
	{
	echo "<script>alert('ห้องประชุม  มีการจองแล้ว วันและช่วงเวลา กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
	}
	
	
	}	
	
	//แก้ไขข้อมูล  history.back(-1);
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
	if (is_array($_POST['equip']))
    {
	$equip = implode(',', $_POST['equip']);	
    }
	
	
	
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
	. "etc='{$_POST['etc']}' ";
	$meSQL .= "WHERE id ='{$_POST['id']}' ";
	$meQuery = $conn->query($meSQL);			
	if ($meQuery == TRUE) {
	echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=mybooking'; </script>";
    } else {
	echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
	exit();
    }
	}	
	//เปลี่ยนสถานะ
	if ($_GET['action']=='change'){
	if ($_GET['status']=='0'){
	$meSQL = "UPDATE tb_event SET status='3'";
	} else if($_GET['status']=='3'){
	$meSQL = "UPDATE tb_event SET status='0'";
	}
	$meSQL .= "WHERE id ='{$_GET['id']}' ";
	$meQuery = $conn->query($meSQL);			
	if ($meQuery == TRUE) {
	echo "<script>window.location ='../index.php?page=mybooking';</script>";
    } else {
	echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
	exit();
    }
	}	
	
	
	
	//ปิด
	$conn->close();
	?>
	
		