<?php

include('db.php');

session_start();

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header('Location: index.php');
}

if(!isset($_SESSION['username'])){
    header('Location: index.php');
}

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

$username=$_SESSION['username']?$_SESSION['username']:null;
$id=$_SESSION['id']?$_SESSION['id']:null;
$email=$_SESSION['email']?$_SESSION['email']:null;

echo "WELCOME $username <br>";

$sql3='SELECT * from posts';
$result = $conn->query($sql3);
$posts=[];
$my_posts=[];
if($result){
    if ($result->num_rows){
        //posts exists
        $posts=$result->fetch_all(MYSQLI_ASSOC);
    }
}
else{
    array_push($errors,'Something went wrong');
}

$sql6='SELECT * from posts where user_id = ?';
$stmt = $conn->prepare($sql6); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if($result){
    if ($result->num_rows){
        //posts exists
        $my_posts = $result->fetch_all(MYSQLI_ASSOC);
    }
}
else{
    array_push($errors,'Something went wrong');
}

//now all info is ready just have to test it out

echo "errors:";
print_r($errors);
echo "<br>";
echo "posts:";

foreach($posts as $post){
    print_r($post);
    echo "<br>";
}

echo "<br>";
echo "my posts:";
foreach($my_posts as $post){
    print_r($post);
    echo "<br>";
}
echo "<br>";
print_r($_SESSION);

?>