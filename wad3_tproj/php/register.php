<?php

require_once 'include/common.php';

$query = $_POST['query'];
// print_r($query);
$query =json_decode($query);

$username = $query->username;
$password = $query->password;
$msg = [];
$retype_password = $query->confirm;
$email = $query->email;

   
if ($password != $retype_password) {
    $msg[] = "Passwords do not match";
}
if (strlen($password) < 8 || strlen($retype_password) < 8) {
    $msg[] = "Your password needs to be at least 8 letters long"; 
}
if(1 !== preg_match('~[0-9]~', $password)){
        #doesn't have numbers
    $msg[] = "Your passwords needs to have a number";
}

if (strpos($email, '@') === false){
    $msg[] = 'Please input a valid email';
}


$dao = new AccountDAO();

$hashed = password_hash($password,PASSWORD_DEFAULT);
if (!$dao->checkUser($username) && count($msg)<1) {
    $dao->register($username,$hashed,$email);
    $msg = "User $username has been successfully registered";
    $_SESSION['success'] = $msg;
} else if($dao->checkUser($username)){
    $msg[] = "User $username is already existing";
}

if ($msg !== "User $username has been successfully registered") {
    $_SESSION['error'] = $msg;
    foreach ($msg as $i){
        echo $i.".";
    }
    echo 'false';
} else {
    echo 'true';
}
?>