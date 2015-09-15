<?php
 DEFINE('DB_USERNAME', 'root');
 DEFINE('DB_PASSWORD', 'root');
 DEFINE('DB_HOST', 'localhost');
 DEFINE('DB_DATABASE', 'websecurity');

 $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);


 if (mysqli_connect_error()) {
  die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
 }

 echo 'Connected successfully.';

$names = array("user1","user2","user3","fredrik","anton","alex","axel","user4","user5","user6");

foreach($names as $name) {
  $password = $name;
  $salt = base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));

  $email = $name."@email.com";
  $hash = hash_pbkdf2("sha512", $password, $salt, 10000, 512);
  print "<br>";
  print $name;
  print "<br>";
  echo $email;
  print "<br>";
  print strlen($hash);
  print "<br>";
  print strlen($salt);
  print "<br>";

  $sql = "Insert into users(email,name,password,salt) values('".$email."','".$name."','".$hash."','".$salt."')";
  print $sql;
  mysqli_query($conn,$sql);
}
 $conn->close();
?>
