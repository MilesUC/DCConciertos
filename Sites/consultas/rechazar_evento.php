<?php include('../templates/header.php') ?>

    <?php
        require("../config/conexion.php");

        $id_evento = $_POST['id_evento'];
        $f = "SELECT * FROM rechazar_evento('$id_evento');";
        $imp = $db -> prepare($f);
        $imp -> execute();
        $d = $imp -> fetchAll();

        $query = "SELECT * FROM nuevos_eventos WHERE id = '$id_evento';";
        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
    ?>


<!DOCTYPE html>
<html>

<head>
<title>Evento</title>

</head>

<body>
<div class='container has-text-centered'>
	<div class='columns is-mobile is-centered'>
	  <div class='column is-three-fifths'>
		  <div>
		    <h1 class='title'>Evento</h1>
		    <hr>
		  </div>
      <div class='container has-text-centered'>
		    <table class='table is-bordered has-background-success-light'>
          <colgroup>
            <col span="1" style="width: 80%;">
            <col span="1" style="width: 20%;">
          </colgroup>
		      <thead>
            <tr>
              <th>Nombre</th>
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
      </div>
      <br>
      <br>
      <div class='container has-text-centered'>
        <form align="center" class="buttons" action="../index.php" method="get">
          <input align="center" type="submit" class="button" value="Volver">
          </input>
        </form>
        <br>
      </div>
	  </div>
	</div>
</div>


</body>

</html>


<?php include('../templates/footer.php') ?>