<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
 	$json = json_decode($request_body, true);

    $game = $json["game"];

    $req = $PDO->query("SELECT label FROM word ORDER BY RAND() LIMIT 1");
    $word = $req->fetchColumn();

    $req = $PDO->prepare("UPDATE turn SET word = :word WHERE game = :game ORDER BY nbr DESC LIMIT 1");

	$req->execute(array(
        "word" => $word,
        "game" => $game
    ));

    echo(json_encode($word));
}

catch(PDOException $e){
    echo 'Connexion impossible';
}

?>