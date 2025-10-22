<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD']=== 'POST'):
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $sql = "UPDATE users SET name = "$name', email = '$email', age = $age WHERE id = $id;

    $result = $connection->query($sql);

    if($result)
        header('Loxation: ../index.php');
    else
        echo "Error: $sql<br>{$connection->error}";
endif;