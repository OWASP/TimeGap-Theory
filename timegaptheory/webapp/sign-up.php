<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once dirname( __FILE__ ) . '/' . '../common/timegaptheorydatabase.php';
require_once dirname( __FILE__ ) . '/' . '../common/common.php';
require_once dirname( __FILE__ ) . '/' . '../settings/delay.php'; 

if (isset($_POST['firstname'])) {


  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_user = array(
      "firstname" => $_POST['firstname'],
      "password"  => $_POST['password'],
      "email"     => $_POST['email'],
      "loginattempts"     => 0,
      "rewards"   => 100,
      "welcomegift"  => 0
    );

    $sql2 = "SELECT *
            FROM users
            WHERE email = :email";

    $email = $_POST['email'];
    $statement2 = $connection->prepare($sql2);
    $statement2->bindParam(':email', $email, PDO::PARAM_STR);
    $statement2->execute();

    if ($statement2->rowCount() > 0){
      echo "account email address exists";
      exit;
    }else{
      sleep($config['wait']);
      $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        "users",
        implode(", ", array_keys($new_user)),
        ":" . implode(", :", array_keys($new_user))
      );

      $statement = $connection->prepare($sql);
      $statement->execute($new_user);

    }


  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
  
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign-up</title>
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
                <li class="is-active"><a href="#" aria-current="page">Sign Up</a></li>
              </ul>
            </nav>
      <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['firstname']); ?> successfully added.</blockquote>
  <?php endif; ?>
  <a class="button is-light" href="javascript:fill('tom');">Tom</a> 
  <a class="button is-light" href="javascript:fill('jerry');">Jerry</a> 
  <a class="button is-light" href="javascript:fill('spike');">Spike</a> 
  <a class="button is-light" href="javascript:fill('tyke');">Tyke</a>
  <br/><br/>
  
  <form method="post" id="create" style="width:35%;">

    <div class="field">
      <label class="label">Name</label>
      <div class="control">
        <input class="input" name="firstname" id="firstname" type="text" placeholder="John Doe">
      </div>
    </div>


    <div class="field">
      <label class="label">Password</label>
      <div class="control">
        <input class="input" name="password" id="password" type="password" placeholder="Password" onkeyup="ee1f();" onpaste="ee2f();">
      </div>
    </div>

    <div class="notification is-danger" style="font-size:0.9em;" id="ee1n">
      Sorry, this password is already taken by the user 'admin'. <br>
      Please add/remove some characters from your password to make it unique.
    </div>

    <div class="notification is-danger" style="font-size:0.9em;" id="ee2n">
    <div class="delete" onclick="ee2e.style.display='none';"></div>
      For security reasons, we don't allow password managers. Thanks for understanding.
    </div>


    <div class="field">
      <label class="label">Email</label>
      <div class="control">
        <input class="input" name="email" id="email" type="email" placeholder="you@timegaptheory.com">
      </div>
    </div>


    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link">Submit</button>
      </div>
    </div>

  </form>
      </div>
    
    </div>
      
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../common/footer.php'; ?></div>
<script>
ee1e = document.getElementById('ee1n');
ee2e = document.getElementById('ee2n');
var passelm = document.getElementById('password');

ee1e.style.display = "none";
ee2e.style.display = "none";

function fill(user){
    document.getElementById('firstname').value = user;
    document.getElementById('password').value = user;
    document.getElementById('email').value = user + '@timegaptheory.com';
}

function ee1f(){
  ee1e.style.display = "none";
  if(['123456','password','123456789','12345678','12345','111111','1234567','sunshine','qwerty','iloveyou'].includes(passelm.value)){
    ee1e.style.display = "block";
  }
  
}

function ee2f(){
  ee2e.style.display = "block";
  
}
</script>
</body>
</html>
