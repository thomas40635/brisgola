<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
 	$json = json_decode($request_body, true);

    $game = $json["game"];
    $pseudo = $json["pseudo"];

    $req = $PDO->prepare("SELECT COUNT(*) FROM player WHERE game = :game");

    $req->execute(array(
        "game" => $game
    ));

    $count = $req->fetchColumn();
    echo $count;

    $req = $PDO->prepare("INSERT INTO player (game,pseudo,position) VALUES (:game,:pseudo,:position)");

	$req->execute(array(
        "game" => $game,
        "pseudo" => $pseudo,
        "position" => $count + 1
    ));
}

catch(PDOException $e){
    echo 'Connexion impossible';
}

?>