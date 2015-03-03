<?php
/**
 * Fck class
 *
 * @package default
 * @author  Kevin Anaya www.anaya@gmail.com
 **/
class Fck {

    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "SkyC0m123";
    private $dbname = "refe_db";

    private static $db;
    protected $con;

    # Abrir conexion
    public function __construct() {
        $this->con = new MySQLi(self::$host, self::$user, self::$pass, $this->dbname);
    }

    # Cerrar conexion.
    function __destruct() {
        # Si hay un objeto MySQLi en $db
        if ($this->con != null) {
            $this->con->close();
            //print 'Se cerro la conexion';
        }
    }
    # Abrir una conexion.
    public static function getCon() {
        # Si $db esta vacio, se crea una conexion
        if (self::$db == null) {
            self::$db = new Fck();
            //print 'Se abrio la conexion';
        }
        return self::$db->con;
    }
}
?>