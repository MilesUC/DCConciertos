<?php
	ob_start();
	session_start();
?>

<?php
    require("../config/conexion.php");
    $msg = '';
    header("Location: index.php?msg=$msg");
    /* if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT username, contrasena, tipo FROM usuarios WHERE username = '$username';";

        $result = $db -> prepare($query);
        $result -> execute();
        $usuario_validar = $result -> fetchAll();

        if ($usuario_validar != []) {  
            if ($password == $usuario_validar[0][1]) {
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['tipo'] = $usuario_validar[0][2];
                $msg = "Sesión iniciada correctamente.";
                header("Location: ../index.php?msg=$msg");
            }
            else {
                $msg = "Contraseña incorrecta. Revisa el usuario y la contraseña<br>";
                header("Location: login.php?msg=$msg");
            }
        }
        else
        {
            $msg = "Usuario incorrecto. Revisa el usuario y la contraseña<br>";
            header("Location: login.php?msg=$msg");
        }
    }
    else{
        $msg = "Error 404";
        header("Location: login.php?msg=$msg");
    } */
?>
