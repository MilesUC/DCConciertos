<?php include('../templates/header.php') ?>

    <?php
        require("../config/conexion.php");
        $f = "SELECT * FROM importar_usuarios();";
        $imp = $db -> prepare($f);
        $imp -> execute();
        $d = $imp -> fetchAll();

        $query = "SELECT * FROM usuarios;";
        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
    ?>


<!DOCTYPE html>
<html>

<head>
  <title>Usuarios Importados</title>
</head>

<body>
<div class='container has-text-centered'>
	<div class='columns is-mobile is-centered'>
	  <div class='column is-three-fifths'>
		  <div>
		    <h1 class='title'>Usuarios importados</h1>
		    <hr>
		  </div>
      <div class='container has-text-centered'>
		    <table class='table is-bordered has-background-light'>
          <colgroup>
            <col span="1" style="width: 90%;">
            <col span="1" style="width: 40%;">
          </colgroup>
		      <thead>
            <tr>
              <th>Número</th>
              <th>Nombre</th>
              <th>Tipo</th>
            </tr>
		      </thead>
		      <tbody>
            <?php
              foreach ($data as $usuario) {
                echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> <td>$usuario[3]</td> </tr>";
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