<?php
try {
    $user = getenv('DB_1_ENV_MYSQL_USER');
    $password = getenv('DB_1_ENV_MYSQL_PASSWORD');
    $pdo = new \PDO('mysql:host=db;dbname=test', $user, $password);
} catch(\Exception $e) {
    echo 'MySQL connexion error : ' . $e->getMessage();
}

phpinfo();
