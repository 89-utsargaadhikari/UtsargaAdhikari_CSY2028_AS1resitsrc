<?php
session_start();
require_once './service/categoryService.php';
// Start a session for the user

// Include the categoryService file

$categoryService = new CategoryService();
// Create a new instance of the CategoryService class

$categories = $categoryService->getAll();
// Get all the categories from the database using the getAll() method of the CategoryService class

?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="styles.css" />
	<!-- Link to the stylesheet file -->
	<title>Northampton News</title>
	<!-- Page title -->
</head>
<body>
	<header>
		<section>
			<h1>Northampton News</h1>
			<!-- Page header -->
		</section>
	</header>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<!-- Home page link -->
			<li><a href="articles.php">Articles</a></li>
			<!-- Articles page link -->
			<li><a href="">Category</a>
				<ul>
					<?php
					foreach ($categories as $row) {
						echo '<li><a href="category.php?id=' . $row->id . '">' . $row->name . '</a></li>';
						// Display all the categories as a list
						// Each category has a link to its respective page (category.php) with its ID as a query string parameter
					}
					?>
				</ul>
			</li>
			<?php
			if (!isset($_SESSION['loggedIn'])) {
				echo '<li><a href="login.php"> Sign In</a></li>';
				// Display the sign-in link if the user is not logged in
				echo '<li><a href="register.php"> Sign Up</a></li>';
				// Display the sign-up link if the user is not logged in
			} else {
				echo '<li><a href="logout.php">Logout</a></li>';
				// Display the logout link if the user is logged in
			}
			?>
			<li></li>
		</ul>
	</nav>
	<img src="images/banners/randombanner.php" />