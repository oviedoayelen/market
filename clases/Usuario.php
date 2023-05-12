<?php
require_once 'DB.php';
require_once 'Producto.php';
require_once 'Direccion.php';

class Usuario{

    private $id;
    private $usuario;
    private $password;
    private $nombre;
    private $apellido;
    private $email;
    private $fecha_alta;
    private $favoritos;
    private $carrito;
    private $status;

    public function __construct($usuario = null){
        $this->id = $usuario['id'] ?? null;
        $this->usuario = $usuario['usuario'] ?? null;
        $this->password = $usuario['password'] ?? null;
        $this->nombre = $usuario['nombre'] ?? null;
        $this->apellido = $usuario['apellido'] ?? null;
        $this->email = $usuario['email'] ?? null;
        $this->fecha_alta = $usuario['fecha_alta'] ?? 'NOW()';
        $this->favoritos = $usuario['favoritos'] ?? null;
        $this->carrito = $usuario['carrito'] ?? null;
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

    public function update(){
        $sql = "UPDATE usuarios SET 
                usuario = '$this->usuario',        
                password = '$this->password',
                nombre = '$this->nombre',
                apellido = '$this->apellido',
                email = '$this->email',
                favoritos = '$this->favoritos',
                carrito = '$this->carrito'
                WHERE id = $this->id";
        $stmt = DB::getStatement($sql);
		$stmt->execute();
    }

    public function delete(){
        $sql = "UPDATE usuarios SET 
                status = null       
                WHERE id = $this->id";
        $stmt = DB::getStatement($sql);
		$stmt->execute();

        $sql = "UPDATE productos SET 
                status = null        
                WHERE id_vendedor = $this->id";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
    }

    public function insert(){
        $sql = "INSERT INTO usuarios
                (   
                    usuario,
                    password,
                    nombre,
                    apellido,
                    email,
                    fecha_alta,
                    status
                )
                VALUES
                (
                    '$this->usuario',        
                    '$this->password',
                    '$this->nombre',
                    '$this->apellido',
                    '$this->email',
                    $this->fecha_alta,
                    $this->status
                )";
          $stmt = DB::getStatement($sql);
          $stmt->execute();
    }

    static function getByUsuario($user){
        $stmt = DB::getStatement("SELECT * FROM usuarios WHERE (usuario = :us OR email = :us) AND status = 1");
        $stmt->bindParam(':us', $user, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt->rowCount() === 1) {
            $usuario = new Usuario($stmt->fetch(PDO::FETCH_ASSOC));
            return $usuario;
        }
		return null;
    }

    static function getById($id){
        $stmt = DB::getStatement("SELECT * FROM usuarios WHERE id='$id' AND status = 1");
		$stmt->execute();
		if ($stmt->rowCount() === 1) {
            $usuario = new Usuario($stmt->fetch(PDO::FETCH_ASSOC));
            return $usuario;
        }
		return null;
    }

    static function loguearUsuario($usuario, $password){
        $stmt = DB::getStatement("SELECT * FROM usuarios WHERE (usuario = :us OR email = :us) AND password = :pass AND status = 1");
        $stmt->bindParam(':us', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $password, PDO::PARAM_STR);
        $stmt->execute();
		if ($stmt->rowCount() === 1) {
		    return true;
        }
		return false;
    }

    public function getIdProductos(){ 
        $sql = "SELECT id FROM productos WHERE id_vendedor = '$this->id'";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        }
        return [];
    }

    public function getIdDirecciones(){ 
        $sql = "SELECT id FROM direcciones WHERE id_usuario = '$this->id'";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        }
        return [];
    }

    public function getProductos(){
        return Producto::getAll(" AND id_vendedor = '$this->id'");
    }

    public function getDirecciones(){ 
        return Direccion::getAll(" WHERE id_usuario = '$this->id'");
    }

    public function getFavoritosArray(){
        $favoritos = null;
        $sql = "SELECT favoritos FROM usuarios WHERE id = '$this->id'";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        foreach(explode(",",$stmt->fetch()[0]) as $id){
            if($id && Producto::getById($id)){
                $favoritos[$id] = $id;
            }
        }
        return $favoritos;
    }

    public function getFavoritos(){
        $productos = null;
        if(!isset($_SESSION['favoritos'])){
            $_SESSION['favoritos'] = $this->getFavoritosArray();
        }
        if($_SESSION['favoritos']){
            foreach ($_SESSION['favoritos'] as $id) {
                if(Producto::getById($id)){
                    $productos[] = Producto::getById($id);
                }
            }
        }
        return $productos;
    }

    public function guardarFavoritos($concatenar = null){
        if(isset($_SESSION['favoritos'])){
            if($concatenar && $this->favoritos){
                $this->favoritos = $this->favoritos . "," . implode(",",$_SESSION['favoritos']);
            }
            else{
                $this->favoritos = count($_SESSION['favoritos']) > 0 ? implode(",",$_SESSION['favoritos']) : null;
            }
            $this->update();
        }
    }

    static function loguearParaFavoritos(){
        if (!isset($_SESSION['usuario_logueado'])) {
            echo "<script>
            $('.favorito').on('click', function(){
                location.href = 'ingresar.php';
            });
            </script>";
        }
    }

    public function checkedFavorito($id){
        $favoritos = $this->getFavoritosArray();
        if($favoritos){
            foreach($favoritos as $favorito){
                if($favorito == $id){
                    echo "checked";
                } 
            }
        }
    }

    public function getCarritoArray(){
        $sql = "SELECT carrito FROM usuarios WHERE id = $this->id";
        $stmt = DB::getStatement($sql);
        $stmt->execute();
        parse_str($stmt->fetch()[0],$carrito);
        foreach($carrito as $id=>$val){
            if(!Producto::getById($id)){
                unset($carrito[$id]);
            }
        }
        return $carrito;
    }
    
    public function getCarrito(){
        $productos = null;
        if(!isset($_SESSION['carrito'])){
            $_SESSION['carrito'] = $this->getCarritoArray();
        }
        if($_SESSION['carrito']){
            foreach ($_SESSION['carrito'] as $id=>$val) {
                if(Producto::getById($id)){
                    $productos[] = Producto::getById($id);
                }
            }
        }
        return $productos;
    }

    public function guardarCarrito($concatenar = null){
        if(isset($_SESSION['carrito'])){
            $str = null;
            foreach($_SESSION['carrito'] as $id=>$cant){
                $str .= "$id=$cant&";
            }
            if($concatenar){
                $this->carrito = $this->carrito . $str;
            }
            else{
                $this->carrito = $str;
            }
            $this->update();
        }
    }

}