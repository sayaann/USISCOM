<?php
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'USISCOM';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (!$conn) {die('Could not connect: ' . mysql_error());}

	if(isset($_POST['nrep'])) {$repartidor = $_POST['nrep'];}
	else {$repartidor = 'NO'; }
	
?>

<html>
<head>
	<title>Repartidor</title>
	<link rel="stylesheet" type="text/css" href="usiscom.css" />
</head>

<body>

	<?php include 'cabecera.html';?>
	<?php include 'navegacion.html';?>

	<div id="content" class="content">
	<h1>Pedidos a repartir</h1>

	<form method ="POST" action="FinVenta.php">
		<label>ID VENTA:</label>
		<input type="number" name="idV" id="idV" />
		<input type="submit" name="subR" id="subR" />
	</form>

	<table border='1px'>

		<tr>
			<td>ID Venta</td>
			<td>Fecha Inicio</td>
			<td>Cliente</td>
			<td>Insititucion</td>
			<td>Pedido</td>
			<td>Costo</td>
		</tr>

		<?php

			$sql = "SELECT idVenta, idPedido, Fecha_inicio, Nombre_cliente, Institucion_cliente, Costo FROM Venta NATURAL JOIN Pedido WHERE (Estatus = 1) AND (Repartidor = '$repartidor')";

			$result = mysqli_query($conn, $sql);

			//echo $result;

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";

						echo "<td>".$row['idVenta']."</td>
							  <td>".$row['Fecha_inicio']."</td>
							  <td>".$row['Nombre_cliente']."</td>
							  <td>".$row['Institucion_cliente']."</td>";

						$idp = $row['idPedido'];
						echo "<td>";
								$sql2 = "SELECT Nombre FROM Pedido_Articulo NATURAL JOIN Articulo WHERE (idPedido = $idp)";
								$res2 = mysqli_query($conn, $sql2);

								if (mysqli_num_rows($res2) > 0) {
									echo "<ul>";
									while ($r2 = mysqli_fetch_assoc($res2)) {
											echo "<li>".$r2['Nombre']."</li>";
									}
									echo "</ul>";
								}
						echo "</td>";

						echo "<td>".$row['Costo']."</td";

					echo "</tr>";

				}
			}
			else {
				echo "0 Results";
			}
			mysqli_close($conn);
		?>

	</table>
	</div>

	<?php include 'pie.html';?>

</body>

</html>