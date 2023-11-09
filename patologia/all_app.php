<?php
include('../util.php');

$currentDate = date('Y-m-d H:i:s');
$db = new db();

$db->query('SELECT id_,cid,patologia,descricao,referencias, createdAt, updatedAt, status, user_type FROM patologia');

$result = $db->resultset();

if ($result) {
	$i = 0;
	foreach ($result as $row) {
		$arr['data'][] = array(
			'id_' => $row['id_'],
			'cid' => $row['cid'],
			'patologia' => $row['patologia'],
			'descricao' => $row['descricao'],
			'referencias' => $row['referencias'],
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