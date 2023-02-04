<?php
require 'header.php';
require_once './service/userService.php';
$userService = new UserService();
?>
<main>
	<?php
	require 'sidenav.php';
	?>
	<article>
		<h2 class="text-center">Log In</h2>
		<?php
		// If user is already logged in
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
		?>
			<!-- Show a warm message if the user is already logged in -->
			<section class="right">
				<h2>You are now logged in as <?php echo $_SESSION['email'] ?></h2>
			</section>
		<?php
		} else {
			try {
				// Check if submit button is clicked
				if (isset($_POST['submit'])) {
					// Call the loginUser method from userService and store the result in $user
					$user = $userService->loginUser($_POST['email'], $_POST['password']);

				// Start a session for the logged in user
				$_SESSION['userId'] = $user->id;
				$_SESSION['name'] = $user->name;
				$_SESSION['isSuperAdmin'] = $user->isSuperAdmin;
				$_SESSION['isAdmin'] = $user->isAdmin;
				$_SESSION['email'] = $user->email;
				$_SESSION['loggedIn'] = true;
				
				// Redirect to index.php
				echo '<script>window.location.href = "index.php";</script>';
			}
		} catch (Exception $e) {
			// Display the error message
			echo "<h6 style='color:red'>{$e->getMessage()}</h4>";
		}
	?>
		<!-- Show the login form if the user is not logged in -->
		<form action="" method="POST">
			<div class="row">
				<div class="col-6">
					<div class="row">
						<div class="col-2"><label class="form-label">Email</label></div>
						<div class="col-10"><input type="text" name="email" class="form-control" /></div>
					</div>
					<div class="row">
						<div class="col-2"><label class="form-label">Password</label></div>
						<div class="col-10"><input type="password" name="password" class="form-control" /></div>
				

						</div>
						<input type="submit" name="submit" value="Submit" class="btn btn-primary float-center" />
					</div>
			
				</div>
			</form>
		<?php
		}
		?>
	</article>
</main>
<?php
require 'footer.php';
?>