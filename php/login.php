<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$mongo = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongo->selectDatabase('my_database');
$collection = $db->selectCollection('users');

$email = $_POST['email'];
$password = $_POST['password'];

$user = $collection->findOne(['email' => $email]);

if (!$user) {
    die('No such user.');
}

if (!password_verify($password, $user['password'])) {
    die('Invalid password.');
}

$token = bin2hex(random_bytes(32));

$redis->set($token, $email);

session_start();
$_SESSION['token'] = $token;

header('Location: index.php');
exit;

?>