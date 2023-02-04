<?php
// Include header file
require 'header.php';

// Require categoryService file only once
require_once './service/categoryService.php';

// Initialize categoryService object
$categoryService = new CategoryService();

// Store categories in an array
$categories = [];

// Try to get all categories from the database
try {
	$categories = $categoryService->getAll();
} catch (Exception $ex) {
	// If an exception is thrown, set categories to an empty array
	$categories = [];
}
?>
<main>
	<!-- Include sidenav file -->
	<?php require 'sidenav.php'; ?>
	<article>
		<h2>Categories</h2>
		<form>
			<!-- Display a message about the category list -->
			<p>List of all the categories</p>
		</form>
		<?php
		// Loop through each category
		foreach ($categories as $currentCategory) {
		?>
			<!-- Display each category as a link to category.php -->
			<a class="categoryLink" href="category.php?id=<?php echo $currentCategory->id ?>">
				<!-- Display category name in a list item with a specific style -->
				<li class="article-item">
					<?php echo $currentCategory->name ?>
				</li>
			</a>
		<?php
		}
		?>
	</article>
</main>
<!-- Include footer file -->
<?php require 'footer.php'; ?>
<!-- Style for article-item class -->
<style>
	.article-item {
		display: flex;
		align-items: center;
		list-style-type: circle;
		padding: 12px 8px;
		background-color: white;
	}
</style>