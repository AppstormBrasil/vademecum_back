
    <?php

include("../util.php");

$created_at = date("Y-m-d  H:i:s");

$checkfirst = checkAuth();
if($checkfirst == ""){
	$arr["status"] = "ERROR";
	$arr["status_txt"] = "Ops , Invalid Token ! If the problem persists, contact our technical support!" ;
	$arr["data"] = [];
	echo json_encode($arr);
	exit(0);
}
$checkfirst_ = get_object_vars($checkfirst);


if($checkfirst_["valid"] == 0){
	$arr["status"] = "ERROR";
	$arr["status_txt"] = "Ops , Invalid Token ! If the problem persists, contact our technical support!" ;
	echo json_encode($arr);
	exit(0);
} else {
	$user_type = $checkfirst_["user_type"];
}


$db = new db();
$i = 0;
$array_name = [];
    $array_email = [];
    $array_password = [];
    		

$db->query("SELECT name, email, password  FROM user");


$db->execute();
$result = $db->resultset();
if ($result) {
	foreach ($result as $row) {
        $name = $row["name"];
        $email = $row["email"];
        $password = $row["password"];
          
    
        if(!(in_array($row["name"], $array_name))){
            array_push($array_name, $row["name"]);
        }
                
        if(!(in_array($row["email"], $array_email))){
            array_push($array_email, $row["email"]);
        }
                
        if(!(in_array($row["password"], $array_password))){
            array_push($array_password, $row["password"]);
        }
                
		$arr["data"][] = array(
            
        "name" => $row["name"],
        
        "email" => $row["email"],
        
        "password" => $row["password"],
        
		);
		$i++;
	}
}
	


if($i > 0){

    $arr["array_name"] = $array_name;
        $arr["array_email"] = $array_email;
        $arr["array_password"] = $array_password;
        
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