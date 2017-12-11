<?php

	//if (isset($_POST['busArticulo'])) {
		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'USISCOM';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		if (!$conn) {die('Could not connect: ' . mysql_error());}

		if (isset($_POST['busqueda'])) { $search = $_POST['busqueda']; }
		else {$search = '';}

		$sql ="SELECT idArticulo, Nombre, Descripcion, Precio, Imagen FROM Articulo WHERE (Unidades > 0 AND Nombre LIKE '%$search%')";
		$result = mysqli_query($conn, $sql);
?>


<html>
	<head>
		<title>Busqueda Articulos</title>
		<script type="text/javascript" src="Galleta.js">
		</script>
		<link rel="stylesheet" type="text/css" href="usiscom.css" />
	</head>

<body>

	<?php include 'cabecera.html';?>
	<?php include 'navegacion.html';?>

	<?php include 'BusquedaArticulo.html'; ?>

	<div id="content" class="content">
	<h1>Resultados de busqueda</h1>

	<table border="1px">

		<tr>
			<td>ID Articulo</td>
			<td>Nombre</td>
			<td>Descripcion</td>
			<td>Costo</td>
			<td>Imagen</td>
			<td>Agregar</td>
		</tr>

		<?php
		
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";
					echo "<td>".$row['idArticulo']."</td>
						  <td>".$row['Nombre']."</td> 
						  <td>".$row['Descripcion']."</td> 
						  <td>$".$row['Precio']."</td> 
						  <td>. <img src='".$row['Imagen']."' /> </td>
						  <td> <input type='button' id='b".$row['idArticulo']."' value='Agregar' onclick='AddCookie(".$row['idArticulo'].")' /> </td>";
					echo "</tr>";

				}
			}
			else {
				echo "0 results";
			}

			mysqli_close($conn);
		//}
		?>
	</table>
	</div>

	<?php include 'pie.html';?>

</body>

</html>