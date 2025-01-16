<?php
    require_once __DIR__.'/loadenv.php';
    try {
        loadEnv(__DIR__ . '/../.env'); // Adjust the path if needed
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $host = $_ENV['HOST'];
    $db = $_ENV['DATABASE'];
    $user = $_ENV['USER'];
    $pwd = $_ENV['PASSWORD'];
    $charset = $_ENV['CHARSET'];

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        $pdo = new PDO($dsn,$user,$pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
    }

    require_once 'crud.php';
    require_once 'user.php';
    $crud = new crud($pdo);
    $user = new user($pdo);

    $user->insertUser('zeal@safo2024','test123');
?>