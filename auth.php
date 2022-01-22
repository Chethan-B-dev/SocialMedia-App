<?php

include('db.php');

session_start();

$errors=[];

if(isset($_POST['login_form'])){
    
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    
    if(empty($username) || empty($password)) array_push($errors,'Please enter all the required information');
    
    $sql2='SELECT * from users where username = ? LIMIT 1';
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("s", $username);

    if($stmt->execute()){
        $result = $stmt->get_result(); 
        $user = $result->fetch_assoc();
        if(!$user) array_push($errors,'invalid credentials');
        if(!password_verify($password,$user['password'])) array_push($errors,'invalid credentials');
    }
    else array_push($errors,'Something Went Wrong');
    
    if(count($errors)===0){
        $_SESSION['username']=$username;
        $_SESSION['id']=$user['id'];
        $_SESSION['email']=$user['email'];
        header('Location: new.php');
    }
    else header("Location: index.php?errors=".base64_encode(serialize($errors)));
}


if(isset($_POST['signup_form'])){

    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    
    if(empty($username) || empty($password) || empty($email)) array_push($errors,'Please enter all the required fields');
    
    $sql="SELECT * from users where username = ? or email = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ss", $username,$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user) array_push($errors,'That username/email already exists');
    
    if($errors) header("Location: signup.php?errors=".base64_encode(serialize($errors)));
    
    else{
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql1="INSERT INTO users(username,email,password) VALUES(?,?,?)";
        $stmt = $conn->prepare($sql1);
        $stmt->bind_param("sss", $username, $email, $password);
        
        if($stmt->execute()){
            $_SESSION['username']=$username;
            $_SESSION['id']=$stmt->insert_id;
            $_SESSION['email']=$email;
            header('Location: new.php');
        }
        else header('Location: index.php');
    }
}
  
?>


