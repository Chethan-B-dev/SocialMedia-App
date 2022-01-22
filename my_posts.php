<?php
include('db.php');

session_start();

$username=$_SESSION['username']?$_SESSION['username']:null;
$id=$_SESSION['id']?$_SESSION['id']:null;
$email=$_SESSION['email']?$_SESSION['email']:null;
$errors=[];


$sql6='SELECT * from posts where user_id = ? and is_tweet = 0 order by id DESC';
$stmt = $conn->prepare($sql6); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if($result){
    if ($result->num_rows){
        //posts exists
        $my_pics = $result->fetch_all(MYSQLI_ASSOC);
    }else{
      $my_pics=[];
    }
}
else{
    array_push($errors,'Something went wrong');
}


$sql7='SELECT * from posts where user_id = ? and is_tweet = 1 order by id DESC';
$stmt = $conn->prepare($sql7); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if($result){
    if ($result->num_rows){
        //posts exists
        $my_tweets = $result->fetch_all(MYSQLI_ASSOC);
    }else{
      $my_tweets=[];
    }
}
else{
    array_push($errors,'Something went wrong');
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQF-4RhGwf6B7hMZWcesyMHSwJuVbZU7nhrhA&usqp=CAU" type="image/x-icon">  
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" />

    <title>Account</title>

    <style> 
   
   body{
    background-image: url("https://www.shutterstock.com/blog/wp-content/uploads/sites/5/2020/05/shutterstock_1556534186.jpg?w=750");
   }
   
  .profile{
       font-size: 1.3em;
       font-weight: bold;
       color:#DD2C00 !important;
   }
   .profile1{
       font-size: 1.9em;
       font-weight: bold;
       color:#DD2C00 !important;
   }
   .custom{
       width: 550px;
   }
   .dropdown-item{
       font-weight: bold;
   }

   .dropdown-item:hover{
     background-color:red !important;
     color:white !important;
   }



   </style>
  </head>
  <body>
    
    <div class="nav">
    <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle profile"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Profile
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="new.php">Dashboard <i class="fas fa-chart-line"></i></a>
              <a class="dropdown-item" href="my_posts.php">My Posts <i class="fas fa-images"></i> </a>
              <a class="dropdown-item" href="#" data-target="#upload_pic" data-toggle="modal" ></i>Post a Picture <i class="far fa-image"></i></a>
              <a class="dropdown-item" data-target="#post_tweet" data-toggle="modal" href="#">Post a thought <i class="fab fa-twitter"></i></a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" data-target="#logout" data-toggle="modal" href="#"> </i>Logout <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </li>

    </div>
   
        
        <h1 class="text-center profile1">WebMedia</h1>

    <div class="container">
        
    <h1 class="text-danger mb-4" style="font-family: 'Montserrat', sans-serif;font-size:2em !important;">Photos</h1>
    
  <div class="row">

   <?php if($my_pics): ?>

    <?php foreach($my_pics as $pic): ?>
      <div class="col-md-4 mt-3">
        <div class="card">

        <a href="<?= 'images/'.$pic['image'] ?>" class="w-100 h-100" data-toggle="lightbox">
          <img src="<?= 'images/'.$pic['image'] ?>" class="card-img-top" alt="...">
        </a>


          <div class="card-body">
            <?php if($id === intval($pic['user_id'])):?>
                <a href="posts.php?place=my_posts&post_del=1&delete=<?= $pic['id'] ?>"><i class="text-danger fas fa-trash float-right"></i></a>
            <?php endif ?>
            <h5 class="card-title"><?= $pic['name'] ?></h5>
            <p class="card-text"><?= $pic['caption'] ?></p>
          </div>
          <div class="card-footer">
                  <p class="text-muted"><?php echo date('M j Y g:i A', strtotime($pic['time']));  ?></p>
          </div>
        </div>
    </div>
    <?php endforeach ?>

    <?php else:?>

      <h2 class="text-white text-center ml-3">No posts to Show</h2>

    <?php endif ?>

    </div>

  </div>
        

    <div class="container mt-5">
    <h1 class="text-danger mt-4" style="font-family: 'Montserrat', sans-serif;font-size:2em !important;">Tweets</h1>
        <div class="row mt-5">

          <?php if($my_tweets): ?>
              <?php foreach($my_tweets as $tweet):?>
            <div class="col-md-4">
            <div class="card border-danger mb-3" style="max-width: 18rem;">
              
              <div class="card-header bg-danger text-center font-weight-bold">
                <p class="float-left text-white"><?= $username ?></p>
                <?php if($id === intval($tweet['user_id'])):?>
                  <a href="posts.php?place=my_posts&post_del=1&delete=<?= $tweet['id'] ?>"><i class="text-white fas fa-trash float-right"></i></a>
                <?php endif ?>
                
              </div>
                <div class="card-body">
                  <!-- <h5 class="card-title text-danger"><?= $username ?></h5> -->
                  <p class="card-text"><?= $tweet['caption'] ?></p>
                  
                </div>

                <div class="card-footer">
                  <p class="text-muted"><?php echo date('M j Y g:i A', strtotime($tweet['time']));  ?></p>
                </div>
            </div>
            </div>
              <?php endforeach ?>
              <?php else:?>

              <h2 class="text-white text-center ml-3">No tweets to Show</h2>

              <?php endif ?>

        </div>
    </div>


  
  <!-- Modal -->
  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel">Logout</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       
        <div class="modal-body">
            Are you sure you want to logout?
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <a type="button" href="new.php?logout=1" class="btn btn-danger">Yes</a>
        </div>
      </div>
    </div>
  </div>
            <!-- upload pic -->

            <div class="modal fade" id="upload_pic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload A picture</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST" action="posts.php" enctype="multipart/form-data">
              <div class="modal-body">
                  
                <div class="form-group">
                    <label for="inputAddress">Caption</label>
                    <input type="text" class="form-control" name="caption" id="inputAddress" placeholder="Enter Caption">
                  </div>
                <div class="form-group">
                  <label for="image">Example file input</label>
                  <input type="file" class="form-control-file" name="image" id="image">
                </div>
              </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="Submit" name="post_pic" class="btn btn-primary" value="Post">
            </div>

            </form>
          </div>
        </div>
      </div> 
      
      <div class="modal fade" id="post_tweet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tweet Something</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="posts.php" method="POST">
              <div class="modal-body">
                  
                <div class="form-group">
                      <textarea name="caption" id="editor1" placeholder="Enter Your Thoughts"></textarea>
                </div>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="post_tweet" class="btn btn-primary" value="tweet">
              </div>
            </form>
          </div>
        </div>
      </div>














    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g==" crossorigin="anonymous"></script>
    <script>
         $(function(){
        var $ckfield = CKEDITOR.replace( 'editor1' );
        
        $ckfield.on('change', function() {
          $ckfield.updateElement();         
        });
    });


      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox();
      });

    </script>

   

     
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  
  </body>
</html>