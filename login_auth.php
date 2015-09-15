<?php
    require_once "database.inc.php";
    $database = new Database('localhost', 'root', 'root', 'websecurity');

    $database->openConnection();
    if($database->isConnected()){
        $email = $_POST[email];
        $password = $_POST[password];
        $result = $database->authenticateUser($email, $password);
        if($result == true){
            print 'SUCCESS';
            print "<br>Welcome ".$database->getName($email);
            
        } else {
            print 'FAIL';
        }

    } else {
        echo 'Connection to database failed';
    }
    $database->closeConnection();
?>