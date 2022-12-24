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
            <label class="label">Nombre de usuario</label>
            <div class="control">
              <input class="input" type="text" placeholder="Ingresa usuario"name="username">
            </div>
          </div>
          <div class="field">
            <label class="label">Contraseña</label>
            <div class="control">
              <input class="input" type="password" placeholder="Ingresa contraseña" name="password">
            </div>
          </div>
          <button class="button is-primary" type="submit" formaction="login_validation.php" name="login">Login</button>
          <button class="button is-light" type="submit" formaction="../index.php" value="Volver">Volver</button>
        </form>
      </div>
    </div>
  </section>
