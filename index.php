<?php
session_start();
include 'connection.php';
if(isset($_REQUEST['login_btn']))
{
    $email = $_POST['email'];
    $pwd = md5($_POST['pwd']);
    
    $select_query = mysqli_query($conn,"select id, user_name from tbl_users where emailid='$email' and password='$pwd'");
    $rows = mysqli_num_rows($select_query);
    if($rows > 0)
    {
        $username = mysqli_fetch_row($select_query);
    
        $_SESSION['id'] = $username[0];
        $_SESSION['name'] = $username[1];
        header("Location: landing.php"); 
        exit();
    }
    else
    { ?>
        <script>
            alert("You have entered wrong email id or password.");
        </script>
    <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Visitor Management System</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/custom_style.css?ver=1.1" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <style>
  /* ✅ Banner card wrapper */
  .banner {
      text-align: center;
      margin-top: 0px;    /* push banner slightly down */
      margin-bottom: 2px; /* space before login */
      max-width: 1000px;    /* same as card width */
      margin-left: auto;
      margin-right: auto;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      overflow: hidden;    /* ensures image fits inside rounded corners */
  }

  .banner img {
      width: 100%;         /* fill banner card width */
      height: 200px;       /* fixed height for card */
      object-fit: cover;   /* fill card, crop if needed */
      display: block;
  }

  /* ✅ Login card smaller & centered */
  .card-login {
      margin: 0 auto;
      margin-top: 0px;
      max-width: 400px;
      padding: 20px;
  }

  /* ✅ Mobile tweaks */
  @media (max-width: 480px) {
      .banner img {
          height: 120px;    /* smaller on mobile */
      }
      .card-login {
          max-width: 90%;   /* responsive width */
      }
  }
  /* ✅ Input fields matching green shade */
.form-control {
    border: 1px solid #28a745; /* normal border */
}

.form-control:focus {
    border-color: #004d00;      /* dark green on focus */
    box-shadow: 0 0 0 0.2rem rgba(0,77,0,0.25); /* subtle green glow */
}
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

.container.d-flex {
    min-height: 100%;           /* full viewport height */
    display: flex;
    flex-direction: column;
    justify-content: flex-end;  /* pushes login card toward bottom */
    align-items: center;        /* centers horizontally */
    padding-bottom: 40px;       /* distance from bottom */
}



</style>

</head>
<body style="background-color: #e6f4ea;">

  <!-- ✅ Banner at the top -->
  <div class="banner">
    <img src="Images/SABanner.png" alt="Specanciens Banner" class="img-respnsive center-block" style="max-width: 1100px; margin-top:20px;">
  </div>

  <!-- ✅ Login form -->
  <div class="container d-flex justify-content-center">
    <div class="card card-login mx-auto">
      <div class="card-header text-center">
        <h4>Login to Visitors Management System (VMS)</h4>
      </div>
      <div class="card-body">
        <form name="login" method="post" action="">
          <div class="form-group">
              <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
          </div>
          <div class="form-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pwd" required>
          </div>
          <input type="submit" class="btn btn-primary btn-block" name="login_btn" value="Login"style="background-color:#004d00; border-color:#004d00; color:white;">
        </form>
      </div>
    </div>
  </div>

</body>
</html>
