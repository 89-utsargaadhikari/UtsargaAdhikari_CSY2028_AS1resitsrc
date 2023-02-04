<?php
// Import header and article/comment services
require 'header.php';
require_once './service/articleService.php';
require_once './service/commentService.php';

// Initialize article and comment services
$commentService = new CommentService();
$articleService = new ArticleService();

// Initialize article information
$article = null;

// Main article section
?>
<main>
	<?php
	// Import sidenav
	require 'sidenav.php';
	?>
	<article>
		<?php
		// If article id is set in GET request, fetch article information
		if (isset($_GET['id'])) {
			try {
				$id = $_GET['id'];
				$article = $articleService->getById($id);
			} catch (Exception $e) {
				// do nothing
			}
		}

	// If comment delete form is submitted, delete comment
	if (isset($_POST['delete'])) {
		try {
			$commentId = $_POST['commentId'];
			$commentService->deleteCommentById($commentId);
			echo "<h6 style='color:green'>Comment has been deleted</h6>";
			
			// Refresh page to show updated content
			echo '<script>window.location.href = "fullArticle.php?id=' . $article?->id . ';</script>';
		} catch (Exception $e) {
			echo "<h6 style='color:red'>{$e->getMessage()}</h6>";
		}
	}
	
	// If comment submit form is submitted, add comment
	if (isset($_POST['submit'])) {
		try {
			$comment = $_POST['commentText'];
			$commentService->addComment($article->id, $comment, $_SESSION['userId']);
			echo "<h6 style='color:green'>Comment has been added</h6>";
			
			// Refresh page to show updated content
			echo '<script>window.location.href = "fullArticle.php?id=' . $article?->id . ';</script>';
		} catch (Exception $e) {
			echo "<h6 style='color:red'>{$e->getMessage()}</h6>";
		}
	}
	
	// If article information is set, show article information
	if (isset($article)) {
	?>
		<!-- Show article information -->
		<h1><?php echo $article?->title ?></h1>
		<div class="row">
			<em class="article-alignment">Published Date: <?php echo $article?->publishedDate ?></em>
			<p class="article-alignment">Author: <?php echo $article?->publishedUser ?> </p>
			</div>
			<?php
	}
// Check if article image exists and display the image or a placeholder if not
if (isset($article->imageName)) {
?>

<img height="300" width="100%" style="margin-bottom:15px" src=<?php echo $article->imageName ?> />
<?php
} else {
	echo '<div class="border"></div>';
}
?>
<p><?php echo $article->content ?></p>
<div class="border"></div>
<h5 style="text-align: center;">Comments</h5>
<?php
// Get the comments for the current article
$comments = $commentService->getByArticleId($article->id);

// Check if there are comments for this article and display a message if not
if (empty($comments)) {
	echo ('<h6 style="text-align: center; padding:30px 0px">No Comments Found</h6>');
} else {
	// Loop through each comment and display it
	foreach ($comments as $currentComment) {
?>

	<div class="comment">
		<h7 class="content"><?php echo $currentComment->content ?></h7>
		<a href="userComments.php?userId=<?php echo $currentComment->publishedBy ?>" class="author">
			Posted by: <?php echo $currentComment->publishedUser ?>
		</a>
		
		<?php
		// If the user is logged in and the current comment was made by them, show the delete button
		if (isset($_SESSION['userId']) && ($currentComment->publishedBy == $_SESSION['userId'])) { ?>
			<form method="post" action="">
				<?php
				echo '<input type="hidden" name="commentId" value="' . $currentComment->id . '" />'
				?>
				<button style="padding:0px 8px" name="delete" value="Delete" type="submit">Delete Comment</button>
			</form>
		<?php
		}
		?>
		<div class="border"></div>
	</div>
<?php
}
}

// Check if the user is logged in and display the comment form or a message to log in
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
?>
<form action="" method="post">
<textarea style="width: 100%;" placeholder="Write your comment here..." name="commentText" required></textarea>
<input type="submit" name="submit" value="Comment as <?php echo ($_SESSION['name']) ?>" class="form-btn">
</form>

<?php
} else {
?>

<p style="text-align:center">You have to be logged in to comment. <a href="login.php">Press here to login</a></p>
<?php
}
?>
</article>
</main>
<?php
