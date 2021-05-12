<?php
include '../../connect.php';
$data = array();
$query = "SELECT * FROM tb_event AS t1 
LEFT JOIN tb_division AS t2 
ON t1.division = t2.id_division 
LEFT JOIN tb_style AS t3
ON t1.style = t3.id_style 
LEFT JOIN tb_rooms AS t4
ON t1.rooms = t4.id_rooms WHERE status = 1";
if ($result = $conn->query($query)) {	
    /* fetch object array */
    while ($obj = $result->fetch_object()) {
       $data[] = array(
                    'id' => $obj->id,
                    'title'=> $obj->title,
                    'start'=> $obj->start,
                    'end'=> $obj->end,
                    'color'=> $obj->color,
                    'division'=> $obj->name_division,
                    'people'=> $obj->people,
                    'style'=> $obj->name_style,
                    'equipment'=> $obj->equipment,
					'member'=> $obj->member,
					'rooms'=> $obj->name_rooms,
					'etc'=> $obj->etc,
                    );
    }

    /* free result set */
    $result->close();
}
$conn->close();

$data=(isset($data))?$data:NULL;
$json= json_encode($data);  
if(isset($_GET['callback']) && $_GET['callback']!=""){  
echo $_GET['callback']."(".$json.");";      
}else{  
echo $json;  
}
?>