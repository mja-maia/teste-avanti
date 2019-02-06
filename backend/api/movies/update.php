<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../../config.php'; 
include_once '../../models/movie.php';
 
// get database connection
$database = new Database();
$db = $database->connect();
 
// prepare product object
$movie = new Movie($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
// set ID property of product to be edited
$movie->id = $data->id;
 
$movie->titulo = $data->titulo;
$movie->descricao = $data->descricao;
$movie->categoria = $data->categoria;
$movie->diretor = $data->diretor;
$movie->imagem = $data->imagem;
$movie->ator = $data->ator;
 
// update the product
if($movie->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Product was updated."));
}
 
// if unable to update the product, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update product."));
}
?>