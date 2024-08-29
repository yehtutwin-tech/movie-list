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

  // while($row = $result->fetch_assoc()) {
  //   echo $row['name'];
  //   echo "<br />";
  // }
?>
<hr/>
<table border="1">
  <thead>
    <tr>
      <th>Name</th>
      <th>Created At</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['created_at'] ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>