<?php
require __DIR__ . '/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (User::exist($_REQUEST['login'])) {
        $result = 'Este usuario ya existe';
    } else if ($_REQUEST['pass'] !== $_REQUEST['pass_re']) {
        $result = 'La contraseña no coincide';
    } else {
        if (User::create($_REQUEST)) {
            $result = 'Usuario creado exitosamente';
        } else {
            $result = 'Error al crear el usuario';
        }
    }
}
?>

<html>
<header>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regitrarse</title>
</header>
<body>
<div style="text-align: center">
    <form action="" method="post">
        <div><b><?= $result; ?></b></div>
        <div><label for="name">Nombre:</label><input name="name" id="name" type="text" required></div>
        <div><label for="login">Usuario:</label><input name="login" id="login" type="text" required></div>
        <div><label for="pass">Contraseña:</label><input name="pass" id="pass" type="password" required></div>
        <div><label for="pass_re">Repetir Contraseña:</label><input name="pass_re" id="pass_re" type="password"
                                                                    required></div>
        <div>
            <a href="/login.php">
                <input type="button" value="Acceder">
            </a>
            <input type="submit" value="Registrar">
        </div>
    </form>
</div>
</body>
</html>