<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once dirname( __FILE__ ) . '/' . '../common/timegaptheorydatabase.php';
require_once dirname( __FILE__ ) . '/' . '../common/common.php'; 
require_once dirname( __FILE__ ) . '/' . '../settings/delay.php'; 




if (isset($_POST['wait']) && isset($_POST['marswait']) && isset($_POST['maxlogin'])) {
  $config['wait'] = (int)$_POST['wait'];
  $config['marswait'] = (int)$_POST['marswait'];
  $config['maximumloginattempt'] = (int)$_POST['maxlogin'];

try {
  $connection = new PDO("mysql:host=$host", $username, $password, $options);
  $sql = "use " . $dbname . ";UPDATE `settings` SET `wait`=" . $config['wait'] . ", `marswait`=" . $config['marswait'] . ", `maximumloginattempt`=" . $config['maximumloginattempt'] . " WHERE `id`=1;";
  $connection->exec($sql);
  header("Refresh:0");
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
  <title>Settings</title>
  <link rel="icon" type="image/png" href="../common/lab.png">
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
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="">
        OWASP TimeGap Theory Labs
      </a>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href="../webapp/">
            Webapp
          </a>
          <a class="button is-warning" href="../settings/">
            Settings
          </a>
          <a class="button is-info" href="../score/">
              Score
            </a>
        </div>
      </div>
    </div>
  </div>
</nav>
  </div></div>

  <div class="columns">
      <div class="column"><nav class="breadcrumb" aria-label="breadcrumbs">
              <ul>
                <li><a href="../">OWASP TimeGap Theory</a></li>
                <li class="is-active"><a href="#" aria-current="page">Settings</a></li>
              </ul>
            </nav>
          <div class="content">
          <form method="post">

<div class="field">
  <label class="label">Main wait</label>
  <p>Regular database waiting period in seconds</p>
  <div class="control">
    <input class="input" name="wait" id="email" type="number" value="<?php echo escape($settings['wait']); ?>"  style="width:35%;">
  </div>
</div>
<br>
  <div class="field">
    <label class="label">Mars wait</label>
    <p>Database waiting period for ticket to Mars</p>
    <div class="control">
      <input class="input" name="marswait" id="password" type="number" value="<?php echo escape($settings['marswait']); ?>" style="width:35%;">
    </div>
  </div>
  <br>
  <div class="field">
    <label class="label">Maximum logins</label>
    <p>Maximum number of login attempt before the account gets locked out</p>
    <div class="control">
      <input class="input" name="maxlogin" id="password" type="number" value="<?php echo escape($settings['maximumloginattempt']); ?>" style="width:35%;">
    </div>
  </div>

    <input class="button is-primary" type="submit" name="submit" value="Update">
</form>
              
            </div>
      </div>

  


      <div class="column">
      </div>
    
    </div>
      
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../common/footer.php'; ?></div></div>
</body>
</html>
