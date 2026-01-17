<?php

namespace Framework;

use PDO;


class Database {
  public $conn;

  /**
   * Create a constructor class
   * 
   * @param array $config
   */
  public function __construct($config) {
    $dsn = "mysql:
      host={$config['host']};
      port={$config['port']};
      dbname={$config['dbname']};
    ";

    // PDO options/attributes
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    // PUt the connection into try/catch
    try {

      $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
      
    } catch (PDOException $e) {

      throw new Exception("Connection failed {$e->getMessage()}");
    }
  }

  /**
   * Create a query method
   * 
   * @param string $query
   * @return PDOstatement
   */
  public function query($query, $params = []) {
    try {
      $sth = $this->conn->prepare($query);

      // Bind named params
      foreach ($params as $param => $value) {
        $sth->bindValue (':' . $param, $value);
      }

      $sth->execute();
      return $sth;

    } catch (PDOException $e) {
      throw new Exception("The query failed to execute: {$e->getMessage()}");
    }
  }
  
}