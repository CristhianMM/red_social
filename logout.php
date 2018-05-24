<?php
require __DIR__ . '/autoload.php';

User::logout();
header('location: /');

?>