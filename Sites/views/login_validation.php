<?php
	ob_start();
	session_start();
?>

<?php
    require("../config/conexion.php");
    $msg = '';
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT username, contrasena, tipo FROM usuarios WHERE username = '$username';";
        //$val = $db->prepare("CALL validar_login($rut, $user_password)");
        /*$val -> execute();

        $rut = $_POST['username'];
        $user_password = $_POST['password'];
        $val = $db->prepare("CALL validar_login($rut, $user_password)");
        $val -> execute();
        $msg = "$val";
        if ($val)
        {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['tipo'] = $db->prepare("CALL get_tipo($rut, $user_password)");
            $_SESSION['tipo'] -> execute();
            $_SESSION['password'] = $_POST['password'];
            // $msg = "Sesión iniciada correctamente";
        }
        else{
            $msg = "No funciona";
        }

        header("Location: ../index.php?msg=$msg");
    }*/
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
                $_SESSION['fecha_inicio'] = "01/01/1000";
                $_SESSION['fecha_termino'] = "01/01/4000";
                
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
    }
?>
