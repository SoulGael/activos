function guardardatos(cod,des,no,com)
{	
var xmlhttp;
var c=cod;
var d=des;
var num=no;
var co=com;
if(n==''){
document.getElementById("PActivos").innerHTML="";
return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
		document.getElementById("PActivos").innerHTML=xmlhttp.responseText;
	}
}
for(var n=0;n<1;n++)
{
	xmlhttp.open("POST","paginas/nuevo.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("cod="+c+"&des="+d+"&no="+num+"&com="+co);
}
}

function consuActivo()
{
var xmlhttp;

var n=document.getElementById('idusuario').value;

if(n==''){
document.getElementById("resultados").innerHTML="";
return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("resultados").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("POST","paginas/filtroConsu.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("q="+n);
}

function modif(id,nomb)
{	
var xmlhttp;
var ge1=id;
var ge2=nomb;

document.getElementById("resultados").innerHTML="";

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
		document.getElementById("resultados").innerHTML=xmlhttp.responseText;
	}
}
for(var n=0;n<1;n++)
{
	xmlhttp.open("POST","paginas/modifica.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("g1="+ge1+"&g2="+ge2);
}
}

function elim(id)
{	
var xmlhttp;
var ge1=id;

document.getElementById("resultados").innerHTML="";

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
		document.getElementById("resultados").innerHTML=xmlhttp.responseText;
	}
}
for(var n=0;n<1;n++)
{
	xmlhttp.open("POST","paginas/eliminar.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("g1="+ge1);
}
}

function guardardos(id,nomb,activo)
{	
var xmlhttp;
var ge1=id;
var ge2=nomb;
var ge3=activo;

document.getElementById("resultados").innerHTML="";

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
		document.getElementById("resultados").innerHTML=xmlhttp.responseText;
	}
}
for(var n=0;n<1;n++)
{
	xmlhttp.open("POST","paginas/guardado.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="+ge1+"&no="+ge2+"&ac="+ge3);
}
}

function guardarfiltro(id,cod,valid)
{	
var xmlhttp;
var i=id;
var co=cod;
var va=valid;

if(n==''){
document.getElementById(va).innerHTML="";
return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
		document.getElementById(va).innerHTML=xmlhttp.responseText;
	}
}
for(var n=0;n<1;n++)
{
	xmlhttp.open("POST","paginas/guardar_elem.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id="+i+"&cod="+co);
}
}