<?php

// Drivers
//$drivers = PDO::getAvailableDrivers();
//print_r($drivers);

// Connexion
//$db = new PDO('mysql:127.0.0.1;dbname=pdo', 'root', '');

try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=pdo', 'root', '');
} catch (PDOException $e) {
    die($e->getMessage());
}

// Query
$users = $db->query('SELECT * FROM users');
//$u = $users->fetch();
//$u = $users->fetch(PDO::FETCH_ASSOC);
//$u = $users->fetch(PDO::FETCH_OBJ);
$u = $users->fetchAll(PDO::FETCH_OBJ);
//print_r($u);

// Prepare
$statement = $db->prepare('SELECT * FROM users');
$statement->execute();
$users = $statement->fetch(PDO::FETCH_OBJ);
//print_r($users);
$statement = $db->prepare('SELECT * FROM users WHERE id = :id');
$statement->bindValue('id', 1);
$statement->execute();
$statement = $db->prepare('SELECT * FROM users WHERE id = ?');
$statement->execute([1]);
$statement = $db->prepare('SELECT * FROM users WHERE id = :id');
$statement->execute(['id' => 1]);
$statement = $db->prepare('SELECT * FROM users WHERE id = :id');
$id = 1;
$statement->bindValue('id', $id);
$id = 2;
$statement->execute();
$user = $statement->fetch(PDO::FETCH_OBJ);
$id = 1;
$statement->bindParam('id', $id);
$id = 2;
$statement->execute();
$user = $statement->fetch(PDO::FETCH_OBJ);
//print_r($user);

// Escape
$id = 1;
$id = $db->quote($id);
$statement = $db->query('SELECT * FROM users WHERE id = ' . $id);
$user = $statement->fetch(PDO::FETCH_OBJ);
//print_r($user);

// Count
$statement = $db->query('SELECT * FROM users');
$users = $statement->rowCount();
//echo $users;

// Insert
$statement = $db->prepare('INSERT INTO users (username, email) VALUES(:username, :email)');
$statement->execute([
    'username' => 'Jacques',
    'email' => 'jacques@example.com'
]);
$id = $db->lastInsertId();
echo $id;
