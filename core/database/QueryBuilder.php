<?php

namespace LRS\App\Core\Database;

use PDO;

class QueryBuilder {
  protected $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function selectAll($table) {
    $qry = $this->conn->prepare("select * from {$table}");
    $qry->execute();

    return $qry->fetchAll(PDO::FETCH_CLASS);
  }

  public function select($table, $clause) {
    $qry = $this->conn->prepare("select * from {$table} where {$clause}");
    $qry->execute();

    return $qry->fetchAll(PDO::FETCH_CLASS);
  }

  public function insert($table, $params) {
    $sql = sprintf(
        'insert %s (%s) values (%s)',
        $table,
        implode(', ', array_keys($params)),
        ':' . implode(', :', array_keys($params))
      );

    try {
      $qry = $this->conn->prepare($sql);
      $qry->execute($params);

    } catch (PDOException $e) {
      dd($e);
    }

    $id = $this->conn->lastInsertId();
    return $id;
  }
}
