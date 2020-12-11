<?php
class Layout{

  function __construct(){
      $this->banner = '';
      $this->notices = '';
      $this->content= '';
      $this->title = 'Basic Onboarding';
  }

  function setTitle($titleText){ $this->title = $titleText; }
  function setBanner($bannerText){ $this->banner = $bannerText; }
  function addContent($newContent){ $this->content .= $newContent; }
  function addNotice($newNotice){ $this->notices .= $newNotice; }

  function header(){ ?>
    <!doctype html>
    <html lang="en">
    <head>

       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
      <title><?= $this->title ?></title>

      <!-- Bootstrap  https://v5.getbootstrap.com/ -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">

      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Spartan&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="styles.css">

      <!-- FontAwesome (get your own "Kit" at https://fontawesome.com )-->
      <script src="https://kit.fontawesome.com/5535203e19.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php
  } // end function header


  function publicBanner(){ ob_start();  ?>
    <div id="publicBanner" class="container-fluid">
      <div class="container">
        <img src="img/BiteLogo.svg" height="150" width="auto"></img>
        <!-- <h1 class="display-4 text-white"><h1><?=$this->title?></h1> -->
        <!-- <p class="lead">We're happy you're here.</p> -->
        <hr>
      </div>
    </div>
  <?php $this->banner = ob_get_clean();
} //end function publicBanner()



  function banner(){ echo $this->banner; }

  function notices(){
    if ($this->notices == '')  return;
     ?>
    <div class="container mt-2">
      <div class="alert alert-success" role="alert">
        <?=$this->notices;?>
      </div>
    </div>
<?php
  }

  function content(){ ?>
      <main id="content">
          <?= $this->content?>
      </main>
  <?php }

  function loginForm(){  ob_start(); ?>
    <div class="loginForm">
    <div class="container-fluid mt-5">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <form  method="post">
                  <label class="text-muted">Your credentials, please.</label>
                  <input class="form-control form-control-lg my-1" type="email" name="login_email" placeholder="Email Address" required>
                  <input class="form-control form-control-lg my-1" type="password" name="login_password" placeholder="Password" required>
                  <button class="btn btn-info btn-lg btn-block my-3" type="submit" name="login_button" id="btn2" >Login</button>
                  <p class="text-muted text-center">Need an Account? <a href="?">Register Here</a>.</p>
                </form>
            </div>
        </div>
    </div>
  </div>
<?php $this->content.= ob_get_clean();
}


function registrationForm(){ ob_start(); ?>
 <div class="container-fluid mt-5">
   <h1>Meet the monster that was made for you</h1>
   <h2>Join the #1 dating app for monsters</h2>
     <div class="row justify-content-center align-items-center h-100">
         <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
             <form method="post" >
                <label class="text-muted">Let's get started.</label>
                <input class="form-control form-control-lg my-1" type="text" name="reg_fullName" placeholder="Full Name" required>
                <input class="form-control form-control-lg my-1" type="email" name="reg_email" placeholder="Email Address" required>
                <input class="form-control form-control-lg my-1" type="password" name="reg_password" placeholder="Password" required>


                <div id="regSubmit" > <button id="btn2" class="btn btn-info btn-lg btn-block my-3" type="submit" name="reg_button"><div id="reg_button_text">Register</div></button>
              </div>
             </form>
             <p id="gotAnAcc" class="text-left text-muted">Have an Account? <a href="?login_form">Login Here</a></p>

         </div>
         <div  class="d-none d-sm-block col-sm-6 offset-sm-0 offset-lg-2 px-5">
           <img id="frankie" src="img/frankie.svg" width="auto"></img>
         </div>
     </div>
 </div>
<?php $this->content.= ob_get_clean();
}

  function footer(){ ?>
    <footer class="footer text-dark p-5 text-muted text-center">
       <div class="container">
         Created with <a class="text-muted" href="https://v5.getbootstrap.com/">Bootstrap</a>, PHP, and MySQL by Alex L, Mais, and Emily.
       </div>
     </footer>
    </body>
    </html>
  <?php
  }

}  // end of Layout Class.
?>
