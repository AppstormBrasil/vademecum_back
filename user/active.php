<?php 
 

include("../util.php");

$currentDate = date("Y-m-d  H:i:s");

$checkfirst = checkAuth();
if($checkfirst == ""){
	$arr["status"] = "ERROR";
	$arr["status_txt"] = "Ops, token invalido! Tente novamente. Caso isso ocorra novamente, entre em contato com o suporte!" ;
	$arr["data"] = [];
	echo json_encode($arr);
	exit(0);
}
$checkfirst_ = get_object_vars($checkfirst);

if($checkfirst_["valid"] == 0){
	$arr["status"] = "ERROR";
	$arr["status_txt"] = "Ops, token invalido! Tente novamente. Caso isso ocorra novamente, entre em contato com o suporte!" ;
	echo json_encode($arr);
	exit(0);
} else {
	$user_type = $checkfirst_["user_type"];
}

$db = new db();

if (isset($_POST["id_"])) {
	$id_ = $_POST["id_"];
} else {
	$arr["status"] = "ERROR";
	$arr["status_txt"] = "Error! ID não informado!";
	echo json_encode($arr);
	exit(0);
}

if (isset($_POST["action"])) {
	$status = $_POST["action"];
} else {
	$arr["status"] = "ERROR";
	$arr["status_txt"] = "Error! ID não informado!";
	echo json_encode($arr);
	exit(0);
}

$db->query("UPDATE user SET status = :status WHERE id_ =:id_");
$db->bind(":id_", $id_);
$db->bind(":status", $status);

if ($db->execute()) {
	$arr["status"] = "SUCCESS";
	$arr["status_txt"] = "user deletado com sucesso!";
	echo json_encode($arr);
	exit(0);
} else {
	$arr["status"] = "ERROR";
	$arr["status_txt"] = "Erro ao salvar, se os problemas persistirem, entre em contato com o suporte!";
	echo json_encode($arr);
	exit(0);
}
    
 ?>