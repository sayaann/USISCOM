<?php

	if (isset($_POST['subArticulo'])) {

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'USISCOM';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		if (!$conn) {die('Could not connect: ' . mysql_error());}

		$nom_art = $_POST['nombreArticulo'];
		$des_art = $_POST['descripcionArticulo'];
		$pre_art = $_POST['precioArticulo'];
		$uni_art = $_POST['unidadesArticulo'];


		

		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		
		$sql = "INSERT INTO Articulo (Nombre, Descripcion, Precio, Unidades, Imagen) VALUES('$nom_art', '$des_art', $pre_art, $uni_art, '$target_file')";

		$retval = mysqli_query($conn, $sql);

		if (! $retval) {die('Could not enter data: ' . mysqli_error($conn));}

		//echo "OK DATA<br/>";
		mysqli_close($conn);
	} 
?>

<html>
<head>
	<title>Alt Articulo Exito</title>
	<link rel="stylesheet" type="text/css" href="usiscom.css">
</head>

<body>

	<?php include 'cabecera.html'; ?>
	<?php include 'navegacion.html'; ?>

	<div id="content" class="content">
	<h1>Exito de Ingreso Arículo</h1>
	<a href="AltaArticulo.html">Ingresar Otro Articulo</a>
	</div>

	<?php include 'pie.html'; ?>

</body>

</html>