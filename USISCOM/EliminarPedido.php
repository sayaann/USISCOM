<?php
	
	$flag = 0;

	if (isset($_POST['subEP'])) {

		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'USISCOM';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		if (!$conn) {die('Could not connect: ' . mysql_error());}

		$idpedido = $_POST['idpedido'];

		$sql2 = "SELECT Estatus FROM Venta WHERE idPedido = $idpedido";
		$result = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

					if ($row['Estatus'] == 0) {

						$sql = "DELETE FROM Venta WHERE idPedido = $idpedido ";
						$sql3 = "DELETE FROM Pedido_Articulo WHERE idPedido = $idpedido";
						$sql4 = "DELETE FROM Pedido WHERE idPedido = $idpedido";

						if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4)) {
							$flag=1;
						}
						else {
							$flag=2;
						}
					}
					else {
						$flag=3;
					}
				}
		}
		else {
			$flag=4;
		}
		mysqli_close($conn);
	}
?>

<html>
<head>
	<title>Eliminar Pedido</title>
	<link rel="stylesheet" type="text/css" href="usiscom.css" />
</head>

<body>

	<?php include 'cabecera.html';?>
	<?php include 'navegacion.html';?>

	<div id="content" class="content">
	<h1>Eliminar Pedido</h1>

	


	<form method="POST" action="" id="forma">
		<label>Codigo de Pedido:</label>
		<input type="number" name="idpedido" id="idpedido" />
		<input type="submit" name="subEP" id="subEP" />
	</form>

	<?php
		

		if ($flag==1){ echo "Eliminado con éxtio<br/>"; }
		if ($flag==2){ echo "No es posible eliminar<br/>"; }
		if ($flag==3){ echo "El pedido ha sido enviado, no es posible eliminar<br/>"; }
		if ($flag==4){ echo "No existe registro con ese ID<br/>"; }
	?>
	</div>

	<?php include 'pie.html';?>

</body>

</html>