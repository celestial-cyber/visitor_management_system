<?php
if (!isset($conn)) {
    include 'connection.php';
}
?>
<?php echo "<!-- Sidebar loaded -->"; ?>


<!-- Sidebar -->
<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" 
    id="accordionSidebar" style="min-height:100vh;">

  <!-- Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_dashboard.php">
    <div class="sidebar-brand-icon">
      <i class="fas fa-user-shield"></i>
    </div>
    <div class="sidebar-brand-text mx-3 text-wrap">VMS Console</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Admin Dashboard -->
  <li class="nav-item">
    <a class="nav-link text-wrap" href="admin_dashboard.php" style="white-space: normal; word-wrap: break-word;">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Admin Dashboard</span>
    </a>
  </li>

  <!-- New Visitor -->
  <li class="nav-item">
    <a class="nav-link text-wrap" href="new-visitor.php" style="white-space: normal; word-wrap: break-word;">
      <i class="fas fa-user-plus"></i>
      <span>New Visitor</span>
    </a>
  </li>

  <!-- Manage Visitors -->
  <li class="nav-item">
    <a class="nav-link text-wrap" href="manage-visitors.php" style="white-space: normal; word-wrap: break-word;">
      <i class="fas fa-users"></i>
      <span>Manage Visitors</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Section Title -->
  <div class="sidebar-heading text-wrap" style="white-space: normal; word-wrap: break-word;">
    Event Management
  </div>

  <!-- Manage Events Dropdown -->
  <li class="nav-item">
    <a class="nav-link collapsed text-wrap" href="#" data-toggle="collapse" data-target="#collapseEvents"
      aria-expanded="false" aria-controls="collapseEvents" style="white-space: normal; word-wrap: break-word;">
      <i class="fas fa-calendar-alt"></i>
      <span>Manage Events</span>
    </a>
    <div id="collapseEvents" class="collapse" aria-labelledby="headingEvents" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded d-flex flex-column">
        <a class="collapse-item mb-2 text-wrap" href="add-event.php" style="white-space: normal; word-wrap: break-word;">➕ Add Event</a>
        <a class="collapse-item text-wrap" href="view-event.php" style="white-space: normal; word-wrap: break-word;">📋 View Events</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Logout -->
  <li class="nav-item">
    <a class="nav-link text-wrap" href="logout.php" style="white-space: normal; word-wrap: break-word;">
      <i class="fas fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>
</ul>
