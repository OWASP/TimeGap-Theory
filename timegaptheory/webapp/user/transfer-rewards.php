<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once dirname( __FILE__ ) . '/' . '../../common/timegaptheorydatabase.php';
require_once dirname( __FILE__ ) . '/' . '../../common/common.php';
require_once dirname( __FILE__ ) . '/' . '../../settings/delay.php'; 


if (isset($_POST['submit'])) {
//
if (!hash_equals($_POST['from'], $_POST['to'])){

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $user =[
      "from"        => $_POST['from'],
      "to" => $_POST['to'],
      "amount"  => $_POST['amount']
    ];

    $sql3 = "SELECT rewards
    FROM users
            WHERE email = :from";
            $statement = $connection->prepare($sql3);

            $statement->bindParam(':from', $_POST['from'], PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0){


                  if($result[0]["rewards"] >= $_POST['amount']){

                    sleep($config['wait']);
                    $sql = "UPDATE users
                            SET id = id,
                              firstname = firstname,
                              password = password,
                              email = :to,
                              rewards = rewards + :amount,
                              welcomegift = welcomegift,
                              date = date
                            WHERE email = :to";


                            $sql2 = "UPDATE users
                                    SET id = id,
                                      firstname = firstname,
                                      password = password,
                                      email = :from,
                                      rewards = rewards - :amount,
                                      welcomegift = welcomegift,
                                      date = date
                                    WHERE email = :from";

                  /*  $sql1 = "UPDATE users
                            SET rewards = rewards + :amount,
                            WHERE to = :to";*/

                  $statement = $connection->prepare($sql);
                  $statement->execute($user);
                  $statement = $connection->prepare($sql2);
                  $statement->execute($user);

                  }else{
                    echo '<div class="notification is-danger">
                    Not enough rewards
                  </div>';
                  }


            }else{
              echo "empty";
            }
  } catch(PDOException $error) {
      echo $sql3 . "<br>" . $error->getMessrewards();
  }
}else{
  echo '<div class="notification is-danger">
  From and to can not be same
</div>';
}
}

if (isset($_GET)) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM users";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessrewards();
  }
} else {
    echo "Something went wrong!";
    exit;
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transfer Rewards</title>
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
                <li class="is-active"><a href="#" aria-current="page">Transfer Rewards</a></li>
              </ul>
            </nav>
  <a class="button is-light" href="javascript:transfer('tomjerryten');">$10 from Tom to Jerry</a> 
  <a class="button is-light" href="javascript:transfer('tomjerryninety');">$90 from Tom to Jerry</a> 
  <br/><br/>

<form method="post">
  <span class="tag is-primary">From:</span><br>
          <select name="from" id="from" class="input">
            <?php foreach ($result as $row) : ?>
              <option value="<?php echo escape($row["email"]); ?>"><?php echo escape($row["email"]); ?> rewards( <?php echo escape($row["rewards"]); ?> )</option>
            <?php endforeach; ?>
          </select>
          <br><br>
  <span class="tag is-warning">To:</span><br>
          <select name="to" id="to" class="input">
            <?php foreach ($result as $row) : ?>
              <option value="<?php echo escape($row["email"]); ?>"><?php echo escape($row["email"]); ?> rewards( <?php echo escape($row["rewards"]); ?> )</option>
            <?php endforeach; ?>
          </select><br><br>
  <span class="tag is-danger">Amount:</span><br>
  <input class="input" type="number" id="amount" name="amount"
       min="10" max="100000" value="100">
          <input class="button is-primary" type="submit" name="submit" value="Transfer">
      </form>

      </div>
      
      </div><br>
    
    
    
    
    
      <?php require_once dirname( __FILE__ ) . '/' . '../../common/footer.php'; ?></div>
      <script>
      function transfer(a){
        var from = document.getElementById('from');
        var to = document.getElementById('to');
        var amount = document.getElementById('amount');
        from.value = 'tom@timegaptheory.com';
        to.value = 'jerry@timegaptheory.com';
        if(a=='tomjerryten'){
          amount.value = '10';
        }else if(a=='tomjerryninety'){
          amount.value = '90';
        }

      }
      </script>
    </body>
    </html>