<?php
require("./config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Center</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="card mt-2 shadow">
            <div class="card-header row">
                <div class="card-title col">
                    <h4>
                        Account Center
                    </h4>
                </div>
                <div class=" col-4 col-md-4 col-lg-4 col-xl-3 col-xxl-2 text-center">
                    <a href="./register.php" class="btn w-75 btn-primary float-end">+Add Account</a>
                </div>

            </div>
            
            <div class="card-body">
                <?php 
                if (isset($_SESSION['successMsg'])): 
                   
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php 
                    echo $_SESSION['successMsg'];
                    unset($_SESSION['successMsg']);
                    ?>
                    <button class=" btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif?>
                <table class="table table-striped-column">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        //id,name,email,psw 
                        $query = "SELECT id,name,email,psw FROM users";
                        $result = mysqli_query($dbConnection, $query);
                        $accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach ($accounts as $row) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $psw = $row['psw'];
                            echo "<tr>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$email</td>
                            <td>$psw</td>
                            <td>
                                <a href='./edit.php?accid=$id'>Edit</a>|
                                <a class='deleteBtn' href='./index.php?deleteid=$id' >Delete</a>
                            </td>
                        </tr>";
                        }


                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php 
if (isset($_GET['deleteid'])) {
    $currentId = $_GET['deleteid'];
    $query ="DELETE FROM users WHERE id=$currentId";
    mysqli_query($dbConnection,$query);
    header("location:index.php");
}   

?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script>
    let deleteBtn = document.getElementsByClassName("deleteBtn");
    for (let i = 0; i < deleteBtn.length; i++) {
        deleteBtn[i].addEventListener('click',function(){
                confirm("are you sure to delete");
        });
        
    }
    
</script>
</html>