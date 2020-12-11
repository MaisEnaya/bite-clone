<?php
class User {

  function __construct($db, $data){
    $this->db = $db;
    if(is_numeric($data)){
      $sql = "SELECT * FROM `User` WHERE `user_id` = '$data'";
      $result = $this->db->ixd->query($sql)->fetch_object();
      foreach ($result as $column => $row){  $this->$column = $row; }
    }
  }

  function welcome(){ ob_start();  ?>
    <div class="container-fluid">
      <div class="container">
        <p class="lead">
          <a id="btn2" class="btn btn-primary" href="?logout" role="button">Logout</a>
        </p>
        <img src="img/BiteLogo.svg" height="150" width="auto"></img>
        <h1 class="display-4 text-white"><h1>Welcome, <?=  $this->fullName ?></h1>
        <!-- <p class="lead">Come here often?</p> -->

      </div>
      <hr>
    </div>
  <?php
    return ob_get_clean();
  }

  function emptyInfoFilled(){
    $sql = "UPDATE `User` SET `infoFilled`=0 WHERE `user_id` = '$this->user_id'";
    $this->db->ixd->query($sql);
      header("Location: index.php");
  }

function saveInfo(){
  $monster_type = $this->db->ixd->real_escape_string($_REQUEST['monsterType']);
  $user_name = $this->db->ixd->real_escape_string($_REQUEST['user_name']);
  $size = $this->db->ixd->real_escape_string($_REQUEST['size']);
  $gender = $this->db->ixd->real_escape_string($_REQUEST['gender']);
  $scariness = $this->db->ixd->real_escape_string($_REQUEST['cuteness']);
  $l4gender = $_POST['l4gender'];
  $genderPref = '"'.implode('","', $l4gender).'"';
  $sizePref = '"'.implode('","', $_POST['l4size']).'"';
  $rel_type = $this->db->ixd->real_escape_string($_REQUEST['relationship_type']);
  $cutePref = '"'.implode('","', $_POST['l4cute']).'"';

  $sql = "UPDATE `User` SET
  `monsterType`= '$monster_type',
  `bodySize`='$size',
  `gender`='$gender',
  `scariness`='$scariness',
  `fullName`='$user_name',
  `preferredGender`='$genderPref',
  `size_preference`='$sizePref',
  `desiredRelationshipType`='$rel_type',
  `scary_preference`='$cutePref',
  `infoFilled`=1,
  `assumedAllRisk`=1
  WHERE `user_id` = '$this->user_id'";

  $this->db->ixd->query($sql);
    header("Location: index.php");
}





