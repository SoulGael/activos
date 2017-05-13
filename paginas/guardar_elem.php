<?php  
include 'conexion.php';
conectarse();
//$q=($_GET['geu']);
$id=$_POST['id'];
$codigo=$_POST['cod'];
$cod='';

  $consultacon="select elementos from tbl_comun where codigo='".$id."'";
  $resultadocon=pg_query($consultacon) or die (pg_last_error());

  if(pg_num_rows($resultadocon)==0){
    
  }

  else{
    while($filacon=pg_fetch_array($resultadocon))
    { 
      $cod=$filacon[0];    
    }
  }

  if(pg_query("update tbl_comun set elementos=('".$cod."'||'".$codigo."'||',') where codigo='".$id."'"))
  {
    echo "<td colspan='5'><div class='alert alert-success'><strong>Activo</strong> Guardado Correctamente</div></td>";
  }
  else
  {
  echo "<td colspan='5'><div class='alert alert-danger'><strong>Error</strong>  No se pudo Guardar Intentelo Nuevamente</div></td>";
  }
?>