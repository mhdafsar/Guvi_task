<?php 

if(isset($_POST['register'])){
	$username   = $_POST['username'];
	$email  = $_POST['email'];
	$pass   = $_POST['password'];
	$pass_c = $_POST['confirm_password'];

	if($pass == $pass_c){ 
		
		// Connect to Redis 
		$redis = new Redis();
		$redis->connect('localhost', 6379);
		
		// Store user details in Redis 
		$redis->hmset($username, array('email' => $email, 'password' => $pass));

		// Connect to MongoDB 
		$mongo = new MongoDB\Driver\Manager('mongodb://localhost:27017');

		// Store user details in MongoDB
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->insert(['username' => $username, 'email' => $email]);

		$mongo->executeBulkWrite('users.users', $bulk);
		
		echo "Registration successful";
		
	} else {
		echo "Passwords do not match";
	}
}
?>