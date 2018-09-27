<?php

require "config.php";

try{
    $request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $game = $json["game"];
    $pseudo = $json["pseudo"];

    $req = $PDO->prepare("SELECT position,pseudo FROM player WHERE game = :game AND pseudo != :pseudo");

    $req->execute(array(
        "game" => $game,
        "pseudo" => $pseudo
    ));

    $other = $req->fetchAll();
    print_r($other);exit;
    $req = $PDO->prepare("SELECT draw1,draw2 FROM turn WHERE game = :game");

    $req->execute(array(
        "game" => $game
    ));

    $draws = $req->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($draws);
}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>