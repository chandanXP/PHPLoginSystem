<?php
$showAlert = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){//here, this means if user submitted/posted the form/req then the below elements to taken.
     
     include 'partials/_dbconnect.php';//we include the file which will connect us to the Database
     $username = $_POST["username"];//$username=username, which is in the table of the Existing db
     $password = $_POST["password"];//$password=password, which is in the table of the Existing db
     $cpassword = $_POST["cpassword"];//$cpassword=cpassword, which is in the table of the Existing db
     // $exist = false;

     //check whether this username Exists
     $existsql = "SELECT * FROM `users` WHERE username = '$username'";
     $result = mysqli_query($conn, $sql);
     $numExistRows = mysqli_num_rows($result);
     if($numExistRows > 0){//if username is more than 0
          // $exists = true;
          $showerror = "Username Already Exists!";
     }
     else{
          // $exists = false;
          if(($password == $cpassword)){//if password and confirm password matched then
               $sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$password', current_timestamp())";//will add the username and password to the database
               $result = mysqli_query($conn, $sql);
               if($result){
                    $showAlert = true;//this show the alert bar on your screen
                    header("location: login.php"); //this will send you to the login page
               }
          }
          else{
               $showerror = "Password you entered not matched!";//if the password is not equal to the confirm password then it will show the issue to the user
          }

     }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Signup</title>
</head>
<body>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account has been created, Now you can login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }

    if($showerror){
     echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Erro!</strong> Your password is not matched.
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
     </button>
    </div> ';
    }
    ?>
    
    <div class="container my-4">
     <h1 class="text-center">| Signup to our website |</h1>
     <form action="/login_system/signup.php" method="post">
          <div class="form-group  col-md-6">
               <label for="username">Username</label>
               <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
               
          </div>
          <div class="form-group  col-md-6">
               <label for="password">Password</label>
               <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group  col-md-6">
               <label for="cpassword">Confirm Password</label>
               <input type="password" class="form-control" id="cpassword" name="cpassword">
               <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
          </div>
           
          <button type="submit" class="btn btn-primary  col-md-6">Signup</button>
     </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
     
</body>
</html>
