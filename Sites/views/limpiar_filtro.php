<?php
	ob_start();
	session_start();
?>

<?php
    $_SESSION['fecha_inicio'] = "01/01/1000";
    $_SESSION['fecha_termino']  = "01/01/4000";
    header("Location: ../index.php?msg=$msg");
?>