<?php
require __DIR__ . '/autoload.php';

$user = User::getAuth();

if ($user['id'] && $_POST['message']) {
    $con = new Conexion();
    $con->ejecutar('insert into comments values (default, :user_id, :message, default)', [
        ':user_id' => $user['id'],
        ':message' => $_POST['message'],
    ]);

    header('location: /');
}

$con = new Conexion();
$comments = $con->ejecutar('select c.*, u.name as user from comments c join users u on c.user_id = u.id order by created_at desc');

?>

<?php if ($user['id']): ?>
    <div>
        <h1><?= $user['name']; ?></h1>
        <a href="/logout.php">
            <input type="button" value="Salir">
        </a>
        <form method="post" action="">
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
            <input type="submit" value="Comentar">
        </form>
    </div>
<?php else: ?>
    <div>
        <a href="/login.php">
            <input type="button" value="Iniciar Sesion">
        </a>
    </div>
<?php endif; ?>

<div class="comentarios">
    <?php foreach ($comments as $comment): ?>
        <?php require('views/comment.php'); ?>
    <?php endforeach; ?>
</div>
