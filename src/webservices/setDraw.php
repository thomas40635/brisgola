<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
 	$json = json_decode($request_body, true);

    $game = $json["game"];
    $draw = $json["draw"];
    $pseudo = $json["pseudo"];

    $req = $PDO->prepare("SELECT position FROM player WHERE game = :game AND pseudo = :pseudo");

    $req->execute(array(
        "game" => $game,
        "pseudo" => $pseudo
    ));

    $numPlayer = $req->fetchColumn();

    $req = $PDO->prepare("UPDATE turn SET draw".$numPlayer." = :draw WHERE game = :game");

	$req->execute(array(
        "draw" => $draw,
        "game" => $game
    ));
}

catch(PDOException $e){
    echo 'Connexion impossible';
}

?>