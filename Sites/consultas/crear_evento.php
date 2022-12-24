<?php session_start(); ?>
<?php include('../templates/header.php') ?>

  <?php
      require("../config/conexion.php");
	  $evento = $_POST["evento"];
  	  $artista = $_POST["artista"];
	  $artistas = explode(",", $artista);
	  $recinto = $_POST["recinto"];
	  $productora = $_SESSION['username'];
	  $p = str_replace("_", " ", $productora);
	  $fecha_inicio = $_POST["fecha_inicio"];
	  $fecha_termino = $_POST["fecha_termino"];
	  $count = 0;
	  foreach ($artistas as $a) {
	    $b = str_replace("_", " ", $a);
		$q = "SELECT * FROM crear_evento('$evento', '$b', '$recinto', '$p', '$fecha_inicio', '$fecha_termino');";
		$r = $db -> prepare($q);
		$r -> execute();
		$d = $r -> fetchAll();
		$count = $count + 1;
 	  }

	  $query = "SELECT * FROM nuevos_eventos ORDER BY id DESC LIMIT '$count';";
      $result = $db -> prepare($query);
      $result -> execute();
      $data = $result -> fetchAll();
    ?>


<!DOCTYPE html>
<html>

<head>
  <title>Evento creado</title>
  <link rel='stylesheet' href=
  'https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css'>
  <!-- custom css -->
  <style>
	div.columns {
	  margin-top: 50px;
	}

	.table td {
	  font-size: 17px
	}

	.table th {
	  font-size: 17px
	}
  </style>
</head>

<body>
  <div class='container has-text-centered'>
    <div class='columns is-mobile is-centered'>
	  <div class='column is-5'>
	    <div>
		  <h1 class='title'>Evento creado</h1>
		  <hr>
		</div>
		<table class='table is-bordered has-background-light'>
		  <thead>
            <tr>
        	  <th>Nombre</th>
        	  <th>Artista</th>
			  <th>Recinto</th>
			  <th>Productora</th>
			  <th>Fecha de inicio</th>
			  <th>Fecha de termino</th>
        	</tr>
		  </thead>
		  <tbody>
            <?php
          	  foreach ($data as $evento) {
                echo "<tr> <td>$evento[1]</td> <td>$evento[2]</td> <td>$evento[3]</td> <td>$evento[4]</td> <td>$evento[5]</td> <td>$evento[6]</td> </tr>";
			}
            ?>
          </tbody>
		</table>
		<br>
		<form align="center" class="buttons" action="../index.php" method="get">
			<input type="submit" class="button" value="Volver">
				</input>
		</form>
	  </div>
	</div>
  </div>

  <br>

</body>

</html>


<?php include('../templates/footer.php') ?>