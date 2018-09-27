<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
 	$json = json_decode($request_body, true);

    $game = $json["game"];

    $req = $PDO->prepare("SELECT etat FROM turn WHERE game = :game ORDER BY nbr DESC LIMIT 1");

    $req->execute(array(
        "game" => $game
    ));
    $etat = $req->fetchColumn();
    echo($etat);
}

catch(PDOException $e){
    echo 'Connexion impossible';
}

?>