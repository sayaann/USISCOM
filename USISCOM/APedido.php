<?php
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'USISCOM';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (!$conn) {die('Could not connect: ' . mysql_error());}
?>

<html>
<head>
	<title>Alta Pedido</title>
	<script type="text/javascript" src="Galleta.js">
	</script>
	<link rel="stylesheet" type="text/css" href="usiscom.css">
</head>

<body>
	
	<?php include 'cabecera.html';?>
	<?php include 'navegacion.html';?>

	<div id="content" class="content">
	<h1>Alta Pedido</h1>

	<form method="POST" action="AltaPedido.php">

		<label>Nombre cliente:</label>
		<input type="text" name="ncliPedido" id="ncliPedido" />
		<br />

		<label>Institucion cliente</label>
		<input type="text" name="icliPedido" id="icliPedido" />
		<br />

		<label>Pedido:</label>
		<br />
		<table border='1px'>
			<?php


				$idx=1;
				$article = 'art'.$idx;
				$total = 0.00;

				if (isset($_COOKIE['cuenta'])) $lim = $_COOKIE['cuenta'];
				else $lim = 0;

				while ($idx <= $lim) {

					if (isset($_COOKIE[$article])) { $article = $_COOKIE[$article]; }
					else { $article = 0;}


					$sql = "SELECT Nombre, Descripcion, Precio FROM Articulo WHERE (idArticulo = $article)";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {

							echo "<tr>";
							echo "<td>".$row['Nombre']."</td>
								  <td>".$row['Descripcion']."</td>
								  <td> <input type='button' value='Quitar' onclick='RemoveCookie(".$idx.")' /> </td>' ";
							echo "</tr>";
							$total = $total + $row['Precio'];
						}

						
						
					}
					$idx=$idx+1;
					$article = 'art'.$idx;
				}
			?>
		</table>

		<label>Total:</label>
		<?php echo "<input type='text' value='".$total."' readonly='true' />"; ?>
		<br />

		<input type="submit" name="aPedido" id="aPedido" />
	</form>
	</div>

	<?php include 'pie.html';?>

</body>

</html>