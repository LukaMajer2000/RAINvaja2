<?php

require_once "connection.php"; 
require_once "comment.php"; 
require_once "controllers/comments_Controller.php"; 

session_start();

$comments_controller = new comments_Controller;

// nastavimo glave odgovora tako, da brskalniku sporočimo, da mu vračamo json
header('Content-Type: application/json');
// omgočimo zahtevo iz različnih domen
header("Access-Control-Allow-Origin: *");
// Kot odgovor iz API-ja izpišemo JSON string s pomočjo funkcije json_encode

// preberemo HTTP metodo iz zahteve
$method = $_SERVER['REQUEST_METHOD'];

// Razberemo parametre iz URL - razbijemo URL po '/'
// tako dobimo iz zahteve api/first/second/third => $request = array("first", "second", "third")
if(isset($_SERVER['PATH_INFO']))
	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
else
	$request="";

if(!isset($request[0]) || $request[0] != "comments"){
    echo json_encode((object)["status"=>"404", "message"=>"Not found"]);
    die();
}
// Odvisno od metode pokličemo ustrezen controller action
switch($method){
    case "GET":
        // Če je v zahtevi nastavljen :id, kličemo akcijo show (en oglas), sicer pa index (vsi oglasi)
        if(isset($request[1])){
            $comments_controller->show($request[1]);
        } else {
            $adid = $_GET['id'];
            $comments_controller->index($adid);
        }
        break;
    case "POST": 
        $adid = $_GET['id'];
        $comments_controller->store($adid);
        break;
    case "DELETE":
        if(!isset($request[1])){
            // Če ni podan :id v zahtevi, izpišemo napako
            echo json_encode((object)["status"=>"500", "message"=>"Invalid parameters"]);
            die();
        }
        $comments_controller->delete($request[1]);
        break;
    default: 
        break;
}


