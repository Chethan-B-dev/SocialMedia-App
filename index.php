<?php


session_start();

if(isset($_GET['errors'])){
  try{
      $errors=unserialize(base64_decode($_GET['errors']));
      $errors=array_unique($errors);
  }
  catch(Exception $e){
      $errors=[];
  }
}else{
  $errors=[];
}

if(isset($_SESSION['username'])){
  header('Location: new.php');
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQF-4RhGwf6B7hMZWcesyMHSwJuVbZU7nhrhA&usqp=CAU" type="image/x-icon">  
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
            body{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color:black;
            color: cornsilk;
           background-image: url("data:image/jpeg;base64,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");
            /* background-position: center; 
            background-repeat: no-repeat; 
            background-size: cover; */
        }
        h1{
            color: darkred  ;
        }
    .netflix{
        background-color: darkred;
        margin-left: 20px;
    }
  
    </style>
<br><br><br><br><br>
  <h1>Web Media</h1> 
  <br><br>

  <?php foreach($errors as $error):?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php endforeach ?>

<form method="POST" action="auth.php">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
      </div>
      <!-- <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Stay Signed In</label>
      </div> -->
     <input type="submit" name="login_form" class="btn btn-light" value="Login">
      <a href="signup.php" type="button" class="btn btn-danger netflix">Sign Up</a>
  </form>
   
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

 
   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <div>

    </div>
  </body>
</html>