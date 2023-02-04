<?php
// require header.php to include header section of the HTML page
require 'header.php';

// require checkAdminAccess.php to verify user access permission
require 'checkAdminAccess.php';
?>
<main>
	<?php
	// require sidenav.php to include side navigation bar
	require 'sidenav.php';
	?>

<article>
	<h2>Logout</h2>
	<?php
	// Logs out the user by destroying the session information
	session_unset();
	session_destroy();
	
	// Redirecting to the index page
	echo '<script>window.location.href = "index.php";</script>';
	?>
</article>
</main>
<?php
// require footer.php to include footer section of the HTML page
require 'footer.php';
?>