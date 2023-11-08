<?php
date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL);
ini_set('display_errors', 1);

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

include('connection.php');

//include "phpqrcode/qrlib.php";
$current_date = date('Y-m-d');
$current_date_time = date('Y-m-d  H:i:s');

define("prod_path", "http://localhost:8012/vadecum_back/");

//build the headers
$headers = ['name' => 'RS256', 'typ' => 'JWT'];
$headers_encoded = base64url_encode(json_encode($headers));

//build the payload


//build the signature
$key = "MIICWwIBAAKBgHjWzozHkWVvsWRQmIVhfzxFE5+/A0hdgZdy/qY70Dtmd6mPZDYn
4FNetIeT9G2YFuyvmR4rSO0ixaYmqq59tEwrgum1jfh0dMLJeINV0MIr6kI8r/We
J4Vqh8PDCLNThz4UlDiUmhol7ZxRjDQho4dklIBp2JXR809yF1lrJCgbAgMBAAEC
gYBA5EoDe+Busq52inl9lz/2o7nIHZGruNsw84Ygyxol6/7yxZgxJPTokIEuFZw7
hmM5M4tskh4ViojNkxIxpju9tE2eMzox4DTIuXwEFqPtHP/jovXTnrI6K4uLtRvL
pFpv1SYnck/Jn4lmP8OjApLbpwNbJYgVOw+BRa/49gs+IQJBAM/TFkddZhn21p7/
jjeylBPvkTbmxo4ip8Zk46TcOS6rjRwF66DHHrLga9uIpPptLLIXgBtiUNU6WRBQ
oMJ8RCMCQQCU2b/XvyXhlEajNweEGUsyhZ6guavovZ5Foon9RRnv+dGXJJsDZWDp
YIHCzHme5i3RWgbcdJdGy5TUUVCVMG+pAkEAyJ0McYFQURn83Wj1wQBKfuAQPn4R
Bx2e9R1ovjiznkCNq5JvfTkZgjSvCTFjiDYhIh0bVdPXEa4MUXpzZKoOHwJAJsk6
oQgw4b/WTC9JqRVCL+77b5wR/Hp0ZGa/GBzKbmqlP4INVmwzPXylM1I+mrYV2Ehi
I03KIWto444wtj9ByQJAKKEAES4Wkc9cLs2gP34tudjYE+ot6cgWr6M/15ErhHuT
RfcL5U69IE1g5NHRFmY2lzU3eFEo3G8n3GI6g3pHcg==";

$key2 = "MIGeMA0GCSqGSIb3DQEBAQUAA4GMADCBiAKBgHjWzozHkWVvsWRQmIVhfzxFE5+/
A0hdgZdy/qY70Dtmd6mPZDYn4FNetIeT9G2YFuyvmR4rSO0ixaYmqq59tEwrgum1
jfh0dMLJeINV0MIr6kI8r/WeJ4Vqh8PDCLNThz4UlDiUmhol7ZxRjDQho4dklIBp
2JXR809yF1lrJCgbAgMBAAE=";



function hourMinute2Minutes($strHourMinute)
{
  $from = date('Y-m-d 00:00:00');
  $to = date('Y-m-d ' . $strHourMinute);
  $diff = strtotime($to) - strtotime($from);
  $minutes = $diff / 60;
  return (int) $minutes;
}

