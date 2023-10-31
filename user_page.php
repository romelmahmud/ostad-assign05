<?php
session_start();
$users = json_decode(file_get_contents('users.json'), true);

$current_user = $users[$_SESSION['userEmail']];

if ($current_user['role'] != 'user' || $current_user['role'] != 'manager') {

    header('Location: login.php');

} else {
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();

        header('Location: login.php');
    }
}

?>
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Crew Management | User Page</title>
</head>
<body>
<div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center mb-4">User Page </h3>
                <div class="card shadow-sm">
                  <h3 class="m-5 text-center">Welcome <?php echo $current_user['username'] ?></h3>
                  <form class="form text-center" method="POST" >
                  <input class="btn btn-warning mb-5 " type="submit" name="logout" value="logout">

                  </form>
                </div>


            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>