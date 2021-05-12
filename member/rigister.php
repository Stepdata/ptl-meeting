<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="fonts/linearicons/style.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">
				<form  name="formregister" method="post"  action="./action-rigister.php?action=add">
					<h3>สมัครสมาชิก</h3>
					<div class="form-holder">
						<span class="lnr lnr-user"></span>
						<input type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="Username ภาษาอังกฤษและตัวเลข" value="" required>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" name="txtPassword" id="txtPassword" class="form-control" placeholder="Password ภาษาอังกฤษและตัวเลข" value="" required>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" name="txtConPassword" id="txtConPassword" class="form-control" placeholder="Confirm Password" value="" required>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-user"></span>
						<input type="text" name="title" id="title" class="form-control" placeholder="คำนำหน้า" value="" required>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-user"></span>
						<input type="text"  name="txtfirstname" id="txtfirstname" class="form-control" placeholder="ชื่อ" value="" required>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-user"></span>
						<input type="text" name="txtsurname" id="txtsurname" class="form-control" placeholder="นามสกุล" value="" required>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-user"></span>
						<input type="text" name="position" id="position" class="form-control" placeholder="ตำแหน่ง" value="" required>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-phone-handset"></span>
						<input type="text" name="phone" id="phone" class="form-control" placeholder="เบอร์โทรศัพท์" value="" required>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="text"  name="txtemail" id="txtemail"  class="form-control" placeholder="E-Mail" >
					</div>
					<button type="submit" >
						<span>Register</span> 
					</button>
				</form>
				<img src="images/image-2.png" alt="" class="image-2">
			</div>
			
		</div>
		
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/main.js"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>