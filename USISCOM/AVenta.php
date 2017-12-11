<?php
	if (isset($_POST['subVenta'])) {

		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'USISCOM';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		if (!$conn) {die('Could not connect: ' . mysql_error());}

		$idventa = $_POST['idVenta'];
		$repventa = $_POST['repVenta'];

		$sql2 = "SELECT Estatus FROM Venta WHERE idVenta = $idventa";
		$result = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

					if ($row['Estatus'] == 0) {
						$sql = "UPDATE Venta SET Repartidor='$repventa', Estatus=1 WHERE idVenta = $idventa";

						if (mysqli_query($conn, $sql)) {
							echo "Venta alta bien";
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
	}
?>

<html>
<head>
	<title>Alta Venta</title>
	<link rel="stylesheet" type="text/css" href="usiscom.css">
</head>

<body>
	<?php include 'cabecera.html';?>
	<?php include 'navegacion.html';?>
	<a href="AltaVenta.php">Ingresar más ventas</a>
	<?php include 'pie.html';?>
</body>

</html>