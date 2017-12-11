<?php
	$dbhost = 'localhost:3306';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'USISCOM';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (!$conn) {die('Could not connect: ' . mysql_error());}

	$sql ="SELECT idArticulo, Nombre, Descripcion, Precio, Imagen FROM Articulo WHERE (Unidades > 0) ORDER BY Nombre DESC";
	$result = mysqli_query($conn, $sql);
?>

<html>
<head>
	<title>Catalogo</title>
	<script type="text/javascript" src="Galleta.js">
	</script>

</head>

<body>

	<h1>Catalogo</h1>

	<table border='1px'> 

		<?php
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";
					echo "<td>".$row['idArticulo']."</td>
						  <td>".$row['Nombre']."</td> 
						  <td>".$row['Descripcion']."</td> 
						  <td>".$row['Precio']."</td> 
						  <td> <img src='".$row['Imagen']."' /> </td>
						  <td> <input type='button' id='b".$row['idArticulo']."' value='Agregar' onclick='AddCookie(".$row['idArticulo'].")' /> </td>";
					echo "</tr>";

				}
			}
			else {
				echo "0 results";
			}

			mysqli_close($conn);
		?>

	</table>

</body>

</html>