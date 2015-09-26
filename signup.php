<?php
require_once "database.inc.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php
            if ($db->isConnected()){
                $val = parseValues();
                $err = false;

                if (strlen($val['email']) == 0) {
                    show_error("Please provide an email.");
                    $err = true;                    
                }

                if($val['password'] != $val['password_repeat']){
                    show_error("Passwords do not match");
                    $err = true;
                }

                if(strlen($val['password']) < 8){
                    show_error("Password too short!");
                    $err = true;
                }

                if(!$db->emailUnique($val['email'])){
                    show_error("Email already exists...");
                    $err = true;
                }

                if ($err) {
                    echo '<a href="signup_form.html">< try again</a>';
                } else {
                    $db->createUser($val['email'], $val['name'], $val['password'], $val['address']);
                }
            }

            function parseValues(){
            //    It is a GET
                $ret = array();
                if(isset($_GET["email"])){
                    $ret['email'] = $_GET["email"];
                    $ret['name'] = $_GET["name"];
                    $ret['address'] = $_GET["address"];
                    $ret['password'] = $_GET["password"];
                    $ret['password_repeat'] = $_GET["password_repeat"];
                }else if(isset($_POST["email"])){
                    $ret['email'] = $_POST["email"];
                    $ret['name'] = $_POST["name"];
                    $ret['address'] = $_POST["address"];
                    $ret['password'] = $_POST["password"];
                    $ret['password_repeat'] = $_POST["password_repeat"];
                }
                return $ret;
            }

            function show_error($error){
                echo '<div class="error">';
                print($error);
                echo '</div>';
            }
        ?>
    </body>
</html>