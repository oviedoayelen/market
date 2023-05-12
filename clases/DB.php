<?php

class DB {

    static private $db;
    const DSN = 'mysql:host=localhost;dbname=tienda';
    const USER = 'root';
    const PASSWORD = '';
    const CHARSET = 'utf8';

    static function getConnection() {
        // si aun no esta creado mi objeto PDO
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(
                    self::DSN,
                    self::USER,
                    self::PASSWORD,
                    [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . self::CHARSET]
                );
            } 
            catch (Exception $e) {
                $error = $e->getMessage();
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $fecha = date('d/m/Y H:i:s');
                $detalle_error = "\r\n$fecha\t$error";
                $fh = fopen('log_de_errores.log', 'a');
                fwrite($fh, $detalle_error);
                fclose($fh);
                echo "<script>
                        window.location = 'pagina_error.php';
                    </script>";
                die;
            }
        }
        return self::$db;
    }

    static function getStatement($sql){
        return self::getConnection()->prepare($sql);
    }
}