<?php
	session_start();
	if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    } else {
        $msg = '';
    }
?>

<?php include('../templates/header.php'); ?>

<div class="notification is-danger is-light">
  <button class="delete"></button>
  <strong> <?php echo "$msg"; ?> </strong>
</div>

<section class="section">
    <div class="columns is-mobile is-centered is-vcentered cover-all">
      <div class="column is-half">
        <!-- https://bulma.io/documentation/form/general/ -->
        <form class="form-signin" role="form" method="post">
          <div class="field">
            <label class="label">Nombre de evento</label>
            <div class="control">
              <input class="input" type="text" name="evento">
            </div>
          </div>
          <div class="field">
            <label class="label">Artistas (Separar por comas)</label>
            <div class="control">
              <input class="input" type="text" name="artista">
            </div>
          </div>
          <div class="field">
            <label class="label">Recinto</label>
            <div class="control">
              <input class="input" type="text" name="recinto">
            </div>
          </div>
          <div class="field">
            <label class="label">Fecha de inicio (DD-MM-AAAA)</label>
            <div class="control">
              <input class="input" type="text" name="fecha_inicio">
            </div>
          </div>
          <div class="field">
            <label class="label">Fecha de termino (DD-MM-AAAA)</label>
            <div class="control">
              <input class="input" type="text" name="fecha_termino">
            </div>
          </div>

          <button class="button is-primary" type="submit" formaction="../consultas/crear_evento.php" name="crear">Crear Evento</button>
          <button class="button is-light" type="submit" formaction="../index.php" value="Volver">Volver</button>
        </form>
      </div>
    </div>
  </section>
