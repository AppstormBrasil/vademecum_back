<?php

include('../util.php');
$currentDate = date('Y-m-d H:i:s');
$db = new db();

if (isset($_POST['name'])) {
	$name = $_POST['name'];
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Erro! name não fornecido!';
	echo json_encode($arr);
	exit(0);
}

if (isset($_POST['email'])) {
	$email = $_POST['email'];
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Erro! email não fornecido!';
	echo json_encode($arr);
	exit(0);
}

if (isset($_POST['password'])) {
	$password = $_POST['password'];
	$password = md5($password);
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Erro! password não fornecido!';
	echo json_encode($arr);
	exit(0);
}

$bytes = random_bytes(6);
$id_ = bin2hex($bytes);

$db->query('INSERT INTO user (id_,name,email,password,createdAt,updatedAt,status,user_type) VALUES (:id_,:name,:email,:password,:createdAt,:updatedAt, :status, :usertype);');
$db->bind(':id_', $id_);
$db->bind(':name', $name);
$db->bind(':email', $email);
$db->bind(':password', $password);
$db->bind(':createdAt', $currentDate);
$db->bind(':updatedAt', $currentDate);
$db->bind(':status', 1);
$db->bind(':usertype', "user");
if ($db->execute()) {
	$arr['status'] = 'SUCCESS';
	$arr['status_txt'] = 'Dados inseridos com sucesso!';
	echo json_encode($arr);
	exit(0);
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Erro ao salvar, se os problemas persistirem, entre em contato com o suporte!';
	echo json_encode($arr);
	exit(0);
}

?>