<?php
  include_once("../partial/header.php");
  include_once('../../dbConnection.php');
?>

<h1 class="text-center">Create New Movie</h1>

<a href="index.php?tab=movie" class="btn btn-outline-secondary my-2">
  <i class="fa-solid fa-arrow-left"></i>
  Back to Listing
</a>

<?php
  $error_message = '';
  $success_message = '';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['title']) && !empty($_POST['year']) && !empty($_POST['type_id'])) {
      
      $title = $_POST['title'];
      $year = $_POST['year'];
      $type_id = $_POST['type_id'];

      $file = $_FILES['poster'];

      $upload_file = '../images/' . $file['name'];

      move_uploaded_file(
        $file['tmp_name'],
        $upload_file,
      );
      
      // insert into db
      // $date_now = date('Y-m-d h:i:s');
      $sql = "INSERT INTO movies (`title`, `year`, `type_id`, `poster`, `created_at`, `updated_at`) VALUES ('$title', '$year', '$type_id', '$upload_file', now(), now())";

      $result = $conn->query($sql);

      if (!$result) {
        die('query failed: ' . $conn->error);
      }

      $success_message = "Record created successfully!";
    }
    else {
      $error_message = "All fields are required!";
    }
  }
  
  $sql_types = "SELECT * FROM types";
  $result_types = $conn->query($sql_types);
?>

<form method="post" enctype="multipart/form-data">
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
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title"/>
    </div>
    <div class="col-6 mb-3">
      <label for="year" class="form-label">Year</label>
      <input type="text" class="form-control" id="year" name="year"/>
    </div>
    <div class="col-6 mb-3">
      <label for="type" class="form-label">Type</label>
      <select class="form-control" name="type_id">
        <?php while($types = $result_types->fetch_assoc()) { ?>
          <option value="<?= $types['id'] ?>">
            <?= ucfirst($types['name']) ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="col-6 mb-3">
      <label for="poster" class="form-label">Poster</label>
      <input type="file" class="form-control" id="poster" name="poster"/>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-floppy-disk"></i>
        Create
      </button>
    </div>
  </div>
</form>

<?php include_once("../partial/footer.php"); ?>