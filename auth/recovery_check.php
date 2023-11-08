<?php
include('../util.php');


$currentDate = date('Y-m-d H:i:s');

$db = new db();

if (isset($_POST["id_token"])) {
	$id_token = $_POST["id_token"];
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Ops, Token invalido, tente novamente!' ;
	echo json_encode($arr);
	exit(0);
}

$db->query('SELECT u.email,u.id_,u.pass_temp FROM users u WHERE u.token_temp = :token_temp'); 
$db->bind(':token_temp', $id_token);
$result = $db->single();					
//$result = $db->resultset();
if($result){
	$email = $result["email"];
	$id_ = $result["id_"];
	$password = $result["pass_temp"];

	$db->query('UPDATE users SET password = :password , token_temp = :token_temp , pass_temp = :pass_temp WHERE id_ = :id_ AND email = :email ');
	$db->bind(':id_', $id_);
	$db->bind(':password', $password);
	$db->bind(':token_temp', '');
	$db->bind(':pass_temp', '');
	$db->bind(':email', $email);

	if($db->execute()){ 
		$arr['status'] = 'SUCCESS';
		$arr['status_txt'] = 'Senha atualizada com sucesso!';
		echo json_encode($arr);

	} else {

		$arr['status'] = 'ERROR';
		$arr['status_txt'] = $check_email;
		echo json_encode($arr);
	}
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Error! Usuário não encontrado!';
	echo json_encode($arr);
	exit(0);
}

?>