function checkAuth()
{

  $secret = '603cd7254c7d4004af2d0f172ca6dcfb87b349568040374b58130adb4942a9b2';
  $key = "MIICWwIBAAKBgHjWzozHkWVvsWRQmIVhfzxFE5+/A0hdgZdy/qY70Dtmd6mPZDYn
4FNetIeT9G2YFuyvmR4rSO0ixaYmqq59tEwrgum1jfh0dMLJeINV0MIr6kI8r/We
J4Vqh8PDCLNThz4UlDiUmhol7ZxRjDQho4dklIBp2JXR809yF1lrJCgbAgMBAAEC
gYBA5EoDe+Busq52inl9lz/2o7nIHZGruNsw84Ygyxol6/7yxZgxJPTokIEuFZw7
hmM5M4tskh4ViojNkxIxpju9tE2eMzox4DTIuXwEFqPtHP/jovXTnrI6K4uLtRvL
pFpv1SYnck/Jn4lmP8OjApLbpwNbJYgVOw+BRa/49gs+IQJBAM/TFkddZhn21p7/
jjeylBPvkTbmxo4ip8Zk46TcOS6rjRwF66DHHrLga9uIpPptLLIXgBtiUNU6WRBQ
oMJ8RCMCQQCU2b/XvyXhlEajNweEGUsyhZ6guavovZ5Foon9RRnv+dGXJJsDZWDp
YIHCzHme5i3RWgbcdJdGy5TUUVCVMG+pAkEAyJ0McYFQURn83Wj1wQBKfuAQPn4R
Bx2e9R1ovjiznkCNq5JvfTkZgjSvCTFjiDYhIh0bVdPXEa4MUXpzZKoOHwJAJsk6
oQgw4b/WTC9JqRVCL+77b5wR/Hp0ZGa/GBzKbmqlP4INVmwzPXylM1I+mrYV2Ehi
I03KIWto444wtj9ByQJAKKEAES4Wkc9cLs2gP34tudjYE+ot6cgWr6M/15ErhHuT
RfcL5U69IE1g5NHRFmY2lzU3eFEo3G8n3GI6g3pHcg==";

  $http_header = apache_request_headers();

  if (isset($http_header['Authorization']) && $http_header['Authorization'] != null) {
    $bearer = explode(' ', $http_header['Authorization']);
    $token = explode('.', $bearer[1]);

    $header = base64_decode($token[0]);
    $payload = base64_decode($token[1]);
    $details = json_decode($payload);
    $expiration = $details->exp;
    $user_type = $details->user_type;
    //$user_franquia = $details->user_franquia;
    //$user_fornecedor = $details->user_fornecedor;
    //$user_permission = $details->user_permission;
    $user_id = $details->userid;
    $date_now = new Datetime("now");
    $now = $date_now->format('U');


    if ($expiration > $now) {
    } else {
      $object = new stdClass();
      $object->valid = 1;
      $object->message = 'Token has expired';
      $object->user_type = $user_type;
      //$object->user_franquia = $user_franquia;
      //$object->user_fornecedor = $user_fornecedor;
      //$object->user_permission = $user_permission;
      $object->user_id = $user_id;
      return $object;
    }

    $header = $token[0];
    $payload = $token[1];
    $sign = $token[2];
    //Conferir Assinatura
    $valid = hash_hmac('sha256', $header . "." . $payload, $key, true);
    $valid = base64url_encode($valid);

    if ($sign === $valid) {
      $object = new stdClass();
      $object->valid = 1;
      $object->message = 'Valid Token';
      $object->user_type = $user_type;
      //$object->user_franquia = $user_franquia;
      //$object->user_fornecedor = $user_fornecedor;
      //$object->user_permission = $user_permission;
      $object->user_id = $user_id;
      return $object;
    } else {
      $object = new stdClass();
      $object->valid = 0;
      $object->message = 'Invalid Token';
      return $object;
    }
  }

  //return false;

}

function removeDirectory($path)
{
  $files = glob($path . '/*');
  foreach ($files as $file) {
    is_dir($file) ? removeDirectory($file) : unlink($file);
  }
  rmdir($path);
  return;
}

