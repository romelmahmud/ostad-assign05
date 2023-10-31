<?php
session_start();
$users = json_decode(file_get_contents('users.json'), true);

$current_user = $users[$_SESSION['userEmail']];

if ($current_user['role'] != 'admin') {

    header('Location: login.php');

} else {

    $updating_user_email = $_SESSION['updating_user']['email'];
    $updating_user_username = $_SESSION['updating_user']['username'];
    $updating_user_role = $_SESSION['updating_user']['role'];

    if (isset($_POST['update_role'])) {
        $user_email = $updating_user_email;
        $new_role = $_POST['role'];

        if (isset($users[$user_email])) {
            $users[$user_email]['role'] = $new_role;

            file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

            header('Location: admin_dashboard.php');
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
  <title>Crew Management | Update User</title>
</head>
<body>
<div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center mb-4">User Update Page </h3>
                <div class="card shadow-sm">
                  <h4 class="m-5 text-center ">Update User: <span class="text-primary"><?php echo $updating_user_username ?></span> </h4>
                  <p class="ms-5">Username:<span class="text-secondary "> <?php echo $updating_user_username ?></span></p>
                  <p class="ms-5">Email:<span class="text-secondary"> <?php echo $updating_user_email ?></span></p>
                  <p class="ms-5">Role:<span class="text-secondary"> <?php echo $updating_user_role ?></span></p>

                   <h4 class="text-center">Update User Role:(admin, manager, user)</h4>
                  <form class="form m-5 mt-2" method="POST">
                            <input class="form-control mb-3" type="text" name="role" placeholder="Role"
                                value="<?php echo $updating_user_role ?>">
                            <input class="btn btn-primary" type="submit" name="update_role" value="Update">
                        </form>

                </div>


            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
