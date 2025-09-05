<?php
session_start();
include 'connection.php';

if(!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];
$success = "";
$show_new_event_form = false;

// Handle success messages via GET (PRG pattern)
if(isset($_GET['success'])){
    $success = "Event '" . htmlspecialchars($_GET['success']) . "' registered successfully!";
}
if(isset($_GET['deleted'])){
    $success = "Event '" . htmlspecialchars($_GET['deleted']) . "' deleted successfully!";
}

// Fetch all events user has registered for
$registered_events = [];
$result = $conn->query("SELECT event FROM event_registrations WHERE user_id = $user_id");
if($result){
    while($row = $result->fetch_assoc()){
        $registered_events[] = $row['event'];
    }
}

// Handle event deletion
if(isset($_POST['delete_event'])){
    $event_to_delete = $_POST['delete_event'];
    $stmt = $conn->prepare("DELETE FROM event_registrations WHERE user_id = ? AND event = ?");
    $stmt->bind_param("is", $user_id, $event_to_delete);
    $stmt->execute();
    $stmt->close();

    header("Location: landing.php?deleted=" . urlencode($event_to_delete));
    exit();
}

// Main form submission
if(isset($_POST['register_btn'])){
    $event = $_POST['event'];
    if($event == "Nostalgia"){
        header("Location:dashboard.php"); 
        exit();
    } 
    else if($event == "New Event"){
        $show_new_event_form = true;
    }
}

// New event registration
if(isset($_POST['new_event_submit'])){
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO event_registrations (user_id, name, email, event, event_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $_SESSION['name'], $email, $event_name, $event_date);
    $stmt->execute();
    $stmt->close();

    // Redirect using GET after successful registration
    header("Location: dashboard.php?event=" . urlencode($event_name));

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Event Landing Page</title>
<style>
body { font-family: Arial,sans-serif; background: #e6f5ea; padding:50px 0; text-align:center; }
.container { background:#fff; padding:40px; max-width:600px; margin:auto; border-radius:12px; box-shadow:0 4px 12px rgba(0,128,0,0.2);}
h2 { color:#2e7d32; margin-bottom:20px;}
form input, form button { width:80%; max-width:100%; padding:10px; margin:15px 0; border-radius:6px; border:1px solid #ccc; font-size:16px; box-sizing:border-box;}
button { padding:12px 25px; background:#2e7d32; color:#fff; border:none; border-radius:6px; font-size:16px; cursor:pointer;}
button:hover { background:#1b5e20;}
.success { color:#1b5e20; font-weight:bold; margin-bottom:15px;}
/* Custom dropdown */
.custom-dropdown { position: relative; width: 80%; margin: auto; text-align:left;}
.dropdown-btn { width: 100%; padding:10px; border:1px solid #ccc; border-radius:6px; cursor:pointer; background:#fff; display:flex; justify-content: space-between; align-items: center;}
.dropdown-content { display:none; position:absolute; background:#fff; width:100%; max-height:200px; overflow-y:auto; border:1px solid #ccc; border-radius:6px; z-index:100; }
.dropdown-content div { padding:10px; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center; cursor:pointer; }
.dropdown-content div:hover { background:#e6f5ea; }
.delete-btn { background:#2e7d32; color:#fff; border:none; border-radius:50%; width:20px; height:20px; cursor:pointer; font-weight:bold; line-height:16px; }
</style>
</head>
<body>
<div class="container">
<?php if(!$show_new_event_form) { ?>
    <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
<?php } else { ?>
    <h2>Register New Event</h2>
<?php } ?>


<?php if($success != "") { echo "<div class='success'>$success</div>"; } ?>

<?php if(!$show_new_event_form) { ?>
<form method="POST" action="">
<input type="text" name="name" placeholder="Your Name" required>
<input type="email" name="email" placeholder="Email Address" required>

<div class="custom-dropdown">
    <div class="dropdown-btn">-----Select Event----</div>
    <div class="dropdown-content">
        <div data-value="Nostalgia">Nostalgia</div>
        <?php foreach($registered_events as $evt): ?>
            <div data-value="<?php echo $evt; ?>" style="display:flex; justify-content:space-between; align-items:center;">
                <span><?php echo $evt; ?></span>
                <button type="button" class="delete-btn" onclick="deleteEvent('<?php echo $evt; ?>')">"X"</button>
            </div>
        <?php endforeach; ?>
        <div data-value="New Event">New Event Registration</div>
    </div>
</div>
<input type="hidden" name="event" id="selected-event" required>

<button type="submit" name="register_btn">Proceed</button>
</form>
<?php } ?>

<?php if($show_new_event_form) { ?>

<form method="POST" action="">
<input type="text" name="event_name" placeholder="Event Name" required>
<input type="date" name="event_date" required>
<input type="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" hidden>
<button type="submit" name="new_event_submit">Register Event</button>
</form>
<?php } ?>

<!-- Hidden delete form -->
<form method="POST" action="" id="delete-form" style="display:none;">
    <input type="hidden" name="delete_event" id="delete-event-input">
</form>

</div>

<script>
// Toggle dropdown
document.querySelector('.dropdown-btn').addEventListener('click', function(){
    document.querySelector('.dropdown-content').style.display =
        document.querySelector('.dropdown-content').style.display === 'block' ? 'none' : 'block';
});
// Set selected event
document.querySelectorAll('.dropdown-content div[data-value]').forEach(function(item){
    item.addEventListener('click', function(e){
        if(e.target.classList.contains('delete-btn')) return; // ignore clicks on delete
        document.querySelector('.dropdown-btn').innerText = this.dataset.value;
        document.getElementById('selected-event').value = this.dataset.value;
        document.querySelector('.dropdown-content').style.display='none';
    });
});

// Delete event function
function deleteEvent(evtName){
    if(confirm("Are you sure you want to delete '"+evtName+"'?")){
        document.getElementById('delete-event-input').value = evtName;
        document.getElementById('delete-form').submit();
    }
}

// ✅ Auto-hide success message after 3 seconds
setTimeout(function(){
    var msg = document.querySelector('.success');
    if(msg){
        msg.style.transition = "opacity 1s ease"; // fade-out
        msg.style.opacity = "0";
        setTimeout(function(){ msg.remove(); }, 1000); // remove after fade
    }
}, 3000);
</script>
</body>
</html>
