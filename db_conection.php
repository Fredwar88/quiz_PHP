<?php 
#php version 7.4.29


    #Parametros de la BD
class Connection {

    private $driver = 'mysql';
    private $host = 'localhost';
    private $dbname= 'quiz_db';
    private $charset= 'utf8';
    private $username = 'bcpelftn';
    private $password = "Js71ZIgvf9X4";
            
    
    protected function connect()
        {
            try {
                #conexion con la BD 
                $connect = new PDO ("{$this->driver}:host={$this->host};dbname={$this->dbname};charset={$this->charset}",$this->username,$this->password);
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connect;

            } catch (PDOException $e) {
                #soporte de errores
                echo('db error');
                echo $e->getMessage();
            }
    }

}



?>