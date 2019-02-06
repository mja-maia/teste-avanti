<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

include_once '../../config.php';
include_once '../../models/movie.php';

$database = new Database();
$db = $database->connect();

$movies = new Movie($db);

$result = $movies->read();
$num  = $result->rowCount();

if($num > 0 ){
  $movies_arr = array();
  $movies_arr['data'] = array();


  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $movies_item = array(
      'id' => $id,
      'titulo' => $titulo,
      'descricao' => $descricao,
      'categoria' => $categoria,
      'ator' => $ator,
      'diretor' => $diretor,
      'imagem' => $imagem
    );
    
    array_push($movies_arr['data'], $movies_item);
  }
  echo json_encode($movies_arr);
}else{
  echo json_encode(
    array('message' => 'Nenhum filme encontrado!')
  );
}