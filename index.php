<?php
  include_once('partial/header.php');
  include_once('dbConnection.php');
?>

<div class="row my-3">
  <div class="col-4 offset-4">
    <form method="get">
      <div class="input-group mb-3">
        <input name="title" type="text" class="form-control outline-0" placeholder="Search by Ttile..." value="<?= isset($_GET['title']) ? $_GET['title'] : '' ?>">
        <button class="btn btn-outline-secondary" type="submit">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
    </form>
  </div>
</div>
<div class="row my-3">
  <?php
    $sql = "SELECT `movies`.*, `types`.`name` AS type_name FROM `movies` LEFT JOIN `types` ON `movies`.`type_id` = `types`.`id`";

    if (isset($_GET['title'])) {
      $title = $_GET['title'];

      $sql .= " WHERE `title` LIKE '%$title%'";
    }
    
    $sql .= " ORDER BY `movies`.`id` DESC";

    $result = $conn->query($sql);

    if (!$result) {
      die('query failed: ' . $conn->error);
    }

    while($row = $result->fetch_assoc()) { 
  ?>
  <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
    <div class="card shadow-sm">
      <img src="admin/<?= str_replace('../', './', $row['poster']) ?>" class="card-img-top" alt="Img">
      <div class="card-body">
        <h5 class="card-title"><?= $row['title'] ?></h5>
        Year: <?= $row['year'] ?>
        Type: <?= $row['type_name'] ?>
      </div>
    </div>
  </div>
  <?php } ?>
</div>

<?php include_once('partial/footer.php'); ?>