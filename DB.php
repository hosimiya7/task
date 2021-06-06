<?php

class DB{

  private $dsn;
  private $user;
  private $password;

  public function __construct()
  {
    $this->dsn = 'mysql:dbname=nv17m_practice;host=public.nv17m.tyo2.database-hosting.conoha.io';
    $this->user = 'nv17m_practice';
    $this->password = '%Practice';
  }

  public function getDBHandler()
  {
    try{
      $dbh = new PDO($this->dsn, $this->user, $this->password);
      return $dbh;
    } catch(PDOException $e){
      echo "接続失敗:".$e->getMessage()."\n";
      exit();
    }
  }
}

