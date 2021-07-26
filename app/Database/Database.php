<?php

namespace App\Database;

use mysqli;

class Database extends \mysqli
{
    protected string $server_name = "localhost";
    protected string $user_name = "cartwhite";
    protected string $password = "A1ijumaan-mysql";
    protected string $dbname = "reports_php";

    public function dbConn(): mysqli
    {
        $conn = new mysqli($this->server_name, $this->user_name, $this->password, $this->dbname);

        if($conn->connect_error){
            die("Connection failed: ". $conn->connect_errno);
        }
        return $conn;
    }
}