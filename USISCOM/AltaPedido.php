<?php
	
	if (isset($_POST['aPedido'])) {

		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'USISCOM';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		if (!$conn) {die('Could not connect: ' . mysql_error());}

		$nc_ped = $_POST['ncliPedido'];
		$it_ped = $_POST['icliPedido'];

		// INICIO CALC COSTO
		$idx=1; $article = 'art'.$idx; $cos_ped = 0.00; 

		if (isset($_COOKIE['cuenta'])) $lim = $_COOKIE['cuenta'];
		else $lim = 0;

		while ($idx <= $lim) {

			if (isset($_COOKIE[$article])) { $article = $_COOKIE[$article]; }
			else { $article = 0;}


			$sql = "SELECT Precio FROM Articulo WHERE (idArticulo = $article)";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$cos_ped = $cos_ped + $row['Precio'];
				}
			}
			$idx=$idx+1;
			$article = 'art'.$idx;
		}
		// FIN CALC COSTO


		// INICIO INGRESAR PEDIDO		
		$sql = "INSERT INTO Pedido (Nombre_cliente, Institucion_cliente, Fecha, Costo) VALUES('$nc_ped', '$it_ped', NOW(), $cos_ped)";

		if (mysqli_query($conn, $sql)) {
			$id_Pedido = mysqli_insert_id($conn);
		}
		// FIN INGRESAR PEDIDO

		// INICIO INGRESAR EN PEDIDO_ARTICULO
		$idx=1; $article = 'art'.$idx; 

		if (isset($_COOKIE['cuenta'])) $lim = $_COOKIE['cuenta'];
		else $lim = 0;

		while ($idx <= $lim) {

			if (isset($_COOKIE[$article])) { 
				$article = $_COOKIE[$article]; 

				$sql = "INSERT INTO Pedido_Articulo (idArticulo, idPedido, Cantidad) VALUES ($article, $id_Pedido, 1)";
				
				$retval = mysqli_query($conn, $sql);

				if (! $retval) {die('Could not enter data: ' . mysqli_error($conn));}	
			}
			$idx=$idx+1;
			$article = 'art'.$idx;
		}
		// FIN INGRESAR EN PEDIDO_ARTICULO

		// INICIO ADD TO VENTA
		$sql = "INSERT INTO Venta (Fecha_inicio, Estatus, idPedido) VALUES (NOW(), 0, $id_Pedido)";
		$retval = mysqli_query($conn, $sql);
		if (! $retval) {die('Could not enter data: ' . mysqli_error($conn));}
		// FIN ADD VENTA

		// INICIO DELETE COOKIES
			$idx=1; $article = 'art'.$idx; 
			
			if (isset($_COOKIE['cuenta'])) $lim = $_COOKIE['cuenta'];
			else $lim = 0;

			while ($idx <= $lim) {
				if (isset($_COOKIE[$article])) { 
					//$article = $_COOKIE[$article]; 
					setcookie($article, '', time()-3600);
				}
				$idx=$idx+1;
				$article = 'art'.$idx;
			}
			setcookie('cuenta', '', time()-3600);
		// FIN DELETE COOKIES

		//echo '<script type="text/javascript"> alert(document.cookies); </script>';
?>

<html>
<head>
	<title>Alta Pedido</title>
	<link rel="stylesheet" type="text/css" href="usiscom.css">
</head>

<body>

	<?php include 'cabecera.html'; ?>
	<?php include 'navegacion.html'; ?>

	<div id="content" class="content">
	<?php
		echo "<h2>Pedido Ingresado con exito</h2>";
		echo "<h2>EL ID DE TU PEDIDO ES : ".$id_Pedido."</h2>";
		echo "<h2>El coste es: $".$cos_ped."</h2>";
		mysqli_close($conn);
		}

	?>
	</div>
	
	<?php include 'pie.html'; ?>

</body>

</html>
