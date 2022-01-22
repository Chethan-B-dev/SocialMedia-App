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
            background-image: url('data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUTEhIWFRUXFxUWFxUVFRcVFRUVGBcXFxUXFRcYHyggGBolHRcVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDQ0NFQ8PFS0ZFRktKy0rLS0rLS0tLSstLS0tLTctLSstLSstLS0rLS0rNy0rLS0tNys3LTctLS0tNys3Lf/AABEIALEBHAMBIgACEQEDEQH/xAAaAAADAQEBAQAAAAAAAAAAAAABAgMABAUH/8QAOxAAAQMBBAkDAwMCBQUBAAAAAQACESEDMUFREmFxgZGhsdHwBBPBIjLhUmLxQnIzgpKywhQjg6LSBf/EABYBAQEBAAAAAAAAAAAAAAAAAAABAv/EABYRAQEBAAAAAAAAAAAAAAAAAAARAf/aAAwDAQACEQMRAD8A+JQsQrF/7W11JXPnAXzd1VRKEVUWlatbwSA1QdNi0ANm92GMXDv5SZMuktpU1k0GwxqVNOAypiBUHKhBCQNcNKpJ1EnEb0ALpBcWi4ZjEa9SDGgg3ioOeacWrtEiSKjoewS+4YvxF9c5v3IKl0j6oP8ATIujAHvsXNaNgkK9mTBJAF1Yjpet6mJpIoL9naFRIR+66t29aBFdeUzPaEwedXDcmDykQrdHI8ksDI36td3JWLz4ES4k3BBEtbS/XULQI14Y5flUc4iQUoeQgVzb9qUqmmb863Le4UE9BAMXVZtJa52ljdnd5uUvcOaCMLutv8EbG/C5nmb112o/7TRs6IrkfYwJG3UlBmaRSCa7o4Kj7AtxjHLokim+vL8pAtnAMid92/JYtJNdhwjNOWDCp3fCxaCb8kga0YNG4gxkBBy1q/r/ALG7R0K5bVgFy6vX3N8wCDk94xGUR5uHBD3jnyu2cSgGymFmMyYvgU5kIFc8mK3XRTog15GOrdknawEwCeA/+kIb+7gO6BQ85nyqUquiMyNopy2JHNgwoERBOE7pTtbvKuyTMEXxiflAoa8Y5Y7PxwSNc77pUwEVRT2dY460HWcJEQgqx1ImNtxzBwTjRN4IMQeUGDlAXOnbaHb8bCgqJu0sYxyPm5ESf64AvNeyBtxF0c56JC8G+TyHAIHkYSQKyeutI90mUC7zBVNnGHNVC2bZon9vdv8AwmApdGuVFqB4rE0zTPsxgQUkJzAiL8TlsQM+zIMxsy3qLqlUcbs/IW0j/NUALyQG5XdlMNVYGXBUc0ATfO5BzPyFw8lZtmTMC69UI1DqgHOzjkEE4XVan/tt3dFO1sNEAyqtLXNAJiFBztcCfqu8/KBIFRsHztVzYM/XzCxsWR992sIIOtZEQBdUYrMrf4R+FX2LP9Z4hP7VmP6td4xQc1q0RSN27vyXT68UbtWIs8Tz7KfrLTS+2oF++AiucCJmMrwdt2qUwo3WSY4D88SlL8xOu4/lYO/urf8AVfyQdFmyHVuAiTQTqzqVJ1jTG/HKLykaBcAeI7JgwfpI1kx8IEN0a5+B8o2nw3oE8t8qPhKYzPAd0QgR0jmeKLmwggAszq4juj7TsuiRzY+ClRVfad+kre07JSVPaMSabb+CA+2fCO6Bbs4g9CkWBRFAP5R0RmOB7IMtI2HBNpjLzdCKcNAu+o54Ddeh7hOJS+4BcN/4qsGn8ZIizCb69Z2pSRrHNBjin0nX99WvWqCGZbVgzWOPZazMmvkqg3fKAaEFEN1Ii5MgXRwCDqHkiUCgBagE7XQlaUAtHE3qZCuYOKUhuaCJCqbGkAg7wFIrQgf/AKf+3/UltbKkyKAUmZ2JYSwgSFSzx2fInlKWEWmEDMZNzRxOrumFlqaLjjjvS7HRqM/CM/u/3dkCuF+Yi6mI7rUME5ie/VZzr6yTikDoQVpcYB1RqrTeltHCsRWCKCRIqOiTSH6eZQLh+kcSoCftG0/Ca1cQYFIUnOlUDwbzW66flFLbHmSdxjqphW0NIUw5atmIUQgZj4MhdBtjFAQdkqFm+DKq71JyCBmPeTHUEIOtHC9oIQZbOJii1va4Digk903CEqMLAIjKrbU9zmls21VWtJMFtNkQg3vHNbTlTDUWtVRQJwPJBSMFYzxRYI7ILMdRFSaqBFZZZM0KBChoHJO52VEgrrVAIjBLKYyNW8dEgrt6/lEK4ISmFUNKLuOP4QO2B93zKkUTsSIrSneBmJpdzU3iEGuwjJQUIbF9dl9/4WAGJjdqCDrUSfpH8UCT3BWnPUgNoRJi5ISqF7aHR560hcKGKY1vogQrKrnNxaeKUPblhdN9f5UUiCox4EHR5raTcjx/CDOdcRSRhtI+Eiq94u0RQa9uetBloKy0XRAnVnKqFARLDyndEp/fv+kVnfJmqUWxwyjke/IIpJWTWtoXGTelCIYIgItKo6DNwrxvyQJCLQnbGfLzwLOjDX+FUUF4rlGxIy/b/PwgTQZ4bP5lERM7aa4QFoB2JQg08LlmlBYVyFJu1lUMXypw4iaxtQAoiqiM8Vg5TNkfCsxlYkY60DkpXGbz5sQaL5wB4hIURiRrPLukbUiM0xszs20QkDXmeyAE1OVUVg4Zc0wg5jmECviudendC0dQ0vTOakIQTdUynspwIG1aFtFFZsgkSM8NX4Rh2beXn8pCUkKCx0sNHliJSiRIBESb9yU2DsQBtIHUpXsIvEKKrLs28kGjW2uF+3pzUFkFwXVgClTdH5TFpwDcMsgucHDNN7Ry+EDPYZNKbCB+FjZEa9k9lrU1NTxlYWpumm75VGdZECTnFb8O6mnc4m8ziun0vo9ISaDVeUHGivSf6BsUkHioejsBpkOww88qoB6f0hcJmBxSW9iWmDuK9VrYEBJbWbSPqG/JKR5QKZLCr7piOYoYWkL7Zy406raGscZ6LNbKbQ1jn8BEbQGfIohoz5LaIiZ611VSSg6CaAjKCqY6OERwqp2DboqDQ6giXCdKd2ZiFFLan6jtTQNJ1YoeYlTFsL4rdq27UHWpmYFQRTZCCxImkkuadhz30U2WnmSkwOMC6+Ddrv3K2i40MZzQUzpegS1AmhUindZmNLCYSOKqMFqhbSuWQVY6RG8fKctGY5qLBed28/iU6DFmsce6GgT/ACK7FtiUkgdigm1s/JyCZrsGUzJvjEk4BZ5hoGdTxIHygwfS7dwmvworCxBDiHTAk0jhVCwM/SbjyOBCo06I0TSQdLVI+meu9I1ujUxOABBrnTBFQlEDE3dUE9oIgaup/hQESbqDVT+VOF0tDQ2Cb5u3Xceam4NzO4cb4QLaGvDolQRBQd1j6GkuMHIYbV3MbAAyCDbQGsiqOkEUVy2/pNIlwMHzFdMhB1qBeQN6DygDWTEXpxZzjkg+0Be44HPd/KaR+rK4ZXealWQLPPNqACLnCPu3eBKHKhgsqtcdFoBiSQeUKwYbpPE90pHILM5HgUfad+k8F1iyGPysbJuQ5eZKUjlaw/pPAoEqr7PRcyMTdvCiqivpmgkg4g/CdtAAcNF3FxHZRs3QTsPGKIvtpcTmI6RzCimoHj6pOldF1c07BcM9MbsOYUTagknRgzMzNdiPunSnHpsQVYyWgEis8aQuRzU9pakxqRsyTpawTqm+UCtszlzCYMzPCv4U3mbrgI85pwwiDgdh4oio2IPas1s6jl2WJVBDfOiS0KOklL0AcJAi8dL55qTXRUGE5dkj77s+iikFmTcJ1/lHRaLzJyF289kHvJvJO1JKCgMuEgRkKCL0vqL9wWYfq3x8LW9+4dEVpNJE0u/hBzD+mOPylDtaLiMzw/KgRZUDRBqAQTvCZzWwINYuzPHagiUwTt0aTyF9cdyENzN2Wz8qhCUE9pGHPbTkkRBVLICCYmIO6sqao22IaWzQ+FFN6l8umIoOgPzySAoWjpM+ZJQUR12J+nY8c6LsF+3kF59iaPH7Z/0mV3MtAayKx084IqjRVAunzzUg8iL+Jiin7zQfu4AoGt2/aciFyvx2q1pb6UAXSFF4qdpTE0jgmsYmuIjfRK5LCqDCIKNpnn1x81ptIT2/hBNwSwqvIwlTQHRTNPBISiEBIIPRO4TXyfKpQaQTs7JW2hFJoUBKkUxcs28DWgQrNEmFUCN4dynsmawQDrZ8z0CiueVnAhVs2UjX8FJafDegRQcYcdvyn9SK+ZlJaXlWtRI57iPOagmxpFc0ZdmOLflI0rSMuf4Qb6dZ5Iksi4znOKZhBe2mIkZnFG1shLgKET9MUpfB2VQYNZrum8RcDRJLZuJG2Meymms2SQM0GAkwFnNgwuu29JoNJmcLs6KFm+TBGEUAnIVKAMswROU9CR0KWE90jX0lIqgQtCZCEFrIRhJcIArdiaJpvGiKft66Ure80/c2TdIMItc3BnEkoC15ikTsHQBVl19RtpzSf9QRdA2CEvuE5cAqHLz+scSlt8Dib8N/mSU2jtY5KZqojFAowsqGY0mBgJO6nZU9sfwe9OYWDv6cY54j4R0nZRtkc1FQe3GUjgVS3wGrr5yW9xt8TJmuGcIJLFPpt/T3x/CFpaTcIqctWpArD0PQr0RYjWvOYK7ndCvUZ9ozgdAouIW9lEVN4BEyINFxWP3N2jqvR9QPo1gg85XBZiH7D0QM25v9r/8AkmcfoOxnyg0Us/8AN1PdY/YdjOpCoP8AV/5BzlQfc3Z8lWmv+dnQqdsIgbf9zkCvvKeztMDxy8vWbZ6TokDWVm2EzUU57EDmDlxjP8BI+zGf/s1b2qTI2YrCxJQTa6CCMKqnuipgyQRfQTiMUmmVtI+BAqf074cCcClIQAQer6m0aWEaQrrnovOAaMSdgjmeyQIpAz3SZWAQTsxGfnbgiFLfKFBdfqy28ZRWRsv1rlaMTuHmCDBO18blb0bNKZN0UBjkFP1B0XETI1154bkAbaVE7NgiL1haONdurmpPp1CWUFi6byPNiUFKHnPhRYHHJAZRagRwzy/KBqfKAIOlllpSajcXDkFn2LtvmV65WPIuMKwt3RfN1CAc+yBLV1abOFEicMmuvufgotsjMEEa4QTRlE2Zpr7kJvZO3wd0C2d44caLqsvUkADRyE17LmtLMicpI4FM6xO3D/cP+JQWtbZxkRAzMjqpNP1bT1SPs42GI6oIKh3IA8W9yEgeNHR1ETvkfKVxmpWhAwtKkxSZG0XJLR89PN8owiGoGYyXXxrNyLbC/wCod9iOKICoX2vpmRsxVbECKxvWa2iEKCBtdXOt0IOtZml/cn5S019VoHgRWNw3n4+EAs4rQiOmyshAmDJGNYkCOZWdZD6dZi++p5igXOHQrPswGg6QmSKSciBqRTmxbS+s3EG7ds4oNsAYjIHDMcFBtoRcSN6YScevIIHdYiJE3A9K7KpZGIn6aebZQIOc6qzTUUgdgbuYQeh6CzGjMVJK3/6DBoziLlyWb3D7X04cile6audpah3w3KBX3DZ8ldHpmNipr5QLlLpWQW9Qysi5JZgXm67b5RKGo9Bh5iiLsgAyZFIG3EqDshd1R087j5RGMOGw+dUCgJ2ih3fKwTNFDu6qoVloRdz81nimdaPxPT42pHJw10UNKYjUilc8mN+rWU/uunZqCxLv1eV7IVr9WOcTfVBnvJocFvcdmVoN+kJ21WMzVyAEk7tSxackZj+rV1W/zZ5oFLCsbM5FMR+5A/3b6+ZKjGzKLUrjrlAFBaKlMGKelU71Rj7vKoHaESAllDTQcSe0w/tCKygRYILIMqf0D+49AisgkV1em/xfP0rLIuN6n/F3hciyyAoLLIgrBZZBisgsgYotWWQUTNx2fIQWRCuWH27z/wAVlkUqCyyqCsFllACiFllVYrLLKDLBZZUM6871mYbeyKyCpu81pQssmj//2Q==');
            /* background-position: center; 
            background-repeat: no-repeat; 
            background-size: cover; */
        }
        h1{
            color: darkred  ;
        }
    .x{
        background-color: darkred;
        padding:0px 120px;
    }
  
    </style>
<br><br><br><br><br>
  <h1> Sign up</h1> 
  <br><br> 


  <?php foreach($errors as $error):?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php endforeach ?>

  
    <form method="POST" action="auth.php">

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Email Id</label>
        <input name="email" type="email" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label" >Password</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword2">
      </div>
     <input type="submit" class="btn btn-danger x SignIn" name="signup_form" value="Register">
      
    </form>


    <div class="mt-3">
      Already have an account? <a href="index.php" style="text-decoration:none;color:red;">Sign in</a>
    </div>
   
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