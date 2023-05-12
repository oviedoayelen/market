<?php

require_once 'DB.php';
require_once 'Marca.php';
require_once 'Usuario.php';

class Producto{
    
    private $id;
    private $id_vendedor;
    private $nombre;
    private $precio;
    private $id_categoria;
    private $categoria;
    private $id_marca;
    private $marca;
    private $foto;
    private $fecha_alta;
    private $descripcion;
    private $status;

    public function __construct($producto = null){
        $this->id = $producto['id'] ?? null;
        $this->id_vendedor = $producto['id_vendedor'] ?? null;
        $this->nombre = $producto['nombre'] ?? null;
        $this->precio = $producto['precio'] ?? null;
        $this->id_categoria = $producto['id_categoria'] ?? null;
        $this->categoria = $producto['categoria'] ?? null;
        $this->id_marca = $producto['id_marca'] ?? null;
        $this->marca = $producto['marca'] ?? null;
        $this->foto = $producto['foto'] ?? null;
        $this->fecha_alta = $producto['fecha_alta'] ?? 'NOW()';
        $this->descripcion = $producto['descripcion'] ?? null;
        $this->status = 1;
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

    public function insert(){
        $sql = "INSERT INTO productos
                (
                    id,
                    id_vendedor,
                    nombre,
                    precio,
                    id_categoria,
                    id_marca,
                    foto,
                    fecha_alta,
                    descripcion,
                    status
                )
                VALUES
                (
                    '$this->id',
                   '$this->id_vendedor',
                   '$this->nombre',
                    $this->precio,
                    $this->id_categoria,        
                    $this->id_marca,     
                   '$this->foto',        
                    $this->fecha_alta,
                   '$this->descripcion',
                    $this->status
                )";
              //  echo $sql;
        $stmt = DB::getStatement($sql);
        $stmt->execute();
    }

    public function update(){
        $sql = "UPDATE productos SET
                nombre = '$this->nombre',
                precio = $this->precio,
                id_categoria = $this->id_categoria,        
                id_marca = $this->id_marca,     
                foto = '$this->foto',
                descripcion = '$this->descripcion'        
                WHERE id = '$this->id'";
        $stmt = DB::getStatement($sql);
		$stmt->execute();
    }

    public function delete(){
        $sql = "UPDATE productos SET status = null WHERE id = '$this->id'";
        $stmt = DB::getStatement($sql);
		$stmt->execute();
    }

    static function getAll($where = null){
        $sql = "SELECT p.id, id_vendedor, p.nombre, precio, p.id_categoria, p.id_marca, p.status, p.foto, p.fecha_alta, p.descripcion, m.nombre as 'marca', c.nombre as 'categoria' 
                FROM productos p 
                JOIN marcas m ON p.id_marca = m.id 
                JOIN categorias c ON p.id_categoria = c.id 
                JOIN usuarios u ON p.id_vendedor = u.id 
                JOIN direcciones d ON d.id_usuario = u.id         
                JOIN provincias pp ON d.id_provincia = pp.id
                JOIN localidades l ON d.id_localidad = l.id 
                AND p.status = 1 $where";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $producto){
                $productos[] = new Producto($producto);
            }
            return $productos;
        }
        return [];
    }

    static function getById($id){
        $sql = "SELECT p.id, id_vendedor, p.nombre, precio, p.id_categoria, p.id_marca, p.status, p.foto, fecha_alta, descripcion, m.nombre as 'marca', c.nombre as 'categoria' 
                FROM productos p 
                JOIN marcas m ON p.id_marca = m.id 
                JOIN categorias c ON p.id_categoria = c.id 
                WHERE p.id = '$id' AND p.status = 1";
        $stmt = DB::getStatement($sql);
		$stmt->execute();
		if ($stmt->rowCount() === 1) {
            $producto = new Producto($stmt->fetch(PDO::FETCH_ASSOC));
		    return $producto;
        }
		return null;
    }

    public function getFechaFormateada(){
        return date_format(date_create_from_format('Y-m-d H:i:s', $this->fecha_alta), 'd-m-Y');
    }

    static function getCategorias($where = null){
        $sql = "SELECT COUNT(*) as countProductos, c.id, c.nombre as 'categoria' 
                FROM productos p 
                JOIN marcas m ON p.id_marca = m.id 
                JOIN categorias c ON p.id_categoria = c.id 
                JOIN usuarios u ON p.id_vendedor = u.id 
                JOIN direcciones d ON d.id_usuario = u.id
                JOIN provincias pp ON d.id_provincia = pp.id
                JOIN localidades l ON d.id_localidad = l.id 
                WHERE p.status = 1 $where  
                GROUP BY p.id_categoria 
                ORDER BY COUNT(*) DESC";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    static function getMarcas($where = null){
        $sql = "SELECT COUNT(*) as countProductos, m.id, m.nombre as 'marca' 
                FROM productos p 
                JOIN marcas m ON p.id_marca = m.id 
                JOIN categorias c ON p.id_categoria = c.id 
                JOIN usuarios u ON p.id_vendedor = u.id 
                JOIN direcciones d ON d.id_usuario = u.id 
                JOIN provincias pp ON d.id_provincia = pp.id
                JOIN localidades l ON d.id_localidad = l.id
                WHERE p.status = 1 $where 
                GROUP BY p.id_marca 
                ORDER BY COUNT(*) DESC";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    static function getProvincias($where = null){
        $sql = "SELECT COUNT(*) as countProductos, pp.id, pp.nombre as 'provincia' 
                FROM productos p 
                JOIN usuarios u ON p.id_vendedor = u.id 
                JOIN direcciones d ON d.id_usuario = u.id 
                JOIN provincias pp ON d.id_provincia = pp.id
                JOIN localidades l ON d.id_localidad = l.id
                JOIN categorias c ON c.id = p.id_categoria
                JOIN marcas m ON m.id = p.id_marca
                WHERE p.status = 1 $where 
                GROUP BY d.id_provincia 
                ORDER BY COUNT(*) DESC";
               // echo $sql;
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    static function getLocalidades($where = null){
        $sql = "SELECT COUNT(*) as countProductos, l.id, l.nombre as 'localidad' 
                FROM productos p 
                JOIN usuarios u ON p.id_vendedor = u.id 
                JOIN direcciones d ON d.id_usuario = u.id 
                JOIN localidades l ON d.id_localidad = l.id
                JOIN provincias pp ON d.id_provincia = pp.id
                JOIN categorias c ON c.id = p.id_categoria
                JOIN marcas m ON m.id = p.id_marca
                WHERE p.status = 1 $where 
                GROUP BY d.id_localidad 
                ORDER BY COUNT(*) DESC";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }
}

