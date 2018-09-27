<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
 	$json = json_decode($request_body, true);

    $code = $json["code"];

    $req = $PDO->prepare("INSERT INTO game (code) VALUES (:code)");

	$req->execute(array(
        "code" => $code
    ));
}

catch(PDOException $e){
    echo 'Connexion impossible';
}

?>