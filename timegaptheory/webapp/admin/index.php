<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
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
            <a class="button is-danger" href="index.php">
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
                <li class="is-active"><a href="#" aria-current="page">Administration Panel</a></li>
              </ul>
            </nav>
            <div class="container">
                <div class="level-left">
                    <div class="level-item"><a class="button is-info" href="manage-users.php">Manage users</a></div>
                    <div class="level-item"><a class="button is-primary" href="ticket-to-mars.php">Tickets to Mars</a></div>
                    <div class="level-item"><a class="button is-warning" href="create-users.php">Create default users</a></div>
                    <div class="level-item"><a class="button is-danger" href="reset-database.php">Reset database</a></div>
                </div>
            </div>
      </div>

      </div>
    </div>
      
  </div><br>

  <?php require_once dirname( __FILE__ ) . '/' . '../../common/footer.php'; ?></div>
</body>
</html>
