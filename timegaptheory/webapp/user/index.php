<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once dirname( __FILE__ ) . '/' . '../../settings/delay.php'; 
require_once dirname( __FILE__ ) . '/' . '../../common/common.php';
require_once dirname( __FILE__ ) . '/' . '../../common/session.php';

if(!isset($_SESSION['login_user'])){
  header("location:../login.php");
  die();
}

$user_check = $_SESSION['login_user'];
try {
  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "SELECT firstname,rewards,welcomegift
            FROM users
            WHERE email = :email";

  $statement = $connection->prepare($sql);
  $statement->bindParam(':email', $user_check, PDO::PARAM_STR);
  $statement->execute();
  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome, <?php echo escape($result[0]['firstname']) ?> </title>
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
      <div class="column">
      <nav class="breadcrumb" aria-label="breadcrumbs">
              <ul>
                <li><a href="../../">OWASP TimeGap Theory</a></li>
                <li><a href="../">WebApp</a></li>
                <li class="is-active"><a href="#" aria-current="page">User</a></li>
              </ul>
            </nav>
            <br>

            <?php 
            echo "Hello, " . escape($result[0]['firstname']) . "<br>" . 
            "You have <span style='color:#ff0000;font-size:1.4em;'>" . escape($result[0]['rewards']) . "</span> rewards points <br>" ;
            if($result[0]['welcomegift'] == 0){
              echo "You haven't completed KYC yet. If you already did, please enter the code <a href='enter-coupon.php' >here</a>";
            }
            ?>
            <br><br>

            <div class="level-left">
                <div class="level-item"><a class="button is-info" href="enter-coupon.php">Enter coupon</a></div>
                <div class="level-item"><a class="button is-info" href="buy-tickets.php">Buy tickets</a></div>
                <div class="level-item"><a class="button is-info" href="transfer-rewards.php">Transfer rewards</a></div>
                <div class="level-item"><a class="button is-info" href="rate-the-program.php">Rate the program</a></div>
            </div>
     
      </div>
    
    </div>
      
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../../common/footer.php'; ?></div>
<script>
function fill(user){
    document.getElementById('password').value = user;
    document.getElementById('email').value = user + '@timegaptheory.com';
}
</script>
</body>
</html>