  // function saveBio(){
  //   $bio_text = $this->db->ixd->real_escape_string($_REQUEST['bio_text']);
  //   $sql = "UPDATE `User` SET `bio`= '$bio_text' WHERE `user_id` = '$this->user_id'";
  //   $this->db->ixd->query($sql);
  //   header("Location: index.php");
  // }

function moreInfo(){
  ob_start(); ?>
  <div> <form action="index.php" method="post" class="p-3">
    <h3>Help us find your next date <span>👅</span></h3>

    <div class="wrapper">

    <!-- <p class="text-muted">My name is</p> -->
    <!-- <div class="form-group w-50 py-3"> -->
    <div class="row">
      <div class="col" id="nameLabel">
      <label for="user_name"><h4>My name is</h4></label>
    </div>
    <div class="col">
      <!-- <div class="col-sm-5"> -->
      <!-- <label for="user_name" class="text-muted">My name is</label> -->
      <textarea name="user_name" class="form-control" id="user_name" rows="1"><?=$this->fullName?></textarea>
    </div>
    <div class="col" id="typeLabel">
    <h4> and I am a </h4> </div>
    <div class="col">
      <textarea name="monsterType" placeholder="ex. Vampire, Demon, etc" class="form-control" id="monsterType" rows="1"><?=$this->monsterType?></textarea>

    </div>


  </div>

  <!-- </div> -->
<div class="about_grid">
    <div class="about_col"> <h1 class="text-muted">I identify as</h1> <hr></div>
    <div class="about_col_1">
    <label class="myGenderCon"><p> female </p>
      <input type="radio" name="gender" <?php echo ($this->gender =='female')? 'checked':'' ?> value="female">
      <span id="female" class="checkmark"></span>
    </label>
    <label class="myGenderCon"><p> genderless </p>
      <input type="radio" c name="gender"  <?php echo ($this->gender =='genderless')? 'checked':'' ?> value="genderless">
      <span id="genderless" class="checkmark"></span>
    </label>
      <label class="myGenderCon" for="male"> <p>Male</p>
          <input type="radio" id="male" name="gender"<?php echo ($this->gender =='male')? 'checked':'' ?> value="male">
          <span id="male" class="checkmark"></span>
        </label>
        <div class="break"></div>

          <label class="myGenderCon" for="other"> <p>Other</p>
            <input type="radio" id="other" name="gender" <?php echo ($this->gender =='other')? 'checked':'' ?> value="other">
                  <span id="other" class="checkmark"></span>
            </label>
      </div>

    <!--
    <label class="myGenderCon" for="male"> <p>Male</p>
      <input type="radio" id="male" name="gender" <//?php echo ($this->gender =='male')? 'checked':'' ?> value="male" >
      <span class="checkmark"></span>
    </label><br>
    <input type="radio" id="female" name="gender" <//?php echo ($this->gender =='female')? 'checked':'' ?> value="female">
    <label for="female">Female</label><br> -->
    <!-- <input type="radio" id="genderless" name="gender" <//?php echo ($this->gender =='genderless')? 'checked':'' ?> value="genderless"> -->
    <!-- <label for="genderless">Genderless</label><br> -->
    <!-- <input type="radio" id="other" name="gender" <//?php echo ($this->gender =='other')? 'checked':'' ?> value="other"> -->
    <!-- <label for="other">Other</label> -->

<div class="about_col_2">
    <label for="cuteness" class="text-muted">Are you a cute or a scary monster?</label>
    <div class="slider_grid">
     <input type="range" name="cuteness" min="1" max="8" value="<?=$this->scariness?>" class="slideCute" id="cuteness">
     <p class="text-muted" id="cuteP">cute</p>
     <p class="text-muted" id="scaryP">SCARY</p>
         </div>
  </div>

<!-- <div class="break"><div> -->
  <div class="about_col_3">
  <label for="size" class="text-muted">Are you a tiny or a big monster?</label>
  <br>
  <div class="slider_grid">
  <p class="text-muted" id="tinyP">tiny</p>
<input type="range"  name="size" min="1" max="8" value="<?=$this->bodySize?>" class="slider" id="size">
  <p id="hugeP" class="text-muted">Huge</p>
  </div>
  <!-- <p class="text-muted">Tiny</p>
  <input type="range" name="size" min="1" max="8" value="<//?=$this->bodySize?>" class="slider" id="size">
  <p class="text-muted">Huge</p> -->
</div>
</div>
    <!-- moved to the top  -->
    <!-- <div class="form-group w-50 py-3">
      <label for="monsterType" class="text-muted">What kind of monster are you?</label>
      <textarea name="monsterType" class="form-control" id="monsterType" rows="1"><//?=$this->monsterType?></textarea>
    </div> -->

    <div class="break"></div>
    <div class="about_grid">
        <div class="about_col"> <h1 class="text-muted">I am looking for a</h1> <hr></div>
        <div class="about_col_1">
          <label class="myGenderCon"><p> female </p>
  <input type="checkbox" id="l4female"  name="14gender[]"  value="female">
  <span id="female" class="checkmark"></span>
</label>
<label class="myGenderCon"><p> genderless </p>
  <input type="checkbox" id="l4genderless" name="14gender[]"  value="genderless">
  <span id="genderless" class="checkmark"></span>
</label>
<label class="myGenderCon"><p> male </p>
  <input type="checkbox" id="l4male"  name="14gender[]"  value="male">
  <span id="male" class="checkmark"></span>
</label>    <div class="break"></div>


<label class="myGenderCon"><p> other </p>
  <input type="checkbox" id="l4other"  name="14gender[]"  value="other">
  <span id="other" class="checkmark"></span>
</label>
          </div>


    <div class="about_col_2">
        <label for="cuteness" class="text-muted">How scary would you like them to be?</label>
        <div class="slider_grid">
         <input type="range" name="l4cute[]" min="1" max="8" value="<?=$this->scariness?>" class="slideCute" id="cuteness">
         <p class="text-muted" id="cuteP">cute</p>
         <p class="text-muted" id="scaryP">SCARY</p>
             </div>
      </div>

    <!-- <div class="break"><div> -->
      <div class="about_col_3">
      <label for="l4size[]" class="text-muted">What size of monster are you looking for?</label>
      <br>
      <div class="slider_grid">
      <p class="text-muted" id="tinyP">tiny</p>
    <input type="range"  name="l4size[]" min="1" max="8" value="<?=$this->bodySize?>" class="slider" id="size">
      <p id="hugeP" class="text-muted">Huge</p>
      </div>

    </div>

</div>
<!--
<div class="break"></div>

    <h3> What kind of relationship are you looking for?</h3>
<p>I am looking for a</p>
  <input type="radio" name="relationship_type" id="casual" value="casual">
  <label for="casual">Casual Relationship</label><br>
  <input type="radio" name="relationship_type" id="short_term" value="short_term">
  <label for="short_term">Short-Term Relationship</label><br>
  <input type="radio" name="relationship_type" id="long_term" value="long_term">
  <label for="long_term">Long-Term Relationship</label><br>
  <input type="radio" name="relationship_type"  id="cultist" value="cultist">
  <label for="cultist">Underling Who Will Worship Me In Exchange For Great And Terrible Power</label><br>
  <input type="radio" name="relationship_type"  id="cult_leader" value="cult_leader">
  <label for="cult_leader">Being Of Immense Power Who Will Grant Me The Ability To Destroy All Those Who Oppose Me ;)</label><br>
    </div> -->


<div class="form-group">
  <div class="two_col_grid">
  <div class="risk_col"><input type="checkbox" id="waiver" name="waiver" value="accepted" required>
  </div>
<div class="risk_col">  <label class="text-muted small" for="waiver">By checking this box agree to the site's terms and conditions. I also confirm that I'm aware that Bite takes no responsibility for any physical, psychological, emotional, and/or spiritual harm that I may experience as a result of trying to date or contact any monster, creature, supernature force, unknowable entity, monster hunter in disguise, mindless seething mass of matter (organic or otherwise), or individual that I meet through this app.</label>
</div>
</div>

</div><br>
    <div class="form-group">
      <h3>Get ready for an adventure!<h3>
      <button id="btn1" type="submit" class="btn btn-primary" name="enter_Info_Button">Save</button>
    </div>
  </form> </div>
  <?php
    return ob_get_clean();
}

