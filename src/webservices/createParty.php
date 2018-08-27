<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
	$code = json_decode($request_body);

    $req = $PDO->prepare("INSERT INTO Party (code) VALUES (:code)");

    $req->execute(array(
            "code" => $code
            ));

    $data = $req->fetchAll();
    if(count($data)>0){
        echo "OK";
	}
	else{
		echo "NOPE";
	}

}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>