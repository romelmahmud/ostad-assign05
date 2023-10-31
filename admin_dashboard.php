<?php
session_start();
$users = json_decode(file_get_contents('users.json'), true);

$current_user = $users[$_SESSION['userEmail']];

if ($current_user['role'] != 'admin') {

    header('Location: login.php');

} else {
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();

        header('Location: login.php');
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Crew Management | Admin Dashboard</title>
</head>
<body>
<div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center mb-4">Admin Page </h3>
                <div class="card shadow-sm">
                  <h3 class="m-5 text-center">Welcome <?php echo $current_user['username'] ?></h3>
                  <form class="form text-center" method="POST" >
                    <div class="d-flex justify-content-center mb-3 "><a class="  btn btn-success" href="create_user.php">Create User</a>
                    <input class="btn  btn-warning ms-2" type="submit" name="logout" value="logout">
                  </div>

                  </form>

                  <div class="row mt-3 p-3" >
                  <h4 class="text-center mb-2">All Crew List: </h4>
                  <table class="table ">
  <thead>
    <tr>
      <th scope="col">username</th>
      <th scope="col">role</th>
      <th scope="col">email</th>
      <th scope="col">action</th>

    </tr>
  </thead>
  <tbody>



<?php
foreach ($users as $user) {
    echo "<tr>";
    echo "<td>";
    echo "{$user['username']}" . "</br>";
    echo "</td>";
    echo "<td>";
    echo "{$user['role']}" . "</br>";
    echo "</td>";
    echo "<td>";
    echo "{$user['email']}" . "</br>";
    echo "</td>";
    echo "<td>";
    echo '<form  method="POST" >

    <input class=" btn btn-info" type="submit" name="update" value="Update">

    <input class=" btn btn-danger ms-2" type="submit" name="delete" value="Delete">



  </form>' . "</br>";

    echo "</td>";
    echo "</tr>";

    if (isset($_POST['update'])) {
        // print_r($user);
        $_SESSION['updating_user'] = $user;
        header('Location: update_user.php');

    }
    // if (isset($_POST['delete'])) {
    //     $updated_users = array_filter($users, function ($var) {
    //         return $var['email'] != $user['email'];
    //     });
    //     file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
    //     header('Location: admin_dashboard.php');
    // }

}

?>


  </tbody>
</table>
                  </div>



                </div>


            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>