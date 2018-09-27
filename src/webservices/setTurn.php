<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
 	$json = json_decode($request_body, true);

    $game = $json["game"];
    $nbr = $json["nbr"];

    $req = $PDO->prepare("INSERT INTO turn (game,nbr) VALUES (:game,:nbr)");

	$req->execute(array(
        "game" => $game,
        "nbr" => $nbr
    ));

    $req = $PDO->prepare("SELECT * FROM turn WHERE game = :game ORDER BY nbr DESC LIMIT 1");

    $req->execute(array(
        "game" => $game
    ));

    $turn = $req->fetch(PDO::FETCH_ASSOC);
    echo(json_encode($turn));
}

catch(PDOException $e){
    echo 'Connexion impossible';
}

?>