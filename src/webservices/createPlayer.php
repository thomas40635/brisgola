<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $code = $json["code"];
    $playerID = $json["playerID"];

    print_r("JSON : ".$json);

    $req = $PDO->prepare("SELECT player1,player2,player3 FROM Party WHERE code = :code");

    $req->execute(array(
            "code" => $code
            ));

    $data = $req->fetchAll();
    if(!$data[0]['player1']){
        $player = "player1";
    }
    else if(!$data[0]['player2']){
        $player = "player2";
    }
    else if(!$data[0]['player3']){
        $player = "player3";
    }

    $req = $PDO->prepare("UPDATE Party SET ".$player." = :playerID WHERE code = :code");
    $req->execute(array(
            "code" => $code,
            "playerID" => $playerID
            ));
    $data = $req->fetchAll();

}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>