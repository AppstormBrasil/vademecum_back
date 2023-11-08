<?php

include('../util.php');
$currentDate = date('Y-m-d H:i:s');
$db = new db();

$checkfirst = checkAuth();
if ($checkfirst == '') {
    $arr['status'] = 'ERROR';
    $arr['status_txt'] = 'Ops, token invalido! Tente novamente. Caso isso ocorra novamente, entre em contato com o suporte!';
    $arr['data'] = [];
    echo json_encode($arr);
    exit(0);
}
$checkfirst_ = get_object_vars($checkfirst);

if ($checkfirst_['valid'] == 0) {
    $arr['status'] = 'ERROR';
    $arr['status_txt'] = 'Ops, token invalido! Tente novamente. Caso isso ocorra novamente, entre em contato com o suporte!';
    $arr['data'] = [];
    echo json_encode($arr);
    exit(0);
} else {
    $user_type = $checkfirst_['user_type'];
}

if (isset($_POST['cid'])) {
    $cid = $_POST['cid'];
} else {
    $arr['status'] = 'ERROR';
    $arr['status_txt'] = 'Erro! cid não fornecido!';
    echo json_encode($arr);
    exit(0);
}

if (isset($_POST['patologia'])) {
    $patologia = $_POST['patologia'];
} else {
    $arr['status'] = 'ERROR';
    $arr['status_txt'] = 'Erro! patologia não fornecido!';
    echo json_encode($arr);
    exit(0);
}

if (isset($_POST['descricao'])) {
    $descricao = $_POST['descricao'];
} else {
    $arr['status'] = 'ERROR';
    $arr['status_txt'] = 'Erro! descricao não fornecido!';
    echo json_encode($arr);
    exit(0);
}

if (isset($_POST['referencias'])) {
    $referencias = $_POST['referencias'];
} else {
    $arr['status'] = 'ERROR';
    $arr['status_txt'] = 'Erro! referencias não fornecido!';
    echo json_encode($arr);
    exit(0);
}

$bytes = random_bytes(6);
$id_ = bin2hex($bytes);

$db->query('INSERT INTO patologia (id_,cid,patologia,descricao,referencias,createdAt,updatedAt,status,user_type) VALUES (:id_,:cid,:patologia,:descricao,:referencias,:createdAt,:updatedAt, :status, :usertype);');
$db->bind(':id_', $id_);
$db->bind(':cid', $cid);
$db->bind(':patologia', $patologia);
$db->bind(':descricao', $descricao);
$db->bind(':referencias', $referencias);
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