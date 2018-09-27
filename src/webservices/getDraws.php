<?php

require "config.php";

try{
    $request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $game = $json["game"];

    $req = $PDO->prepare("SELECT draw1,draw2,draw3 FROM turn WHERE game = :game");

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