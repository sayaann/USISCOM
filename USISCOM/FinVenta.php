<?php
	
	if (isset($_POST['subR'])) {

		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'USISCOM';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		if (!$conn) {die('Could not connect: ' . mysql_error());}

		$idV = $_POST['idV'];

		$sql2 = "SELECT Estatus FROM Venta WHERE idVenta = $idV";
		$result = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

					if ($row['Estatus'] == 1) {

						$sql = "UPDATE Venta SET Estatus=2, Fecha_fin=NOW() WHERE idVenta = $idV";

						if (mysqli_query($conn, $sql)) {
							echo "Venta fin bien";
						}
						else {
							echo "Va mal";
						}
					}
					else {
						echo "Venta Ya Hecha";
					}
				}
		}
		else {
			echo "NO HAY VENTA CON ESE ID";
		}

		mysqli_close($conn);
	}
?>

<html>
<head>
		<title>Fin Venta</title>
		<link rel="stylesheet" type="text/css" href="usiscom.css">
</head>

<body>

	<?php include 'cabecera.html';?>
	<?php include 'navegacion.html';?>

	<div id="content" class="content">
	<h1>Venta Finalizada</h1>
	<a href="Reparto.php">Regresar a Entregas</a>
	</div>

	<?php include 'pie.html';?>

</body>

</html>