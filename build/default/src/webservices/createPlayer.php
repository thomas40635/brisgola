<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $code = $json["code"];
    $playerID = $json["playerID"];

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

    //$req = $PDO->prepare("UPDATE party(:player) SET (:playerID) WHERE code = :code");
    $req = $PDO->prepare("UPDATE Party SET ".$player." = :playerID WHERE code = :code");

    $req->execute(array(
            "code" => $code,
            "playerID" => $playerID
            ));
    $data = $req->fetchAll();
    echo $req->queryString;
}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>