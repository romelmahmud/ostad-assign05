
<?php
session_start();
$users = json_decode(file_get_contents('users.json'), true);
echo $_SESSION['userEmail'];
if (isset($_POST['login'])) {
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    // echo $userPassword;

    // echo $users[$userEmail]['password'];
    if (empty($userEmail) || empty($userPassword)) {
        $errorMsg = "Please fill  all the fields.";
    } else {
        if (!isset($users[$userEmail])) {
            $errorMsg = "Invalid Credentials";
        } else if ($users[$userEmail]['password'] != $userPassword) {
            $errorMsg = "Invalid Credentials";
        } else {

            $_SESSION['userEmail'] = $userEmail;
            $_SESSION['userRole'] = $users[$userEmail]['role'];
            $_SESSION['username'] = $users[$userEmail]['username'];

            if ($users[$userEmail]['role'] == 'admin') {
                header('Location: admin_dashboard.php');
            } else if ($users[$userEmail]['role'] == 'user' || $users[$userEmail]['role'] == 'manager') {
                header('Location: user_page.php');
            }
        }

    }

}
// } else {

//     if ($users[$_SESSION['userEmail']]['role'] == 'admin') {
//         header('Location: admin_dashboard.php');
//     } else if ($users[$_SESSION['userEmail']]['role'] == 'user' || $users[$_SESSION['userEmail']]['role'] == 'manager') {
//         header('Location: user_page.php');
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Crew Management | Login</title>
</head>
<body>
<div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center mb-4">Crew Management App</h3>
                <div class="card shadow-sm">
                    <div class="card-header text-center ">
                        <h3 class="">Log in</h3>

                    </div>
                    <div class="card-body">
                        <?php
if (isset($errorMsg)) {
    echo "<p>$errorMsg</p>";
}

?>
                        <form class="form " method="POST">

                            <input class="form-control" type="email" name="email" placeholder="Email"><br>
                            <input class="form-control" type="password" name="password" placeholder="Password"><br>

                            <input class="btn btn-primary" type="submit" name="login" value="Login">

                        </form>
                        <span>Don't have an account?  <a href="registration.php" class="">
                            Register
                        </a></span>
                    </div>
                </div>


            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
