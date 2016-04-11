<?php

	/*CLASE 5*/
	var_dump($_POST);
	var_dump($_FILES);
	die;
	/*END CLASE 5*/

	$accion = $_POST['estacionar']; 
	$patente = $_POST['patente'];
	$ahora = date("y-m-d h:i:s");
	$listadeautos = array();
	$listaauxiliar = array();

	if($accion=="ingreso"){
		echo "se guardo la patente $patente";
		$archivo = fopen("ticket.txt", "a");
		fwrite($archivo, $patente."[".$ahora."\n");
		fclose($archivo);
	}
	else {
		$archivo = fopen("ticket.txt", "r"); 
		while(!feof($archivo)){
			$renglon = fgets($archivo);
			$auto = explode("[", $renglon); 
			if($auto[0]!="")
			$listadeautos[] = $auto;
		}
		fclose($archivo);

		$esta = false;
		foreach ($listadeautos as $auto) {
			if($auto[0]==$patente){
				$esta = true;
			}
			else {
				if($auto[0]!=""){
					$listaauxiliar[] = $auto;
				}
			}
		}
		if($esta){
			echo "Está el auto<br>";

			$fechainicio = $auto[1];
			$diferencia = strtotime($ahora)-strtotime($fechainicio);
			echo "El tiempo transcurrido es: $diferencia";

			$archivo = fopen("ticket.txt", "w");
			foreach ($listaauxiliar as $auto) {
				fwrite($archivo, $auto[0]."[".$auto[1]);
			}
			fclose($archivo);
		}
		else {
			echo "No está el auto";
		}
	}
?>
<br>
<br>
<a href="index.php">volver</a>