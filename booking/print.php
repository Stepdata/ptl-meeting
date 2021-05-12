<style type="text/css"> 
	input[type='checkbox']:checked:after {
	background: #FFF;
	content: '\2714';
	color: #000;
	}
</style>
<?php 
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	if ($_SESSION['status'] =='admin' || $_SESSION['status'] =='user' )  
	{
		include '../connect.php';
		include '../function.php';
		$meSQL = "SELECT * FROM tb_event AS t1 
		LEFT JOIN tb_division AS t2 
		ON t1.division = t2.id_division 
		LEFT JOIN tb_style AS t3
		ON t1.style = t3.id_style 
		LEFT JOIN tb_rooms AS t4
		ON t1.rooms = t4.id_rooms
		LEFT JOIN tb_member AS t5
		ON t1.id_member = t5.id_member WHERE id ='{$_GET['id']}' ";
		$meQuery = $conn->query($meSQL);
		if ($meQuery == TRUE) {
			$meResult = $meQuery->fetch_assoc();
			} else {
			echo $conn->error;
		}
		} else {
		echo "<script>alert('คุณไม่มีสิทธิในการเข้าถึง!'); window.location ='index.php';</script>";
	}
?>
<html 
lang="en" xmlns="http://www.w3.org/1999/xhtml"
xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
	
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<meta name=ProgId content=Excel.Sheet>
		<meta name=Generator content="Microsoft Excel 15">
		<link rel=Stylesheet href=stylesheet.css>
		<style type='text/css'>
			
			@font-face {
			font-family: 'THSarabunPSK';
			src: url('../assets/fonts/THSarabunPSK.eot') format('embedded-opentype'),  url('../assets/fonts/THSarabunPSK.woff') format('woff'), url('../assets/fonts/THSarabunPSK.ttf')  format('truetype'), url('../assets/fonts/THSarabunPSK.svg') format('svg');
			font-weight: normal;
			font-style: normal;
			}
			
			body { font-family: 'THSarabunPSK' !important; }
			
		</style>
	</head>
	
	<body link="#0563C1" vlink="#954F72" class=xl65>
		
		<table border=0 cellpadding=0 cellspacing=0 width=629 style='border-collapse: collapse;table-layout:fixed;width:476pt'>
			<col class=xl65 width=37 span=17 style='width:28pt'>
			
			
			<tr height=37 style='mso-height-source:userset;height:27.95pt'>
				<td colspan=7 height=28 class=xl66 style='height:21.0pt'></td> 
				<td height=37 class=xl69 width=900 style='height:27.95pt;width:476pt'><p style="font-size:31px">แบบคำขออนุญาตใช้ห้องประชุม</p></td>
			</tr>
			
			
			
			<tr height=28 style='mso-height-source:userset;height:40.0pt'>
				<td colspan=14 height=28 class=xl66 style='height:21.0pt'></td>
				<td class=xl65 colspan=5 align=left style='mso-ignore:colspan'><p style="font-size:22px">วันที่ <?php echo $meResult['status_date'];?>  </p></td>  
			</tr>
			<tr height=28 style='mso-height-source:userset;height:40.0pt'>
				<td colspan=4 height=28 class=xl65 align=left style='height:21.0pt'><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เรื่อง &nbsp;&nbsp;&nbsp;ขออนุญาตใช้ห้องประชุม</p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:30.0pt'>
				<td colspan=4 height=28 class=xl65 align=left style='height:21.0pt'><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เรียน &nbsp;&nbsp; <?php echo $boss ;?></p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:5.0pt'></tr>
			<tr height=28 style='mso-height-source:userset;height:23.0pt'>
				<td colspan=4 height=28 class=xl65 style='height:21.0pt'></td>
				<td colspan=2 class=xl67><p style="font-size:22px">ข้าพเจ้า</p></td>
				<td colspan=7 class=xl67><p style="font-size:22px"><?php echo $meResult['ntitle'].$meResult['member'];?></p></td>
				<td colspan=2 class=xl66><p style="font-size:22px">ตำแหน่ง</p></td>
				<td colspan=5 class=xl67><p style="font-size:22px"><?php echo $meResult['position'];?></p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:23.0pt'>
				<td height=28 class=xl66 style='height:21.0pt'><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สังกัด &nbsp;&nbsp;&nbsp;<?php echo $meResult['name_division'];?></p></td>
				<td colspan=12 class=xl67></td>
				<td colspan=16 class=xl66><p style="font-size:22px">เบอร์โทรศัพท์ &nbsp;&nbsp;<?php echo $meResult['phone'];?></p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:23.0pt'>
				<td colspan=6 height=28 class=xl66 style='height:21.0pt'><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;มีความประสงค์ขออนุญาตใช้&nbsp;<?php echo $meResult['name_rooms'];?></p></td>
				<td colspan=11 class=xl67></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:23.0pt'>
				<td colspan=3 height=28 class=xl66 style='height:21.0pt'><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่</p></td>
				<td colspan=1 class=xl67><p style="font-size:22px">&nbsp;&nbsp;<?php echo date('d',strtotime($meResult['start']));?></p></td>
				<td class=xl65 align=left><p style="font-size:22px">&nbsp;&nbsp;เดือน</p></td>
				<td colspan=4 class=xl67><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $thai_month_arr[date("n",strtotime($meResult['start']))];?></p></td>
				<td class=xl65 align=left><p style="font-size:22px">พ.ศ.</p></td>
				<td colspan=2 class=xl67><p style="font-size:22px">&nbsp;<?php echo date('Y',strtotime($meResult['start']))+543;?></p></td>
				<td class=xl65 align=left><p style="font-size:22px">เวลา</p></td>
				<td colspan=5 class=xl67><p style="font-size:22px">&nbsp;&nbsp;&nbsp;<?php echo date('H:i',strtotime($meResult['start']));?>  &nbsp;&nbsp;&nbsp; น.</p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:23.0pt'>
				<td colspan=3 height=28 class=xl66 style='height:21.0pt'><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ถึงวันที่</p></td>
				<td colspan=1 class=xl67><p style="font-size:22px">&nbsp;&nbsp;<?php echo date('d',strtotime($meResult['end']));?></p></td>
				<td class=xl65 align=left><p style="font-size:22px">&nbsp;&nbsp;เดือน</p></td>
				<td colspan=4 class=xl67><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $thai_month_arr[date('n',strtotime($meResult['end']))];?></p></td>
				<td class=xl65 align=left><p style="font-size:22px">พ.ศ.</p></td>
				<td colspan=2 class=xl67><p style="font-size:22px">&nbsp;<?php echo date('Y',strtotime($meResult['end']))+543;?></p></td>
				<td class=xl65 align=left><p style="font-size:22px">เวลา</p></td>
				<td colspan=5 class=xl67><p style="font-size:22px">&nbsp;&nbsp;&nbsp;<?php echo date('H:i',strtotime($meResult['end']));?>  &nbsp;&nbsp;&nbsp; น.</p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:23.0pt'>
				<td colspan=3 height=28 class=xl66 style='height:21.0pt'><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวม</p></td>
				<td colspan=1 class=xl67><p style="font-size:22px">&nbsp;&nbsp;<?php $day = round(abs(strtotime($meResult['start']) - strtotime($meResult['end']))/60/60/24);if($day <= 0){echo '1';} else {echo $day;} ?> </p></td>
				<td class=xl65 align=left><p style="font-size:22px"> &nbsp;&nbsp;วัน  </p></td>
				<td colspan=10 class=xl67><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โดยมีวัตถุประสงค์เพื่อ &nbsp;<?php echo $meResult['title'];?></p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:23.0pt'>
				<td colspan=6 height=28 class=xl66 style='height:21.0pt'><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;มีผู้เข้าร่วมประชุมจำนวน</p></td>
				<td class=xl65 align=left><p style="font-size:22px"><?php echo $meResult['people'];?> &nbsp;คน</p></td>
				<td class=xl65 align=left><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;รูปแบบการจัดห้องแบบ  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $meResult['name_style'];?></p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:23.0pt'>
				<td colspan=3 height=28 class=xl66 style='height:21.0pt'><p style="font-size:22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เครื่องมือ อุปกรณ์ และสิ่งอำนวยความสะดวก</p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:23.0pt'>
				<td colspan=1 height=28 class=xl65 style='height:25.0pt'></td>
				<td colspan=3 height=28 class=xl65 style='height:21.0pt'>
					<div style="padding-left:100px;">
						<p style="font-size:22px">
							<?php 
								$meSQL2 = "SELECT * FROM tb_equipment ORDER BY id_equipment asc";
								$meQuery2 = $conn->query($meSQL2);
								$equipment = explode(',' , $meResult['equipment']);
								//echo $equipment;
								while ($meResult2 = $meQuery2->fetch_assoc()){
									if (in_array($meResult2['name_equipment'], $equipment))
									{
										echo "<input type='checkbox' disabled='false' name='equip[]' value='".$meResult2['name_equipment']."' checked >";
									}else
									{
										echo "<input type='checkbox' disabled='false' name='equip[]' value='".$meResult2['name_equipment']."' >";
									}// end if
								?> 	  
								<label for="equip[]"><?php echo $meResult2['name_equipment'];?></label>&nbsp;&nbsp; &nbsp;&nbsp;
								<?php $i++; if ($i == 3){echo '<br />';$i=0;} 
								} ?>
						</p>	
					</div>
				</td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:25.0pt'>
				<td colspan=4 height=28 class=xl65 style='height:25.0pt'></td>
				<td colspan=15 class=xl66><p style="font-size:22px">จึงเรียนมาเพื่อโปรดพิจารณาอนุญาต</p></td>
			</tr>
			
			<tr height=28 style='mso-height-source:userset;height:1.0pt'></tr>
			<tr height=28 style='mso-height-source:userset;height:21.0pt'>
				<td colspan=11 height=28 class=xl65 style='height:21.0pt'></td>
				<td colspan=8 class=xl66><p style="font-size:22px">ลงชื่อ<img src="<?php echo $meResult['path_img'];?> "/> ผู้ขออนุญาต</p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:10.0pt'>
				<td height=28 class=xl65 style='height:10.0pt'></td>
				<td colspan=2 class=xl70> <p style="font-size:22px">ความเห็นเจ้าหน้าที่</p></td>
				<td colspan=9 height=28 class=xl71 style='height:21.0pt'><p style="font-size:22px">(</p></td>
				<td colspan=5 class=xl67 style="text-align:center;"><p style="font-size:22px"><?php echo $meResult['ntitle'] ; echo $meResult['member'];?></p></td>
				<td colspan=0 class=xl66><p style="font-size:22px">)</p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:27.0pt'>
				<td colspan=2 height=28 class=xl65 style='height:21.0pt'></td>
				<td colspan=9 class=xl66> <p style="font-size:22px">ได้ตรวจสอบแล้ว ปรากฏว่า
				</p></td>
				<td colspan=10 class=xl66><p style="font-size:22px">&nbsp;&nbsp;ตำแหน่ง   <?php echo $meResult['position'];?></p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:27.0pt'>
				<td colspan=2 class=xl66></td>
				<td colspan=10 class=xl66><p style="font-size:22px"> 
					<?php echo "<input type='checkbox' disabled='false'>"?> ห้องประชุมว่าง
					&nbsp;&nbsp;
					<?php echo "<input type='checkbox' disabled='false'>"?> ห้องประชุมไม่ว่าง
				</p></td>
				<td class=xl66><p style="font-size:22px">&nbsp;&nbsp; วันที่ <?php echo $meResult['status_date'];?></p></td>
			</tr>
			
			<tr height=28 style='mso-height-source:userset;height:25.0pt'>
				<td colspan=2 class=xl66></td>
				<td class=xl66><p style="font-size:22px">เพื่อโปรดพิจารณา</p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:20.0pt'></tr>
			<tr height=28 style='mso-height-source:userset;height:21.0pt'>
				<td height=28 class=xl65 style='height:21.0pt'></td>
				<td colspan=10 class=xl66><p style="font-size:22px">&nbsp;ลงชื่อ..................................................เจ้าหน้าที่</p></td>
				<td class=xl70><p style="font-size:22px">ความเห็นของ<?php echo $boss ;?></p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:21.0pt'>
				<td colspan=2 height=28 class=xl65 style='height:21.0pt'></td>
				<td colspan=10 class=xl66><p style="font-size:22px">(.................................................)</p></td>
				<td class=xl66><p style="font-size:22px">
					<?php echo "<input type='checkbox' disabled='false'>"?> อนุญาต
					&nbsp;&nbsp;
					<?php echo "<input type='checkbox' disabled='false'>"?> ไม่อนุญาต
				</p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:21.0pt'>
				<td colspan=1 class=xl65></td>
				<td colspan=11 class=xl66><p style="font-size:22px">&nbsp;วันที่&nbsp;...................................................</p></td>
				<td class=xl66><p style="font-size:22px"><?php echo "<input type='checkbox' disabled='false'>"?> ห้องประชุมไม่ว่างแจ้งผู้ร้องทราบ</p></td>
			</tr>
			
			<tr height=28 style='mso-height-source:userset;height:20.0pt'></tr>
			<tr height=28 style='mso-height-source:userset;height:21.0pt'>
				<td colspan=11 class=xl65></td>
				<td class=xl66><p style="font-size:22px">ลงชื่อ..................................................ปลัดเทศบาล</p></td>
			</tr>
			
			
			<tr height=28 style='mso-height-source:userset;height:21.0pt'>
				<td colspan=12 height=28 class=xl65 style='height:21.0pt'></td>
				<td class=xl66><p style="font-size:22px">(.................................................)</p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:21.0pt'>
				<td colspan=11 class=xl65></td>
				<td class=xl66><p style="font-size:22px">&nbsp;วันที่&nbsp;...................................................</p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:15.0pt'></tr>
			<tr height=28 style='mso-height-source:userset;height:20.0pt'>
				<td colspan=1 height=28 class=xl65 style='height:21.0pt'></td>
				<td class=xl66><p style="font-size:20px">หมายเหตุ&nbsp; : กรณีมีการยกเลิกการใช้ห้องประชุม โปรดแจ้งล่วงหน้า 24 ชั่วโมง โทร. 074-613007 ต่อ 104 หรือทางไลน์ @771mnqbl </p></td>
			</tr>
			<tr height=28 style='mso-height-source:userset;height:0.0pt'>
				<td colspan=2 height=28 class=xl65 style='height:0.0pt'></td>
				<td colspan=2 class=xl66><p style="font-size:20px">&nbsp;&nbsp;&nbsp;&nbsp;<img src="qrcode.png" width="60" height="60" alt="" /> </p></td>
				<td class=xl66>	สป.ทม.พัทลุง</td>
			</tr>
			
			
			<![if supportMisalignedColumns]>
			<tr height=0 style='display:none'>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
				<td width=37 style='width:28pt'></td>
			</tr>
			<![endif]>
		</table>
		<div style="text-align:center;"><input type="button" name="Button" value="พิมพ์" onclick="javascript:this.style.display='none';window.print();"></div>
	</body>
	
</html>
