<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
 	$json = json_decode($request_body, true);

    $game = $json["game"];
    $pseudo = $json["pseudo"];

    $req = $PDO->prepare("UPDATE player SET vote = 0 WHERE game = :game AND pseudo = :pseudo LIMIT 1");

	$req->execute(array(
        "game" => $game,
        "pseudo" => $pseudo
    ));
}

catch(PDOException $e){
    echo 'Connexion impossible';
}

?>