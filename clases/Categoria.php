<?php

require_once 'DB.php';

class Categoria {

    private $id;
    private $nombre;
    private $foto;
    private $relevancia;

    public function __get($property){
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value){
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    static function getById($id){
        $sql = "SELECT * FROM categorias WHERE id = $id";
        $stmt = DB::getStatement($sql);
		$stmt->execute();
		if ($stmt->rowCount() === 1) {
		    return $stmt->fetchObject('Categoria');
        }
		return null;    
    }

    static function getAll(){
        $stmt = DB::getStatement('SELECT * FROM categorias ORDER BY relevancia DESC');
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Categoria');
        }
        return [];
    }

    public function update(){
        $sql = "UPDATE categorias SET 
                relevancia = $this->relevancia+1
                WHERE id = $this->id";
        $stmt = DB::getStatement($sql);
		$stmt->execute();
    }

}