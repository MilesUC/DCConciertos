<?php session_start(); ?>


<?php 
    include('./templates/header.php'); 
?>

<section class="hero is-success is-medium">
  <div class="hero-body">
  <?php 
    if (isset($_SESSION['username']) && $_SESSION['tipo'] == "productora") {
      ?>
      <h1 class="title">Productoras</h1>
      <?php 
    }
    elseif (isset($_SESSION['username']) && $_SESSION['tipo'] == "artista"){
    ?>
    <h1 class="title">Artistas</h1>
    <?php 
    }
    else{
      ?>
      <h1 class="title">Bienvenido</h1>
      <?php
    }
    ?>
  </div>
</section>

<?php if (empty($fecha1)){
    $fecha1 = "01/01/1000";
    $fecha2 = "01/01/4000";
    } ?>


<section class="section">
  <?php if (isset($_SESSION['username'])) { ?>
    <?php $user = $_SESSION['username'] ?>
    <!-- Se muestra un mensaje si hay una sesión de usuario -->
    <h2 class="title is-1"> Hola <?php echo $_SESSION['tipo'] ?> <?php echo $_SESSION['username'] ?></h2>
    <!-- Aquí inicia la página para productoras -->
    <?php if ($_SESSION['tipo'] == "productora") { ?>
      <div class="columns"> 
        <div class="column has-text-left">
          <form class="buttons" action="./views/form.php">
            <input class="button is-primary" type="submit" value="Crear evento">
          </form>
          <form class="buttons" action="./views/logout.php">
            <input class="button is-danger" type="submit" value="Cerrar Sesión">
          </form>
        </div>
        <div class="column has-text-right is-3">
          <label class="label">Filtrar por fecha (DD-MM-YYYY):</label>
          <!-- https://bulma.io/documentation/form/general/ -->
          <form class="form-signin" role="form" action="views/filtrar.php" method="post">
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Desde: </label>
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input class="input" type="text" name="fecha1">
                  </div>
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Hasta: </label>
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input class="input" type="text" name="fecha2">
                  </div>
                </div>
              </div>
            </div>
            <button class="button is-primary-light" type="submit" name="login">Filtrar</button>
          </form>
          <br>
          <form class="form-signin" role="form" action="views/limpiar_filtro.php" method="post">
            <button class="button is-danger-light" type="submit" name="login">Limpiar filtro</button>
          </form>
        </div>
      </div>
      <div class="tile is-ancestor">
        <div class="container is-fluid">
          <div class="columns is-multiline">
            <!-- Eventos programados -->
            <div class="column is-half">
              <div class="tile is-parent">
                <div class="tile is-child box">
                  <h2 class="title">Eventos programados</h2>
                    <?php
                      require("./config/conexion.php");
                      $user = $_SESSION['username'];
                      $aux = str_replace("_", " ", $user);
                      $fecha1 = $_SESSION['fecha_inicio'];
                      $fecha2 = $_SESSION['fecha_termino']; 
                      $query = "SELECT evento, recinto, fecha_inicio FROM eventos WHERE LOWER(productora) = '$aux' AND fecha_inicio > TO_DATE('$fecha1', 'DD/MM/YYYY') AND fecha_inicio < TO_DATE('$fecha2', 'DD/MM/YYYY') ORDER BY fecha_inicio;";
                      $result = $db -> prepare($query);
                      $result -> execute();
                      $data = $result -> fetchAll();
                    ?>
                  <div class='container has-text-centered'>
	                  <div class='columns is-mobile is-centered'>
	                    <div class='column is-11'>
		                    <table class='table is-bordered has-background-light'>
                          <colgroup>
                            <col span="1" style="width: 50%;">
                            <col span="1" style="width: 35%;">
                            <col span="1" style="width: 35%;">
                          </colgroup>
		                      <thead>
                            <tr>
                              <th>Nombre evento</th>
                              <th>Recinto</th>
                              <th>Fecha de inicio</th>
                            </tr>
		                      </thead>
		                      <tbody>
                            <?php
                              foreach ($data as $usuario) {
                                echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> <td>$usuario[2]</td> </tr>";
                              }
                            ?>
                          </tbody>
		                    </table>
	                    </div>
	                  </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Eventos aprobados -->
            <div class="column is-half">
              <div class="tile is-parent">
                <div class="tile is-child box">
                  <h2 class="title">Eventos aprobados</h2>
                  <?php
                    require("./config/conexion.php");
                    $user = $_SESSION['username'];
                    $aux = str_replace("_", " ", $user);
                    $fecha1 = $_SESSION['fecha_inicio'];
                    $fecha2 = $_SESSION['fecha_termino']; 
                    $query = "SELECT nombre, MIN(recinto), MIN(fecha_inicio) FROM nuevos_eventos GROUP BY productora, nombre HAVING LOWER(productora) = '$aux' AND COUNT(case when aprobado = 1 then 1 else null end) = COUNT(case when productora = '$aux' then 1 else null end) AND MIN(fecha_inicio) > TO_DATE('$fecha1', 'DD/MM/YYYY') AND MIN(fecha_inicio) < TO_DATE('$fecha2', 'DD/MM/YYYY') ORDER BY MIN(fecha_inicio);";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $data = $result -> fetchAll();
                  ?>
                  <div class='container has-text-centered'>
                    <div class='columns is-mobile is-centered'>
                      <div class='column is-11'>
                        <table class='table is-bordered has-background-light'>
                          <colgroup>
                            <col span="1" style="width: 50%;">
                            <col span="1" style="width: 35%;">
                            <col span="1" style="width: 35%;">
                          </colgroup>
                          <thead>
                            <tr>
                              <th>Nombre evento</th>
                              <th>Recinto</th>
                              <th>Fecha de inicio</th>
                            </tr>
                          </thead>
	                        <tbody>
                            <?php
                              foreach ($data as $usuario) {
                                echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> <td>$usuario[2]</td> </tr>";
                              }
                            ?>
                          </tbody>
                        </table>
	                    </div>
	                  </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Eventos rechazados -->
            <div class="column is-half">
              <div class="tile is-parent">
                <div class="tile is-child box">
                  <h2 class="title">Eventos rechazados</h2>
                  <?php
                    require("./config/conexion.php");
                    $user = $_SESSION['username'];
                    $aux = str_replace("_", " ", $user);
                    $fecha1 = $_SESSION['fecha_inicio'];
                    $fecha2 = $_SESSION['fecha_termino']; 
                    $query = "SELECT nombre, MIN(recinto), MIN(fecha_inicio) FROM nuevos_eventos GROUP BY productora, nombre HAVING LOWER(productora) = '$aux' AND COUNT(case when aprobado = -1 then 1 else null end) > 0 AND MIN(fecha_inicio) > TO_DATE('$fecha1', 'DD/MM/YYYY') AND MIN(fecha_inicio) < TO_DATE('$fecha2', 'DD/MM/YYYY') ORDER BY MIN(fecha_inicio);";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $data = $result -> fetchAll();
                  ?>
                  <div class='container has-text-centered'>
	                  <div class='columns is-mobile is-centered'>
	                    <div class='column is-11'>
	                      <table class='table is-bordered has-background-light'>
                          <colgroup>
                            <col span="1" style="width: 50%;">
                            <col span="1" style="width: 35%;">
                            <col span="1" style="width: 35%;">
                          </colgroup>
	                        <thead>
                            <tr>
                              <th>Nombre evento</th>
                              <th>Recinto</th>
                              <th>Fecha de inicio</th>
                            </tr>
		                      </thead>
		                      <tbody>
                            <?php
                              foreach ($data as $usuario) {
                                echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> <td>$usuario[2]</td> </tr>";
                              }
                            ?>
                          </tbody>
		                    </table>
	                    </div>
	                  </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Eventos pendientes -->
            <div class="column is-half">
              <div class="tile is-parent">
                <div class="tile is-child box">
                  <h2 class="title">Eventos pendientes de aprobación</h2>
                  <?php
                    require("./config/conexion.php");
                    $user = $_SESSION['username'];
                    $aux = str_replace("_", " ", $user);
                    $fecha1 = $_SESSION['fecha_inicio'];
                    $fecha2 = $_SESSION['fecha_termino']; 
                    $query = "SELECT nombre, MIN(recinto), MIN(fecha_inicio) FROM nuevos_eventos GROUP BY productora, nombre HAVING LOWER(productora) = '$aux' AND COUNT(case when aprobado = 1 then 1 else null end) < COUNT(case when productora = '$aux' then 1 else null end) AND COUNT(case when aprobado = -1 then 1 else null end) = 0 AND MIN(fecha_inicio) > TO_DATE('$fecha1', 'DD/MM/YYYY') AND MIN(fecha_inicio) < TO_DATE('$fecha2', 'DD/MM/YYYY') ORDER BY MIN(fecha_inicio);";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $data = $result -> fetchAll();
                  ?>
                  <div class='container has-text-centered'>
                    <div class='columns is-mobile is-centered'>
                      <div class='column is-11'>
		                    <table class='table is-bordered has-background-light'>
                          <colgroup>
                            <col span="1" style="width: 50%;">
                            <col span="1" style="width: 35%;">
                            <col span="1" style="width: 35%;">
                          </colgroup>
		                      <thead>
                            <tr>
                              <th>Nombre evento</th>
                              <th>Recinto</th>
                              <th>Fecha de inicio</th>
                            </tr>
		                      </thead>
		                      <tbody>
                            <?php
                              foreach ($data as $usuario) {
                                echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> <td>$usuario[2]</td> </tr>";
                              }
                            ?>
                          </tbody>
		                    </table>
	                    </div>
	                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Aquí inicia la página para artistas -->
    <?php } else { ?>
      <form class="buttons" action="./views/logout.php">
        <input class="button is-danger" type="submit" value="Cerrar Sesión">
      </form>
      <div class="tile is-ancestor">
        <div class="container is-fluid">
          <div class="columns is-multiline">
            <!-- Eventos programados -->
            <div class="column is-half">
              <div class="tile is-parent">
                <div class="tile is-child box">
                  <h2 class="title">Eventos programados</h2>
                    <?php
                      require("./config/conexion.php");
                      $user = $_SESSION['username'];
                      $aux = str_replace("_", " ", $user);
                      $fecha1 = $_SESSION['fecha_inicio'];
                      $fecha2 = $_SESSION['fecha_termino']; 
                      $query = "SELECT consulta.evento, consulta.recinto, consulta.fecha_inicio, tour.nombre FROM tour RIGHT JOIN 
                      (SELECT eventos.evento, eventos.recinto, eventos.fecha_inicio FROM eventos 
                      JOIN eventos_artistas ON eventos.evento = eventos_artistas.evento WHERE LOWER(eventos_artistas.artista) = '$aux' 
                      ORDER BY fecha_inicio) AS consulta ON tour.nombre = consulta.evento;";
                      $result = $db -> prepare($query);
                      $result -> execute();
                      $data = $result -> fetchAll();
                    ?>
                    <?php
                      require("./config/conexion.php");
                      $user = $_SESSION['username'];
                      $aux = str_replace("_", " ", $user);
                      $fecha1 = $_SESSION['fecha_inicio'];
                      $fecha2 = $_SESSION['fecha_termino']; 
                      $query2 = "SELECT consulta.nombre, consulta.recinto, consulta.fecha_inicio, tour.nombre FROM tour RIGHT JOIN 
                        (SELECT DISTINCT nuevos_eventos.nombre, nuevos_eventos.recinto, nuevos_eventos.fecha_inicio FROM nuevos_eventos,
                        (SELECT nombre, productora, fecha_inicio FROM nuevos_eventos GROUP BY productora, nombre, fecha_inicio
                         HAVING COUNT(case when aprobado = 1 then 1 else null end) = COUNT(artista)) AS e_a WHERE 
                         LOWER(nuevos_eventos.artista) = '$aux' AND nuevos_eventos.nombre = e_a.nombre AND nuevos_eventos.productora = e_a.productora AND 
                         nuevos_eventos.fecha_inicio = e_a.fecha_inicio) AS consulta ON tour.nombre = consulta.nombre;";

                      $result2 = $db -> prepare($query2);
                      $result2 -> execute();
                      $data2 = $result2 -> fetchAll();
                    ?>
                  <div class='container has-text-centered'>
	                  <div class='columns is-mobile is-centered'>
	                    <div class='column is-12'>
		                    <table class='table is-bordered has-background-light'>
                          <colgroup>
                          <col span="1" style="width: 30%;">
                            <col span="1" style="width: 40%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 30%;">
                          </colgroup>
		                      <thead>
                            <tr>
                              <th>Nombre evento</th>
                              <th>Recinto</th>
                              <th>Fecha de inicio</th>
                              <th>Tour</th>
                            </tr>
		                      </thead>
		                      <tbody>
                            <?php
                              foreach ($data as $usuario) {
                                if (empty($usuario[3])){
                                  echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> <td>$usuario[2]</td> <td>No disp</td> </tr>";
                                }
                                else{
                                  echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> <td>$usuario[2]</td> <td>$usuario[3]</td> </tr>";
                                }
                              }
                              ?>
                            <?php
                              foreach ($data2 as $usuario) {
                                if (empty($usuario[3])){
                                  echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> <td>$usuario[2]</td> <td>No disp</td> </tr>";
                                }
                                else{
                                  echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> <td>$usuario[2]</td> <td>$usuario[3]</td> </tr>";
                                }
                              }
                              ?>
                          </tbody>
		                    </table>
	                    </div>
	                  </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Hospedajes -->
            <div class="column is-half">
              <div class="tile is-parent">
                <div class="tile is-child box">
                  <h2 class="title">Hospedajes</h2>
                  <?php                
                    require("./config/conexion.php");
                    $user = $_SESSION['username'];
                    $aux = str_replace("_", " ", $user);
                    $query = "SELECT nombre_hotel, tipo_traslado FROM hospedajes_y_traslados WHERE LOWER(artista) = '$aux';";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $data = $result -> fetchAll();
                  ?>
                  <div class='container has-text-centered'>
                    <div class='columns is-mobile is-centered'>
                      <div class='column is-8'>
                        <table class='table is-bordered has-background-light'>
                          <colgroup>
                            <col span="1" style="width: 80%;">
                            <col span="1" style="width: 50%;">
                          </colgroup>
                          <thead>
                            <tr>                          
                              <th>Hotel</th>
                              <th>Traslado</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              foreach ($data as $evento) {
                                echo "<tr> <td>$evento[0]</td> <td>$evento[1]</td> </tr>";
                              }
                            ?>
                          </tbody>
                        </table>	                
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Artistas en Tour -->
            <div class="column is-half">
              <div class="tile is-parent">
                <div class="tile is-child box">
                  <h2 class="title">Otros artistas en eventos</h2>
                  <?php                
                    require("./config/conexion.php");
                    $user = $_SESSION['username'];
                    $aux = str_replace("_", " ", $user);
                    $query = "SELECT eventos_artistas.artista, eventos_artistas.evento FROM eventos_artistas JOIN (SELECT * FROM eventos_artistas WHERE LOWER(artista) = '$aux') AS artist ON eventos_artistas.evento = artist.evento WHERE LOWER(eventos_artistas.artista) != '$aux';";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $data1 = $result -> fetchAll();
                  ?>
                  <?php                
                    require("./config/conexion.php");
                    $user = $_SESSION['username'];
                    $aux = str_replace("_", " ", $user);
                    $query = "SELECT e.artista, e.nombre, e.fecha_inicio FROM nuevos_eventos AS e, (SELECT nuevos_eventos.nombre, nuevos_eventos.fecha_inicio FROM nuevos_eventos, (SELECT nombre, fecha_inicio FROM nuevos_eventos GROUP BY productora, nombre, fecha_inicio HAVING COUNT(case when aprobado = 1 then 1 else null end) = COUNT(artista)) AS e_a WHERE LOWER(nuevos_eventos.artista) = '$aux' AND nuevos_eventos.nombre = e_a.nombre AND nuevos_eventos.fecha_inicio = e_a.fecha_inicio) AS e_a_a WHERE e.nombre = e_a_a.nombre AND e.fecha_inicio = e_a_a.fecha_inicio AND e.artista != '$aux' ORDER BY e_a_a.fecha_inicio;";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $data2 = $result -> fetchAll();
                    ?>
                  <div class='container has-text-centered'>
                    <div class='columns is-mobile is-centered'>
                      <div class='column is-8'>
                        <table class='table is-bordered has-background-light'>
                          <colgroup>
                          <col span="1" style="width: 60%;">
                          <col span="1" style="width: 80%;">
                        </colgroup>
                          <thead>
                            <tr>                          
                              <th>Artista</th>
                              <th>Evento</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              foreach ($data1 as $evento) {
                                echo "<tr> <td>$evento[0]</td> <td>$evento[1]</td> </tr>";
                              }
                              ?>
                            <?php
                              foreach ($data2 as $evento) {
                                echo "<tr> <td>$evento[0]</td> <td>$evento[1]</td> </tr>";
                              }
                            ?>
                          </tbody>
                        </table>	                
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Entradas de cortesía -->
            <div class="column is-half">
              <div class="tile is-parent">
                <div class="tile is-child box">
                  <h2 class="title">Entradas de cortesía</h2>
                  <?php                
                    require("./config/conexion.php");
                    $user = $_SESSION['username'];
                    $aux = str_replace("_", " ", $user);
                    $query = "SELECT entradas_cortesia.evento, entradas_cortesia.asiento, f.categoria
                    FROM entradas_cortesia LEFT JOIN public.dblink('dbname=grupo22e3
                              port=5432
                              password=grupo22
                              user=grupo22',
                              'SELECT * FROM entradas')
                              AS f(id_entrada int, nombre_evento varchar, categoria varchar, asiento varchar, tipo varchar)
                              ON entradas_cortesia.evento = f.nombre_evento AND entradas_cortesia.asiento = f.asiento
                    WHERE LOWER(entradas_cortesia.artista) like '$aux';";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $data = $result -> fetchAll();
                  ?>
                  <div class='container has-text-centered'>
                    <div class='columns is-mobile is-centered'>
                      <div class='column is-8'>
                        <table class='table is-bordered has-background-light'>
                          <colgroup>
                            <col span="1" style="width: 60%;">
                            <col span="1" style="width: 35%;">
                            <col span="1" style="width: 35%;">
                          </colgroup>
                          <thead>
                            <tr>                          
                              <th>Evento</th>
                              <th>Asiento</th>
                              <th>Categoría</th>
                            </tr>
                          </thead>
                          <tbody> 
                      
                            <?php
                              foreach ($data as $evento) {
                                if (empty($evento[2])){
                                  echo "<tr> <td>$evento[0]</td> <td>$evento[1]</td> <td>No disp</td> </tr>";
                                }
                                else{
                                  echo "<tr> <td>$evento[0]</td> <td>$evento[1]</td> <td>$evento[2]</td> </tr>";
                                }
                              }
                            ?>
                          </tbody>
                        </table>	                
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Eventos por ver -->
            <div class="column is-half">
              <div class="tile is-parent">
                <div class="tile is-child box">
                  <h2 class="title">Eventos por ver</h2>
                  <?php                
                    require("./config/conexion.php");
                    $user = $_SESSION['username'];
                    $aux = str_replace("_", " ", $user);
                    $query = "SELECT id, nombre, recinto, productora, fecha_inicio, fecha_termino FROM nuevos_eventos WHERE aprobado = 0 AND LOWER(artista) like '$aux' ORDER BY fecha_inicio;";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $data = $result -> fetchAll();
                  ?>
                  <div class='container has-text-centered'>
                    <div class='columns is-mobile is-centered'>
                      <div class='column is-11'>
                        <table class='table is-bordered has-background-light'>
                          <colgroup>
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 40%;">
                            <col span="1" style="width: 30%;">
                            <col span="1" style="width: 25%;">
                            <col span="1" style="width: 20%;">
                          </colgroup>
                          <thead>
                            <tr>                          
                              <th>Id evento</th>
                              <th>Nombre evento</th>
                              <th>Recinto</th>
                              <th>Productora</th>
                              <th>Fecha_inicio</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              foreach ($data as $evento) {
                                echo "<tr> <td>$evento[0]</td> <td>$evento[1]</td> <td>$evento[2]</td> <td>$evento[3]</td><td>$evento[4]</td></tr>";
                              }
                            ?>
                          </tbody>
                        </table>	                
                      </div>
                    </div>
                  </div>
                  <br>
                  <form class="form-signin" role="form" method="post">
                    <div class="field">
                      <label class="label">Selecionar evento</label>
                      <select class="select" name="id_evento" style="width:200px">
                        <option selected>Seleccione un evento</option>
                        <?php
                          #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
                          foreach ($data as $d) {
                            echo "<option value=$d[0]>$d[0] $d[1]</option>";
                          }
                        ?>
                      </select>
                    </div>
                    <div class="field is-grouped-left">
                      <button class="button is-primary" type="submit" formaction="./consultas/aceptar_evento.php">Aceptar</button>
                      <button class="button is-danger" type="submit" formaction="./consultas/rechazar_evento.php">Rechazar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="column is-half">
              <div class="tile is-parent">
                <div class="tile is-child box">
                  <h2 class="title">Condiciones ambientales</h2>
                  <?php
                    if (isset($_GET['ciudad'])){
                      $ciudad = $_GET['ciudad'];

                      $curl = curl_init();

                      curl_setopt_array($curl, [
                        CURLOPT_URL => "https://visual-crossing-weather.p.rapidapi.com/forecast?aggregateHours=24&location=".$ciudad. "%2CDC%2CUSA&contentType=json&unitGroup=us&shortColumnNames=0",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => [
                          "X-RapidAPI-Host: visual-crossing-weather.p.rapidapi.com",
                          "X-RapidAPI-Key: 4e7b68c07amsh5bcab0e32768832p172629jsn875f54b8e1dc"
                        ],
                      ]);

                      $response = curl_exec($curl);
                      $temperatura = substr($response, strpos($response, 'temp', 2280) + 6, 4);
                      $humedad = substr($response, strpos($response, 'humidity', 2280) + 10, 4);
                      $viento = substr($response, strpos($response, 'wdir', 2280) + 6, 5);
                      $err = curl_error($curl);

                      curl_close($curl);
                    }
                  ?>
                  <div class='container has-text-centered'>
                    <div class='columns is-mobile is-centered'>
                      <div class='column is-11'>
                        <table class='table is-bordered has-background-light'>
                          <colgroup>
                          <col span="1" style="width: 40%;">
                          <col span="1" style="width: 15%;">
                          <col span="1" style="width: 30%;">
                          <col span="1" style="width: 25%;">
                          </colgroup>
                          <thead>
                            <tr>                          
                            <th>Ciudad</th>
                            <th>Temperatura (°F)</th>
                            <th>Humedad</th>
                            <th>Dirección del viento (°)</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            if (isset($_GET['ciudad'])){
                              echo "<tr> <td>$ciudad</td> <td>$temperatura</td> <td>$humedad</td> <td>$viento</td> </tr>";
                            }
                          ?>
                          </tbody>
                        </table>	                
                      </div>
                    </div>
                  </div>
                  <br>
                  <form class="form-signin" role="form" method="get">
                    <div class="field">
                    <label for="ciudad">Ver condiciones ambientales de la ciudad: </label>
                    <input type="text" name="ciudad" value="">
                    </div>
                    <div class="field is-grouped-left">
                      <button class="button is-primary" type="submit" name="button">Ver</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  <?php }} else { ?>
    <!-- En el caso que no, se muestran los botones para iniciar sesión -->
    <?php
    $fecha1 = "01/01/1000";
    $fecha2 = "01/01/4000";
    ?>
    <div class="buttons">
        <a href="./views/login.php" class="button is-primary">
          Iniciar sesión 
        </a>
        <form class="buttons" action="./consultas/importar_usuarios.php">
          <input class="button" type="submit" value="Importar Usuarios">
        </form>
    </div>
  <?php } ?>

</section>

<?php include('./templates/footer.php'); ?>


