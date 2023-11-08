<?php

include("../util.php");

$created_at = date("Y-m-d  H:i:s");

$checkfirst = checkAuth();
if ($checkfirst == "") {
	$arr["status"] = "ERROR";
	$arr["status_txt"] = "Ops , Invalid Token ! If the problem persists, contact our technical support!";
	$arr["data"] = [];
	echo json_encode($arr);
	exit(0);
}
$checkfirst_ = get_object_vars($checkfirst);


if ($checkfirst_["valid"] == 0) {
	$arr["status"] = "ERROR";
	$arr["status_txt"] = "Ops , Invalid Token ! If the problem persists, contact our technical support!";
	echo json_encode($arr);
	exit(0);
} else {
	$user_type = $checkfirst_["user_type"];
}


$db = new db();
$i = 0;
$array_cid = [];
$array_patologia = [];
$array_descricao = [];
$array_referencias = [];


$db->query("SELECT cid, patologia,descricao, referencias  FROM patologia");


$db->execute();
$result = $db->resultset();
if ($result) {
	foreach ($result as $row) {
		$cid = $row["cid"];
		$patologia = $row["patologia"];
		$descricao = $row["descricao"];
		$referencias = $row["referencias"];


		if (!(in_array($row["cid"], $array_cid))) {
			array_push($array_cid, $row["cid"]);
		}

		if (!(in_array($row["patologia"], $array_patologia))) {
			array_push($array_patologia, $row["patologia"]);
		}

		if (!(in_array($row["descricao"], $array_descricao))) {
			array_push($array_descricao, $row["descricao"]);
		}

		if (!(in_array($row["referencias"], $array_referencias))) {
			array_push($array_referencias, $row["referencias"]);
		}

		$arr["data"][] = array(

			"cid" => $row["cid"],

			"patologia" => $row["patologia"],

			"descricao" => $row["descricao"],

			"referencias" => $row["referencias"],

		);
		$i++;
	}
}



if ($i > 0) {

	$arr["array_cid"] = $array_cid;
	$arr["array_patologia"] = $array_patologia;
	$arr["array_referencias"] = $array_referencias;

	$arr["status"] = "SUCCESS";
	$arr["total"] = $i;
	echo json_encode($arr);
	exit(0);
} else {
	$arr["status"] = "ERROR";
	$arr["status_txt"] = "No data Found!";
	$arr["data"] = [];
	echo json_encode($arr);

	exit(0);
}

?>