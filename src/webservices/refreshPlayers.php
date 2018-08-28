<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $code = $json["code"];
    $playerID = $json["playerID"];

    $req = $PDO->prepare("SELECT player1,player2,player3 FROM Party WHERE code = :code");

    $req->execute(array(
            "code" => $code
            ));

    $data = $req->fetchAll();
    $players = [$data['player1'],$data['player2'],$data['player3']];
    return $players;

}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>