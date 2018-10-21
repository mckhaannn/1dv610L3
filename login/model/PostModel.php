<?php

namespace model;


class PostModel {

  /**
   * send post to database
   */
  public function submitPost($post, $name) {
    include('Database.php');
    $sql = "INSERT INTO posts (post, name) VALUES (:post, :name)";
    $result = $connection->prepare($sql);
    $result->bindParam(':post', $post);
    $result->bindParam(':name', $name);
    $result->execute();
  }

  public function updatePost($post, $name, $id) {
    include('Database.php');
    $sql = "UPDATE posts SET post='$post' WHERE id='$id'  ";
    $result = $connection->prepare($sql);
    $result->execute();
  }
  
  public function retrivePosts() {
    include('Database.php');
    $fetchedData = array();
    $sql = "SELECT * FROM posts";
    $result = $connection->prepare($sql);
    $result->execute();
    $row = $result->fetchAll(\PDO::FETCH_OBJ);
    return $row;
  }

  public function deletePost($id) {
    var_dump($id);
    include('Database.php');
    $sql = "DELETE FROM posts WHERE id='$id'";
    $result = $connection->prepare($sql);
    $result->execute();
  }
  
  public function validAuthor($name, $id) {
    include('Database.php');
    $sql = "SELECT * FROM posts WHERE ID=:ID";
    $result = $connection->prepare($sql);
    $result->bindParam('ID', $id);
    $result->execute();
    $row = $result->fetchAll(\PDO::FETCH_OBJ);
    if($row[0]->name == $name) {
      return true;
    } else { 
      return false;
    }
  }
}  