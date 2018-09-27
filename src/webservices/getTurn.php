<?php

require "config.php";

try{
    $request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $game = $json["game"];

    $req = $PDO->prepare("SELECT * FROM turn WHERE game = :game");

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