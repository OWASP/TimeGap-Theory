<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome | OWASP TimeGap Theory Labs</title>
  <link rel="icon" type="image/png" href="common/lab.png">
  <link rel="stylesheet" href="common/bulma.css" id="light" title="Light">
  <link rel="stylesheet" href="common/bulmadark.css"  id="dark"  title="Dark" disabled>
  <link href="common/css/all.css" rel="stylesheet">
  <style> 
  .videoWrapper {
	position: relative;
	padding-bottom: 50.25%; /* 16:9 */
	padding-top: 0px;
	height: 0;
}
.videoWrapper iframe {
	position: absolute;
	top: 20%;
	left: 20%;
	width: 60%;
	height: 60%;
}
  </style>
</head>
<body>
  <div class="container">
  <div class="columns">
  <div class="column">
    <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="index.php"><img src="common/owasp.png" height="28" width="28"></a>
    <a class="navbar-item" href="index.php"><img src="common/timegaptheory.png" height="28" width="28"></a>
    <a class="navbar-item" href="index.php"><img src="common/lab.png" height="28px" width="28px"></a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="index.php">
        OWASP TimeGap Theory Labs
      </a>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href="webapp/">
            Webapp
          </a>
          <a class="button is-warning" href="settings/">
            Settings
          </a>
          <a class="button is-info" href="score/">
              Score
            </a>
        </div>
      </div>
    </div>
  </div>
</nav>
  </div></div>

  <div class="videoWrapper"><iframe width="560" height="630" src="https://www.youtube.com/embed/ZNEEzZXROTo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>

  <div class="columns">
      </div>

  <div class="column">
    
      <br><br>
        <center><a class="button is-info is-large" href="score/">
          View Score
        </a>
          <a class="button is-danger is-large" href="story/">
            The Story
          </a>
        <a class="button is-warning is-large" href="settings/">
          Settings
        </a>
        <a class="button is-primary is-large" href="webapp/">
          Let's Begin
        </a></center>
     <br><br>
     </div>

     <div class="column">
      </div>
    
    </div>
      
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . 'common/footer.php'; ?></div>
</body>
</html>
