<?php

include 'Modelo/conexion.php';


$con = new Conexion();
var_dump($con->test());
var_dump($con->insert('insert into users values(?, ? , ?)', ['Nelson', 'nelson', '12345']));
