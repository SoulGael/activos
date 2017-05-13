<?php
function conectarse() {
	if (!($conexion = pg_connect("host='181.39.76.200' port=5432 dbname='db_isp' user='gestion_juridica' password='91GGr15da19'"))) 
   	//if (!($conexion = pg_connect("host='localhost' port=5432 dbname='db_isp' user='postgres' password='postgres'"))) 
    {			
        exit();
    }
    else {    
    }
    return $conexion;
    pg_close();
}
conectarse();
?>