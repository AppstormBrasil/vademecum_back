<?php
include('../util.php');
include('../email/recovery.php');

$currentDate = date('Y-m-d H:i:s');

$db = new db();

if (isset($_POST["email"])) {
	$email = $_POST["email"];
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Ops, e-mail não informado!' ;
	echo json_encode($arr);
	exit(0);
}

$db->query('SELECT u.email, u.id_, u.name FROM users u WHERE u.email = :email'); 
$db->bind(':email', $email);
$result = $db->single();					
//$result = $db->resultset();
if($result){
	$new_pass = sprintf("%06d", mt_rand(1, 999999));
	$new_token = sprintf("%06d", mt_rand(1, 999999));
	$password = md5($new_pass);
	$token = md5($new_token);
	$email = $result["email"];
	$id_ = $result["id_"];
	$name = $result["name"];

	$db->query('UPDATE users SET pass_temp = :pass_temp , token_temp = :token_temp WHERE id_ = :id_ AND email = :email ');
	$db->bind(':pass_temp', $password);
	$db->bind(':token_temp', $token);
	$db->bind(':id_', $id_);
	$db->bind(':email', $email);

	if($db->execute()){ 
		$check_email = email_recovery($email,$new_pass,$name,$prod_path,$mail,$token);

		if($check_email == 'Sucess'){
			$arr['status'] = 'SUCCESS';
			$arr['status_txt'] = 'Nova senha enviado ao e-mail com sucesso! Favor verificar a caixa de entrada e o spam!';
			echo json_encode($arr);
		} else {
			$arr['status'] = 'ERROR';
			$arr['status_txt'] = $check_email;
			echo json_encode($arr);
		}
	}
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Erro! E-mail não cadastrado/encontrado em nosso banco de dados!';
	echo json_encode($arr);
	exit(0);
}

?>