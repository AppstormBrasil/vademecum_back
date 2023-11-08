<?php 
 
include('../util.php');

$created_at = date('Y-m-d  H:i:s'); 
 
$db = new db();

if (isset($_POST['email'])) {
	$email = $_POST['email'];
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'E-mail não informado';
	echo json_encode($arr);
	exit(0);
}

if (isset($_POST['password'])) {
	$password = $_POST['password'];
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Senha não informada';
	echo json_encode($arr);
	exit(0);
}

if (isset($_POST['device_type'])) {
	$device_type = $_POST['device_type'];
} else {
	$device_type  = '';
}
	
$password = trim($_POST['password']);	
$password = md5($password);

if ($email != "") {
	$db->query('SELECT * FROM user u WHERE u.email = :email  AND u.password = :password');
	$db->bind(':email', $email);
	$db->bind(':password', $password);

	$result = $db->resultset();

	if($result){
		foreach($result as $row) {

			$id_user = $row["id_"]; 
			$user_name = $row["name"];
			$user_email = $row["email"];
			$user_type = $row["user_type"];
			$user_status = $row["status"];
	
			
	
			$issuedAt = time();
			$expirationTime = $issuedAt + 60 * 60 * 24 * 24;
	
			$payload = ['userid' => $id_user, 
						'user_name' => $user_name, 
						'email' => $user_email,
						'user_type' => $user_type, 
						'iat' => $issuedAt, 
						'exp' => $expirationTime, 
					];
			
			$payload_encoded = base64url_encode(json_encode($payload));
	
			$signature = hash_hmac('sha256', "$headers_encoded.$payload_encoded", $key, true);
			
			$signature_encoded = base64url_encode($signature);
			$token = "$headers_encoded.$payload_encoded.$signature_encoded";
	
			$arr['user_info'] = array(
				'usertoken' => $token,
				'userid' => $id_user, 
				'usertype' => $user_type,
				'user_name' => $user_name , 
				'email' => $email,
			);
		}
		
		$arr['status'] = 'SUCCESS';
		$arr['status_txt'] = 'Login realizado com sucesso!';
		$arr['id_user'] = $id_user;
		echo json_encode($arr);

		exit(0);
	}else {
		$arr['status'] = 'ERROR';
		$arr['status_txt'] = 'Não foi possível encontrar o usuário. Verifique o email e a senha!';
		echo json_encode($arr);
		exit(0);
	}
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Não foi possível encontrar o usuário';
	echo json_encode($arr);
	exit(0);
}

function getUserIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
 
?>