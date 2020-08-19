<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  require_once dirname( __FILE__ ) . '/' . '../../common/common.php';
  require_once dirname( __FILE__ ) . '/' . '../../common/session.php';
  require_once dirname( __FILE__ ) . '/' . '../../settings/delay.php'; 

  if(!isset($_SESSION['login_user'])){
     header("location:../login.php");
     die();
  }

  $user_check = $_SESSION['login_user'];
  try {
      $connection = new PDO($dsn, $username, $password, $options);
      $sql = "SELECT rewards, welcomegift
              FROM users
              WHERE email = :email";
      $statement = $connection->prepare($sql);
      $statement->bindParam(':email', $user_check, PDO::PARAM_STR);
      $statement->execute();
      $result = $statement->fetchAll();
      } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessrewards();
      }

    if ($statement->rowCount() > 0){
      if(intval($result[0]["welcomegift"]) == 1){
      echo "<center><span class=\"tag is-success\">You are our preferred customer</span></center>";
    }else{
      echo "<center><span class=\"tag is-warning\">You need to complete KYC</span></center>";
    }
  }

  if (isset($_POST["coupon"]) && !empty($_POST["coupon"]) && $_POST['coupon'] == "WELCOME10") {

      try  {
        $connection = new PDO($dsn, $username, $password, $options);
        $sql4 = "SELECT welcomegift
                FROM users
                WHERE email = :email";
        $statement4 = $connection->prepare($sql);
        $statement4->bindParam(':email', $user_check, PDO::PARAM_STR);
        $statement4->execute();
        $result4 = $statement4->fetchAll();
      } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessrewards();
      }

    if ($statement4->rowCount() > 0){
      if(intval($result4[0]["welcomegift"]) == 0){
        sleep($config['wait']);
        $sql2 = "UPDATE users
                SET id = id,
                  firstname = firstname,
                  password = password,
                  email = email,
                  rewards = rewards + 500,
                  welcomegift = welcomegift + 1,
                  date = date
                WHERE firstname = :firstname";

                        $statement2 = $connection->prepare($sql2);
                        $statement2->bindParam(':firstname', $login_session, PDO::PARAM_STR);
                        $statement2->execute();
                        echo '<script>location.reload();</script>';
              }else if(intval($result4[0]["welcomegift"]) == 1){
                echo "<center><span class=\"tag is-danger\">This coupon code has expired</span></center>";
              }
    }








}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Enter coupon</title>
  <link rel="icon" type="image/png" href="../../common/webapp.png">
  <link rel="stylesheet" href="../../common/bulma.css" id="light" title="Light">
  <link rel="stylesheet" href="../../common/bulmadark.css"  id="dark"  title="Dark" disabled>
</head>
<body>
  <div class="container">
  <div class="columns">
  <div class="column">
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="../"><img src="../../common/owasp.png" height="28" width="28"></a>
            <a class="navbar-item" href="../"><img src="../../common/timegaptheory.png" height="28" width="28"></a>
            <a class="navbar-item" href="../"><img src="../../common/lab.png" height="28px" width="28px"></a>
            <a class="navbar-item" href=""><img src="../../common/webapp.png" height="28px" width="28px"></a>
          </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
        <a class="navbar-item" href="">
            OWASP TimeGap Theory WebApp
        </a>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
            <a class="button is-danger" href="../admin/">
              Admin
            </a>
          <a class="button is-warning" href="../sign-up.php">
            Sign Up
          </a>
          <a class="button is-primary" href="logout.php">
            Logout
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
  </div></div>

  <div class="columns">
      <div class="column is-two-fifths">
          <nav class="breadcrumb" aria-label="breadcrumbs">
              <ul>
                <li><a href="../../">OWASP TimeGap Theory</a></li>
                <li><a href="../">WebApp</a></li>
                <li><a href="index.php">User</a></li>
                <li class="is-active"><a href="#" aria-current="page">Enter coupon</a></li>
              </ul>
            </nav>
            <div class="container">
<a class="button is-light" href="javascript:fillv();">Valid coupon</a> 
<a class="button is-light" href="javascript:filliv();">Invalid coupon</a> 
<br><br>

<?php

if ($result && $statement->rowCount() > 0) {
  echo "You have <span style='color:red;font-size:1.3em;'>" . escape($result[0]["rewards"]) . "</span> reward point(s).";

}

?>
<br><br>
<form method="post">

<div class="field">
  <label class="label">Enter coupon code</label>
  <div class="control">
    <input class="input" name="coupon" id="coupon" type="text" placeholder="1B34SDX">
  </div>
</div>
<input class="button is-primary" type="submit" name="submit" value="Submit">
</form> </div>
    
    </div>
      
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../../common/footer.php'; ?></div>
  <script>
    var count = -1;
  function fillv(){
    document.getElementById('coupon').value='WELCOME10';
  }
  function filliv(){
    count += 1;
    var cp = "";
    switch(count) {
      case 0:
        cp = "WHATEVER"
        break;
      case 1:
        cp = "Well, why again?"
        break;
      case 2:
        cp = "Come on"
        break;
      case 3:
        cp = "Are you crazy?"
        break;
      case 4:
        cp = "This needs to stop"
        break;
      case 5:
        cp = "I won't talk anymore"
        break;
      case 1:
        cp = "Well, why again?"
        break;
      default:
      count = -1
      cp = "WELCOME10909"
    }
    document.getElementById('coupon').value=cp;
  }
  </script>
</body>
</html>
