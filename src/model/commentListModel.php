
<?php
class CommentListModel
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

    // The title of the article associated with the comment
    public $articleTitle;

    // Constructor to initialize CommentListModel object
    public function __construct($id, $publishedBy, $publishedDate, $content, $articleId, $publishedUser, $articleTitle)
    {
        $this->id = $id;
        $this->publishedBy = $publishedBy;
        $this->content = $content;
        $this->articleId = $articleId;
        $this->publishedDate = $publishedDate;

        // If the publishedUser is not provided, set it to "Unknown"
        $this->publishedUser = $publishedUser ?? 'Unknown';
        $this->articleTitle = $articleTitle;
    }

    // Method to convert an array of data into a CommentListModel object
    public static function fromMap($datafromMap)
    {
        // Return a new CommentListModel object constructed using the data from the array
        return new CommentListModel(
            $datafromMap["id"],
            $datafromMap["publishedBy"],
            $datafromMap["publishedDate"],
            $datafromMap["content"],
            $datafromMap["articleId"],
            $datafromMap["publishedUser"],
            $datafromMap["articleTitle"],
        );
    }
}
