<?php
require("./config.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
    <!-- CSS only
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css"
  rel="stylesheet"
/>
</head>
<body>
    <?php 
    $currentId = $_GET["accid"];
    $query = "SELECT name,email,psw FROM users WHERE id=$currentId";
    $result = mysqli_query($dbConnection,$query);
    $currentAcc = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $currentName = $currentAcc[0]['name'];
    $currentEmail = $currentAcc[0]['email'];
    $currentPassword = $currentAcc[0]['psw'];

    $errorName = $errorEmail = $errorPassword = $newName = $newEmail = $newPassword = '';
    $capitalLetter = false;
    $smallLeter = false;
    $number = false;
    $password_check = false;
    if (isset($_POST['save'])) {
        
        empty($_POST['name'])?$errorName = 'Please fill out username!': $newName = $_POST['name'];
        empty($_POST['email'])?$errorEmail = 'Please fill out email!': $newEmail = $_POST['email'];
        empty($_POST['password'])?$errorPassword = 'Please fill out username!': $newPassword = $_POST['password'];
        
        if ($newName !== '' && $newEmail !== '' && $newPassword !== '') {
           if (preg_match("/[A-Z]/",$newPassword)) {
                $capitalLetter = true;
                if (preg_match("/[a-z]/",$newPassword)) {
                    $smallLeter = true;
                    if (preg_match("/[1-9]/",$newPassword)) {
                        $number = true;
                        if ($capitalLetter && $smallLeter && $number) {
                            $password_check = true;
                             if ($password_check) {
                                $query = "UPDATE users SET name='$newName', email ='$newEmail',psw = '$newPassword' WHERE id=$currentId ";
                                mysqli_query($dbConnection,$query);
                                header("location:./index.php");
                             }
                        }
                    } else {
                        $errorPassword ='Your password must be contain 1 or more numbers';
                    }
                } else {
                $errorPassword ='Your password must be contain 1 or more small letters';
            }
           } else {
            $errorPassword ='Your password must be contain 1 or more capital letters';
           }
        }

        


    }
    ?>
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
                        Edit Account Info
                    </h4>
                    </div>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                            <div class="mb-3">
                                    <label for="exampleInputName" class="form-label">Username</label>
                                    <input type="text" name="name" value="<?php 
                                    if (isset($_POST['save'])) {
                                        echo $newName;
                                    } else {
                                        echo $currentName;
                                    }?>" class="form-control <?php if (isset($_POST['save'])) {
                                        if (empty($newName)) {
                                            echo "is-invalid";
                                        }
                                    } ?>" id="exampleInputName">
                                    <span class="text-danger"><?php echo$errorName?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" name="email" value="<?php 
                                    if (isset($_POST['save'])) {
                                        echo $newEmail;
                                    } else {
                                        echo $currentEmail;
                                    }?>" class="form-control <?php if (isset($_POST['save'])) {
                                        if (empty($newEmail)) {
                                            echo "is-invalid";
                                        }
                                    } ?>" id="exampleInputEmail1">
                                    <span class="text-danger"><?php echo$errorEmail?></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="text" name="password" value="<?php 
                                    if (isset($_POST['save'])) {
                                        echo $newPassword;
                                    } else {
                                        echo $currentPassword;
                                    }?>" class="form-control <?php if (isset($_POST['save'])) {
                                        if (empty($newPassword)) {
                                            echo "is-invalid";
                                        }
                                    } ?>" id="exampleInputPassword1">
                                    <span class="text-danger"><?php echo$errorPassword?></span>
                                </div>
                                <button type="submit" class="btn btn-dark float-end " name="save">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>