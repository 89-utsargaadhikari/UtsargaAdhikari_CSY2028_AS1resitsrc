<?php
require_once './model/comment.php';
require_once './model/commentListModel.php';

class CommentService
{
    public $pdo;

    function __construct()
    {
        // database connection is created in this constructor
        require './database/database.php';
        $this->pdo = $pdo;
    }

    // Add new comment for given article [articleId]
    function addComment($articleId, $content, $userId)
    {
        // Insert a new comment into the comment table in the database
        $sql_query = "INSERT INTO comment (articleId,content,publishedBy) VALUES (:articleId,:content,:userId)";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['articleId' => $articleId, 'content' => $content, 'userId' => $userId];
        $query_executor->execute($data);
    }

    // Delete comment by [id]
    function deleteCommentById($id)
    {
        // Delete a comment from the comment table in the database using the id
        $sql_query = "DELETE FROM comment WHERE id = :id";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['id' => $id,];
        $query_executor->execute($data);
    }

    // Get specific comment by [id]
    function getById($id)
    {
        // If the id is not set, throw an exception
        if (!isset($id))
            throw new Exception("Error, Comment doesnt exists");

        // Get a single comment from the database using the id
        $sql_query = "SELECT c.*,u.name as publishedUser FROM comment c LEFT JOIN user u ON c.publishedBy = u.id WHERE c.id= :id LIMIT 1";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['id' => $id];
        $query_executor->execute($data);
        $fetched_rows =  $query_executor->fetchAll();
        // Convert the fetched row to a Comment object
        $data = Comment::fromMap($fetched_rows[0]);
        return $data;
    }

    // Get all comments related to article by [articleId]
    function getByArticleId($articleId)
    {
        // If the articleId is not set, throw an exception
        if (!isset($articleId))
            throw new Exception("Error, Comment doesnt exists");

        // Get all comments related to an article from the database using the articleId
        $sql_query = "SELECT c.*,u.name as publishedUser FROM comment c LEFT JOIN user u ON c.publishedBy = u.id WHERE c.articleId = :articleId";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['articleId' => $articleId];
        $query_executor->execute($data);
        $fetched_rows =  $query_executor->fetchAll();
        //Map list of fetched rows to list of objects
        $data =   array_map(function ($current_row) {
            return Comment::fromMap($current_row);
        }, $fetched_rows);
        return $data;
    }

    //Get comments related to user by [userId]
    function getByUserId($userId)
    {
        if (!isset($userId))
            throw new Exception("Error, Comment doesnt exists");
        $sql_query = "SELECT c.*,u.name as publishedUser, a.title  as articleTitle FROM comment c LEFT JOIN user u ON c.publishedBy = u.id INNER JOIN article a on a.id = c.articleId 
         WHERE c.publishedBy = :userId";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['userId' => $userId];
        $query_executor->execute($data);
        $fetched_rows =  $query_executor->fetchAll();
        //Map list of fetched rows to list of objects
        $data =   array_map(function ($current_row) {
            return CommentListModel::fromMap($current_row);
        }, $fetched_rows);
        return $data;
    }
}
