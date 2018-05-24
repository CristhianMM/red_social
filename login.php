<?php
require __DIR__ . '/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (User::login($_REQUEST['login'], $_REQUEST['pass'])) {
        header('location: /');
    } else {
        $result = 'Error de usuario o contraseña';
    }
}
?>

<html>
<header>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</header>
<body>
<div style="text-align: center">
    <form action="" method="post">
        <div><b><?= $result; ?></b></div>
        <div><label for="login">Usuario:</label><input name="login" id="login" type="text" required></div>
        <div><label for="pass">Contraseña:</label><input name="pass" id="pass" type="password" required></div>
        <div>
            <a href="/register.php">
                <input type="button" value="Registrar">
            </a>
            <input type="submit" value="Acceder">
        </div>
    </form>
</div>
</body>
</html>