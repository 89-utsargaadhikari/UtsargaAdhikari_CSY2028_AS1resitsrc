<?php
require 'header.php';
require 'checkAdminAccess.php';
require_once './service/userService.php';
$userService = new UserService();
$userId;
$user = null;

// Check if the GET request has a userId parameter and assign it to the userId variable
if (isset($_GET['userId'])) {
	$userId = $_GET['userId'];
	// Try to retrieve the user information by userId
	try {
		$user = $userService->getById($userId);
	} catch (Exception $e) {
		// If an exception is thrown, catch it and do nothing
	}
}

?>
<main>
	<?php
	require 'sidenav.php';
	?>

<article>
	<h2>Add New Admin</h2>
	<?php
	// If the form is submitted, try to update the user information
	try {
		if (isset($_POST['submit'])) {
			$userService->updateUser($userId, $_POST['name'], $_POST['email']);
			// Redirect the user to manageAdmins.php after the user information is updated
			echo '<script>window.location.href = "manageAdmins.php";</script>';
		}
	} catch (Exception $e) {
		// If an exception is thrown, catch it and display an error message
		echo "<h6 style='color:red'>{$e->getMessage()}</h4>";
	}
	?>
	<form action="" method="POST">
		<!-- Form prompt -->
		<p>Please enter your information below</p>
		<div class="row">
			<div class="col-2">
				<label class="form-label">Full Name</label>
			</div>
			<!-- Prefill the form with user information, if it exists -->
			<div class="col-10">
				<input type="text" name="name" value="<?php echo $user ? $user->name : ''; ?>" class="form-control" required />
			</div>
		</div>
		<div class="row">
			<div class="col-2">
				<label class="form-label">Email</label>
			</div>
			<!-- Prefill the form with user information, if it exists -->
			<div class="col-10">
				<input type="text" name="email" value="<?php echo $user ? $user->email : ''; ?>" class="form-control" required />
			</div>
		</div>
		<input type="submit" name="submit" value="Submit" class="btn btn-primary float-center" />
	</form>

</article>
</main>
<?php
require 'footer.php';
?>