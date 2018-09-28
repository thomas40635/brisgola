<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
 	$json = json_decode($request_body, true);

    $game = $json["game"];

    $req = $PDO->prepare("UPDATE turn SET etat = 1 WHERE game = :game ORDER BY nbr DESC LIMIT 1");

	$req->execute(array(
        "game" => $game
    ));
}

catch(PDOException $e){
    echo 'Connexion impossible';
}

?>