<?php

require_once './model/category.php';

// Class to manage all the category-related services
class CategoryService
{
    // PDO object to interact with the database
    public $pdo;

    // Constructor to initiate the connection to the database
    function __construct()
    {
        require './database/database.php';
        $this->pdo = $pdo;
    }

    // Function to retrieve all the categories from the database
    function getAll()
    {
        // SQL query to select all categories
        $sql_query = "SELECT * FROM category";
        // Prepare the query for execution
        $query_executor =  $this->pdo->prepare($sql_query);
        // Execute the query
        $query_executor->execute();
        // Fetch the result of the query
        $fetched_rows =  $query_executor->fetchAll();
        // Map the list of fetched rows to list of Category objects
        $data =   array_map(function ($current_row) {
            return Category::fromMap($current_row);
        }, $fetched_rows);
        // Return the list of categories
        return $data ?? [];
    }

    // Function to insert a new category in the database
    function insertCategory($name)
    {
        // SQL query to insert a new category
        $sql_query = "INSERT INTO category (name) VALUES (:name)";
        // Prepare the query for execution
        $query_executor =  $this->pdo->prepare($sql_query);
        // Bind the data to the query
        $data = ['name' => $name];
        // Execute the query
        $query_executor->execute($data);
    }

    // Function to update the information of an existing category
    function updateCategory($id, $name)
    {
        // SQL query to update the category information
        $sql_query = "UPDATE category SET name =:name  WHERE id= :id";
        // Prepare the query for execution
        $query_executor =  $this->pdo->prepare($sql_query);
        // Bind the data to the query
        $data = ['name' => $name, 'id' => $id];
        // Execute the query
        $query_executor->execute($data);
    }

    // Function to delete a category from the database
    function delete($id)
    {
        // SQL query to delete the category
        $sql_query = "DELETE FROM category WHERE id= :id";
        // Prepare the query for execution
        $query_executor =  $this->pdo->prepare($sql_query);
        // Bind the data to the query
        $data = ['id' => $id];
        // Execute the query
        $query_executor->execute($data);
    }

    // Function to retrieve a specific category by its ID
    function getById($id)
    {
        // Check if the ID is set
        if (!isset($id)) {
            // If the ID is not set, throw an exception
            throw new Exception("Error, Category doesn't exist");
        }
        // SQL query to select a specific category by ID
        $sql_query = "SELECT *FROM category WHERE id= :id LIMIT 1";

        $query_executor =  $this->pdo->prepare($sql_query);
        $data = ['id' => $id];
        $query_executor->execute($data);
        $fetched_rows =  $query_executor->fetchAll();
        $data = Category::fromMap($fetched_rows[0]);
        return $data;
    }  
   
}
