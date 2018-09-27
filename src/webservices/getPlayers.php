<?php

require "config.php";

try{
    $request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $game = $json["game"];

    $req = $PDO->prepare("SELECT * FROM player WHERE game = :game ORDER BY position");

    $req->execute(array(
        "game" => $game
    ));

    $players = $req->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($players));
}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>