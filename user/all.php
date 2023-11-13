<?php 
include('../util.php');

$currentDate = date('Y-m-d H:i:s'); 
$db = new db();  

$checkfirst = checkAuth();
if($checkfirst == ''){ 
    $arr['status'] = 'ERROR'; 
    $arr['status_txt'] = 'Ops, token invalido! Tente novamente. Caso isso ocorra novamente, entre em contato com o suporte!';
    $arr['data'] = []; 
    echo json_encode($arr); 
    exit(0);
} 
$checkfirst_ = get_object_vars($checkfirst);

if($checkfirst_['valid'] == 0){ 
    $arr['status'] = 'ERROR'; 
    $arr['status_txt'] = 'Ops, token invalido! Tente novamente. Caso isso ocorra novamente, entre em contato com o suporte!';
    $arr['data'] = []; 
    echo json_encode($arr); 
    exit(0);
} else { 
    $user_type = $checkfirst_['user_type']; 
}

$db->query('SELECT id_,name,email, createdAt, updatedAt, status, user_type FROM user'); 

$result = $db->resultset(); 

if($result){ 
	 $i = 0; 
	 foreach($result as $row) { 
	 	 $arr['data'][] = array(
	 	 	 'id_' => $row['id_'],
	 	 	 'name' => $row['name'],
	 	 	 'email' => $row['email'],
	 	 	 'createdAt' => $row['createdAt'],
	 	 	 'updatedAt' => $row['updatedAt'],
	 	 	 'status' => $row['status'],
	 	 	 'user_type' => $row['user_type'],
	 	 ); 
 	 	 $i++;
	 } 
	  $arr['status'] = 'SUCCESS';
	  $arr['total'] = $i;
	  echo json_encode($arr);
	  exit(0);
} else { 
 	  $arr['status'] = 'ERROR'; 
	  $arr['status_txt'] = 'No data Found'; 
	  echo json_encode($arr);
	  exit(0);
} 

 ?>