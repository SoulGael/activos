<?php
include 'paginas/conexion.php';
conectarse();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Saitel - Ordenamiento de Activos</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    

    <script src="js/alertify.min.js"></script>
    <link rel="stylesheet" href="css/alertify.core.css" />
    <link rel="stylesheet" href="css/alertify.default.css" id="toggleCSS" />
    <script src="js/busqueda.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    function seleccionar(){
      $("input[name=checktodos]").change(function(){
        $('input[name=condi]').each( function() {      
          if($("input[name=checktodos]:checked").length == 1){
            this.checked = true;
          } else {
            this.checked = false;
          }
        });
      });
    }
  </script>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Sistema el Ordenamiento de Activos para la empresa SAITEL</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Activos</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form">
            
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <p><STRONG>INSTRUCCIONES: </STRONG></p>
        <p>Todos los activos que esten "SIN CATEGORIA" seran mostrados en esta lista.</p>
      </div>
    </div>
    <br>

    

    <div class="container">
      <!-- Example row of columns -->
      <div id="tabs">
          <ul>
            <li><a href="#PActivos"><span>Plan de Cuentas de Activos</span></a></li>
            <li><a href="#CActivos"><span>Categorización de Activos</span></a></li>
          </ul>

          <div id="PActivos">
            <?php
            include 'paginas/condi.php';
            opciones();
            ?>
          </div>
          <div id="CActivos">
            <div class="input-group input-group-sm" STYLE="z-index:1">
              <span class="input-group-addon">Nombres</span>
                <input type="text" class="form-control" id="idusuario" name="idusuario"  onkeyup="consuActivo()" placeholder="Activos">
              <span class="input-group-addon">Grupo de Activos</span>
              <select id="provincia" class="form-control">
                <?php
                    $consulta="select * from tbl_comun where id_comun like '%CAT%'  order by codigo";
                    $resultado=pg_query($consulta) or die (pg_last_error());
                    /*$id_com='1';
                    $nom='1';
                    while($tabla=pg_fetch_array($resultado))
                    {
                      $cod_acMas1=$tabla['codigo'];
                      $resul='';
                      $resul = strpos($cod_acMas1, $cod_ac);
                      if ($resul ===false) {
                        if($nom!='1')
                        echo "<option value=".$id_com.">".$cod_ac." - ".$nom."</option>";
                      }
                      else
                      {
                        echo "<optgroup label=".$cod_ac.'-'.$nom."></optgroup>";
                      }
                      $cod_ac=$cod_acMas1;
                      $id_com=$tabla['id_comun'];
                      $nom=$tabla['nombre'];
                    } */
                    while($tabla=pg_fetch_array($resultado))
                    {
                      if ($tabla['numero_elementos']==='0') {
                        echo "<optgroup label=".$tabla['codigo'].'-'.$tabla['nombre']."></optgroup>";
                      }
                      else{
                        echo "<option value=".$tabla['id_comun'].">".$tabla['codigo']." - ".$tabla['nombre']."</option>";
                      }
                    }
                ?> 
              </select>

              <!--data-target="#myModal"-->
              <span class="input-group-addon"  data-toggle="modal"  style=cursor:pointer;>
                <select id="admin" onchange=nuevo(this)>
                  <option>Seleccione una Opcion</option>
                  <option value="m">Modificar</option>
                  <option value="e">Eliminar</option>
                </select>
              </span>
              <button type="button" class="btn btn-success form-control" onclick=imprimo(this)>Guardar</button> 
            </div>
            <br>
            <div id="resultados">
            </div> 
          </div>  
        </div>

        <script>
          $( "#tabs" ).tabs();
        </script> 

      <br>

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Error</h4>
          </div>
          <div class="modal-body" id="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

      <script type="text/javascript">

      function imprimo(){
        var ids='';
        var nombre='';
        for(var i=1;i<document.getElementById("selectable").rows.length;i++)
        {                        
          var elemento = document.getElementById("condiciones"+i+"");
          if(elemento.checked)
          {
            ids+=elemento.value+',';
            nombre+=selectable.rows[i].cells[1].childNodes[0].nodeValue+',';
            //ids+=selectable.rows[i].cells[1].childNodes[0].nodeValue+',';
            //guardarimpr(selectable.rows[i].cells[1].childNodes[0].nodeValue);
            //alert(" Elemento: " + elemento.value 
              //+ "\n Seleccionado: " + selectable.rows[i].cells[1].childNodes[0].nodeValue
              //+ "\n Valor: " + provincia.value);      
          }
        }
        ids=ids.substr(0,ids.length-1);
        nombre=nombre.substr(0,nombre.length-1);
        guardardos(ids,nombre,provincia.value);
        //imprimirpdf(ids);
      }

      function myFunctioncheck(val) {
          document.getElementById('txtCod'+val+'').value = document.getElementById("txtpoe").value.toUpperCase();
          document.getElementById('txtDescri'+val+'').value = '-POE';
          document.getElementById('txtCod'+val+'').disabled = true;
          document.getElementById('txtDescri'+val+'').disabled = true;
      }
      function myFunctioncheck2(val) {
          document.getElementById('txtCod'+val+'').value = '';
          document.getElementById('txtDescri'+val+'').value = '';
          document.getElementById('txtCod'+val+'').disabled = false;
          document.getElementById('txtDescri'+val+'').disabled = false;
      }

      

      function presionBoton(mue)
      {
        var posicion=document.getElementById('combo').options.selectedIndex; //posicion
        var conte=(document.getElementById('combo').options[posicion].text); //valor
        var ultimo=0;
        if (document.getElementById("combo").value=='SELECCIONE UNA OPCION') {
          alert("SELECCIONE UNA OPCION DE LA DEPRECIACION");
        }
        else{
          if (document.getElementById("txtNelementos").value>1) {
            $('#myModal').modal('show');
            var elem=document.getElementById("txtelementos").value;
            elem=elem.substr(0,elem.length-1);
            var res = elem.split(",");
            var error='t';
            for (var i = 0; i <=res.length; i++) {
              if (document.getElementById("txtCodigo").value==res[i]) {
                document.getElementById("modal-body").innerHTML = "<div class='alert alert-danger alert-dismissable'>"+
                                                                      "<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                                                                      "<strong>¡Cuidado!</strong> Se esta repitiendo el Codigo."+
                                                                    "</div>";
                                                                    error='e';
              }
            }

            if(error=='t'){        
            var ingreso="";
            document.getElementById("myModalLabel").innerHTML = "Ingresar Activos para:<strong> "+(document.getElementById("txtDescripcion").value).toUpperCase()+
            '</strong><input class="form-control" id ="txtid" type="hidden" value='+document.getElementById("txtCodigo").value+' disabled>';
            ingreso += '<table id="selectable" class="table table-hover">'+
              '<thead>'+
              '<tr>'+
              '<th>Codigo</th>'+
              '<th>Descripcion</th>'+
              '<th>Numero de Elementos</th>'+
              '<th>Depreciacion</th>'+
              '</tr>'+
              '</thead>';
            for (var i = 1; i <= document.getElementById("txtNelementos").value-1; i++) {
              ingreso+='<tbody id='+i+'>'+
              '<td>'+
              '<input class="form-control" id ="txtCod'+i+'" type="text" placeholder="Codigo" required>'+
              '</td>'+
              '<td>'+
              "<input class='form-control' id ='txtDescri"+i+"' type='text' placeholder='Descripcion' required>"+
              '</td>'+
              '<td>'+
              "<input class='form-control' type='text' placeholder='Numero de Elementos' value='1' disabled>"+
              '</td>'+
              '<td>'+
              "<SELECT NAME='co"+i+"' id='co"+i+"' disabled>"+
              "<option value="+document.getElementById("combo").value+">"+conte+"</option>"+
              "</select>"+
              '</td>'+
              '<td>'+
              "<button type='button' class='btn btn-primary'onclick='guardarelemtos("+i+")''>Guardar</button>"+
              '</td>'+
              '</tbody>';
              ultimo=i;
            };
            if(document.getElementById("txtpoe").value!='s')
            {
              ingreso += '<div class="checkbox">'+
                          '<label>'+
                            '<input type="checkbox" onclick="if(this.checked){myFunctioncheck('+ultimo+')}else{myFunctioncheck2('+ultimo+')}">'+
                            'Incluir POE'+
                          '</label>'+
                        '</div>';
            }
            document.getElementById("modal-body").innerHTML = ingreso;
           } 
          }; 
          guardardatos(document.getElementById("txtCodigo").value,
            document.getElementById("txtDescripcion").value, 
            document.getElementById("txtNelementos").value, 
            document.getElementById("combo").value);
        }
      }

      function guardarelemtos(cod){
        if (document.getElementById("txtDescri"+cod).value=='-POE') {
          alert('poe ingresado');
          guardarfiltro(document.getElementById("txtid").value,
          document.getElementById("txtCod"+cod).value,cod);
        }
        else{
           guardarfiltro(document.getElementById("txtid").value,
          document.getElementById("txtCod"+cod).value,cod);

        guardardatos(document.getElementById("txtCod"+cod).value,
            document.getElementById("txtDescri"+cod).value, '1',
            document.getElementById("co"+cod).value);
        }

        /*alert(document.getElementById("txtid").value);
        alert(document.getElementById("txtCod"+cod).value);
        alert(document.getElementById("txtDescri"+cod).value);
        alert(document.getElementById("co"+cod).value);*/
      }

      function nuevo(){
        var posicion=document.getElementById('provincia').options.selectedIndex; //posicion
        var conte=(document.getElementById('provincia').options[posicion].text); //valor
        if(admin.value=="m")
        {
          var n2 = prompt("Modificar "+conte+" por:");
          if(n2!=null)
          {
            //alert(provincia.value);
            modif(provincia.value, n2);
          }
        }
        if(admin.value=="e")
        {
          confirmar=confirm("¿Seguro que desea eliminar "+conte+"?"); 
          if (confirmar) 
          {
            // si pulsamos en aceptar
            elim(provincia.value);
          }
        }

          //alert(conte);
      }
      </script>
      
    </div> <!-- /container -->
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
