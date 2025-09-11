<?php
session_start();
include 'connection.php';

// ✅ Only allow logged-in users
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// ✅ Fetch events from tbl_events
$sql = "SELECT * FROM tbl_events ORDER BY event_id DESC";
$result = mysqli_query($conn, $sql);

// Debug (optional)
// if (!$result) {
//     die("Query failed: " . mysqli_error($conn));
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Events</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3 class="mb-3">📅 Events List</h3>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Event Name</th>
          <th>Description</th>
          <th>Date</th>
          <th>Location</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['event_id']; ?></td>
              <td><?php echo htmlspecialchars($row['event_name']); ?></td>
              <td><?php echo htmlspecialchars($row['description']); ?></td>
              <td><?php echo htmlspecialchars($row['event_date']); ?></td>
              <td><?php echo htmlspecialchars($row['location']); ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center">No events found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
