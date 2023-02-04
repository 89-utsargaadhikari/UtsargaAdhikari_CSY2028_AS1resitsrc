<?php

// requiring the header file
require 'header.php';

// requiring the checkAdminAccess file
require 'checkAdminAccess.php';

// requiring the category service
require_once './service/categoryService.php';

// creating an instance of the category service
$categoryService = new CategoryService();

// creating an array for category list
$categoryList = [];

?>
<main>
	<!-- including the sidenav file -->
	<?php require 'sidenav.php'; ?>

	<article>
	<!-- Add new category button -->
	<a class="articleLink" href="addCategory.php">
		<button style="padding:0px 12px; margin-left:79%" type="button"> Add New Category</button>
	</a>

<!-- PHP code block to delete a category -->
<?php
	try {
		if (isset($_POST['delete']) && isset($_POST['id'])) {
			// Call delete method of categoryService and pass id
			$categoryService->delete($_POST['id']);
			// Display success message after deletion
			echo "<h6 style='color:green'>Category has been deleted</h4>";
		}
	} catch (Exception $e) {
		// Display error message if any exception occurs
		echo "<h6 style='color:red'>{$e->getMessage()}</h4>";
	}
?>

<!-- Table to display list of categories -->
<table>
	<?php
		// Get all categories
		$categoryList = $categoryService->getAll();
		// Check if there are no categories
		if (empty($categoryList)) {
			// Display message if no categories found
			echo '<h2  style="text-align:center; margin-top:50px"> No Category Found</h2>';
		} else {
	?>

	<!-- Table headers -->
	<tr>
		<th style="text-align:center">
			<h4>S.No</h4>
		</th>
		<th style="text-align:center">
			<h4>Name</h4>
		</th>
		<th style="text-align:center">
			<h4>Actions</h4>
		</th>
	</tr>

	<!-- Loop to display all categories -->
	<?php
		foreach ($categoryList as $currentAdmin) { 
	?>
		<tr>
			<!-- Serial number of the category -->
			<td style="text-align:center">
				<?= array_search($currentAdmin, $categoryList) + 1 ?>
			</td>
			<!-- Name of the category -->
			<td style="text-align:center">
				<?= $currentAdmin->name ?>
			</td>
			<!-- Edit and delete buttons -->
			<th style="text-align:center">
				<form method="post" action="">
					<!-- Edit button with id of the category as parameter -->
					<a href="editCategory.php?id=<?= $currentAdmin->id ?>">
						<button style="padding:0px 8px" type="button"> Edit </button>
							</a>
								<?php

								echo '<input type="hidden" name="id" value="' . $currentAdmin->id . '" />'
								?>
								<button style="padding:0px 8px" name="delete" value="Delete" type="submit">Delete </button>
							</form>


						</th>
					</tr>
			<?php
				}
			}
			?>
			<div>
				</form>
		</table>
	</article>
</main>

<?php
require 'footer.php'; //implementing footer
?><style>
	th {
		padding: 8px 0px;
		border-bottom: 1px solid #333;
	}

	form {
		padding-top: 0px !important;
		margin-top: 0px !important;
		border-top: 0px solid #888 !important;
	}
</style>