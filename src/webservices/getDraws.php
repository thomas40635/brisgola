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

    $other = $req->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode($other));
}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>