<?php

require_once 'DB.php';

class Marca{

    private $id;
    private $nombre;

    public function __construct($marca = null){
        $this->nombre = $marca['nombre']  ??  null;
        $this->id = $marca['id']  ?? $this->setId();
    }

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

    public function setId($id = null){
        if(!$id&&$this->nombre){
            if(!$this->getByNombre($this->nombre)){
                $this->insert();
            }
            return $this->id = $this->getByNombre($this->nombre)->id;
        }
        $this->id = $id;
    }

    static function getById($id){
        $sql = "SELECT * FROM marcas WHERE id = $id";
        $stmt = DB::getStatement($sql);
		$stmt->execute();
		if ($stmt->rowCount() === 1) {
            $marca = new Marca($stmt->fetch(PDO::FETCH_ASSOC));
		    return $marca;
        }
		return null;  
    }

    static function getByNombre($nombre){
        $stmt = DB::getStatement('SELECT * FROM marcas WHERE nombre = :nombre LIMIT 1');
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt->rowCount() === 1) {
            $marca = new Marca($stmt->fetch(PDO::FETCH_ASSOC));
		    return $marca;
        }
		return null;  
    }

    static function getAll($where = null){
        $stmt = DB::getStatement("SELECT * FROM marcas $where");
		$stmt->execute();
        if ($stmt->rowCount() >= 1) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];  
    }

    public function update(){
        $sql = "UPDATE marcas SET
                nombre = '$this->nombre'       
                WHERE id = $this->id";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
    }

    public function delete(){
        $sql = "DELETE FROM marcas WHERE id = $this->id";
        $stmt = DB::getStatement($sql);
		$stmt->execute();
    }
    
    public function insert(){
        $sql = "INSERT INTO marcas
                (   
                    nombre
                )
                VALUES
                (
                    '$this->nombre'      
                )";
            $stmt = DB::getStatement($sql);
            $stmt->execute();
    }
}
