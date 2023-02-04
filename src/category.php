<?php
//Including the header page
require 'header.php';

//Including the articleService and categoryService
require_once './service/articleService.php';
require_once './service/categoryService.php';

//Creating objects of articleService and categoryService
$articleService = new ArticleService();
$categoryService = new CategoryService();

//Creating an empty articles array
$articles = [];
$category = null;

//Getting list of all articles of this category from database
if (isset($_GET['id'])) {
	//Trying to get the category and articles
	try {
		//Getting the category by id
		$category = $categoryService->getById($_GET['id']);
		
		//Getting articles of the current category
		$articles = $articleService->getByCategoryId($_GET['id']);
	} catch (Exception $ex) {
		//If exception occurs, do nothing
	}
}
?>
<main>
	<!--Including sidenav page-->
	<?php
	require 'sidenav.php';
	?>
	<article>
		<!--Displaying category name-->
		<h2><?php echo $category->name ?>'s Articles</h2>
		<form>
			<!--Displaying message with category name-->
			<p>Discover the news and information on <b><?php echo $category->name ?></b></p>
		</form>
		<?php
		//Displaying all the articles of this category
		foreach ($articles as $currentArticle) {
		?>
			<!--Creating a link to fullarticle.php with article id as parameter-->
			<a class="articleLink" href="fullarticle.php?id=<?php echo $currentArticle->id ?>">
				<!--Displaying article title and published date-->
				<li class="article-item">
					<?php echo $currentArticle->title ?>
					<em class="article-date"><?php echo $currentArticle->publishedDate ?></em>
				</li>
			</a>
		<?php
		}
		?>
	</article>
</main>
<!--Including footer page-->
<?php
require 'footer.php';
?>
<!--Styling the article items-->
<style>
	.article-item {
		display: flex;
		align-items: center;
		list-style-type: circle;
		padding: 12px 8px;
		background-color: white;
	}

	.article-date {
		margin-left: auto;
		font-style: italic;
	}
</style>