<?php

// Include header file
require 'header.php';

// Check if the user has access to the page
require 'checkAdminAccess.php';

// Include the category service and article service files
require_once './service/categoryService.php';
require_once './service/articleService.php';

// Initialize the article and category services
$articleService = new ArticleService();
$categoryService = new CategoryService();

// Get all categories and store them in the $categories variable
$categories;
try {
	$categories = $categoryService->getAll();
} catch (Exception $e) {
	// If an exception occurs, set $categories to an empty array
	$categories = [];
}

?>

<!-- Main section -->
<main>
	<!-- Include the sidenav file -->
	<?php require 'sidenav.php'; ?>

	<!-- Article section -->
	<article>
		<!-- Add New Article header -->
		<h2>Add New Article</h2>
		
		<!-- If the submit button is clicked -->
		<?php
		try {
			if (isset($_POST['submit'])) {
				// Store the uploaded image
				$image=$_FILES['image'];
				$file=null;
				// Check if the image was uploaded
				if (isset($image) && $image["error"] == 0) {
					$file = $image;
				}
				// Call the addArticle method and pass the required parameters
				$articleService->addArticle($_POST['title'], $_POST['content'], $_POST['category'], $_SESSION['userId'], $file);
				// Redirect the user to the adminArticles.php page
				echo '<script>window.location.href = "adminArticles.php";</script>';
			}
		} catch (Exception $e) {
			// If an exception occurs, display the error message in a h6 tag with a red color
			echo "<h6 style='color:red'>{$e->getMessage()}</h4>";
		}
		?>
		
		<!-- Form for adding a new article -->
		<form action="" method="POST" enctype="multipart/form-data">
			<!-- Row for the article title -->
			<div class="row">
				<div class="col-2">
					<label class="form-label">Title</label>
				</div>
				<div class="col-10">
					<input type="text" name="title" class="form-control" required />
				</div>
			</div>
			<!-- Row for the article content -->
			<div class="row">
				<div class="col-2">
					<label class="form-label">Content</label>
				</div>


				<div class="col-10">
					<textarea name="content" class="form-control" required></textarea>
				</div>
			</div>

			<div class="row">
				<div class="col-2">
					<label class="form-label">Category</label>
				</div>
				<div class="col-10">
					<select name="category" required>
						<?php
						foreach ($categories as $category) {
							echo '<option value=' . $category->id . '>' . $category->name . '</option>';
						};
						?>
				</div>
			</div>
			<div class="row">
				<div class="col-2">
					<input type="hidden" class="form-control"></input>
				</div>

			</div>

			<div class="row">
				<div class="col-2">
					<label class="form-label">Image</label>
				</div>
				<div class="col-10">
					<input type="file" class="col-9" name="image" accept="image/png, image/jpeg" />
				</div>
			</div>
			<input type="submit" name="submit" value="Submit" class="btn btn-primary float-center" />
		</form>
	</article>
</main>
<?php
require 'footer.php';
?>