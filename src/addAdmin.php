<?php
require 'header.php';
require 'checkAdminAccess.php';
require_once './service/userService.php';

//Create instance of userService
$userService = new UserService();
?>
<main>
	<?php

	//Include the sidenav
	require 'sidenav.php';
	?>

	<article>
	<h2>Add New Admin</h2>
	<?php
	// Try to create an admin and handle any errors
	try {
		if (isset($_POST['submit'])) {
			// Call the createAdmin method with the posted name, email, and password
			$userService->createAdmin($_POST['name'], $_POST['email'], $_POST['password']);
			// Redirect to the manageAdmins page
			echo '<script>window.location.href = "manageAdmins.php";</script>';
		}
	} catch (Exception $e) {
		// Display the error message in red
		echo "<h6 style='color:red'>{$e->getMessage()}</h4>";
	}
	?>
	<form action="" method="POST">
		<p>Please enter your information below</p>
		<div class="row">
			<div class="col-2"><label class="form-label">Full Name</label></div>
			<div class="col-10">
				<input type="text" name="name" class="form-control"  required/>
			</div>
		</div>
		<div class="row">
			<div class="col-2">
				<label class="form-label">Email</label>
			</div>
			<div class="col-10">
				<input type="text" name="email" class="form-control"  required/>
			</div>
		</div>
		<div class="row">
			<div class="col-2">
				<label class="form-label">Password</label>
			</div>
			<div class="col-10">
				<input type="password" name="password" class="form-control" required />
			</div>
		</div>
		<input type="submit" name="submit" value="Submit" class="btn btn-primary float-center" />
	</form>
</article>

</main>
<?php
require 'footer.php';
?>

