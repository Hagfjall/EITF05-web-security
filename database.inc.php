<?php

class Database
{
    private $host;
    private $userName;
    private $password;
    private $database;
    private $conn;
    private $iterations;

    /**
     * Constructs a database object for the specified user.
     */


    public function __construct($host, $userName, $password, $database)
    {
        $this->host = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->database = $database;
        $this->iterations = 10000;
    }

    /**
     * Opens a connection to the database, using the earlier specified user
     * name and password.
     *
     * @return true if the connection succeeded, false if the connection
     * couldn't be opened or the supplied user name and password were not
     * recognized.
     */
    public function openConnection()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database",
                $this->userName, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = "Connection error: " . $e->getMessage();
            print $error . "<p>";
            unset($this->conn);
            return false;
        }
        return true;
    }

    /**
     * Closes the connection to the database.
     */
    public function closeConnection()
    {
        $this->conn = null;
        unset($this->conn);
    }

    /**
     * Checks if the connection to the database has been established.
     *
     * @return true if the connection has been established
     */
    public function isConnected()
    {
        return isset($this->conn);
    }

    /**
     * Execute a database query (SELECT).
     *
     * @param $query The query string (SQL), with ? placeholders for parameters
     * @param $param Array with parameters
     * @return The result set
     */
    private function executeQuery($query, $param = null)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($param);
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            $error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
            die($error);
        }
        return $result;
    }

    /**
     * Execute a database update (insert/delete/update).
     *
     * @param $query The query string (SQL), with ? placeholders for parameters
     * @param $param Array with parameters
     * @return The number of affected rows
     */
    private function executeUpdate($query, $param = null)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($param);
            $result = $stmt->rowCount();

        } catch (Exception $e) {
            $error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
            die($error);

        }
        return $result;
    }

    public function createUser($email, $name, $password, $address)
    {
        $salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
        $hash = hash_pbkdf2("sha512", $password, $salt, $this->iterations, 0, false);
        $sql = "INSERT INTO users(email,name,address,password,salt) VALUES (?,?,?,?,?)";

        print_r($this->executeUpdate($sql, array($email, $name, $address, $hash, $salt)));

    }


    public function authenticateUser($email, $password)
    {
        $salt = $this->getSalt($email);
        $hash = hash_pbkdf2("sha512", $password, $salt, $this->iterations, 0, false);
        $sql = "SELECT * FROM users WHERE `email` = ? AND `password` = ?";
        $return = $this->executeQuery($sql, array($email, $hash));
        if (sizeof($return) == 1) {
            return true;
        } else {
            return false;
        }
    }

    private function getSalt($email)
    {
        $sql = "SELECT salt FROM users WHERE `email` = ?";
        $array = $this->executeQuery($sql, array($email));
        foreach ($array as $value) {
            $salt = $value;
        }
        return $salt;
    }

    public function getName($email)
    {
        $sql = "SELECT name FROM users WHERE `email` = ? ";
        return $this->executeQuery($sql, array($email))[0];
    }

}



//EXAMPLE
$db = new Database("localhost", "root", "root", "websecurity");
$db->openConnection();
if (!$db->isConnected()) {
    echo 'noo!';
}
//$db->createUser("hagfjall@gmail.com", "freddan", "hagfjall", "Vildandsvägen");
//        $result = $db->getName("axel@email.com");
//        foreach($result as $name){
//            print $name['name'];
//        }

?>
