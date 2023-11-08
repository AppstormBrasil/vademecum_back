<?php
include('../util.php');
$created_at = date('Y-m-d  H:i:s');

$db = new db();

if (isset($_POST['email'])) {
	$email = $_POST['email'];
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'E-mail not Found';
	echo json_encode($arr);
	exit(0);
}

if (isset($_POST['password'])) {
	$password = $_POST['password'];
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Passowrd not Found';
	echo json_encode($arr);
	exit(0);
}

$password = trim($_POST['password']);
//$password = md5($password);

if (isset($_POST['device_type'])) {
	$device_type = $_POST['device_type'];
} else {
	$device_type  = '';
}


if ($email != "") {

	$db->query('SELECT 
			u.id_ as id_user,
			u.name as user_name,
			u.email as user_email,
			u.password as user_pass,
			u.user_type as user_type,
			u.status  
			FROM user u 
  			WHERE u.email = :email AND u.password = :password ');

	$db->bind(':email', $email);
	$db->bind(':password', $password);
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'No user found';
	echo json_encode($arr);
	exit(0);
}

$result = $db->resultset();

if ($result) {
	
	$i = 0;
	$arr = [];
	foreach ($result as $row) {
		
		$status = $row["status"];

		if($status == 1){
			$id_user = $row["id_user"];
			$user_name = $row["user_name"];
			$user_type = $row["user_type"];
			
			$issuedAt = time();
			$expirationTime = $issuedAt + 60 * 60 * 24 * 24;

			$payload = ['userid' => $id_user, 
			'user_name' => $user_name , 
			'iat' => $issuedAt , 
			'exp' => $expirationTime  , 
			'user_type' => $user_type , 
			'email' => $email,
		
			];
			
			$payload_encoded = base64url_encode(json_encode($payload));
			$signature = hash_hmac('sha256', "$headers_encoded.$payload_encoded", $key, true);
			$signature_encoded = base64url_encode($signature);
			$token = "$headers_encoded.$payload_encoded.$signature_encoded";

			$arr['user_info'] = array(
				'usertoken' => $token,
			);

			$arr["id_user"] = $id_user;

			$arr['status'] = 'SUCCESS';
			$arr['status_txt'] = 'Sucessfuly Login';
			echo json_encode($arr);

			if (isset($_POST['c_user_push'])) {
				$c_user_push = $_POST['c_user_push'];

				if($c_user_push != ""){
					$endpoint = $c_user_push['endpoint'];
					$authToken = $c_user_push['authToken'];
					$contentEncoding = $c_user_push['contentEncoding'];
					$publicKey = $c_user_push['publicKey'];
					if($device_type != ""){
						if($device_type != "desktop"){
							//update_push($endpoint,$authToken,$contentEncoding,$publicKey,$id_user);
						}
					}
				}

			} 

			exit(0);

		} else {
			$arr['status'] = 'ERROR';
			$arr['status_txt'] = 'Your account needs to be activated! Please contact your administrator';
			echo json_encode($arr);
			exit(0);
		}

		
	}

	
	
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Invalid login or password';
	echo json_encode($arr);
	exit(0);
}

function update_push($endpoint,$authToken,$contentEncoding,$publicKey,$id_){

	$db = new db();
	$db->query('UPDATE users SET endpoint = :endpoint , authToken = :authToken , contentEncoding = :contentEncoding , publicKey = :publicKey WHERE id_ = :id_');
	$db->bind(':endpoint', $endpoint);
	$db->bind(':authToken', $authToken);
	$db->bind(':contentEncoding', $contentEncoding);
	$db->bind(':publicKey', $publicKey);
	$db->bind(':id_', $id_);
	$db->execute();
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