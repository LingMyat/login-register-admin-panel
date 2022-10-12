<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div style="height: 100vh;" class=" w-100 bg-black">
        <div class="container pt-4">
            <div class="row">
                <div class="col col-4 text-center">
                    <a href="./login.php" class="btn btn-primary w-75 mb-2">LOGIN</a>
                    <a href="./register.php" class="btn btn-success w-75 mb-2">REGISTER</a>
                    <a href="./logout.php" class="btn btn-danger w-75 mb-2">LOGOUT</a>
                </div>
                <div class="col col-5">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email or Username</label>
                                    <input type="text" name="emailOrUsername" class="form-control" id="exampleInputEmail1">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button type="submit" class="btn btn-dark float-end " name="login">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
session_start();
echo"<pre>";
print_r($_SESSION);
if (isset($_POST['login'])) {
    $nameOrEmail = $_POST['emailOrUsername'];
    $password = $_POST['password'];

    if ($nameOrEmail === $_SESSION['name'] || $nameOrEmail === $_SESSION['email'] ) {
        if (password_verify($password,$_SESSION['password'])) {
            echo "login complete";
        }else{
            echo "<script>alert('Your password is wrong please try again')</script>";
        }
    }else{
        echo "<script>alert('Your email or username is wrong please try again')</script>";
    }
}
?>

</html>