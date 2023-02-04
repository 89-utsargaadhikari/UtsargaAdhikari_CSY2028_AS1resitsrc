<?php
require 'header.php';
require_once './service/commentService.php';
require_once './service/userService.php';

// Initializing CommentService and UserService classes
$commentService = new CommentService();
$userService = new UserService();

// Setting up an empty array for comments
$comments = [];
$user = null;

// Get the user ID from the GET request
if (isset($_GET['userId'])) {
	try {
		// Try to get the user information using the user ID
		$user = $userService->getById($_GET['userId']??0);

		// Get all the comments made by the user using the user ID
		$comments = $commentService->getByUserId($_GET['userId'] ??0);
	} catch (Exception $ex) {
		// If an error occurs, set the comments array to an empty array
		$comments = [];
	}
}
?>
<main>
	<?php
	// Include the sidenav
	require 'sidenav.php';
	?>
	<article>
		<h2>Comments</h2>
		<form>
			<p>All the comments made by <?php echo $user?->name  ?></p>
		</form>
		<?php
		// Loop through each comment
		foreach ($comments as $currentComment) {
		?>
			<li class="article-item">
				<div>
					<!-- Display the article title -->
					<b><?php echo $currentComment->articleTitle ?></b>
					<!-- Display the comment content -->
					<p><?php echo $currentComment->content ?></p>
					<!-- Display the date the comment was published -->
					<p><?php echo $currentComment->publishedDate ?></p>
				</div>
			</li>
		<?php
		}
		?>
	</article>
</main>
<?php
require 'footer.php';
?>
<style>
	.article-item {
		display: flex;
		align-items: center;
		list-style-type: circle;
		padding: 12px 8px;
		background-color: white;
	}
</style>