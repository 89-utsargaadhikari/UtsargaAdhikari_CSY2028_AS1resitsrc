<?php
// Include header file
require 'header.php';

// Check admin access
require 'checkAdminAccess.php';

// Include category service file
require_once './service/categoryService.php';

// Create an instance of category service
$categoryService = new CategoryService();

// Initialize category and category id variables
$category;
$categoryId;

// Get category information and prefill form with category information
if (isset($_GET['id'])) {
  $categoryId = $_GET['id'];
  try {
    // Get category information by id
    $category = $categoryService->getById($categoryId);
  } catch (Exception $e) {
    // Error message
  }
}

?>
<main>
  <!-- Include side navigation -->
  <?php
  require 'sidenav.php';
  ?>
  <article>
    <h2 class="text-center">Edit category</h2>
    <!-- Update category information -->
    <?php
    try {
      if (isset($_POST['submit'])) {
        $categoryService->updateCategory($categoryId, $_POST['name']);
        // Redirect to admin categories page
        echo '<script>window.location.href = "adminCategories.php";</script>';
      }
    } catch (Exception $e) {
      echo "<h6 style='color:red'>{$e->getMessage()}</h4>";
    }
    ?>

<form action="" method="POST">
  <div class="row">
    <div class="col-2">
      <!-- Category name label -->
      <label class="form-label">Category Name</label>
    </div>
    <div class="col-10">
      <!-- Category name input field -->
      <input type="text" name="name" class="form-control" value="<?php echo $category?->name ?>" />
    </div>
  </div>
  <!-- Submit button -->
  <input type="submit" name="submit" value="Submit" class="btn btn-primary float-center" />
</form>
  </article>
</main>
<!-- Include footer file -->
<?php
require 'footer.php';
?>