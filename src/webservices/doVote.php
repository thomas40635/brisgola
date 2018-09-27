<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
 	$json = json_decode($request_body, true);

    $game = $json["game"];
    $pseudo = $json["pseudo"];

    $req = $PDO->prepare("UPDATE player SET score = score + 1 WHERE game = :game AND pseudo = :pseudo");

	$req->execute(array(
        "game" => $game,
        "pseudo" => $pseudo
    ));
}

catch(PDOException $e){
    echo 'Connexion impossible';
}

?>