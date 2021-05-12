<?php
$conn = mysqli_connect("localhost", "u166343836_root", "Data123456789", "u166343836_room");
mysqli_set_charset($conn, 'utf8');
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
date_default_timezone_set('Asia/Bangkok');
//config
$org = "<i class='ace-icon glyphicon glyphicon-lock'></i>".'  เทศบาลเมืองพัทลุง' ; //ชื่อหน่วยงาน
$boss = 'ปลัดเทศบาลเมืองพัทลุง' ; //ชื่อตำแหน่งหัวหน้าใช้ในปริ้นหนังสือ
?>