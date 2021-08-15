<?php

namespace MysqlDB;

use PDO;
use PDOException;



class MysqlDB 
{

    private $host;
    private $username;
    private $password ;
    private $db;

    public $link;
    private $error;


    public function __construct ()
    {
        $HOST = getenv("db_host");
        $USERNAME = getenv("db_username");
        $PASSWORD = getenv("db_password");
        $DATABASE = getenv("db_name");

        $this->host = $HOST;
        $this->username = $USERNAME;
        $this->password = $PASSWORD;
        $this->db = $DATABASE;

        $this->connectDB();
    }

    public function connectDB ()
    {

       try
       {
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->db;
            $this->link = new PDO($dsn, $this->username, $this->password);
            $this->link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->link;
       }
       catch(PDOException $e)
       {
            $this->error = 'Connection Failed! -> '. $e->getMessage();
            return false;
       }

    }

    public function insert ($table,$data,$args)
    {
        $blanks = array();

        foreach($data as $key) {
            $key = $key." = ?";
            array_push($blanks, $key);
        }

        $blanks = implode(",", $blanks);

        $query = "INSERT INTO  $table SET ".$blanks;

        $stmt = $this->link->prepare($query);
        $stmt->execute($args);

        if($stmt->rowCount() >0) {
            return $stmt;
        } else {
            return false;
        }

    }

    public function select ($table,$where,$val,$by,$option)
    {

        if($by == 'none')
             $by = "id";
        if($option == 'none')
             $option = "DESC";

        if($where == 'none') {
          // query
          $query = "SELECT * FROM $table  ORDER BY $by $option";
        } else {
          // query
          $query = "SELECT * FROM $table WHERE $where = '$val' AND ORDER BY $by $option";
        }

        $stmt = $this->link->query($query);
        if($stmt->rowCount() >0) {
            return $stmt->fetch();
        } else {
            return false;
        }

    }

    public function selectByOperator ($table,$col,$op,$val,$by,$option)
    {

        if($by == 'none')
            $by = "id";
        if($option == 'none')
            $option = "DESC";


        $query = "SELECT * FROM $table WHERE $col $op '$val' ORDER BY $by $option";


        $stmt = $this->link->query($query);
        if($stmt->rowCount() >0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }

    }


    public function update ($table, $data, $by, $value, $args)
    {

        $blanks = array();

        foreach($data as $key) {
            $key = $key." = ?";
            array_push($blanks, $key);
        }

        $blanks = implode(",", $blanks);

        $query = "UPDATE $table SET " .$blanks. " WHERE $by = '$value'";

        $stmt = $this->link->prepare($query);
        $stmt->execute($args);

        if($stmt->rowCount() >0) {
            return $stmt;
        } else {
            return false;
        }

    }

    public function soft_delete($table,$by,$val)
    {
        // query
        $query = "UPDATE $table SET isDeleted = 1 WHERE $by = '$val'";

        $stmt = $this->link->query($query);

        if($stmt->rowCount() >0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function delete ($table, $by, $val)
    {
        // query
        $query = "DELETE FROM $table WHERE $by = '$val'";

        $stmt = $this->link->query($query);

        if($stmt->rowCount() >0) {
            return $stmt;
        } else {
            return false;
        }

    }


    public function search($table, $by, $val)
    {
        //query
        $query = "SELECT * FROM $table WHERE $by LIKE '%$val%'";

        $stmt = $this->link->query($query);
        if($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }


}
