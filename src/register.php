<?php
// Include header.php file
require 'header.php';

// Require userService class and create an object
require_once './service/userService.php';
$userService = new UserService();

?>
<main>
	<!-- Include sidenav.php file -->
	<?php
	require 'sidenav.php';
	?>

<article>
	<h2>Sign Up</h2>
	
	<?php
	// If the form is submitted, try to create a new user
	try {
		if (isset($_POST['submit'])) {
			$userService->createUser($_POST['name'], $_POST['email'], $_POST['password']);
			echo '<script>window.location.href = "login.php";</script>';
		}
	} catch (Exception $e) {
		// If an exception is caught, display the error message
		echo "<h6 style='color:red'>{$e->getMessage()}</h4>";
	}
	?>
	
	<!-- Sign up form -->
	<form action="" method="POST">
		<p>Please enter your information below</p>
		<div class="row">
			<!-- Full Name label and input -->
			<div class="col-2"><label class="form-label">Full Name</label></div>
			<div class="col-10"><input type="text" name="name" class="form-control" /> </div>
		</div>
		<div class="row">
			<!-- Email label and input -->
			<div class="col-2">
				<label class="form-label">Email</label>
			</div>
			<div class="col-10">
				<input type="text" name="email" class="form-control" />
			</div>
		</div>
		<div class="row">
			<!-- Password label and input -->
			<div class="col-2">
				<label class="form-label">Password</label>
			</div>
			<div class="col-10">
				<input type="password" name="password" class="form-control" />
			</div>
		</div>
		<!-- Submit button -->
		<input type="submit" name="submit" value="Submit" class="btn btn-primary float-center" />
	</form>

</article>
</main>
<!-- Include footer.php file -->
<?php
require 'footer.php';
?>