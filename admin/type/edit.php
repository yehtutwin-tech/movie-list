<?php include_once("../partial/header.php"); ?>

<h1 class="text-center">Edit Type</h1>

<a href="index.php?tab=type" class="btn btn-outline-secondary my-2">
  <i class="fa-solid fa-arrow-left"></i>
  Back to Listing
</a>

<?php
  include_once('../../dbConnection.php');

  $error_message = '';
  $success_message = '';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id']) && !empty($_POST['name'])) {
      
      $id = $_POST['id'];
      $name = $_POST['name'];

      // insert into db
      // $date_now = date('Y-m-d h:i:s');
      $sql = "UPDATE types SET `name`='$name', `updated_at`=now() WHERE id=$id";

      $result = $conn->query($sql);

      if (!$result) {
        die('query failed: ' . $conn->error);
      }

      $success_message = "Record updated successfully!";
    }
    else {
      $error_message = "All fields are required!";
    }
  }

  if (!isset($_GET['id'])) {
    header('Location: index.php?tab=type');
  }

  $id = $_GET['id'];

  $sql = "SELECT * FROM types WHERE id=$id";

  $result = $conn->query($sql);

  $row = $result->fetch_assoc();

  if (!$row) {
    header('Location: index.php?tab=type');
  }
?>
<hr/>

<form method="post">
  <input type="hidden" name="id" value="<?= $row['id'] ?>"/>
  <div class="row my-3">
    <?php if ($error_message) { ?>
    <div class="col-12 mb-3">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $error_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
    <?php } ?>
    <?php if ($success_message) { ?>
    <div class="col-12 mb-3">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $success_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
    <?php } ?>
    <div class="col-6 mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="<?= $row['name'] ?>"/>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-floppy-disk"></i>
        Update
      </button>
    </div>
  </div>
</form>

<?php include_once("../partial/footer.php"); ?>