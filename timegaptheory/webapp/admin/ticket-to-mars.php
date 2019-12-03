<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ticket to Mars</title>
  <link rel="icon" type="image/png" href="../../common/timegaptheory.png">
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
            <a class="button is-warning" href="../admin/">
              Admin
            </a>
          <a class="button is-warning" href="../sign-up.php">
            Sign Up
          </a>
          <a class="button is-primary" href="../login.php">
            Login
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
                <li><a href="index.php">Administration Panel</a></li>
                <li class="is-active"><a href="#" aria-current="page">Ticket to Mars</a></li>
              </ul>
            </nav>
            <div class="container">

      <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require_once dirname( __FILE__ ) . '/' . '../../common/config.php';
require_once dirname( __FILE__ ) . '/' . '../../common/common.php';
require_once dirname( __FILE__ ) . '/' . '../../common/timegaptheorydatabase.php';
require_once dirname( __FILE__ ) . '/' . '../../score/eligible.php';


  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $number = count($result);
    $rewardedaccounts = 0 ;

    for ($x = 0; $x <= $number; $x++) {
      $sql2 = "SELECT email, rewards FROM users LIMIT :limit,1";
      $statement2 = $connection->prepare($sql2);
      $statement2->bindParam(':limit', $x, PDO::PARAM_INT);
      $statement2->execute();
      $result2 = $statement2->fetchAll();
      if ($statement2->rowCount() > 0){
        if($result2[0]["rewards"] >= 2000){
          sleep($config['marswait']);
          $rewardedaccounts = (int)$rewardedaccounts + 1;
          echo escape($result2[0]["email"]) . " is eligible. Notification email sent to the user.<br>";
          $sql3 = "UPDATE mars
                  SET rewarded = :rewardedaccounts
                  WHERE id=1;";

          $statement3 = $connection->prepare($sql3);
          $statement3->bindParam(':rewardedaccounts', $rewardedaccounts, PDO::PARAM_INT);
          $statement3->execute();

        }else{
          sleep($config['marswait']);
          echo escape($result2[0]["email"]) . " is NOT eligible.<br>";
        }
      }

    }



    /*
    foreach ($result as $row) :
      echo "processing the acocunt of ". $row["email"] .  " - ";
      if($row["rewards"] > 2000){
        echo "eligible. <i class=\"fas fa-smile\"></i> granting 1000 reward points<br>";
        sleep($wait);
        $sql3 = "UPDATE users
                SET id = id,
                  firstname = firstname,
                  password = password,
                  email = email,
                  rewards = rewards + 1000,
                  welcomegift = welcomegift,
                  date = date
                WHERE email = :email";

        $statement3 = $connection->prepare($sql3);
        $statement3->bindParam(':email', $row["email"], PDO::PARAM_STR);
        $statement3->execute();

      }else{
          echo "not eligible. <i class=\"far fa-frown\"></i> <br>";
      }


    endforeach;
    */




  } catch(PDOException $error) {
      #echo $sql . $sql3 . "<br>" . $error->getMessrewards();
  }

?>

</div>
      
</div>
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../../common/footer.php'; ?></div>
</body>
</html>
