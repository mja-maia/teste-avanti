<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../../config.php'; 
include_once '../../models/movie.php';

 
$database = new Database();
$db = $database->connect();
 
$movie = new Movie($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->titulo) &&
    !empty($data->descricao) &&
    !empty($data->categoria) &&
    !empty($data->diretor) &&
    !empty($data->imagem) &&
    !empty($data->ator)
){
 
    $movie->titulo = $data->titulo;
    $movie->descricao = $data->descricao;
    $movie->categoria = $data->categoria;
    $movie->diretor = $data->diretor;
    $movie->imagem = $data->imagem;
    $movie->ator = $data->ator;
 
    // create the product
    if($movie->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Filme criado com sucesso!"));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Erro ao criar um filme"));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Erro ao cadastrar filme, dados incompletos"));
}
?>