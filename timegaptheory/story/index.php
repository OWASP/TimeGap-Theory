<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once dirname( __FILE__ ) . '/' . '../common/config.php';
if (isset($_POST['wait']) && isset($_POST['marswait']) && isset($_POST['maxlogin'])) {
  $config['wait'] = (int)$_POST['wait'];
  $config['marswait'] = (int)$_POST['marswait'];
  $config['maximumloginattempt'] = (int)$_POST['maxlogin'];
file_put_contents(dirname( __FILE__ ) . '/../common/config.php', '<?php $config = ' . var_export($config, true) . ';');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Story</title>
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
                <li class="is-active"><a href="#" aria-current="page">Story</a></li>
              </ul>
            </nav>
          <div class="content" style="font-size:0.9em;">

          <p>The ACME shopping chain has been seeing a decline in revenue for the past few years. A new CEO, Ms. RockStar, took charge a few months ago. Ms. RockStar wants ACME to get into online business. Getting online is essential for ACME to fight with competitors. The online presence is going to have a rewards program to encourage buyers, well, to buy more.</p>

          <p>Thanks to the declining revenue, board-of-directors are slightly sensitive when it comes to spending money. The board has decided to outsource the entire web application development to the lowest bidder from Duckburg, Freedonia. The development team consists of four recent college graduates. All of them have accounts on StackOverflow. They stood on their promise and came up with the first beta version six months late.</p>

          <p>Meanwhile, things were not going well on the ACME headquarters in San Jose, USA. One of the board directors, Mr.MoonShine's Facebook account got phished. Mr. MoonShine turned the conference room upside down last time, talking about the importance of "cyber" security. As a result of that, the board has decided to do a security verification of the current web application.</p>

          <p>ACME scanned the web app with a commercial scanner. They got a very long report, and the development team is busy fixing them. Mr. MoonShine is still not impressed. He read some online articles and found that the commercial scanner they used does not check for TOCTOU vulnerabilities.</p>

          <p>The CEO, Ms.RockStar, is your friend. She reached out to you, asking for help. A friend in need is a friend indeed. You offered her the helping hand and promised to check all of the seven essential pages for TOCTOU issues.</p>

<br/>

              
            </div>
      </div>

  


      <div class="column">
      <br><br>
      <img src="../common/blue-glass-paneled-buildings-under-clear-blue-sky-2078774.jpg" >
      <span style="color:grey;font-size:0.6em;"><a href="https://www.pexels.com/photo/blue-glass-paneled-buildings-under-clear-blue-sky-2078774/">Photo from Pexels</a></span>
      </div>
    
    </div>
      
  </div><br>





  <?php require_once dirname( __FILE__ ) . '/' . '../common/footer.php'; ?></div></div>
</body>
</html>