function mainPage(){
  $scariness_parsed='';
  switch ($this->scariness) {
    case 1:
      $scariness_parsed = "impossibly twee";
      break;
    case 2:
      $scariness_parsed = "adorable";
      break;
    case 3:
      $scariness_parsed = "cute";
      break;
    case 4:
      $scariness_parsed = "normal";
      break;
    case 5:
      $scariness_parsed = "creepy";
      break;
    case 6:
      $scariness_parsed = "scary";
      break;
    case  7:
      $scariness_parsed = "horrifying";
      break;
    case  8:
      $scariness_parsed = "mind-shatteringly unspeakably grotesque";
  }
  $size_parsed='';
  switch ($this->bodySize) {
    case 1:
      $size_parsed = "miniscule";
      break;
    case 2:
      $size_parsed = "tiny";
      break;
    case 3:
      $size_parsed = "small";
      break;
    case 4:
      $size_parsed = "medium";
      break;
    case 5:
      $size_parsed = "large";
      break;
    case 6:
      $size_parsed = "huge";
      break;
    case  7:
      $size_parsed = "enormous";
      break;
    case  8:
      $size_parsed = "collosal";
  }
  ob_start(); ?>
  <div> <h3> You are a(n) <?=$size_parsed?>,  <?=$scariness_parsed?>, <?=$this->gender?> <?=$this->monsterType?></h3> </div>
  <div> <p> At this stage of the project, this page is a placeholder</p> </div>
  <p><a class="btn btn-primary btn-lg" href="?change_details" role="button">Edit Details</a></p>

  <?php
    return ob_get_clean();
}

  function bio(){  ob_start(); ?>
    <div class="row">
      <div class="col-md-6">
        <img style="width: 100%;" src="https://cataas.com/cat?<?= uniqid() ?>">
      </div>
      <div class="col-md-6 py-3">
        <?php
        if(isset($_REQUEST['bio_edit'])){ ?>
          <form action="index.php" method="post" class="p-3">
            <h3>Edit your bio</h3>
            <div class="form-group w-50 py-3">
              <label for="bio_text" class="text-muted">What's your thing?</label>
              <textarea name="bio_text" class="form-control" id="bio_text" rows="4"><?=$this->bio?></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" name="bio_save_button">Save</button>
            </div>
          </form>
        <?php } else { ?>
          <p class="display-4"><?=$this->bio?></p>
          <!-- <p><a class="btn btn-primary btn-lg" href="?bio_edit" role="button">Edit Bio</a></p> -->
        <?php } ?>
      </div>
    </div>
  </div>
  <?php
    return ob_get_clean();
  }  // end function bio

  function isAuthenticated(){
    if ($this->user_id == $_SESSION['user_id']){
      return true;
    }
    return false;
  }

  // function hasEnteredInfo(){
  // if  ($this->infoFilled == 0){
  //     return false;
  //   }else{
  //     return true;
  //   }
  // }
} //end User class


?>
