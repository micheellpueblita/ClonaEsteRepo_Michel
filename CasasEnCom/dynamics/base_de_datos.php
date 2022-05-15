<?php
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("PASSWORD", "");
    define("DB", "base_de_casas");
    
    function connect()
    {
        $cone = mysqli_connect(DBHOST,DBUSER,PASSWORD,DB);
        var_dump($cone);
        if(!$cone){
            mysqli_error();
            echo "No se ha encotrado la base de datos";
        }
        return $conexion;
    }

?>