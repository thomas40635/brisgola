<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $code = $json["code"];
    $pseudo = $json["playerID"];

    $req = $PDO->prepare("SELECT * FROM Player WHERE code = :code");

    $req->execute(array(
            "code" => $code
            ));

    $data = $req->fetchAll();
    if(count($data) == 0){
        $order = 1;
    }
    else if(count($data) == 1){
        $order = 2;
    }
    else if(count($data) == 2){
        $order = 3;
    }

    $req = $PDO->prepare("INSERT INTO Player (code,pseudo,order) VALUES (:code,:pseudo,:order,:score)");
    $req->execute(array(
            "code" => $code,
            "pseudo" => $pseudo,
            "order" => $order,
            "score" => 0
            ));
    $data = $req->fetchAll();

}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>