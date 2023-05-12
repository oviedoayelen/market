<?php

require_once 'DB.php';

class Direccion{
    
    private $id;
    private $id_provincia;
    private $id_localidad;
    private $provincia;
    private $localidad;
    private $calle;
    private $altura;
    private $telefono;
    private $calle1;
    private $calle2;
    private $observaciones;
    private $codigo_postal;
    private $id_usuario;
    private $nombre;
    private $apellido;

    public function __construct($direccion = null){
        $this->id = $direccion['id'] ?? null;
        $this->id_provincia = $direccion['id_provincia'] ?? null;
        $this->id_localidad = $direccion['id_localidad'] ?? null;
        $this->provincia = $direccion['provincia'] ?? null;
        $this->localidad = $direccion['localidad'] ?? null;
        $this->calle = $direccion['calle'] ?? null;
        $this->altura = $direccion['altura'] ?? null;
        $this->telefono = $direccion['telefono'] ?? null;
        $this->calle1 = $direccion['calle1'] ?? null;
        $this->calle2 = $direccion['calle2'] ?? null;
        $this->observaciones = $direccion['observaciones'] ?? null;
        $this->codigo_postal = $direccion['codigo_postal'] ?? null;
        $this->id_usuario = $direccion['id_usuario'] ?? null;
        $this->nombre = $direccion['nombre'] ?? null;
        $this->apellido = $direccion['apellido'] ?? null;
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
    
    static function getById($id){
        $stmt = DB::getStatement("SELECT d.id, d.id_provincia, d.id_localidad, d.calle, d.altura, d.codigo_postal, d.telefono, d.calle1, d.calle2, d.nombre, d.apellido, d.id_usuario, d.observaciones, p.nombre as 'provincia', l.nombre as 'localidad' FROM direcciones d JOIN provincias p ON d.id_provincia = p.id JOIN localidades l ON d.id_localidad = l.id WHERE d.id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt->rowCount() === 1) {
            $direccion = new Direccion($stmt->fetch(PDO::FETCH_ASSOC));
		    return $direccion;
        }
		return null;
    }

    static function getAll($where = null){
        $sql = "SELECT d.id, d.id_provincia, d.id_localidad, d.calle, d.altura, d.codigo_postal, d.telefono, d.calle1, d.calle2, d.nombre, d.apellido, d.id_usuario, d.observaciones, p.nombre as 'provincia', l.nombre as 'localidad' FROM direcciones d JOIN provincias p ON d.id_provincia = p.id JOIN localidades l ON d.id_localidad = l.id $where";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $direccion){
                $direcciones[] = new Direccion($direccion);
            }
            return $direcciones;
        }
        return [];
    }

    public function update(){
        $sql = "UPDATE direcciones SET
                id_provincia = '$this->id_provincia',
                id_localidad = '$this->id_localidad',
                calle = '$this->calle',
                altura = $this->altura,  
                telefono = $this->telefono,        
                calle1 = '$this->calle1',     
                calle2 = '$this->calle2',     
                observaciones = '$this->observaciones',
                codigo_postal = $this->codigo_postal,
                nombre = '$this->nombre',
                apellido = '$this->apellido',
                id_usuario = $this->id_usuario     
                WHERE id = '$this->id'";
        $stmt = DB::getStatement($sql);
		$stmt->execute();
    }

    public function delete(){
        $sql = "UPDATE direcciones SET
                id_usuario = null     
                WHERE id = '$this->id'";
        $stmt = DB::getStatement($sql);
		$stmt->execute();
    }

    public function insert(){
        $sql = "INSERT INTO direcciones
                (
                    id,
                    id_provincia,
                    id_localidad,
                    calle,
                    altura,
                    telefono,
                    calle1,
                    calle2,
                    observaciones,
                    codigo_postal,
                    id_usuario,
                    nombre,
                    apellido

                )
                VALUES
                (
                    '$this->id',
                   '$this->id_provincia',
                   '$this->id_localidad',
                    '$this->calle',
                    $this->altura,  
                    $this->telefono,        
                    '$this->calle1',     
                    '$this->calle2',     
                    '$this->observaciones',
                    $this->codigo_postal,
                    '$this->id_usuario',
                    '$this->nombre',
                    '$this->apellido'
                )";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
    }

    static function getProvincias($where = null){
        $sql = "SELECT * FROM provincias $where  ORDER BY nombre";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $provincia){
                $provincias[$provincia['id']] = $provincia['nombre'];
            }
            return $provincias;
        }
        return [];
    }

    static function getLocalidades($where = null){
        $sql = "SELECT * FROM localidades $where  ORDER BY nombre";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $localidad){
                $localidades[$localidad['id']] = $localidad['nombre'];
            }
            return $localidades;
        }
        return [];
    }
}

/* "SELECT * FROM productos p JOIN productos_direcciones pd ON p.id = pd.id_producto JOIN direcciones d ON d.id = pd.id_direccion"; */