<?php
include('db.php');
$errors=[];

session_start();

if(isset($_POST['post_pic'])){
    
    $fileExtensions = ['jpeg','jpg','png','gif'];
    
    if(isset($_FILES['image'])){
        
        $username=$_SESSION['username'];
        $id=$_SESSION['id'];
        $caption=mysqli_real_escape_string($conn,$_POST['caption']);
        
        if(empty($caption)) array_push($errors,'Please enter all the details');
        
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        $fileExtension = strtolower(end(explode('.',$fileName)));
        $fileNameEncoded = hash("sha1", basename($fileName)."-".bin2hex(openssl_random_pseudo_bytes(32))).".".$fileExtension;
        $uploadPath = "images/".$fileNameEncoded;
        
        if (!in_array($fileExtension,$fileExtensions)) array_push($errors,'file type not allowed');
        
        if ($fileSize > 7000000) array_push($errors,'file size cannot be greater than 7 mb');
        
        if(empty($errors)){
            if(move_uploaded_file($fileTmpName, $uploadPath)){
                $sql5='INSERT INTO posts(user_id,caption,image,is_tweet,name) VALUES (?,?,?,0,?)';
                $stmt = $conn->prepare($sql5);
                $stmt->bind_param("ssss", $id, $caption, $fileNameEncoded,$username);
                $stmt->execute();
                header('Location: new.php?added=1');
            }
        }
        else header('Location: new.php?errors='.base64_encode(serialize($errors)));
        
    }
    else{
        //no image given
        array_push($errors,'Please Provide all the information');
        header('Location: new.php?errors='.base64_encode(serialize($errors)));
    }
}

if(isset($_POST['post_tweet'])){
    $username=$_SESSION['username'];
    $id=$_SESSION['id'];
    $caption=$_POST['caption'];
    if(empty($caption)) array_push($errors,'Please enter a tweet');
    if(empty($errors)){
        $sql6='INSERT INTO posts(user_id,caption,is_tweet,name) VALUES (?,?,1,?)';
        $stmt = $conn->prepare($sql6);
        $stmt->bind_param("sss", $id, $caption,$username);
        if($stmt->execute()) header('Location: new.php?added=1');
        else{
            array_push($errors,'Something went Wrong');
            header('Location: new.php?errors='.base64_encode(serialize($errors)));
        }
    }else header('Location: new.php?errors='.base64_encode(serialize($errors)));
    
}

if(isset($_GET['post_del'])){
    $username=$_SESSION['username'];
    $id=$_SESSION['id'];
    $post_id=mysqli_real_escape_string($conn,$_GET['delete']);
    $sql = "SELECT is_tweet,image FROM posts WHERE id=? and user_id=? LIMIT 1";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ss", $post_id,$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && !$user['is_tweet']){
        $image=$user['image'];
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') system("del images\{$image}");
        
        else system("rm images/{$image}");
    }

    $sql6='DELETE FROM posts where id = ? and user_id = ?';
    $stmt = $conn->prepare($sql6);
    $stmt->bind_param("ss", $post_id, $id);


    if($stmt->execute()) header("Location: ".$_GET['place'].".php?deleted=1");

    else{
        array_push($errors,'Something went Wrong');
        header('Location: new.php?errors='.base64_encode(serialize($errors)));
    }
}
?>
