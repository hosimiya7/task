<?php
require_once("DB.php");
class Task
{
  private $dbh;
  public function __construct()
  {
    $db = new DB;
    $this->dbh = $db->getDBHandler();
    date_default_timezone_set('Asia/Tokyo');
  }

  public function create(string $category, string $date, string $content): void
  {
    $sql = 'INSERT INTO tasks(category, date, content) VALUES(:category, :date, :content)';
    $prepare = $this->dbh->prepare($sql);
    // どの箱に何を入れるか
    $prepare->bindValue(':category', $category, PDO::PARAM_STR);
    $prepare->bindValue(':date', $date, PDO::PARAM_STR);
    $prepare->bindValue(':content', $content, PDO::PARAM_STR);
    try {
      $prepare->execute();
    } catch (PDOException $th) {
      throw $th;
    }
  }


  public function getRecords(): array
  {
    $request = new Request;
    $is_done = $request->getQueryValue('is_done');
    $category = $request->getQueryValue('category');
    $order = $request->getQueryValue('order');



    if ($is_done === "complete") {
      $sql = 'SELECT `tasks`.* FROM tasks WHERE is_done = true';
    } elseif ($is_done === "incomplete") {
      $sql = 'SELECT `tasks`.* FROM tasks WHERE is_done = false';
    } else {
      $sql = 'SELECT `tasks`.* FROM `tasks` WHERE 1 = 1';
    }

    if ($category === "hobby") {
      $sql .= ' AND category = "hobby"';
    } elseif ($category === "work") {
      $sql .= ' AND category = "work"';
    }

    if ($order === "asc") {
      $sql .= ' ORDER BY date ASC';
    } elseif ($order === "desc") {
      $sql .= ' ORDER BY date DESC';
    }

    $prepare = $this->dbh->prepare($sql);
    $prepare->execute();
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function delete($id)
  {
    $sql = 'DELETE FROM tasks WHERE id = :id';
    $prepare = $this->dbh->prepare($sql);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
  }
  public function complete($id)
  {
    $sql = 'UPDATE tasks SET is_done = true WHERE id = :id';
    $prepare = $this->dbh->prepare($sql);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
  }
  public function incomplete($id)
  {
    $sql = 'UPDATE tasks SET is_done = false WHERE id = :id';
    $prepare = $this->dbh->prepare($sql);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
  }
}
