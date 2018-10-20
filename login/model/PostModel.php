<?php

namespace model;


class PostModel {

  /**
   * send post to database
   */
  public function submitPost($post, $name) {
    include('Database.php');
    $sql = "INSERT INTO posts (post, name) VALUES (:post, :name)";
    $insertToDb = $connection->prepare($sql);
    $insertToDb->bindParam(':post', $post);
    $insertToDb->bindParam(':name', $name);
    $insertToDb->execute();
  }
  
  public function retrivePosts() {
    include('Database.php');
    $fetchedData = array();
    $result = $connection->prepare("SELECT * FROM posts");
    $result->execute();
    $row = $result->fetchAll(\PDO::FETCH_OBJ);
    return $row;
  }
  
  public function validAuthor($name, $id) {
    include('Database.php');
    $match = $connection->prepare("SELECT * FROM posts WHERE ID=:ID");
    $match->bindParam('ID', $id);
    $match->execute();
    $row = $match->fetchAll(\PDO::FETCH_OBJ);
    if($row[0]->name == $name) {
      return true;
    } else { 
      return false;
    }
  }

  public function editPost() {
    include('Database.php');
    $sql = "UPDATE MyGuests SET post='Doe' WHERE id=2";


  }
}  