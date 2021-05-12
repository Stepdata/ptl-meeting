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
	
	if(isset($_POST['signaturesubmit'])){ 
		$signature = $_POST['signature'];
		$signatureFileName = uniqid().'.png';
		$signature = str_replace('data:image/png;base64,', '', $signature);
		$signature = str_replace(' ', '+', $signature);
		$data = base64_decode($signature);
		$file = 'signatures/'.$signatureFileName;
		file_put_contents($file, $data);
		
		$msg = "<div class='alert alert-success'>Signature Uploaded</div>";
		$msg1 = "<div class='alert alert-success'>$file</div>";
		$msg2 = "<div class='alert alert-success'>$signatureFileName</div>";
		$v_path = "../signature/signatures/".$signatureFileName;
		$meSQL = "UPDATE tb_event SET path_img= '{$v_path}' where id_member = '{$_GET['memberid']}' and title = '{$_GET['title']}'";
		$meQuery = $conn->query($meSQL);	

		
		
		 if ($meQuery == TRUE) {
			 echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=mybooking'; </script>";
		 } 
		else 
		 {
			 echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
			 exit();
		 }
		 echo"<script> window.location ='../index.php?page=mybooking';</script>";
	} 
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<style>
			#canvasDiv{
            position: relative;
            border: 2px dashed grey;
            height:65px;
			width :200px;
			}
		</style>
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<br>
					
				
	
					<?php echo isset($meSQL)?$meSQL:''; ?>
					<center><h2>เซ็นต์ชื่อเพื่อจองห้องประชุม</h2>
						<hr>
						<div id="canvasDiv"></div>
					
					<br>
						<button type="button" class="btn btn-danger" id="reset-btn">ล้าง</button>
						<button type="button" class="btn btn-success" id="btn-save">บันทึก</button>
						<br><br><br><br>
						<h5>หมายเหตุ :  เซ็นต์ให้ชิดด้านล่างสุด ลายเซ็นต์บันทึกแล้วไม่สามารถแก้ไขได้</h5>
						<img src="examsig.jpg"  alt="ตัวอย่างการเซ็นต์" /> 
						<h5>ตัวอย่างการเซ็นต์ชื่อ</h5>
						
					</center>
				</div>
				<form id="signatureform" action="" style="display:none" method="post">
					<input type="hidden" id="signature" name="signature">
					<input type="hidden" name="signaturesubmit" value="1">
				</form>
			</div>
		</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
	<script>
		$(document).ready(() => {
			var canvasDiv = document.getElementById('canvasDiv');
			var canvas = document.createElement('canvas');
			canvas.setAttribute('id', 'canvas');
			canvasDiv.appendChild(canvas);
			$("#canvas").attr('height', $("#canvasDiv").outerHeight());
			$("#canvas").attr('width', $("#canvasDiv").width());
			if (typeof G_vmlCanvasManager != 'undefined') {
				canvas = G_vmlCanvasManager.initElement(canvas);
			}
			
			context = canvas.getContext("2d");
			$('#canvas').mousedown(function(e) {
				var offset = $(this).offset()
				var mouseX = e.pageX - this.offsetLeft;
				var mouseY = e.pageY - this.offsetTop;
				
				paint = true;
				addClick(e.pageX - offset.left, e.pageY - offset.top);
				redraw();
			});
			
			$('#canvas').mousemove(function(e) {
				if (paint) {
					var offset = $(this).offset()
					//addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
					addClick(e.pageX - offset.left, e.pageY - offset.top, true);
					console.log(e.pageX, offset.left, e.pageY, offset.top);
					redraw();
				}
			});
			
			$('#canvas').mouseup(function(e) {
				paint = false;
			});
			
			$('#canvas').mouseleave(function(e) {
				paint = false;
			});
			
			var clickX = new Array();
			var clickY = new Array();
			var clickDrag = new Array();
			var paint;
			
			function addClick(x, y, dragging) {
				clickX.push(x);
				clickY.push(y);
				clickDrag.push(dragging);
			}
			
			$("#reset-btn").click(function() {
				context.clearRect(0, 0, window.innerWidth, window.innerWidth);
				clickX = [];
				clickY = [];
				clickDrag = [];
			});
			
			$(document).on('click', '#btn-save', function() {
				var mycanvas = document.getElementById('canvas');
				var img = mycanvas.toDataURL("image/png");
				anchor = $("#signature");
				anchor.val(img);
				$("#signatureform").submit();
			});
			
			var drawing = false;
			var mousePos = {
				x: 0,
				y: 0
			};
			var lastPos = mousePos;
			
			canvas.addEventListener("touchstart", function(e) {
				mousePos = getTouchPos(canvas, e);
				var touch = e.touches[0];
				var mouseEvent = new MouseEvent("mousedown", {
					clientX: touch.clientX,
					clientY: touch.clientY
				});
				canvas.dispatchEvent(mouseEvent);
			}, false);
			
			
			canvas.addEventListener("touchend", function(e) {
				var mouseEvent = new MouseEvent("mouseup", {});
				canvas.dispatchEvent(mouseEvent);
			}, false);
			
			
			canvas.addEventListener("touchmove", function(e) {
				
				var touch = e.touches[0];
				var offset = $('#canvas').offset();
				var mouseEvent = new MouseEvent("mousemove", {
					clientX: touch.clientX,
					clientY: touch.clientY
				});
				canvas.dispatchEvent(mouseEvent);
			}, false);
			
			
			
			// Get the position of a touch relative to the canvas
			function getTouchPos(canvasDiv, touchEvent) {
				var rect = canvasDiv.getBoundingClientRect();
				return {
					x: touchEvent.touches[0].clientX - rect.left,
					y: touchEvent.touches[0].clientY - rect.top
				};
			}
			
			
			var elem = document.getElementById("canvas");
			
			var defaultPrevent = function(e) {
				e.preventDefault();
			}
			elem.addEventListener("touchstart", defaultPrevent);
			elem.addEventListener("touchmove", defaultPrevent);
			
			
			function redraw() {
				//
				lastPos = mousePos;
				for (var i = 0; i < clickX.length; i++) {
					context.beginPath();
					if (clickDrag[i] && i) {
						context.moveTo(clickX[i - 1], clickY[i - 1]);
						} else {
						context.moveTo(clickX[i] - 1, clickY[i]);
					}
					context.lineTo(clickX[i], clickY[i]);
					context.closePath();
					context.stroke();
				}
			}
		})
		
	</script>
</html>		