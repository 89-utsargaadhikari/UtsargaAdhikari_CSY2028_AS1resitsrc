<?php
require_once './model/article.php';

class ArticleService
{
    // Add a property to store the PDO object
    public $pdo;
    
    // The constructor sets up the connection to the database
    function __construct()
    {
        require './database/database.php';
        $this->pdo = $pdo;
    }
    
    // Get all articles
    function getAll()
    {
        // Query to select all articles and the users who published them
        $sql_query = "SELECT a.*, u.name as publishedUser FROM article a LEFT JOIN user u ON a.publishedBy = u.id ORDER BY publishedDate";
        $query_executor =  $this->pdo->prepare($sql_query);
        $query_executor->execute();
        $fetched_rows =  $query_executor->fetchAll();
        // Map the fetched rows to objects of type Article
        $data =   array_map(function ($current_row) {
            return Article::fromMap($current_row);
        }, $fetched_rows);
        return $data;
    }

    // Get latest articles
    function getLatestArticles()
    {
        // Query to select the latest 10 articles and the users who published them
        $sql_query = "SELECT a.*, u.name as publishedUser FROM article a LEFT JOIN user u ON a.publishedBy = u.id ORDER BY publishedDate DESC LIMIT 10";
        $query_executor =  $this->pdo->prepare($sql_query);
        $query_executor->execute();
        $fetched_rows =  $query_executor->fetchAll();
        // Map the fetched rows to objects of type Article
        $data =   array_map(function ($current_row) {
            return Article::fromMap($current_row);
        }, $fetched_rows);
        return $data;
    }

    // Add a new article with the given information and image
    function addArticle($title, $content, $categoryId, $userId, $image)
    {
        // Get the name for the image file
        $imageName = null;
        if (isset($image["tmp_name"]) && !empty($image["tmp_name"])) {
            $currentImage = $image["tmp_name"];
            $ext = end((explode(".", $image["name"])));
            $imageName = date('U') . '.' . $ext;
            move_uploaded_file($currentImage, './images/articles/' . $imageName);
        }
        // Insert a new article into the database
        $sql_query = "INSERT INTO article (title,content,publishedBy,categoryId,imageName) VALUES (:title,:content,:userId,:categoryId,:imageName)";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['title' => $title, 'content' => $content, 'userId' => $userId, 'categoryId' => $categoryId, 'imageName' => $imageName];
        $query_executor->execute($data);
    }

    // Update Article information and image
    function updateArticle($id, $title, $content, $categoryId, $image)
    {
        $imageName = null;
        if (isset($image["tmp_name"]) && !empty($image["tmp_name"])) {
            $currentImage = $image["tmp_name"];
            $ext = end((explode(".", $image["name"])));
            $imageName = date('U') . '.' . $ext;
            move_uploaded_file($currentImage, './images/articles/' . $imageName);
        }
        $sql_query = "UPDATE article SET title = :title, content = :content, categoryId = :categoryId, imageName=:imageName WHERE id = :id";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['content' => $content, 'id' => $id, 'title' => $title, 'categoryId' => $categoryId, 'imageName' => $imageName];
        $query_executor->execute($data);
    }

    // Delete Article with provided Id
    function deleteArticleById($id)
    {
        $article = $this->getById($id);
        if (isset($article->imageName)) {
            try {
                $current_imageName = $article->imageName;
                if (file_exists($current_imageName))
                    unlink($current_imageName);
            } catch (Exception $e) {
                // do nothing
            }
        }
        $sql_query = "DELETE FROM article WHERE id = :id";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['id' => $id,];
        $query_executor->execute($data);
    }

    //Get specific article by [id]
    function getById($id)
    {
        if (!isset($id))
            throw new Exception("Error, article doesnt exists");
        $sql_query = "SELECT a.*, u.name as publishedUser FROM article a LEFT JOIN user u ON a.publishedBy = u.id  WHERE a.id= :id LIMIT 1";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['id' => $id];
        $query_executor->execute($data);
        $fetched_rows =  $query_executor->fetchAll();
        $data = Article::fromMap($fetched_rows[0]);
        return $data;
    }

    //Get all articles from category [categoryId]
    function getByCategoryId($categoryId)
    {
        if (!isset($categoryId))
            throw new Exception("Error, article doesnt exists");
        $sql_query = "SELECT a.*, u.name as publishedUser FROM article a LEFT JOIN user u ON a.publishedBy = u.id  WHERE a.categoryId = :categoryId  ORDER BY publishedDate";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['categoryId' => $categoryId];
        $query_executor->execute($data);
        $fetched_rows =  $query_executor->fetchAll();
        //Map list of fetched rows to list of objects
        $data =   array_map(function ($current_row) {
            return Article::fromMap($current_row);
        }, $fetched_rows);
        return $data;
        return $data;
    }
}
