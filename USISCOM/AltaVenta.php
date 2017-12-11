<?php
	
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'USISCOM';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (!$conn) {die('Could not connect: ' . mysql_error());}

	//function AVenta ($id_venta) {}

?>

<html>
<head>
	<title>Alta Venta</title>
	<link rel="stylesheet" type="text/css" href="usiscom.css">
</head>

<body>

	<?php include 'cabecera.html';?>
	<?php include 'navegacion.html';?>

	<div id="content" class="content">
	<h1>Alta Venta</h1>

	<form method="POST" action="AVenta.php">

		<label>ID Venta:</label>
		<input type="text" name="idVenta" id="idVenta" />
		<br/>

		<label>Repartidor:</label>
		<input type="text" name="repVenta" id="repVenta" />
		<br/>

		<input type="submit" name="subVenta" id="subVenta" />

	</form>


	<table border='1px'>

		<tr>
			<td>ID Venta</td>
			<td>Fecha de Inicio</td>
			<td>Pedido</td>
			<td>Costo</td>
		</tr>

		<?php


			$sql = "SELECT idVenta, Fecha_inicio, Costo, idPedido FROM Venta NATURAL JOIN Pedido WHERE (Estatus = 0)";
			$result = mysqli_query($conn, $sql);

			//echo $result;

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					
					echo "<tr>";

						echo "<td>".$row['idVenta']."</td>
							  <td>".$row['Fecha_inicio']."</td>";
							  //<td>PENDIENTE</td>

						echo "<td>";
							  	$idp = $row['idPedido'];
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

						echo "<td>".$row['Costo']."</td>";



					echo "</tr>";

				}
			}
			else {echo "0 results";}

			mysqli_close($conn);
		?>

	</table>
	</div>

	<?php include 'pie.html';?>

</body>

</html>