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

$sql3='SELECT * from posts order by id DESC';
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
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQF-4RhGwf6B7hMZWcesyMHSwJuVbZU7nhrhA&usqp=CAU" type="image/x-icon">  

    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" />

    <title>Account</title>

   <style> 
   
   body{
    background-image: url("https://www.shutterstock.com/blog/wp-content/uploads/sites/5/2020/05/shutterstock_1556534186.jpg?w=750");
   }
   nav.navbar{
        background-color:#BDBDBD !important;
        
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

    <div class="container custom mt-4">

      <?php foreach($errors as $error):?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
      <?php endforeach ?>
    
    </div>
    
    
    <div class="container custom mt-5">

        <?php if($posts): ?>

        <?php foreach($posts as $post): ?>


        <?php if($post['image']): ?>

          <div class="card mt-4">

            <a href="<?= 'images/'.$post['image'] ?>" data-toggle="lightbox">

              <img class="card-img-top" src="<?= 'images/'.$post['image'] ?>" alt="Card image cap">
            </a>
            <div class="card-body">
              <h5 class="card-title text-danger"><?= $post['name'] ?></h5>

              <?php if($id === intval($post['user_id'])):?>
                <a href="posts.php?place=new&post_del=1&delete=<?= $post['id'] ?>"><i class="text-danger fas fa-trash float-right"></i></a>
              <?php endif ?>

              <p class="card-text"><?= $post['caption'] ?></p>
            </div>
            <div class="card-footer">
                  <p class="text-muted"><?php echo date('M j Y g:i A', strtotime($post['time']));  ?></p>
            </div>

          </div>

          <?php else:?>

            
          <div class="card mt-4">
            <div class="card-header bg-danger">
                <h5 class="card-title text-center pt-2 float-left text-white"><?= $post['name'] ?></h5>
                <?php if($id === intval($post['user_id'])):?>
                  <a href="posts.php?place=new&post_del=1&delete=<?= $post['id'] ?>"><i class="text-white fas fa-trash float-right"></i></a>
                <?php endif ?>
            </div>

              <div class="card-body">
                <p class="card-text"><?= $post['caption'] ?></p>
            </div>
            <div class="card-footer">
                  <p class="text-muted"><?php echo date('M j Y g:i A', strtotime($post['time']));  ?></p>
            </div>

          </div>

         <?php endif ?>

        <?php endforeach ?>


        <?php else:?>

        <h1 class="text-white text-center">No posts to Show</h1>

        <?php endif ?>

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

</body>
</html>