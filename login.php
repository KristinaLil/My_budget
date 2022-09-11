<?php

session_start();
if (isset($_POST['user']) && isset($_POST['password'])) {

    if ($_POST['user'] == 'admin' && $_POST['password'] == 'admin') {
        $_SESSION['login'] = 1;
        $_SESSION['user'] = $_POST['user'];
        header("location:budget.php");
        die();
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
}


include "password.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My budget</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h1>My budget</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3 mb-3">
                    <div class="card-header">Please log in</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="text" name="user" class="mb-3" placeholder="Username"> <br>
                            <input type="password" name="password" class="mb-3" placeholder="Password"> <br>
                            <?php include "password.php"; ?>
                            <button class="btn btn-warning mb-3">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>