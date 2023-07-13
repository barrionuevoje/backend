<?php
	
	require 'conexion.php';
	
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];
	$cuit = $_POST['cuit'];

	$sql = "UPDATE personas SET nombre='$nombre', correo='$email', telefono='$telefono', cuit='$cuit' WHERE id = '$id'";
	$resultado = $mysqli->query($sql);
	$id_insert = $id;

	if($_FILES["archivo"]["error"]>0){
		echo "Error al cargar archivo";
	}else{
	 	$permitidos = array("image/gif","image/png","image/jpg","application/pdf");
		$limite_kb = 200;

		if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"]<= $limite_kb * 1024){

			$ruta = 'files/'.$id_insert.'/';
			$archivo = $ruta.$_FILES["archivo"]["name"];
			
			if(!file_exists($ruta)){
				mkdir($ruta);
			};
			if(!file_exists($archivo)){
				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
				if($resultado){
					echo "archivo Guardado";
				}else{
					echo "Error al guardar archivo";
				};
			
			}else{
				echo "Archivo ya existe";
			};
		}else{
			echo "Archivo no permitido o excede el tamaño";
		};
	};
	
?>

<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
					<?php if($resultado) { ?>
						<h3>REGISTRO MODIFICADO</h3>
						<?php } else { ?>
						<h3>ERROR AL MODIFICAR</h3>
					<?php } ?>
					
					<a href="index.php" class="btn btn-primary">Regresar</a>
					
				</div>
			</div>
		</div>
	</body>
</html>
