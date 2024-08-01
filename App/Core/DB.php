<?php

namespace App\Core;

use PDO;
use PDOException;

class DB
{
    private $conn;
    private $table;
    private $conditions = [];
    private $conditionClause = "";
    private $results;

    private function connect()
    {
        if (!isset($this->conn)) {
            try {
                $this->conn = new PDO("mysql:host=" . HOST . ";dbname=" . NAME, USER, PASS);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                exit;
            }
        }
    }
    public function setTable($table)
    {
        $this->table = $table;
        
        return $this; // Enable method chaining
    }
    public function where($conditions)
    {
        $conditionClause = "WHERE ";
        foreach ($conditions as $key => $value) {
            $conditionClause .= "$key = :$key AND ";
        }
        $conditionClause = rtrim($conditionClause, " AND ");
        $this->conditionClause = $conditionClause;
        $this->conditions = $conditions;

        return $this; 
    }
    public function select(array $columns = ['*'])
    {
        $this->connect();

        try {
            $columns = implode(', ', $columns);
            $sql = "SELECT $columns FROM  `$this->table` " ;
            if (!empty($this->conditionClause)) {
                $sql .= " " . $this->conditionClause;
            }
            $stmt = $this->conn->prepare($sql);
            foreach ($this->conditions as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            $stmt->execute();
            $this->results = $stmt->fetchAll(PDO::FETCH_ASSOC);
     
            return $this; 
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public function insert(array $data)
    {
        $this->connect();

        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            return $this; // Return the instance to enable further chaining
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function delete($id=null)
    {
        $this->connect();

        try {
            $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE `id` = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $this; 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function deleteMultiple(array $ids)
    {
        $this->connect();
    
        try {
            // Create a string of placeholders
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
    
            // Prepare the SQL statement
            $sql = "DELETE FROM " . $this->table . " WHERE `id` IN ($placeholders)";
            $stmt = $this->conn->prepare($sql);
    
            // Execute the statement with the array of IDs
            $stmt->execute($ids);
    
            return $this; 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getResult()
    {   
        return  $this->results;      
    }
}
