<?php
  include_once("../partial/header.php");
  include_once('../../dbConnection.php');
?>

<h1 class="text-center">Movie List</h1>

<a href="add.php?tab=movie" class="btn btn-outline-secondary my-2">Create New</a>

<?php
  $sql = "SELECT `movies`.*, `types`.`name` AS type_name FROM `movies` INNER JOIN `types` ON `movies`.`type_id` = `types`.`id` ORDER BY `movies`.`id` DESC";

  $result = $conn->query($sql);

  if (!$result) {
    die('query failed: ' . $conn->error);
  }
?>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">Poster</th>
      <th scope="col">Title</th>
      <th scope="col">Year</th>
      <th scope="col">Type</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td>
        <img src="<?= $row['poster'] ?>" width="50" />
      </td>
      <td><?= $row['title']; ?></td>
      <td><?= $row['year']; ?></td>
      <td><?= ucfirst($row['type_name']); ?></td>
      <td><?= $row['created_at']; ?></td>
      <td>
        <a href="edit.php?tab=movie&id=<?= $row['id']; ?>">Edit</a>
        <a href="delete.php?tab=movie&id=<?= $row['id']; ?>">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<?php include_once("../partial/footer.php"); ?>