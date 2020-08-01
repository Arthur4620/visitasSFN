<?php 
	$host='localhost';
	$username='root';
	$password='';
	$db='locventas3';
	
	$conectar= new mysqli($host,$username,$password,$db);
	//mysql_close($conectar);
	if($conectar-> connect_error)
	{
		die ("Error Conexion". $conectar-> connect_error);
	}
 ?>