<?php

require "config.php";

try{
    $request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $game = $json["game"];

    $req = $PDO->prepare("SELECT score FROM player WHERE game = :game");

    $req->execute(array(
        "game" => $game
    ));

    $scores = $req->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($scores);
}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>