<?php
session_start();
$usersFile = 'users.json';

$users = json_decode(file_get_contents('users.json'), true);

function saveUsers($users, $file)
{
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

$current_user = $users[$_SESSION['userEmail']];

if ($current_user['role'] != 'admin') {

    header('Location: login.php');

} else {

// Registration Form Handling
    if (isset($_POST['create'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

//Validation
        if (empty($username) || empty($email) || empty($password)) {
            $errorMsg = "Please fill  all the fields.";
        } else {
            if (isset($users[$email])) {
                $errorMsg = "Email already exists.";
            } else {
                $users[$email] = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,

                    'role' => $role,
                ];

                saveUsers($users, $usersFile);
                header('Location: admin_dashboard.php');
            }

        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Crew Management | Create User</title>
</head>
<body>
<div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center mb-4">Crew Management App</h3>
                <div class="card shadow-sm">
                    <div class="card-header text-center ">
                        <h3 class="">Create User</h3>

                    </div>
                    <div class="card-body">
                        <?php
if (isset($errorMsg)) {
    echo "<p>$errorMsg</p>";
}

?>
                        <form class="form" method="POST">
                            <input class="form-control" type="text" name="username" placeholder="Username"><br>
                            <input class="form-control" type="email" name="email" placeholder="Email"><br>
                            <input class="form-control" type="password" name="password" placeholder="Password"><br>
                            <input class="form-control mb-3" type="text" name="role" placeholder="Role(user, manager, admin)"
                                ><br>

                            <input class="btn btn-primary" type="submit" name="create" value="Create">


                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>

