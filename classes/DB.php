<?php
class DB {

  function __construct(){
    $hostname = "localhost";
    $username = "ixd1663_monster";
    $password = "p3nYq!gf4nkU2pH";
    $database = "ixd1663_cats";
    $this->ixd = new mysqli($hostname, $username, $password, $database);
    $this->ixd->set_charset("utf8");
    if ($this->ixd->connect_error) {  die("Error: " . $this->ixd->connect_error);   }
  }

  function login(){
      $email = $this->ixd->real_escape_string($_REQUEST['login_email']);
      $sql = "SELECT * FROM `User` WHERE `email` = '$email'";
      $result = $this->ixd->query($sql);

      if ( $user = $result->fetch_object() ){
        if (password_verify($_REQUEST['login_password'], $user->password)){
            $_SESSION['user_id'] = $user->user_id;
            header("Location: index.php");
        }
      }
      else{
        return 'Login Failed';
      }
  }

  function register(){
      //user clicked on register reg_button
      $fullName = $this->ixd->real_escape_string($_REQUEST['reg_fullName']);
      $email = $this->ixd->real_escape_string($_REQUEST['reg_email']);
      // $username = $this->ixd->real_escape_string($_REQUEST['reg_username']);
      $password = password_hash($_REQUEST['reg_password'], PASSWORD_DEFAULT);
      // encrypt password prior to saving in db

      $data = [
        'fullName' => $fullName,
        'email' => $email,
        'username' => $email,
        // 'username' => $username,
        'password' => $password
      ];

      $columns = '`'.implode('`,`',array_keys($data)).'`';
      $values = '"'.implode('","', $data).'"';

      $sql = "INSERT INTO `User` ($columns) VALUES ($values) ";

      if ( $this->ixd->query($sql) ){
        header("Location: index.php?login_form&reg_success=".$email);
      }else{
        return "Something went wrong: ".$this->ixd->error;
      }
  }

  function end(){
    $this->db->close();
  }
}
?>
