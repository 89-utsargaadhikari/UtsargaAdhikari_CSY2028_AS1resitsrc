<?php
class Article
{
    // Properties to store article information
    public $id;
    public $title;
    public $content;
    public $categoryId;
    public $publishedBy;
    public $imageName;
    public $publishedUser;
    public $publishedDate;
    
    // Constructor to initialize article information
    public function __construct($id, $title, $content, $publishedBy, $categoryId, $publishedDate, $imageName, $publishedUser)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->publishedBy = $publishedBy;
        $this->categoryId = $categoryId;
        $this->publishedDate = $publishedDate;
        // Check if image name is set and add prefix if it is
        $this->imageName = isset($imageName) ? ('./images/articles/' . $imageName) : null;
        // Set default value for published user as "Unknown" if it is not set
        $this->publishedUser = $publishedUser  ?? 'Unknown';
    }

    // Function to create an article object from data array
    public static function fromMap($datafromMap)
    {
        return new Article(
            $datafromMap["id"],
            $datafromMap["title"],
            $datafromMap["content"],
            $datafromMap["publishedBy"],
            $datafromMap["categoryId"],
            $datafromMap["publishedDate"],
            $datafromMap["imageName"],
            $datafromMap["publishedUser"],
        );
    }
}
?>