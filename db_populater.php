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
  $salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);

  $email = $name."@email.com";
  $address = $name."gatan"." 13";
  $hash = hash_pbkdf2("sha512", $password, $salt, 10000, 0,false);
  print "<br>";
  print $name;
  print "<br>";
  echo $email;
  print "<br>";
  print strlen($hash);
  print "<br>";
  print $hash;
  print "<br>";
  print $address;
  print "<br>";
  $sql = "Insert into users(email,name,address,password,salt) values('".$email."','".$name."','".$address."','".$hash."','".$salt."')";
  #print $sql;
  mysqli_query($conn,$sql);
}
 $conn->close();
?>
