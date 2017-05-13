<?php  
include 'conexion.php';
conectarse();
$id=$_POST['g1'];
$nomb=$_POST['g2'];

if(pg_query("update tbl_comun set nombre='".$nomb."' where id_comun='".$id."'"))
{
	echo "<div class='alert alert-success'><strong>".$nomb."</strong> Modificado Correctamente</div>";
}
else {
	echo "<div class='alert alert-danger'><strong>".$nomb."</strong> No se pudo Modificar Intentelo Nuevamente</div>";
}
?>