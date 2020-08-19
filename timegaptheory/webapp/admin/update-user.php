<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */
require_once dirname( __FILE__ ) . '/' . '../../common/timegaptheorydatabase.php';
require_once dirname( __FILE__ ) . '/' . '../../settings/delay.php'; 
require_once dirname( __FILE__ ) . '/' . '../../common/common.php';

if (isset($_POST['submit'])) {


  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $user =[
      "id"        => (int)$_POST['id'],
      "firstname" => $_POST['firstname'],
      "password"  => $_POST['password'],
      "email"     => $_POST['email'],
      "rewards"       => (int)$_POST['rewards'],
      "loginattempts"  => (int)$_POST['loginattempts'],
      "welcomegift"  => (int)$_POST['welcomegift']
    ];
    sleep($wait);

    $sql = "UPDATE users
            SET id = :id,
              firstname = :firstname,
              password = :password,
              email = :email,
              rewards = :rewards,
              loginattempts = :loginattempts,
              welcomegift = :welcomegift,
              date = :date
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->bindParam(':id', $user['id'], PDO::PARAM_STR);
  $statement->bindParam(':firstname', $user['firstname'], PDO::PARAM_STR);
  $statement->bindParam(':email', $user['email'], PDO::PARAM_STR);
  $statement->bindParam(':password', $user['password'], PDO::PARAM_STR);
  $statement->bindParam(':rewards', $user['rewards'], PDO::PARAM_STR);
  $statement->bindParam(':loginattempts', $user['loginattempts'], PDO::PARAM_STR);
  $statement->bindParam(':welcomegift', $user['welcomegift'], PDO::PARAM_STR);
  $statement->bindParam(':date', $user['date'], PDO::PARAM_STR);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessrewards();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];


    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
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
  <title>Update user</title>
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
                <li><a href="manage-users.php">Manage Users</a></li>
                <li class="is-active"><a href="#" aria-current="page">Update a user</a></li>
              </ul>
            </nav>
            <div class="container">
            


<?php if (isset($_POST['submit']) && $statement) : ?>
<div class="notification is-success"><?php echo escape($_POST['firstname']); ?> successfully updated.</div>
<?php endif; ?>
<form method="post">
  <?php foreach ($user as $key => $value) : ?>
  <div class="field">
    <label class="label"><?php echo $key; ?></label>
    <div class="control">
      <input class="input" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" type="text">
    </div>
  </div>
  <?php endforeach; ?>
    <input class="button is-text" type="submit" name="submit" value="Submit">
</form>
</div>
      
</div>
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../../common/footer.php'; ?></div>
</body>
</html>
