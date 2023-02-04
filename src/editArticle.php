<?php
// Import required files
require 'header.php';
require 'checkAdminAccess.php';
require_once './service/categoryService.php';
require_once './service/articleService.php';

// Create instances of article and category services
$articleService = new ArticleService();
$categoryService = new CategoryService();

// Get all categories
$categories = [];
try {
	$categories = $categoryService->getAll();
} catch (Exception $e) {
	$categories = [];
}

// Get article information if id exists in GET
$articleId;
$article = null;
if (isset($_GET['id'])) {
	$articleId = $_GET['id'];
	try {
		$article = $articleService->getById($articleId);
	} catch (Exception $e) {
		// catch error if any
	}
}
?>
<main>
	<?php require 'sidenav.php'; ?>
	<article>
		<h2>Edit Article</h2>
		<?php
		try {
			if (isset($_POST['submit'])) {
				// If form is submitted, update article information
				$image = $_FILES['image'];
				$file = null;
				if (isset($image) && $image["error"] == 0) {
					$file = $image;
				}
				$articleService->updateArticle($articleId, $_POST['title'], $_POST['content'], $_POST['categoryId'], $file);
				// Redirect to admin articles page after update
				echo '<script>window.location.href = "adminArticles.php";</script>';
			}
		} catch (Exception $e) {
			echo "<h6 style='color:red'>{$e->getMessage()}</h6>";
		}
		?>
		<!-- Edit article form -->
		<form action="" method="POST" enctype="multipart/form-data">
			<!-- Title input -->
			<div class="row">
				<div class="col-2">
					<label class="form-label">Title</label>
				</div>
				<div class="col-10">
					<input type="text" name="title" value="<?php echo $article?->title; ?>" class="form-control" required />
				</div>
			</div>

		<!-- Content input -->
		<div class="row">
			<div class="col-2">
				<label class="form-label">Content</label>
			</div>
			<div class="col-10">
				<textarea name="content" class="form-control" required><?php echo $article?->content; ?></textarea>
			</div>
		</div>


		<div class="row">
				<!-- Start of the first row, containing the Category label and select -->
				<div class="col-2">
					<!-- Start of the first column, containing the label for the category -->
					<label class="form-label">Category</label>
					<!-- End of the first column -->
				</div>
				<div class="col-10">
					<!-- Start of the second column, containing the select element for the category -->
					<select name="categoryId" required>
						<!-- PHP code to populate the select options with the categories -->
						<?php
						foreach ($categories as $category) {
							// Check if the current category should be selected
							if ($category->id == $article->categoryId) {
								// If so, add a "selected" attribute to the option
								echo '<option selected="selected" value="' . $category->id . '">' . $category->name . '</option>';
							} else {
								// If not, don't add a "selected" attribute
								echo '<option value="' . $category->id . '">' . $category->name . '</option>';
							}
						};
						// End of the PHP code
						?>
					</select>
					<!-- End of the second column -->
				</div>
				<!-- End of the first row -->
			</div>
			<!-- Start of the second row, containing the hidden input field -->
			<div class="row">
				<div class="col-2">
					<!-- Start of the first column, containing the hidden input field -->
					<input type="hidden" class="form-control"></input>
					<!-- End of the first column -->
				</div>
				<!-- End of the second row -->

		<!-- Start of the third row, containing the Image label and file input field -->
		<div class="row">
			<div class="col-2">
				<!-- Start of the first column, containing the label for the image -->
				<label class="form-label">Image</label>
				<!-- End of the first column -->
			</div>
			<div class="col-10">
				<!-- Start of the second column, containing the file input field for the image -->
				<input type="file" class="col-9" name="image" accept="image/png, image/jpeg" />
				<!-- End of the second column -->
				</div>
			</div>
			<input type="submit" name="submit" value="Submit" class="btn btn-primary float-center" />
		</form>
	</article>
</main>
<?php
require 'footer.php';
?>