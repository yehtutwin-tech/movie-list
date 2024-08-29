<?php include_once("../partial/header.php"); ?>

<h1 class="text-center">Type List</h1>

<a href="add.php" class="btn btn-outline-secondary my-2">Create New</a>

<?php
  include_once('../../dbConnection.php');
  
  $sql = "SELECT * FROM types";

  $result = $conn->query($sql);

  if (!$result) {
    die('query failed: ' . $conn->error);
  }
?>
<hr/>
<table class="table table-bordered table-strped table-hover">
  <thead>
    <tr>
      <th>Name</th>
      <th>Created At</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['created_at'] ?></td>
      <td>
        <a
          href="<?= PROJECT_ROOT ?>/admin/type/edit.php?id=<?= $row['id'] ?>"
          class="btn btn-warning"
        >
          <i class="fa-regular fa-pen-to-square"></i>
        </a>
        <a
          href="<?= PROJECT_ROOT ?>/admin/type/delete.php?id=<?= $row['id'] ?>"
          class="btn btn-danger"
        >
          <i class="fa-solid fa-trash-can"></i>
        </a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>