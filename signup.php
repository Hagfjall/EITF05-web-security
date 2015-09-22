<?php
require_once "database.inc.php";
if ($db->isConnected()) {
    $val = parseValues();
//    print_r($val);
    if ($val['password'] != $val['password_repeat']) {
        show_error("Passwords do not match");
    }
    if (strlen($val['password']) < 8) {
        show_error("Password too short!");
    }
    if (!$db->emailUnique($val['email'])) {
        show_error("Email already exists...");
    }
    print $db->createUser_unsafe($val['email'], $val['name'], $val['password'], $val['address'] == 1);

}

function parseValues()
{
//    It is a GET
    $ret = array();
    if (isset($_GET[email])) {
        $ret['email'] = $_GET[email];
        $ret['name'] = $_GET[name];
        $ret['address'] = $_GET[address];
        $ret['password'] = $_GET[password];
        $ret['password_repeat'] = $_GET[password_repeat];
    } else if (isset($_POST[email])) {
        $ret['email'] = $_POST[email];
        $ret['name'] = $_POST[name];
        $ret['address'] = $_POST[address];
        $ret['password'] = $_POST[password];
        $ret['password_repeat'] = $_POST[password_repeat];
    }
    return $ret;
}

function show_error($error)
{
    print($error);
    ?>
    <a href="signup_form.html">Go back</a>
    <?php
}

?>