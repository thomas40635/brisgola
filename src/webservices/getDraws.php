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
    $other1 = "draw".$other[0]['position'];
    $other2 = "draw".$other[1]['position'];

    $req = $PDO->prepare("SELECT ".$other1.",".$other2." FROM turn WHERE game = :game ORDER BY nbr DESC LIMIT 1");

    $req->execute(array(
        "game" => $game
    ));

    $draws = $req->fetch(PDO::FETCH_ASSOC);
    // $other[0]["draw"] = $draws[0]
    print_r(json_encode($req));
}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>