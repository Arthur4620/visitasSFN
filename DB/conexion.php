<?php 
	$host='db4free.net';
	$username='root46';
	$password='Arthur46';
	$db='locventas2';
	
	$conectar= new mysqli($host,$username,$password,$db);
	//mysql_close($conectar);
	if($conectar-> connect_error)
	{
		die ("Error Conexion". $conectar-> connect_error);
	}
 ?>