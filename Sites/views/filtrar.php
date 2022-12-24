<?php
	ob_start();
	session_start();
?>

<?php
    require("../config/conexion.php");
    $msg = '';
    if (!empty($_POST['fecha1'])){
        $_SESSION['fecha_inicio']  = $_POST['fecha1'];
    }
    if (!empty($_POST['fecha2'])){
        $_SESSION['fecha_termino'] = $_POST['fecha2'];
    }
    header("Location: ../index.php?msg=$msg");
?>

