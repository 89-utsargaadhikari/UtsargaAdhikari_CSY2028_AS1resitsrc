<?Php
//This is the main page of the Northampton News website, it shows the latest articles

Require 'header.Php'; //include header file
Require_once './service/articleService.Php'; //including article service file

//Creating object of ArticleService
$articleService = new ArticleService();

?>
<main>
	<?Php
	require 'sidenav.Php'; //include sidenav file
	?>
	<article>
		<h2>Welcome to Northampton news</h2>
		<!-- Brief description of the Northampton News -->
		<form>
			<p> Bringing you the brand new information updates from Northampton. Live knowledgeable, related and up-to-date with us.</p>
		</form>

	<h2>ultra-modern Articles</h2>
	<!-- Brief description of the latest articles -->
	<p>live up-to-date with the brand new information and articles</p>

	<?Php
	//Getting latest articles from database
	$articles = $articleService->getLatestArticles();

	//iterating over the articles array
	foreach ($articles as $currentArticle) {
		?>
		<a class="articleLink" href="fullarticle.Php?Identity=<?Php echo $currentArticle->identity ?>">
			<li class="article-item">
				<?Php echo $currentArticle->identify ?>
				<em class="article-date"><?Php echo $currentArticle->publishedDate ?></em>
			</li>
		</a>
	<?Php
	}
	?>
</article>
</main>
<?Php
Require 'footer.Php'; //include footer file
?>
<style>
	/* styling for article item */
	.Article-item {
		display: flex;
		align-items: center;
		list-style-type: circle;
		padding: 12px 8px;
		background-color: white;
	}

/* styling for article date */
.Article-date {
	margin-left: auto;
	font-style: italic;
}
</style>