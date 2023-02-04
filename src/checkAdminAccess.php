<?php
//Checks if user is logged in and if user is admin
//Use to restrict logged in user from admin-only-authorized page
//If  logged in user is not admin then redirect to index.php page 
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true&& $_SESSION['isAdmin'] == true) {
} else {
	echo '<script>window.location.href = "index.php";</script>';
}
