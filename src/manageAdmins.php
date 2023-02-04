<?php
// Requiring header and checkAdminAccess files
require 'header.php';
require 'checkAdminAccess.php';

// Requiring userService class
require_once './service/userService.php';

// Instantiating the UserService class
$userService = new UserService();

// Array to store all the admins
$adminList = [];
?>
<main>
	<?php
		// Requiring sidenav
		require 'sidenav.php';
	?>

<article>
	<!-- Add new admin button -->
	<a class="articleLink" href="addAdmin.php"><button style="padding:0px 12px; margin-left:80%" type="button">Add New Admin</button></a>

	<?php
		// Checking if the delete button was clicked and the id was sent
		if (isset($_POST['delete']) && isset($_POST['id'])) {
			try {
				// Deleting the admin
				$userService->deleteUser($_POST['id']);
				echo "<h6 style='color:green'>Admin has been deleted</h4>";
			} catch (Exception $e) {
				echo "<h6 style='color:red'>{$e->getMessage()}</h4>";
			}
		}
	?>

	<!-- Table to display all the admins -->
	<table>
		<?php
			// Getting all the admins
			$adminList = $userService->getAllAdmins();

			// Checking if there are no admins registered
			if (empty($adminList)) {
				echo '<h2  style="text-align:center; margin-top:50px"> No Admin Found</h2>';
			} else {
		?>

				<!-- Table headers -->
				<tr>
					<th style="text-align:center">
						<h4>Full Name</h4>
					</th>
					<th style="text-align:center">
						<h4>Email Address</h4>
					</th>
					<th style="text-align:center">
						<h4>Registered date</h4>
					</th>
					<th style="text-align:center">
						<h4>Actions</h4>
					</th>
				</tr>

				<!-- Looping through all the admins -->
				<?php
					foreach ($adminList as $currentAdmin) {
				?>
					<tr>
						<!-- Displaying full name -->
						<td style="text-align:center">
							<?= $currentAdmin->name ?>
						</td>
						<td style="text-align:center">
							<?= $currentAdmin->email ?>
						</td>
						<td style="text-align:center">
							<?= $currentAdmin->createdAt ?>
						</td>
						<th style="text-align:center">
							<form method="post" action="">
								<a href="editAdmin.php?userId=<?= $currentAdmin->id ?>"><button style="padding:0px 8px" type="button"> Edit </button></a>
								<?php
								// If admin is super admin then dont allow to delte the super admin
								if (!($currentAdmin->isSuperAdmin)) {
									echo '<input type="hidden" name="id" value="' . $currentAdmin->id . '" />'
								?>
									<button style="padding:0px 8px" name="delete" value="Delete" type="submit">Delete </button>
								<?php
								}
								?>
							</form>


						</th>
					</tr>
			<?php
				}
			}
			?>
			<div>
				</form>
		</table>
	</article>
</main>

<?php
require 'footer.php'; //implementing footer
?><style>
	th {
		padding: 8px 0px;
		border-bottom: 1px solid #333;
	}

	form {
		padding-top: 0px !important;
		margin-top: 0px !important;
		border-top: 0px solid #888 !important;
	}
</style>