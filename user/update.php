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

 if(isset($_POST['id_'])){
    $id_ = $_POST['id_'];
} else {
   $arr['status'] = 'ERROR';
   $arr['status_txt'] = 'Erro! id_ não fornecido!';
    echo json_encode($arr); 
   exit(0);
} 

 if(isset($_POST['name'])){
    $name = $_POST['name'];
} else {
   $arr['status'] = 'ERROR';
   $arr['status_txt'] = 'Erro! name não fornecido!';
    echo json_encode($arr); 
   exit(0);
} 

 if(isset($_POST['email'])){
    $email = $_POST['email'];
} else {
   $arr['status'] = 'ERROR';
   $arr['status_txt'] = 'Erro! email não fornecido!';
    echo json_encode($arr); 
   exit(0);
} 


$db->query('UPDATE user SET name = :name,email = :email,updatedAt = :updatedAt WHERE id_= :id_ '); 
$db->bind(':id_', $id_); 
$db->bind(':name', $name); 
$db->bind(':email', $email); 
$db->bind(':updatedAt', $currentDate); 
if($db->execute()){ 
	$arr['status'] = 'SUCCESS';
	$arr['status_txt'] = 'Atualizado com sucesso'; 
	echo json_encode($arr);
	exit(0);
} else { 
 	$arr['status'] = 'ERROR'; 
	$arr['status_txt'] = 'Erro ao salvar, se os problemas persistirem, entre em contato com o suporte!'; 
	echo json_encode($arr);
	exit(0);
} 

 ?>