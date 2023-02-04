<?php
// Include header.php file at the top
require 'header.php';

// Include articleService.php file and create an instance of ArticleService class
require_once './service/articleService.php';
$articleService = new ArticleService();
?>
<main>
	<!-- Include sidenav.php file -->
	<?php require 'sidenav.php'; ?>

<article>
	<h2>Articles</h2>
	<form>
		<p>Discover the news and information on a wide range of topics</p>
	</form>

	<?php
	// Get a list of all articles from the database
	$articles = $articleService->getAll();

	// Loop through the articles and display each article as a list item
	foreach ($articles as $currentArticle) {
	?>
		<a class="articleLink" href="fullarticle.php?id=<?php echo $currentArticle->id ?>">

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
<!-- Include footer.php file at the bottom -->
<?php require 'footer.php'; ?>
<style>
	/* Style the article items */
	.article-item {
		display: flex;
		align-items: center;
		list-style-type: circle;
		padding: 12px 8px;
		background-color: white;
	}

	/* Style the publication date of the article */
	.article-date {
		margin-left: auto;
		font-style: italic;
	}
</style>