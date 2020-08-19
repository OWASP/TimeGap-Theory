<?php

/**
 * Delete a user
 */

 require_once dirname( __FILE__ ) . '/' . '../../common/timegaptheorydatabase.php';
 require_once dirname( __FILE__ ) . '/' . '../../settings/delay.php'; 
require_once dirname( __FILE__ ) . '/' . '../../common/common.php';

$success = null;

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


if (isset($_POST["id"])) {


  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $id = $_POST["id"];

    $sql = "DELETE FROM users WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "<div class='notification is-danger'>User successfully deleted</div>";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessrewards();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM users";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessrewards();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Delete user</title>
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
                <li class="is-active"><a href="#" aria-current="page">Delete a user</a></li>
              </ul>
            </nav>
            <div class="container">

<?php if ($success) echo $success; ?>


<form method="post">
  Are you sure you want to delete the <br>user <span style='color:red;'> <?php echo escape($result[0]["firstname"]) . "</span><br> with ID: <span style='color:red;'>" . escape($result[0]["id"]) . "</span>?<br>"; ?>
  <input class="input" type="hidden" name="id" value="<?php echo escape($result[0]["id"]); ?>">
  <input class="button is-text" type="submit" name="submit" value="Submit">
</form>

<br>
</div>
      
</div>
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../../common/footer.php'; ?></div>
</body>
</html>
