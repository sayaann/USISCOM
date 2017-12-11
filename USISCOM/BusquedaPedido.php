<?php

	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'USISCOM';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (!$conn) {die('Could not connect: ' . mysql_error());}

	if (isset($_POST['idpedido'])) $idpedido = $_POST['idpedido'];
	else $idpedido = 0;


?>

<html>
<head>
	<title>Buscar Pedido</title>
	<link rel="stylesheet" type="text/css" href="usiscom.css" />
</head>

<body>

	<?php include 'cabecera.html';?>
	<?php include 'navegacion.html';?>

	<?php include 'BusPedido.html'; ?>
	
	<div id="content" class="content">
	<h1>Buscar Pedido</h1>

	<?php

		$sql = "SELECT Nombre_cliente, Institucion_cliente, Fecha, Costo FROM Pedido Where idPedido = $idpedido";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<p> Nombre del cliente: ".$row['Nombre_cliente']."<br/>
					  Insitición del cliente: ".$row['Institucion_cliente']."<br/>
					  Fecha de peticion: ".$row['Fecha']."<br />
					  Costo del pedido: ".$row['Costo']."
					  </p>";
			}
		}
		else {
			echo "<p>Pedido no encontrado</p>";
		}

		$sql = "SELECT Nombre, Descripcion FROM Pedido_Articulo NATURAL JOIN Articulo Where idPedido = $idpedido";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<p> Articulo: ".$row['Nombre']."<br/>
					  Descripcion del Articulo: ".$row['Descripcion']."
					  </p>";
			}
		}

		$sql = "SELECT Fecha_fin, Repartidor, Estatus FROM Venta Where idPedido = $idpedido";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {

				$stat = $row['Estatus'];
				if ($stat == 0) $stat = 'Pedido en proceso';
				else if ($stat == 1) $stat = 'Pedido enviado';
				else if ($stat == 2) $stat = 'Pedido entregado';


				echo "<p> Fecha de fin: ".$row['Fecha_fin']."<br/>
					  Repartidor: ".$row['Repartidor']."<br/>
					  Estatus: ".$stat."
					  </p>";
			}
		}

		mysqli_close($conn);
	?>
	</div>
	

	<?php include 'pie.html';?>

</body>

</html>