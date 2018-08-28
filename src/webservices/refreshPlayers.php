<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $code = $json["code"];

    $req = $PDO->prepare("SELECT player1,player2,player3 FROM Party WHERE code = :code");

    $req->execute(array(
            "code" => $code
            ));

    $data = $req->fetchAll();
    $players = $data[0][0];
    echo $players;
    return $players;
}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>