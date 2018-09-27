<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
 	$json = json_decode($request_body, true);

    $game = $json["game"];

    $req = $PDO->prepare("SELECT SUM(vote) FROM player WHERE game = :game");

    $req->execute(array(
        "game" => $game
    ));
    $vote = $req->fetchColumn();
    echo($vote);
}

catch(PDOException $e){
    echo 'Connexion impossible';
}

?>