function getDepartament($dep_name)
{
  $id_dep = '';
  $db = new db();
  $db->query("SELECT d.id_ 
  FROM departments d 
  WHERE d.title = :title ");
  $db->bind(':title', $dep_name);
  $db->execute();
  $result = $db->single();
  $id_ = $result['id_'];

  if ($id_ <> '') {
    $id_dep = $id_;
  }

  return $id_dep;
}
function save_ticket_log($ticket_id, $action, $description, $id_user)
{

  $db = new db();
  $bytes = random_bytes(8);
  $id_ = bin2hex($bytes);
  $create_at = date('Y-m-d  H:i:s');

  $db->query("INSERT INTO ticket_log (id_, ticket_id, action, description, id_user, createdAt) 
  VALUES (:id_, :ticket_id, :action, :description, :id_user, :createdAt )");
  $db->bind(':id_', $id_);
  $db->bind(':ticket_id', $ticket_id);
  $db->bind(':action', $action);
  $db->bind(':description', $description);
  $db->bind(':id_user', $id_user);
  $db->bind(':createdAt', $create_at);
  $db->execute();


}

function save_mant_log($mant_id, $action, $description, $id_user)
{
  $db = new db();
  $bytes = random_bytes(8);
  $id_ = bin2hex($bytes);
  $create_at = date('Y-m-d  H:i:s');

  $db->query("INSERT INTO maintenance_log (id_, mant_id, action, description, id_user, createdAt) 
  VALUES (:id_, :mant_id, :action, :description, :id_user, :createdAt )");
  $db->bind(':id_', $id_);
  $db->bind(':mant_id', $mant_id);
  $db->bind(':action', $action);
  $db->bind(':description', $description);
  $db->bind(':id_user', $id_user);
  $db->bind(':createdAt', $create_at);
  $db->execute();
}

function base64url_encode($data)
{
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64UrlEncode($data)
{
  // First of all you should encode $data to Base64 string
  $b64 = base64_encode($data);

  // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
  if ($b64 === false) {
    return false;
  }

  // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
  $url = strtr($b64, '+/', '-_');

  // Remove padding character from the end of line and return the Base64URL result
  return rtrim($url, '=');
}

function get_client_ip()
{
  $ipaddress = '';
  if (getenv('HTTP_CLIENT_IP'))
    $ipaddress = getenv('HTTP_CLIENT_IP');
  else if (getenv('HTTP_X_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  else if (getenv('HTTP_X_FORWARDED'))
    $ipaddress = getenv('HTTP_X_FORWARDED');
  else if (getenv('HTTP_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
  else if (getenv('HTTP_FORWARDED'))
    $ipaddress = getenv('HTTP_FORWARDED');
  else if (getenv('REMOTE_ADDR'))
    $ipaddress = getenv('REMOTE_ADDR');
  else
    $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

function get_nome_mes($mes_dummy)
{
  switch ($mes_dummy) {
    case "01":
      $mes = "Jan";
      break;
    case "02":
      $mes = "Fev";
      break;
    case "03":
      $mes = "Mar";
      break;
    case "04":
      $mes = "Abr";
      break;
    case "05":
      $mes = "Mai";
      break;
    case "06":
      $mes = "Jun";
      break;
    case "07":
      $mes = "Jul";
      break;
    case "08":
      $mes = "Ago";
      break;
    case "09":
      $mes = "Set";
      break;
    case "10":
      $mes = "Out";
      break;
    case "11":
      $mes = "Nov";
      break;
    case "12":
      $mes = "Dez";
      break;
  }
  return $mes;

}

function get_mes_string($date)
{
  $dia_semana = strftime('%A', strtotime($date));
  $mes = strftime('%B', strtotime($date));
  $dia = strftime('%d', strtotime($date));
  return $dia . ' de ' . ucwords($mes);
}

function get_dia_semana_string($date)
{
  $dia_semana = strftime('%A', strtotime($date));
  return ucwords($dia_semana);
}

function br_to_usa_date_time2($date)
{
  $date = explode(" ", $date);

  $only_date = explode("/", $date[0]);

  $ano = $only_date[2];
  $mes = $only_date[1];
  $dia = $only_date[0];
  $br_date = $ano . '-' . $mes . '-' . $dia;
  $br_date = $br_date . ' ' . $date[1] . ':00';
  return $br_date;
}


function left($str, $length)
{
  return substr($str, 0, $length);
}

function right($str, $length)
{
  return substr($str, -$length);
}



function br_to_usa($date)
{
  $date = explode("/", $date);
  return substr($date[2], 0, 4) . '-' . $date[1] . '-' . $date[0] . ' ' . substr($date[2], 5, 9);
}

function usa_to_br_date_time($date)
{
  $date = explode(" ", $date);
  $only_date = explode("-", $date[0]);
  $br_date = $only_date[2] . '/' . $only_date[1] . '/' . $only_date[0];
  return $br_date . ' ' . $date[1];

  //return substr($date[2],0,4).'/'.$date[1].'/'.$date[0].' '.substr($date[2],5,9);

}

function usa_to_br($date)
{
  $date = explode("-", $date);
  return substr($date[2], 0, 4) . '/' . $date[1] . '/' . $date[0] . ' ' . substr($date[2], 5, 9);

}

function br_to_usa_month($date)
{
  $date = explode("/", $date);
  return $date[2] . '-' . $date[1] . '-' . $date[0];
}


function get_only_date($date)
{
  $date = explode("-", $date);
  return substr($date[2], 0, 2);
}

function get_day_month($date)
{
  $date = explode("-", $date);
  return substr($date[2], 0, 2) . '/' . substr($date[1], 0, 2);
}

function get_only_year($date)
{
  $date = explode("-", $date);
  return substr($date[1], 0, 2);

}

function br_month($date)
{
  $date = explode("-", $date);
  return substr($date[2], 0, 2) . '-' . $date[1] . '-' . $date[0];
}

function br_month2($date)
{
  $date = explode("/", $date);
  return substr($date[2], 0, 2) . '/' . $date[1] . '/' . $date[0];

}

function usa_month($date)
{
  $date = explode("/", $date);

  $string = trim($date[2] . '-' . $date[1] . '-' . $date[0]);
  return str_replace(' ', '', $string);

}

function usa_month_visitor($date)
{
  $date = explode("-", $date);
  $string = trim($date[2] . '-' . $date[1] . '-' . $date[0]);
  return $string;

}

function br_month3($date)
{
  $date = explode("-", $date);
  return substr($date[2], 0, 2) . '/' . $date[1] . '/' . $date[0];
}

function minutes($time)
{
  $time = explode(':', $time);
  return ($time[0] * 60) + ($time[1]) + ($time[2] / 60);
}

function get_only_day_br($date)
{
  $date = explode("-", $date);
  return substr($date[0], 0, 2);
}

function get_only_time($date)
{
  $date = explode(" ", $date);
  return $date[1];
}

function Valor($valor)
{
  $verificaPonto = ".";
  if (strpos("[" . $valor . "]", "$verificaPonto")):
    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);
  else:
    $valor = str_replace(',', '.', $valor);
  endif;

  return $valor;
}

function h2m($hours)
{
  $t = explode(".", $hours);
  $h = $t[0];
  if (isset($t[1])) {
    $m = $t[1];
  } else {
    $m = "00";
  }
  $mm = ($h * 60);
  return $mm;
}

function gerarCod()
{
  //$all = "ABCDEFGHIJKLMNOPQRSTUVYWZ0123456789";
  $all = "abcdefghijklimnopqrstuvxz0123456789";
  $key = "";
  for ($i = 0; $i < 20; $i++) {
    $key .= $all[rand(0, 34)];
  }
  return $key;
}

function get_nome_mes_completo($mes_dummy)
{
  switch ($mes_dummy) {
    case "01":
      $mes_dummy = "Janeiro";
      break;
    case "02":
      $mes_dummy = "Fevereiro";
      break;
    case "03":
      $mes_dummy = "Março";
      break;
    case "04":
      $mes_dummy = "Abril";
      break;
    case "05":
      $mes_dummy = "Maio";
      break;
    case "06":
      $mes_dummy = "Junho";
      break;
    case "07":
      $mes_dummy = "Julho";
      break;
    case "08":
      $mes_dummy = "Agosto";
      break;
    case "09":
      $mes_dummy = "Setembro";
      break;
    case "10":
      $mes_dummy = "Outubro";
      break;
    case "11":
      $mes_dummy = "Novembro";
      break;
    case "12":
      $mes_dummy = "Dezembro";
      break;
  }
  return $mes_dummy;

}

function obterUltimosSeteDias() {
  $dataAtual = new DateTime();  // Obtém a data atual
  $intervalo1 = new DateInterval('P1D');  // Intervalo de 1 dia
  $intervalo7 = new DateInterval('P7D');  // Intervalo de 7 dia

  $dataAtual = $dataAtual->sub($intervalo7);
  
  $ultimosSeteDias = array();

  for ($i = 0; $i < 7; $i++) {
      $data = $dataAtual->add($intervalo1)->format('d/m/Y');
      $ultimosSeteDias[] = $data;
  }

  return $ultimosSeteDias;
}
?>