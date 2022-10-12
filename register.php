<?php
require('./config.php');

session_start();
$errorName = $errorEmail = $errorPassword = $errorConfirmPassword = "";
$name = $email = $password = $confirm_password = '';
if (isset($_POST['register'])) {



    $_POST['name'] !== '' ? $name = $_POST['name'] : $errorName = 'Please fill out username!';
    $_POST['email'] !== '' ? $email = $_POST['email'] : $errorEmail = 'Please fill out email!';
    $capitalLetter = false;
    $smallLeter = false;
    $number = false;
    $password_check = false;
    if ($_POST['password'] !== '') {
        $password = $_POST['password'];
    } else {
        $errorPassword = 'Please fill out password!';
    }

    if ($_POST["confirmPassword"] !== '') {
        $confirm_password = $_POST["confirmPassword"];
    } else {
        $errorConfirmPassword = 'Please fill out confirm password!';
    }

    // echo $name.'<br>';
    // echo $email.'<br>';
    // echo $password.'<br>';
    // echo $confirm_password;
    if ($name !== '' && $email !== '' && $password !== '' && $confirm_password !== '') {
        if (strlen($password) >= 6 && strlen($confirm_password) >= 6) {

            if ($password === $confirm_password) {

                if (preg_match('/[A-Z]/', $password)) {
                    $capitalLetter = true;
                    if (preg_match('/[a-z]/', $password)) {
                        $smallLeter = true;
                        if (preg_match('/[1-9]/', $password)) {
                            $number = true;
                            if ($capitalLetter && $smallLeter && $number) {
                                $password_check = true;
                            }
                        } else {

                            $errorPassword = $errorConfirmPassword = 'Your password must be contain 1 or more numbers';
                        }
                    } else {

                        $errorPassword = $errorConfirmPassword = 'Your password must be contain 1 or more small letters';
                    }
                } else {

                    $errorPassword = $errorConfirmPassword = 'Your password must be contain 1 or more capital letters';
                }
                if ($password_check) {
                    //query အရင်ရေး
                    $query =  "INSERT INTO users (name,email,psw) VALUES ('$name','$email','$password')";
                    //mysqli_query(database connection, query code CRUD )
                    mysqli_query($dbConnection, $query);
                    $_SESSION['successMsg'] = "Account create successful";
                    header("location:index.php");
                }
            } else {
                $errorPassword = 'Your Password and Confirm Password must be same';
                $errorConfirmPassword = 'Your Password and Confirm Password must be same';
            }
        } else {
            $errorPassword = 'Your password must be greater than or equal 6';
            $errorConfirmPassword = 'Your confirm password must be greater than or equal 6';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div style="height: 100vh;" class=" w-100 ">
        <div class="container pt-4">
            <div class="row">
                <div class="col col-4 text-center">
                    <a href="./index.php" class="btn btn-primary w-75 mb-2">Acc Center</a>
                    <a href="./register.php" class="btn btn-success w-75 mb-2">REGISTER</a>
                </div>
                <div class="col col-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>
                                    Account Register
                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class=" mb-3">
                                    <label for="exampleInputName" class="form-label">Username</label>
                                    <input type="text" name="name" placeholder="Username" class="form-control <?php
                                                                                                                if (isset($_POST['register'])) {
                                                                                                                    if (empty($name)) {
                                                                                                                        echo "is-invalid";
                                                                                                                    }
                                                                                                                } ?>" id="exampleInputName" value="<?php echo $name ?>">
                                    <span class=" text-danger"><?php echo $errorName; ?></span>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" name="email" placeholder="Email" class="form-control <?php
                                                                                                                if (isset($_POST['register'])) {
                                                                                                                    if (empty($email)) {
                                                                                                                        echo "is-invalid";
                                                                                                                    }
                                                                                                                } ?>" id="exampleInputEmail1" value="<?php echo $email ?>">
                                    <span class=" text-danger"><?php echo $errorEmail; ?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="text" name="password" placeholder="Password eg.Linn123" class="form-control <?php
                                                                                                                                if (isset($_POST['register'])) {
                                                                                                                                    if (empty($password)) {
                                                                                                                                        echo "is-invalid";
                                                                                                                                    }
                                                                                                                                } ?>" id="exampleInputPassword1" value="<?php echo $password ?>">
                                    <span class=" text-danger"><?php echo $errorPassword; ?></span>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputConfirmPassword" class="form-label">Confirm Password</label>
                                    <input type="text" name="confirmPassword" placeholder="Re enter password" class="form-control <?php
                                                                                                                                    if (isset($_POST['register'])) {
                                                                                                                                        if (empty($confirm_password)) {
                                                                                                                                            echo "is-invalid";
                                                                                                                                        }
                                                                                                                                    } ?>" id="exampleInputConfirmPassword" value="<?php echo $confirm_password ?>">

                                    <span class=" text-danger"><?php echo $errorConfirmPassword; ?></span>

                                    <div class="form-text">Password and Confirm Password must be same</div>
                                </div>
                                <button type="submit" name="register" class="btn btn-dark float-end ">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</html>