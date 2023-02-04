<?php
class User
{
    // The unique identifier of the user
    public $id;

    // The name of the user
    public $name;

    // The email address of the user
    public $email;

    // A flag indicating whether the user is an administrator
    public $isAdmin;

    // A flag indicating whether the user is a super administrator
    public $isSuperAdmin;

    // The date and time when the user was created
    public $createdAt;

    // Constructor to initialize User object
    public function __construct($id, $name, $email, $isAdmin, $isSuperAdmin, $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;

        // If the isAdmin flag is not provided, set it to false
        $this->isAdmin = $isAdmin ?? false;

        // If the isSuperAdmin flag is not provided, set it to false
        $this->isSuperAdmin = $isSuperAdmin ?? false;
        $this->createdAt = $createdAt;
    }

    // Method to convert an array of data into a User object
    public static function fromMap($datafromMap)
    {
        // Return a new User object constructed using the data from the array
        return new User(
            $datafromMap["id"],
            $datafromMap["name"],
            $datafromMap["email"],
            $datafromMap["isAdmin"],
            $datafromMap["isSuperAdmin"],
            $datafromMap["createdAt"]
        );
    }
}
