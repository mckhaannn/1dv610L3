<?php

namespace model;

require_once('Database.php');

class PostModel {

  public function __construct()
  {
    $this->database = new \model\Database();
    $this->connection = $this->database->server();
    $this->postStatus = false;
    $this->validAuthorStatus = false;
  }
  
  /**
   * return post status
   */
  public function isPostAdded() {
    return $this->postStatus;
  }
  /**
   * return post status
   */
  public function isValidAuthor() {
    return $this->validAuthorStatus;
  }

  /**
   * adds a post to sql db
   */
  public function submitPost($post, $name) {
    $sql = "INSERT INTO posts (post, name) VALUES (:post, :name)";
    $result = $this->connection->prepare($sql);
    $result->bindParam(':post', $post);
    $result->bindParam(':name', $name);
    $result->execute();
    $this->postStatus = true;
  }

  /**
   * updates post in sql db
   */
  public function updatePost($post, $name, $id) {
    $sql = "UPDATE posts SET post='$post' WHERE id='$id'  ";
    $result = $this->connection->prepare($sql);
    $result->execute();
  }
  

  /**
   * fetches all data from db
   */
  public function retrivePosts() {
    $fetchedData = array();
    $sql = "SELECT * FROM posts";
    $result = $this->connection->prepare($sql);
    $result->execute();
    $row = $result->fetchAll(\PDO::FETCH_OBJ);
    return $row;
  }


  /**
   * deletes a post from sql db
   */
  public function deletePost($id) {
    $sql = "DELETE FROM posts WHERE id='$id'";
    $result = $this->connection->prepare($sql);
    $result->execute();
  }
  

  /**
   * check if its the right author
   */
  public function validAuthor($name, $id) {
    $sql = "SELECT * FROM posts WHERE ID=:ID";
    $result = $this->connection->prepare($sql);
    $result->bindParam('ID', $id);
    $result->execute();
    $row = $result->fetchAll(\PDO::FETCH_OBJ);
    if($row[0]->name == $name) {
      $this->validAuthorStatus = true;
    } else { 
      $this->validAuthorStatus = false;
    }
  }
}  