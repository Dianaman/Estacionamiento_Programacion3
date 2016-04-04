<?php

/*	1- si es un ingreso lo guardo en ticket.txt
 	2- si es salida leo el archivo:
 	leer del archivo todos los datos, guardarlos en un array
	si la patente existe en el archivo .
	 sobreescribo el archivo con todas las patentes
	 y su horario si la patente solicitada
	... calculo el costo de estacionamiento a 
	20$ el segundo y lo muestro.
	si la patente no existe mostrar mensaje y 
	el boton que me redirija al index  
	3- guardar todo lo facturado en facturado.txt*/


	//var_dump($_POST['estacionar']);
	$accion = $_POST['estacionar']; //para preguntar si el value del botón es estacionar
	$patente = $_POST['patente'];
	$ahora = date("y-m-d h:i:s");
	$listadeautos = array();

	if($accion=="ingreso"){
		echo "se guardo la patente $patente";
		$archivo = fopen("ticket.txt", "a");
		fwrite($archivo, $patente."[".$ahora."]\n");
		fclose($archivo);
	}
	else {
		$archivo = fopen("ticket.txt", "r");
		while(!feof($archivo)){
			$renglon = fgets($archivo);
			$auto = explode("[", $renglon); //explode separa un string mediante el delimitador
			echo "$auto[0] $auto[1]<br>";
			$listadeautos[] = $auto;
		}
		var_dump($listadeautos);
		fclose($archivo);
	}
?>
<br>
<br>
<a href="index.php">volver</a>