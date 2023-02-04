<?php

class Category
{

    public $id;
    public $name;

    // Constructor to initialize the class properties
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    // Method to convert data from the data source to the Category object
    public static function fromMap($datafromMap)
    {
        // Return the Category object from the data from the data source
        return new Category($datafromMap["id"], $datafromMap["name"]);
    }
}
