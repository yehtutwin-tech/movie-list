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