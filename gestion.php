<?php


	$accion = $_POST['estacionar']; 
	$patente = $_POST['patente'];
	$ahora = date("y-m-d h:i:s");
	$listadeautos = array();
	$listaauxiliar = array();






	/*CLASE 5*/
	var_dump($_POST);
	echo "<br><br>";
	var_dump($_FILES['foto_autito']['name']);

	//guardado con el nombre del archivo subido
	//$archivoDestino = "fotitos/".$_FILES['foto_autito']['name'];

	//guardado con la patente.jpg (o la extensión que sea)
	//utilizamos explode para conseguir la extensión
	$extAnterior = explode(".", $_FILES['foto_autito']['name']);
	$archivoDestino = "fotitos/".$patente.".".$extAnterior[1];

	//el archivo subido se guarda temporalmente en el servidor, el parámetro que indica dónde se guarda es el tmp_name
	//para guardarlo en la página necesitamos mover el archivo con move_uploaded_file(ubicacion, destino);
	move_uploaded_file($_FILES['foto_autito']['tmp_name'], $archivoDestino);

	echo "<br><br>";
	var_dump($archivoDestino);
	die();
	/*END CLASE 5*/





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