<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
    $code = json_decode($request_body)[0];
	$playerID = json_decode($request_body)[1];

    $req = $PDO->prepare("SELECT player1, player2, player3 FROM party WHERE code = :code");

    $req->execute(array(
            "code" => $code
            ));

    $data = $req->fetchAll();

    if(!$data['player1']){
        $player = "player1";
    }
    else if(!$data['player2']){
        $player = "player2";
    }
    else if(!$data['player3']){
        $player = "player3";
    }

    $req = $PDO->prepare("UPDATE party SET :player = :playerID WHERE code = :code");

    $req->execute(array(
            "code" => $code,
            "player" => $player,
            "playerID" => $playerID
            ));

    $data = $req->fetchAll();

}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>