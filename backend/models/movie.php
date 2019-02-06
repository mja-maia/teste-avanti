<?php
class Movie{
 
    // database connection and table name
    private $conn;
    private $table_name = "movies";
 
    // object properties
    public $id;
    public $titulo;
    public $descricao;
    public $categoria;
    public $ator;
    public $diretor;
    public $imagem;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    public function read(){
      $query = "SELECT * FROM movies";

      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;
    }

  function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                titulo=:titulo, descricao=:descricao, categoria=:categoria, ator=:ator, diretor=:diretor, imagem=:imagem";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->titulo=htmlspecialchars(strip_tags($this->titulo));
    $this->descricao=htmlspecialchars(strip_tags($this->descricao));
    $this->categoria=htmlspecialchars(strip_tags($this->categoria));
    $this->ator=htmlspecialchars(strip_tags($this->ator));
    $this->diretor=htmlspecialchars(strip_tags($this->diretor));
    $this->imagem=htmlspecialchars(strip_tags($this->imagem));
 
    // bind values
    $stmt->bindParam(":titulo", $this->titulo);
    $stmt->bindParam(":descricao", $this->descricao);
    $stmt->bindParam(":categoria", $this->categoria);
    $stmt->bindParam(":ator", $this->ator);
    $stmt->bindParam(":diretor", $this->diretor);
    $stmt->bindParam(":imagem", $this->imagem);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
  }

  // update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                titulo=:titulo, descricao=:descricao, categoria=:categoria, ator=:ator, diretor=:diretor, imagem=:imagem
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->titulo=htmlspecialchars(strip_tags($this->titulo));
    $this->descricao=htmlspecialchars(strip_tags($this->descricao));
    $this->categoria=htmlspecialchars(strip_tags($this->categoria));
    $this->ator=htmlspecialchars(strip_tags($this->ator));
    $this->diretor=htmlspecialchars(strip_tags($this->diretor));
    $this->imagem=htmlspecialchars(strip_tags($this->imagem));
 
    // bind new values
    $stmt->bindParam(":titulo", $this->titulo);
    $stmt->bindParam(":descricao", $this->descricao);
    $stmt->bindParam(":categoria", $this->categoria);
    $stmt->bindParam(":ator", $this->ator);
    $stmt->bindParam(":diretor", $this->diretor);
    $stmt->bindParam(":imagem", $this->imagem);
    $stmt->bindParam(":id", $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

  function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
}