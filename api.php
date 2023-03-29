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


<<<<<<< HEAD
<<<<<<< HEAD
=======
$comments_Controller = new comments_Controller;

if(isset($request[0])&&($request[0]=="comments")){
    switch($method){

        case 'PUT':
            if(isset($request[1])){
                $commentID = $request[1];
                $comments_Controller->loadOneComment($Db,$commentID);
                $input = json_decode(file_get_contents("php://input"),true);

                if(isset($input)){
                    //$comment->title=$input["title"];
                    $comment->content=$input["content"];
                    $comment->refreshComments($Db);
                }else{
                    $comment=array("info"=>"No comment content.");
                }
            }else{
                $comment=array("info"=>"No comment content.");
            }
            break;


        case 'POST':
            parse_str(file_get_contents("php://input"),$input);
            if(isset($input)){
                $date = date('Y-m-d H:i:s');
                $comment=new Comment(0,$input["user_id"],$input["content"],$input["nickname"],$input["date"],$input["email"],$input["adid"],$input["ip"]);
                $comment->addComment($Db);
            }else{
                $comment=array("info"=>"No comment content.");
            }
            break;


        case 'GET':
                if(isset($request[1]) && isset($request[2]) && $request[1]=="loadOneComment"){
                    $commentID = $request[2];
                    $comments_Controller->loadOneComment($Db, $commentID);
                }else if(isset($request[1])&&isset($request[2])&&$request[1]=='loadAllComments'){
                    $comments_Controller->loadAllComments($Db,$request[2]);
                }else if(isset($request[1])&&$request[1]=='loadLastFiveComments'){
                    $comments_Controller->loadLastFiveComments($Db);
                }
            break;


        case 'DELETE':
            if(isset($request[1]) && isset($request[2])){
                $commentID = $request[2];
                $comments_Controller->deleteComment($Db,$commentID);
                $comment=array("info"=>"Comment deleted.");
            }else{
                $comment=array("info"=>"No comment content.");
            }
            break;

    }
    if(isset($request[1]) && isset($request[2]) && $request[1]=="JSNOP"){
        $calBack = $request[2];
        $comment = json_encode($comment);
        echo "$calBack($comment);";
    }else{
        header("Content-Type: applicaton/json");
        header("Access-Control-Allow-Origin: *");
        echo json_encode($comment);
    }
}

if(isset($request[0]) && ($request[0]=="proxy")){
    $arrrayContextsOptions=array("ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false,));
    echo(file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=46.5475311,15.6357408&radius=500&type=restaurant&keyword=fast&key=AIzaSyCVEC1ERr1a9XG8Etp3e26EHuYc3ZxfFOc",false,stream_context_create($arrrayContextsOptions)));
}

?>
>>>>>>> 90c4629 (Pozabo commit)
=======
>>>>>>> 120217e (Problem z mergom)
