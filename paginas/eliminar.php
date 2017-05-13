<?php  
include 'conexion.php';
conectarse();
$id=$_POST['g1'];

$consulta="select descripcion from tbl_activo where id_categoria='".$id."'";
$resultado=pg_query($consulta) or die (pg_last_error());

if(pg_num_rows($resultado)==0){
	pg_query("delete from tbl_comun where id_comun='".$id."'");
	echo "<div class='alert alert-success'><strong>✓</strong>No se encontraron activos asociados: Eliminado Correctamente</div>";
}else{
	echo "<div class='alert alert-success'><strong>Error</strong>No se puede Eliminar por que esta Categoria tiene los siguiente activos</div>";
    while($tabla=pg_fetch_array($resultado))
        {
            echo "<div class='alert alert-success'><strong>x </strong>".$tabla['descripcion']."</div>";
        }
}
?>