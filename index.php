<?php

//start managing the user session.
session_start();

if( isset($_REQUEST['logout'])){
  session_destroy(); // logout
  header("Location: ?login_form"); //redirect to another page.
}

// include the required classes
include 'classes/DB.php';
include 'classes/User.php';
include 'classes/Layout.php';

//make a particular instance for important classes.
$db = new DB();
$page = new Layout();

//if we are not logged in yet.
// ie. if no user id is yet stored in the session.
if ( ! isset($_SESSION['user_id']) ){

  if ( isset($_REQUEST['reg_button'])){
    $db->register();
  }
  if( isset($_REQUEST['login_button'])){
    $status = $db->login();
    $page->addNotice($status);
  }
  if (isset($_REQUEST['reg_success'])){
    $page->addNotice ('Thanks '.$_REQUEST['reg_success'].', you are now registered!');
  }
  if (isset($_REQUEST['login_form'])) {
    $page->setTitle("Login");
    $page->loginForm();
  }
  else{
    $page->setTitle("Register");
    $page->registrationForm();
  }
  $page->publicBanner(); // this is the image for users not yet logged in.

}

else{
  // if the user is logged in  .
  // ie. we have a user id already stored in the sesssion .

  $user = new User($db, $_SESSION['user_id']);

  // if (isset($_REQUEST['bio_save_button'])){ $user->saveBio();  }
  if (isset($_REQUEST['enter_Info_Button'])){ $user->saveInfo();}
if (isset($_REQUEST['change_details'])){ $user->emptyInfoFilled();}
  $page->setTitle("Welcome, ".$user->email); // email not showing up?

  $page->setBanner( $user->welcome() );
  if ($user->infoFilled==0){
    $page->addContent( $user->moreInfo() );
  }else{
    $page->addContent( $user->mainPage() );
  }
}

$page->header();
$page->banner();
$page->notices();
$page->content();
$page->footer();

?>
