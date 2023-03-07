<?php
session_start();
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    if($username == 'test' && $password == '1234'){
        $_SESSION['username'] = $username;
        header('location: dashboard.php');
    } else {
        echo 'Invalid Login';
    }
}
?>