<?php

require_once './model/user.php';

class UserService
{
    public $pdo;

    // Constructor to initialize database connection
    function __construct()
    {
        require './database/database.php';
        $this->pdo = $pdo;
    }

    // Get all users including admin
    function getAll()
    {
        $sql_query = "SELECT * FROM user";
        $query_executor =  $this->pdo->prepare($sql_query);
        $query_executor->execute();
        $fetched_rows =  $query_executor->fetchAll();
        // Map list of fetched rows to list of objects
        $data =   array_map(function ($current_row) {
            return User::fromMap($current_row);
        }, $fetched_rows);

        return $data;
    }

    // Get Admin list only
    function getAllAdmins()
    {
        $sql_query = "SELECT * FROM user WHERE isAdmin = 1";
        $query_executor =  $this->pdo->prepare($sql_query);
        $query_executor->execute();
        $fetched_rows =  $query_executor->fetchAll();
        // Map list of fetched rows to list of objects
        $data =   array_map(function ($current_row) {
            return User::fromMap($current_row);
        }, $fetched_rows);
        return $data;
    }

    // Get user by id
    function getById($id)
    {
        if (!isset($id)) {
            throw new Exception("Error, User doesnot exists");
        }
        $sql_query = "SELECT * FROM user WHERE id= :id LIMIT 1";
        $query_executor = $this->pdo->prepare($sql_query);
        $data = ['id' => $id];
        $query_executor->execute($data);
        $fetched_rows =  $query_executor->fetchAll();
        if (empty($fetched_rows)) {
            throw new Exception("User not found");
        }
        $data = User::fromMap($fetched_rows[0]);
        return $data;
    }

    // Get User by Email address and returns null if it doesn't exist
    function getUserByEmail($email)
    {
        $sql_query = "SELECT * FROM user WHERE email =:email LIMIT 1";
        $query_executor = $this->pdo->prepare($sql_query);
        $data = ['email' => $email];
        $query_executor->execute($data);
        $fetched_rows =  $query_executor->fetchAll();
        if (!empty($fetched_rows)) {
            return User::fromMap($fetched_rows[0]);
        }
        return null;
    }

    // Verify email address and password, then login user
    function loginUser($email, $password)
    {
        if (empty(trim($email)) || empty(trim($password))) {
            throw new Exception('Email address and password cannot be empty');
        }
        $sql_query = "SELECT * FROM user WHERE email =:email AND password = :password LIMIT 1";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = [
            'email' => $email, 'password' => sha1($password),
        ];
        $query_executor->execute($data);
        $fetched_rows =  $query_executor->fetchAll();
        if (empty($fetched_rows)) {
            throw new Exception("Email address or password is incorrect");
        }
        $data = User::fromMap($fetched_rows[0]);
        return $data;
    }

    // Create new admin
    function createAdmin($name, $email, $password)
    {
        if (empty(trim($name)))
            throw new Exception("Name cannot be empty");
        if (empty(trim($email)) || empty(trim($password)))
            throw new Exception('Email address or password cannot be empty');
        $existingUser = $this->getUserByEmail($email);
        if ($existingUser != null) {
            throw new Exception("Admin with Email address $email already exists.");
        }
        $sql_query = "INSERT into user (name,email,password,isAdmin) VALUES (:name,:email,:password,1)";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = [
            'email' => $email, 'password' => sha1($password), 'name' => $name,
        ];
        $query_executor->execute($data);
    }

    // Create new user
    function createUser($name, $email, $password)
    {
        if (empty(trim($name)))
            throw new Exception("Name cannot be empty");
        if (empty(trim($email)) || empty(trim($password)))
            throw new Exception('Email address or password cannot be empty');
        $existingUser = $this->getUserByEmail($email);
        if ($existingUser != null) {
            throw new Exception("User with Email address $email already exists.");
        }
        $sql_query = "INSERT into user (name,email,password,isAdmin) VALUES (:name,:email,:password,0)";
        $query_executor =  $this->pdo->prepare($sql_query);
        $data = [
            'email' => $email, 'password' => sha1($password), 'name' => $name,
        ];
        $query_executor->execute($data);
    }


    // Delete user
    function deleteUser($id)
    {
        if (!isset($id))
            throw new Exception("Error, User doesnot exists");

        $user = $this->getById($id);
        if ($user->isSuperAdmin) {
            throw new Exception("Cannot Delete Super Admin");
        }
        $sql_query = "DELETE FROM user WHERE id =:id AND isSuperAdmin = 0";
        $query_executor = $this->pdo->prepare($sql_query);
        $data = ['id' => $id];
        $query_executor->execute($data);
    }
    // Update user
    function updateUser($id, $name, $email)
    {
        if (!isset($id))
            throw new Exception("Error, User doesnot exists");
        $existingUser = $this->getUserByEmail($email);
        if ($existingUser != null) {
            if ($existingUser->id != $id)
                throw new Exception("User with Email address $email already exists.");
        }
        $sql_query = "UPDATE user SET name=:name, email = :email WHERE id =:id";
        $query_executor = $this->pdo->prepare($sql_query);
        $data = ['name' => $name, 'email' => $email, 'id' => $id];
        $query_executor->execute($data);
    }
}
