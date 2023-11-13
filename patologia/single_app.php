<?php
include('../util.php');

$currentDate = date('Y-m-d H:i:s');
$db = new db();


if (isset($_GET['id_'])) {
	$id_ = $_GET['id_'];
} else {
	$arr['status'] = 'ERROR';
	$arr['status_txt'] = 'Erro! id_ não fornecido!';
	echo json_encode($arr);
	exit(0);
}

$db->query('SELECT id_,cid,patologia,descricao,referencias FROM patologia WHERE id_ = :id  ');
$db->bind(':id', $id_);

$result = $db->resultset();

if ($result) {
	$i = 0;
	foreach ($result as $row) {
		$arr['data'] = array(
			'id_' => $row['id_'],
			'cid' => $row['cid'],
			'patologia' => $row['patologia'],
			'descricao' => $row['descricao'],
			'referencias' => $row['referencias'],
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