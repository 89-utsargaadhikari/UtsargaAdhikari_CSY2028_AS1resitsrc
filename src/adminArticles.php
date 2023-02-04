<?php
// Include the required files: header.php, checkAdminAccess.php, categoryService.php, and articleService.php
require 'header.php';
require 'checkAdminAccess.php';
require_once './service/categoryService.php';
require_once './service/articleService.php';

// Create instances of ArticleService and CategoryService classes
$articleService = new ArticleService();
$categoryService = new CategoryService();

// Initialize an empty array to store the article list
$articleList = [];

// Main content
?>
<main> 
  <!-- Include the sidenav.php file -->
		<?php require 'sidenav.php'; ?>

	<article>
		<a class="articleLink" href="addArticle.php"><button style="padding:0px 12px; margin-left:82%" type="button"> Add New Article</button></a>
		<?php
		try {
			if (isset($_POST['delete']) && isset($_POST['id'])) {
				$articleService->deleteArticleById($_POST['id']);
				echo "<h6 style='color:green'>Article has been deleted</h4>";
			}
		} catch (Exception $e) {
			echo "<h6 style='color:red'>{$e->getMessage()}</h4>";
		}
		?>
		<table>
			<?php
			$articleList = $articleService->getAll();
			// If there are no articles then show a message else display article int a list
			if (empty($articleList)) {
				echo '<h2  style="text-align:center; margin-top:50px"> No Category Found</h2>';
			} else {
			?>

				<tr>
					<th style="text-align:center">
						<h4>S.No</h4>
					</th>
					<th style="text-align:center">
						<h4>Title</h4>
					</th>
					<th style="text-align:center">
						<h4>Author</h4>
					</th>
					<th style="text-align:center">
						<h4>Published Date</h4>
					</th>
					<th style="text-align:center">
						<h4>Actions</h4>
					</th>
				</tr>
				<?php
				foreach ($articleList as $currentData) { ?>
					<tr>
						<td style="text-align:center">
							<?= array_search($currentData, $articleList) + 1 ?>
						</td>
						<td style="text-align:center">
							<?= $currentData->title ?>
						</td>
						<td style="text-align:center">
							<?= $currentData->publishedUser ?? 'Unknown' ?>
						</td>
						<td style="text-align:center">
							<?= $currentData->publishedDate ?>
						</td>
						<th style="text-align:center">
							<form method="post" action="">
								<a href="editArticle.php?id=<?= $currentData->id ?>"><button style="padding:0px 8px" type="button"> Edit </button></a>
								<?php

								echo '<input type="hidden" name="id" value="' . $currentData->id . '" />'
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