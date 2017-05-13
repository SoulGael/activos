<?php  
function opciones() {
  $codigo="";
  $consulta="select c.codigo, c.nombre, c.numero_elementos, d.depreciacion from tbl_comun c, tbl_tabla_depreciacion d where d.id_tabla_depreciacion=c.id_depreciacion order by codigo";
  $resultado=pg_query($consulta) or die (pg_last_error());
  echo '<table class="table table-hover">';
  echo '<thead>
  <tr>
  <th>Codigo</th>
  <th>Descripcion</th>
  <th>Numero de Elementos</th>
  <th>Depreciacion</th>
  </tr>
  </thead>';
  echo '<tbody>';
  echo '<td>';
  echo "<input class='form-control' id ='txtCodigo' type='text' placeholder='Codigo' required>";
  echo '</td>';
  echo '<td>';
  echo "<input class='form-control' id ='txtDescripcion' type='text' placeholder='Descripcion' required>";
  echo '</td>';
  echo '<td>';
  echo "<input class='form-control' id ='txtNelementos' type='text' placeholder='Numero de Elementos' required>";
  echo '</td>';
  $consulta1="select id_tabla_depreciacion, depreciacion from tbl_tabla_depreciacion";
  $resultado1=pg_query($consulta1) or die (pg_last_error());
  echo '<td>';
  echo "<SELECT NAME='combo' id='combo'>"; 
  echo "<option>SELECCIONE UNA OPCION</option>";  

  if(pg_num_rows($resultado1)==0){
   echo '<b>No hay sugerencias </b>';
 }
 else{   
   while($fila1=pg_fetch_array($resultado1))
   { 
    echo "<option value=".$fila1[0].">".$fila1[1]."</option>";     
  }
}
echo "</select>";
echo '</td>';
echo '<td>';
echo "<button type='button' class='btn btn-primary'onclick='presionBoton()''>Guardar</button>";
echo '</td>';
echo '</tbody>'; 

if(pg_num_rows($resultado)==0){
}

else{
  while($fila=pg_fetch_array($resultado)){
    $codigo=$codigo.$fila[0].',';
    echo '<tbody>';
    echo '<td>';
    echo $fila[0];
    echo '</td>';
    echo '<td>';
    echo $fila[1];
    echo '</td>';
    echo '<td>';
    echo $fila[2];
    echo '</td>';
    echo '<td>';
    echo $fila[3];
    echo '</td>';
    echo '</tbody>';                     
  }
}

echo '</table>'; 
echo "<input class='form-control' id ='txtelementos' type='hidden' value=".$codigo." placeholder='Numero de Elementos'>";

$consulta2="select * from tbl_comun where nombre like UPPER('%poe%')";
  $resultado2=pg_query($consulta2) or die (pg_last_error());

  if(pg_num_rows($resultado2)==0){
    echo "<input class='form-control' id ='txtpoe' type='hidden' value='s' placeholder='Numero de Elementos'>";
  }

  else{
    while($fila2=pg_fetch_array($resultado2))
    { 
      echo "<input class='form-control' id ='txtpoe' type='hidden' value=".$fila2['codigo']." placeholder='Numero de Elementos'>";  
    }
  }
}
?>