<?php

function autoloader($className){
    $classNameParts = explode('\\', $className);
    $className = end($classNameParts);

    include 'classes/' . $className . '.php';
}

spl_autoload_register('autoloader');

(new Ego\DotEnv(__DIR__ . '/.env'))->load();

$pdo = new PDO(
    getenv('DATABASE_DNS'),
    getenv('DATABASE_USER'),
    getenv('DATABASE_PASSWORD')
);

$query = $pdo->query('SHOW VARIABLES like "version"');

$row = $query->fetch();

echo 'MySQL version:' . $row['Value'];
