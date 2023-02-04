<?php
//If user is not logged in then no menu options is displayed in sidebar
if (!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])) {
	echo '<nav>
			</nav>';
} else {
	echo '<nav>
	<ul class="list-group list-group-flush">';
	// Admin Sections
	if ($_SESSION['isAdmin']) {
		echo '<li><a href="adminArticles.php">All Articles</a></li>';
		echo '<li><a href="addArticle.php">Add new article</a></li>';
		echo '<li><a href="adminCategories.php">All Categories</a></li>';
		echo '<li><a href="addCategory.php">Add new category</a></li>';
		echo '<li><a href="manageAdmins.php">Manage Admins</a></li>';
	} else {
		echo '<li><a href="articles.php">All Articles</a></li>';
		echo '<li><a href="categories.php">All Categories</a></li>';
	}
	echo '</ul>
			</nav>';
}
