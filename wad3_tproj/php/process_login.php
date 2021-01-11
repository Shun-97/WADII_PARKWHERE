<?php

require_once 'include/common.php';
//
    $query = $_POST['query'];
//    print_r($query);
//    print_r(json_decode($query));
    $query_decode= json_decode($query);
    $username = $query_decode->username;
    $password = $query_decode->password;


    $dao = new AccountDAO();
    $hashedpassword = $dao->getHashedPassword($username);

    if ($hashedpassword !== NULL) { //succes
        if (password_verify($password,$hashedpassword)) {
            $_SESSION['username'] = $username;
            echo true;
        }
    } else{ //return a false msg.
        $msg = "Authentication failed";
        $_SESSION['error'] = $msg;

        echo false;
    }

?>