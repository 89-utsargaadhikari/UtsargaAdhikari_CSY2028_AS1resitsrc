<?php
// Import header and checkAdminAccess files
require 'header.php';
require 'checkAdminAccess.php';

// Import category service file
require_once './service/categoryService.php';

// Create an instance of categoryService
$categoryService = new CategoryService();
?>
<main>
	<!-- Import sidenav file -->
	<?php require 'sidenav.php'; ?>
	<!-- Main content -->
<article>
	<h2 class="text-center">Add new category</h2>
	
	<?php
	// Check if the form is submitted
	if (isset($_POST['submit'])) {
		// Try to insert the category
		try {
			$categoryService->insertCategory($_POST['name']);
			// Redirect to adminCategories.php page
			echo '<script>window.location.href = "adminCategories.php";</script>';
		} catch (Exception $e) {
			// Display the error message
			echo "<h6 style='color:red'>{$e->getMessage()}</h4>";
		}
	}
	?>

	<!-- Category form -->
	<form action="" method="POST">
		<div class="row">
			<div class="col-2">
				<label class="form-label">Category Name</label>
			</div>
			<div class="col-10">
				<input type="text" name="name" class="form-control" required />
			</div>
		</div>
		<input type="submit" name="submit" value="Submit" class="btn btn-primary float-center" />
	</form>
</article>

</main>
<?php
require 'footer.php';
?>