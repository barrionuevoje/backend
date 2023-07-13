<?php
	require 'conexion.php';
	
	$id = $_GET['id'];
	
	$sql = "SELECT * FROM personas WHERE id = '$id'";
	$resultado = $mysqli->query($sql);
	$row = $resultado->fetch_array(MYSQLI_ASSOC);
	
?>
<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	

		<script>
			$(document).ready(function(){
				$('.delete').click(function(){
					var parent = $(this).parent().attr('id');
					var service = $(this).parent().attr('data');
					var dataString = 'id='+service;

					$.ajax({
						type: "POST",
						url: "del_file.php",
						data: dataString,
						success: function(){
							location.reload();
						}
					});
				});
			});


		</script>



	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<h3 style="text-align:center">MODIFICAR REGISTRO</h3>
			</div>
			
			<form class="form-horizontal" method="POST" action="update.php" enctype="multipart/form-data" autocomplete="off">
				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombre</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']; ?>" required>
					</div>
				</div>
				
				<input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>" />
				
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $row['correo']; ?>"  required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="telefono" class="col-sm-2 control-label">Telefono</label>
					<div class="col-sm-10">
						<input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $row['telefono']; ?>" >
					</div>
				</div>

				<div class="form-group">
					<label for="telefono" class="col-sm-2 control-label">CUIT</label>
					<div class="col-sm-10">
						<input type="tel" class="form-control" id="cuit" name="cuit" placeholder="C.U.I.T" value="<?php echo $row['cuit']; ?>" >
					</div>
				</div>

				<div class="form-group">
					<label for="archivo" class="col-sm-2 control-label">Archivo</label>
					<div class="col-sm-10">
						<input type="file" class="form-control" id="archivo" name="archivo" >

						<?php 

							$path = "files/".$id;
							if(file_exists($path)){
								$directorio = opendir($path);
								while($archivo = readdir($directorio))
								{
									if(!is_dir($archivo)){
										echo "<div data='".$path."/".$archivo."'>
										<a href='".$path."/".$archivo."' 
										title='Ver Archivo adjunto'><span 
										class='glyphicon glyphicon-picture'></span></a>";
										echo "$archivo <a href='#' class='delete' 
										title='Ver archivo adjunto'>
										<span class='glyphicon glyphicon-trash'
										aria-hiden='true></span></a></div>";
										echo "<img src='files/$id/$archivo' width='300' />";
									}
								}
							}
						
						
						
						?>
					</div>
				</div>
				
				
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="index.php" class="btn btn-default">Regresar</a>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>