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

    $req = $PDO->prepare("SELECT draw".$other[0]['position'].",draw".$other[1]['position']." FROM turn WHERE game = :game ORDER BY nbr DESC LIMIT 1");

    $req->execute(array(
        "game" => $game
    ));

    $draws = $req->fetchAll(PDO::FETCH_ASSOC);
    echo $draws;exit;
    // $other[0]["draw"] = $draws[0]
    print_r(json_encode($other));
}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>