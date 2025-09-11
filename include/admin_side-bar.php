<?php
if (!isset($conn)) {
    include 'connection.php';
}
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" 
    id="accordionSidebar" style="min-height:100vh;">

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Admin Dashboard -->
  <li class="nav-item">
    <a class="nav-link text-wrap" href="admin_dashboard.php" 
       style="white-space: normal; word-wrap: break-word;">
      Admin Dashboard
    </a>
  </li>

  <!-- New Visitor -->
  <li class="nav-item">
    <a class="nav-link text-wrap" href="new-visitor.php" 
       style="white-space: normal; word-wrap: break-word;">
      New Visitor
    </a>
  </li>

  <!-- Manage Visitors -->
  <li class="nav-item">
    <a class="nav-link text-wrap" href="manage-visitors.php" 
       style="white-space: normal; word-wrap: break-word;">
      Manage Visitors
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Section Title -->
  <div class="sidebar-heading text-wrap" 
       style="white-space: normal; word-wrap: break-word;">
    Event Management
  </div>

  <!-- Manage Events Dropdown -->
  <li class="nav-item">
    <a class="nav-link collapsed text-wrap" href="#" 
       data-toggle="collapse" data-target="#collapseEvents"
       aria-expanded="false" aria-controls="collapseEvents" 
       style="white-space: normal; word-wrap: break-word;">
      Manage Events
    </a>
    <div id="collapseEvents" class="collapse" aria-labelledby="headingEvents" 
         data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded d-flex flex-column">
        <a class="collapse-item mb-2 text-wrap" href="add-event.php" 
           style="white-space: normal; word-wrap: break-word;">Add Event</a>
        <a class="collapse-item text-wrap" href="view-event.php" 
           style="white-space: normal; word-wrap: break-word;">View Events</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Logout -->
  <li class="nav-item">
    <a class="nav-link text-wrap" href="logout.php" 
       style="white-space: normal; word-wrap: break-word;">
      Logout
    </a>
  </li>
</ul>
