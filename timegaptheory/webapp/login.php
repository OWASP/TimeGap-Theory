<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once dirname( __FILE__ ) . '/' . '../common/timegaptheorydatabase.php';
require_once dirname( __FILE__ ) . '/' . '../common/config.php';
require_once dirname( __FILE__ ) . '/' . '../common/common.php';



if (isset($_POST['email'])) {


  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $user =[
      "password"  => $_POST['password'],
      "email"     => $_POST['email']
    ];

    $sql = "SELECT id, loginattempts
            FROM users
            WHERE email = :email
            AND password = :password";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  $result = $statement->fetchAll();

  if ($statement->rowCount() > 0){
    if($result[0]["loginattempts"] >= $config['maximumloginattempt']){
      $loginmessage = " Maximum Login Attempts Reached " . $result[0]["loginattempts"];
      echo '<center><span class=\"tag is-success\">' . $loginmessage . '</span></center>';
    }else{
      session_start();
      $_SESSION['login_user'] = $_POST['email'];
      sleep($config['wait']);
      $sql4 = "UPDATE users
              SET id = id,
                firstname = firstname,
                password = password,
                email = email,
                rewards = rewards,
                welcomegift = welcomegift,
                loginattempts = 0,
                date = date
              WHERE email = :email";

        $statement4 = $connection->prepare($sql4);
        $statement4->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $statement4->execute();
      header("location: user/index.php");
    }



  }else{
    sleep($config['wait']);

    $loginmessage = "Login Failed";

    echo '<center><span class=\"tag is-success\">' . $loginmessage . '</span></center>';

    $user2 =[
        "email"     => $_POST['email']
      ];

    $sql2 = "SELECT id, loginattempts
              FROM users
              WHERE email = :email";

    $statement2 = $connection->prepare($sql2);
    $statement2->execute($user2);
    $result2 = $statement2->fetchAll();


    if ($statement2->rowCount() > 0){
      if($result2[0]["loginattempts"] < $config['maximumloginattempt']){
        sleep($config['wait']);
        $loginmessage = "Email exists on the system";
        echo '<center><span class=\"tag is-success\">' . $loginmessage . '</span></center>';
        $sql3 = "UPDATE users
                SET id = id,
                  firstname = firstname,
                  password = password,
                  email = email,
                  rewards = rewards,
                  welcomegift = welcomegift,
                  loginattempts = loginattempts + 1,
                  date = date
                WHERE email = :email";

          $statement3 = $connection->prepare($sql3);
          $statement3->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
          $statement3->execute();
      }else{
        $loginmessage = "Your account is locked out";
        echo '<center><span class=\"tag is-success\">' . $loginmessage . '</span></center>';
      }

    }


  }


  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}


if (isset($_GET)) {

if (isset($_SESSION['login_user'])){
      header("location: user/index.php");
     die();
}

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="icon" type="image/png" href="../common/webapp.png">
  <link rel="stylesheet" href="../common/bulma.css" id="light" title="Light">
  <link rel="stylesheet" href="../common/bulmadark.css"  id="dark"  title="Dark" disabled>
</head>
<body>
  <div class="container">
  <div class="columns">
  <div class="column">
    <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="../"><img src="../common/owasp.png" height="28" width="28"></a>
    <a class="navbar-item" href="../"><img src="../common/timegaptheory.png" height="28" width="28"></a>
    <a class="navbar-item" href="../"><img src="../common/lab.png" height="28px" width="28px"></a>
    <a class="navbar-item" href=""><img src="../common/webapp.png" height="28px" width="28px"></a>
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
            <a class="button is-danger" href="admin/">
              Admin
            </a>
          <a class="button is-warning" href="sign-up.php">
            Sign Up
          </a>
          <a class="button is-primary" href="login.php">
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
                <li class="is-active"><a href="#" aria-current="page">Login</a></li>
              </ul>
            </nav>
      <?php if (isset($_POST['firstname']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['firstname']); ?> successfully added.</blockquote>
  <?php endif; ?>
  <a class="button is-light" href="javascript:fill('tom');">Tom</a> 
  <a class="button is-light" href="javascript:fill('jerry');">Jerry</a> 
  <a class="button is-light" href="javascript:fill('spike');">Spike</a> 
  <a class="button is-light" href="javascript:fill('tyke');">Tyke</a>
  <br/><br/>
  
  <form method="post"  style="width:35%;">

<div class="field">
  <label class="label">Email</label>
  <div class="control">
    <input class="input" name="email" id="email" type="email" placeholder="you@timegaptheory.com">
  </div>
</div>

  <div class="field">
    <label class="label">Password</label>
    <div class="control">
      <input class="input" name="password" id="password" type="password" placeholder="Password">
    </div>
  </div>

    <input class="button is-primary" type="submit" name="submit" value="Submit">
</form>
      </div>
    
    </div>
      
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../common/footer.php'; ?></div>
<script>
function fill(user){
    document.getElementById('password').value = user;
    document.getElementById('email').value = user + '@timegaptheory.com';
}
</script>
</body>
</html>
