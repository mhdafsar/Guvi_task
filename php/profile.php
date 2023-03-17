<?php
// include necessary libraries
include('redis.php');
include('mongodb.php');

$id = $_GET['user_id'];

// create redis connection
$redis = new Redis();
$redis->connect('localhost', 6379);

// create mongodb connection
$mongo = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongo->profile;

// check if user exists in redis
$user_exists = $redis->exists($id);

if ($user_exists) {
    // user exists in redis, retrieve the data 
    $user_data = $redis->hgetall($id);
    // output user data
    echo 'User data:<br>';
    echo 'Name: ' . $user_data['name'] . '<br>';
    echo 'Age: ' . $user_data['age'] . '<br>';
    echo 'Gender: ' . $user_data['gender'] . '<br>';
    
} else {
    // user not found in redis, retrieve data from mongodb
    $user_data = $db->users->findOne(['user_id' => $id]);
    // output user data
    echo 'User data:<br>';
    echo 'Name: ' . $user_data['name'] . '<br>';
    echo 'Age: ' . $user_data['age'] . '<br>';
    echo 'Gender: ' . $user_data['gender'] . '<br>';
    // store user data in redis
    $redis->hmset($id, ['name' => $user_data['name'], 'age' => $user_data['age'], 'gender' => $user_data['gender']]);
}