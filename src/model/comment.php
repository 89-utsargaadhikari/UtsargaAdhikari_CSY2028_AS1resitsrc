<?php
class Comment
{

    // The unique identifier of the comment
    public $id;

    // The id of the user who published the comment
    public $publishedBy;

    // The username of the user who published the comment
    public $publishedUser;

    // The date and time when the comment was published
    public $publishedDate;

    // The content of the comment
    public $content;

    // The id of the article associated with the comment
    public $articleId;

    // Constructor to initialize comment object
    public function __construct($id, $publishedBy, $publishedDate, $content, $articleId, $publishedUser)
    {
        $this->id = $id;
        $this->publishedBy = $publishedBy;
        $this->content = $content;
        $this->articleId = $articleId;
        $this->publishedDate = $publishedDate;

        // If the publishedUser is not provided, set it to "Unknown"
        $this->publishedUser = $publishedUser ?? 'Unknown';
    }

    // Method to convert an array of data into a Comment object
    public static function fromMap($datafromMap)
    {
        // Return a new Comment object constructed using the data from the array
        return new Comment(
            $datafromMap["id"],
            $datafromMap["publishedBy"],
            $datafromMap["publishedDate"],
            $datafromMap["content"],
            $datafromMap["articleId"],
            $datafromMap["publishedUser"],
        );
    }
}
